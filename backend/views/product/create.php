<?php
$this->breadcrumbs = array(
    Yii::t('product', 'Products') => array('index'),
    Yii::t('default', 'Create'),
);


$this->menu = array(
    array('label' => Yii::t('product', 'Product Menu'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('product', 'List Product'), 'url' => array('index')),   
    array('label' => Yii::t('product', 'Manage Product'), 'url' => array('admin')),
    '---',
    array('label' => Yii::t('category', 'Category'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('category', 'Manage Category'), 'url' => array('/cate')),
);


?>
<div class="well">
    <fieldset>
        <legend style="font-size: 16px;font-weight: bold;"><?php echo Yii::t('product', 'Create Product'); ?></legend>
        <?php echo $this->renderPartial('_form', array('model' => $model, 'categoryList' => $categoryList)); ?>
    </fieldset>
</div>