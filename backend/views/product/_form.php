<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'product-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<!--<p class="help-block"><?php echo Yii::t('default', 'Fields with * are required.') ?></p>-->

<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 255)); ?>
<?php echo $form->dropDownListRow($model, 'category_id', $categoryList); ?>
<?php echo $form->textFieldRow($model, 'price', array('class' => 'span5')); ?>
<?php echo $form->textFieldRow($model, 'inventory', array('class' => 'span5')); ?>
<?php echo $form->dropDownListRow($model, 'status', Product::itemAlias('ProductStatus')); ?>
<?php if (!$model->isNewRecord): ?>
    <div>  
        <?php echo '<img src="' . Yii::app()->baseUrl . '/assets/uploads/products/' . $model->original_pic_path . '" style="width:100px;"/>'; ?>  
    </div>
<?php endif ?>
<?php echo $form->fileFieldRow($model, 'original_pic_path'); ?>
<?php echo $form->textAreaRow($model, 'descriptor', array('rows' => 6, 'cols' => 50, 'class' => 'span7')); ?>




<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? Yii::t('default', 'Create') : Yii::t('default', 'Save'),
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
