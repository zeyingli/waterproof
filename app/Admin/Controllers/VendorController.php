<?php

namespace App\Admin\Controllers;

use App\Models\Administration\Vendor;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class VendorController extends Controller
{
    use HasResourceActions;

    /**
     * @var string
     */
    protected $title = 'Vendor Management';

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
            ->description('Maintaining Vendor Information')
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
            ->description('Showing Information for Vendor: '. $id)
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
            ->description('Editing Information for Vendor: '. $id)
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
            ->description('Creating New Vendor')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Vendor());

        $grid->disableFilter();
        $grid->disableExport();

        $grid->model()->orderBy('id', 'ASC');
        $grid->paginate(10);

        $grid->id('ID')->sortable();
        $grid->name('Name');
        $grid->created_at('Created at');

        $grid->actions(function ($actions) {
            $actions->disableView();
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
        $show = new Show(Vendor::findOrFail($id));

        $show->id('ID');
        $show->name('Name');
        $show->key('API Key');
        $show->secret('API Secret');
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
        $form = new Form(new Vendor());

        $form->text('name', 'Vendor Name')->help('Vendor Name')->placeholder('Vendor Name')->attribute(['autocomplete' => 'off'])->rules('required|max:20');
        $form->text('key', 'API Key')->help('Vendor API Key')->placeholder('Vendor API Key')->attribute(['autocomplete' => 'off'])->rules('required|max:191');
        $form->password('secret', 'API Secret')->help('Vendor API Secret')->placeholder('Vendor API Secret')->rules('max:191');

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
}
