<?php
/* @var $this OrgController */
/* @var $model Org */
/* @var $form CActiveForm */
?>


 <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'org-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
    ?>




<!--<p class="help-block"><?php echo Yii::t('default', 'Fields with * are required.') ?></p>-->

<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 255)); ?>
<?php echo $form->textFieldRow($model, 'slogan', array('class' => 'span5')); ?>
<?php if (!$model->isNewRecord): ?>
    <div>  
        <?php echo '<img src="' . Yii::app()->baseUrl . '/assets/uploads/orgs/' . $model->photo_path . '" style="width:100px;"/>'; ?>  
    </div>
<?php endif ?>
<?php echo $form->fileFieldRow($model, 'photo_path'); ?>
<?php echo $form->textFieldRow($model, 'company_name', array('class' => 'span5')); ?>





<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? Yii::t('default', 'Create') : Yii::t('default', 'Save'),
    ));
    ?>
</div>

<?php $this->endWidget(); ?>




