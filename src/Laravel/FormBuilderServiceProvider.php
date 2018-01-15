<?php

namespace Konsulting\FormBuilder\Laravel;

use League\Plates\Engine;
use Konsulting\FormBuilder\ClassResolver;
use Konsulting\FormBuilder\FormBuilder as BaseFormBuilder;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class FormBuilderServiceProvider extends BaseServiceProvider
{
    /**
     * Register the form builder.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BaseFormBuilder::class, function () {
            return (new FormBuilder(
                new Engine(__DIR__ . '/../../form-builder/partials/bootstrap3'),
                new ClassResolver('Konsulting\\FormBuilder\\Elements\\')
            ))->addDecorators(config('laravel-form-builder.decorators'));
        });
    }
}
