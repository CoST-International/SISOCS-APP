<?php
/* @var $this PreferredBiddersController */
/* @var $model PreferredBidders */
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
		<?php echo $form->label($model,'idContratacion'); ?>
		<?php echo $form->textField($model,'idContratacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parties_id'); ?>
		<?php echo $form->textField($model,'parties_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parties_name'); ?>
		<?php echo $form->textField($model,'parties_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->