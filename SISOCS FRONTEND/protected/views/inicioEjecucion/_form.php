<?php
    /* @var $this InicioEjecucionController */
    /* @var $model InicioEjecucion */
    /* @var $form CActiveForm */


    $lat1=15.4365949;
    $lon1=-87.9808419;

    $lat2=15.4696470;
    $lon2=-88.0057300;
    $this->beginWidget('zii.widgets.jui.CJuiDialog',
                        array(
                            'id'=>'inicio-ejecucion-form-dialog',
                                'options'=>array(
                                    'title'=>Yii::t('job', 'Gestion Elemento'),
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

<script type="text/javascript">
  function CalculaDuracionEnDias(){

    $("#Tariffs_durationInDays")
    .focus(
    function(){
        var start = $('#Tariffs_startDate').datepicker('getDate');
        var end   = $('#Tariffs_endDate').datepicker('getDate');
        var days   = (end - start)/1000/60/60/24;
        if (start!=null)
            {
            $('#Tariffs_durationInDays').val(days);
            }
        });
  }
  function f_carga_Datos_Contacto(){
      //alert($("#InicioEjecucion_idContacto").val());
      $("#Contatos_tel01").val($("#InicioEjecucion_idContacto").val());
      $("#Contatos_email01").val($("#InicioEjecucion_idContacto").val());
  }
  $(document).ready(function(){
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
        .columns.adjust()
        .responsive.recalc();
    });
  })

</script>
<div class="tab-content">
      <ul class="nav nav-pills nav-fill" role="tablist">
        <li class="nav-item "><a class="nav-link active" data-toggle="tab" href="#home">Implementación</a></li>
        <li class="nav-item "><a class="nav-link" data-toggle="tab" href="#menu1">Documentos</a></li>
        <li class="nav-item "><a class="nav-link" data-toggle="tab" href="#menu2">Hito</a></li>
        <li class="nav-item "><a class="nav-link" data-toggle="tab" href="#menu3">Tarifas</a></li>
        <li class="nav-item "><a class="nav-link" data-toggle="tab" href="#menu4">Transacciones</a></li>
        <li class="nav-item "><a class="nav-link" data-toggle="tab" href="#menu5">KPI</a></li>

      </ul>

        <div id="home" class="tab-pane fade in active">

            <?php $form=$this->beginWidget('CActiveForm', array(
                      'id'=>'inicio-ejecucion-form',
                      // Please note: When you enable ajax validation, make sure the corresponding
                      // controller action is handling ajax validation correctly.
                      // There is a call to performAjaxValidation() commented in generated controller code.
                      // See class documentation of CActiveForm for details on this.
                      'enableAjaxValidation' => true,
                      'htmlOptions' => array('enctype' => 'multipart/form-data'),
                  )); ?>

        	<p class="note">Campos con  <span class="required">*</span> son requeridos.</p>

        	<?php echo $form->errorSummary($model); ?>

                <table class="center" width="100%" class="table table-borderless">
                    <tr>
                        <td colspan="2">
                            <div class="form-group">
                                <?php echo $form->hiddenField($model, 'idInicioEjecucion', array('size'=>20,'maxlength'=>20,'class'=>'idcod')); ?>
                                <?php echo $form->labelEx($model, 'idContratacion'); ?>
                                <?php echo $form->dropDownList($model, 'idContratacion', $model->listaContratacion(), array('prompt'=>'Seleccione...'));?>
                                <?php echo $form->error($model, 'idContratacion'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'idContacto'); ?>
                                <?php echo $form->dropDownList($model, 'idContacto', $model->listaContactos(), array('onchange'=>'f_carga_Datos_Contacto()','prompt'=>'Seleccione...'));?>
                                <?php echo $form->error($model, 'idContacto'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label>Tel&eacute;fono:</label>
                                <?php //$form->textField($model->codContacto01,'telefono');?>
                                <?php //echo  CHtml::listData(Contactos::model()->findAll(),'codigo', 'telefono');?>
                                <?php echo CHtml::dropDownList('Contatos_tel01', 'idContacto', array(
                                           CHtml::listData(Contactos::model()->findAll(), 'idContacto', 'telefono')
                                           ), array('empty'=>'Sin seleccionar', 'prompt'=>'Sin seleccionar','disabled'=>'disabled')); ?>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label>Correo electr&oacute;nico:</label>
                                <?php echo CHtml::dropDownList('Contatos_email01', 'idContacto', array(
                                           CHtml::listData(Contactos::model()->findAll(), 'idContacto', 'email'),
                                           ), array('empty'=>'Sin seleccionar', 'prompt'=>'Sin seleccionar','disabled'=>'disabled')); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'fecha_inicio'); ?>
                                <?php
                                    if ($model->fecha_inicio!='') {
                                        $model->fecha_inicio=date('Y-m-d', strtotime($model->fecha_inicio));
                                    }
                                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'model'=>$model,
                                    'attribute'=>'fecha_inicio',
                                    'value'=>$model->fecha_inicio,
                                    'language' => 'es',
                                    'htmlOptions' => array('readonly'=>"readonly"),
                                    'options'=>array(
                                    'autoSize'=>true,
                                    'defaultDate'=>$model->fecha_inicio,
                                    'dateFormat'=>'yy-mm-dd',
                                    'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.gif',
                                    'buttonImageOnly'=>true,
                                    'buttonText'=>' Click aqui',
                                    'selectOtherMonths'=>true,
                                    'yearRange'=>'-10:+20',
                                    'showAnim'=>'slide',
                                    'showButtonPanel'=>true,
                                    'showOn'=>'button',
                                    'showOtherMonths'=>true,
                                    'changeMonth' => 'true',
                                    'changeYear' => 'true',
                                    ),
                                )); ?>
                                <?php echo $form->error($model, 'fecha_inicio'); ?>
                            </div>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                </table>

        		<table class="center" width="100%" class="table table-borderless"><caption>Plan de Desembolsos</caption>
        			<tr>
        				<td>
        			        <div class="form-group" >
        			            <!-- //////////////////////////////////////////////////////////////////////// -->
        			            <?php
                                    if ($model->isNewRecord) {
                                        echo '<p style="color:Red;">Guarde para poder agregar Desembolsos</p>';
                                    } else {
                                        echo CHtml::ajaxLink(Yii::t('job', 'Agregar Desembolsos'),
                                            $this->createUrl('desembolsosMontos/create', array('id'=>$model->idInicioEjecucion)),
                                            array(    'success'=>'js:function(data) {
									                    	dialogoDeUpdate.dialog("open");
									                    	document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                        initDateInputs()
		                								}',
                                                    'update' => '#filas_desembolsos'
                                            ),array('class'=>'specialLinks')
                                    );

                                    } ?>
        			        </div>
        			        <div class="form-group">
        			            <div id="filas_desembolsos"></div>
        			        </div>
                      <!-- //////////////////////////////////////////////////////////////////////// -->

            			</td>
            		</tr>
            	</table>
            <div class="form-group">
                 <?php echo $form->labelEx($model, 'estado'); ?>
                 <?php echo $form->dropDownList($model, 'estado', $model->listaEstados());?>
                 <?php echo $form->error($model, 'estado'); ?>
            </div>
            <br/>

            <div class="buttons">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks')); ?>
            </div>

            <?php $this->endWidget(); ?>
        </div><!-- form -->
        <div id="menu1" class="tab-pane fade" style="overflow:hidden;">
          <?php
            if ($model->isNewRecord) {
                echo '<p style="color:Red;">Guarde para poder agregar documentos</p>';
            } else {
                echo CHtml::ajaxLink(Yii::t('job', 'Agregar Documento'),
                    $this->createUrl('implementationDocuments/create', array('id'=>$model->idInicioEjecucion)),
                    array(    'success'=>'js:function(data) {
                                    dialogoDeUpdate.dialog("open");
                                    document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                    initDateInputs()
                                }',
                            'update' => '#filas_documentos'
                    ),array('class'=>'specialLinks')
                );
            } ?>
            <div class="form-group">
                <div id="filas_documentos"></div>
            </div>
        </div>
        <div id="menu2" class="tab-pane fade" style="overflow:hidden;">
          <?php
            if ($model->isNewRecord) {
                echo '<p style="color:Red;">Guarde para poder agregar esta sección</p>';
            } else {
                echo CHtml::ajaxLink(Yii::t('job', 'Agregar Mielstone'),
                    $this->createUrl('implementationMilestone/create', array('id'=>$model->idInicioEjecucion)),
                    array(    'success'=>'js:function(data) {
                                    dialogoDeUpdate.dialog("open");
                                    document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                    initDateInputs()
                                }',
                            'update' => '#filas_milestone'
                    ),array('class'=>'specialLinks')
                );
            } ?>
            <div class="form-group">
                <div id="filas_milestone"></div>
            </div>
        </div>
        <div id="menu3" class="tab-pane fade" style="overflow:hidden;">
          <?php
            if ($model->isNewRecord) {
                echo '<p style="color:Red;">Guarde para poder agregar esta sección</p>';
            } else {
                echo CHtml::ajaxLink(Yii::t('job', 'Agregar Tarifas'),
                    $this->createUrl('Tariffs/create', array('id'=>$model->idInicioEjecucion)),
                    array(    'success'=>'js:function(data) {
                                    dialogoDeUpdate.dialog("open");
                                    document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                    initDateInputs();
                                    CalculaDuracionEnDias();
                                }',
                            'update' => '#filas_tariffs'
                    ),array('class'=>'specialLinks')
                );
            } ?>
            <div class="form-group">
                <div id="filas_tariffs"></div>
            </div>
        </div>
        <div id="menu4" class="tab-pane fade" style="overflow:hidden;">
          <?php
            if ($model->isNewRecord) {
                echo '<p style="color:Red;">Guarde para poder agregar esta sección</p>';
            } else {
                echo CHtml::ajaxLink(Yii::t('job', 'Agregar Transacciones'),
                    $this->createUrl('transactions/create', array('id'=>$model->idInicioEjecucion)),
                    array(    'success'=>'js:function(data) {
                                    dialogoDeUpdate.dialog("open");
                                    document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                    initDateInputs()
                                }',
                            'update' => '#filas_transaction'
                    ),array('class'=>'specialLinks')
                );
            } ?>
            <div class="form-group">
                <div id="filas_transaction"></div>
            </div>
        </div>

        <div id="menu5" class="tab-pane fade" style="overflow:hidden;">
          <?php
            if ($model->isNewRecord) {
                echo '<p style="color:Red;">Guarde para poder agregar KPI</p>';
            } else {
                echo CHtml::ajaxLink(Yii::t('job', 'Agregar KPI'),
                    $this->createUrl('kpi/create', array('id'=>$model->idInicioEjecucion)),
                    array(    'success'=>'js:function(data) {
                                    dialogoDeUpdate.dialog("open");
                                    document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                    initDateInputs()
                                }',
                            'update' => '#filas_kpi'
                    ),array('class'=>'specialLinks')
                );
            } ?>
            <div class="form-group">
                <div id="filas_kpi"></div>
            </div>

          <?php
            if ($model->isNewRecord) {
                echo '<p style="color:Red;">Guarde para poder agregar KPI Observacion</p>';
            } else {
                echo CHtml::ajaxLink(Yii::t('job', 'Agregar KPI Observacion'),
                    $this->createUrl('kpiObservations/create', array('id'=>$model->idInicioEjecucion)),
                    array(    'success'=>'js:function(data) {
                                    dialogoDeUpdate.dialog("open");
                                    document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                    initDateInputs()
                                }',
                            'update' => '#filas_kpi_obs'
                    )
                );
            } ?>
            <div class="form-group">
                <div id="filas_kpi_obs"></div>
            </div>
        </div>
