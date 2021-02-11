<?php
/* @var $this EstadosgestcontraController */
/* @var $data Estadosgestcontra */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idEstadoGesion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idEstadoGesion), array('view', 'id'=>$data->idEstadoGesion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />


</div>