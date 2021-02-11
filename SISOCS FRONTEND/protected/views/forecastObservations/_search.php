<?php
/* @var $this ForecastObservationsController */
/* @var $model ForecastObservations */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'forecast_id'); ?>
		<?php echo $form->textField($model,'forecast_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'obs_notes'); ?>
		<?php echo $form->textField($model,'obs_notes',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'obs_amount'); ?>
		<?php echo $form->textField($model,'obs_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'obs_currency'); ?>
		<?php echo $form->textField($model,'obs_currency',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->