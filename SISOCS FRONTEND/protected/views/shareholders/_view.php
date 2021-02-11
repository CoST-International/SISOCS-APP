<?php
/* @var $this ShareholdersController */
/* @var $data Shareholders */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idContratacion')); ?>:</b>
	<?php echo CHtml::encode($data->idContratacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shareholder_id')); ?>:</b>
	<?php echo CHtml::encode($data->shareholder_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shareholder_name')); ?>:</b>
	<?php echo CHtml::encode($data->shareholder_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('votingRights')); ?>:</b>
	<?php echo CHtml::encode($data->votingRights); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('votingRightsDetails')); ?>:</b>
	<?php echo CHtml::encode($data->votingRightsDetails); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shareholding')); ?>:</b>
	<?php echo CHtml::encode($data->shareholding); ?>
	<br />


</div>