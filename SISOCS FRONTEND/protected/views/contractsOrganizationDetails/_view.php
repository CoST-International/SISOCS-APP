<?php
/* @var $this ContractsOrganizationDetailsController */
/* @var $data ContractsOrganizationDetails */
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


</div>