<?php
/* @var $this ImgAdjuntadasController */
/* @var $data ImgAdjuntadas */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->codigo), array('view', 'id'=>$data->codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cod_contrato')); ?>:</b>
	<?php echo CHtml::encode($data->cod_contrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_img')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_img); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ubicacion_img')); ?>:</b>
	<?php echo CHtml::encode($data->ubicacion_img); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_registro')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_registro')); ?>:</b>
	<?php echo CHtml::encode($data->user_registro); ?>
	<br />


</div>