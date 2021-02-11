<?php
/* @var $this SubsectorController */
/* @var $data Subsector */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idSubSector')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idSubSector), array('view', 'id'=>$data->idSubSector)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idSector')); ?>:</b>
	<?php echo CHtml::encode($data->idSector); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subsector')); ?>:</b>
	<?php echo CHtml::encode($data->subsector); ?>
	<br />


</div>