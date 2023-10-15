<?php

namespace App\Admin\Controllers;

use App\Models\City;
use App\Models\Customer;
use App\Models\NfcCard;
use App\Models\SocialType;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Hash;

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
        $grid->column('username', __('Username'));
        $grid->column('company_name', __('Company name'));
        $grid->column('profile_type', __('Profile Type'));
        $grid->column('position', __('Position'));
        $grid->column('profile_pic', __('Profile pic'));
        $grid->column('cover_pic', __('Cover pic'));
        $grid->column('company_logo', __('Company logo'));
        $grid->column('city.name', __('City'));
        $grid->column('city.state.name', __('State'));
        $grid->column('city.state.country.name', __('Country'));

        $grid->filter(function ($filter) {
            return $filter->like('name');
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
        $show = new Show(Customer::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('username', __('Username'));
        $show->field('company_name', __('Company name'));
        $show->field('profile_type', __('Profile Type'));
        $show->field('position', __('Position'));
        $show->field('profile_pic', __('Profile pic'))->unescape()->as(function ($pic) {
            $pic = asset('storage/' . $pic);
            return "<img src='{$pic}' style='width: 200px; height: auto;' />";
        });
        $show->field('is_profile_pic', __('Is Profile pic Visible'))->as(function ($value) {
            return $value == 1 ? 'Visible' : 'Not Visible';
        });
        $show->field('cover_pic', __('Cover pic'))->unescape()->as(function ($pic) {
            $pic = asset('storage/' . $pic);
            return "<img src='{$pic}' style='width: 200px; height: auto;' />";
        });
        $show->field('company_logo', __('Company logo'))->unescape()->as(function ($pic) {
            $pic = asset('storage/' . $pic);
            return "<img src='{$pic}' style='width: 200px; height: auto;' />";
        });
        $show->field('is_company_logo', __('Is Company logo Visible'))->as(function ($value) {
            return $value == 1 ? "Visible" : "Not Visible";
        });
        $show->field('address', __('Address'));
        $show->field('about', __('About'))->unescape();
        $show->city(function ($city) {
            $city->field('name', __('City'));

            $city->state(function ($state) {
                $state->field('name', __('State'));

                $state->country(function ($country) {
                    $country->field('name', __('Country'));
                });
            });
        });
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        $show->socials('Socials', function ($socials) {
            $socials->resource('/admin/socials');

            $socials->value();
            $socials->column('social_type.name', __('Social Type'));

            $socials->filter(function ($filter) {
                $filter->like('value');
            });
        });

        $show->emails('Emails', function ($emails) {
            $emails->resource('/admin/emails');

            $emails->value();

            $emails->filter(function ($filter) {
                $filter->like('value');
            });
        });

        $show->phones('Phones', function ($phones) {
            $phones->resource('/admin/phones');

            $phones->value();

            $phones->filter(function ($filter) {
                $filter->like('value');
            });
        });

        $show->whatsapps('Whatsapps', function ($whatsapps) {
            $whatsapps->resource('/admin/whatsapps');

            $whatsapps->value();

            $whatsapps->filter(function ($filter) {
                $filter->like('value');
            });
        });

        $show->websites('Websites', function ($websites) {
            $websites->resource('/admin/websites');

            $websites->value();

            $websites->filter(function ($filter) {
                $filter->like('value');
            });
        });

        $show->products('Products', function ($products) {
            $products->resource('/admin/products');

            $products->column('title', __('Title'));
            $products->column('image', __('Image'))->display(function ($image) {
                $image = asset('storage/' . $image);
                return "<img src='{$image}' style='width: 50px; height: 50px; object-fit: cover;' />";
            });
            $products->column('price', __('Price'));
            $products->column('discount-price', __('Discount price'));

            $products->filter(function ($filter) {
                $filter->like('title');
            });
        });

        $show->other_images('Other_images', function ($other_images) {
            $other_images->resource('/admin/other_images');

            $other_images->image()->display(function ($image) {
                $image = asset('storage/' . $image);
                return "<img src='{$image}' style='width: 50px; height: 50px; object-fit: cover;' />";
            });

            $other_images->filter(function ($filter) {
                $filter->like('image');
            });
        });


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

        $form->display('id', __('ID'));

        $form->text('name', __('Name'));
        $form->text('company_name', __('Company name'));
        $form->text('username', __('Username'));
        $form->password('password', __('Password'))->default('password');
        $form->text('position', __('Position'));
        $form->select('profile_type', __('Profile Type'))->options(['personal' => 'Personal Type', 'company' => 'Company Type'])->default('personal');
        $form->image('profile_pic', __('Profile pic'));
        $form->switch('is_profile_pic', __('Is Profile Visible'))->default(true);
        $form->image('cover_pic', __('Cover pic'));
        $form->image('company_logo', __('Company logo'));
        $form->switch('is_company_logo', __('Is Company Logo Visible'))->default(true);
        $form->textarea('address', __('Address'));
        $form->ckeditor('about', __('About'))->options(['height' => 500]);
        $form->select('city_id', __('City'))->options(City::all()->pluck('name', 'id'));
        $form->select('status', __('Status'))->options(['active' => 'Active', 'inactive' => 'Inactive'])->default('active');

        $form->hasMany('emails', function (Form\NestedForm $form) {
            $form->text('value', __('Email'));
        });

        $form->hasMany('phones', function (Form\NestedForm $form) {
            $form->text('value', __('Phone Number'));
        });

        $form->hasMany('whatsapps', function (Form\NestedForm $form) {
            $form->text('value', __('Whatsapp Number'));
        });

        $form->hasMany('websites', function (Form\NestedForm $form) {
            $form->text('value', __('Website URL'));
        });

        $form->hasMany('products', function (Form\NestedForm $form) {
            $form->text('title', __('Title'));
            $form->textarea('des', __('Des'));
            $form->image('image', __('Image'));
            $form->decimal('price', __('Price'));
            $form->decimal('discount-price', __('Discount price'));
        });

        $form->hasMany('socials', function (Form\NestedForm $form) {
            $form->text('value', __('Value'));
            $form->select('social_type_id', __('Social type id'))->options(SocialType::all()->pluck('name', 'id'));
        });

        $form->hasMany('other_images', function (Form\NestedForm $form) {
            $form->image('image', __('image'));
        });

        $form->saving(function (Form $form) {
            $form->password = Hash::make($form->password);
        });
        
        return $form;
    }
}
