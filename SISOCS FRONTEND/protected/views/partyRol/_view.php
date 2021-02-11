<?php
/* @var $this PartyRolController */
/* @var $data PartyRol */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idRol')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idRol), array('view', 'id'=>$data->idRol)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />


</div>