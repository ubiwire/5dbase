<div style="width: 320px;padding: 114px 0 0;margin: auto; ">
    <h2><?php echo UserModule::t("jjh backend login"); ?></h2>
    <div style="font-weight: normal;border: 1px solid #E5E5E5;">


        <?php
        $this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Login");
        $this->breadcrumbs = array(
            UserModule::t("Login"),
        );
        ?>
        <div class="login">

            <?php if (Yii::app()->user->hasFlash('loginMessage')): ?>
                <div class="success">
                    <?php echo Yii::app()->user->getFlash('loginMessage'); ?>
                </div>
            <?php endif; ?>
    <!--    <p><?php //echo UserModule::t("Please fill out the following form with your login credentials:");   ?></p>-->
            <?php
            /*
              $form = new CForm(array(
              'elements'=>array(
              'username'=>array(
              'type'=>'text',
              'maxlength'=>32,
              ),
              'password'=>array(
              'type'=>'password',
              'maxlength'=>32,
              ),
              'rememberMe'=>array(
              'type'=>'checkbox',
              )
              ),

              'buttons'=>array(
              'login'=>array(
              'type'=>'submit',
              'label'=>'Login',
              ),
              ),
              ), $model);

             */
            ?>
            <?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'verticalForm',
                'htmlOptions' => array('class' => 'well'),
                    ));
            ?>
            <?php echo $form->textFieldRow($model, 'username', array('class' => 'span3', 'prepend' => '<i class="icon-user"></i>')); ?>
            <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span3', 'prepend' => '<i class="icon-lock"></i>')); ?>
            <?php echo $form->checkboxRow($model, 'rememberMe'); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => UserModule::t("Login"), 'type' => 'primary')); ?>
            <?php $this->endWidget(); ?>
            <div>
                <div class="hint right">
                    <?php echo CHtml::link(UserModule::t("Register"), Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo CHtml::link(UserModule::t("Lost Password?"), Yii::app()->getModule('user')->recoveryUrl); ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>