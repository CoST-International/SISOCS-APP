<?php
/* @var $this CalificacionOferenteController */
/* @var $model CalificacionOferente */
/* @var $form CActiveForm */
?>

<div class="">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'calificacion-oferente-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	 'enableClientValidation'=>true,
           'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'afterValidate'=>'js:$.yii.fix.ajaxSubmit.afterValidate'
                             ),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
       
	<div class="form-group">
		<?php echo $form->hiddenField($model, 'idCalificacion', array('value'=>$idCalificacion)); ?>
		<?php echo $form->error($model,'idCalificacion'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'idOferente'); ?>
		<?php echo  $form->dropDownList($model,'idOferente',$model->listaParties(),array('prompt'=>'--Seleccione un valor--','class'=>'form-control'));?>  
		<?php echo $form->error($model,'idOferente'); ?>
	</div>

	<div class="form-group buttons">
		<?php  echo CHtml::Button('Enviar',array('id'=>'enviar','onclick'=>'send_oferente();'));  ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
