<?php

ini_set('display_errors', 1);
error_reporting(E_ALL^E_NOTICE);
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../yiisoft/vendor/autoload.php');
require(__DIR__ . '/../yiisoft/vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();

