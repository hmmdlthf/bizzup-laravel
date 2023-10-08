<?php

namespace App\Admin\Controllers;

use App\Models\City;
use App\Models\Customer;
use App\Models\SocialType;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CustomerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Customer';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Customer());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('company_name', __('Company name'));
        $grid->column('position', __('Position'));
        $grid->column('profile_pic', __('Profile pic'));
        $grid->column('cover_pic', __('Cover pic'));
        $grid->column('company_logo', __('Company logo'));
        $grid->column('city_id', __('City id'));
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
        $show = new Show(Customer::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('company_name', __('Company name'));
        $show->field('position', __('Position'));
        $show->field('profile_pic', __('Profile pic'));
        $show->field('cover_pic', __('Cover pic'));
        $show->field('company_logo', __('Company logo'));
        $show->field('city_id', __('City id'));
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
        $form = new Form(new Customer());

        $form->text('name', __('Name'));
        $form->text('company_name', __('Company name'));
        $form->text('position', __('Position'));
        $form->text('profile_pic', __('Profile pic'));
        $form->text('cover_pic', __('Cover pic'));
        $form->text('company_logo', __('Company logo'));
        $form->select('city_id', __('City'))->options(City::all()->pluck('name', 'id'));
        // $form->number('city_id', __('City id'));

        $form->hasMany('emails', function (Form\NestedForm $form) {
            $form->text('value', __('Email'));
        });

        $form->hasMany('phones', function (Form\NestedForm $form) {
            $form->text('value', __('Phone Number'));
        });

        // $form->hasMany('whatsapp', function (Form\NestedForm $form) {
        //     $form->text('value', __('Whatsapp Number'));
        // });

        $form->hasMany('websites', function (Form\NestedForm $form) {
            $form->text('value', __('Website URL'));
        });

        $form->hasMany('products', function (Form\NestedForm $form) {
            $form->text('title', __('Title'));
            $form->textarea('des', __('Des'));
            $form->text('image', __('Image'));
            $form->decimal('price', __('Price'));
            $form->decimal('discount-price', __('Discount price'));
        });

        $form->hasMany('socials', function (Form\NestedForm $form) {
            $form->text('name', __('Name'));
            $form->text('value', __('Value'));
            $form->select('social_type_id', __('Social type id'))->options(SocialType::all()->pluck('name', 'id'));
        });

        return $form;
    }
}
