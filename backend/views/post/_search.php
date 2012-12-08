<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contents'); ?>
		<?php echo $form->textArea($model,'contents',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comments_count'); ?>
		<?php echo $form->textField($model,'comments_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'like_count'); ?>
		<?php echo $form->textField($model,'like_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'favorite_count'); ?>
		<?php echo $form->textField($model,'favorite_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'public'); ?>
		<?php echo $form->textField($model,'public'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'wb_type'); ?>
		<?php echo $form->textField($model,'wb_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'refer_id'); ?>
		<?php echo $form->textField($model,'refer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'org_id'); ?>
		<?php echo $form->textField($model,'org_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_at'); ?>
		<?php echo $form->textField($model,'create_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_at'); ?>
		<?php echo $form->textField($model,'update_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'file_path'); ?>
		<?php echo $form->textField($model,'file_path',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->