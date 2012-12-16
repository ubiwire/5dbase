<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'reward-point-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><?php echo Yii::t('default', 'Fields with * are required.')?></p>

	<?php echo $form->errorSummary($model); ?>

        <?php echo $form->datepickerRow($model, 'date',
        array('prepend'=>'<i class="icon-calendar"></i>')); ?>

	<?php echo $form->textFieldRow($model,'total',array('class'=>'span4')); ?>
<?php echo $form->dropDownListRow($model, 'status', RewardPoint::itemAlias('RewardPointStatus')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
