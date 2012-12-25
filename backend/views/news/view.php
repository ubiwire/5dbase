<?php
$this->breadcrumbs = array(
    Yii::t('news', 'News') => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => Yii::t('news', 'News'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('news', 'Create News'), 'url' => array('create')),
    array('label' => Yii::t('news', 'Update News'), 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('news', 'Delete News'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('default', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('news', 'Manage News'), 'url' => array('admin')),
    '---',
    array('label' => Yii::t('default', 'team manage'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('default', 'User List'), 'url' => array('/user')),
);
?>

<div class="well">
<h3><?php echo $model->title; ?></h3>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
          'name' => 'news_type',
            'value' => News::itemAlias('NewsType', $model->news_type),
        ),
        'title',
        'content',
    ),
));
?>
</div>