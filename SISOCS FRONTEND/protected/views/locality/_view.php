<?php
/* @var $this LocalityController */
/* @var $data Locality */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idLocality')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idLocality), array('view', 'id'=>$data->idLocality)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />


</div>