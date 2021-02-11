<?php
/* @var $this ProyectoController */
/* @var $data Proyecto */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idproyect')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idproyect), array('view', 'id'=>$data->idproyect)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('programa')); ?>:</b>
	<?php echo CHtml::encode($data->programa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codproyecto')); ?>:</b>
	<?php echo CHtml::encode($data->codproyecto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proyecto')); ?>:</b>
	<?php echo CHtml::encode($data->proyecto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ubicacion')); ?>:</b>
	<?php echo CHtml::encode($data->ubicacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fuentefinan')); ?>:</b>
	<?php echo CHtml::encode($data->fuentefinan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('region')); ?>:</b>
	<?php echo CHtml::encode($data->region); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('depto')); ?>:</b>
	<?php echo CHtml::encode($data->depto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tramo')); ?>:</b>
	<?php echo CHtml::encode($data->tramo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ruta')); ?>:</b>
	<?php echo CHtml::encode($data->ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipored')); ?>:</b>
	<?php echo CHtml::encode($data->tipored); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estadored')); ?>:</b>
	<?php echo CHtml::encode($data->estadored); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proposito')); ?>:</b>
	<?php echo CHtml::encode($data->proposito); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descrip')); ?>:</b>
	<?php echo CHtml::encode($data->descrip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('presupuesto')); ?>:</b>
	<?php echo CHtml::encode($data->presupuesto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('benemunicipio')); ?>:</b>
	<?php echo CHtml::encode($data->benemunicipio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('especiplano')); ?>:</b>
	<?php echo CHtml::encode($data->especiplano); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('presuprogra')); ?>:</b>
	<?php echo CHtml::encode($data->presuprogra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estudiofact')); ?>:</b>
	<?php echo CHtml::encode($data->estudiofact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estudioimpact')); ?>:</b>
	<?php echo CHtml::encode($data->estudioimpact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('licambi')); ?>:</b>
	<?php echo CHtml::encode($data->licambi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estuimpactierra')); ?>:</b>
	<?php echo CHtml::encode($data->estuimpactierra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('planreasea')); ?>:</b>
	<?php echo CHtml::encode($data->planreasea); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plananual')); ?>:</b>
	<?php echo CHtml::encode($data->plananual); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('acuerdofinan')); ?>:</b>
	<?php echo CHtml::encode($data->acuerdofinan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('otro')); ?>:</b>
	<?php echo CHtml::encode($data->otro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechacreacion')); ?>:</b>
	<?php echo CHtml::encode($data->fechacreacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	*/ ?>

</div>