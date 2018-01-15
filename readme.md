# Form Builder

*A library to simplify form building in php applications. It uses a template approach, supplied by [Plates](http://platesphp.com). It is inspired by the [Laravel Collective Form library](https://laravelcollective.com/docs/5.3/html) and a previous generations of form builder developed by Konsulting.*

You can use the library in any PHP project, but we have included some helpers for usage within a Laravel Project.

*Documentation is still being developed, so please bear with us.*

## Installation

We recommend using composer to install the library.

`composer require konsulting/form-builder`

## Usage with Laravel

The package will auto-register the Service Provider and Facade in Laravel 5.5+. In earlier versions of Laravel, you
will need to manually register them yourself in your `config/app.php`.

```php
"providers" => [
    ...
    "Konsulting\\FormBuilder\\Laravel\\FormBuilderServiceProvider"
],

"aliases" => [
    ...
    "Form" => "Konsulting\\FormBuilder\\Laravel\\FormBuilderFacade"
]
```

You will then be able to access the FormBuilder instance though the Facade in your views (or anywhere else you need to).

```php
// For example
Form::text('name', $yourName)->withLabel('Your Name')

```

## Usage outside Laravel

To begin using the form builder, you need to construct it using the Plates Engine (which essentially tells it which templates to use) and a class resolver (which effectively tells the build where to look for each form elements' class).

```php
    use League\Plates\Engine;
    use Konsulting\FormBuilder\FormBuilder;
    use Konsulting\FormBuilder\ClassResolver;

    //...
    
    $builder = new FormBuilder(
        new Engine(__DIR__ . '/../../vendor/konsulting/form-builder/partials/bootstrap3'),
        new ClassResolver('Konsulting\\FormBuilder\\Elements\\')
    );
```

There is a simple API to build up your form elements. Each element shares a set of common methods, and we have set up the base set of html form elements.

### Shared methods
#### Setting attributes
* `withLabel(label)` and `withoutLabel`
* `withError(message)` and `withoutError`
* `withFeedback(type, message)` and `withoutFeedback`
* `withHelp(message)`
* `withAddon(content, position=before|after)` - specific addon to the input (e.g. calendar icon to the right of an input box)
* `prepend(content)` - place content before the whole html block
* `append(content)` - place content after the whole html block
* `withAttributes(['name' => value, ...])` - set a range of attributes, or those without specific setters

#### Retrieving attributes
* `attributes([array_of_keys_wanted])`
* `attributesExcept([array_of_keys_to_exclude])`

### Form Elements
* `input(type, name, value)`
* `checkbox(name, value)`
* `radio(name, value)`
* `select(name, options, selected)`
* `textarea(name, value)`
* `date(name, value)`
* `time(name, value)`
* `datetime(name, value)`

### Dates and time
Dates and time have an additional method, `split()`, which is used to generate input boxes that are split into each component of the date/time.
There is a DateTimeFormats helper class, which is used to set the formats for user input/display and for persistence.

The helper also contains functions used to help split the date into components or re-combine it based on the settings.

When using the `split()` method, your dates and times will need to be recombined when validating them, for example.

## Contributing

Contributions are welcome and will be fully credited. We will accept contributions by Pull Request. 

Please:

* Use the PSR-2 Coding Standard
* Add tests, if you’re not sure how, please ask.
* Document changes in behaviour, including readme.md.

## Testing
We use [PHPUnit](https://phpunit.de) for this package.

Run tests using PHPUnit: `vendor/bin/phpunit`
