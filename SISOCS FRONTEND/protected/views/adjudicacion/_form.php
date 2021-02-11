<?php
/* @var $this AdjudicacionController */
/* @var $model Adjudicacion */
/* @var $form CActiveForm */
?>

<div class="container">

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'img-adjuntados-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data')
    ));
?>
<?php
    if(is_null($model->idAdjudicacion)){

    }else{

?>
<table width="50%" border="0" align="right">
	  <tr>
	    <td width="9%">&nbsp;</td>
            <td width="51%"><b>Contrataciones</b></td>
	    <td width="40%"></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td align="right">

                <style type="text/css">
                    .button {
                            background-color: #4CAF50; /* Green */
                            border: none;
                            color: white;
                            padding: 0px 24px;
                            text-align: center;
                            text-decoration: none;
                            display: inline-block;
                            font-size: 16px;
                            margin: 2px 1px;
                            -webkit-transition-duration: 0.4s; /* Safari */
                            transition-duration: 0.4s;
                            cursor: pointer;
}
                    .button5 {
                        background-color: white;
                        color: black;
                        border: 2px solid #555555;
                    }

                    .button5:hover {
                        background-color: #555555;
                        color: white;
                    }
                </style>
                <script type="text/javascript">
            function myFunction() {
                var x = document.getElementById("mySelect").value;
                //document.getElementById("demo").innerHTML = "You selected: " + x;
                 if(x=="create3"){
                     document.getElementById("demo").href="index.php?r=contratacion/create3&idCreate="+<?php echo $model->idAdjudicacion; ?>;

                }
                else if(x=="opcion"){
                    document.getElementById("demo").href="#";
                }
                else{
                    //alert(x);
                 document.getElementById("demo").href="index.php?r=contratacion/view&id="+x;

                }
                //
                ////else{
                    //document.getElementById("demo").href="index.php?r=calificacion/"+x;
                //}

            }
            </script>
             <select id="mySelect" onchange="myFunction()">
            <?php
            $ContratacionCrear="create3";

            $listaContra=$model->listaContrataciones($model->idAdjudicacion);
            echo '<option value="opcion">Seleccione una Opcion</option>';
            echo '<option value="'.$ContratacionCrear.'">Nuevo</option>';
            foreach($listaContra as $ids=>$nameCali){
                echo "<option value=".$ids.">".$nameCali."</option>";
            }

            ?>
		<!--<option value="TH">Thailand</option>
		<option value="EN">English</option>
		<option value="US">United States</option>-->
	</select>
        <a st="st" id="demo" class="button button5" href="#">Ir</a> <br></td>
	    <td align="left">&nbsp;</td>
      </tr>
  </table><?php } ?>
	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

  <p><?php echo $form->errorSummary($model); ?></p>
	<table width="100%" border="0" class="table table-borderless">
	  <tr>
	    <td colspan="2"><table width="100%" border="0" class="table table-borderless">
	      <tr>
	        <td width="41%"><span class="form-group"><?php echo $form->labelEx($model,'idCalificacion'); ?></span></td>
	        <td width="36%"><span class="form-group"><?php echo $form->labelEx($model,'numproceso'); ?></span></td>
	        <td width="23%">&nbsp;</td>
          </tr>
	      <tr>
	        <td><span class="form-group"><?php

				if(isset($_GET['idCreate'])){
					  		echo $form->dropDownList($model,'idCalificacion', $model->listaCalificacionID($_GET['idCreate'])
			,
                array(
				//'disabled'=>'disabled',
                    //'prompt'=>'Seleccione una opción',
                    'ajax'=>array(
                        'type'=>'POST',
                        'dataType'=>'json',
                        'data'=>array('idCalificacion'=>'js: $(this).val()', 'numproceso'=>'js: $("#Adjudicacion_idCalificacion option:selected").text()'),
                        'url'=>$this->createUrl('Adjudicacion/Proceso'),
                        'success'=>'function(data) {
                            $("#Adjudicacion_numproceso").val(data.numproceso);
                        	$("#Adjudicacion_nomprocesoproyecto").val(data.nompro);}',
                    )
                ));
                    //echo  $form->dropDownList($model,'idProyecto',$model->listaProyectos(),array('prompt'=>'--Seleccione un valor--'));
                }else if(isset($_GET['id'])){
						echo $form->dropDownList($model,'idCalificacion', $model->listaCalificacion()
						,
							array(
								'disabled'=>'disabled',
								'ajax'=>array(
									'type'=>'POST',
									'dataType'=>'json',
									'data'=>array('idCalificacion'=>'js: $(this).val()', 'numproceso'=>'js: $("#Adjudicacion_idCalificacion option:selected").text()'),
									'url'=>$this->createUrl('Adjudicacion/Proceso'),
									'success'=>'function(data) {
										$("#Adjudicacion_numproceso").val(data.numproceso);
										$("#Adjudicacion_nomprocesoproyecto").val(data.nompro);}',
								)
							));
                }else{
					echo $form->dropDownList($model,'idCalificacion', $model->listaCalificacion()
						,
							array(
								'prompt'=>'Seleccione una opción',
								'ajax'=>array(
									'type'=>'POST',
									'dataType'=>'json',
									'data'=>array('idCalificacion'=>'js: $(this).val()', 'numproceso'=>'js: $("#Adjudicacion_idCalificacion option:selected").text()'),
									'url'=>$this->createUrl('Adjudicacion/Proceso'),
									'success'=>'function(data) {
										$("#Adjudicacion_numproceso").val(data.numproceso);
										$("#Adjudicacion_nomprocesoproyecto").val(data.nompro);}',
								)
							));
				}
                ?> <?php echo $form->error($model,'idCalificacion'); ?></span></td>
	        <td><span class="form-group"><?php echo $form->textField($model,'numproceso',array('size'=>60,'maxlength'=>60)); ?> <?php echo $form->error($model,'numproceso'); ?></span></td>
	        <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
	  <tr>
	    <td colspan="2">&nbsp;</td>
      </tr>
      <!--
      <tr>
        <td>
            <?php
                echo $form->dropDownList($model,'currency', $model->listaCurrency());
            ?>

        </td>
       </tr>
     -->
	  <tr>
	    <td colspan="2"><table width="100%" border="0" class="table table-borderless">
	      <tr>
	        <td width="41%"><span class="form-group"><?php echo $form->labelEx($model,'idMetodoAdjudicacion'); ?></span></td>
	        <td width="36%"><span class="form-group"><?php echo $form->labelEx($model,'costoesti'); ?></span></td>
	        <td width="23%">&nbsp;</td>
          </tr>
	      <tr>
	        <td><span class="form-group"><?php echo $form->Dropdownlist($model, 'idMetodoAdjudicacion', $model->listaMetodAdjidicacion(), array('prompt'=>'Seleccione el metodo de adjudicación')); ?> <?php echo $form->error($model,'idMetodoAdjudicacion'); ?></span></td>
	        <td width="36%"><span class="form-group"><?php echo $form->textField($model,'costoesti'); ?> <?php echo $form->error($model,'costoesti'); ?></span></td>
	        <td width="23%">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
	  <tr>
	    <td colspan="2">&nbsp;</td>
      </tr>
	  <tr>
	    <td colspan="2"><span class="form-group"><?php echo $form->labelEx($model,'nparticipantes'); ?></span></td>
      </tr>
	  <tr>
	    <td width="41%"><span class="form-group"><?php echo $form->textField($model,'nparticipantes'); ?> <?php echo $form->error($model,'nparticipantes'); ?></span></td>
	    <td width="59%">&nbsp;</td>
      </tr>
	  <tr>
	    <td colspan="2">&nbsp;</td>
      </tr>

	  <tr>
      <td colspan="2">
        <div class="form-group container">
          <?php
            if ($model->isNewRecord) {
                echo '<p style="color:Red;">Guarde para poder agregar documentos</p>';
            } else {
                echo CHtml::ajaxLink(Yii::t('job', 'Agregar Documento'),
                                    $this->createUrl('awardDocuments/create', array('id'=>$model->idAdjudicacion)),
                                    array(    'success'=>'js:function(data) {
                                                    updateDialog.dialog("open");
                                                    document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                                    initDateInputs()
                                                }',
                                            'update' => '#filas_desembolsos'
                                    )
                            );

                $this->beginWidget('zii.widgets.jui.CJuiDialog',
                        array(
                            'id'=>'award-documents-form-dialog',
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

            } ?>
        </div>
        <div class="form-group">
            <div id="filas_desembolsos"></div>
        </div>
      </td>
    </tr>
	  <tr>
	    <td colspan="2">&nbsp;</td>
    </tr>
	  <tr>
	    <td colspan="2"><span class="form-group"><?php echo $form->labelEx($model,'estado'); ?> <?php echo  $form->dropDownList($model,'estado',$model->listaEstados(),array('prompt'=>'--Seleccione un valor--'));?> <?php echo $form->error($model,'estado'); ?></span></td>
    </tr>
    <tr>
	    <td colspan="2">&nbsp;</td>
    </tr>
	  <tr>
	    <td colspan="2"><span class="form-group">
          <?php
                $usuarioActual=Yii::app()->user->id;
                if ($model->isNewRecord) {
                  echo $form->hiddenField($model,'usuario_creacion',array('value'=>$usuarioActual));
                } else {
                  echo $form->hiddenField($model,'usuario_creacion',array('value'=>$model->usuario_creacion));
                }

                if ($model->isNewRecord) {
                    $fechaCreacion=date("Y-m-d H:i:s");
                    echo $form->hiddenField($model,'fecha_creacion',array('value'=>$fechaCreacion));
                }
          ?>
      </td>
    </tr>
    <tr>
	    <td colspan="2"><span class="form-group buttons"><?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks')); ?></span></td>
      </tr>
  </table>
	<p>&nbsp; </p>
	<div class="form-group buttons"></div>
<?php $this->endWidget(); ?>

</div><!-- form -->


<script type="text/javascript">
    function initDateInputs(){
      $("#AwardDocuments_datePublished").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });

      $("#AwardDocuments_dateModified").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });
    }
    function loadDocuments(){

        $('#filas_desembolsos').load('<?php echo CController::createUrl("adjudicacion/ViewDocuments", array("id"=>$model->idAdjudicacion, "event"=>"Update")); ?>');

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
        var data=$("#award-documents-form")[0];
        data = new FormData(data);


        $.ajax({
            type: 'POST',
            url: '<?php echo CController::createUrl("awardDocuments/create", array("id"=>$model->idAdjudicacion)); ?>',
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

    function update_documents(idawardDocuments)
    {
        $("input[id$='url']").each(function (i, el) {
            if ($(el).val().length == 0){
                //field cant be empty
                $(el).val("0");
            }
        });
        var data=$("#award-documents-form")[0];
        data = new FormData(data);

        $.ajax({
                type: 'POST',
                url: '<?php echo CController::createUrl("awardDocuments/update"); ?>'+'&id='+idawardDocuments,
                data:data,
                processData: false,  // Important!
                contentType: false,
                cache: false,
                success:function(data){
                    alert("Datos Actualizados correctamente!");
                    loadDocuments();
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

    function get_data_update(idawardDocuments){
        console.log(idawardDocuments)
        $.ajax({
                type: 'GET',
                url: '<?php echo CController::createUrl("awardDocuments/update"); ?>'+'&id='+idawardDocuments,
                success:function(data){
                  updateDialog.dialog("open");
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
        updateDialog = $("#award-documents-form-dialog").dialog({
        autoOpen: false,
        modal: true,
        width: 550,
        height:650,
        title: 'Details'
    });
        console.log(updateDialog)
    })

</script>

<?php
        $this->beginWidget('zii.widgets.jui.CJuiDialog',
        array(
            'id'=>'mydialog',
            'options'=>array(
            'title'=>'Almacenando Datos!',
            'autoOpen'=>false,
            'modal'=>true,
            'width'=>'400',
            'height'=>'150',
            'buttons'=>array(
                'Aceptar'=>'js:function(){$("#adjudicacion-form").submit()}',
                'Cancelar'=>'js:function(){$(this).dialog("close")}')
            ))
);
echo 'Desea guardar?';
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
