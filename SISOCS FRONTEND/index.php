<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/protected/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',false);
// Yii 1.1 predates PHP's required internal interface return types. PHP 8.x
// reports those legacy signatures as deprecations while the framework boots;
// Yii's error handler otherwise turns the deprecation into a bootstrap error.
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',5);

require_once($yii);
Yii::createWebApplication($config)->run();
