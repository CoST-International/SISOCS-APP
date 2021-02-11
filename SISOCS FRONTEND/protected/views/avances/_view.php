<?php
/* @var $this AvancesController */
/* @var $data Avances */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idAvances')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idAvances), array('view', 'id'=>$data->idAvances)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idInicioEjecucion')); ?>:</b>
	<?php echo CHtml::encode($data->idInicioEjecucion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('porcent_programado')); ?>:</b>
	<?php echo CHtml::encode($data->porcent_programado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('porcent_real')); ?>:</b>
	<?php echo CHtml::encode($data->porcent_real); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('finan_programado')); ?>:</b>
	<?php echo CHtml::encode($data->finan_programado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('finan_real')); ?>:</b>
	<?php echo CHtml::encode($data->finan_real); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_problemas')); ?>:</b>
	<?php echo CHtml::encode($data->desc_problemas); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_temas')); ?>:</b>
	<?php echo CHtml::encode($data->desc_temas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_avance')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_avance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adj_garantias')); ?>:</b>
	<?php echo CHtml::encode($data->adj_garantias); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adj_avances')); ?>:</b>
	<?php echo CHtml::encode($data->adj_avances); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adj_supervicion')); ?>:</b>
	<?php echo CHtml::encode($data->adj_supervicion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adj_evaluacion')); ?>:</b>
	<?php echo CHtml::encode($data->adj_evaluacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adj_tecnica')); ?>:</b>
	<?php echo CHtml::encode($data->adj_tecnica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adj_financiero')); ?>:</b>
	<?php echo CHtml::encode($data->adj_financiero); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adj_recepcion')); ?>:</b>
	<?php echo CHtml::encode($data->adj_recepcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adj_disconformidad')); ?>:</b>
	<?php echo CHtml::encode($data->adj_disconformidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

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