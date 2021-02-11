<?php
/* @var $this SubsectorController */
/* @var $model Subsector */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idSubSector'); ?>
		<?php echo $form->textField($model,'idSubSector'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idSector'); ?>
		<?php echo $form->textField($model,'idSector'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subsector'); ?>
		<?php echo $form->textField($model,'subsector',array('size'=>60,'maxlength'=>65)); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->