<?php
/* @var $this TransactionsController */
/* @var $model Transactions */
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

	<div class="form-group">
		<?php echo $form->hiddenField($model,'idInicioEjecucion',array('value'=>$idInicioEjecucion)); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date',array('size'=>20,'maxlength'=>20,'placeholder'=>'AAAA-MM-DD','readonly'=>false,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'source'); ?>
		<?php echo $form->textField($model,'source',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'source'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'payer_id'); ?>
		<?php echo  $form->dropDownList($model,'payer_id',Yii::app()->Controller->listaParties(),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'payer_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'payee_id'); ?>
		<?php echo  $form->dropDownList($model,'payee_id',Yii::app()->Controller->listaParties(),
											array('prompt'=>'--Seleccione un Valor--',
														'onchange'=>'','class'=>'form-control'
											)); ?>
		<?php echo $form->error($model,'payee_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'currency'); ?>
		<?php echo  $form->dropDownList($model,'currency',Yii::app()->Controller->listaMonedas(),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'relatedImplementationMilestone'); ?>
		<?php echo  $form->dropDownList($model,'relatedImplementationMilestone',Yii::app()->Controller->listaMilestone(),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'relatedImplementationMilestone'); ?>
	</div>

	<div class="form-group buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Save'); ?>
            <?php  //echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_desembolsos(); dialogoDeUpdate.dialog("close"); return false;'));  ?>

			<?php if ($model->isNewRecord==false) {


			     echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'update_documents(\'transactions\','.$model->id.');'));
				 echo CHtml::button('Cerrar', array('onclick' => 'dialogoDeUpdate.dialog("close"); return false;'));
			}else{
			      echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_documents(\'transactions\');'));
		    }

			?>

	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
