<?php
/**
 * Created by IntelliJ IDEA.
 * User: matsui
 * Date: 2018/04/10
 * Time: 12:49
 */

namespace Crhg\ConfigValidator\Interfaces;


interface ConfigValidationRuleProvider
{
    /**
     * Rules for validate configuration
     * @return array
     */
    public function getConfigValidationRule();
}