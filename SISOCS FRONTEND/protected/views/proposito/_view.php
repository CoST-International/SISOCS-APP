<?php
/* @var $this PropositoController */
/* @var $data Proposito */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idProposito')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idProposito), array('view', 'id'=>$data->idProposito)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proposito')); ?>:</b>
	<?php echo CHtml::encode($data->proposito); ?>
	<br />


</div>