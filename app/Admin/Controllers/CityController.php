<?php

namespace App\Admin\Controllers;

use App\Models\City;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CityController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'City';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new City());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('state_id', __('State id'));
        $grid->column('state.name', __('State'));
        $grid->column('state.country_id', __('Country id'));
        $grid->column('state.country.name', __('Country'));

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
        $show = new Show(City::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('state_id', __('State id'));
        $show->field('state.name', __('State'));
        $show->field('state.country_id', __('Country id'));
        $show->field('state.country.name', __('Country'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new City());

        $form->text('name', __('Name'));
        $form->number('state_id', __('State id'));

        return $form;
    }
}
