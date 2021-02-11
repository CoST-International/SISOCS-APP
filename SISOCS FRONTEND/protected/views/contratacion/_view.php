<?php
/* @var $this ContratacionController */
/* @var $data Contratacion */
?>
<?php if($data->estado!='BORRADOR' && $data->estado!='REVISIÓN' || !Yii::app()->user->isGuest)  
{?>
<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idContratacion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idContratacion), array('view', 'id'=>$data->idContratacion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idAdjudicacion')); ?>:</b>
	<?php echo CHtml::encode($data->idAdjudicacion); ?>
	<br />
<!--
	<b><?php //echo CHtml::encode($data->getAttributeLabel('idEntidad')); ?></b>
	<?php //echo CHtml::encode($data->idEntidad0->descripcion); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('idoferente')); ?></b>
	<?php //echo CHtml::encode($data->idoferente); ?>
	<br /> -->

	

	<b><?php echo CHtml::encode($data->getAttributeLabel('precioLPS')); ?>:</b>
	<?php echo number_format($data->precioLPS,2,'.',','); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('precioUSD')); ?>:</b>
	<?php echo number_format($data->precioUSD,2,'.',','); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alcances')); ?>:</b>
	<?php echo CHtml::encode($data->alcances); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechainicio')); ?>:</b>
	<?php echo CHtml::encode($data->fechainicio); ?>
	<br />

	<?php /*
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('ncontrato')); ?>:</b>
	<?php echo CHtml::encode($data->ncontrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titulocontrato')); ?>:</b>
	<?php echo CHtml::encode($data->titulocontrato); ?>
	<br />

	*/ ?>

</div><?php }?>