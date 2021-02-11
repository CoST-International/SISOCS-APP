<?php
/* @var $this FinanceController */
/* @var $data Finance */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idContratacion')); ?>:</b>
	<?php echo CHtml::encode($data->idContratacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('financingParty_id')); ?>:</b>
	<?php echo CHtml::encode($data->financingParty_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('financingParty_name')); ?>:</b>
	<?php echo CHtml::encode($data->financingParty_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('financeCategory')); ?>:</b>
	<?php echo CHtml::encode($data->financeCategory); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency')); ?>:</b>
	<?php echo CHtml::encode($data->currency); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('startDate')); ?>:</b>
	<?php echo CHtml::encode($data->startDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('endDate')); ?>:</b>
	<?php echo CHtml::encode($data->endDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('interestRate_base')); ?>:</b>
	<?php echo CHtml::encode($data->interestRate_base); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('interestRate_margin')); ?>:</b>
	<?php echo CHtml::encode($data->interestRate_margin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('interestRate_fixed')); ?>:</b>
	<?php echo CHtml::encode($data->interestRate_fixed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stepInRights')); ?>:</b>
	<?php echo CHtml::encode($data->stepInRights); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exchangeRateGuarantee')); ?>:</b>
	<?php echo CHtml::encode($data->exchangeRateGuarantee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('repaymentFrequency')); ?>:</b>
	<?php echo CHtml::encode($data->repaymentFrequency); ?>
	<br />

	*/ ?>

</div>