<?php
/* @var $this TipoModContratoController */
/* @var $model TipoModContrato */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idTipoModificacion'); ?>
		<?php echo $form->textField($model,'idTipoModificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_modificacion'); ?>
		<?php echo $form->textField($model,'tipo_modificacion',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->