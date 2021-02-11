<?php
/* @var $this DocAdjuntadosController */
/* @var $data DocAdjuntados */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->codigo), array('view', 'id'=>$data->codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cod_contrato')); ?>:</b>
	<?php echo CHtml::encode($data->cod_contrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_doc')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_doc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ubicacion_doc')); ?>:</b>
	<?php echo CHtml::encode($data->ubicacion_doc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_registro')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_registro')); ?>:</b>
	<?php echo CHtml::encode($data->user_registro); ?>
	<br />


</div>