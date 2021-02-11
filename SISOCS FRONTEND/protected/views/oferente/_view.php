<?php
/* @var $this oferenteController */
/* @var $data oferente */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idOferente')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idoferente), array('view', 'id'=>$data->idoferente)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_oferente')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_oferente); ?>
	<br />


</div>
