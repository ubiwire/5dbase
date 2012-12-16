<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('org_id')); ?>:</b>
	<?php echo CHtml::encode($data->org_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('granter_id')); ?>:</b>
	<?php echo CHtml::encode($data->granter_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('integral_id')); ?>:</b>
	<?php echo CHtml::encode($data->integral_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recipient_id')); ?>:</b>
	<?php echo CHtml::encode($data->recipient_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('integral_val')); ?>:</b>
	<?php echo CHtml::encode($data->integral_val); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('granter_type')); ?>:</b>
	<?php echo CHtml::encode($data->granter_type); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('usage')); ?>:</b>
	<?php echo CHtml::encode($data->usage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_at')); ?>:</b>
	<?php echo CHtml::encode($data->create_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_at')); ?>:</b>
	<?php echo CHtml::encode($data->update_at); ?>
	<br />

	*/ ?>

</div>