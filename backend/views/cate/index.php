<?php
$this->breadcrumbs = array(
    Yii::t('category', 'Category'),
);

$this->menu = array(
    array('label' => Yii::t('category', 'Category'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('category', 'Create Category'), 'url' => array('create')),
    array('label' => Yii::t('category', 'Manage Category'), 'url' => array('admin')),
    '---',
     array('label' => Yii::t('product', 'Product Menu'), 'itemOptions' => array('class' => 'nav-header')),
     array('label' => Yii::t('product', 'Manage Product'), 'url' => array('/product')),
);
?>

<h1>Categories</h1>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
