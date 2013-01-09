<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sms-setup-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo t("Fields with <span class=\"required\">*</span> are required.");?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'providertype'); ?>
		<?php echo $form->textField($model,'providertype',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'providertype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parameters'); ?>
		<?php echo $form->textField($model,'parameters',array('size'=>32)); ?>
		<?php echo $form->error($model,'parameters'); ?>
        <span class="hint"><?php echo UserModule::t('JSON string (example: {example}).',array('{example}'=>CJavaScript::jsonEncode(array('CoreId'=>'1007')))); ?></span>
	</div>
    <?php if($model->isNewRecord){ ?>
	<div class="row">
		<?php echo $form->labelEx($model,'isactive'); ?>
        <?php echo $form->dropDownList($model, 'isactive', SmsSetup::itemAlias('isActive')); ?>
		<?php //echo $form->textField($model,'isactive'); ?>
		<?php echo $form->error($model,'isactive'); ?>
	</div>
    <?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? t('Create') : t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->