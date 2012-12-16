<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'reward-grant-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'org_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'granter_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'integral_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'recipient_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'integral_val',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'granter_type',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'usage',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'create_at',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'update_at',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
