<?php
/* @var $this MonedasController */
/* @var $data Monedas */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idMoneda')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idMoneda), array('view', 'id'=>$data->idMoneda)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('moneda')); ?>:</b>
	<?php echo CHtml::encode($data->moneda); ?>
	<br />


</div>