<?php
$this->breadcrumbs = array(
    Yii::t('product', 'Products') => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => Yii::t('product', 'List Product'), 'url' => array('index')),
    array('label' => Yii::t('product', 'Create Product'), 'url' => array('create')),
    array('label' => Yii::t('product', 'Update Product'), 'url' => array('update', 'id' => $model->id)),
   // array('label' => Yii::t('product', 'Delete Product'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => Yii::t('product', 'Manage Product'), 'url' => array('admin')),
);
?>
<style>
    .price {font-size: 14px; line-height: 28px;font-weight: bold;display: block;
    }
    .pro_number {
        font-size: 24px;color: #FF2900;font-family: verdana, arial;padding-right: 20px;
    }
    .li_info li {
        float: left;
        height: 26px;
        width: 49%;
        line-height: 26px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
</style>
<div class="well">
    <div class="title" style="border-bottom: 1px solid #D5D5D5;font-size: 18px;font-weight: normal;">
        <dl>
            <dt> <?php echo Yii::t('product', 'Product detail') ?></dt>
        </dl>
    </div>
    <div>
        <div style="width: 160px;height: 200px;float: left;padding: 15px;text-align: center;">
            <?php echo CHtml::image(Yii::app()->baseUrl . '/assets/uploads/products/' . $model->original_pic_path, '', array('style' => "width:140px;")) ?>
        </div>
        <div style="width: 428px;height: 280px;float: left;padding: 20px;border-left: 1px solid #D5D5D5;">
            <div>
                <div>
                    <p class="price">    
                        <?php echo Yii::t('product', 'Price') ?>：
                        <span class="pro_number"><?php echo $model->price ?></span>
                        <?php echo Yii::t('product', 'Inventory') ?>：
                        <span class="pro_number"><?php echo $model->inventory ?></span>
                    </p>
                </div>
                <div>
                    <div class="li_info">
                        <ul>
                            <li>
                                <?php echo Yii::t('product', 'Name') ?>：
                                <span>
                                    <?php echo $model->name ?>
                                </span>
                            </li>
                            <li>
                                <?php echo Yii::t('product', 'Category') ?>：
                                <span title="2012">
                                    <?php echo $model->category->name ?>
                                </span>
                            </li>
                            <li>
                                <?php echo Yii::t('product', 'Status') ?>：
                                <span>
                                    <?php echo Product::itemAlias('ProductStatus', $model->status) ?>
                                </span>
                            </li>
                            <li></li>
                            <li> <?php echo Yii::t('product', 'Descriptor') ?>：</li>
                        </ul>
                    </div>
                    <div class="clear"> </div>
                </div>
                <div style="margin-left:24px;"><?php echo $model->descriptor ?></div>
            </div>
        </div>
    </div>
    <div class="clear"> </div>
</div>
<?php
//$this->widget('bootstrap.widgets.TbDetailView', array(
//    'data' => $model,
//    'attributes' => array(
//        'id',
//        'name',
//        'price',
//        'descriptor',
//        'original_pic_path',
//        'process_picture_path',
//        'org_id',
//        'inventory',
//        'category_id',
//        'status',
//        'create_at',
//        'update_at',
//    ),
//));
?>
