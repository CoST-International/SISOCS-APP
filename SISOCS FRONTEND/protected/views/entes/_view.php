<?php
/* @var $this EntesController */
/* @var $data Entes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idEnte')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idEnte), array('view', 'id'=>$data->idEnte)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />


</div>