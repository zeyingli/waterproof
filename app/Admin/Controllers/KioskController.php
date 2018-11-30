<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\StatusChange;
use App\Http\Controllers\Controller;
use App\Models\Administration\Kiosk;
use App\Models\Administration\Umbrella;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class KioskController extends Controller
{
    use HasResourceActions;

    /**
     * @var string
     */
    protected $title = 'Kiosk Management';

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
            ->description('Maintaining Kiosk Information and Status')
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
            ->description('Showing Kiosk Details: '.$id)
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
            ->description('Editing Kiosk Info: '.$id)
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
            ->description('Creating New Kiosk')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Kiosk());

        $grid->disableFilter();

        $grid->model()->orderBy('id', 'ASC');

        $grid->paginate(10);

        $grid->id('ID')->sortable();
        $grid->name()->editable();
        $grid->column('location');
        $grid->umbrella('Available Umbrella')->display(function ($status) {
            $status = Umbrella::where([
                ['kiosk_id', '=', $this->id],
                ['status', '=', 0],
            ])->count();

            return "<span>{$status}</span>";
        });
        // $grid->url('QR Code')->urlWrapper();

        // $states = [
        //     'on' => ['value' => '1', 'text' => 'Enable', 'color' => 'success'],
        //     'off' => ['value' => '0', 'text' => 'Disable', 'color' => 'danger'],
        // ];

        // $grid->status()->switch($states);
        $grid->status()->display(function () {
            switch ($this->status) {
                case 0:
                    return "<span class='label label-danger'>Disconnected</span>";
                    break;
                case 1:
                    return "<span class='label label-success'>Connected</span>";
                    break;
                case 2:
                    return "<span class='label label-warning'>Disabled</span>";
                    break;
                default:
                    return "<span class='label label-default'>Unknown</span>";
                    break;
            }
        });

        $grid->updated_at();

        $grid->actions(function ($actions) {
            $actions->disableView();
        });

        $grid->tools(function ($tools) {
            $tools->batch(function (Grid\Tools\BatchActions $batch) {
                $batch->add('Enable', new StatusChange(1));
                $batch->add('Disable', new StatusChange(0));
            });
        });

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
        $show = new Show(Kiosk::findOrFail($id));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Kiosk());

        $form->display('id', 'ID');

        $form->text('name')->default('000@IST')->help('Kiosk Name')->rules('required|max:50|unique:kiosk');

        $form->text('location')->help('Kiosk Location')->rules('required|max:50')->attribute(['autocomplete' => 'off', 'placeholder' => 'Kiosk Location']);

        $form->text('lat', 'Latitude')->help('Please visit http://www.mapcoordinates.net/en for more details')->rules('required')->attribute(['autocomplete' => 'off', 'placeholder' => 'Latitude of Kiosk']);
        $form->text('lng', 'Longitude')->help('Please visit http://www.mapcoordinates.net/en for more details')->rules('required')->attribute(['autocomplete' => 'off', 'placeholder' => 'Longitude of Kiosk']);
        $form->url('img', 'Thumbnail')->help('Thumbnail of Kiosk Location')->attribute(['autocomplete' => 'off', 'placeholder' => 'https://cdn.zeyingli.com/waterproof/images/thumbnail/xxx.jpg']);

        $states = [
            'on'  => ['value' => 1, 'text' => 'Enable', 'color' => 'success'],
            'off' => ['value' => 2, 'text' => 'Disable', 'color' => 'danger'],
        ];
        $form->switch('Status')->states($states)->default(1)->rules('required');

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

    public function status(Request $request)
    {
        foreach (Kiosk::find($request->get('ids')) as $kiosk) {
            $kiosk->status = $request->get('action');
            $kiosk->save();
        }
    }

    public function getKiosks(Request $request)
    {
        $q = $request->get('q');

        return Kiosk::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }
}
