<?php
/* @var $this ProyectoController */
/* @var $data Proyecto */

?>


<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idProyecto')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idProyecto), array('view', 'id'=>$data->idProyecto)); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo')); ?>:</b>
	<?php echo CHtml::encode($data->codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_proyecto')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_proyecto); ?>
	<br />

	

</div>