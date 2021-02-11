<?php
/* @var $this ContratacionController */
/* @var $model Contratacion */
/* @var $form CActiveForm */
    $this->beginWidget('zii.widgets.jui.CJuiDialog',
                        array(
                            'id'=>'contratacion-form-dialog',
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

<div class="tab-content">
  <ul class="nav nav-pills nav-fill" role="tablist">
        <li class="nav-item ">
          <a class="nav-link active" data-toggle="tab" href="#home">Contratacion
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" data-toggle="tab" href="#contractMilestone">Hito
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" data-toggle="tab" href="#OrganizationDetails">Detalles de Organización
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" data-toggle="tab" href="#Signatures">Firmantes
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" data-toggle="tab" href="#menu4">Documentos
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" data-toggle="tab" href="#debtEquityRatio">Ratio de Endeudamiento
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" data-toggle="tab" href="#GovSupportGuarantee">Garantia de Gobierno
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" data-toggle="tab" href="#PreferredBidders">Oferentes Preferidos
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" data-toggle="tab" href="#RiskAllocation">Asignación de Riesgos
          </a>
        </li>
        <li class="nav-item ">
          <!-- <a class="nav-link" data-toggle="tab" href="#ShareCapital">Capital Compartido -->
          <!-- </a> -->
        </li>
        <li class="nav-item ">
          <a class="nav-link" data-toggle="tab" href="#menu10">TIR
          </a>
        </li>
        <!-- <li class="nav-item ">
          <a class="nav-link" data-toggle="tab" href="#menu11">Enmienda
          </a>
        </li> -->
        <li class="nav-item ">
          <a class="nav-link" data-toggle="tab" href="#menu12">Accionista
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" data-toggle="tab" href="#menu13">Prestamista e Inversor
          </a>
        </li>
		<li class="nav-item ">
          <a class="nav-link" data-toggle="tab" href="#menu14">Información Financiera
          </a>
        </li>
		<li class="nav-item ">
          <a class="nav-link" data-toggle="tab" href="#menu15">Proyectos Relacionados
          </a>
        </li>
  </ul>
  <div id="home" class="tab-pane fade in active">

        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'contratacion-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
             'enableAjaxValidation' => true,
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
        )); ?>
          <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

          <p><?php echo $form->errorSummary($model); ?></p>
           <table width="100%" border="0" class="table table-borderless" class="table table-borderless">
              <tr>
                <td><table width="100%" border="0" class="table table-borderless">
                  <tr>
                    <td width="41%"><span class=""><?php echo $form->labelEx($model,'idAdjudicacion'); ?></span></td>
                    <td width="40%"><span class=""><?php echo $form->labelEx($model,'ncontrato'); ?></span></td>
                    <td width="19%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><span class=""><?php


                     if(isset($_GET['idCreate'])){
                        echo $form->dropDownList($model,'idAdjudicacion', $model->listaAdjudicacionID($_GET['idCreate']),
                        array(
                        'disabled'=>'disabled',
                            //'prompt'=>'Seleccione una opción',
                            'options'=>array(sprintf('%010d', $model->idAdjudicacion)=>array('selected'=>'selected')),
                            'ajax'=>array(
                                'type'=>'POST',
                                'dataType'=>'json',
                                'data'=>array('idAdjudicacion'=>'js: $(this).val()'),
                                'url'=>$this->createUrl('adjudicacion/search'),
                                'success'=>'function(data) {
                                    $("#Contratacion_ncontrato").val(data.ncontrato); Hab_EspecificacionyPlanos(data.idetodo)}',
                            )
                        ));
                        }else if(isset($_GET['id'])){
                        echo $form->dropDownList($model,'idAdjudicacion', $model->listaAdjudicacion(),
                        array(
                        'disabled'=>'disabled',
                            //'prompt'=>'Seleccione una opción',
                            'options'=>array(sprintf('%010d', $model->idAdjudicacion)=>array('selected'=>'selected')),
                            'ajax'=>array(
                                'type'=>'POST',
                                'dataType'=>'json',
                                'data'=>array('idAdjudicacion'=>'js: $(this).val()'),
                                'url'=>$this->createUrl('adjudicacion/search'),
                                'success'=>'function(data) {
                                    $("#Contratacion_ncontrato").val(data.ncontrato); Hab_EspecificacionyPlanos(data.idetodo)}',
                            )
                        ));

                            //echo  $form->dropDownList($model,'idProyecto',$model->listaProyectosID($_GET['idCreate']));
                        }else{
                                            echo $form->dropDownList($model,'idAdjudicacion', $model->listaAdjudicacion(),
                        array(
                            'prompt'=>'Seleccione una opción',
                            'options'=>array(sprintf('%010d', $model->idAdjudicacion)=>array('selected'=>'selected')),
                            'ajax'=>array(
                                'type'=>'POST',
                                'dataType'=>'json',
                                'data'=>array('idAdjudicacion'=>'js: $(this).val()'),
                                'url'=>$this->createUrl('adjudicacion/search'),
                                'success'=>'function(data) {
                                    $("#Contratacion_ncontrato").val(data.ncontrato); Hab_EspecificacionyPlanos(data.idetodo)}',
                            )
                        ));
                        }

                    if(empty($_GET['idCreate'])){



                    }else{






                    }




                ?> <?php echo $form->error($model,'idAdjudicacion'); ?></span></td>
                    <td width="40%"><span class=""><?php echo $form->textField($model,'ncontrato',array('size'=>20,'maxlength'=>20/*,'value'=>date('Y-m').$model->idAdjudicacion*/)); ?> <?php echo $form->error($model,'ncontrato'); ?></span></td>
                    <td width="19%">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><span class=""><?php echo $form->labelEx($model,'primario'); ?></span></td>
              </tr>
              <tr>
              <tr>
                <td><?php echo $form->checkBox($model,'primario'); ?></td>
              </tr>
              <tr>
                <td><span class=""><?php echo $form->labelEx($model,'titulocontrato'); ?></span></td>
              </tr>
              <tr>
                <td><span class=""><?php echo $form->textArea($model,'titulocontrato',array('size'=>60, 'rows'=>5, 'cols'=>60, 'maxlength'=>2000)); ?> <?php echo $form->error($model,'titulocontrato'); ?></span></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><table width="100%" border="0" class="table table-borderless">
                  <tr>
                    <td width="45%"><span class=""><?php echo $form->labelEx($model,'precioLPS'); ?></span></td>
                    <td width="36%"><span class=""><?php echo $form->labelEx($model,'precioUSD');  ?></span></td>
                    <td width="19%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><span class=""><?php echo $form->textField($model,'precioLPS'); ?> <?php echo $form->error($model,'precioLPS'); ?></span></td>
                    <td width="36%"><span class=""><?php echo $form->textField($model,'precioUSD'); ?> <?php echo $form->error($model,'precioUSD'); ?></span></td>
                    <td width="19%">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><span class=""><?php echo $form->labelEx($model,'alcances'); ?></span></td>
              </tr>
              <tr>
                <td><span class=""><?php echo $form->textArea($model,'alcances',array('rows'=>5, 'cols'=>60)); ?> <?php echo $form->error($model,'alcances'); ?></span></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><table width="100%" border="0" class="table table-borderless">
                  <tr>
                    <td width="12%"><span class=""><?php echo $form->labelEx($model,'fechainicio'); ?></span></td>
                    <td width="15%">&nbsp;</td>
                    <td width="16%"><span class=""><?php echo $form->labelEx($model,'fechafinal'); ?></span></td>
                    <td width="9%">&nbsp;</td>
                    <td width="30%"><span class=""><?php echo $form->labelEx($model,'duracioncontrato'); ?></span></td>
                    <td width="18%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2"><span class="">
                      <?php
                                    if ($model->fechainicio!='') {
                                        $model->fechainicio=date('Y-m-d',strtotime($model->fechainicio));
                                    }
                                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'model'=>$model,
                                    'attribute'=>'fechainicio',
                                    'value'=>$model->fechainicio,
                                    'language' => 'es',
                                    'htmlOptions' => array('readonly'=>"readonly"),

                                    'options'=>array(
                                    'autoSize'=>true,
                                    'defaultDate'=>$model->fechainicio,
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
                                    ),
                                )); ?>
                    <?php echo $form->error($model,'fechainicio'); ?></span></td>
                    <td><span class="">
                      <?php
                                    if ($model->fechafinal!='') {
                                        $model->fechafinal=date('Y-m-d',strtotime($model->fechafinal));
                                    }
                                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'model'=>$model,
                                    'attribute'=>'fechafinal',
                                    'value'=>$model->fechafinal,
                                    'language' => 'es',
                                    'htmlOptions' => array('readonly'=>"readonly"),

                                    'options'=>array(
                                    'autoSize'=>true,
                                    'defaultDate'=>$model->fechafinal,
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
                    <?php echo $form->error($model,'fechafinal'); ?></span></td>
                    <td>&nbsp;</td>
                    <td><span class=""><?php echo $form->textField($model,'duracioncontrato',array('size'=>60,'maxlength'=>65, 'readonly'=>true)); ?> <?php echo $form->error($model,'duracioncontrato'); ?></span></td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
            </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><span class="">
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
                <td><span class=""><?php echo $form->labelEx($model,'estado'); ?> <?php echo  $form->dropDownList($model,'estado',$model->listaEstados(),array('prompt'=>'--Seleccione un valor--')); ?> <?php echo $form->error($model,'estado'); ?></span></td>
              </tr>
              <tr>
                <td><span class="buttons"><?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks')); ?></span></td>
              </tr>
          </table>
            <p><span class="">
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
            <?php echo $form->error($model,'usuario_creacion'); ?></span> </p>
            <div class=""></div>

            <div class=""></div>

            <div class=""></div>

            <div class=""></div>

            <div class=""></div>

            <div class=""></div>

            <div class=""></div>

            <div class=""></div>

                                <div class=""></div>

                                <div class=""></div>

            <div class=""></div>

            <div class=""></div>

            <div class=""></div>

            <div class=""></div>
                <div class=""></div>

                 <div class=""></div>

                 <div class=""></div>

            <?php /*if (!$model->isNewRecord) {
                        echo '  <div class="">';
                        echo $form->labelEx($model,'fechacreacion');
                        echo $form->textField($model,'fechacreacion',array('disabled'=>'true','value' => date('d-M-Y', $model->fechacreacion)));
                        echo $form->error($model,'fechacreacion');
                        echo '  </div>';

                        if (!empty($model->fechapublicado)) {
                            echo '  <div class="">';
                            echo $form->labelEx($model,'fechapublicado');
                            echo $form->textField($model,'fechapublicado',array('disabled'=>'true', 'value' => date("d-M-Y",strtotime($model->fechapublicado))));
                            echo $form->error($model,'fechapublicado');
                            echo '  </div>';
                        }
                      }*/
            ?>

            <div class=""></div>

            <div class="buttons"></div>

        <?php $this->endWidget(); ?>

        </div><!-- form -->
 <div id="contractMilestone" class="tab-pane fade" style="overflow:hidden;">
      <?php
        if ($model->isNewRecord) {
            echo '<p style="color:Red;">Guarde la Contratacion para poder agregar Milestone</p>';
        } else {
            echo CHtml::ajaxLink(Yii::t('job', 'Agregar Milestone'),
                $this->createUrl('contractsMilestone/create', array('id'=>$model->idContratacion)),
                array(    'success'=>'js:function(data) {
                                dialogoDeUpdate.dialog("open");
                                document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                initDateInputs()
                            }',
                        'update' => '#filas_milestone'
                ),
                array('class'=>'specialLinks')
            );
        } ?>
        <div class="">
            <div id="filas_milestone"></div>
        </div>
 </div>
 <div id="OrganizationDetails" class="tab-pane fade" style="overflow:hidden;">
      <?php
        if ($model->isNewRecord) {
            echo '<p style="color:Red;">Guarde la Contratacion para poder agregar Organization Details</p>';
        } else {
            echo CHtml::ajaxLink(Yii::t('job', 'Agregar organización detalles'),
                $this->createUrl('contractsOrganizationDetails/create', array('id'=>$model->idContratacion)),
                array(    'success'=>'js:function(data) {
                                dialogoDeUpdate.dialog("open");
                                document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                initDateInputs()
                            }',
                        'update' => '#filas_organization_details'
                ),
                array('class'=>'specialLinks')
            );
        } ?>
        <div class="">
            <div id="filas_organization_details"></div>
        </div>
 </div>
 <div id="Signatures" class="tab-pane fade" style="overflow:hidden;">
      <?php
        if ($model->isNewRecord) {
            echo '<p style="color:Red;">Guarde la Contratacion para poder agregar Firmantes</p>';
        } else {
            echo CHtml::ajaxLink(Yii::t('job', 'Agregar Firmantes'),
                $this->createUrl('contractsSignatories/create', array('id'=>$model->idContratacion)),
                array(    'success'=>'js:function(data) {
                                dialogoDeUpdate.dialog("open");
                                document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                initDateInputs()
                            }',
                        'update' => '#filas_Signatures'
                ),
                array('class'=>'specialLinks')
            );
        } ?>
        <div class="">
            <div id="filas_Signatures"></div>
        </div>
 </div>

  <div id="menu4" class="tab-pane fade" style="overflow:hidden;">
      <?php
        if ($model->isNewRecord) {
            echo '<p style="color:Red;">Guarde para poder agregar documentos</p>';
        } else {
            echo CHtml::ajaxLink(Yii::t('job', 'Agregar Documento'),
                $this->createUrl('contractDocuments/create', array('id'=>$model->idContratacion)),
                array(    'success'=>'js:function(data) {
                                dialogoDeUpdate.dialog("open");
                                document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                initDateInputs()
                            }',
                        'update' => '#filas_documentos'
                ),
                array('class'=>'specialLinks')
            );
        } ?>
        <div class="">
            <div id="filas_documentos"></div>
        </div>
 </div>
  <div id="debtEquityRatio" class="tab-pane fade" style="overflow:hidden;">
        <?php
          if ($model->isNewRecord) {
              echo '<p style="color:Red;">Guarde la Contratacion para poder agregar Ratio de Endeudamiento</p>';
          } else {
              echo CHtml::ajaxLink(Yii::t('job', 'Agregar Ratio de Endeudamiento'),
                  $this->createUrl('debtEquityRatio/create', array('id'=>$model->idContratacion)),
                  array(    'success'=>'js:function(data) {
                                  dialogoDeUpdate.dialog("open");
                                  document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                  initDateInputs()
                              }',
                          'update' => '#filas_debtEquityRatio'
                  ),
                  array('class'=>'specialLinks')
              );
          } ?>
          <div class="">
              <div id="filas_debtEquityRatio"></div>
          </div>
   </div>
   <div id="GovSupportGuarantee" class="tab-pane fade" style="overflow:hidden;">
        <?php
          if ($model->isNewRecord) {
              echo '<p style="color:Red;">Guarde la Contratacion para poder agregar Gov Support Guarantee</p>';
          } else {
              echo CHtml::ajaxLink(Yii::t('job', 'Agregar Gob garantias de soporte'),
                  $this->createUrl('govSupportGuarantee/create', array('id'=>$model->idContratacion)),
                  array(    'success'=>'js:function(data) {
                                  dialogoDeUpdate.dialog("open");
                                  document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                  initDateInputs()
                              }',
                          'update' => '#filas_GovSupportGuarantee'
                  ),
                  array('class'=>'specialLinks')
              );
          } ?>
          <div class="">
              <div id="filas_GovSupportGuarantee"></div>
          </div>
   </div>
   <div id="PreferredBidders" class="tab-pane fade" style="overflow:hidden;">
        <?php
          if ($model->isNewRecord) {
              echo '<p style="color:Red;">Guarde la Contratacion para poder agregar Oferentes Preferidos</p>';
          } else {
              echo CHtml::ajaxLink(Yii::t('job', 'Agregar Oferentes Preferidos'),
                  $this->createUrl('preferredBidders/create', array('id'=>$model->idContratacion)),
                  array(    'success'=>'js:function(data) {
                                  dialogoDeUpdate.dialog("open");
                                  document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                  initDateInputs()
                              }',
                          'update' => '#filas_PreferredBidders'
                  ),
                  array('class'=>'specialLinks')
              );
          } ?>
          <div class="">
              <div id="filas_PreferredBidders"></div>
          </div>
   </div>
   <div id="RiskAllocation" class="tab-pane fade" style="overflow:hidden;">
        <?php
          if ($model->isNewRecord) {
              echo '<p style="color:Red;">Guarde la Contratacion para poder agregar Asignación de Riesgos</p>';
          } else {
              echo CHtml::ajaxLink(Yii::t('job', 'Agregar Asignación de Riesgos'),
                  $this->createUrl('riskAllocation/create', array('id'=>$model->idContratacion)),
                  array(    'success'=>'js:function(data) {
                                  dialogoDeUpdate.dialog("open");
                                  document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                  initDateInputs()
                              }',
                          'update' => '#filas_RiskAllocation'
                  ),
                  array('class'=>'specialLinks')
              );
          } ?>
          <div class="">
              <div id="filas_RiskAllocation"></div>
          </div>
   </div>
   <div id="ShareCapital" class="tab-pane fade" style="overflow:hidden;">
        <?php
          if ($model->isNewRecord) {
              echo '<p style="color:Red;">Guarde la Contratacion para poder agregar Capital Compartido</p>';
          } else {
              echo CHtml::ajaxLink(Yii::t('job', 'Agregar Capital Compartido'),
                  $this->createUrl('shareCapital/create', array('id'=>$model->idContratacion)),
                  array(    'success'=>'js:function(data) {
                                  dialogoDeUpdate.dialog("open");
                                  document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                  initDateInputs()
                              }',
                          'update' => '#filas_ShareCapital'
                  ),
                  array('class'=>'specialLinks')
              );
          } ?>
          <div class="">
              <div id="filas_ShareCapital"></div>
          </div>
   </div>
   <div id="menu10" class="tab-pane fade" style="overflow:hidden;">
        <?php
          if ($model->isNewRecord) {
              echo '<p style="color:Red;">Guarde la Contratacion para poder agregar esta seccion</p>';
          } else {
              echo CHtml::ajaxLink(Yii::t('job', 'Agregar TIR'),
                  $this->createUrl('actualIrr/create', array('id'=>$model->idContratacion)),
                  array(    'success'=>'js:function(data) {
                                  dialogoDeUpdate.dialog("open");
                                  document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                  initDateInputs()
                              }',
                          'update' => '#filas_actualirr'
                  ),
                  array('class'=>'specialLinks')
              );
          } ?>
          <div class="">
              <div id="filas_actualirr"></div>
          </div>
   </div>
   <div id="menu11" class="tab-pane fade" style="overflow:hidden;">
        <?php
          if ($model->isNewRecord) {
              echo '<p style="color:Red;">Guarde la Contratacion para poder agregar esta seccion</p>';
          } else {
              echo CHtml::ajaxLink(Yii::t('job', 'Agregar Enmienda'),
                  $this->createUrl('amendment/create', array('id'=>$model->idContratacion)),
                  array(    'success'=>'js:function(data) {
                                  dialogoDeUpdate.dialog("open");
                                  document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                  initDateInputs()
                              }',
                          'update' => '#filas_amendment'
                  ),
                  array('class'=>'specialLinks')
              );
          } ?>
          <div class="">
              <div id="filas_amendment"></div>
          </div>
   </div>
   <div id="menu12" class="tab-pane fade" style="overflow:hidden;">
        <?php
          if ($model->isNewRecord) {
              echo '<p style="color:Red;">Guarde la Contratacion para poder agregar esta seccion</p>';
          } else {
              echo CHtml::ajaxLink(Yii::t('job', 'Agregar Accionista'),
                  $this->createUrl('shareholders/create', array('id'=>$model->idContratacion)),
                  array(    'success'=>'js:function(data) {
                                  dialogoDeUpdate.dialog("open");
                                  document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                  initDateInputs()
                              }',
                          'update' => '#filas_shareholders'
                  ),
                  array('class'=>'specialLinks')
              );
          } ?>
          <div class="">
              <div id="filas_shareholders"></div>
          </div>
   </div>
   <div id="menu13" class="tab-pane fade" style="overflow:hidden;">
        <?php
          if ($model->isNewRecord) {
              echo '<p style="color:Red;">Guarde la Contratacion para poder agregar esta seccion</p>';
          } else {
              echo CHtml::ajaxLink(Yii::t('job', 'Agregar Prestamista e Inversor'),
                  $this->createUrl('lendersSuppliers/create', array('id'=>$model->idContratacion)),
                  array(    'success'=>'js:function(data) {
                                  dialogoDeUpdate.dialog("open");
                                  document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                  initDateInputs()
                              }',
                          'update' => '#filas_lender'
                  ),
                  array('class'=>'specialLinks')
              );
          } ?>
          <div class="">
              <div id="filas_lender"></div>
          </div>
   </div>

   <div id="menu14" class="tab-pane fade" style="overflow:hidden;">
        <?php
          if ($model->isNewRecord) {
              echo '<p style="color:Red;">Guarde la Contratacion para poder agregar esta seccion</p>';
          } else {
              echo CHtml::ajaxLink(Yii::t('job', 'Agregar Información Financiera'),
                  $this->createUrl('finance/create', array('id'=>$model->idContratacion)),
                  array(    'success'=>'js:function(data) {
                                  dialogoDeUpdate.dialog("open");
                                  document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                  initDateInputs()
                              }',
                          'update' => '#filas_finance'
                  ),
                  array('class'=>'specialLinks')
              );
          } ?>
          <div class="">
              <div id="filas_finance"></div>
          </div>
   </div>
   <div id="menu15" class="tab-pane fade" style="overflow:hidden;">
        <?php
          if ($model->isNewRecord) {
              echo '<p style="color:Red;">Guarde la Contratacion para poder agregar esta seccion</p>';
          } else {
              echo CHtml::ajaxLink(Yii::t('job', 'Agregar Proyecto'),
                  $this->createUrl('RelatedProcess/create', array('id'=>$model->idContratacion)),
                  array(    'success'=>'js:function(data) {
                                  dialogoDeUpdate.dialog("open");
                                  document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                  initDateInputs()
                              }',
                          'update' => '#filas_related_process',
                            ),
                  array('class'=>'specialLinks')
              );
          } ?>
          <div class="">
              <div id="filas_related_process"></div>
          </div>
   </div>



