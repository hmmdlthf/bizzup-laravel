<?php

namespace App\Admin\Controllers;

use App\Models\Customer;
use App\Models\NfcCard;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class NfcCardController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'NfcCard';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new NfcCard());

        $grid->column('id', __('Id'));
        $grid->column('prefix', __('Prefix'));
        $grid->column('uid', __('Uid'));
        $grid->column('url', __('Url'));
        $grid->column('qrcode', __('Qrcode'));
        $grid->column('status', __('Status'));
        $grid->column('customer_id', __('Customer Id'));
        $grid->column('customer.name', __('Customer Name'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(NfcCard::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('prefix', __('Prefix'));
        $show->field('uid', __('Uid'));
        $show->field('url', __('Url'));
        $show->field('qrcode', __('Qrcode'));
        $show->field('status', __('Status'));
        $show->field('customer_id', __('Customer Id'));
        $show->field('customer.name', __('Customer Name'));
        $show->field('customer.company_name', __('Company Name'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new NfcCard());

        $form->text('prefix', __('Prefix'));
        $form->text('uid', __('Uid'));
        $form->url('url', __('Url'));
        $form->image('qrcode', __('Qrcode'));
        $form->text('status', __('Status'))->default('active');
        $form->select('customer_id', __('Customer'))->options(Customer::all()->pluck('name', 'id'));

        return $form;
    }
}
