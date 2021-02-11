<?php
/* @var $this TipoModContratoController */
/* @var $data TipoModContrato */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTipoModificacion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idTipoModificacion), array('view', 'id'=>$data->idTipoModificacion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_modificacion); ?>
	<br />


</div>