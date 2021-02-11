<?php
/* @var $this DesembolsosMontosController */
/* @var $data DesembolsosMontos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idDesembolso')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idDesembolso), array('view', 'id'=>$data->idDesembolso)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idInicioEjecucion')); ?>:</b>
	<?php echo CHtml::encode($data->idInicioEjecucion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desembolso')); ?>:</b>
	<?php echo CHtml::encode($data->desembolso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monto')); ?>:</b>
	<?php echo CHtml::encode($data->monto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_desembolso')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_desembolso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('usuario_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->usuario_creacion); ?>
	<br />

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