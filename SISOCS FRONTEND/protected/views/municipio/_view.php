<?php
/* @var $this MunicipioController */
/* @var $data Municipio */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idMunicipio')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idMunicipio), array('view', 'idMunicipio'=>$data->idMunicipio,'idDepartamento'=>$data->idDepartamento)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idDepartamento')); ?>:</b>
	<?php //echo CHtml::encode($data->FK_idDepartamento->departamento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('municipio')); ?>:</b>
	<?php echo CHtml::encode($data->municipio); ?>
	<br />


</div>