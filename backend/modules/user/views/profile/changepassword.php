<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change Password");
$this->breadcrumbs=array(
	UserModule::t("Profile") => array('/user/profile'),
	UserModule::t("Change Password"),
);
$this->menu=array(

	    array('label'=>'Person', 'itemOptions'=>array('class'=>'nav-header')),
    array('label'=>UserModule::t('Profile'), 'url'=>array('/user/profile')),
    array('label'=>UserModule::t('Edit'), 'url'=>array('edit')),
	((UserModule::isAdmin())
		?array('label'=>'Manager', 'itemOptions'=>array('class'=>'nav-header'))
		:array()),
	((UserModule::isAdmin())
		?array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
		:array()),
			((UserModule::isAdmin())
		?array('label'=>UserModule::t('List User'), 'url'=>array('/user'))
		:array()),
    
);
?>

<h1><?php echo UserModule::t("Change password"); ?></h1>




<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'changepassword-form',
	  'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well'),
)); ?>
 
<?php echo $form->passwordFieldRow($model, 'oldPassword'); ?>
<?php echo $form->passwordFieldRow($model, 'password', array('hint'=>UserModule::t("Minimal password length 4 symbols."))); ?>
<?php echo $form->passwordFieldRow($model, 'verifyPassword'); ?>
  
<br>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>UserModule::t("Save"))); ?>
 
<?php $this->endWidget(); ?>

