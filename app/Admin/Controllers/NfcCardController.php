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
        $grid->column('url', __('Url'))->display(function ($url) {
            return "<a href='{$url} 'target='_blank' >{$url}</a>";
        });
        $grid->column('qrcode', __('Qrcode'))->display(function ($pic) {
            $pic = asset('storage/' . $pic);
            $pic_file = basename($pic);
            return "<a href='{$pic}' download='{$pic_file}' target='_blank'>{$pic}</a>";
        });
        $grid->column('status', __('Status'));
        $grid->column('customer_id', __('Customer Id'));
        $grid->column('customer.name', __('Customer Name'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->filter(function ($filter) {
            return $filter->like('uid');
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
        $show = new Show(NfcCard::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('prefix', __('Prefix'));
        $show->field('uid', __('Uid'));
        $show->field('url', __('Url'));
        $show->field('qrcode', __('Qrcode'))->unescape()->as(function ($pic) {
            $pic = asset('storage/' . $pic);
            $pic_file = basename($pic);
            return "<div style='position: relative;'><img src='{$pic}' style='width: 200px; height: auto;' /><a href='{$pic}' download='{$pic_file}' target='_blank' class='btn btn-sm btn-primary' style='position: absolute; bottom: 1rem; right: 1rem;'>Download Image</a></div>";
        });
        $show->field('status', __('Status'));

        $show->customer(function ($customer) {
            $customer->field('id', __('Customer Id'));
            $customer->field('name', __('Customer'));
            $customer->field('company_name', __('Company'));
        });
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
        $form->select('status', __('Status'))->options(['active' => 'Active', 'inactive' => 'Inactivate'])->default('active');
        $form->select('customer_id', __('Customer'))->options(Customer::all()->pluck('name', 'id'));

        return $form;
    }
}
