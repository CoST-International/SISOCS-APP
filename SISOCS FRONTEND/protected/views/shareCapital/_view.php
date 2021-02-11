<?php
/* @var $this ShareCapitalController */
/* @var $data ShareCapital */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idContratacion')); ?>:</b>
	<?php echo CHtml::encode($data->idContratacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('debtEquityRatio')); ?>:</b>
	<?php echo CHtml::encode($data->debtEquityRatio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shareCapital_amount')); ?>:</b>
	<?php echo CHtml::encode($data->shareCapital_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shareCapital_currency')); ?>:</b>
	<?php echo CHtml::encode($data->shareCapital_currency); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectIRR')); ?>:</b>
	<?php echo CHtml::encode($data->projectIRR); ?>
	<br />


</div>