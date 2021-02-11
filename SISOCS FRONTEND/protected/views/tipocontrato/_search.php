<?php
/* @var $this TipocontratoController */
/* @var $model Tipocontrato */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idTipoContrato'); ?>
		<?php echo $form->textField($model,'idTipoContrato'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contrato'); ?>
		<?php echo $form->textField($model,'contrato',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->