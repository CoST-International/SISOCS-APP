<?php
/* @var $this AvancesImagenesController */
/* @var $model AvancesImagenes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idImagen'); ?>
		<?php echo $form->textField($model,'idImagen'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idAvances'); ?>
		<?php echo $form->textField($model,'idAvances'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_imagen'); ?>
		<?php echo $form->textField($model,'nombre_imagen',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_fisico'); ?>
		<?php echo $form->textField($model,'nombre_fisico',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ubicacion_imagen'); ?>
		<?php echo $form->textField($model,'ubicacion_imagen',array('size'=>60,'maxlength'=>3000)); ?>
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