<?php
/* @var $this FinanceController */
/* @var $model Finance */
/* @var $form CActiveForm */
?>

<div class="form">

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
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>



	<div class="form-group">
		<?php echo $form->labelEx($model,'financingParty_id'); ?>
		<?php echo  $form->dropDownList($model,'financingParty_id',Yii::app()->controller->listaParties(),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'financingParty_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'financeCategory'); ?>
		<?php echo  $form->dropDownList($model,'financeCategory',Yii::app()->controller->listaFinanceCategory(),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'financeCategory'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'amount'); ?><br>
		<?php echo $form->textField($model,'amount',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'currency'); ?>
		<?php echo  $form->dropDownList($model,'currency',Yii::app()->controller->listaMonedas(),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'currency'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'startDate'); ?><br>
		<?php echo $form->textField($model,'startDate',array('placeholder'=>'AAAA-MM-DD','class'=>'form-control')); ?>
		<?php echo $form->error($model,'startDate'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'endDate'); ?><br>
		<?php echo $form->textField($model,'endDate',array('placeholder'=>'AAAA-MM-DD','class'=>'form-control')); ?>
		<?php echo $form->error($model,'endDate'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'interestRate_base'); ?><br>
		<?php echo $form->textField($model,'interestRate_base',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'interestRate_base'); ?>
	</div>

	<!-- <div class="form-group"> -->
		<?php //echo $form->labelEx($model,'interestRate_margin'); ?>
		<?php //echo $form->textField($model,'interestRate_margin',array('class'=>'form-control')); ?>
		<?php //echo $form->error($model,'interestRate_margin'); ?>
	<!-- </div> -->

	<!-- <div class="form-group"> -->
		<?php //echo $form->labelEx($model,'interestRate_fixed'); ?>
		<?php //echo $form->textField($model,'interestRate_fixed',array('class'=>'form-control')); ?>
		<?php //echo $form->error($model,'interestRate_fixed'); ?>
	<!-- </div> -->

	<!-- <div class="form-group"> -->
		<?php //echo $form->labelEx($model,'stepInRights'); ?>
		<?php //echo $form->textField($model,'stepInRights',array('class'=>'form-control')); ?>
		<?php //echo $form->error($model,'stepInRights'); ?>
	<!-- </div> -->

	<!-- <div class="form-group"> -->
		<?php //echo $form->labelEx($model,'exchangeRateGuarantee'); ?>
		<?php //echo $form->textField($model,'exchangeRateGuarantee',array('class'=>'form-control')); ?>
		<?php //echo $form->error($model,'exchangeRateGuarantee'); ?>
	<!-- </div> -->

	<div class="form-group">
		<?php echo $form->labelEx($model,'repaymentFrequency'); ?><br>
		<?php echo $form->textField($model,'repaymentFrequency',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'repaymentFrequency'); ?>
	</div>

	<div class="buttons">
		<?php
				if ($model->isNewRecord==false) {
					 echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'update_documents(\'finance\','.$model->id.');','class'=>'btn btn-success'));
					 echo CHtml::button('Cerrar', array('onclick' => 'dialogoDeUpdate.dialog("close"); return false;','class'=>'btn btn-info'));
				}else{
					  echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_documents(\'finance\');','class'=>'btn btn-success'));
				}

		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
