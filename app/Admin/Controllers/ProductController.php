<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('des', __('Des'));
        $grid->column('image', __('Image'));
        $grid->column('price', __('Price'));
        $grid->column('discount-price', __('Discount price'));
        $grid->column('customer_id', __('Customer id'));
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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('des', __('Des'));
        $show->field('image', __('Image'));
        $show->field('price', __('Price'));
        $show->field('discount-price', __('Discount price'));
        $show->field('customer_id', __('Customer id'));
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
        $form = new Form(new Product());

        $form->text('title', __('Title'));
        $form->textarea('des', __('Des'));
        $form->image('image', __('Image'));
        $form->decimal('price', __('Price'));
        $form->decimal('discount-price', __('Discount price'));
        $form->number('customer_id', __('Customer id'));

        return $form;
    }
}
