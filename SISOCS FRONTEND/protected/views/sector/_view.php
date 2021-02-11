<?php
/* @var $this SectorController */
/* @var $data Sector */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idSector')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idSector), array('view', 'id'=>$data->idSector)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sector')); ?>:</b>
	<?php echo CHtml::encode($data->sector); ?>
	<br />


</div>