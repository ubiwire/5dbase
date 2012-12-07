<?php $this->pageTitle = Yii::app()->name; ?>
<h1><?php echo Yii::t("post", "last post list"); ?></h1>
<?php
$dataProvider = new CActiveDataProvider('Post', array(
            'criteria' => array(
                'condition' => 'org_id=' . Yii::app()->user->org_id,
                'order' => 'create_at DESC',
            ),
            'pagination' => array(
                'pageSize' => 1,
            ),
        ));

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_post_list', // refers to the partial view named '_post'
    'sortableAttributes' => array(
        'like_count' => Yii::t('post', 'post like'),
        'favorite_count' => Yii::t('post', 'post favorite'),
        'comments_count' => Yii::t('post', 'post comments'),
        'create_at' => Yii::t('post', 'Post time'),
    ),
));



?>



