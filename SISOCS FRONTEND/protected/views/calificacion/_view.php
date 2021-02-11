<?php
/* @var $this CalificacionController */
/* @var $data Calificacion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idCalificacion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idCalificacion), array('view', 'id'=>$data->idCalificacion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idProyecto')); ?>:</b>
	<?php echo CHtml::encode($data->idProyecto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numproceso')); ?>:</b>
	<?php echo CHtml::encode($data->numproceso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nomprocesoproyecto')); ?>:</b>
	<?php echo CHtml::encode($data->nomprocesoproyecto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idFuncionario')); ?>:</b>
	<?php echo CHtml::encode($data->idFuncionario0->nombre); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('proceseval')); ?>:</b>
	<?php echo CHtml::encode($data->proceseval); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invitainter')); ?>:</b>
	<?php echo CHtml::encode($data->invitainter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('basespreca')); ?>:</b>
	<?php echo CHtml::encode($data->basespreca); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resolucion')); ?>:</b>
	<?php echo CHtml::encode($data->resolucion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombreante')); ?>:</b>
	<?php echo CHtml::encode($data->nombreante); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('convocainvi')); ?>:</b>
	<?php echo CHtml::encode($data->convocainvi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tdr')); ?>:</b>
	<?php echo CHtml::encode($data->tdr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aclaraciones')); ?>:</b>
	<?php echo CHtml::encode($data->aclaraciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actarecpcion')); ?>:</b>
	<?php echo CHtml::encode($data->actarecpcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaingreso')); ?>:</b>
	<?php echo CHtml::encode($data->fechaingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipocontrato')); ?>:</b>
	<?php echo CHtml::encode($data->tipocontrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('otro1')); ?>:</b>
	<?php echo CHtml::encode($data->otro1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('otro2')); ?>:</b>
	<?php echo CHtml::encode($data->otro2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('identidadadquisicion')); ?>:</b>
	<?php echo CHtml::encode($data->identidadadquisicion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idmetodo')); ?>:</b>
	<?php CHtml::encode($data->idmetodo);?>
	<br />
    */
	 ?>

</div>