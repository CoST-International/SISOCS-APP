<?php
/* @var $this CalificacionController */
/* @var $model Calificacion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idCalificacion'); ?>
		<?php echo $form->textField($model,'idCalificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idProyecto'); ?>
		<?php echo $form->textField($model,'idProyecto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'numproceso'); ?>
		<?php echo $form->textField($model,'numproceso',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nomprocesoproyecto'); ?>
		<?php echo $form->textField($model,'nomprocesoproyecto',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idente'); ?>
		<?php echo $form->textField($model,'idente'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idFuncionario'); ?>
		<?php echo $form->textField($model,'idFuncionario'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechactualizacion'); ?>
		<?php echo $form->textField($model,'fechactualizacion',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estatusproceso'); ?>
		<?php echo $form->textField($model,'estatusproceso',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proceseval'); ?>
		<?php echo $form->textField($model,'proceseval',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invitainter'); ?>
		<?php echo $form->textField($model,'invitainter',array('size'=>60,'maxlength'=>254)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'basespreca'); ?>
		<?php echo $form->textField($model,'basespreca',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'resolucion'); ?>
		<?php echo $form->textField($model,'resolucion',array('size'=>60,'maxlength'=>254)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombreante'); ?>
		<?php echo $form->textField($model,'nombreante',array('size'=>60,'maxlength'=>254)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'convocainvi'); ?>
		<?php echo $form->textField($model,'convocainvi',array('size'=>60,'maxlength'=>254)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tdr'); ?>
		<?php echo $form->textField($model,'tdr',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aclaraciones'); ?>
		<?php echo $form->textField($model,'aclaraciones',array('size'=>60,'maxlength'=>254)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'actarecpcion'); ?>
		<?php echo $form->textField($model,'actarecpcion',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechaingreso'); ?>
		<?php echo $form->textField($model,'fechaingreso',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipocontrato'); ?>
		<?php echo $form->textField($model,'tipocontrato',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado'); ?>
		<?php echo $form->textField($model,'estado',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'otro'); ?>
		<?php echo $form->textField($model,'otro',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idmetodo'); ?>
		<?php echo $form->textField($model,'idmetodo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecharecibido'); ?>
		<?php echo $form->textField($model,'fecharecibido',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idTipoContrato'); ?>
		<?php echo $form->textField($model,'idTipoContrato'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->