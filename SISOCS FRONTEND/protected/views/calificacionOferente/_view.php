<?php
/* @var $this CalificacionOferenteController */
/* @var $data CalificacionOferente */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idCalificacion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idCalificacion), array('view', 'id'=>$data->primaryKey)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idOferente')); ?>:</b>
	<?php echo CHtml::encode($data->idOferente); ?>
	<br />


</div>