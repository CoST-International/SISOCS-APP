<?php
/* @var $this InicioEjecucionController */
/* @var $model InicioEjecucion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idInicioEjecucion'); ?>
		<?php echo $form->textField($model,'idInicioEjecucion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idContratacion'); ?>
		<?php echo $form->textField($model,'idContratacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idContacto'); ?>
		<?php echo $form->textField($model,'idContacto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_inicio'); ?>
		<?php echo $form->textField($model,'fecha_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'programainicial'); ?>
		<?php echo $form->textField($model,'programainicial',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vartiempo'); ?>
		<?php echo $form->textField($model,'vartiempo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'varprecio'); ?>
		<?php echo $form->textField($model,'varprecio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idEstadoContrato'); ?>
		<?php echo $form->textField($model,'idEstadoContrato'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado'); ?>
		<?php echo $form->textField($model,'estado',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usuario_creacion'); ?>
		<?php echo $form->textField($model,'usuario_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model,'fecha_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usuario_publicacion'); ?>
		<?php echo $form->textField($model,'usuario_publicacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_publicacion'); ?>
		<?php echo $form->textField($model,'fecha_publicacion'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->