<?php
/* @var $this PartiesController */
/* @var $data Parties */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('legalName')); ?>:</b>
	<?php echo CHtml::encode($data->legalName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uri')); ?>:</b>
	<?php echo CHtml::encode($data->uri); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('streetAddress')); ?>:</b>
	<?php echo CHtml::encode($data->streetAddress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('locality')); ?>:</b>
	<?php echo CHtml::encode($data->locality); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('region')); ?>:</b>
	<?php echo CHtml::encode($data->region); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('countryName')); ?>:</b>
	<?php echo CHtml::encode($data->countryName); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('contactPoint_name')); ?>:</b>
	<?php echo CHtml::encode($data->contactPoint_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contactPoint_email')); ?>:</b>
	<?php echo CHtml::encode($data->contactPoint_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contactPoint_telephone')); ?>:</b>
	<?php echo CHtml::encode($data->contactPoint_telephone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('roles')); ?>:</b>
	<?php echo CHtml::encode($data->roles); ?>
	<br />

	*/ ?>

</div>