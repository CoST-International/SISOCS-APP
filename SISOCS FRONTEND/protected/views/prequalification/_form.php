<?php
/* @var $this PrequalificationController */
/* @var $model Prequalification */
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

<p class="note">Campos con <span class="required" style="color:red; font-size:18px;">*</span>&nbsp;  son requeridos.</p>

<?php echo $form->errorSummary($model); ?>
<div class="form-group">
	<?php /*echo $form->labelEx($model,'idProyecto'); */?>
</div>
	<div class="row">
		<?php echo $form->hiddenField($model, 'idProyecto', array('value'=>$idProyecto)); ?>
	</div>


	<?php
	echo '<div class="form-group">';
	echo $form->labelEx($model,'startDate');
	echo '</div>';
	echo '<div class="form-group">';
	echo $form->textField($model,'startDate',array('size'=>20,'maxlength'=>20,'placeholder'=>'AAAA/MM/DD','readonly'=>false,'class'=>'form-control' ));
	echo '</div>';
	echo $form->error($model,'startDate');


	echo '<div class="form-group">';
	echo $form->labelEx($model,'endDate');
	echo '</div>';
	echo '<div class="form-group">';
	echo $form->textField($model,'endDate',array('size'=>20,'maxlength'=>20,'placeholder'=>'AAAA/MM/DD','readonly'=>false,'class'=>'form-control' ));
	echo '</div>';
	echo $form->error($model,'endDate');


	echo '<div class="form-group"';
	echo $form->labelEx($model,'durationInDays');
	echo '</div>';
	echo '<div class="form-group">';
	echo $form->textField($model,'durationInDays',array('size'=>60,'maxlength'=>255,'class'=>'form-control', 'readonly'=>true));
	echo '</div>';
	echo $form->error($model,'durationInDays');


	echo '<div class="form-group">';
	echo $form->labelEx($model,'enquiryPeriod_startDate');
	echo '</div>';
	echo '<div class="form-group">';
	echo $form->textField($model,'enquiryPeriod_startDate',array('size'=>20,'maxlength'=>20,'placeholder'=>'AAAA/MM/DD','readonly'=>false,'class'=>'form-control' ));
	echo '</div>';
	echo $form->error($model,'enquiryPeriod_startDate');


	echo '<div class="form-group">';
	echo $form->labelEx($model,'enquiryPeriod_endDate');
	echo '</div>';
	echo '<div class="form-group">';
	echo $form->textField($model,'enquiryPeriod_endDate',array('size'=>20,'maxlength'=>20,'placeholder'=>'AAAA/MM/DD','readonly'=>false,'class'=>'form-control' ));
	echo '</div>';
	echo $form->error($model,'enquiryPeriod_endDate');


	echo '<div class="form-group">';
	echo $form->labelEx($model,'qualificationPeriod_startDate');
	echo '</div>';
	echo '<div class="form-group">';
	echo $form->textField($model,'qualificationPeriod_startDate',array('size'=>20,'maxlength'=>20,'placeholder'=>'AAAA/MM/DD','readonly'=>false,'class'=>'form-control' ));
	echo '</div>';
	echo $form->error($model,'qualificationPeriod_startDate');


	echo '<div class="form-group">';
	echo $form->labelEx($model,'qualificationPeriod_endDate');
	echo '</div>';
	echo '<div class="form-group">';
	echo $form->textField($model,'qualificationPeriod_endDate',array('size'=>20,'maxlength'=>20,'placeholder'=>'AAAA/MM/DD','readonly'=>false,'class'=>'form-control' ));
	echo '</div>';
	echo $form->error($model,'qualificationPeriod_endDate');

	echo '<div class="form-group">';
	echo $form->labelEx($model,'eligibilityCriteria');
	echo '</div>';
	echo '<div class="form-group">';
	echo $form->textField($model,'eligibilityCriteria',array('size'=>20,'maxlength'=>255,'class'=>'form-control', 'onclick'=>'console.log("Hola");'));
	echo '</div>';
	echo $form->error($model,'eligibilityCriteria');
	 ?>

	<div class="buttons">
    <?php //echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Save'); ?>
            <?php  //echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_desembolsos(); dialogoDeUpdate.dialog("close"); return false;'));  ?>

      <?php if ($model->isNewRecord==false) {


           echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'update_documents(\'prequalification\','.$model->id.');','class'=>'btn btn-success'));
         echo CHtml::button('Cerrar', array('onclick' => 'dialogoDeUpdate.dialog("close"); return false;','class'=>'btn btn-info'));
      }else{
            echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_documents(\'prequalification\');','class'=>'btn btn-success'));
        }

      ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
