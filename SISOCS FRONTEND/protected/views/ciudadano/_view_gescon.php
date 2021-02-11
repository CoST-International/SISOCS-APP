<?php
/* @var $this CiudadanoController */
/* @var $data Contratos */
?>

<div class="view" width="100%">
	<b><?php echo CHtml::encode($data->getAttributeLabel('nmodifica')); ?>:</b>
	<?php echo CHtml::encode($data->nmodifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipomodifica')); ?>:</b>
	<?php echo CHtml::encode($data->tipomodifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechatercontra')); ?>:</b>
	<?php echo CHtml::encode($data->fechatercontra); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('precioactual')); ?>:</b>
	<?php echo (!empty($data->precioactual))? number_format(CHtml::encode($data->precioactual),2) : '&nbsp;'; ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('alcanceactucontrato')); ?>:</b>
	<?php echo CHtml::encode($data->alcanceactucontrato); ?>
	<br />
	
		
	<b><?php echo CHtml::encode($data->getAttributeLabel('justimodcontrato')); ?>:</b>
	<?php echo CHtml::encode($data->justimodcontrato); ?>
	<br />
	
	 <b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />
	
</div>