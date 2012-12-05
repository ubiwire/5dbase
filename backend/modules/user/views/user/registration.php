<div class="container" id="page">
    <?php
    $this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Registration");
    $this->breadcrumbs = array(
        UserModule::t("Registration"),
    );
    ?>
    <h2><?php echo UserModule::t("Registration"); ?></h2>
    <?php if (Yii::app()->user->hasFlash('registration')): ?>
        <div class="success">
            <?php echo Yii::app()->user->getFlash('registration'); ?>
        </div>
    <?php else: ?>
        <?php
        /** @var BootActiveForm $form */
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'registration-form',
            'type' => 'horizontal',
                ));
        ?>
        <fieldset>
            <legend><?php echo UserModule::t("Registration"); ?></legend>
            <p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
            <?php echo $form->textFieldRow($model, 'username'); ?>
            <?php echo $form->passwordFieldRow($model, 'password', array('hint' => UserModule::t("Minimal password length 4 symbols."))); ?>
            <?php echo $form->passwordFieldRow($model, 'verifyPassword'); ?>
            <?php echo $form->textFieldRow($model, 'email'); ?>
            <?php echo $form->textFieldRow($model, 'tel'); ?>
            <?php echo $form->textFieldRow($org, 'name'); ?>
            <?php
            $profileFields = $profile->getFields();
            if ($profileFields) {
                foreach ($profileFields as $field) {
                    ?>	
            
                    <?php
                    if ($widgetEdit = $field->widgetEdit($profile)) {
                        echo $widgetEdit;
                    } elseif ($field->range) {
                        echo $form->dropDownListRow($profile, $field->varname, Profile::range($field->range));
                    } elseif ($field->field_type == "TEXT") {
                        echo$form->textAreaRow($profile, $field->varname, array('rows' => 6, 'cols' => 50));
                    } else {
                        echo $form->textFieldRow($profile, $field->varname, array('size' => 60, 'maxlength' => (($field->field_size) ? $field->field_size : 255)));
                    }
                    ?>
            
                    <?php
                }
            }
            ?>
            <?php if (UserModule::doCaptcha('registration')): ?>		
                <?php $this->widget('CCaptcha'); ?>
                <?php echo $form->textFieldRow($model, 'verifyCode', array('hint' => UserModule::t("Please enter the letters as they are shown in the image above.") . '
		<br/>' . UserModule::t("Letters are not case-sensitive."))); ?>
            <?php endif; ?>
        </fieldset>
        <div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => UserModule::t("Register"))); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'reset', 'label' => UserModule::t("Reset"))); ?>
        </div>
        <?php $this->endWidget(); ?>
        <p class="hint">
            <?php echo CHtml::link(UserModule::t("Login"), Yii::app()->getModule('user')->loginUrl); ?> | <?php echo CHtml::link(UserModule::t("Lost Password?"), Yii::app()->getModule('user')->recoveryUrl); ?>
        </p>
    <?php endif; ?>
    <hr/>
    <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
        All Rights Reserved.<br/>
        <?php //echo Yii::powered();   ?>
    </div>
    <!-- footer -->
</div>


