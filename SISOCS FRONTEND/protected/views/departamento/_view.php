<?php
/* @var $this DepartamentoController */
/* @var $data Departamento */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idDepartamento')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idDepartamento), array('view', 'id'=>$data->idDepartamento)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('departamento')); ?>:</b>
	<?php echo CHtml::encode($data->departamento); ?>
	<br />


</div>