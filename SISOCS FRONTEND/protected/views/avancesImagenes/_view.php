<?php
/* @var $this AvancesImagenesController */
/* @var $data AvancesImagenes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idImagen')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idImagen), array('view', 'id'=>$data->idImagen)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idAvances')); ?>:</b>
	<?php echo CHtml::encode($data->idAvances); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_imagen')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_imagen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_fisico')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_fisico); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ubicacion_imagen')); ?>:</b>
	<?php echo CHtml::encode($data->ubicacion_imagen); ?>
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