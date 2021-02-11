<?php
/* @var $this GarantiasController */
/* @var $data Garantias */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idGarantia')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idGarantia), array('view', 'id'=>$data->idGarantia)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idInicioEjecucion')); ?>:</b>
	<?php echo CHtml::encode($data->idInicioEjecucion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTipoGarantia')); ?>:</b>
	<?php echo CHtml::encode($data->idTipoGarantia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_vencimiento')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_vencimiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monto')); ?>:</b>
	<?php echo CHtml::encode($data->monto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuario_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->usuario_creacion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuario_publicacion')); ?>:</b>
	<?php echo CHtml::encode($data->usuario_publicacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_publicacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_publicacion); ?>
	<br />

	*/ ?>

</div>