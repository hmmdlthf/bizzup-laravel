<?php

namespace App\Admin\Controllers;

use App\Models\Country;
use App\Models\State;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StateController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'State';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new State());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('country_id', __('Country id'));
        $grid->column('country.name', __('Country Name'));

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
        $show = new Show(State::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('country_id', __('Country id'));
        $show->field('country.name', __('Country Name'));
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
        $form = new Form(new State());

        $form->text('name', __('Name'));
        $form->select('country_id', __('Country'))->options(Country::all()->pluck('name', 'id'));

        $form->hasMany('cities', function (Form\NestedForm $form) {
            $form->text('name', __('City Name'));
        });

        return $form;
    }
}
