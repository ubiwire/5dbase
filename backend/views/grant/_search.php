<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

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
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
