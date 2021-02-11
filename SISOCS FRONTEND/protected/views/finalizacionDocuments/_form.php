<?php
/* @var $this TenderDocumentsController */
/* @var $model TenderDocuments */
/* @var $form CActiveForm */
?>

<div class="">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tender-documents-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">

		<?php echo $form->hiddenField($model,'idFinalizacion',array('value'=>$idFinalizacion)); ?>

	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'documentType'); ?>
		<?php echo  $form->dropDownList($model,'documentType',Yii::app()->controller->listarDocumentType(),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'documentType'); ?>
	</div>

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
		<?php echo $form->labelEx($model,'pageStart'); ?>
		<?php echo $form->textField($model,'pageStart',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'pageStart'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'pageEnd'); ?>
		<?php echo $form->textField($model,'pageEnd',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'pageEnd'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php
				echo $form->textField($model,'url',array('class'=>'form-control'));
				echo $form->fileField($model, 'uploadDocument');
		?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'datePublished'); ?>
		<?php echo $form->textField($model,'datePublished',array('class'=>'form-control', 'placeholder'=>'aaaa-mm-dd')); ?>
		<?php echo $form->error($model,'datePublished'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'dateModified'); ?>
		<?php echo $form->textField($model,'dateModified',array('class'=>'form-control', 'placeholder'=>'aaaa-mm-dd')); ?>
		<?php echo $form->error($model,'dateModified'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'accessDetails'); ?>
		<?php echo $form->textField($model,'accessDetails',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'accessDetails'); ?>
	</div>

	<div class="form-group buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Save'); ?>
            <?php  //echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_desembolsos(); $("#update-dialog").dialog("close"); return false;'));  ?>

			<?php if ($model->isNewRecord==false) {

			     echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'update_documents('.$model->id.');','class'=>'btn btn-success'));
				 echo CHtml::button('Cerrar', array('onclick' => 'updateDialog.dialog("close"); return false;','class'=>'btn btn-info'));
			}else{
			      echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_documents();','class'=>'btn btn-success'));
		    }

			?>

	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
