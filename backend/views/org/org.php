<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('org', 'team');
$this->breadcrumbs = array(
    Yii::t('org', 'your team'),
);
$this->menu = array(
    array('label' => Yii::t('default', 'team manage'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('org', 'edit team'), 'url' => array('update')),
    array('label' => Yii::t('default', 'member manage'), 'url' => array('/user')),
);
?>
<div class="well">
    <h3><?php echo Yii::t('org', 'your team'); ?></h3>

    <?php if (Yii::app()->user->hasFlash('orgMessage')): ?>
        <div class="success">
            <?php echo Yii::app()->user->getFlash('orgMessage'); ?>
        </div>
    <?php endif; ?>


    <table class="detail-view table table-striped table-condensed">
        <tr>
            <th ><?php echo CHtml::encode($model->getAttributeLabel('name')); ?></th>
            <td><?php echo CHtml::encode($model->name); ?></td>
        </tr>
        <tr>
            <th ><?php echo CHtml::encode($model->getAttributeLabel('slogan')); ?></th>
            <td><?php echo CHtml::encode($model->slogan); ?></td>
        </tr>
        <tr>
            <th ><?php echo CHtml::encode($model->getAttributeLabel('photo_path')); ?></th>
            <td>
                <?php echo '<img src="' . Yii::app()->baseUrl . '/assets/uploads/orgs/' . $model->photo_path . '" style="width:100px;"/>'; ?>  
            </td>
        </tr>
        <tr>
            <th ><?php echo CHtml::encode($model->getAttributeLabel('company_name')); ?></th>
            <td><?php echo $model->company_name; ?></td>
        </tr>

    </table>
</div>