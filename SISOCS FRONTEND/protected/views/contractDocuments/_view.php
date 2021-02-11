<?php
/* @var $this ContractDocumentsController */
/* @var $data ContractDocuments */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idContratacion')); ?>:</b>
	<?php echo CHtml::encode($data->idContratacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentType')); ?>:</b>
	<?php echo CHtml::encode($data->documentType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pageStart')); ?>:</b>
	<?php echo CHtml::encode($data->pageStart); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('pageEnd')); ?>:</b>
	<?php echo CHtml::encode($data->pageEnd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datePublished')); ?>:</b>
	<?php echo CHtml::encode($data->datePublished); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateModified')); ?>:</b>
	<?php echo CHtml::encode($data->dateModified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('accessDetails')); ?>:</b>
	<?php echo CHtml::encode($data->accessDetails); ?>
	<br />

	*/ ?>

</div>