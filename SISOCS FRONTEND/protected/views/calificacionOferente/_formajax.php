<?php
/* @var $this CalificacionOferenteController */
/* @var $model CalificacionOferente */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'calificacion-oferente-form',
            'enableClientValidation'=>true,
           'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'afterValidate'=>'js:$.yii.fix.ajaxSubmit.afterValidate'),
));?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
	
		<div class="row">
		<?php echo $form->labelEx($model,'idcalificacion'); ?>
		<?php echo $form->textField($model,'idcalificacion',array('value'=>$idCalificacion)); ?>
		<?php echo $form->error($model,'idcalificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idoferente'); ?>
		<?php echo  $form->dropDownList($model,'idoferente',$model->listaParties(),array('prompt'=>'--Seleccione un valor--'));?>
		<?php echo $form->error($model,'idoferente'); ?>
	</div>
       

	<div class="buttons">
		<?php  echo CHtml::Button('Enviar',array('id'=>'enviar','onclick'=>'send_oferente();'));  ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