</div>
<script type="text/javascript">
$().ready(function(){
    $("#Contratacion_duracioncontrato")
    .focus(
    function(){
        var start = $('#Contratacion_fechainicio').datepicker('getDate');
        var end   = $('#Contratacion_fechafinal').datepicker('getDate');
        var days   = (end - start)/1000/60/60/24;
        if (start!=null)
            {
            $('#Contratacion_duracioncontrato').val(days+" dias");
            }
        });

    });
</script>


<?php

  $resultX=  Yii::app()->db->createCommand()
                                           ->select('*')
                                           ->from('v_idmetodoadquisicion_idcontratacion')
                                           ->where('idContratacion=:id',array(':id'=>$model->idContratacion))
                                           ->queryRow();

  $IdMetodoAdquisicion = $resultX['idMetodo'];


Yii::app()->clientScript->registerScript('id_something',
         'Hab_EspecificacionyPlanos('.$IdMetodoAdquisicion.');'
        , CClientScript::POS_LOAD);

?>



<script type="text/javascript">
  $(document).ready(function(){
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
        .columns.adjust()
        .responsive.recalc();
    });
  })
  function initDateInputs(){
    $("#ContractsMilestone_dueDate").datepicker({
        uiLibrary: "bootstrap4",
        dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
    });

    $("#ContractsMilestone_dateMet").datepicker({
        uiLibrary: "bootstrap4",
        dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
    });

    $("#ContractDocuments_datePublished").datepicker({
        uiLibrary: "bootstrap4",
        dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
    });

    $("#ContractDocuments_dateModified").datepicker({
        uiLibrary: "bootstrap4",
        dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
    });

    $("#GovSupportGuarantee_startDate").datepicker({
        uiLibrary: "bootstrap4",
        dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
    });

    $("#GovSupportGuarantee_endDate").datepicker({
        uiLibrary: "bootstrap4",
        dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
    });

    $("#Amendment_date").datepicker({
        uiLibrary: "bootstrap4",
        dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
    });

	$("#Finance_startDate").datepicker({
        uiLibrary: "bootstrap4",
        dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
    });

	$("#Finance_endDate").datepicker({
        uiLibrary: "bootstrap4",
        dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
    });

  }
    function loadEverything(){
        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("Contratacion/ViewRelatedProcess", array("id"=>$model->idContratacion, "event"=>"Update")); ?>',
            data:data,
            success:function(data){
               $('#filas_related_process').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });
        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("Contratacion/ViewDocuments", array("id"=>$model->idContratacion, "event"=>"Update")); ?>',
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
            url: '<?php echo CController::createUrl("Contratacion/ViewMilestone", array("id"=>$model->idContratacion, "event"=>"Update")); ?>',
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
            url: '<?php echo CController::createUrl("Contratacion/ViewOrganizationDetails", array("id"=>$model->idContratacion, "event"=>"Update")); ?>',
            data:data,
            success:function(data){
               $('#filas_organization_details').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });
        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("Contratacion/ViewSignatures", array("id"=>$model->idContratacion, "event"=>"Update")); ?>',
            data:data,
            success:function(data){
               $('#filas_Signatures').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });
        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("Contratacion/ViewDebtEquityRatio", array("id"=>$model->idContratacion, "event"=>"Update")); ?>',
            data:data,
            success:function(data){
               $('#filas_debtEquityRatio').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });
        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("Contratacion/ViewGovSupportGuarantee", array("id"=>$model->idContratacion, "event"=>"Update")); ?>',
            data:data,
            success:function(data){
               $('#filas_GovSupportGuarantee').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });
        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("Contratacion/ViewPreferredBidders", array("id"=>$model->idContratacion, "event"=>"Update")); ?>',
            data:data,
            success:function(data){
               $('#filas_PreferredBidders').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });
        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("Contratacion/ViewRiskAllocation", array("id"=>$model->idContratacion, "event"=>"Update")); ?>',
            data:data,
            success:function(data){
               $('#filas_RiskAllocation').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });
        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("Contratacion/ViewShareCapital", array("id"=>$model->idContratacion, "event"=>"Update")); ?>',
            data:data,
            success:function(data){
               $('#filas_ShareCapital').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });
        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("Contratacion/ViewActualIRR", array("id"=>$model->idContratacion, "event"=>"Update")); ?>',
            data:data,
            success:function(data){
               $('#filas_actualirr').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });
        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("Contratacion/ViewAmendment", array("id"=>$model->idContratacion, "event"=>"Update")); ?>',
            data:data,
            success:function(data){
               $('#filas_amendment').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });
        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("Contratacion/ViewShareholders", array("id"=>$model->idContratacion, "event"=>"Update")); ?>',
            data:data,
            success:function(data){
               $('#filas_shareholders').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });
        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("Contratacion/ViewLenderSuppliers", array("id"=>$model->idContratacion, "event"=>"Update")); ?>',
            data:data,
            success:function(data){
               $('#filas_lender').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });
		$.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("Contratacion/ViewFinance", array("id"=>$model->idContratacion, "event"=>"Update")); ?>',
            data:data,
            success:function(data){
               $('#filas_finance').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });
    }
      <?php if (!$model->isNewRecord) {
              echo 'loadEverything();';
          }
    ?>

    function send_documents(type)
    {
        var controller = "";
        if (type == "documents"){
            controller = '<?php echo CController::createUrl("contractDocuments/create", array("id"=>$model->idContratacion)); ?>';
        }else if(type == "milestone"){
            controller = '<?php echo CController::createUrl("contractsMilestone/create", array("id"=>$model->idContratacion)); ?>';
        }else if(type == "OrganizationDetails"){
            controller = '<?php echo CController::createUrl("contractsOrganizationDetails/create", array("id"=>$model->idContratacion)); ?>';
        }else if(type == "Signatures"){
            controller = '<?php echo CController::createUrl("contractsSignatories/create", array("id"=>$model->idContratacion)); ?>';
        }else if(type == "DebtEquityRatio"){
            controller = '<?php echo CController::createUrl("debtEquityRatio/create", array("id"=>$model->idContratacion)); ?>';
        }else if(type == "GovSupportGuarantee"){
            controller = '<?php echo CController::createUrl("govSupportGuarantee/create", array("id"=>$model->idContratacion)); ?>';
        }else if(type == "PreferredBidders"){
            controller = '<?php echo CController::createUrl("preferredBidders/create", array("id"=>$model->idContratacion)); ?>';
        }else if(type == "RiskAllocation"){
            controller = '<?php echo CController::createUrl("riskAllocation/create", array("id"=>$model->idContratacion)); ?>';
        }else if(type == "ShareCapital"){
            controller = '<?php echo CController::createUrl("shareCapital/create", array("id"=>$model->idContratacion)); ?>';
        }else if(type == "actualIrr"){
            controller = '<?php echo CController::createUrl("actualIrr/create", array("id"=>$model->idContratacion)); ?>';
        }else if(type == "amendment"){
            controller = '<?php echo CController::createUrl("amendment/create", array("id"=>$model->idContratacion)); ?>';
        }else if(type == "shareholders"){
            controller = '<?php echo CController::createUrl("shareholders/create", array("id"=>$model->idContratacion)); ?>';
        }else if(type == "lender"){
            controller = '<?php echo CController::createUrl("lendersSuppliers/create", array("id"=>$model->idContratacion)); ?>';
        }else if(type == "finance"){
            controller = '<?php echo CController::createUrl("finance/create", array("id"=>$model->idContratacion)); ?>';
        }else if (type == 'relatedProcess'){
            controller = '<?php echo CController::createUrl("relatedProcess/create", array("id"=>$model->idContratacion)); ?>';
        }



      //  var data=$("#contratacion-dialog-form").serialize();
    $("input[id$='url']").each(function (i, el) {
      if ($(el).val().length == 0){
        //field cant be empty
        $(el).val("0");
      }
    });
        var data=$("#contratacion-dialog-form")[0];
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

    function update_documents(type,idcontractDocuments)
    {
        var controller = "";
        if (type == "documents"){
            controller = '<?php echo CController::createUrl("contractDocuments/update"); ?>';
        }else if(type == "milestone"){
            controller = '<?php echo CController::createUrl("contractsMilestone/update"); ?>';
        }else if(type == "OrganizationDetails"){
            controller = '<?php echo CController::createUrl("contractsOrganizationDetails/update"); ?>';
        }else if(type == "Signatures"){
            controller = '<?php echo CController::createUrl("contractsSignatories/update"); ?>';
        }else if(type == "DebtEquityRatio"){
            controller = '<?php echo CController::createUrl("debtEquityRatio/update"); ?>';
        }else if(type == "GovSupportGuarantee"){
            controller = '<?php echo CController::createUrl("govSupportGuarantee/update"); ?>';
        }else if(type == "PreferredBidders"){
            controller = '<?php echo CController::createUrl("preferredBidders/update"); ?>';
        }else if(type == "RiskAllocation"){
            controller = '<?php echo CController::createUrl("riskAllocation/update"); ?>';
        }else if(type == "ShareCapital"){
            controller = '<?php echo CController::createUrl("shareCapital/update"); ?>';
        }else if(type == "actualIrr"){
            controller = '<?php echo CController::createUrl("actualIrr/update"); ?>';
        }else if(type == "amendment"){
            controller = '<?php echo CController::createUrl("amendment/update"); ?>';
        }else if(type == "shareholders"){
            controller = '<?php echo CController::createUrl("shareholders/update"); ?>';
        }else if(type == "lender"){
            controller = '<?php echo CController::createUrl("lendersSuppliers/update"); ?>';
        }else if(type == "finance"){
            controller = '<?php echo CController::createUrl("finance/update"); ?>';
        }else if (type == 'relatedProcess'){
            controller = '<?php echo CController::createUrl("relatedProcess/update"); ?>';
        }
        //var data=$("#contratacion-dialog-form").serialize();
    $("input[id$='url']").each(function (i, el) {
      if ($(el).val().length == 0){
        //field cant be empty
        $(el).val("0");
      }
    });
        var data=$("#contratacion-dialog-form")[0];
        data = new FormData(data);
        $.ajax({
                type: 'POST',
                url: controller+'&id='+idcontractDocuments,
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
            if (type == "documents"){
                controller = '<?php echo CController::createUrl("contractDocuments/delete"); ?>';
            }else if(type == "milestone"){
                controller = '<?php echo CController::createUrl("contractsMilestone/delete"); ?>';
            }else if(type == "OrganizationDetails"){
                controller = '<?php echo CController::createUrl("contractsOrganizationDetails/delete"); ?>';
            }else if(type == "Signatures"){
                controller = '<?php echo CController::createUrl("contractsSignatories/delete"); ?>';
            }else if(type == "DebtEquityRatio"){
                controller = '<?php echo CController::createUrl("debtEquityRatio/delete"); ?>';
            }else if(type == "GovSupportGuarantee"){
                controller = '<?php echo CController::createUrl("govSupportGuarantee/delete"); ?>';
            }else if(type == "PreferredBidders"){
                controller = '<?php echo CController::createUrl("preferredBidders/delete"); ?>';
            }else if(type == "RiskAllocation"){
                controller = '<?php echo CController::createUrl("riskAllocation/delete"); ?>';
            }else if(type == "ShareCapital"){
                controller = '<?php echo CController::createUrl("shareCapital/delete"); ?>';
            }else if(type == "actualIrr"){
                controller = '<?php echo CController::createUrl("actualIrr/delete"); ?>';
            }else if(type == "amendment"){
                controller = '<?php echo CController::createUrl("amendment/delete"); ?>';
            }else if(type == "shareholders"){
                controller = '<?php echo CController::createUrl("shareholders/delete"); ?>';
            }else if(type == "lender"){
                controller = '<?php echo CController::createUrl("lendersSuppliers/delete"); ?>';
            }else if(type == "finance"){
                controller = '<?php echo CController::createUrl("finance/delete"); ?>';
            }else if (type == 'relatedProcess'){
                controller = '<?php echo CController::createUrl("relatedProcess/delete"); ?>';
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

    function get_data_update(type,idcontractDocuments){
        var controller = "";
        if (type == "documents"){
            controller = '<?php echo CController::createUrl("contractDocuments/update"); ?>';
        }else if(type == "milestone"){
            controller = '<?php echo CController::createUrl("contractsMilestone/update"); ?>';
        }else if(type == "OrganizationDetails"){
            controller = '<?php echo CController::createUrl("contractsOrganizationDetails/update"); ?>';
        }else if(type == "Signatures"){
            controller = '<?php echo CController::createUrl("contractsSignatories/update"); ?>';
        }else if(type == "DebtEquityRatio"){
            controller = '<?php echo CController::createUrl("debtEquityRatio/update"); ?>';
        }else if(type == "GovSupportGuarantee"){
            controller = '<?php echo CController::createUrl("govSupportGuarantee/update"); ?>';
        }else if(type == "PreferredBidders"){
            controller = '<?php echo CController::createUrl("preferredBidders/update"); ?>';
        }else if(type == "RiskAllocation"){
            controller = '<?php echo CController::createUrl("riskAllocation/update"); ?>';
        }else if(type == "ShareCapital"){
            controller = '<?php echo CController::createUrl("shareCapital/update"); ?>';
        }else if(type == "actualIrr"){
            controller = '<?php echo CController::createUrl("actualIrr/update"); ?>';
        }else if(type == "amendment"){
            controller = '<?php echo CController::createUrl("amendment/update"); ?>';
        }else if(type == "shareholders"){
            controller = '<?php echo CController::createUrl("shareholders/update"); ?>';
        }else if(type == "lender"){
            controller = '<?php echo CController::createUrl("lendersSuppliers/update"); ?>';
        }else if(type == "finance"){
            controller = '<?php echo CController::createUrl("finance/update"); ?>';
        }else if (type == 'relatedProcess'){
            controller = '<?php echo CController::createUrl("relatedProcess/update"); ?>';
        }

        $.ajax({
                type: 'GET',
                url: controller+'&id='+idcontractDocuments,
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
        dialogoDeUpdate = $("#contratacion-form-dialog").dialog({
        autoOpen: false,
        modal: true,
        width: 550,
        height:650,
        title: 'Details'
    });
        console.log(dialogoDeUpdate)
    })
</script>


<script>

                    function Hab_EspecificacionyPlanos(lid)
                                {
                                    $.ajax({
                                       // type: 'POST',
                                       // url:  '<!--?php echo CController::createUrl('CalificacionController/CargarDroplist'); ?-->',
                                        asyc: false,
                                        data: {'idX': lid},
                                        success: function(data) {
                                            // alert(lid);

                                               if (lid=='2' || lid=='3' || lid=='4') {
                                                // $('#Contratacion_espeplanos').attr('disabled', true);
                                                document.getElementById("Contratacion_espeplanos").disabled  = false;
                                                document.getElementById("Contratacion_image3").disabled = false;
                                                }
                                            else {
                                                document.getElementById("Contratacion_espeplanos").disabled  = false;
                                                document.getElementById("Contratacion_image3").disabled = false;
                                            }

                                        },
                                        beforeSend: function() {
                                            jQuery('.popup .middle').addClass('loading');
                                        },
                                        complete: function() {
                                            jQuery('.popup .middle').removeClass('loading');
                                        }
                                    });
                                }
                    </script>

<?php //echo $resultX['idmetodo']; ?>
