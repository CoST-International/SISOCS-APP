<?php
/* @var $this PrequalificationController */
/* @var $data Prequalification */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idProyecto')); ?>:</b>
	<?php echo CHtml::encode($data->idProyecto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('startDate')); ?>:</b>
	<?php echo CHtml::encode($data->startDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('endDate')); ?>:</b>
	<?php echo CHtml::encode($data->endDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('durationInDays')); ?>:</b>
	<?php echo CHtml::encode($data->durationInDays); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enquiryPeriod_startDate')); ?>:</b>
	<?php echo CHtml::encode($data->enquiryPeriod_startDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enquiryPeriod_endDate')); ?>:</b>
	<?php echo CHtml::encode($data->enquiryPeriod_endDate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('qualificationPeriod_startDate')); ?>:</b>
	<?php echo CHtml::encode($data->qualificationPeriod_startDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qualificationPeriod_endDate')); ?>:</b>
	<?php echo CHtml::encode($data->qualificationPeriod_endDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('eligibilityCriteria')); ?>:</b>
	<?php echo CHtml::encode($data->eligibilityCriteria); ?>
	<br />

	*/ ?>

</div>