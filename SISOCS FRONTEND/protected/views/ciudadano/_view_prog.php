<?php
/* @var $this ProgramaController */
/* @var $data Programa */
?>

<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('programa')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->programa), array('view', 'id'=>$data->programa)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombreprograma')); ?>:</b>
	<?php echo CHtml::encode($data->nombreprograma); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BIP')); ?>:</b>
	<?php echo CHtml::encode($data->BIP); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('entes')); ?>:</b>
	<?php echo CHtml::encode($data->entes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('funcinombre')); ?>:</b>
	<?php echo CHtml::encode($data->funcinombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('funcirol')); ?>:</b>
	<?php echo CHtml::encode($data->funcirol); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proposito')); ?>:</b>
	<?php echo CHtml::encode($data->proposito); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sector')); ?>:</b>
	<?php echo CHtml::encode($data->sector); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('subsector')); ?>:</b>
	<?php echo CHtml::encode($data->subsector); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('costoesti')); ?>:</b>
	<?php echo CHtml::encode($data->costoesti); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaapro')); ?>:</b>
	<?php echo CHtml::encode($data->fechaapro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fuentefinan')); ?>:</b>
	<?php echo CHtml::encode($data->fuentefinan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipomone')); ?>:</b>
	<?php echo CHtml::encode($data->tipomone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monto')); ?>:</b>
	<?php echo CHtml::encode($data->monto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cartaconvenio')); ?>:</b>
	<?php echo CHtml::encode($data->cartaconvenio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('otro1')); ?>:</b>
	<?php echo CHtml::encode($data->otro1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('planope')); ?>:</b>
	<?php echo CHtml::encode($data->planope); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('presupuesto')); ?>:</b>
	<?php echo CHtml::encode($data->presupuesto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('perfildelprogra')); ?>:</b>
	<?php echo CHtml::encode($data->perfildelprogra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('otro2')); ?>:</b>
	<?php echo CHtml::encode($data->otro2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechacreacion')); ?>:</b>
	<?php echo CHtml::encode($data->fechacreacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	*/ ?>

</div>