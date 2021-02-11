<div class="form">
<?php $modelBudgetBreakDown=new BudgetBreakdown(); ?>
  <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'budget-breakdown-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
  )); ?>

    <p class="note">Campos con <span class="required" style="color:red; font-size:18px;">*</span>&nbsp;  son requeridos.</p>

    <?php echo $form->errorSummary($modelBudgetBreakDown); ?>
    <div class="row col-md-8">
      <?php echo $form->labelEx($modelBudgetBreakDown,'idProyecto'); ?>
    </div>
    <div class="row col-md-8">
      <?php
      if(isset($_GET['idCreate'])){
        echo  $form->textField($modelBudgetBreakDown,'idProyecto',array());
      }else if(isset($_GET['id'])){
        $iDP=Yii::app()->request->getQuery('id');
        echo  $form->textField($modelBudgetBreakDown,'idProyecto',array('value'=>$iDP,'disabled'=>'disabled'));
      }else{
      echo  $form->dropDownList($modelBudgetBreakDown,'idProyecto',array(),array('prompt'=>'--Seleccione un valor--'));
      }
       ?>
      <?php //echo $form->textField($modelBudgetBreakDown,'idProyecto',array('disabled'=>'disabled')); ?>
      <?php echo $form->error($modelBudgetBreakDown,'idProyecto'); ?>
    </div>



      <?php
        if (empty($iDP)) {
          $budgetBreakdownValues="";
        }

          echo '<div class="row col-md-8"';
          echo $form->labelEx($modelBudgetBreakDown,'description');
          echo '</div>';
          echo '<div class="row col-md-8">';
          echo $form->textArea($modelBudgetBreakDown,'description',array('size'=>60,'maxlength'=>255));
          echo '</div>';
          echo $form->error($modelBudgetBreakDown,'description');

          echo '<div class="row col-md-8">';
          echo $form->labelEx($modelBudgetBreakDown,'sourceParty_id');
          echo '</div>';
          echo '<div class="row col-md-8">';
          echo  $form->dropDownList($modelBudgetBreakDown,'sourceParty_id',$modelBudgetBreakDown->listaParties(),array('prompt'=>'--Seleccione un Valor--'));
          echo '</div>';
          echo $form->error($modelBudgetBreakDown,'sourceParty_id');

          echo '<div class="row col-md-8"';
          echo $form->labelEx($modelBudgetBreakDown,'amount');
          echo '</div>';
          echo '<div class="row col-md-8">';
          echo $form->textField($modelBudgetBreakDown,'amount');
          echo '</div>';
          echo $form->error($modelBudgetBreakDown,'amount');

          echo '<div class="row col-md-8">';
          echo $form->labelEx($modelBudgetBreakDown,'currency');
          echo '</div>';
          echo '<div class="row col-md-8">';
          echo $form->textField($modelBudgetBreakDown,'currency');
          echo '</div>';
          echo $form->error($modelBudgetBreakDown,'currency');

          echo '<div class="row col-md-8">';
          echo $form->labelEx($modelBudgetBreakDown,'startDate');
          echo '</div>';
          echo '<div class="row col-md-8">';
          echo $form->textField($modelBudgetBreakDown,'startDate',array('size'=>20,'maxlength'=>20,'placeholder'=>'DD/MM/AAAA','readonly'=>false ));
          echo '</div>';
          echo $form->error($modelBudgetBreakDown,'startDate');


          echo '<div class="row col-md-8">';
          echo $form->labelEx($modelBudgetBreakDown,'startDate');
          echo '</div>';
          echo '<div class="row col-md-8">';
          echo $form->textField($modelBudgetBreakDown,'endDate',array('size'=>20,'maxlength'=>20,'placeholder'=>'DD/MM/AAAA','readonly'=>false ));
          echo '</div>';
          echo $form->error($modelBudgetBreakDown,'endDate');





       ?>



    <?php echo CHtml::hiddenField('eje' , 1, array('id' => 'eje')); ?>

    <?php
      echo CHtml::hiddenField('idProyecto' , $iDP, array('idProyecto' => $iDP));
    ?>
    <div class="row buttons col-md-8">

    </div>
    <div class="row col-md-8">
      <?php if ($model->isNewRecord==false) {


			     echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'update_documents(\'desembolso\','.$model->idDesembolso.');'));
				 echo CHtml::button('Cerrar', array('onclick' => 'updateDialog.dialog("close"); return false;'));
			}else{
			      echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_BudgetBreakdown(\'desembolso\');'));
		    }

			?>
    </div>
  <?php $this->endWidget(); ?>

</div><!-- form -->
