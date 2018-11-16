<?php

namespace App\Admin\Controllers;

use App\Models\Administration\Kiosk;
use App\Models\Administration\Record;
use App\Models\Administration\Umbrella;
use App\Models\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class RecordController extends Controller
{
    use HasResourceActions;

    /**
     * @var string
     */
    protected $title = 'Record Management';

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header($this->title)
            ->description('Maintaining Record Information')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header($this->title)
            ->description('Showing Record Details: '. $id)
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header($this->title)
            ->description('Editing Record Info: '. $id)
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header($this->title)
            ->description('Manually Creating New Record')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Record());

        $grid->model()->orderBy('id', 'ASC');
        $grid->paginate(50);

        $grid->id('ID');
        $grid->users()->name('Username')->sortable();
        $grid->kiosk()->name('Kiosk Name')->sortable();
        $grid->umbrella()->serial_number('Umbrella SN')->sortable();
        
        $grid->start_time('Start time');
        $grid->end_time('End time');
        
        $grid->status('Status')->display(function () {
            switch ($this->status) {
                case (0):
                    return "<span class='label label-info'>Pending</span>";
                break;
                case (1):
                    return "<span class='label label-success'>Completed</span>";
                break;
                case (2):
                    return "<span class='label label-warning'>Voided</span>";
                break;
                case (3):
                    return "<span class='label label-danger'>Overdue</span>";
                break;
                default:
                    return "<span class='label label-default'>Unknown</span>";
                break;
            }
        })->sortable();

        $grid->updated_at('Updated at');

        $grid->actions(function ($actions) {
            $actions->disableEdit();
            $actions->disableDelete();
        });

        $grid->filter(function (Grid\Filter $filter) {

            $filter->disableIdFilter();

            $filter->column(1/2, function ($filter) {
                $filter->equal('users_id', 'Username')->select()->ajax('/administration/api/get-user');
                $filter->equal('kiosk_id', 'Kiosk Name')->select()->ajax('/administration/api/get-kiosks');
            });
            
            $filter->column(1/2, function ($filter) {
                $filter->between('created_at')->datetime();
                $filter->between('updated_at')->datetime();
            });

            $filter->scope('status', 'Pending')->where('status', '0');
            $filter->scope('status', 'Completed')->where('status', '1');
            $filter->scope('status', 'Voided')->where('status', '2');
            $filter->scope('status', 'Overdue')->where('status', '3');
            $filter->scope('status', 'Unknown')->where('status', '>', '3');
            
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Record::findOrFail($id));

        $show->id('Id');
        $show->users_id('Users id');
        $show->kiosk_id('Kiosk id');
        $show->umbrella_id('Umbrella id');
        $show->start_time('Start time');
        $show->end_time('End time');
        $show->status('Status');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Record);

        // Retrieve User
        $form->select('users_id', 'User Name')->options(function ($name) {
            $user = User::find($name);

            if ($user) {
                return [$user->name => $user->id];
            }
        })->ajax('/administration/api/get-user')->rules('required');

        // Retrieve Kiosk
        $form->select('kiosk_id', 'Kiosk Name')->options(function ($name) {
            $kiosk = Kiosk::find($name);

            if ($kiosk) {
                return [$kiosk->name => $kiosk->id];
            }
        })->ajax('/administration/api/get-kiosk')->rules('required');

        // Retrieve Umbrella
        $form->select('umbrella_id', 'Umbrella Serial Number')->options(function ($serial_number) {
            $umbrella = Umbrella::find($serial_number);

            if ($umbrella) {
                return [$umbrella->serial_number => $umbrella->id];
            }
        })->ajax('/administration/api/get-allavailableumbrellas')->rules('required');

        $form->datetime('start_time', 'Start time')->default(date('Y-m-d H:i:s'))->rules('required');
        $form->datetime('end_time', 'End time')->default(date('Y-m-d H:i:s'))->rules('required');
        
        $form->select('status', 'Status')->options([
            0 => 'Pending',
            1 => 'Completed',
            2 => 'Voided',
            3 => 'Overdue',
        ]);

        $form->footer(function ($footer) {

            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();

        });

        return $form;
    }
}
