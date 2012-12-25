<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'news-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><?php echo Yii::t('default',  'Fields with * are required.') ?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownList($model,'news_type', News::itemAlias('NewsType'), array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textAreaRow($model,'content',array('rows'=>6, 'cols'=>50, 'class'=>'span7')); ?>


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('default', 'Create') : Yii::t('default', 'Save'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
