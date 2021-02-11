<div class="">
<script type="text/javascript">

</script>

<?php //$model=new BudgetBreakdown(); ?>
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

  <div class="row">
    <?php echo $form->hiddenField($model, 'idProyecto', array('value'=>$idProyecto)); ?>
  </div>



      <?php
        if (empty($idProyecto)) {
          $budgetBreakdownValues="";
        }

          echo '<div class="form-group"';
          echo $form->labelEx($model,'description');
          echo '</div>';
          echo '<div class="form-group">';
          echo $form->textArea($model,'description',array('size'=>60,'maxlength'=>255,'class'=>'form-control'));
          echo '</div>';
          echo $form->error($model,'description');

          echo '<div class="form-group">';
          echo $form->labelEx($model,'sourceParty_id');

          echo  $form->dropDownList($model,'sourceParty_id',Yii::app()->Controller->listaParties(),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control'));
          echo '</div>';
          echo $form->error($model,'sourceParty_id');

          echo '<div class="form-group"';
          echo $form->labelEx($model,'amount');
          echo '</div>';
          echo '<div class="form-group">';
          echo $form->textField($model,'amount',array('class'=>'form-control'));
          echo '</div>';
          echo $form->error($model,'amount');

          echo '<div class="form-group">';
          echo $form->labelEx($model,'currency');

          echo  $form->dropDownList($model,'currency',Yii::app()->controller->listaMonedas(),array('prompt'=>'--Seleccione un valor--','class'=>'form-control'));
          echo '</div>';
          echo $form->error($model,'currency');

          echo '<div class="form-group">';
          echo $form->labelEx($model,'startDate');

          echo $form->textField($model,'startDate',array('size'=>20,'maxlength'=>20,'placeholder'=>'AAAA-MM-DD','readonly'=>false,'class'=>'form-control'));
          echo '</div>';
          echo $form->error($model,'startDate');


          echo '<div class="form-group">';
          echo $form->labelEx($model,'endDate');
          echo $form->textField($model,'endDate',array('size'=>20,'maxlength'=>20,'placeholder'=>'AAAA-MM-DD','readonly'=>false,'class'=>'form-control'));
          echo '</div>';
          echo $form->error($model,'endDate');





       ?>



    <?php echo CHtml::hiddenField('eje' , 1, array('id' => 'eje')); ?>


    <div class="row buttons col-md-8">

    </div>
    <div class="form-group"><br>
    <?php //echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Save'); ?>
            <?php  //echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_desembolsos(); dialogoDeUpdate.dialog("close"); return false;'));  ?>

      <?php if ($model->isNewRecord==false) {


           echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'update_documents(\'budget\','.$model->id.');','class'=>'btn btn-success'));
         echo CHtml::button('Cerrar', array('onclick' => 'dialogoDeUpdate.dialog("close"); return false;','class'=>'btn btn-info'));
      }else{
            echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_documents(\'budget\');','class'=>'btn btn-success'));
        }

      ?>
    </div>
  <?php $this->endWidget(); ?>

</div><!-- form -->
