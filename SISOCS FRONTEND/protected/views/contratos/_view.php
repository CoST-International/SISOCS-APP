<?php
/* @var $this ContratosController */
/* @var $data Contratos */
?>
<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('idContratos')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idContratos), array('view', 'id'=>$data->idContratos)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idContratacion')); ?>:</b>
	<?php echo CHtml::encode($data->idContratacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nmodifica')); ?>:</b>
	<?php echo CHtml::encode($data->nmodifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipomodifica')); ?>:</b>
	<?php echo CHtml::encode($data->tipomodifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('justimodcontrato')); ?>:</b>
	<?php echo CHtml::encode($data->justimodcontrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('precioactual')); ?>:</b>
	<?php echo CHtml::encode($data->precioactual); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechatercontra')); ?>:</b>
	<?php echo CHtml::encode($data->fechatercontra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alcanceactucontrato')); ?>:</b>
	<?php echo CHtml::encode($data->alcanceactucontrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adendas')); ?>:</b>
	<?php echo CHtml::encode($data->adendas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prograactu')); ?>:</b>
	<?php echo CHtml::encode($data->prograactu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('otro')); ?>:</b>
	<?php echo CHtml::encode($data->otro); ?>
	<br />
</div>
