<?php
/* @var $this DebtEquityRatioController */
/* @var $data DebtEquityRatio */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idContratacion')); ?>:</b>
	<?php echo CHtml::encode($data->idContratacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shareCapitalDetails')); ?>:</b>
	<?php echo CHtml::encode($data->shareCapitalDetails); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('debtEquityRatioDetails')); ?>:</b>
	<?php echo CHtml::encode($data->debtEquityRatioDetails); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('subsidyRatio')); ?>:</b>
	<?php echo CHtml::encode($data->subsidyRatio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectIRR')); ?>:</b>
	<?php echo CHtml::encode($data->projectIRR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subsidyRatioDetails')); ?>:</b>
	<?php echo CHtml::encode($data->subsidyRatioDetails); ?>
	<br />

	*/ ?>

</div>