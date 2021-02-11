<?php
/* @var $this ContratacionController */
/* @var $data Contratacion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idcontratacion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idcontratacion), array('view', 'id'=>$data->idcontratacion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codcontrato')); ?>:</b>
	<?php echo CHtml::encode($data->codcontrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('entidadaadcontra')); ?>:</b>
	<?php echo CHtml::encode($data->entidadaadcontra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ncontrato')); ?>:</b>
	<?php echo CHtml::encode($data->ncontrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('consulfirma')); ?>:</b>
	<?php echo CHtml::encode($data->consulfirma); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('precio')); ?>:</b>
	<?php echo CHtml::encode($data->precio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alcances')); ?>:</b>
	<?php echo CHtml::encode($data->alcances); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fechainicio')); ?>:</b>
	<?php echo CHtml::encode($data->fechainicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechafinal')); ?>:</b>
	<?php echo CHtml::encode($data->fechafinal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('duracioncontrato')); ?>:</b>
	<?php echo CHtml::encode($data->duracioncontrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentocontra')); ?>:</b>
	<?php echo CHtml::encode($data->documentocontra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regante')); ?>:</b>
	<?php echo CHtml::encode($data->regante); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('espeplanos')); ?>:</b>
	<?php echo CHtml::encode($data->espeplanos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('otro')); ?>:</b>
	<?php echo CHtml::encode($data->otro); ?>
	<br />

	*/ ?>

</div>