<?php
/* @var $this PropositoController */
/* @var $model Proposito */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idProposito'); ?>
		<?php echo $form->textField($model,'idProposito'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proposito'); ?>
		<?php echo $form->textField($model,'proposito',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->