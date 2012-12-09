<?php

/**
 * main.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/22/12
 * Time: 5:48 PM
 *
 * This file holds the configuration settings of your backend application.
 * */
$backendConfigDir = dirname(__FILE__);

$root = $backendConfigDir . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..';

$params = require_once($backendConfigDir . DIRECTORY_SEPARATOR . 'params.php');

// Setup some default path aliases. These alias may vary from projects.
Yii::setPathOfAlias('root', $root);
Yii::setPathOfAlias('common', $root . DIRECTORY_SEPARATOR . 'common');
Yii::setPathOfAlias('backend', $root . DIRECTORY_SEPARATOR . 'backend');
Yii::setPathOfAlias('www', $root . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'www');
/* uncomment if you need to use frontend folders */
/* Yii::setPathOfAlias('frontend', $root . DIRECTORY_SEPARATOR . 'frontend'); */


$mainLocalFile = $backendConfigDir . DIRECTORY_SEPARATOR . 'main-local.php';
$mainLocalConfiguration = file_exists($mainLocalFile) ? require($mainLocalFile) : array();

$mainEnvFile = $backendConfigDir . DIRECTORY_SEPARATOR . 'main-env.php';
$mainEnvConfiguration = file_exists($mainEnvFile) ? require($mainEnvFile) : array();

return CMap::mergeArray(
                array(
            'name' => '集结号',
            // @see http://www.yiiframework.com/doc/api/1.1/CApplication#basePath-detail
            'basePath' => 'backend',
            // set parameters
            'params' => $params,
            // preload components required before running applications
            // @see http://www.yiiframework.com/doc/api/1.1/CModule#preload-detail
            'preload' => array('bootstrap', 'log'),
            // @see http://www.yiiframework.com/doc/api/1.1/CApplication#language-detail
            'language' => 'zh_cn',
            'defaultController' => 'site',
            // using bootstrap theme ? not needed with extension
            //'theme' => 'bootstrap',
            // setup import paths aliases
            // @see http://www.yiiframework.com/doc/api/1.1/YiiBase#import-detail
            'import' => array(
                'common.components.*',
                'common.extensions.*',
                /* uncomment if required */
                /* 'common.extensions.behaviors.*', */
                /* 'common.extensions.validators.*', */
                'common.models.*',
                // uncomment if behaviors are required
                // you can also import a specific one
                /* 'common.extensions.behaviors.*', */
                // uncomment if validators on common folder are required
                /* 'common.extensions.validators.*', */
                'application.components.*',
                'application.controllers.*',
                'application.models.*',
                'application.modules.user.models.*',
                'application.modules.user.components.*',
            ),
            /* uncomment and set if required */
            // @see http://www.yiiframework.com/doc/api/1.1/CModule#setModules-detail
            'modules' => array(
                'comments' => array(
                    //you may override default config for all connecting models
                    'defaultModelConfig' => array(
                        //only registered users can post comments
                        'registeredOnly' => false,
                        'useCaptcha' => false,
                        //allow comment tree
                        'allowSubcommenting' => true,
                        //display comments after moderation
                        'premoderate' => false,
                        //action for postig comment
                        'postCommentAction' => 'comments/comment/postComment',
                        //super user condition(display comment list in admin view and automoderate comments)
                        'isSuperuser' => 'false',
                        //order direction for comments
                        'orderComments' => 'DESC',
                    ),
                    //the models for commenting
                    'commentableModels' => array(
                        //model with individual settings
                        'Citys' => array(
                            'registeredOnly' => true,
                            'useCaptcha' => true,
                            'allowSubcommenting' => false,
                            //config for create link to view model page(page with comments)
                            'pageUrl' => array(
                                'route' => 'admin/citys/view',
                                'data' => array('id' => 'city_id'),
                            ),
                        ),
                        //model with default settings
                        'ImpressionSet',
                    ),
                    //config for user models, which is used in application
                    'userConfig' => array(
                        'class' => 'User',
                        'nameProperty' => 'username',
                        'emailProperty' => 'email',
                    ),
                ),
                'user' => array(
                    # encrypting method (php hash function)
                    'hash' => 'md5',
                    # send activation email
                    'sendActivationMail' => true,
                    # allow access for non-activated users
                    'loginNotActiv' => false,
                    # activate user on registration (only sendActivationMail = false)
                    'activeAfterRegister' => false,
                    # automatically login from registration
                    'autoLogin' => true,
                    # registration path
                    'registrationUrl' => array('/user/registration'),
                    # recovery password path
                    'recoveryUrl' => array('/user/recovery'),
                    # login form path
                    'loginUrl' => array('/user/login'),
                    # page after login
                    'returnUrl' => array('/user/profile'),
                    # page after logout
                    'returnLogoutUrl' => array('/user/login'),
                ),
                'message' => array(
                    'userModel' => 'User',
                    'getNameMethod' => 'getFullName',
                    'getSuggestMethod' => 'getSuggest',
                ),
                'api' => array(
                   // 'apiPerPage'=>15,
                    ),
                'gii' => array(
                    'class' => 'system.gii.GiiModule',
                    'password' => 'admin',
                    'generatorPaths' => array(
                        'bootstrap.gii'
                    )
                )
            ),
            
            'components' => array(
                'user' => array(
                    // enable cookie-based authentication
                    'class' => 'WebUser',
                    'allowAutoLogin' => true,
                    'loginUrl' => array('/user/login'),
                ),
                /* load bootstrap components */
                'bootstrap' => array(
                    'class' => 'common.extensions.bootstrap.components.Bootstrap',
                    'responsiveCss' => true,
                ),
                'errorHandler' => array(
                    // @see http://www.yiiframework.com/doc/api/1.1/CErrorHandler#errorAction-detail
                    'errorAction' => 'site/error'
                ),
                'db' => array(
                    'connectionString' => $params['db.connectionString'],
                    'username' => $params['db.username'],
                    'password' => $params['db.password'],
                    'schemaCachingDuration' => YII_DEBUG ? 0 : 86400000, // 1000 days
                    'enableParamLogging' => YII_DEBUG,
                    'charset' => 'utf8',
                    'tablePrefix' => $params['db.tablePrefix'],
                ),
                'urlManager' => array(
                    'urlFormat' => 'path',
                    //'showScriptName' => false,
                    'urlSuffix' => '/',
                    'rules' => $params['url.rules']
                ),
            /* make sure you have your cache set correctly before uncommenting */
            /* 'cache' => $params['cache.core'], */
            /* 'contentCache' => $params['cache.content'] */
            // 'log'=>array(
            //         'class'=>'CLogRouter',
            //         'routes'=>array(
            //                        array(
            //                           'class'=>'CFileLogRoute',
            //                            'levels'=>'trace, info',
            //                            'categories'=>'system.*',
            //                            ),
            //                        array(
            //                             'class'=>'CWebLogRoute',
            //                             ),
            //                        ),
            //                  ),

            ),
                ), CMap::mergeArray($mainEnvConfiguration, $mainLocalConfiguration)
);