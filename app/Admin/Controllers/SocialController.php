<?php

namespace App\Admin\Controllers;

use App\Models\Customer;
use App\Models\Social;
use App\Models\SocialType;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SocialController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Social';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Social());

        $grid->column('id', __('Id'));
        $grid->column('customer_id', __('Customer id'));
        $grid->column('social_type_id', __('Social type id'));
        $grid->column('social_type.name', __('Name'));
        $grid->column('value', __('Value'));
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
        $show = new Show(Social::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('customer_id', __('Customer id'));
        $show->field('customer.name', __('Customer Name'));
        $show->field('social_type_id', __('Social type id'));
        $show->field('social_type.name', __('Name'));
        $show->field('value', __('Value'));
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
        $form = new Form(new Social());

        $form->number('customer_id', __('Customer'))->options(Customer::all()->pluck('name', 'id'));
        $form->select('social_type_id', __('Social type'))->options(SocialType::all()->pluck('name', 'id'));
        $form->text('value', __('Value'));

        return $form;
    }
}
