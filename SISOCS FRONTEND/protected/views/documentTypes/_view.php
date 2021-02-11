<?php
/* @var $this DocumentTypesController */
/* @var $data DocumentTypes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idDocumentType')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idDocumentType), array('view', 'id'=>$data->idDocumentType)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::encode($data->code); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>