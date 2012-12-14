<?php
/* @var $this OrgController */
/* @var $model Org */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'org-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
    ?>
    <p class="note"><span class="required">*</span><?php echo Yii::t('org', 'Fields with * are required.') ?></p>
    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'slogan'); ?>
        <?php echo $form->textField($model, 'slogan', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'slogan'); ?>
    </div>

  
    <div class="row">  
        <?php  echo '<img src="'.Yii::app()->baseUrl.'/assets/uploads/orgs/' . $model->photo_path . '" style="width:100px;"/>'; ?>  
    </div>

    <div class="row">  
        <?php echo $form->labelEx($model, 'photo_path'); ?>  
        <?php echo CHtml::activeFileField($model, 'photo_path'); ?>  
        <?php echo $form->error($model, 'photo_path'); ?>  
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'company_name'); ?>
        <?php echo $form->textField($model, 'company_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'company_name'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('default','Create') : Yii::t('default','Save')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->