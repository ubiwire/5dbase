<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Profile");
$this->breadcrumbs = array(
    UserModule::t("Profile"),
);
$this->menu = array(
    array('label' => 'Person', 'itemOptions' => array('class' => 'nav-header')),
    array('label' => UserModule::t('Edit'), 'url' => array('edit')),
    array('label' => UserModule::t('Change password'), 'url' => array('changepassword')),
    ((UserModule::isAdmin()) ? array('label' => 'Manager', 'itemOptions' => array('class' => 'nav-header')) : array()),
    ((UserModule::isAdmin()) ? array('label' => UserModule::t('Manage Users'), 'url' => array('/user/admin')) : array()),
    ((UserModule::isAdmin()) ? array('label' => UserModule::t('List User'), 'url' => array('/user')) : array()),
);
?>

<div class="well" style="position:relative">
    <fieldset>
        <legend style="font-size: 16px;font-weight: bold;"><?php echo UserModule::t('Your profile'); ?></legend>


        <?php if (Yii::app()->user->hasFlash('profileMessage')): ?>
            <div class="success">
                <?php echo Yii::app()->user->getFlash('profileMessage'); ?>
            </div>
        <?php endif; ?>

        <div class="pull-right" style="text-align:center;position:absolute;left:588px;top:78px;">
            <?php
            $str = Yii::app()->baseUrl . '/assets/uploads/profiles/' . ($profile->photo_path ? $profile->photo_path : 'nopic.png');
            echo CHtml::image($str, '', array('style' => "width:140px;"));
            ?>
        </div>
        <table class="detail-view table table-striped table-condensed">
            <tr>
                <th ><?php echo CHtml::encode($model->getAttributeLabel('username')); ?></th>
                <td><?php echo CHtml::encode($model->username); ?></td>
            </tr>
            <?php
            $profileFields = ProfileField::model()->forOwner()->sort()->findAll();
            if ($profileFields) {
                foreach ($profileFields as $field) {
                    
                    if ($field->varname == 'photo_path'){
//                        echo $field->varname;
//                        Yii::app()->end();
                        continue;
                    }
                    //echo "<pre>"; print_r($profile); die();
                    ?>
                    <tr>
                        <th ><?php echo CHtml::encode(UserModule::t($field->title)); ?></th>
                        <td><?php echo (($field->widgetView($profile)) ? $field->widgetView($profile) : CHtml::encode((($field->range) ? Profile::range($field->range, $profile->getAttribute($field->varname)) : $profile->getAttribute($field->varname)))); ?></td>
                    </tr>
                    <?php
                }//$profile->getAttribute($field->varname)
            }
            ?>
            <tr>
                <th ><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
                <td><?php echo CHtml::encode($model->email); ?></td>
            </tr>
            <tr>
                <th ><?php echo CHtml::encode($model->getAttributeLabel('create_at')); ?></th>
                <td><?php echo $model->create_at; ?></td>
            </tr>
            <tr>
                <th ><?php echo CHtml::encode($model->getAttributeLabel('lastvisit_at')); ?></th>
                <td><?php echo $model->lastvisit_at; ?></td>
            </tr>
            <tr>
                <th ><?php echo CHtml::encode($model->getAttributeLabel('status')); ?></th>
                <td><?php echo CHtml::encode(User::itemAlias("UserStatus", $model->status)); ?></td>
            </tr>
        </table>

        <?php
        /*
          $this->widget('bootstrap.widgets.TbDetailView',array(
          'data'=>$model,
          'attributes'=>array(
          'username',
          'email',
          'create_at',
          'lastvisit_at',
          'status',

          ),
          ));

         */
        ?>
    </fieldset>
</div>