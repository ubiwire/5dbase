<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Profile");
$this->breadcrumbs = array(
    UserModule::t("Profile") => array('profile'),
    UserModule::t("Edit"),
);
$this->menu = array(
    array('label' => 'Person', 'itemOptions' => array('class' => 'nav-header')),
    array('label' => UserModule::t('Profile'), 'url' => array('/user/profile')),
    array('label' => UserModule::t('Change password'), 'url' => array('changepassword')),
    ((UserModule::isAdmin()) ? array('label' => 'Manager', 'itemOptions' => array('class' => 'nav-header')) : array()),
    ((UserModule::isAdmin()) ? array('label' => UserModule::t('Manage Users'), 'url' => array('/user/admin')) : array()),
    ((UserModule::isAdmin()) ? array('label' => UserModule::t('List User'), 'url' => array('/user')) : array()),
);
?>


<div class="well">
    <fieldset>
        <legend style="font-size: 16px;font-weight: bold;"><?php echo UserModule::t('Edit profile'); ?></legend>

        <?php if (Yii::app()->user->hasFlash('profileMessage')): ?>
            <div class="success">
                <?php echo Yii::app()->user->getFlash('profileMessage'); ?>
            </div>
        <?php endif; ?>

        <?php /*
          $form=$this->beginWidget('CActiveForm', array(
          'id'=>'profile-form',
          'enableAjaxValidation'=>true,
          'htmlOptions' => array('enctype'=>'multipart/form-data'),
          ));
         */ ?>
        <?php
        /** @var BootActiveForm $form */
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'profile-form',
            'type' => 'horizontal',
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
                ));
        ?>
        <p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
        <?php //echo $form->errorSummary(array($model,$profile)); ?>
        <?php echo $form->textFieldRow($model, 'username', array('class' => 'span3', 'size' => 20, 'maxlength' => 20)); ?>
        <?php echo $form->textFieldRow($model, 'email', array('class' => 'span3', 'size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->textFieldRow($model, 'tel', array('class' => 'span3', 'size' => 60, 'maxlength' => 128)); ?>


        <?php
        $profileFields = $profile->getFields();
//        var_dump($profileFields);
//        Yii::app()->end();
        $reward = array('reward_point', 'surplus_total', 'usage');
        if ($profileFields) {
            foreach ($profileFields as $field) {
                ?>

                <?php
                // echo $form->labelEx($profile,$field->varname);

                if (0) {//$widgetEdit = $field->widgetEdit($profile)
                    // echo $widgetEdit;  // todo:完整修改临时支持日期的做法。以后完整修改profile 支持动态字段。wedget 改成bootstrap 字段
                } elseif ($field->range) {
                    echo $form->dropDownListRow($profile, $field->varname, Profile::range($field->range));
                } elseif ($field->field_type == "TEXT") {
                    echo $form->textAreaRow($profile, $field->varname, array('rows' => 6, 'cols' => 50));
                } elseif ($field->field_type == "DATE") {
                    echo $form->datepickerRow($profile, $field->varname, array(
                        'options' => array(
                            'format' => 'yyyy-mm-dd'),
                        //'hint' => 'birthday.',
                        'prepend' => '<i class="icon-calendar"></i>'));
                } elseif ($field->varname == 'photo_path') {
                    echo $form->fileFieldRow($profile, 'photo_path', array('class' => 'span3'));
                } elseif (in_array($field->varname, $reward)) {
                    //不可编辑项
                    echo $form->uneditableRow($profile, $field->varname, array('class' => 'span3'));
                } else {

                    echo $form->textFieldRow($profile, $field->varname, array('class' => 'span3', 'size' => 60, 'maxlength' => (($field->field_size) ? $field->field_size : 255)));
                }
                ?>

                <?php
            }
        }
        ?>
        <div class="form-actions">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => $model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')));
            ?>
        </div>
        <?php
        $this->endWidget();



        /*

          $this->widget('bootstrap.widgets.TbMenu', array(
          'type'=>'list',
          'items' => array(
          array('label'=>'List header', 'itemOptions'=>array('class'=>'nav-header')),
          array('label'=>'Home', 'url'=>'#', 'itemOptions'=>array('class'=>'active')),
          array('label'=>'Library', 'url'=>'#'),
          array('label'=>'Applications', 'url'=>'#'),
          array('label'=>'Another list header', 'itemOptions'=>array('class'=>'nav-header')),
          array('label'=>'Profile', 'url'=>'#'),
          array('label'=>'Settings', 'url'=>'#'),
          '',
          array('label'=>'Help', 'url'=>'#'),
          )
          ));
         */



//echo '<pre>' . dump($profile->rules()) . '</pre>'; 
        ?>

    </fieldset>
</div>