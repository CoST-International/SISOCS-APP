<?php
/* @var $this MetodoAdjudicacionController */
/* @var $data MetodoAdjudicacion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idMetodoAdjudicacion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idMetodoAdjudicacion), array('view', 'id'=>$data->idMetodoAdjudicacion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />


</div>