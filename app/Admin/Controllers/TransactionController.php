<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Administration\Record;
use App\Models\Administration\Transaction;
use App\Models\Administration\Vendor;
use App\Models\User;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    use HasResourceActions;

    /**
     * @var string
     */
    protected $title = 'Transaction Management';

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
            ->description('Maintaining Transaction Information')
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
            ->description('Showing Transaction Details: ', $id)
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
            ->description('Editing Transaction: ', $id)
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
            ->description('Manually Creating New Transaction')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Transaction());

        //$grid->disableCreateButton();

        $grid->model()->orderBy('id', 'ASC');
        $grid->paginate(50);

        $grid->id('ID')->sortable();
        $grid->record_id('Record ID')->sortable();
        $grid->vendor()->name('Vendor Name')->sortable();
        $grid->amount('Amount');
        $grid->created_at('Created at')->sortable();

        $grid->filter(function (Grid\Filter $filter) {
            $filter->disableIdFilter();

            $filter->equal('record_id', 'Record ID')->select();
            $filter->equal('vendor_id', 'Vendor Name')->select()->ajax('/administration/api/get-vendor');
        });

        $grid->actions(function ($actions) {
            $actions->disableEdit();
            $actions->disableDelete();
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
        $show = new Show(Transaction::findOrFail($id));

        $show->id('ID');
        $show->record_id('Record ID');
        $show->vendor()->name('Vendor Name');
        $show->amount('Amount');
        $show->created_at('Created at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Transaction());

        // $form->select('record_id', 'Record ID')->options(function ($id) {
        //     $record = Record::find($id);

        //     if ($record) {
        //         return $record->id;
        //     }
        // })->ajax('/administration/api/get-recordId')->rules('required');

        $form->text('record_id', 'Record ID')->placeholder('Please enter record ID')->help('Please enter record ID')->attribute(['autocomplete' => 'off'])->rules('required|numeric|exists:record,id');

        $form->currency('amount', 'Amount')->symbol('$')->help('Please enter billable amount')->rules('required');

        $form->select('vendor_id', 'Vendor Name')->options(function ($name) {
            $vendor = Vendor::find($name);

            if ($vendor) {
                return [$vendor->name => $vendor->id];
            }
        })->ajax('/administration/api/get-vendor')->rules('required');

        $form->footer(function ($footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        $form->saving(function ($form) {
            $paymentCode = dump($form->vendor_id);

            switch ($paymentCode) {
                case 1:
                    try {
                        $recordId = dump($form->record_id);
                        $amount = dump($form->amount);

                        $userObj = DB::table('record')->select('users_id')->where('id', $recordId)->get();
                        foreach ($userObj as $obj) {
                            $userId = $obj->users_id;
                        }

                        return $this->doTransaction($userId, $recordId, $amount);
                    } catch (Exception $e) {
                        return back()->with(compact($e));
                    }
                    break;
                default:
                    throw new Exception('Payment method is not available at this time.');
                    break;
            }
        });

        return $form;
    }

    protected static function doTransaction($id, $record, $amount)
    {
        $user = User::findOrFail($id);
        $balance = $user->balance;

        if ($balance < $amount) {
            throw new Exception('ERROR: Account Balance is less than charged amount.');
        }

        $newBalance = $balance - $amount;
        $updateBalance = DB::table('users')->where('id', $id)->decrement('balance', $amount);
        $updateStatus = DB::table('record')->where('id', $record)->update(['status' => 1]);

        return $updateStatus;
    }
}
