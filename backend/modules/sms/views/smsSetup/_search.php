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
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'providertype'); ?>
		<?php echo $form->textField($model,'providertype',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parameters'); ?>
		<?php echo $form->textArea($model,'parameters',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isactive'); ?>
		<?php echo $form->textField($model,'isactive'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(t('Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->