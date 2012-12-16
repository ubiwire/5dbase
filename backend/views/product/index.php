<?php
$this->breadcrumbs = array(
    Yii::t('product', 'Products'),
);
$this->menu = array(
    array('label' => Yii::t('product', 'Create Product'), 'url' => array('create')),
    array('label' => Yii::t('product', 'Manage Product'), 'url' => array('admin')),
);
?>
<style>
    .list-view {
        padding: 0px;
    }
    .pagination {float: right}
    .navbar .brand{
        font-size: 18px;
    }
</style>
<div class="row-fluid">
    <div class="span12">
        <div class="well">							
            <!-- ** widget header ** -->
            <div class="navbar navbar-heading">
                <div class="navbar-inner">
                    <div class="container" style="width: auto;">
                        <a class="brand" href="#"><?php echo Yii::t("product", 'List Product') ?></a>
                    </div>
                </div>
            </div>
            <?php
            $this->widget('bootstrap.widgets.TbListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '_view',
            ));
            ?>
            <div class="clear"> </div>
        </div>
    </div>

</div>




