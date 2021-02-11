<?php
/* @var $this FinalEjecucionController */
/* @var $data FinalEjecucion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idFinalizacion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idFinalizacion), array('view', 'id'=>$data->idFinalizacion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('costoFinalizacion')); ?>:</b>
	<?php echo CHtml::encode($data->costoFinalizacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alcanceFinalizacion')); ?>:</b>
	<?php echo CHtml::encode($data->alcanceFinalizacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaFinalizacion')); ?>:</b>
	<?php echo CHtml::encode($data->fechaFinalizacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adj_documentoGarantia')); ?>:</b>
	<?php echo CHtml::encode($data->adj_documentoGarantia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adj_actaRecepcion')); ?>:</b>
	<?php echo CHtml::encode($data->adj_actaRecepcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adj_informesEvaluacion')); ?>:</b>
	<?php echo CHtml::encode($data->adj_informesEvaluacion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('adj_informeDisconformidad')); ?>:</b>
	<?php echo CHtml::encode($data->adj_informeDisconformidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adj_informeAseguramientoCalidad')); ?>:</b>
	<?php echo CHtml::encode($data->adj_informeAseguramientoCalidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('razonesCambios')); ?>:</b>
	<?php echo CHtml::encode($data->razonesCambios); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indicador1')); ?>:</b>
	<?php echo CHtml::encode($data->indicador1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indicador2')); ?>:</b>
	<?php echo CHtml::encode($data->indicador2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indicador3')); ?>:</b>
	<?php echo CHtml::encode($data->indicador3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indicador4')); ?>:</b>
	<?php echo CHtml::encode($data->indicador4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indicador5')); ?>:</b>
	<?php echo CHtml::encode($data->indicador5); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indicador6')); ?>:</b>
	<?php echo CHtml::encode($data->indicador6); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indicador7')); ?>:</b>
	<?php echo CHtml::encode($data->indicador7); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indicador8')); ?>:</b>
	<?php echo CHtml::encode($data->indicador8); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idInicioEjecucion')); ?>:</b>
	<?php echo CHtml::encode($data->idInicioEjecucion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estadoContratoActual')); ?>:</b>
	<?php echo CHtml::encode($data->estadoContratoActual); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuario_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->usuario_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	*/ ?>

</div>