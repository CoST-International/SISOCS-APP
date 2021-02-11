<?php
/* @var $this ProyectoMunicipioController */
/* @var $model ProyectoMunicipio */
/* @var $form CActiveForm */
?>

<div class="">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'proyecto-dialog-form',
	'enableClientValidation'=>true,
           'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'afterValidate'=>'js:$.yii.fix.ajaxSubmit.afterValidate'),
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="form-group">
        <?php echo $form->hiddenField($model, 'idProyecto', array('value'=>$idProyecto)); ?>
	</div>

	<div class="form-group">
		<?php //echo $form->labelEx($model,'idProyecto'); ?>
		<?php echo $form->hiddenField($model,'idProyecto',array('size'=>20,'maxlength'=>20, 'value'=>$idProyecto)); ?>
		<?php echo $form->error($model,'idProyecto'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'idDepartamento'); ?>
		<?php echo $form->dropDownList($model,"idDepartamento", $model->listaDepareamentos(),
										array(
											'empty' => 'Seleccione un Departamento',
											'onchange'=>'javascript: updateMunicipio(this.value);',
											'class'=>'form-control')
										); ?>
		<?php echo $form->error($model,'idDepartamento'); ?>
	</div>


	<div class="form-group">
		<?php echo $form->labelEx($model,'idMunicipio'); ?>
		<?php
			if($model->isNewRecord){
		 		echo $form->dropDownList($model,"idMunicipio", array(), array('empty'=>'Seleccione un municipio','class'=>'form-control') );
			}
			else {
				echo $form->dropDownList($model,"idMunicipio", Yii::app()->controller->listaMunicipio($model->idDepartamento), array('class'=>'form-control') );
			}
		 ?>
		<?php echo $form->error($model,'idMunicipio'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'beneficio'); ?>
		<?php echo $form->textArea($model,'beneficio',array('rows' => 6, 'cols' => 30,'class'=>'form-control')); ?>
                <?php //echo $form->textField($model,'beneficio',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'beneficio'); ?>
	</div>

	<div class="form-group buttons">

			<?php if ($model->isNewRecord==false) {


			     echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'update_documents(\'beneficiaries\','.$model->idMunicipio.','.$model->idDepartamento.','.$model->idProyecto.');','class'=>'btn btn-success'));
				 echo CHtml::button('Cerrar', array('onclick' => 'dialogoDeUpdate.dialog("close"); return false;','class'=>'btn btn-info'));
			}else{
			      echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_documents(\'beneficiaries\',true);','class'=>'btn btn-success'));
		    }

			?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
