<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'contents'); ?>
		<?php echo $form->textArea($model,'contents',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'contents'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comments_count'); ?>
		<?php echo $form->textField($model,'comments_count'); ?>
		<?php echo $form->error($model,'comments_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'like_count'); ?>
		<?php echo $form->textField($model,'like_count'); ?>
		<?php echo $form->error($model,'like_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'favorite_count'); ?>
		<?php echo $form->textField($model,'favorite_count'); ?>
		<?php echo $form->error($model,'favorite_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'public'); ?>
		<?php echo $form->textField($model,'public'); ?>
		<?php echo $form->error($model,'public'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'wb_type'); ?>
		<?php echo $form->textField($model,'wb_type'); ?>
		<?php echo $form->error($model,'wb_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'refer_id'); ?>
		<?php echo $form->textField($model,'refer_id'); ?>
		<?php echo $form->error($model,'refer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'org_id'); ?>
		<?php echo $form->textField($model,'org_id'); ?>
		<?php echo $form->error($model,'org_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_at'); ?>
		<?php echo $form->textField($model,'create_at'); ?>
		<?php echo $form->error($model,'create_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_at'); ?>
		<?php echo $form->textField($model,'update_at'); ?>
		<?php echo $form->error($model,'update_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'file_path'); ?>
		<?php echo $form->textField($model,'file_path',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'file_path'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->