<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Administration\Kiosk;
use App\Models\Administration\Umbrella;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class UmbrellaController extends Controller
{
    use HasResourceActions;

    /**
     * @var string
     */
    protected $title = 'Umbrella Management';

    /**
     * Index interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header($this->title)
            ->description('Maintaining Umbrella Information and Status')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header($this->title)
            ->description('Showing Umbrella Details: '.$id)
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header($this->title)
            ->description('Editing Umbrella Info: '.$id)
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header($this->title)
            ->description('Registering New Umbrella')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Umbrella());

        $grid->disableFilter();
        $grid->model()->orderBy('id', 'ASC');
        $grid->paginate(30);

        $grid->id('ID')->sortable();
        $grid->kiosk()->name('Kiosk Name');
        $grid->serial_number('Serial Number');

        $grid->status()->display(function () {
            switch ($this->status) {
            case 0:
                return "<span class='label label-success'>Available</span>";
                break;
            case 1:
                return "<span class='label label-info'>Rented</span>";
                break;
            case 2:
                return "<span class='label label-danger'>Lost</span>";
                break;
            default:
                return "<span class='label label-warning'>Unavailable</span>";
                break;
            }
        });

        // $grid->url('Url');

        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableEdit();
        });

        $grid->created_at('Created at');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Umbrella::findOrFail($id));

        $show->id('ID');
        $show->kiosk_id('Kiosk ID');
        $show->serial_number('Serial Number');
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
        $form = new Form(new Umbrella());

        $form->text('serial_number', 'Serial Number')->placeholder('UA-0000')->rules('required|max:10');

        $form->select('kiosk_id', 'Kiosk Name')->options(function ($name) {
            $kiosk = Kiosk::find($name);

            if ($kiosk) {
                return [$kiosk->name => $kiosk->id];
            }
        })->ajax('/administration/api/get-kiosk')->rules('required');

        $states = [
            0 => 'Available',
            4 => 'Unavailable',
        ];
        $form->select('status', 'Status')->options($states)->rules('required');

        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
        });

        $form->footer(function ($footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        return $form;
    }

    public function getAvailableUmbrella(Request $request)
    {
        $kioskID = $request->get('q');

        return Umbrella::where([
            ['kiosk_id', '=', $kioskID],
            ['status', '=', 0],
        ])->count('id');
    }
}
