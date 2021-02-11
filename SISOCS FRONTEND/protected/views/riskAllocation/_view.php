<?php
/* @var $this RiskAllocationController */
/* @var $data RiskAllocation */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idContratacion')); ?>:</b>
	<?php echo CHtml::encode($data->idContratacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('allocation_party_id')); ?>:</b>
	<?php echo CHtml::encode($data->allocation_party_id); ?>
	<br />


</div>