<?php
/* @var $this AvancesController */
/* @var $data Avances */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->codigo), array('view', 'id'=>$data->codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_inicio_ejecucion')); ?>:</b>
	<?php echo CHtml::encode($data->codigo_inicio_ejecucion); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_registro')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_registro); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_registro')); ?>:</b>
	<?php echo CHtml::encode($data->user_registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_avance')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_avance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_problemas')); ?>:</b>
	<?php echo CHtml::encode($data->desc_problemas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_temas')); ?>:</b>
	<?php echo CHtml::encode($data->desc_temas); ?>
	<br />

	*/ ?>

</div>