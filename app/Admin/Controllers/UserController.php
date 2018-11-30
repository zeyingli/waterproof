<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UserController extends Controller
{
    use HasResourceActions;

    protected $title = 'Client Management';

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
            ->description('Maintaining Client Information')
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
            ->description('Showing Client Details: '.$id)
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
            ->description('Editing Client Info: '.$id)
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
            ->description('Creating New Client')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->disableFilter();
        $grid->model()->orderBy('id', 'ASC');
        $grid->paginate(30);

        $grid->id('ID')->sortable();
        $grid->username('Username');
        $grid->name('Name')->editable();
        $grid->phone('Phone');
        $grid->email('Email')->prependIcon('envelop');
        $grid->balance('Balance');

        $grid->email_verified_at('Status')->display(function ($email_verified_at) {
            if (!empty($email_verified_at)) {
                return "<span class='label label-success'>Verified</span>";
            } else {
                return "<span class='label label-danger'>Unverified</span>";
            }
        });

        $grid->actions(function ($actions) {
            $actions->disableView();
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
        $show = new Show(User::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->email('Email');
        $show->username('Username');
        $show->phone('Phone');
        $show->email_verified_at('Email verified at');
        $show->password('Password');
        $show->remember_token('Remember token');
        $show->balance('Balance');
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
        $form = new Form(new User());

        $form->text('name', 'Name');
        $form->text('username', 'Username');
        $form->email('email', 'Email');
        $form->mobile('phone', 'Phone');
        $form->password('password', 'Password')->placeholder('Leave blank if no password change.');
        $form->decimal('balance', 'Account Balance')->default(0.00);
        $form->datetime('email_verified_at', 'Email verified at')->default(date('Y-m-d H:i:s'));

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
