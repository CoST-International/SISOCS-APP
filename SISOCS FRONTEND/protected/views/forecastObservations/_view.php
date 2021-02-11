<?php
/* @var $this ForecastObservationsController */
/* @var $data ForecastObservations */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forecast_id')); ?>:</b>
	<?php echo CHtml::encode($data->forecast_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('obs_notes')); ?>:</b>
	<?php echo CHtml::encode($data->obs_notes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('obs_amount')); ?>:</b>
	<?php echo CHtml::encode($data->obs_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('obs_currency')); ?>:</b>
	<?php echo CHtml::encode($data->obs_currency); ?>
	<br />


</div>