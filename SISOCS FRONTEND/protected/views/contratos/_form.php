<?php
/* @var $this ContratosController */
/* @var $model Contratos */
/* @var $form CActiveForm */


if (isset($_GET['idCreate'])){
    $model->idContratacion = $_GET['idCreate'];
    echo '<h1>'.$model->idContratacion0["titulocontrato"].'</h1>';
}


?>

<div class="">


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contratos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	 'enableAjaxValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

  <p><?php echo $form->errorSummary($model); ?></p>
	<table width="100%" border="0" class="table table-borderless">
	  <tr>
	    <td><table width="100%" border="0" class="table table-borderless">
	      <tr>
	        <td width="45%"><span class="form-group"><?php echo $form->labelEx($model,'idContratacion'); ?></span><span class="form-group">
	          <?php
				if(isset($_GET['idCreate'])){
				     echo  $form->dropDownList($model,'idContratacion',$model->listaContratacionID($_GET['idCreate']), array('enable'=>'true'));
                }else if(isset($_GET['id'])){
					echo  $form->dropDownList($model,'idContratacion',$model->listaContratacion(),array('prompt'=>'--Seleccione un valor--','disabled'=>'disabled'));
                }else{
					echo  $form->dropDownList($model,'idContratacion',$model->listaContratacion(),array('prompt'=>'--Seleccione un valor--'));
				}
			?>
	        </span></td>
	        <td width="36%"><span class="form-group"><?php echo $form->labelEx($model,'nmodifica'); ?><?php echo $form->textField($model,'nmodifica'); ?> <?php echo $form->error($model,'nmodifica'); ?></span></td>
	        <td width="19%">&nbsp;</td>
          </tr>
	      <tr>
	        <td><?php echo $form->error($model,'idContratacion'); ?></td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
	  <tr>
	    <td><table width="100%" border="0" class="table table-borderless">
	      <tr>
	        <td width="45%"><span class="form-group"><?php echo $form->labelEx($model,'fecha'); ?></span></td>
	        <td width="36%"><span class="form-group"><?php echo $form->labelEx($model,'tipomodifica'); ?></span></td>
	        <td width="19%">&nbsp;</td>
          </tr>
	      <tr>
	        <td><span class="form-group">
	          <?php
                            if ($model->fecha!='') {
                                $model->fecha=date('Y-m-d',strtotime($model->fecha));
                            }
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model'=>$model,
                            'attribute'=>'fecha',
                            'value'=>$model->fecha,
                            'language' => 'es',
                            'htmlOptions' => array('readonly'=>"readonly"),

                            'options'=>array(
                            'autoSize'=>true,
                            'defaultDate'=>$model->fecha,
                            'dateFormat'=>'yy-mm-dd',
                            'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.gif',
                            'buttonImageOnly'=>true,
                            'buttonText'=>' Click aqui',
                            'selectOtherMonths'=>true,
                            'showAnim'=>'slide',
                            'showButtonPanel'=>true,
                            'showOn'=>'button',
                            'showOtherMonths'=>true,
                            'changeMonth' => 'true',
                            'changeYear' => 'true',
                            'yearRange'=>'-50:+50',
                            ),
                        )); ?>
            <?php echo $form->error($model,'fecha'); ?></span></td>
	        <td width="36%"><span class="form-group"><?php echo $form->dropDownList($model,'tipomodifica',CHtml::listData(TipoModContrato::model()->findAll(), 'tipo_modificacion', 'tipo_modificacion')); ?> <?php echo $form->error($model,'tipomodifica'); ?></span></td>
	        <td width="19%">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td><span class="form-group"><?php echo $form->labelEx($model,'justimodcontrato'); ?></span></td>
      </tr>
	  <tr>
	    <td><span class="form-group"><?php echo $form->textArea($model,'justimodcontrato',array('rows'=>5, 'cols'=>60)); ?> <?php echo $form->error($model,'justimodcontrato'); ?></span></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td><table width="100%" border="0" class="table table-borderless">
	      <tr>
	        <td width="45%"><span class="form-group"><?php echo $form->labelEx($model,'precioactual'); ?></span></td>
	        <td width="36%"><span class="form-group"><?php echo $form->labelEx($model,'fechatercontra'); ?></span></td>
			    <td width="36%"><span class="form-group"><?php echo $form->labelEx($model,'justificacion_fechatercontra'); ?></span></td>
          
	        <td width="19%">&nbsp;</td>
          </tr>
	      <tr>
	        <td><span class="form-group"><?php echo $form->textField($model,'precioactual'); ?> <?php echo $form->error($model,'precioactual'); ?></span></td>
	        <td width="36%"><span class="form-group">
	          <?php
                            if ($model->fechatercontra!='') {
                                $model->fechatercontra=date('Y-m-d',strtotime($model->fechatercontra));
                            }
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model'=>$model,
                            'attribute'=>'fechatercontra',
                            'value'=>$model->fechatercontra,
                            'language' => 'es',
                            'htmlOptions' => array('readonly'=>"readonly"),

                            'options'=>array(
                            'autoSize'=>true,
                            'defaultDate'=>$model->fechatercontra,
                            'dateFormat'=>'yy-mm-dd',
                            'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.gif',
                            'buttonImageOnly'=>true,
                            'buttonText'=>' Click aqui',
                            'selectOtherMonths'=>true,
                            'showAnim'=>'slide',
                            'showButtonPanel'=>true,
                            'showOn'=>'button',
                            'showOtherMonths'=>true,
                            'changeMonth' => 'true',
                            'changeYear' => 'true',
                            'yearRange'=>'-50:+50'
                            ),
                        )); ?>
            <?php echo $form->error($model,'fechatercontra'); ?></span></td>
			<td><span class="form-group"><?php echo $form->textArea($model,'justificacion_fechatercontra'); ?> <?php echo $form->error($model,'justificacion_fechatercontra'); ?></span></td>
      
	        <td width="19%">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="36%"><span class="form-group"><?php echo $form->labelEx($model,'justificacion_fecha_final'); ?></span></td>

      </tr>
      <tr>
        <td><span class="form-group"><?php echo $form->textArea($model,'justificacion_fecha_final'); ?> <?php echo $form->error($model,'justificacion_fecha_final'); ?></span></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td><span class="form-group"><?php echo $form->labelEx($model,'alcanceactucontrato'); ?></span></td>
      </tr>
	  <tr>
	    <td><span class="form-group"><?php echo $form->textArea($model,'alcanceactucontrato',array('rows'=>5, 'cols'=>60)); ?> <?php echo $form->error($model,'alcanceactucontrato'); ?></span></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
		  <td>
	  <?php
		  if ($model->isNewRecord) {
				  echo '<p style="color:Red;">Guarde para poder agregar documentos</p>';
		  } else {
				  echo CHtml::ajaxLink(Yii::t('job', 'Agregar Documentos'),
									  $this->createUrl('ContratosDocuments/create', array('id'=>$model->idContratos)),
									  array(    'success'=>'js:function(data) {
													  updateDialog.dialog("open");
													  document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
													  initDateInputs();
												  }',
											  'update' => '#filas_desembolsos'
									  ),array('class'=>'specialLinks')
							  );


	  }
	  $this->beginWidget('zii.widgets.jui.CJuiDialog',
			  array(
				  'id'=>'tender-documents-form-dialog',
					  'options'=>array(
						  'title'=>Yii::t('job', 'Agregar Documento'),
										  'autoOpen'=>false,
										  'modal'=>'true',
										  'resizeable'=>true,
										  'show' => 'fold',
										  'hide' => 'drop',
										  'width'=>600,
										  'height'=>650,
										  'overlay'=>array('backgroundColor'=>'#000','opacity'=>'3.5'),
					  ),
			  )
			  );

	  echo "<div id='ContenidoAgregarDocuments'></div>";

	  if (Yii::app()->user->hasFlash('Error')) {
		  echo '<div class="flash-success">';
		  echo Yii::app()->user->getFlash('Error');
		  echo '</div>';
	  }

	  $this->endWidget('zii.widgets.jui.CJuiDialog');

  ?>
  <div class="container">
	<div class="form-group">
		<div id="filas_desembolsos"></div>
	</div>
  </div>
  </td>
  </tr>

	  <tr>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td><span class="form-group">
	      <?php //echo $form->labelEx($model,'usuario_creacion'); ?>
          <?php

                if ($model->isNewRecord) {
                    $fechaCreacion=date("Y-m-d H:i:s");
                echo $form->hiddenField($model,'fecha_creacion',array('value'=>$fechaCreacion));
            }
            else {
                //echo $usuarioActual;
                echo $form->labelEx($model,'fecha_creacion');
            ?>
          <?php echo $form->textField($model,'fecha_creacion',array('value'=>$model->fecha_creacion,'disabled'=>'true')); ?>
          <?php } ?>
        <?php echo $form->error($model,'fecha_creacion'); ?></span></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td><span class="form-group"><?php echo $form->labelEx($model,'estado'); ?></span></td>
      </tr>
	  <tr>
	    <td><span class="form-group">
	      <?php //echo $form->textField($model,'estado',array('size'=>25,'maxlength'=>25));
			echo  $form->dropDownList($model,'estado',$model->listaEstados(),array('prompt'=>'--Seleccione un valor--'));?>
        <?php echo $form->error($model,'estado'); ?></span></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
      </tr>
  </table>
	<p>&nbsp; </p>
	<div class="form-group"></div>

	<div class="form-group"></div>

	                    <div class="form-group"></div>

	<div class="form-group"></div>

	<div class="form-group"></div>

	<div class="form-group"></div>

	                    <div class="form-group"></div>

	<div class="form-group"></div>

	<div class="form-group"></div>

	<div class="form-group"></div>

	<div class="form-group"></div>



	<?php /*if (!$model->isNewRecord) {
				echo '	<div class="form-group">';
				echo $form->labelEx($model,'fechacreacion');
				echo $form->textField($model,'fechacreacion',array('disabled'=>'true','value' => date('d/m/Y', $model->fechacreacion)));
				echo $form->error($model,'fechacreacion');
				echo '  </div>';

				if (!empty($model->fechapublicado)) {
					echo '	<div class="form-group">';
					echo $form->labelEx($model,'fechapublicado');
					echo $form->textField($model,'fechapublicado',array('disabled'=>'true', 'value' => date("d-M-Y",strtotime($model->fechapublicado))));
					echo $form->error($model,'fechapublicado');
					echo '  </div>';
				}
			  }	*/
	?>

         <div class="form-group"></div>

          <div class="form-group">
            <?php //echo $form->labelEx($model,'usuario_creacion'); ?>
            <?php
                $usuarioActual=Yii::app()->user->id;
                if ($model->isNewRecord) {
                echo $form->hiddenField($model,'usuario_creacion',array('value'=>$usuarioActual));
            }
            else {
                //echo $usuarioActual;
            ?>
		<?php echo $form->hiddenField($model,'usuario_creacion',array('value'=>$model->usuario_creacion)); ?>
            <?php } ?>
                <?php echo $form->error($model,'usuario_creacion'); ?>
	</div>

	<div class="form-group"></div>



	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    function initDateInputs(){
      $("#ContratosDocuments_datePublished").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });
      $("#ContratosDocuments_dateModified").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });
    }

    function loadDocuments(){
      console.log("Calling this");
        $('#filas_desembolsos').load('<?php echo CController::createUrl("/Contratos/ViewDocumentsDetails", array("id"=>$model->idContratos, "event"=>"Update")); ?>');

    }
      <?php if (!$model->isNewRecord) {
              echo 'loadDocuments();';
          }
    ?>

    function send_documents()
    {
    $("input[id$='url']").each(function (i, el) {
      if ($(el).val().length == 0){
        //field cant be empty
        $(el).val("0");
      }
    });
        var data=$("#tender-documents-form")[0];
        data = new FormData(data);

        $.ajax({
            type: 'POST',
            url: '<?php echo CController::createUrl("ContratosDocuments/create", array("id"=>$model->idContratos)); ?>',
            data:data,
            processData: false,  // Important!
            contentType: false,
            cache: false,
            success:function(data){
                alert("Datos agregados correctamente!");
                loadDocuments();
                updateDialog.dialog("close");
            },
            error: function(data) { // if error occured
                alert("Error el documento ya existe!");
                alert("Error: " + JSON.stringify(data));
            },
            dataType:'html'
        }
        );
    }

    function update_documents(idTenderDocuments)
    {
    $("input[id$='url']").each(function (i, el) {
      if ($(el).val().length == 0){
        //field cant be empty
        $(el).val("0");
      }
    });
        var data=$("#tender-documents-form")[0];
        data = new FormData(data);

        $.ajax({
                type: 'POST',
                url: '<?php echo CController::createUrl("ContratosDocuments/update"); ?>'+'&id='+idTenderDocuments,
                data:data,
                processData: false,  // Important!
                contentType: false,
                cache: false,
                success:function(data){
                    alert("Datos Actualizados correctamente!");
                    loadDocuments();
                    $("#update-dialog").dialog("close");
					updateDialog.dialog("close");
                },
                error: function(data) { // if error occured
                    alert("Error al actulizar documento!");
                    alert("Error: " + JSON.stringify(data));
                },
                dataType:'html'
            }
        );
    }

    function get_data_update(idTenderDocuments){
       updateDialog.dialog("open");
        $.ajax({
                type: 'GET',
                url: '<?php echo CController::createUrl("ContratosDocuments/update"); ?>'+'&id='+idTenderDocuments,
                success:function(data){
                  document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                  initDateInputs();
                },
                error: function(data) { // if error occured
                    alert("Error al actulizar documento!");
                    alert("Error: " + JSON.stringify(data));
                },
                dataType:'html'
            }
        );
    }

    var updateDialog;
    $(document).ready(function(){
        updateDialog = $('#tender-documents-form-dialog').dialog({
        autoOpen: false,
        modal: true,
        width: 550,
        height:650,
        title: 'Details'
    });
        console.log(updateDialog)
    })
  $(document).ready(function(){
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
        .columns.adjust()
        .responsive.recalc();
    });
  })
</script>
