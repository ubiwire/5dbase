<?php
$this->pageTitle = Yii::app()->name;

$this->breadcrumbs = array(
    Yii::t('default', 'Posts'),
);
$this->menu = array(
    array('label' => Yii::t('default', 'Menu'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('default', 'product manage'), 'url' => array('/product')),
    array('label' => Yii::t('default', 'reward point'), 'url' => array('/reward')),
    array('label' => Yii::t('default', 'team manage'), 'url' => array('/user')),
    array('label' => Yii::t('default', 'course manage'), 'url' => array('#')),
);
?>
<style>
    h1 {font-size: 16px;}
    .brand {font-size: 16px;}
    .list-view {padding-top: 0px;}
    .navbar .brand {font-size:16px;}
</style>

<?php
$dataProvider = new CActiveDataProvider('Post', array(
            'criteria' => array(
                'condition' => 'org_id=' . Yii::app()->user->org_id,
                'order' => 'id DESC',
            ),
            'pagination' => array(
                'pageSize' => 15,
            ),
        ));
?>
<?php
//$this->widget('zii.widgets.CListView', array(
//    'dataProvider' => $dataProvider,
//    'itemView' => '_post_list', // refers to the partial view named '_post'
//    'sortableAttributes' => array(
//        'like_count' => Yii::t('post', 'post like'),
//        'favorite_count' => Yii::t('post', 'post favorite'),
//        'comments_count' => Yii::t('post', 'post comments'),
//        'create_at' => Yii::t('post', 'Post time'),
//    ),
//));
?>
<div class="row-fluid">
    <div class="span12">
        <div class="well">							
            <!-- ** widget header ** -->
            <div class="navbar navbar-heading">
                <div class="navbar-inner">
                    <div class="container" style="width: auto;">
                        <a class="brand" href="#"><?php echo Yii::t("post", "last post list"); ?></a>
                    </div>
                </div>
            </div>
            <?php
            $this->widget('bootstrap.widgets.TbListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '_post_list',
            ));
            ?>
            <div class="clear"> </div>
        </div>
    </div>

</div>
