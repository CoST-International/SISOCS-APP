<?php
/* @var $this CurrencyController */
/* @var $data Currency */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idCurrency')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idCurrency), array('view', 'id'=>$data->idCurrency)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('moneda')); ?>:</b>
	<?php echo CHtml::encode($data->moneda); ?>
	<br />


</div>