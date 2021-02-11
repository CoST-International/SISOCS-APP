<?php
/* @var $this CalificacionOferenteController */
/* @var $model CalificacionOferente */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idcalificacion'); ?>
		<?php echo $form->textField($model,'idcalificacion',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idoferente'); ?>
		<?php echo $form->textField($model,'idoferente',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->