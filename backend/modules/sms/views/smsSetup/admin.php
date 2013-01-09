<?php
$this->breadcrumbs=array(
	t('Sms Setups')=>array('index'),
	t('Manage'),
);
Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#sms-setup-grid a.ajaxupdate').live('click', function() {
        $.fn.yiiGridView.update('sms-setup-grid', {
                type: 'POST',
                url: $(this).attr('href'),
                success: function() {
                        $.fn.yiiGridView.update('sms-setup-grid');
                }
        });
        return false;
});
");
?>
<?php if(Yii::app()->user->isAdmin()) {?>
<div class='right'>
    <?php   
  //$this->layout ='//layouts/column2';
$this->widget('ext.widgets.amenu.XActionMenu', array(
    'htmlOptions'=>array('class'=>'actionBar'),
    'items'=>array(
       array('label'=>t('Create SmsSetup'), 'url'=>array('create'),'linkOptions'=>array("style"=>"color: black;padding-left:18px;",'class'=>'icon-add')),       
    ),
));
?>
</div>
<?php }?>
<?php $dataProviderSmsSetup = new CActiveDataProvider('SmsSetup', array('data' =>$model)); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sms-setup-grid',
    'template'=>"{items}\n{pager}",
    'htmlOptions'=>array('class'=>'grid-view clear'),
	'dataProvider'=>$dataProviderSmsSetup,
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		'username',
		//'password',
		'providertype',
		//'parameters',
        array(
                'class'=>'CDataColumn',
                'header'=>t('Isactive'),                                           
                'type'=>'raw',          
                'value'=>'SmsSetup::getIsactiveImg("$data->id")',
            ), 
        array(
			'name'=>t('Balance'),
			'filter' => false,
			'value'=>'0.00',//SmsSetup::getBalance($data->id)
		),
		array(
			'class'=>'CButtonColumn',
            'buttons'=>array('delete'=>array('visible'=>'$data->isactive'),'view'=>array('visible'=>'false'))
		),
	),
)); ?>
