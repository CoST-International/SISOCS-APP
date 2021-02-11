<?php
/* @var $this FuentesfinanController */
/* @var $data Fuentesfinan */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idfuente')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idfuente), array('view', 'id'=>$data->idfuente)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fuente')); ?>:</b>
	<?php echo CHtml::encode($data->fuente); ?>
	<br />


</div>