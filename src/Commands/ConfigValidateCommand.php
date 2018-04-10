<?php
/**
 * Created by IntelliJ IDEA.
 * User: matsui
 * Date: 2018/04/10
 * Time: 12:21
 */

namespace Crhg\ConfigValidator\Commands;

use Crhg\ConfigValidator\Interfaces\ConfigValidationRuleProvider;
use Illuminate\Console\Command;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class ConfigValidateCommand extends Command
{
    protected $signature = 'config:validate';

    protected $description = 'Validate configuration';

    /**
     * @return int exit status
     */
    public function handle()
    {
        $config = Config::all();

        /** @var Application $app */
        $app = $this->getLaravel();
        /** @var ConfigValidationRuleProvider[] $ruleProviders */
        $ruleProviders = $app->getProviders(ConfigValidationRuleProvider::class);

        $found_error = false;
        foreach ($ruleProviders as $p) {
            $rule = $p->getConfigValidationRule();
            $validator = Validator::make($config, $rule);

            foreach ($validator->errors()->keys() as $key) {
                foreach ($validator->errors()->get($key) as $message) {
                    $this->line(sprintf("%s: %s", $key,$message));
                }
                $found_error=true;
            }
        }

        return $found_error? 1: 0;
    }
}