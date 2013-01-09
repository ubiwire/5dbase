<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sms-form',
	'enableAjaxValidation'=>false,
)); 

Yii::app()->clientScript->registerScript('checked', "
$('#timing').click(function(){
    $('#timing').attr('checked')?$('#timeDiv').show():$('#timeDiv').hide();
});	
");
?>

	<p class="note"><?php echo t("Fields with <span class=\"required\">*</span> are required.");?></p>

	<?php echo $form->errorSummary($model); ?>

	<!--<div class="row">
		<?php echo $form->labelEx($model,'from_uid'); ?>
		<?php echo $form->textField($model,'from_uid'); ?>
		<?php echo $form->error($model,'from_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'to_uid'); ?>
		<?php echo $form->textField($model,'to_uid'); ?>
		<?php echo $form->error($model,'to_uid'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>24,'value'=>$model->mobile));//,'maxlength'=>11 ?>
		<?php echo $form->error($model,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>
    <div class="row">
        <?php echo CHtml::checkBox('timing',false);echo t('Timing Send'); ?>
    </div>
	<div class="row" style="display: none;" id="timeDiv">
		<?php echo $form->labelEx($model,'sendtime'); ?>
		<?php $this->widget( 'ext.EJuiTimePicker.EJuiTimePicker', array(
              'model' => $model, // Your model
              'attribute' => 'sendtime', // Attribute for input
                                         'language' => 'zh_CN',
                                            'options' => array(
                                                    'dateFormat'=>'yy-mm-dd',
                                                    //'changeMonth' => 'true',
                                                    'changeYear' => 'true',
                                            ),
            )); ?>
		<?php echo $form->error($model,'sendtime'); ?>
	</div>

	<!--<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textArea($model,'status',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remark'); ?>
		<?php echo $form->textArea($model,'remark',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'remark'); ?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? t('Send') : t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->