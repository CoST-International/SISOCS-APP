<?php
/* @var $this MetodoController */
/* @var $data Metodo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idmetodo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idmetodo), array('view', 'id'=>$data->idmetodo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adquisicion')); ?>:</b>
	<?php echo CHtml::encode($data->adquisicion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('siglas')); ?>:</b>
	<?php echo CHtml::encode($data->siglas); ?>
	<br />


</div>