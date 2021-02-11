<?php
/* @var $this PreferredBiddersController */
/* @var $data PreferredBidders */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idContratacion')); ?>:</b>
	<?php echo CHtml::encode($data->idContratacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parties_id')); ?>:</b>
	<?php echo CHtml::encode($data->parties_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parties_name')); ?>:</b>
	<?php echo CHtml::encode($data->parties_name); ?>
	<br />


</div>