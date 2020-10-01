<?php

namespace Konsulting\FormBuilder\Laravel;

use League\Plates\Engine;
use Konsulting\FormBuilder\ClassResolver;
use Konsulting\FormBuilder\FormBuilder as BaseFormBuilder;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class FormBuilderServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/form.php' => config_path('form.php'),
        ]);
    }

    /**
     * Register the form builder.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/form.php', 'form'
        );

        $this->app->singleton(BaseFormBuilder::class, function () {
            return (new FormBuilder(
                new Engine(config('form.templates')),
                new ClassResolver(config('form.class_namespaces'))
            ))->addDecorators(config('form.decorators'));
        });
    }
}
