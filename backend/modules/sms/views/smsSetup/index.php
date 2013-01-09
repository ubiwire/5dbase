<?php
$this->breadcrumbs=array(
	t('Sms Setups'),
);

$this->menu=array(
	array('label'=>t('Create SmsSetup'), 'url'=>array('create')),
	array('label'=>t('Manage SmsSetup'), 'url'=>array('admin')),
);
?>

<h1><?php echo t('Sms Setups');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
