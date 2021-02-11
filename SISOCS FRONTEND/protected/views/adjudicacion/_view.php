<?php
/* @var $this AdjudicacionController */
/* @var $data Adjudicacion */
?>
<?php if($data->estado!='BORRADOR' && $data->estado!='REVISIÓN' || !Yii::app()->user->isGuest)  
{?>
<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idAdjudicacion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idAdjudicacion), array('view', 'id'=>$data->idAdjudicacion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idCalificacion')); ?>:</b>
	<?php echo CHtml::encode($data->idCalificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numproceso')); ?>:</b>
	<?php echo CHtml::encode($data->numproceso); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('nparticipantes')); ?>:</b>
	<?php echo CHtml::encode($data->nparticipantes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('costoesti')); ?>:</b>
	<?php echo CHtml::encode($data->costoesti); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('estadoproceso')); ?>:</b>
	<?php echo CHtml::encode($data->estadoproceso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actaaper')); ?>:</b>
	<?php echo CHtml::encode($data->actaaper); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('informeacta')); ?>:</b>
	<?php echo CHtml::encode($data->informeacta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resoladju')); ?>:</b>
	<?php echo CHtml::encode($data->resoladju); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('otro')); ?>:</b>
	<?php echo CHtml::encode($data->otro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numfirmasnac')); ?>:</b>
	<?php echo CHtml::encode($data->numfirmasnac); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numfimasinter')); ?>:</b>
	<?php echo CHtml::encode($data->numfimasinter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numconsulcorta')); ?>:</b>
	<?php echo CHtml::encode($data->numconsulcorta); ?>
	<br />

	*/ ?>

</div> <?php }?>