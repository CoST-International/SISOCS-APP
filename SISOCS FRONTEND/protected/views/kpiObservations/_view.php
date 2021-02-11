<?php
/* @var $this KpiObservationsController */
/* @var $data KpiObservations */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kpi_id')); ?>:</b>
	<?php echo CHtml::encode($data->kpi_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tittle')); ?>:</b>
	<?php echo CHtml::encode($data->tittle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency')); ?>:</b>
	<?php echo CHtml::encode($data->currency); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('measure')); ?>:</b>
	<?php echo CHtml::encode($data->measure); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('relatedImplementationMilestone_id')); ?>:</b>
	<?php echo CHtml::encode($data->relatedImplementationMilestone_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('relatedImplementationMilestone_title')); ?>:</b>
	<?php echo CHtml::encode($data->relatedImplementationMilestone_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('startDate')); ?>:</b>
	<?php echo CHtml::encode($data->startDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('endDate')); ?>:</b>
	<?php echo CHtml::encode($data->endDate); ?>
	<br />

	*/ ?>

</div>