<?php
$this->breadcrumbs=array(
	t('Sms'),
);

$this->menu=array(
	//array('label'=>t('Manage Smssetup'), 'url'=>array('smssetup/admin')),
	array('label'=>t('Manage Sms'), 'url'=>array('admin')),
);
?>

<h1><?php echo t('Sms');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
