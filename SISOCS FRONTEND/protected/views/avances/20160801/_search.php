<?php
/* @var $this AvancesController */
/* @var $model Avances */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codigo_inicio_ejecucion'); ?>
		<?php echo $form->textField($model,'codigo_inicio_ejecucion',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'porcent_programado'); ?>
		<?php echo $form->textField($model,'porcent_programado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'porcent_real'); ?>
		<?php echo $form->textField($model,'porcent_real'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'finan_programado'); ?>
		<?php echo $form->textField($model,'finan_programado',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'finan_real'); ?>
		<?php echo $form->textField($model,'finan_real',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row" style="display:none">
		<?php echo $form->label($model,'fecha_registro'); ?>
		<?php echo $form->textField($model,'fecha_registro'); ?>
	</div>

	<div class="row" style="display:none">
		<?php echo $form->label($model,'user_registro'); ?>
		<?php echo $form->textField($model,'user_registro',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_avance'); ?>
		<?php echo $form->textField($model,'fecha_avance'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc_problemas'); ?>
		<?php echo $form->textField($model,'desc_problemas',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc_temas'); ?>
		<?php echo $form->textField($model,'desc_temas',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->