<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'price',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'descriptor',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'original_pic_path',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'process_picture_path',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'org_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'inventory',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'category_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'status',array('class'=>'span5')); ?>

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
