<?php
/* @var $this TipoGarantiasController */
/* @var $data TipoGarantias */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTipoGarantia')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idTipoGarantia), array('view', 'id'=>$data->idTipoGarantia)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />


</div>