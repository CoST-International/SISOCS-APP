<?php
/* @var $this TransactionsController */
/* @var $data Transactions */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idInicioEjecucion')); ?>:</b>
	<?php echo CHtml::encode($data->idInicioEjecucion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('source')); ?>:</b>
	<?php echo CHtml::encode($data->source); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payer_id')); ?>:</b>
	<?php echo CHtml::encode($data->payer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payer_name')); ?>:</b>
	<?php echo CHtml::encode($data->payer_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payee_id')); ?>:</b>
	<?php echo CHtml::encode($data->payee_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('payee_name')); ?>:</b>
	<?php echo CHtml::encode($data->payee_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency')); ?>:</b>
	<?php echo CHtml::encode($data->currency); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('relatedImplementationMilestone')); ?>:</b>
	<?php echo CHtml::encode($data->relatedImplementationMilestone); ?>
	<br />

	*/ ?>

</div>