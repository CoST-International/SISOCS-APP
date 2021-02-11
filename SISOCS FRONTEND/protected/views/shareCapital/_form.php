<?php
/* @var $this ShareCapitalController */
/* @var $model ShareCapital */
/* @var $form CActiveForm */
?>

<div class="">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contratacion-dialog-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->hiddenField($model,'idContratacion',array('value'=>$idContratacion)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'debtEquityRatio'); ?>
		<?php echo $form->textField($model,'debtEquityRatio',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'debtEquityRatio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shareCapital_amount'); ?>
		<?php echo $form->textField($model,'shareCapital_amount',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'shareCapital_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shareCapital_currency'); ?>
		<?php echo  $form->dropDownList($model,'shareCapital_currency',Yii::app()->Controller->listaMonedas(),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'shareCapital_currency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'projectIRR'); ?>
		<?php echo $form->textField($model,'projectIRR',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'projectIRR'); ?>
	</div>

	<div class="buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Save'); ?>
            <?php  //echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_desembolsos(); dialogoDeUpdate.dialog("close"); return false;'));  ?>

			<?php if ($model->isNewRecord==false) {


			     echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'update_documents(\'ShareCapital\','.$model->id.');','class'=>'btn btn-success'));
				 echo CHtml::button('Cerrar', array('onclick' => 'dialogoDeUpdate.dialog("close"); return false;','class'=>'btn btn-info'));
			}else{
			      echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_documents(\'ShareCapital\');','class'=>'btn btn-success'));
		    }

		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
