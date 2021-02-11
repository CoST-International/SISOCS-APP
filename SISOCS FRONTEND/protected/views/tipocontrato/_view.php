<?php
/* @var $this TipocontratoController */
/* @var $data Tipocontrato */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTipoContrato')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idTipoContrato), array('view', 'id'=>$data->idTipoContrato)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contrato')); ?>:</b>
	<?php echo CHtml::encode($data->contrato); ?>
	<br />


</div>