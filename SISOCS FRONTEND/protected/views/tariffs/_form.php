<?php
/* @var $this TariffsController */
/* @var $model Tariffs */
/* @var $form CActiveForm */
?>

<div class="">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'implementation-dialog-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group ">
		<?php echo $form->hiddenField($model,'idInicioEjecucion',array('value'=>$idInicioEjecucion)); ?>
	</div>

	<div class="form-group ">
		<?php echo $form->labelEx($model,'tittle'); ?>
		<?php echo $form->textField($model,'tittle',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'tittle'); ?>
	</div>

	<div class="form-group ">
		<?php echo $form->labelEx($model,'paidBy_party_id'); ?>

		<?php echo  $form->dropDownList($model,'paidBy_party_id',Yii::app()->Controller->listaParties(),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'paidBy_party_id'); ?>
	</div>

	<div class="form-group ">
		<?php echo $form->labelEx($model,'startDate'); ?>
		<?php echo $form->textField($model,'startDate',array('size'=>20,'maxlength'=>20,'placeholder'=>'AAAA-MM-DD','readonly'=>false,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'startDate'); ?>
	</div>

	<div class="form-group ">
		<?php echo $form->labelEx($model,'endDate'); ?>
		<?php echo $form->textField($model,'endDate',array('size'=>20,'maxlength'=>20,'placeholder'=>'AAAA-MM-DD','readonly'=>false,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'endDate'); ?>
	</div>

	<div class="form-group ">
		<?php echo $form->labelEx($model,'maxExtentDate'); ?>
		<?php echo $form->textField($model,'maxExtentDate',array('size'=>20,'maxlength'=>20,'placeholder'=>'AAAA-MM-DD','readonly'=>false,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'maxExtentDate'); ?>
	</div>

	<div class="form-group ">
		<?php echo $form->labelEx($model,'durationInDays'); ?>
		<?php echo $form->textField($model,'durationInDays',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'durationInDays'); ?>
	</div>

	<div class="form-group ">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

	<div class="form-group ">
		<?php echo $form->labelEx($model,'dimensions'); ?>
		<?php echo $form->textArea($model,'dimensions',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'dimensions'); ?>
	</div>

	<div class="form-group ">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="form-group ">
		<?php echo $form->labelEx($model,'currency'); ?>
		<?php echo  $form->dropDownList($model,'currency',Yii::app()->Controller->listaMonedas(),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control')); ?>

		<?php echo $form->error($model,'currency'); ?>
	</div>

	<div class="form-group  buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Save'); ?>
            <?php  //echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_desembolsos(); dialogoDeUpdate.dialog("close"); return false;'));  ?>

			<?php if ($model->isNewRecord==false) {


			     echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'update_documents(\'tariffs\','.$model->id.');'));
				 echo CHtml::button('Cerrar', array('onclick' => 'dialogoDeUpdate.dialog("close"); return false;'));
			}else{
			      echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_documents(\'tariffs\');'));
		    }

			?>

	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
