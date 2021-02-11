<?php
/* @var $this MetodoController */
/* @var $model Metodo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idMetodo'); ?>
		<?php echo $form->textField($model,'idMetodo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adquisicion'); ?>
		<?php echo $form->textField($model,'adquisicion',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'siglas'); ?>
		<?php echo $form->textField($model,'siglas',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
