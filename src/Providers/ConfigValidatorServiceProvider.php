<?php
/**
 * Created by IntelliJ IDEA.
 * User: matsui
 * Date: 2018/04/10
 * Time: 12:19
 */

namespace Crhg\ConfigValidator\Providers;

use Crhg\ConfigValidator\Commands\ConfigValidateCommand;
use Illuminate\Support\ServiceProvider;

class ConfigValidatorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ConfigValidateCommand::class,
            ]);
        }
    }
}