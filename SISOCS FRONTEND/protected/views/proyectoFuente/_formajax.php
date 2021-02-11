<?php
/* @var $this ProgramaFuenteController */
/* @var $model ProgramaFuente */
/* @var $form CActiveForm */
?>

<div class="">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'proyecto-dialog-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->hiddenField($model, 'idProyecto', array('value'=>$idProyecto)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idFuente'); ?>
		<?php echo  $form->dropDownList($model,'idFuente',$model->listaParties(),array('prompt'=>'--Seleccione un valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'idFuente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'monto'); ?>
		<?php echo $form->textField($model,'monto',array('size'=>27,'maxlength'=>27,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'monto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idMoneda'); ?>
		<?php echo  $form->dropDownList($model,'idMoneda',Yii::app()->controller->listaMonedasID(),array('prompt'=>'--Seleccione un valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'idMoneda'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tasa_cambio'); ?>
		<?php echo $form->textField($model,'tasa_cambio',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'tasa_cambio'); ?>
	</div>

	<div class="buttons">
    <?php //echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Save'); ?>
            <?php  //echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_desembolsos(); dialogoDeUpdate.dialog("close"); return false;'));  ?>

      <?php if ($model->isNewRecord==false) {


           echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'update_documents(\'fuente\','.$model->idProyecto.','.$model->idFuente.');','class'=>'btn btn-success'));
         echo CHtml::button('Cerrar', array('onclick' => 'dialogoDeUpdate.dialog("close"); return false;','class'=>'btn btn-info'));
      }else{
            echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_documents(\'fuente\');','class'=>'btn btn-success'));
        }

      ?>
	</div>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
