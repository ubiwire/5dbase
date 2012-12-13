<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="language" content="en"/>

        <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon"/>
        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />


        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
        <?php if (Yii::app()->user->isGuest): ?>
            <?php echo $content; ?>
        <?php else: ?>
            <div class="container" id="page">
                <?php
                $tt = '<span class="badge badge-primary">1</span>';
                $this->widget('bootstrap.widgets.TbNavbar', array(
                    'type' => 'null', // null or 'inverse'
                    'brand' => Yii::t('default', 'Project name'),
                    'brandUrl' => '#',
                    'collapse' => true, // requires bootstrap-responsive.css
                    'items' => array(
                        array(
                            'class' => 'bootstrap.widgets.TbMenu',
                            'items' => array(
                                array('label' => Yii::t('default', 'index page'), 'url' => array('/site/index')),
                                //array('label' => Yii::t('default', 'member manage'), 'url' => array('/site/page', 'view' => 'about')),
                                //array('label' => Yii::t('default', 'product manage'), 'url' => array('/product')),
                                array('label' => Yii::t('default', 'product manage'), 'items' => array(
                                        array('label' => Yii::t('default', 'add product'), 'url' => array('/product/create')),
                                        array('label' => Yii::t('default', 'product list'), 'url' => array('/product/list')),
                                        array('label' => Yii::t('default', 'category manage'), 'url' => array('/news')),
                                )),
                                array('label' => Yii::t('default', 'reward point'), 'items' => array(
                                        array('label' => Yii::t('default', 'reward list'), 'url' => '#'),
                                        array('label' => Yii::t('default', 'reward grant'), 'url' => '#'),
                                )),
                                array('label' => Yii::t('default', 'team manage'), 'items' => array(
                                        array('label' => Yii::t('default', 'update team profile'), 'url' => array('/org/update')),
                                        array('label' => Yii::t('default', 'team tools'), 'url' => array('/news')),
                                        array('label' => Yii::t('default', 'member manage'), 'url' => array('/user')),
                                )),
                                array('label' => Yii::t('default', 'course manage'), 'items' => array(
                                        array('label' => Yii::t('default', 'create course'), 'url' => '#'),
                                        array('label' => Yii::t('default', 'course list'), 'url' => '#'),
                                )),
                            ),
                        ),
                        '<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder=' . Yii::t('default', 'Search') . '></form>',
                        //(!Yii::app()->user->isGuest) ? '<p class="navbar-text pull-right"><a href="#">Help</a></p>' : '',
                        /*
                          <span class="badge badge-primary">1</span>
                         */

                        array(
                            'class' => 'bootstrap.widgets.TbMenu',
                            'encodeLabel' => false,
                            //'linkLabelWrapper'=>'span',
                            'htmlOptions' => array('class' => 'pull-right'),
                            'items' => array(
                                array('label' => 'Login', 'icon' => 'lock', 'url' => array('/user/login'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => 'Messages' . (Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()) ? '<span class="badge badge-warning">' . Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()) . '</span>' : ''), 'icon' => 'envelope', 'url' => Yii::app()->getModule('message')->inboxUrl, 'visible' => !Yii::app()->user->isGuest),
                                '--',
                                array('label' => 'Registration', 'icon' => 'plus', 'url' => array('/user/registration'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => Yii::app()->user->name, 'icon' => 'user', 'url' => '#', 'visible' => !Yii::app()->user->isGuest, 'items' => array(
                                        array('label' => 'Profile', 'url' => array('/user/profile'),),
                                        array('label' => 'Change password', 'url' => array('/user/profile/changepassword')),
                                        array('label' => 'Setting', 'url' => array('/user/profile/edit')),
                                        '---',
                                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                                )),
                            ),
                        ),
                    /*
                      array(
                      'class' => 'bootstrap.widgets.TbBadge',
                      'type'=>'success', // 'success', 'warning', 'important', 'info' or 'inverse'
                      'label'=>'2',
                      ),
                     */
                    ),
                ));
                ?>

                <!-- mainmenu -->
                <div class="container" style="margin-top:80px">

                    <?php if (isset($this->breadcrumbs)): ?>
                        <?php
                        $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                            'links' => $this->breadcrumbs,
                        ));
                        ?><!-- breadcrumbs -->
                    <?php endif ?>


                    <?php echo $content; ?>



                    <hr/>
                    <div id="footer">
                        Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
                        All Rights Reserved.<br/>
                        <?php //echo Yii::powered();      ?>
                    </div>
                    <!-- footer -->
                </div>
            </div>
            <!-- page -->
        <?php endif; ?>
    </body>
</html>