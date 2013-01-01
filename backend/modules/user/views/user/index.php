<?php
$this->breadcrumbs = array(
    UserModule::t("Users"),
);
//if (UserModule::isAdmin()) {
//    $this->layout = '//layouts/column2';
//    $this->menu = array(
//        array('label' => UserModule::t('Manage Users'), 'url' => array('/user/admin')),
//        array('label' => UserModule::t('Manage Profile Field'), 'url' => array('profileField/admin')),
//    );
//}
$this->layout = '//layouts/column2';
//$this->menu = array(
  //  array('label' => UserModule::t('Manage Users'), 'url' => array('/user/console')),
//    array('label' => UserModule::t('Manage Profile Field'), 'url' => array('profileField/admin')),
//);
$this->menu = array(
    array('label' => Yii::t('default', 'member manage'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => UserModule::t( 'Add User'), 'url' => array('create')),
    
    '---',
    array('label' => Yii::t('default', 'team manage'), 'itemOptions' => array('class' => 'nav-header')),
    array('label' => Yii::t('default', 'team tools'), 'url' => array('/news/admin')),
    array('label' => Yii::t('default', 'update team profile'), 'url' => array('/org/update')),
);
?>
<style>
    legend{margin-bottom: 0px;}
</style>
<div class="well">
     <fieldset>
        <legend style="font-size: 16px;font-weight: bold;"><?php echo UserModule::t("List User"); ?></legend>


    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'category-grid',
        'type' => 'striped bordered condensed',
        'dataProvider' => $dataProvider,
        'columns' => array(
            array(
                'name' => 'username',
                'type' => 'raw',
                'value' => 'CHtml::link(CHtml::encode($data->username),array("user/view","id"=>$data->id))',
            ),
            array(
                'name' => 'roles',
                'type' => 'raw',
                'value' => 'User::itemAlias("UserRoles", $data->roles)',
 
            ),
            'create_at',
            'lastvisit_at',
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{update}/{delete}',
            ),
        ),
    ));

    
    ?>

</fieldset>
</div>