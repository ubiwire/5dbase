<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="language" content="en"/>

	<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon"/>
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css"
	      media="screen, projection"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css"
	      media="print"/>
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css"
	      media="screen, projection"/>
	<![endif]-->

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
	<?php $this->widget('bootstrap.widgets.TbNavbar', array(
	'type' => 'inverse', // null or 'inverse'
	'brand' => 'Project name',
	'brandUrl' => '#',
	'collapse' => true, // requires bootstrap-responsive.css
	'items' => array(
		array(
			'class' => 'bootstrap.widgets.TbMenu',
			'items' => array(
				array('label' => '首页', 'url' => array('/site/index')),
				array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
				array('label' => 'Contact', 'url' => array('/site/contact')),			
				
			),
		),

		'<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
		//(!Yii::app()->user->isGuest) ? '<p class="navbar-text pull-right"><a href="#">Help</a></p>' : '',
		array(
			'class' => 'bootstrap.widgets.TbMenu',
			'htmlOptions' => array('class' => 'pull-right'),
			'items' => array(
				array('label' => 'Login', 'icon'=>'lock', 'url' => array('/user/login'), 'visible' => Yii::app()->user->isGuest),
				array('label' => 'Messages', 'icon'=>'envelope', 'url' => array('/user/login'), 'visible' => !Yii::app()->user->isGuest),
				'--',  
				array('label' => 'Registration', 'icon'=>'plus','url' => array('/user/registration'), 'visible' => Yii::app()->user->isGuest),
				array('label' => Yii::app()->user->name, 'icon'=>'user','url' => '#','visible' => !Yii::app()->user->isGuest,'items' => array(
					array('label' => 'Profile', 'url' => array('/user/profile'),),
					array('label' => 'Change password', 'url' => array('/user/profile/changepassword')),
					array('label' => 'Setting', 'url' => array('/user/profile/edit')),
					'---',
					array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
				)),
			),
		),
	),
)); ?>
	<!-- mainmenu -->
	<div class="container" style="margin-top:80px">
		<?php if (isset($this->breadcrumbs)): ?>
			<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links' => $this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
		<?php endif?>

		<?php echo $content; ?>
		<hr/>
		<div id="footer">
			Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
			All Rights Reserved.<br/>
			<?php //echo Yii::powered(); ?>
		</div>
		<!-- footer -->
	</div>
</div>
<!-- page -->
</body>
</html>