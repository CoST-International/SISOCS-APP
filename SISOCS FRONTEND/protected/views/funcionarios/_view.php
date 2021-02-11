<?php
/* @var $this FuncionariosController */
/* @var $data Funcionarios */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idFuncionario')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idFuncionario), array('view', 'id'=>$data->idFuncionario)); ?>
	<br />
	<?php $Ente   = Yii::app()->db->createCommand('SELECT descripcion FROM cs_entes WHERE idEnte ='.CHtml::encode($data->idEnte))->queryAll();  ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('idEnte')); ?>:</b>
	<?php echo CHtml::encode($Ente[0]['descripcion']); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('puesto')); ?>:</b>
	<?php echo CHtml::encode($data->puesto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono')); ?>:</b>
	<?php echo CHtml::encode($data->telefono); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correo')); ?>:</b>
	<?php echo CHtml::encode($data->correo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idUnidad')); ?>:</b>
	<?php echo CHtml::encode($data->idUnidad); ?>
	<br />


</div>
