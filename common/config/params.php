<?php

/**
 * params.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/22/12
 * Time: 1:39 PM
 */
/**
 * Parameters shared by all applications.
 * Please put environment-sensitive parameters in env/params-{environmentcode}.php
 */
$commonConfigDir = dirname(__FILE__);

// get local parameters in
$commonParamsLocalFile = $commonConfigDir . DIRECTORY_SEPARATOR . 'params-local.php';
$commonParamsLocal = file_exists($commonParamsLocalFile) ? require ($commonParamsLocalFile) : array();

// if exists, include it, otherwise set as an empty array
$commonEnvParamsFile = $commonConfigDir . DIRECTORY_SEPARATOR . 'params-env.php';
$commonEnvParams = file_exists($commonEnvParamsFile) ? require($commonEnvParamsFile) : array();

return CMap::mergeArray(array(
            // cache settings -if APC is not loaded, then use CDbCache
            'cache.core' => extension_loaded('apc') ?
                    array(
                'class' => 'CApcCache',
                    ) :
                    array(
                'class' => 'CDbCache',
                'connectionID' => 'db',
                'autoCreateCacheTable' => true,
                'cacheTableName' => 'cache',
                    ),
            'cache.content' => array(
                'class' => 'CDbCache',
                'connectionID' => 'db',
                'autoCreateCacheTable' => true,
                'cacheTableName' => 'cache',
            ),
            // url rules needed by CUrlManager
            'url.rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                //简单方式先处理来自api的访问方式
                // '<module:\w+>/<controller:\w+>/<action:\w+>.json' => '<module>/<controller>/<action>',
                '<module:api>/<controller:\w+>/<action:\w+>.json' => '<module>/<controller>/<action>',
                '<module:api>/<controller:\w+>/show/<id:\d+>.json' => '<module>/<controller>/show',
               // '<module:api>/<controller:\w+>/destroy/<id:\d+>.json' => '<module>/<controller>/show',
                'api/favorites/<id:\d+>.json' => 'api/favorites',
                'api/favorites.json' => 'api/favorites',
            //array( 'api/favorites', 'pattern' => '<module:\w+>/<controller:\w+>/<action:\w+>'),
            // add rest api by fsn
            // array('api/preflight', 'pattern'=>'api/*', 'verb'=>'OPTIONS'),
            //        array('api/index', 'pattern'=>'api/*', 'verb'=>'GET'),
            // array('api/list', 'pattern'=>'api/<model:\w+>', 'verb'=>'GET'),
            //       array('api/view', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
            //       array('api/update', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
            //       array('api/delete', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
            //       array('api/create', 'pattern'=>'api/<model:\w+>', 'verb'=>'POST'),
            // add rest api by fsn
            ),
            'php.exePath' => '/usr/bin/php'
                ), CMap::mergeArray($commonEnvParams, $commonParamsLocal));