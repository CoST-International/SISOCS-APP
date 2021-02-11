<?php
/* @var $this AmendmentController */
/* @var $data Amendment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idContratacion')); ?>:</b>
	<?php echo CHtml::encode($data->idContratacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rationale')); ?>:</b>
	<?php echo CHtml::encode($data->rationale); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amendsReleaseID')); ?>:</b>
	<?php echo CHtml::encode($data->amendsReleaseID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('releaseID')); ?>:</b>
	<?php echo CHtml::encode($data->releaseID); ?>
	<br />


</div>