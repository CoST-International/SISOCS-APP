<?php
/* @var $this EntesUnidadController */
/* @var $data EntesUnidad */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idUnidad')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idUnidad), array('view', 'idUnidad'=>$data->idUnidad,'idEnte'=>$data->idEnte)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idEnte')); ?>:</b>
	<?php echo CHtml::encode($data->idEnte); ?>
	<br />


</div>