</div>

<script type="text/javascript">
    function initDateInputs(){
      $("#DesembolsosMontos_fecha_desembolso").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });

      $("#ImplementationDocuments_datePublished").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });

      $("#ImplementationDocuments_dateModified").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });

      $("#ImplementationMilestone_dueDate").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });

      $("#ImplementationMilestone_dateMet").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });


      $("#Tariffs_startDate").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });

      $("#Tariffs_endDate").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });

      $("#Tariffs_maxExtentDate").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });

      $("#Transactions_date").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });

      $("#KpiObservations_startDate").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });

      $("#KpiObservations_endDate").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });

    }

    function loadKPIOBS(value){
        if (value === undefined)
            value = this.lastKPI;

        this.lastKPI = value;

        if (this.lastKPI === undefined)
            return;

        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("InicioEjecucion/ViewKpiObs",array("event"=>"Update"));?>&idKPI='+value,
            success:function(data){
               $('#filas_kpi_obs').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });
    }

    function loadEverything(){
        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("/InicioEjecucion/ViewDetDesembolsos", array("id"=>$model->idInicioEjecucion, "event"=>"Update")); ?>',

            success:function(data){
              $('#filas_desembolsos').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });

        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("InicioEjecucion/ViewDocuments", array("id"=>$model->idInicioEjecucion, "event"=>"Update")); ?>',
            data:data,
            success:function(data){
               $('#filas_documentos').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });

        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("InicioEjecucion/ViewMilestone", array("id"=>$model->idInicioEjecucion, "event"=>"Update")); ?>',
            data:data,
            success:function(data){
               $('#filas_milestone').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });

        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("InicioEjecucion/ViewTransactions", array("id"=>$model->idInicioEjecucion, "event"=>"Update")); ?>',
            data:data,
            success:function(data){
               $('#filas_transaction').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });

        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("InicioEjecucion/ViewTariffs", array("id"=>$model->idInicioEjecucion, "event"=>"Update")); ?>',
            data:data,
            success:function(data){
               $('#filas_tariffs').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });

        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("InicioEjecucion/ViewKpi", array("id"=>$model->idInicioEjecucion, "event"=>"Update")); ?>',
            data:data,
            success:function(data){
               $('#filas_kpi').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });

        loadKPIOBS();
    }
      <?php if (!$model->isNewRecord) {
              echo 'loadEverything();';
          }
    ?>

    function send_documents(type)
    {
        var controller = "";
        if (type == 'desembolso'){
            controller = '<?php echo CController::createUrl("desembolsosMontos/create", array("id"=>$model->idInicioEjecucion)); ?>';
        }else if (type == "documents"){
            controller = '<?php echo CController::createUrl("implementationDocuments/create", array("id"=>$model->idInicioEjecucion)); ?>';
        } else if (type == "milestone"){
            controller='<?php echo CController::createUrl("implementationMilestone/create", array("id"=>$model->idInicioEjecucion)); ?>';
        } else if (type == "tariffs"){
            controller='<?php echo CController::createUrl("tariffs/create", array("id"=>$model->idInicioEjecucion)); ?>';
        }else if (type == "transactions"){
            controller='<?php echo CController::createUrl("transactions/create", array("id"=>$model->idInicioEjecucion)); ?>';
        }else if (type == "kpi"){
            controller='<?php echo CController::createUrl("kpi/create", array("id"=>$model->idInicioEjecucion)); ?>';
        }else if (type = "kpiObs"){
            controller='<?php echo CController::createUrl("kpiObservations/create", array("id"=>$model->idInicioEjecucion)); ?>';
        }
      //  var data=$("#implementation-dialog-form").serialize();
        $("input[id$='url']").each(function (i, el) {
            if ($(el).val().length == 0){
                //field cant be empty
                $(el).val("0");
            }
        });
        var data=$("#implementation-dialog-form")[0];
        data = new FormData(data);
        setTimeout(function(){
            $.ajax({
                type: 'POST',
                url: controller,
                data:data,
                processData: false,  // Important!
                contentType: false,
                cache: false,
                success:function(data){
                    //alert("Datos agregados correctamente!");
                    loadEverything();
                    dialogoDeUpdate.dialog("close");
                },
                error: function(data) { // if error occured
                    alert("Error el documento ya existe!");
                    alert("Error: " + JSON.stringify(data));
                },
                dataType:'html'
            });
        },200);
    }

    function update_documents(type,idimplementationDocuments)
    {
        var controller = "";
        if (type == 'desembolso'){
            controller = '<?php echo CController::createUrl("desembolsosMontos/update"); ?>';
        }else if (type == "documents"){
            controller = '<?php echo CController::createUrl("implementationDocuments/update"); ?>';
        } else if (type == "milestone"){
            controller='<?php echo CController::createUrl("implementationMilestone/update"); ?>';
        } else if (type == "tariffs"){
            controller='<?php echo CController::createUrl("tariffs/update"); ?>';
        }else if (type == "transactions"){
            controller='<?php echo CController::createUrl("transactions/update"); ?>';
        }else if (type == "kpi"){
            controller='<?php echo CController::createUrl("kpi/update"); ?>';
        }else if (type = "kpiObs"){
            controller='<?php echo CController::createUrl("kpiObservations/update"); ?>';
        }
       // var data=$("#implementation-dialog-form").serialize();
        $("input[id$='url']").each(function (i, el) {
            if ($(el).val().length == 0){
                //field cant be empty
                $(el).val("0");
            }
        });
        var data=$("#implementation-dialog-form")[0];
        data = new FormData(data);
        $.ajax({
                type: 'POST',
                url: controller+'&id='+idimplementationDocuments,
                data:data,
                processData: false,  // Important!
                contentType: false,
                cache: false,
                success:function(data){
                    alert("Datos Actualizados correctamente!");
                    loadEverything();
                    dialogoDeUpdate.dialog("close");
                },
                error: function(data) { // if error occured
                    alert("Error al actulizar documento!");
                    alert("Error: " + JSON.stringify(data));
                },
                dataType:'html'
            }
        );
    }

    deleteObject = function (type,id) {
            var controller = "";
            if (type == 'desembolso'){
                controller = '<?php echo CController::createUrl("desembolsosMontos/delete"); ?>';
            }else if (type == "documentos"){
                controller = '<?php echo CController::createUrl("implementationDocuments/delete"); ?>';
            } else if (type == "milestone"){
                controller='<?php echo CController::createUrl("implementationMilestone/delete"); ?>';
            } else if (type == "tariffs"){
                controller='<?php echo CController::createUrl("tariffs/delete"); ?>';
            }else if (type == "transactions"){
                controller='<?php echo CController::createUrl("transactions/delete"); ?>';
            }else if (type == "kpi"){
                controller='<?php echo CController::createUrl("kpi/delete"); ?>';
            }else if (type = "kpiObs"){
                controller='<?php echo CController::createUrl("kpiObservations/delete"); ?>';
            }
            const url =controller+"&id="+id;

            swal({
                title: '¿Desea eliminar el registro con código : ' + id + ' ?',
                text: "No se podrá recuperar en un futuro",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, ¡Borrar!',
                cancelButtonText: 'No, ¡Mantener!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {

                if (result) {

                    jQuery.ajax({
                        'type': 'POST',
                        'data': {
                            'id': id
                        },
                        'url': url,
                        'cache': false,
                        'success': function (data) {
                            loadEverything();
                            table.row('.selected').remove().draw(false);
                            swal(
                                '¡Borrado!',
                                'El registro ha sido eliminado',
                                'success'
                            )
                        },
                        'error:':function(error){

                            swal(
                                'Error!',
                                'El registro NO ha sido eliminado',
                                'error'
                            )
                        }
                    });
                } else if (result.dismiss === 'cancel') {
                    swal(
                        '¡Cancelado!',
                        'El registro está seguro',
                        'error'
                    )
                }
            }).catch(swal.noop)
    }

    function get_data_update(type,idimplementationDocuments){
        var controller = "";
        if (type == 'desembolso'){
            controller = '<?php echo CController::createUrl("desembolsosMontos/update"); ?>';
        }else if (type == "documentos"){
            controller = '<?php echo CController::createUrl("implementationDocuments/update"); ?>';
        } else if (type == "milestone"){
            controller='<?php echo CController::createUrl("implementationMilestone/update"); ?>';
        } else if (type == "tariffs"){
            controller='<?php echo CController::createUrl("tariffs/update"); ?>';
        }else if (type == "transactions"){
            controller='<?php echo CController::createUrl("transactions/update"); ?>';
        }else if (type == "kpi"){
            controller='<?php echo CController::createUrl("kpi/update"); ?>';
        }else if (type = "kpiObs"){
            controller='<?php echo CController::createUrl("kpiObservations/update"); ?>';
        }
        $.ajax({
                type: 'GET',
                url: controller+'&id='+idimplementationDocuments,
                success:function(data){
                  dialogoDeUpdate.dialog("open");
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
    var dialogoDeUpdate;
    $(document).ready(function(){
        dialogoDeUpdate = $("#inicio-ejecucion-form-dialog").dialog({
            autoOpen: false,
            modal: true,
            width: 550,
            height:650,
            title: 'Details'
        });

        f_carga_Datos_Contacto();
    })
</script>
