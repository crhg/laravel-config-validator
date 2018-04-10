# DESCRIPTION

Validate the configuration of the Laravel application.

# INSTALL

```console
composer require crhg/laravel-config-validator
```

# USAGE

## PREPARE RULES

Implement the `Crhg\ConfigValidator\Interfaces\ConfigValidationRuleProvider` interface in the service provider class.

Define `getConfigValidationRule()` function.
It has no arguments and returns an array of validation rules.
Rules are written in the same way as [validation for request](https://laravel.com/docs/master/validation).

### EXAMPLE

```php
class AppServiceProvider extends ServiceProvider implements ConfigValidationRuleProvider
{
    public function getConfigValidationRule()
    {
        return [
            'app.foo' => 'required',
        ];
    }
}

```

## PERFORM CHECK

Validate the current configuraiton using the rules prepared by executing the `config:validate` artisan command.

```console
% php artisan config:varidate
app.foo: The app.foo field is required.
```

It will display a message if there is a problem.

It exists with status `1` if some errors are found.

# BUGS

* Sometimes the wording of a message is odd because the validator for the request is used.