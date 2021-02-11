<ul id="tabs">
    
    <li id=""><a href="#" name="tab01">Planificación del Proyecto</a></li>
    <li id=""><a href="#" name="tab02">Invitación y Calificación</a></li>
    <li id=""><a href="#" name="tab03">Adjudicación</a></li>
    <li id=""><a href="#" name="tab04">Contratación</a></li>
    <li id=""><a href="#" name="tab05">Gestión de los Contratos</a></li>
    <li id=""><a href="#" name="tab06">Implementación</a></li>
    <li id=""><a href="#" name="tab07">Avances</a></li>
    <li id=""><a href="#" name="tab08">Garantías</a></li>
    <li id=""><a href="#" name="tab09">Gráficos</a></li>
    <li id=""><a href="#" name="tab10">Mapa</a></li>
    <li id=""><a href="#" name="tab11">Finalización</a></li>
</ul>
<div id="content">
    <div id="tab01" name="tab01">
        <!-- **************** PLANIFICACION DE PROYECTOS **************** -->
        <?php if (!empty($proyecto)) { ?>
        <table  class="general">
            <tr>
                <td width="49%" valign="top" style="text-align:left;">
                    <table width="100%">
                        <tr>
                            <td width="25%"><strong>Id del Proyecto:<strong></td>
                            <td><?php echo (!empty($proyecto[0]['idProyecto'])) ? $proyecto[0]['idProyecto'] : 'No ha divulgado esta información';?></td>
                        </tr>
                        <tr>
                            <td width="25%"><strong>Código:<strong></td>
                            <td><?php echo (!empty($proyecto[0]['codigo'])) ? $proyecto[0]['codigo'] : 'No ha divulgado esta información';?></td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Nombre del Proyecto:<strong></td>
                            <td> <?php echo (!empty($proyecto[0]['nombre_proyecto'])) ? $proyecto[0]['nombre_proyecto'] : 'No ha divulgado esta información';?>  </td>
                        </tr>
                        <tr>
                            <td width="10%"><strong>Departamento:<strong></td>
                            <td> <?php echo $proyecto_departamento;?> </td>
                        </tr>
                        <tr>
                            <td width="10%"><strong>Fecha de Publicación:</strong></td>
                            <td><?php echo (!empty($proyecto[0]['fecha_publicacion'])) ? $proyecto[0]['fecha_publicacion'] : 'No ha divulgado esta información'; ?></td>
                        </tr>
                        <tr>
                            <td width="10%"><strong>Sector:</strong></td>
                            <td><?php echo (!empty($proyecto[0]['proyecto_sector'])) ? $proyecto[0]['proyecto_sector'] : 'No ha divulgado esta información'; ?></td>
                        </tr>
                        <tr>
                            <td width="10%"><strong>Sub Sector:</strong></td>
                            <td><?php echo (!empty($proyecto[0]['proyecto_subsector'])) ? $proyecto[0]['proyecto_subsector'] : 'No ha divulgado esta información'; ?></td>
                        </tr>
                        <tr>
                            <td width="10%"><strong>Proposito:</strong></td>
                            <td><?php echo (!empty($proyecto[0]['proyecto_proposito'])) ? $proyecto[0]['proyecto_proposito'] : 'No ha divulgado esta información'; ?></td>
                        </tr>
                        <tr>
                            <td width="10%"><strong>Latitud 1:</strong></td>
                            <td><?php echo (!empty($proyecto[0]['lat1'])) ? $proyecto[0]['lat1'] : 'No ha divulgado esta información'; ?></td>
                        </tr>
                        <tr>
                            <td width="10%"><strong>Longitud 1:</strong></td>
                            <td><?php echo (!empty($proyecto[0]['lon1'])) ? $proyecto[0]['lon1'] : 'No ha divulgado esta información'; ?></td>
                        </tr>
                        <tr>
                            <td width="10%"><strong>Latitud 2:</strong></td>
                            <td><?php echo (!empty($proyecto[0]['lat2'])) ? $proyecto[0]['lat2'] : 'No ha divulgado esta información'; ?></td>
                        </tr>
                        <tr>
                            <td width="10%"><strong>Longitud 2:</strong></td>
                            <td><?php echo (!empty($proyecto[0]['lon2'])) ? $proyecto[0]['lon2'] : 'No ha divulgado esta información'; ?></td>
                        </tr>
                    </table>
                </td>
                <td width="2%">&nbsp;</td>
                <td width="49%" valign="top" class="general-031e"  style="text-align:left;">
                    <table width="100%">
                        <tr>
                            <td width="10%"><strong>Presupuesto:<strong></td>
                            <td>L. <?php echo (!empty($proyecto[0]['presupuesto'])) ? number_format($proyecto[0]['presupuesto'], 2) : 'No ha divulgado esta información';?></td>
                        </tr>
                        <tr>
                            <td width="10%"><strong>Descripción:<strong></td>
                            <td> <?php echo (!empty($proyecto[0]['descrip'])) ? $proyecto[0]['descrip'] : 'No ha divulgado esta información';?></td>
                        </tr>
                        <tr>
                            <td width="25%"><strong>Fecha de Aprobación:<strong></td>
                            <td>  <?php echo (!empty($proyecto[0]['fechaaprob'])) ? $proyecto[0]['fechaaprob'] : 'No ha divulgado esta información';?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br/>
        <table  class="general">
            <tr>
                <td width="49%" valign="top" style="text-align:left;">
                    <table  class="general" border=1 width="100%">
                        <tr>
                            <th colspan="2">Detalles de contacto</th>
                        </tr>
                        <tr>
                            <td width="50%" valign="top" style="text-align:left;">
                                <table width="100%">
                                    <tr>
                                        <td width="10%"><strong>Nombre:<strong></td>
                                        <td><?php echo (!empty($proyecto[0]['funcionario_nombre'])) ? $proyecto[0]['funcionario_nombre'] : 'No ha divulgado esta información';?></td>
                                    </tr>
                                    <tr>
                                        <td width="10%"><strong>Puesto:<strong></td>
                                        <td><?php echo (!empty($proyecto[0]['funcionario_puesto'])) ? $proyecto[0]['funcionario_puesto'] : 'No ha divulgado esta información';?></td>
                                    </tr>
                                    <tr>
                                        <td width="10%"><strong>Correo:<strong></td>
                                        <td><?php echo (!empty($proyecto[0]['funcionario_correo'])) ? $proyecto[0]['funcionario_correo'] : 'No ha divulgado esta información';?></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="50%" valign="top" class="general-031e"  style="text-align:left;">
                                <table width="100%">
                                    <tr>
                                        <td width="10%"><strong>Teléfono:<strong></td>
                                        <td><?php echo (!empty($proyecto[0]['funcionario_telefono'])) ? $proyecto[0]['funcionario_telefono'] : 'No ha divulgado esta información';?></td>
                                    </tr>
                                    <tr>
                                        <td width="20%"><strong>Entidad:<strong></td>
                                        <td><?php echo (!empty($proyecto[0]['funcionario_ente'])) ? $proyecto[0]['funcionario_ente'] : 'No ha divulgado esta información';?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="1%">&nbsp;</td>
                <td width="50%" valign="top">
                    <table  class="general" border=1 width="100%">
                        <tr>
                            <th style="text-align:left;">Fuente de financiamiento</th>
                            <th style="text-align:left;">Monto</th>
                            <th style="text-align:left;">Moneda</th>
                            <th style="text-align:left;">Tasa</th>
                        </tr>
                        <?php
                            $row      = 0;
                            $total_x  = count($proyecto_fuente);
                            $td_style = false;
                            while ($row < $total_x) {
                            ?>
                        <tr>
                            <?php  if ($td_style == false) { ?>
                            <td class="fila_blanco" style="text-align:left;"><?php echo $proyecto_fuente[$row]['fuente']; ?></td>
                            <td class="fila_blanco" style="text-align:left;"><?php echo number_format($proyecto_fuente[$row]['monto'], 2, '.', ','); ?></td>
                            <td class="fila_blanco" style="text-align:left;"><?php echo $proyecto_fuente[$row]['moneda']; ?></td>
                            <td class="fila_blanco" style="text-align:left;"><?php echo number_format($proyecto_fuente[$row]['tasa_cambio'], 2, '.', ','); ?></td>
                            <?php    $td_style = true;
                                } else {
                                ?>
                            <td class="fila_azul"><?php echo $proyecto_fuente[$row]['fuente'];?></td>
                            <td class="fila_azul"><?php echo number_format($proyecto_fuente[$row]['monto'], 2, '.', ',');?></td>
                            <td class="fila_azul"><?php echo $proyecto_fuente[$row]['moneda'];?></td>
                            <td class="fila_azul"><?php echo number_format($proyecto_fuente[$row]['tasa_cambio'], 2, '.', ',');?></td>
                            <?php
                                $td_style = false;
                                }
                                ?>
                        </tr>
                        <?php
                            $row++;
                            }
                            ?>
                    </table>
                </td>
            </tr>
        </table>
        <br/>
        <table class="tabla_interna" width="100%">
            <tr>
                <th>Código Departamento</th>
                <th>Departamento</th>
                <th>Código Municipio</th>
                <th>Municipio</th>
                <th>Beneficio</th>
            </tr>
            <?php
                $row     = 0;
                $total_x = count($proyecto_beneficiario);
                $td_style = false;
                while ($row < $total_x) { ?>
            <tr>
                <?php if ($td_style == false) { ?>
                <td class="fila_blanco"><?php echo $proyecto_beneficiario[$row]['idDepartamento'];?></td>
                <td class="fila_blanco"><?php echo $proyecto_beneficiario[$row]['departamento'];?></td>
                <td class="fila_blanco"><?php echo $proyecto_beneficiario[$row]['idMunicipio'];?></td>
                <td class="fila_blanco"><?php echo $proyecto_beneficiario[$row]['municipio'];?></td>
                <td class="fila_blanco"><?php echo $proyecto_beneficiario[$row]['Beneficio'];?></td>
                <?php   $td_style = true;
                    } else { ?>
                <td class="fila_azul"><?php echo $proyecto_beneficiario[$row]['idDepartamento'];?></td>
                <td class="fila_azul"><?php echo $proyecto_beneficiario[$row]['departamento'];?></td>
                <td class="fila_azul"><?php echo $proyecto_beneficiario[$row]['idMunicipio'];?></td>
                <td class="fila_azul"><?php echo $proyecto_beneficiario[$row]['municipio'];?></td>
                <td class="fila_azul"><?php echo $proyecto_beneficiario[$row]['Beneficio'];?></td>
                <?php $td_style = false;
                    } ?>
            </tr>
            <?php $row++;
                } ?>
        </table>
        <br/>
        <table class="general">
            <tr>
                <td style="text-align:center">
                    <?php echo CHtml::Button('Ver información de respaldo', array('onclick' => '$("#respProyecto").dialog("open"); return false;')); ?>
                </td>
            </tr>
        </table>
        <?php
            } ?>
    </div>
    <div style="display: none;" id="tab02">
        <!-- ********************* INVITACION Y CALIFICACION ***************** -->
        <?php if (!empty($calificacion)) { ?>
        <table  class="general">
            <tr>
                <td width="49%" valign="top" style="text-align:left;">
                    <table width="100%" id="InvitacionCalificacion">
                        <tr>
                            <td> <strong>Id de Calificación:<strong></td>
                            <td><?php echo (!empty($calificacion[0]['idCalificacion'])) ? $calificacion[0]['idCalificacion'] : 'No ha divulgado esta información'; ?></td>
                        </tr>
                        <tr>
                            <td ><strong>Número de Calificación:<strong></td>
                            <td ><?php echo (!empty($calificacion[0]['numproceso'])) ? $calificacion[0]['numproceso'] : 'No ha divulgado esta información'; ?></td>
                        </tr>
                        <tr>
                            <td ><strong>Nombre:<strong></td>
                            <td ><?php echo (!empty($calificacion[0]['nomprocesoproyecto'])) ? $calificacion[0]['nomprocesoproyecto'] : 'No ha divulgado esta información';?>   </td>
                        </tr>
                        <tr>
                            <td ><strong>Método de Adquisiciones:<strong></td>
                            <?php $MetodoAdquisicion   = (is_numeric($calificacion[0]['idMetodo']))?Yii::app()->db->createCommand('SELECT adquisicion FROM `cs_metodo` WHERE idMetodo ='.$calificacion[0]['idMetodo'])->queryAll():null;  ?>
                            <td><?php echo (!empty($MetodoAdquisicion[0]['adquisicion'])) ? $MetodoAdquisicion[0]['adquisicion'] : 'No ha divulgado esta información';?>   </td>
                        </tr>
                        <tr>
                            <td ><strong>Proceso de Evaluación:<strong></td>
                            <?php $ProcesoEvaluacion   = Yii::app()->db->createCommand('SELECT ma.nombre as proceseval FROM `cs_metodo_adjudicacion` ma JOIN cs_calificacion cali ON cali.proceseval=ma.idMetodoAdjudicacion WHERE cali.idCalificacion='.$calificacion[0]['idCalificacion'])->queryAll();  ?>
                            <td><?php echo (!empty($ProcesoEvaluacion[0]['proceseval'])) ? $ProcesoEvaluacion[0]['proceseval'] : 'No ha divulgado esta información';?></td>
                        </tr>
                        <tr>
                            <td width="10%"><strong>Número de Empresas Participantes:</strong></td>
                            <?php $nparticipate=Yii::app()->db->createCommand('SELECT count(*) n FROM cs_calificacion_oferente WHERE idCalificacion ='.$calificacion[0]['idCalificacion'])->queryAll(); ?>
                            <td><?php echo (!empty($adjudicacion[0]['nparticipantes'])) ? $adjudicacion[0]['nparticipantes'] : $nparticipate[0]['n'] ?></td>
                        </tr>
                        <tr>
                            <td ><strong>Fecha de Publicación:<strong></td>
                            <td> <?php echo ((!empty($calificacion[0]['fecha_publicacion'])) ? str_replace('-','/',$calificacion[0]['fecha_publicacion']) : 'No ha divulgado esta información'); ?></td>
                        </tr>
                        <tr>
                            <td ><strong>Tipo de Contrato:<strong></td>
                            <?php $TipoContrato  = Yii::app()->db->createCommand('SELECT contrato FROM cs_tipocontrato WHERE idTipoContrato ='.$calificacion[0]['idTipoContrato'])->queryAll();  ?>
                            <td><?php echo (!empty($TipoContrato[0]['contrato'])) ? $TipoContrato[0]['contrato'] : 'No ha divulgado esta información';?></td>
                        </tr>
                    </table>
                </td>
                <br/>
                <table  class="general">
                    <tr>
                        <td width="49%" valign="top" style="text-align:left;">
                            <table  class="general" border=1 width="100%">
                                <tr>
                                    <th colspan="2">Detalles de contacto</th>
                                </tr>
                                <tr>
                                    <td width="50%" valign="top" style="text-align:left;">
                                        <table width="100%">
                                            <tr>
                                                <td width="10%"><strong>Nombre:<strong></td>
                                                <td><?php echo (!empty($calificacion[0]['funcionario_nombre'])) ? $calificacion[0]['funcionario_nombre'] : 'No ha divulgado esta información';?></td>
                                            </tr>
                                            <tr>
                                                <td width="10%"><strong>Puesto:<strong></td>
                                                <td>   <?php echo (!empty($calificacion[0]['funcionario_puesto'])) ? $calificacion[0]['funcionario_puesto'] : 'No ha divulgado esta información';?></td>
                                            </tr>
                                            <tr>
                                                <td width="10%"><strong>Correo:<strong></td>
                                                <td><?php echo (!empty($calificacion[0]['funcionario_correo'])) ? $calificacion[0]['funcionario_correo'] : 'No ha divulgado esta información';?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="50%" valign="top" class="general-031e"  style="text-align:left;">
                                        <table width="100%">
                                            <tr>
                                                <td width="10%"><strong>Teléfono:<strong></td>
                                                <td><?php echo (!empty($calificacion[0]['funcionario_telefono'])) ? $calificacion[0]['funcionario_telefono'] : 'No ha divulgado esta información';?></td>
                                            </tr>
                                            <tr>
                                                <td width="20%"><strong>Entidad:<strong></td>
                                                <td><?php echo (!empty($calificacion[0]['funcionario_ente'])) ? $calificacion[0]['funcionario_ente'] : 'No ha divulgado esta información';?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="1%">&nbsp;</td>
                        <td width="50%" valign="top">
                            <table  class="general" border=1 width="100%">
                                <tr>
                                    <th colspan="2">Nombres de los Oferentes</th>
                                </tr>
                                <?php $nombresOferentes= Yii::app()->db->createCommand('SELECT nombre_oferente FROM cs_oferente WHERE idOferente in (SELECT idOferente FROM cs_calificacion_oferente WHERE idCalificacion='.$calificacion[0]['idCalificacion'].')')->queryAll();?>
                                <?php
                                    $conteo=1;
                                    foreach ($nombresOferentes as $nombresoferentes) {
                                        echo '<tr><td width="50%" valign="top" style="text-align:left;">';
                                        echo '<b>'.$conteo++.'</b>'.'-) '.$nombresoferentes['nombre_oferente'];
                                        echo '</td></tr>';
                                    }
                                    ?>
                                <td width="50%" valign="top" style="text-align:left;">
                            </table>
                        </td>
                    </tr>
                </table>
                </td><?php
                    if ($calificacion[0]['idTipoContrato'] === 'Diseí±o' || $calificacion[0]['idTipoContrato'] === 'Supervision' || $calificacion[0]['idTipoContrato'] === 'Diseí±o y Supervision') { ?>
                <table class="tabla_interna" width="100%">
                    <tr>
                        <th>Firmas</th>
                    </tr>
                    <?php
                        $row      = 0;
                        $total_x  = count($calificacion_firma);
                        $td_style = false;
                        while ($row < $total_x) {
                        ?>
                    <tr>
                        <?php
                            if ($td_style == false) {
                            ?>
                        <td class="fila_blanco"><?php
                            echo $calificacion_firma[$row]['nombre_firma'];
                            ?></td>
                        <?php
                            $td_style = true;
                            } else {
                            ?>
                        <td class="fila_azul"><?php
                            echo $calificacion_firma[$row]['nombre_firma'];
                            ?></td>
                        <?php
                            $td_style = false;
                            }
                            ?>
                    </tr>
                    <?php
                        $row++;
                        }
                        ?>
                </table>
                <?php
                    } else if ($calificacion[0]['idTipoContrato'] === 'Mantenimiento' || $calificacion[0]['idTipoContrato'] === 'Construcción') {
                    ?>
                <table class="tabla_interna" width="100%">
                    <tr>
                        <th>Oferentes</th>
                    </tr>
                    <?php
                        $row      = 0;
                        $total_x  = count($calificacion_oferente);
                        $td_style = false;
                        while ($row < $total_x) {
                        ?>
                    <tr>
                        <?php
                            if ($td_style == false) {
                            ?>
                        <td class="fila_blanco"><?php
                            echo $calificacion_oferente[$row]['nombre_oferente'];
                            ?></td>
                        <?php
                            $td_style = true;
                            } else {
                            ?>
                        <td class="fila_azul"><?php
                            echo $calificacion_oferente[$row]['nombre_oferente'];
                            ?></td>
                        <?php
                            $td_style = false;
                            }
                            ?>
                    </tr>
                    <?php
                        $row++;
                        }
                        ?>
                </table>
                <?php
                    }
                    ?>
                </td>
            </tr>
        </table>
        <br/>
        <table class="general">
            <tr>
                <td style="text-align:center">
                    <?php echo CHtml::Button('Ver información de respaldo', array(
                        'onclick' => '$("#respCalificacion").dialog("open"); return false;'
                        ));
                        ?>
                </td>
            </tr>
        </table>
        <?php
            }else {
              echo "<p>No ha divulgado esta información </p>";
            }
            ?>
    </div>
    <div style="display: none;" id="tab03">
        <!-- **************** ADJUDICACION **************** -->
        <?php
            if (!empty($adjudicacion)) {
            ?>
        <table  class="general" id="AjudicacionTable">
            <tr>
                <td width="60%" valign="top" style="text-align:left;">
                    <table width="100%">
                        <tr>
                            <td width="30%"><strong>Id de Adjudicación:<strong></td>
                            <td> <?php echo (!empty($adjudicacion[0]['idAdjudicacion'])) ? $adjudicacion[0]['idAdjudicacion'] : 'No ha divulgado esta información';?></td>
                        </tr>
                        <tr>
                            <td width="24%"><strong>Número de Adjudicación:<strong></td>
                            <td> <?php echo (!empty($adjudicacion[0]['numproceso'])) ? $adjudicacion[0]['numproceso'] : 'No ha divulgado esta información';
                                ?></td>
                        </tr>
                        <tr>
                            <td width="10%"><strong>Costo Estimado:<strong></td>
                            <td> L.<?php echo (!empty($adjudicacion[0]['costoesti'])) ? number_format($adjudicacion[0]['costoesti'], 2) : 'No ha divulgado esta información';?></td>
                        </tr>
                        <tr>
                            <td width="10%"><strong>Costo del Contrato:<strong></td>
                            <?php
                                $C1   = Yii::app()->db->createCommand('SELECT precioactual FROM `cs_contratos` WHERE idContratacion ='.$contratacion[0]['idContratacion'].'  and nmodifica=(SELECT max(nmodifica) FROM cs_contratos WHERE idContratacion='.$contratacion[0]['idContratacion'].')')->queryAll();
                                if (empty($C1)) {
                                  $C1   = Yii::app()->db->createCommand('SELECT precioLPS as precioactual FROM `cs_contratacion` WHERE idContratacion='.$contratacion[0]['idContratacion'])->queryAll();
                                }
                                ?>
                            <td> L.<?php echo (!empty($C1[0]['precioactual'])) ? number_format($C1[0]['precioactual'], 2) : 'No ha divulgado esta información';?></td>
                        </tr>

                        <tr>
                            <td width="10%"><strong>Método de la Adjudicación:<strong></td>
                            <?php $metodoAdjudicacion=Yii::app()->db->createCommand('SELECT nombre FROM cs_metodo_adjudicacion WHERE idMetodoAdjudicacion='.$adjudicacion[0]['idMetodoAdjudicacion'])->queryAll(); ?>
                            <td><?php echo (!empty($metodoAdjudicacion[0]['nombre'])) ? $metodoAdjudicacion[0]['nombre'] : 'No ha divulgado esta información';?></td>
                        </tr>
                        <tr>
                        <tr>
                            <td ><strong>Fecha de Publicación:<strong></td>
                            <td> <?php echo ((!empty($adjudicacion[0]['fecha_publicacion'])) ? str_replace('-','/',$adjudicacion[0]['fecha_publicacion']) : 'No ha divulgado esta información'); ?></td>
                        </tr>
                        <tr>
                            <td width="10%"><strong>Método de evaluación:<strong></td>
                            <?php $metodoEvaluacion=Yii::app()->db->createCommand('SELECT m.adquisicion FROM cs_metodo m WHERE m.idMetodo=(SELECT cali.idmetodo from cs_calificacion cali WHERE cali.idCalificacion='.$calificacion[0]['idCalificacion'].')')->queryAll(); ?>
                            <td><?php echo (!empty($metodoEvaluacion[0]['adquisicion'])) ? $metodoEvaluacion[0]['adquisicion'] : 'No ha divulgado esta información';?></td>
                        </tr>
                    </table>
                </td>
                <td width="2%">&nbsp;</td>
                <td width="49%" valign="top" style="text-align:left;">&nbsp;</td>
            </tr>
        </table>
        <br/>
        <!-- <table  class="general">
            <tr>
                <td width="49%" valign="top" style="text-align:left;">
                    <table class="tabla_interna" width="100%">
                        <tr>
                            <th colspan="2">Consultores</th>
                        </tr>
                        <tr>
                            <td class="fila_blanco"><strong>Nacionales:<strong></td>
                            <td class="fila_blanco"><?php// echo (!empty($adjudicacion[0]['adjudicacion_consultores_nacionales'])) ? $adjudicacion[0]['adjudicacion_consultores_nacionales'] : 'No ha divulgado esta información';
                                ?></td>
                            <div style="margin:10px"></div>
                        <tr>
                            <td class="fila_azul"><strong>Internacionales:<strong></td>
                            <td class="fila_azul"><?php //echo (!empty($adjudicacion[0]['adjudicacion_consultores_internacionales'])) ? $adjudicacion[0]['adjudicacion_consultores_internacionales'] : 'No ha divulgado esta información';
                                ?></td>
                        </tr>
                    </table> -->
                </td>
                <td width="1%">&nbsp;</td>
                <td width="50%" valign="top">
                    <!-- <table class="tabla_interna" width="100%">
                        <tr>
                            <th colspan="2">Firmas que Licitarón</th>
                        </tr>
                        <tr>
                            <td class="fila_blanco"><strong>Nacionales:<strong></td>
                            <td class="fila_blanco"><?php //echo (!empty($adjudicacion[0]['adjudicacion_firmas_nacionales'])) ? $adjudicacion[0]['adjudicacion_firmas_nacionales'] : 'No ha divulgado esta información';
                                ?></td>
                            <div style="margin:10px"></div>
                        <tr>
                            <td class="fila_azul"><strong>Internacionales:<strong></td>
                            <td class="fila_azul"><?php //echo (!empty($adjudicacion[0]['adjudicacion_firmas_internacionales'])) ? $adjudicacion[0]['adjudicacion_firmas_internacionales'] : 'No ha divulgado esta información';
                                ?></td>
                        </tr>
                    </table> -->
                </td>
            </tr>
        </table>
        <br/>
        <table class="general">
            <tr>
                <td style="text-align:center">
                    <?php echo CHtml::Button('Ver información de respaldo', array(
                        'onclick' => '$("#respAdjudicacion").dialog("open"); return false;'
                        ));
                        ?>
                </td>
            </tr>
        </table>
        <?php
            }
            else {
              echo "<p>No ha divulgado esta información </p>";
            }
            ?>
    </div>
    <div style="display: none;" id="tab04">
        <!-- **************** CONTRATACION **************** -->
        <?php
            if (!empty($contratacion)) {
            ?>
        <table class="general">
            <tr>
                <td width="30%">
                    <table>
                        <tr>
                            <td width="30%"><strong>Id de Contratación:<strong></td>
                            <td style="width:50px;"> <?php echo (!empty($contratacion[0]['idContratacion'])) ? $contratacion[0]['idContratacion'] : '1';?></td>
                        </tr>
                        <tr>
                            <td ><strong>Número de Contratación:<strong></td>
                            <td> <?php echo (!empty($contratacion[0]['ncontrato'])) ? $contratacion[0]['ncontrato'] : 'No ha divulgado esta información';?></td>
                        </tr>
                        <tr>
                            <td ><strong>Nombre:<strong></td>
                            <td><?php echo (!empty($contratacion[0]['titulocontrato'])) ? $contratacion[0]['titulocontrato'] : 'No ha divulgado esta información';?> </td>
                        </tr>
                        <tr>
                            <td ><strong>Entidad:<strong></td>
                            <td> <?php echo (!empty($contratacion[0]['entes_nombre'])) ? $contratacion[0]['entes_nombre'] : 'No ha divulgado esta información';?></td>
                        </tr>
                        <tr>
                            <td ><strong>Empresa:<strong></td>
                            <td> <?php echo (!empty($contratacion[0]['nombre_oferente'])) ? $contratacion[0]['nombre_oferente'] : 'No ha divulgado esta información';?></td>
                        </tr>
                        <tr>
                            <td ><strong>Alcance:<strong></td>
                            <td><?php echo (!empty($contratacion[0]['alcances'])) ? $contratacion[0]['alcances'] : 'No ha divulgado esta información';?></td>
                        </tr>
                    </table>
                </td>
                <td width="2%">&nbsp;</td>
                <td width="30%">
                    <table>
                        <tr>
                            <td ><strong>Costo del Contrato:<strong></td>
                            <?php
                                $C1   = Yii::app()->db->createCommand('SELECT precioactual FROM `cs_contratos` WHERE idContratacion ='.$contratacion[0]['idContratacion'].'  and nmodifica=(SELECT max(nmodifica) FROM cs_contratos WHERE idContratacion='.$contratacion[0]['idContratacion'].')')->queryAll();
                                if (empty($C1)) {
                                  $C1   = Yii::app()->db->createCommand('SELECT precioLPS as precioactual FROM `cs_contratacion` WHERE idContratacion='.$contratacion[0]['idContratacion'])->queryAll();
                                }
                                ?>
                            <td> L.<?php echo (!empty($C1[0]['precioactual'])) ? number_format($C1[0]['precioactual'], 2) : 'No ha divulgado esta información';?></td>
                        </tr>
                        <tr>
                            <td width="30%"><strong>Fecha de Inicio:<strong></td>
                            <td> <?php echo (!empty($contratacion[0]['fechainicio'])) ? $contratacion[0]['fechainicio'] : 'No ha divulgado esta información';?></td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Fecha Final:<strong></td>
                            <td> <?php echo (!empty($contratacion[0]['fechafinal'])) ? $contratacion[0]['fechafinal'] : 'No ha divulgado esta información';?></td>
                        </tr>
                        <tr>
                            <td ><strong>Costo L.:<strong></td>
                            <td> <?php echo (!empty($contratacion[0]['precioLPS'])) ? number_format($contratacion[0]['precioLPS'], 2) : 'No ha divulgado esta información';?></td>
                        </tr>
                        <tr>
                            <td ><strong>Costo Equivalente $:<strong></td>
                            <td>  <?php echo (!empty($contratacion[0]['precioUSD'])) ? number_format($contratacion[0]['precioUSD'], 2) : 'No ha divulgado esta información';?></td>
                        </tr>
                        <tr>
                            <td width="30%"><strong>Fecha de Publicación:<strong></td>
                            <td> <?php echo (!empty($contratacion[0]['fecha_publicacion'])) ? $contratacion[0]['fecha_publicacion'] : 'No ha divulgado esta información';?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="general">
            <tr>
                <td style="text-align:center">
                    <?php echo CHtml::Button('Ver información de respaldo', array(
                        'onclick' => '$("#respContratacion").dialog("open"); return false;'
                        ));
                        ?>
                </td>
            </tr>
        </table>
        <?php
            }
            else {
              echo "<p>No ha divulgado esta información </p>";
            }
            ?>
    </div>
    <div style="display: none;" id="tab05">
        <!-- **************** GESTION DE CONTRATOS **************** -->
        <?php
            if (!empty($contratos_gestion)) {
                $IdContr   = $contratacion[0]['idContratacion'];
                $ids       = $_GET['id'];
                $rowContra = Yii::app()->db->createCommand()->select('*')->from('vContratos')->where('idContratacion=:id', array(
                    ':id' => $IdContr
                ))->order('nmodifica')->queryAll();
                $rowc      = 0;
                $total_c   = count($rowContra);
                if (!empty($rowContra)) {
            ?>
        <table class="tabla_interna" width="100%">
            <tr>
                <th>Fecha de Modificación del Contrato</th>
                <th>Número de Modificación</th>
                <th>Tipo Modificacion</th>
                <th>Precio Actualizado del Contrato en Lempiras</th>
                <th>Documentos</th>
            </tr>
            <?php
                $style = "fila_blanco";
                while ($rowc < $total_c) {
                    if ($rowc % 2 == 0) {
                        $style = "fila_blanco";
                    } else {
                        $style = "fila_azul";
                    }
                ?>
            <tr>
                <td class="<?php echo $style;
                    ?>"><?php echo $rowContra[$rowc]['fecha'];
                    ?></td>
                <td class="<?php echo $style;
                    ?>"><?php echo $rowContra[$rowc]['nmodifica'];
                    ?></td>
                <td class="<?php echo $style;
                    ?>"><?php echo $rowContra[$rowc]['tipomodifica'];
                    ?></td>
                <td class="<?php echo $style;
                    ?>"><?php echo number_format($rowContra[$rowc]['precioactual']);
                    ?></td>
                <td class="<?php echo $style;
                    ?>">    <?php
                    $codi = $rowContra[$rowc]['idContratos']; echo CHtml::Button('Ver información de respaldo', array(
                        'onclick' => "$('#respContratacion$codi').dialog('open'); return false;"
                    ));
                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id' => "respContratacion$codi",
                        'options' => array(
                            'title' => 'Información de Respaldo de Contratación',
                            'autoOpen' => false,
                            'modal' => true,
                            'width' => 900,
                            'resizable' => false,
                            'show' => array(
                                'effect' => 'blind',
                                'duration' => 1000,
                                'scrolling' => false
                            ),
                            'hide' => array(
                                'effect' => 'blind',
                                'duration' => 500
                            )
                        )
                    ));
                    $this->widget('zii.widgets.CDetailView', array(
                        'data' => $rowContra[$rowc],
                        'attributes' => array(
                            array(
                                'label' => 'Adendas a los Contratos Debidamente Suscritas',
                                'type' => 'raw',
                                'value' => CHtml::link(CHtml::encode($this->getNameFromURL($rowContra[$rowc]['adendas'])), $this->getNameFromEnlace($rowContra[$rowc]['adendas']), array(
                                    'target' => '_blank'
                                ))
                            ),
                            array(
                                'label' => 'Programa Actualizado de Trabajo',
                                'type' => 'raw',
                                'value' => CHtml::link(CHtml::encode($this->getNameFromURL($rowContra[$rowc]['prograactu'])), $this->getNameFromEnlace($rowContra[$rowc]['prograactu']), array(
                                    'target' => '_blank'
                                ))
                            ),
                            array(
                                'label' => 'Otro',
                                'type' => 'raw',
                                'value' => CHtml::link(CHtml::encode($this->getNameFromURL($rowContra[$rowc]['otro'])), $this->getNameFromEnlace($rowContra[$rowc]['otro']), array(
                                    'target' => '_blank'
                                ))
                            )
                        )
                    ));
                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                    ?>
                </td>
            </tr>
            <?php
                $rowc++;
                }
                ?>
        </table>
        <?php
            } else {
                echo 'No se han realizado modificaciones a este contrato';
            }
            }
            else {
            echo "<p>No ha divulgado esta información </p>";
            }
            ?>
    </div>
    <div style="display: none;" id="tab06">
        <!-- **************** INICIO DE EJECUCION **************** -->
        <?php
            if (!empty($ejecucion)) {
                ?>
        <h4>Datos de contacto del proveedor de los servicios</h4>
        <hr/>
        <table width="50%">
            <tr>
                <td width="46%"><strong>Id Implementación:<strong></td>
                <td width="54%"><?php echo (!empty($ejecucion[0]['idInicioEjecucion'])) ? $ejecucion[0]['idInicioEjecucion'] : 'No ha divulgado esta información';?></td>
            </tr>
            <tr>
                <td width="46%"><strong>Id Contratacion:<strong></td>
                <td><?php echo (!empty($ejecucion[0]['idContratacion'])) ? $ejecucion[0]['idContratacion'] : 'No ha divulgado esta información';?></td>
            </tr>
            <tr>
                <td width="46%"><strong>Nombre:<strong></td>
                <td><?php echo (!empty($ejecucion[0]['contacto_nombre'])) ? $ejecucion[0]['contacto_nombre'] : 'No ha divulgado esta información';
                    ?></td>
            </tr>
            <tr>
                <td width="46%"><strong>Dirección:<strong></td>
                <td> <?php echo (!empty($ejecucion[0]['contacto_direccion'])) ? $ejecucion[0]['contacto_direccion'] : 'No ha divulgado esta información';
                    ?> </td>
            </tr>
            <tr>
                <td width="46%"><strong>Teléfono Fijo:<strong></td>
                <td>  <?php echo (!empty($ejecucion[0]['contacto_telefono'])) ? $ejecucion[0]['contacto_telefono'] : 'No ha divulgado esta información';
                    ?></td>
            </tr>
            <tr>
                <td width="46%"><strong>Correo Electrónico:<strong></td>
                <td><?php echo (!empty($ejecucion[0]['contacto_email'])) ? $ejecucion[0]['contacto_email'] : 'No ha divulgado esta información';
                    ?> </td>
            </tr>
            <tr>
                <td width="46%"><strong>Fecha Publicado:<strong></td>
                <td><?php echo (!empty($ejecucion[0]['fecha_publicado'])) ? $ejecucion[0]['fecha_publicado'] : 'No ha divulgado esta información';
                    ?> </td>
            </tr>
            <tr>
              <td width="20%"><strong>Fecha de Inicio:<strong></td>
              <td style="text-align:left;">
                <?php $fechaIP = explode("-", $ejecucion[0]['fecha_inicio']);
                      if ($fechaIP[0] == "00") {
                      } else {
                          echo date('d/m/Y', strtotime($ejecucion[0]['fecha_inicio']));
                      }
                  ?>
              </td>
            </tr>
        </table>
        <br/>
        <table class="general">
            <td>
                </br>
                <!-- Inicio Tabla -->
                <div>
                    <?php
                        if (empty($desembolso)) {
                            $desembolso = Yii::app()->db->createCommand()->select('*')->from('cs_desembolsos_montos')->where('idInicioEjecucion=:id', array(':id' => $ejecucion[0]['idInicioEjecucion']))->order(array('desembolso ASC'))->queryAll();
                            $rowY       = 0;
                            $total_y    = count($desembolso);
                        }
                        else {
                            echo "<p>No ha divulgado esta información </p>";
                        }
                        if (!empty($desembolso)) {
                            ?>
                    <table class="tabla_interna" width="100%">
                        <tr>
                            <th>Número</th>
                            <th>Descripción</th>
                            <th>Monto</th>
                            <th>Fecha Desembolso</th>
                        </tr>
                        <?php
                            $td_style = false;
                            while ($rowY < $total_y) {
                                ?>
                        <tr>
                            <?php
                                if ($td_style == false) {
                                    ?>
                            <td class="fila_azul"><?php echo $desembolso[$rowY]['desembolso'];
                                ?></td>
                            <td class="fila_azul"><?php echo $desembolso[$rowY]['descripcion'];
                                ?></td>
                            <td class="fila_azul"><?php echo (!empty($desembolso[$rowY]['monto'])) ? number_format($desembolso[$rowY]['monto'], 2) : 'No ha divulgado esta información';
                                ?></td>
                            <td class="fila_azul"><?php echo $desembolso[$rowY]['fecha_desembolso'];
                                ?></td>
                            <?php
                                $td_style = true;
                                } else {
                                ?>
                            <td id="fila_blanco"><?php echo $desembolso[$rowY]['desembolso'];
                                ?></td>
                            <td id="fila_blanco"><?php echo $desembolso[$rowY]['descripcion'];
                                ?></td>
                            <td id="fila_blanco"><?php echo (!empty($desembolso[$rowY]['monto'])) ? number_format($desembolso[$rowY]['monto'], 2) : 'No ha divulgado esta información';
                                ?></td>
                            <td id="fila_blanco"><?php echo $desembolso[$rowY]['fecha_desembolso'];
                                ?></td>
                            <?php
                                $td_style = false;
                                }
                                ?>
                        </tr>
                        <?php
                            $rowY++;
                            }
                            ?>
                    </table>
                    <?php
                        }
                        else {
                            echo "<p>No ha divulgado esta información </p>";
                        }
                        ?>
                </div>
                <!-- Fin Tabla-->
            </td>
        </table>
        <table class="general">
            <td style="text-align:center">
                <?php echo CHtml::Button('Ver información de respaldo', array(
                    'onclick' => '$("#respEjecucion").dialog("open"); return false;'
                    ));
                    ?>
            </td>
        </table>
        <?php
            }
            else {
                echo "<p>No ha divulgado esta información </p>";
            }
            ?>
    </div>
    <div style="display: none;" id="tab07">
        <!-- **************** AVANCES **************** -->
        <?php
            if (!empty($avances)) {
                $total_x = count(Yii::app()->db->createCommand()
                                                  ->select('*')
                                                  ->from('v_avance_ft')
                                                  ->where('idContratacion=:id', array(':id' => $contratacion[0]['idContratacion']))
                                                  ->queryAll());
                $row     = 0;
                $total_x = count($avances);
            }

            if (!empty($avances)) {
            ?>
        <table class="tabla_interna" width="100%">
            <tr>
                <th>% Fí­sico Progra.</th>
                <th>% Fí­sico Real</th>
                <th>Finan. Progra.</th>
                <th>Finan. Real</th>
                <th>Fecha de Avance</th>
                <th>Descripción de Problemas</th>
                <th>Descripción de Temas</th>
                <th style="width:50px">Documentos</th>
                <th style="width:50px">Imágenes</th>
            </tr>
            <?php
                $td_style = false;
                while ($row < $total_x) {
                  if ($avances[$row]['estado'] == 'PUBLICADO') { ?>
            <tr>
                <td <?php echo ($td_style) ? 'class="fila_blanco"' : 'class="fila_azul"';?> >
                    <?php echo (!empty($avances[$row]['porcentaje_programado'])) ? number_format($avances[$row]['porcentaje_programado'], 2) : 'No ha divulgado esta información';?>
                </td>
                <td <?php echo ($td_style) ? 'class="fila_blanco"' : 'class="fila_azul"';?> >
                    <?php echo (!empty($avances[$row]['porcentaje_real'])) ? number_format($avances[$row]['porcentaje_real'], 2) : 'No ha divulgado esta información';?>
                </td>
                <td <?php echo ($td_style) ? 'class="fila_blanco"' : 'class="fila_azul"';?> >
                    <?php echo (!empty($avances[$row]['financiero_programado'])) ? number_format($avances[$row]['financiero_programado'], 2) : 'No ha divulgado esta información';?>
                </td>
                <td <?php echo ($td_style) ? 'class="fila_blanco"' : 'class="fila_azul"';?> >
                    <?php echo (!empty($avances[$row]['financiero_real'])) ? number_format($avances[$row]['financiero_real'], 2) : 'No ha divulgado esta información';?>
                </td>
                <td <?php echo ($td_style) ? 'class="fila_blanco"' : 'class="fila_azul"';?> >
                    <p align="left"><?php echo date('d/m/Y', strtotime($avances[$row]['fecha_avance']));?></p>
                </td>
                <td <?php echo ($td_style) ? 'class="fila_blanco"' : 'class="fila_azul"';?> >
                    <?php echo $avances[$row]['problemas'];?>
                </td>
                <td <?php echo ($td_style) ? 'class="fila_blanco"' : 'class="fila_azul"';?> >
                    <?php echo $avances[$row]['temas_relevantes'];?>
                </td>
                <td <?php echo ($td_style) ? 'class="fila_blanco"' : 'class="fila_azul"';?> >
                    <?php
                        $cod = $avances[$row]['idAvances']; echo CHtml::Button('Ver información', array('onclick' => "$('#respAvances$cod').dialog('open'); return false;"));
                        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                            'id' => "respAvances$cod",
                            'options' => array(
                                'title' => 'Información de respaldo de Avances',
                                'autoOpen' => false,
                                'modal' => true,
                                'width' => 900,
                                'resizable' => false,
                                'show' => array(
                                    'effect' => 'blind',
                                    'duration' => 1000,
                                    'scrolling' => false
                                ),
                                'hide' => array(
                                    'effect' => 'blind',
                                    'duration' => 500
                                )
                            )
                        ));
                            $this->widget('zii.widgets.CDetailView', array(
                                'data' => $avances[$row],
                                'attributes' => array(
                                    array(
                                        'label' => 'Documento de garantí­a que puede ser i) Fianza o Garantí­a bancaria, emitida por una institución financiera autorizada; ii) Bonos del Estado y; iii) Cheques Certificados',
                                        'type' => 'raw',
                                        'value' => CHtml::link(CHtml::encode($this->getNameFromURL($avances[$row]['adj_garantia'])), $avances[$row]['adj_garantia'], array(
                                            'target' => '_blank'
                                        ))
                                    ),
                                    array(
                                        'label' => 'Informes de avance de implementación que presentan los contratistas',
                                        'type' => 'raw',
                                        'value' => CHtml::link(CHtml::encode($this->getNameFromURL($avances[$row]['adj_avance'])), $avances[$row]['adj_avance'], array(
                                            'target' => '_blank'
                                        ))
                                    ),
                                    array(
                                        'label' => 'Informes de supervisión de la construcción',
                                        'type' => 'raw',
                                        'value' => CHtml::link(CHtml::encode($this->getNameFromURL($avances[$row]['adj_supervision'])), $avances[$row]['adj_supervision'], array(
                                            'target' => '_blank'
                                        ))
                                    ),
                                    array(
                                        'label' => 'Informes de evaluación de proyecto (continuos y al finalizar)',
                                        'type' => 'raw',
                                        'value' => CHtml::link(CHtml::encode($this->getNameFromURL($avances[$row]['adj_evaluacion'])), $avances[$row]['adj_evaluacion'], array(
                                            'target' => '_blank'
                                        ))
                                    ),
                                    array(
                                        'label' => 'Informes de auditorí­a técnica',
                                        'type' => 'raw',
                                        'value' => CHtml::link(CHtml::encode($this->getNameFromURL($avances[$row]['adj_auditoria_tecnica'])), $avances[$row]['adj_auditoria_tecnica'], array(
                                            'target' => '_blank'
                                        ))
                                    ),
                                    array(
                                        'label' => 'Informes de auditorí­a financiera',
                                        'type' => 'raw',
                                        'value' => CHtml::link(CHtml::encode($this->getNameFromURL($avances[$row]['adj_auditoria_financiera'])), $avances[$row]['adj_auditoria_financiera'], array(
                                            'target' => '_blank'
                                        ))
                                    ),
                                    array(
                                        'label' => 'Acta de recepción definitiva',
                                        'type' => 'raw',
                                        'value' => CHtml::link(CHtml::encode($this->getNameFromURL($avances[$row]['adj_acta_recepcion'])), $avances[$row]['adj_acta_recepcion'], array(
                                            'target' => '_blank'
                                        ))
                                    ),
                                    array(
                                        'label' => 'Informe de disconformidad, cuando corresponda',
                                        'type' => 'raw',
                                        'value' => CHtml::link(CHtml::encode($this->getNameFromURL($avances[$row]['adj_disconformidad'])), $avances[$row]['adj_disconformidad'], array(
                                            'target' => '_blank'
                                        ))
                                    )
                                )
                            ));
                        $this->endWidget('zii.widgets.jui.CJuiDialog');
                        ?>
                </td>
                <td <?php echo ($td_style) ? 'class="fila_blanco"' : 'class="fila_azul"';?> >
                    <!--    **************************************************************************     LAS IMAGENES **********************************************************     -->
                    <?php
                        $avance_imagenes2 = Yii::app()->db->createCommand()
                                                              ->select('*')
                                                              ->from('v_imagenes_poravance')
                                                              ->where('idAvances=:id', array(':id' => $cod))
                                                              ->queryAll();
                        $cantidad_img2    = count($avance_imagenes2);
                        if ($cantidad_img2 > 0) {
                            echo CHtml::Button('Ver imágenes', array('onclick' => "$('#imaAvances$cod').dialog('open'); return false;"));
                        } else {
                            echo CHtml::Button('Ver imágenes', array('onclick' => "$('#imaAvances$cod').dialog('open'); return false;","style" => "background-color:#CCC;"));
                        }

                        if ($cod > 0) {
                            $avance_imagenes = Yii::app()->db->createCommand()
                                                                  ->select('*')
                                                                  ->from('v_imagenes_poravance')
                                                                  ->where('idAvances=:id', array(':id' => $cod))
                                                                  ->queryAll();
                            $cantidad_img    = count($avance_imagenes);
                            if ($cantidad_img > 0) {
                                $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                                    'id' => "imaAvances$cod",
                                    'options' => array(
                                        'title' => 'Galeria de Imágenes',
                                        'autoOpen' => false,
                                        'modal' => true,
                                        'width' => 600,
                                        'height' => 400,
                                        'resizable' => false,
                                        'show' => array(
                                            'effect' => 'blind',
                                            'duration' => 1000,
                                            'scrolling' => false
                                        ),
                                        'hide' => array(
                                            'effect' => 'blind',
                                            'duration' => 500
                                        )
                                    )
                                ));

                                if ($cod > 0) {
                                    $r = 0;
                                    unset($arr_fin);
                                    $arr_fin = array();
                                    if ($cantidad_img > 0) {
                                        while ($r < $cantidad_img) {
                                            if (file_exists(Yii::getPathOfAlias('webroot') . '/' . $avance_imagenes[$r]['nombre_imagen'])) {
                                                $arr_fin[] = Yii::getPathOfAlias('webroot') . '/' . $avance_imagenes[$r]['nombre_imagen'];
                                            }
                                            $r++;
                                        }

                                        $arr_fin2 = array();
                                        for ($f = 0; $f < count($arr_fin); $f++) {
                                            $urlImagen            = str_replace('//', '/', $arr_fin[$f]);
                                            $directorioImg        = dirname($arr_fin[$f]);
                                            $nameandExten         = basename($urlImagen);
                                            $imgDirectorioGuardar = $directorioImg . '/small_' . $nameandExten;
                                            if (file_exists($arr_fin[$f])) {
                                                if (file_exists($imgDirectorioGuardar) == false) {
                                                    if (exif_imagetype($arr_fin[$f])) {
                                                      EWideImage::load($arr_fin[$f])->resize(400, 300)->saveToFile($imgDirectorioGuardar);
                                                    }
                                                }
                                                $arr_fin2[] = $imgDirectorioGuardar;
                                            }
                                        } //echo Yii::app()->Controller->GetPath('webroot.adjuntos', 7, 96).'<hr>'; print_r($arr_fin2);
                        ?>
                    <div class="gallery" align="center">
                        <div class="thumbnails">
                            <?php
                                if (count($arr_fin2) > 0) {
                                    for ($fm = 0; $fm < count($arr_fin2); $fm++) {
                                        $Url2 = $this->getURL($arr_fin2[$fm]);
                                        $Url1 = $this->getURL($arr_fin[$fm]);
                                        echo '<a href="' . $Url1 . '" target="_blank"><img onmouseover="preview.src=img' . $fm . '.src" id="img' . $fm . '" src="' . $Url2 . '" /></a>';
                                    }
                                }
                                ?>
                        </div>
                    </div>
                    <?php
                                    }
                                }
                                $this->endWidget('zii.widgets.jui.CJuiDialog');
                            }
                        }

                        ?>
                </td>
            </tr>
            <?php
                  } //fin de validar avances publicados
                  $td_style = !$td_style;
                  $row++;
                }
                ?>
        </table>
        <?php
            } else {
              echo "<p>No ha divulgado esta información </p>";
            }
            ?>
    </div>
    <div style="display: none;" id="tab08">
        <!-- **************** DESEMBOLSOS Y MONTOS   **************** -->
        <table class="tabla_interna" width="100%">
            <tbody>
                <tr>
                    <th>Tipo</th>
                    <th>Fecha Vencimiento</th>
                    <th>Monto</th>
                    <th>Estado</th>
                </tr>
                <?php
                    if (!empty($ejecucion)) {
                        $garantias = Yii::app()->db->createCommand()
                                                      ->select('*')
                                                      ->from('cs_garantias')
                                                      ->where('idInicioEjecucion=:id', array(':id' => $ejecucion[0]['idInicioEjecucion']))
                                                      ->queryAll();
                        foreach($garantias as $element) {
                          $tipoGarantias = Yii::app()->db->createCommand("SELECT nombre FROM cs_tipo_garantias WHERE idTipoGarantia=".$element['idTipoGarantia'])->queryScalar();
                            echo '<tr>';
                            echo '<td class="">'.$tipoGarantias.'</td>';
                            echo '<td class="">'.$element['fecha_vencimiento'].'</td>';
                            echo '<td class="">'.$element['monto'].'</td>';
                            echo '<td class="">'.$element['estado'].'</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
            </tbody>
        </table>
    </div>
    <div style="display: none;" id="tab09">
        <!-- **************** GRAFICOS   **************** -->
        <h4>Etapas del Proceso de Adquisición en el Proyecto</h4>
        <hr/>
        <?php
            $controlLinea = $_GET['control'];
            $controlId    = $_GET['id'];
            switch ($controlLinea) {
                case 'Proyecto': {
                    $vidpathsControl   = Yii::app()->db->createCommand('SELECT * FROM vidpaths WHERE idProyecto=' . $controlId)->queryRow();
                    $IdProyecto        = $vidpathsControl['idProyecto'];
                    $IdCalificacion    = $vidpathsControl['idCalificacion'];
                    $IdAdjudicacion    = $vidpathsControl['idAdjudicacion'];
                    $IdContratacion    = $vidpathsControl['idContratacion'];
                    $IdInicioEjecucion = $vidpathsControl['idInicioEjecucion'];
                    $IdAvances         = $vidpathsControl['idAvances'];
                    $idContratacion    = $vidpathsControl['idCalificacion'];
                    $tdProyecto        = true;
                    $tdCalificacion    = true;
                    $tdAdjudicacion    = true;
                    $tdContratacion    = true;
                    $tdInicioEjecucion = true;
                    $tdAvances         = true;

                    // Fecha del Contrado de Supervicion

                    if ($vidpathsControl['idProyecto'] != NULL) {
                        $fechaIncioProyecto        = Yii::app()->db->createCommand('SELECT * FROM  cs_proyecto WHERE idProyecto=' . $IdProyecto)->queryRow();
                        $Fecha_Aprobacion_Proyecto = $fechaIncioProyecto['fechaaprob'];
                    } else {
                        $tdProyecto = false;
                    }

                    // ======================================Calificacion==============================================

                    if ($vidpathsControl['idCalificacion'] != NULL) {
                        $fechaIncioCalificacion        = Yii::app()->db->createCommand('SELECT * FROM cs_calificacion WHERE idCalificacion=' . $IdCalificacion)->queryRow();
                        $Fecha_Aprobacion_Calificacion = $fechaIncioCalificacion['fecha_publicacion'];
                    } else {
                        $tdCalificacion = FALSE;
                    }

                    // =====================================Adjudicacion===============================================

                    if ($vidpathsControl['idAdjudicacion'] != NULL) {
                        $fechaIncioAjudicacion         = Yii::app()->db->createCommand('SELECT * FROM cs_adjudicacion WHERE idAdjudicacion=' . $IdAdjudicacion)->queryRow();
                        $Fecha_Aprobacion_Adjudicacion = $fechaIncioAjudicacion['fecha_creacion'];
                    } else {
                        $tdAdjudicacion = false;
                    }

                    // ======================================CONTRATACION========================================================

                    if ($vidpathsControl['idContratacion'] != NULL) {
                        $fechaIncioContratacion        = Yii::app()->db->createCommand('SELECT * FROM  cs_contratacion WHERE idContratacion=' . $IdContratacion)->queryRow();
                        $Fecha_Aprobacion_Contratacion = $fechaIncioContratacion['fecha_publicacion'];
                    } else {
                        $tdContratacion = false;
                    }

                    // ===========================================INICIO EJECUCION =====================================================================

                    if ($vidpathsControl['idInicioEjecucion'] != NULL) {
                        $fechaIncioInicioEjecucion        = Yii::app()->db->createCommand('SELECT * FROM cs_inicio_ejecucion WHERE idInicioEjecucion=' . $IdInicioEjecucion)->queryRow();
                        $Fecha_Aprobacion_InicioEjecucion = $fechaIncioInicioEjecucion['fecha_creacion'];
                    } else {
                        $tdInicioEjecucion = false;
                    }

                    // =============================================AVANCE==================================================================================

                    if ($vidpathsControl['idAvances'] != NULL) {
                        $UltimoAvance = Yii::app()->db->createCommand('SELECT * FROM cs_avances WHERE idInicioEjecucion=' . $IdInicioEjecucion)->queryColumn();

                        // print_r($UltimoAvance);
                        // $verContratacion=Yii::app()->db->createCommand('SELECT * FROM vidpaths WHERE idContratos='.$UltimoAvance)->queryRow();
                        // print_r($verContratacion);

                        foreach ($UltimoAvance as $valor) {
                            $IdAvances = $valor;
                        }

                        // $Fecha_Aprobacion_Avance= $fechaIncioAvance['fecha_avance'];

                        $fechaIncioAvance        = Yii::app()->db->createCommand('SELECT * FROM cs_avances WHERE idAvances=' . $IdAvances)->queryRow();
                        $Fecha_Aprobacion_Avance = $fechaIncioAvance['fecha_avance'];
                        $porcentageAvance        = $fechaIncioAvance['porcent_real'];
                        $finan_programado        = $fechaIncioAvance['finan_programado'];
                    } else {
                        $tdAvances = false;
                    }

                    break;
                }

                case 'Calificacion': {
                    $vidpathsControl   = Yii::app()->db->createCommand('SELECT * FROM vidpaths WHERE idCalificacion=' . $controlId)->queryRow();
                    $IdProyecto        = $vidpathsControl['idProyecto'];
                    $IdCalificacion    = $vidpathsControl['idCalificacion'];
                    $IdAdjudicacion    = $vidpathsControl['idAdjudicacion'];
                    $IdContratacion    = $vidpathsControl['idContratacion'];
                    $IdInicioEjecucion = $vidpathsControl['idInicioEjecucion'];
                    $IdAvances         = $vidpathsControl['idAvances'];
                    $idContratacion    = $vidpathsControl['idCalificacion'];
                    $tdPrograma        = false;
                    $tdProyecto        = true;
                    $tdCalificacion    = true;
                    $tdAdjudicacion    = true;
                    $tdContratacion    = true;
                    $tdInicioEjecucion = true;
                    $tdAvances         = true;

                    // ======================================PROYECTO============================
                    // Fecha del Contrado de Supervicion

                    if ($vidpathsControl['idProyecto'] != NULL) {
                        $fechaIncioProyecto        = Yii::app()->db->createCommand('SELECT * FROM  cs_proyecto WHERE idProyecto=' . $IdProyecto)->queryRow();
                        $Fecha_Aprobacion_Proyecto = $fechaIncioProyecto['fechaaprob'];
                    } else {
                        $tdProyecto = false;
                    }

                    // ======================================Calificacion==============================================

                    if ($vidpathsControl['idCalificacion'] != NULL) {
                        $fechaIncioCalificacion        = Yii::app()->db->createCommand('SELECT * FROM cs_calificacion WHERE idCalificacion=' . $IdCalificacion)->queryRow();
                        $Fecha_Aprobacion_Calificacion = $fechaIncioCalificacion['fecha_creacion'];
                    } else {
                        $tdCalificacion = FALSE;
                    }

                    // =====================================Adjudicacion===============================================

                    if ($vidpathsControl['idAdjudicacion'] != NULL) {
                        $fechaIncioAjudicacion         = Yii::app()->db->createCommand('SELECT * FROM cs_adjudicacion WHERE idAdjudicacion=' . $IdAdjudicacion)->queryRow();
                        $Fecha_Aprobacion_Adjudicacion = $fechaIncioAjudicacion['fecha_creacion'];
                    } else {
                        $tdAdjudicacion = false;
                    }

                    // ======================================CONTRATACION========================================================

                    if ($vidpathsControl['idContratacion'] != NULL) {
                        $fechaIncioContratacion        = Yii::app()->db->createCommand('SELECT * FROM  cs_contratacion WHERE idContratacion=' . $IdContratacion)->queryRow();
                        $Fecha_Aprobacion_Contratacion = $fechaIncioContratacion['fecha_publicacion'];
                    } else {
                        $tdContratacion = false;
                    }

                    // ===========================================INICIO EJECUCION =====================================================================

                    if ($vidpathsControl['idInicioEjecucion'] != NULL) {
                        $fechaIncioInicioEjecucion        = Yii::app()->db->createCommand('SELECT * FROM cs_inicio_ejecucion WHERE idInicioEjecucion=' . $IdInicioEjecucion)->queryRow();
                        $Fecha_Aprobacion_InicioEjecucion = $fechaIncioInicioEjecucion['fecha_creacion'];
                    } else {
                        $tdInicioEjecucion = false;
                    }

                    // =============================================AVANCE==================================================================================

                    if ($vidpathsControl['idAvances'] != NULL) {
                        $UltimoAvance = Yii::app()->db->createCommand('SELECT * FROM cs_avances WHERE idInicioEjecucion=' . $IdInicioEjecucion)->queryColumn();

                        // print_r($UltimoAvance);
                        // $verContratacion=Yii::app()->db->createCommand('SELECT * FROM vidpaths WHERE idContratos='.$UltimoAvance)->queryRow();
                        // print_r($verContratacion);

                        foreach ($UltimoAvance as $valor) {
                            $IdAvances = $valor;
                        }

                        // $Fecha_Aprobacion_Avance= $fechaIncioAvance['fecha_avance'];

                        $fechaIncioAvance        = Yii::app()->db->createCommand('SELECT * FROM cs_avances WHERE idAvances=' . $IdAvances)->queryRow();
                        $Fecha_Aprobacion_Avance = $fechaIncioAvance['fecha_avance'];
                        $porcentageAvance        = $fechaIncioAvance['porcent_real'];
                        $finan_programado        = $fechaIncioAvance['finan_programado'];
                    } else {
                        $tdAvances = false;
                    }

                    break;
                }

                case 'Adjudicacion': {
                    $vidpathsControl   = Yii::app()->db->createCommand('SELECT * FROM vidpaths WHERE idAdjudicacion=' . $controlId)->queryRow();
                    $IdProyecto        = $vidpathsControl['idProyecto'];
                    $IdCalificacion    = $vidpathsControl['idCalificacion'];
                    $IdAdjudicacion    = $vidpathsControl['idAdjudicacion'];
                    $IdContratacion    = $vidpathsControl['idContratacion'];
                    $IdInicioEjecucion = $vidpathsControl['idInicioEjecucion'];
                    $IdAvances         = $vidpathsControl['idAvances'];
                    $idContratacion    = $vidpathsControl['idCalificacion'];
                    $tdPrograma        = false;
                    $tdProyecto        = true;
                    $tdCalificacion    = true;
                    $tdAdjudicacion    = true;
                    $tdContratacion    = true;
                    $tdInicioEjecucion = true;
                    $tdAvances         = true;

                    // ======================================PROYECTO============================
                    // Fecha del Contrado de Supervicion

                    if ($vidpathsControl['idProyecto'] != NULL) {
                        $fechaIncioProyecto        = Yii::app()->db->createCommand('SELECT * FROM  cs_proyecto WHERE idProyecto=' . $IdProyecto)->queryRow();
                        $Fecha_Aprobacion_Proyecto = $fechaIncioProyecto['fechaaprob'];
                    } else {
                        $tdProyecto = false;
                    }

                    // ======================================Calificacion==============================================

                    if ($vidpathsControl['idCalificacion'] != NULL) {
                        $fechaIncioCalificacion        = Yii::app()->db->createCommand('SELECT * FROM cs_calificacion WHERE idCalificacion=' . $IdCalificacion)->queryRow();
                        $Fecha_Aprobacion_Calificacion = $fechaIncioCalificacion['fecha_creacion'];
                    } else {
                        $tdCalificacion = FALSE;
                    }

                    // =====================================Adjudicacion===============================================

                    if ($vidpathsControl['idAdjudicacion'] != NULL) {
                        $fechaIncioAjudicacion         = Yii::app()->db->createCommand('SELECT * FROM cs_adjudicacion WHERE idAdjudicacion=' . $IdAdjudicacion)->queryRow();
                        $Fecha_Aprobacion_Adjudicacion = $fechaIncioAjudicacion['fecha_creacion'];
                    } else {
                        $tdAdjudicacion = false;
                    }

                    // ======================================CONTRATACION========================================================

                    if ($vidpathsControl['idContratacion'] != NULL) {
                        $fechaIncioContratacion        = Yii::app()->db->createCommand('SELECT * FROM  cs_contratacion WHERE idContratacion=' . $IdContratacion)->queryRow();
                        $Fecha_Aprobacion_Contratacion = $fechaIncioContratacion['fecha_publicacion'];
                    } else {
                        $tdContratacion = false;
                    }

                    // ===========================================INICIO EJECUCION =====================================================================

                    if ($vidpathsControl['idInicioEjecucion'] != NULL) {
                        $fechaIncioInicioEjecucion        = Yii::app()->db->createCommand('SELECT * FROM cs_inicio_ejecucion WHERE idInicioEjecucion=' . $IdInicioEjecucion)->queryRow();
                        $Fecha_Aprobacion_InicioEjecucion = $fechaIncioInicioEjecucion['fecha_creacion'];
                    } else {
                        $tdInicioEjecucion = false;
                    }

                    // =============================================AVANCE==================================================================================

                    if ($vidpathsControl['idAvances'] != NULL) {
                        $UltimoAvance = Yii::app()->db->createCommand('SELECT * FROM cs_avances WHERE idInicioEjecucion=' . $IdInicioEjecucion)->queryColumn();

                        // print_r($UltimoAvance);
                        // $verContratacion=Yii::app()->db->createCommand('SELECT * FROM vidpaths WHERE idContratos='.$UltimoAvance)->queryRow();
                        // print_r($verContratacion);

                        foreach ($UltimoAvance as $valor) {
                            $IdAvances = $valor;
                        }

                        // $Fecha_Aprobacion_Avance= $fechaIncioAvance['fecha_avance'];

                        $fechaIncioAvance        = Yii::app()->db->createCommand('SELECT * FROM cs_avances WHERE idAvances=' . $IdAvances)->queryRow();
                        $Fecha_Aprobacion_Avance = $fechaIncioAvance['fecha_avance'];
                        $porcentageAvance        = $fechaIncioAvance['porcent_real'];
                        $finan_programado        = $fechaIncioAvance['finan_programado'];
                    } else {
                        $tdAvances = false;
                    }

                    break;
                }

                case 'Contratacion': {
                    $vidpathsControl   = Yii::app()->db->createCommand('SELECT * FROM vidpaths WHERE idContratacion=' . $controlId)->queryRow();
                    $IdProyecto        = $vidpathsControl['idProyecto'];
                    $IdCalificacion    = $vidpathsControl['idCalificacion'];
                    $IdAdjudicacion    = $vidpathsControl['idAdjudicacion'];
                    $IdContratacion    = $vidpathsControl['idContratacion'];
                    $IdInicioEjecucion = $vidpathsControl['idInicioEjecucion'];
                    $IdAvances         = $vidpathsControl['idAvances'];
                    $idContrato        = $vidpathsControl['idContratos'];
                    $idContratacion    = $vidpathsControl['idCalificacion'];
                    $tdPrograma        = false;
                    $tdProyecto        = true;
                    $tdCalificacion    = true;
                    $tdAdjudicacion    = true;
                    $tdContratacion    = true;
                    $tdInicioEjecucion = true;
                    $tdAvances         = true;

                    // ======================================PROYECTO============================
                    // Fecha del Contrado de Supervicion

                    if ($vidpathsControl['idProyecto'] != NULL) {
                        $fechaIncioProyecto        = Yii::app()->db->createCommand('SELECT * FROM  cs_proyecto WHERE idProyecto=' . $IdProyecto)->queryRow();
                        $Fecha_Aprobacion_Proyecto = $fechaIncioProyecto['fechaaprob'];
                    } else {
                        $tdProyecto = false;
                    }

                    // ======================================Calificacion==============================================

                    if ($vidpathsControl['idCalificacion'] != NULL) {
                        $fechaIncioCalificacion        = Yii::app()->db->createCommand('SELECT * FROM cs_calificacion WHERE idCalificacion=' . $IdCalificacion)->queryRow();
                        $Fecha_Aprobacion_Calificacion = $fechaIncioCalificacion['fecha_publicacion'];
                    } else {
                        $tdCalificacion = FALSE;
                    }

                    // =====================================Adjudicacion===============================================

                    if ($vidpathsControl['idAdjudicacion'] != NULL) {
                        $fechaIncioAjudicacion         = Yii::app()->db->createCommand('SELECT * FROM cs_adjudicacion WHERE idAdjudicacion=' . $IdAdjudicacion)->queryRow();
                        $Fecha_Aprobacion_Adjudicacion = $fechaIncioAjudicacion['fecha_publicacion'];
                    } else {
                        $tdAdjudicacion = false;
                    }

                    // ======================================CONTRATACION========================================================

                    if ($vidpathsControl['idContratacion'] != NULL) {
                        $fechaIncioContratacion        = Yii::app()->db->createCommand('SELECT * FROM  cs_contratacion WHERE idContratacion=' . $IdContratacion)->queryRow();
                        $Fecha_Aprobacion_Contratacion = $fechaIncioContratacion['fecha_publicacion'];
                    } else {
                        $tdContratacion = false;
                    }

                    // ===========================================INICIO EJECUCION =====================================================================

                    if ($vidpathsControl['idInicioEjecucion'] != NULL) {
                        $fechaIncioInicioEjecucion        = Yii::app()->db->createCommand('SELECT * FROM cs_inicio_ejecucion WHERE idInicioEjecucion=' . $IdInicioEjecucion)->queryRow();
                        $Fecha_Aprobacion_InicioEjecucion = $fechaIncioInicioEjecucion['fecha_publicacion'];
                    } else {
                        $tdInicioEjecucion = false;
                    }

                    // =============================================AVANCE==================================================================================

                    if ($vidpathsControl['idAvances'] != NULL) {
                        $UltimoAvance = Yii::app()->db->createCommand('SELECT * FROM cs_avances WHERE idInicioEjecucion=' . $IdInicioEjecucion)->queryColumn();

                        // print_r($UltimoAvance);
                        // $verContratacion=Yii::app()->db->createCommand('SELECT * FROM vidpaths WHERE idContratos='.$UltimoAvance)->queryRow();
                        // print_r($verContratacion);

                        foreach ($UltimoAvance as $valor) {
                            $IdAvances = $valor;
                        }

                        // $Fecha_Aprobacion_Avance= $fechaIncioAvance['fecha_avance'];

                        $fechaIncioAvance        = Yii::app()->db->createCommand('SELECT * FROM cs_avances WHERE idAvances=' . $IdAvances)->queryRow();
                        $Fecha_Aprobacion_Avance = $fechaIncioAvance['fecha_avance'];
                        $porcentageAvance        = $fechaIncioAvance['porcent_real'];
                        $finan_programado        = $fechaIncioAvance['finan_programado'];
                    } else {
                        $tdAvances = false;
                    }

                    break;
                }
            }

            ?>
        <table width="100%%" border="0" bordercolordark="#000000">
            <tr>
                <?php
                    if ($tdProyecto == true) { echo '<td width="14%" bgcolor="#EAB200">&nbsp;</td>' . '<td width="0%" bgcolor="#999999">&nbsp;</td>'; }
                    if ($tdCalificacion == true) { echo '<td width="14%" bgcolor="#EAB200">&nbsp;</td>' . '<td width="0%" bgcolor="#999999">&nbsp;</td>';}
                    if ($tdAdjudicacion == true) { echo '<td width="14%" bgcolor="#EAB200">&nbsp;</td>' . '<td width="0%" bgcolor="#999999">&nbsp;</td>';}
                    if ($tdContratacion == true) { echo '<td width="14%" bgcolor="#EAB200">&nbsp;</td>' . '<td width="0%" bgcolor="#999999">&nbsp;</td>';}
                    if ($tdInicioEjecucion == true) { echo '<td width="14%" bgcolor="#EAB200">&nbsp;</td>' . '<td width="0%" bgcolor="#999999">&nbsp;</td>';}
                    if ($tdAvances == true) { echo '<td width="14%" bgcolor="#EAB200">&nbsp;</td>' . '<td width="0%" bgcolor="#999999">&nbsp;</td>';}
                    ?>
            </tr>
            <tr>
                <?php
                    if ($tdAdjudicacion == true) {
                        echo '<td>';
                        echo '<ol class="progtrckr" data-progtrckr-steps="5">';
                        echo '<li  class="progtrckr-done"><b> Aprobación  Proyecto</b> </br><b>' . $Fecha_Aprobacion_Proyecto . '</b></li>';
                        echo '</ol>'; echo '</td>'; echo '<td>&nbsp;</td>';
                    }

                    if ($tdContratacion == true) {
                        $createDate = new DateTime($Fecha_Aprobacion_Calificacion);
                        echo '<td>';
                        echo '<ol class="progtrckr" data-progtrckr-steps="5">';
                        echo '<li  class="progtrckr-done"><b> Aprobación  Califiación </b> </br><b>' .$createDate->format('Y-m-d')  . '</b></li>';
                        echo '</ol>'; echo '</td>'; echo '<td>&nbsp;</td>';
                    }

                    if ($tdProyecto == true) {
                      $createDate = new DateTime($Fecha_Aprobacion_Adjudicacion);
                        echo '<td>';
                        echo '<ol class="progtrckr" data-progtrckr-steps="5">';
                        echo '<li  class="progtrckr-done"><b> Aprobación  Adjudicación </b> </br><b>' . $createDate->format('Y-m-d') . '</b></li>';
                        echo '</ol>'; echo '</td>'; echo '<td>&nbsp;</td>';
                    }

                    if ($tdCalificacion == true) {
                      $createDate = new DateTime($Fecha_Aprobacion_Contratacion);
                        echo '<td>';
                        echo '<ol class="progtrckr" data-progtrckr-steps="5">';
                        echo '<li  class="progtrckr-done"><b> Aprobación  Contratación </b> </br><b>' . $createDate->format('Y-m-d') . '</b></li>';
                        echo '</ol>'; echo '</td>'; echo '<td>&nbsp;</td>';
                    }

                    if ($tdInicioEjecucion == true) {
                        $createDate = new DateTime($Fecha_Aprobacion_InicioEjecucion);
                        echo '<td>';
                        echo '<ol class="progtrckr" data-progtrckr-steps="5">';
                        echo '<li  class="progtrckr-done"><b> Aprobación  Implementación </b> </br><b>' . $createDate->format('Y-m-d') . '</b></li>';
                        echo '</ol>'; echo '</td>'; echo '<td>&nbsp;</td>';
                    }

                    if ($tdAvances == true) {
                        echo '<td>';
                        echo '<ol class="progtrckr" data-progtrckr-steps="5">';
                        echo '<li  class="progtrckr-done"><b> Avance</b> </br><b>' . $Fecha_Aprobacion_Avance . '</b> </br> <b>- % Fisico Real: ' . $porcentageAvance . '</b></br><b> - % Finaciero Real: ' . number_format($finan_programado,2). '</b></li>';
                        echo '</ol>'; echo '</td>'; echo '<td>&nbsp;</td>';
                    }
                    ?>
            </tr >
        </table>
        <br/><br/>
        <!-- ***********************  GRAFICOS ***********************  -->
        <?php
            if (!empty($contratacion)) {
                $resultX                  = Yii::app()->db->createCommand()->select('*')->from('v_avance_ft')->where('idContratacion=:id', array(
                    ':id' => $contratacion[0]['idContratacion']
                ))->queryAll();
                $i                        = 0;
                $t_x                      = count($resultX);
                $cat                      = array();
                $array_fina_real          = array();
                $array_finan_programado   = array();
                $array_fina_real          = array();
                $array_porcent_real       = array();
                $array_porcent_programado = array();
                foreach ($resultX as $rowX) {
                    $array_porcent_real[]       = (int) $rowX['porcent_real'];
                    $array_porcent_programado[] = (int) $rowX['porcent_programado'];
                    $array_fina_real[]          = (int) $rowX['finan_real'];
                    $array_finan_programado[]   = (int) $rowX['finan_programado'];
                    $i++;
                    $cat[] = strval($i);
                }
                ;
            }

            ?>
        <?php
            if (!empty($contratacion)) {
            ?>
        <table  class="general">
            <tr>
                <td width="50%" style="text-align:center" >
                    <h4>Comparación Avance Financiero Vrs. Real</h4>
                    <hr/>
                    <?php
                        $this->Widget('ext.highcharts.HighchartsWidget', array(
                            'options' => array(
                                'title' => array(
                                    'text' => ''
                                ),
                                'xAxis' => array(
                                    'categories' => $cat
                                ),
                                'yAxis' => array(
                                    'title' => array(
                                        'text' => 'LPS'
                                    )
                                ),
                                'xAxis' => array(
                                    'title' => array(
                                        'text' => 'Meses'
                                    )
                                ),
                                'colors' => array(
                                    '#6AC36A',
                                    '#FFD148'
                                ),
                                'credits' => array(
                                    'enabled' => false
                                ),
                                'series' => array(
                                    array(
                                        'name' => 'Avance Financiero Real',
                                        'data' => $array_fina_real
                                    ),
                                    array(
                                        'name' => 'Avance Financiero Programado',
                                        'data' => $array_finan_programado
                                    )
                                )
                            )
                        ));
                        ?>
                </td>
                <td width="50%" valign="top" style="text-align:center">
                    <h4>Comparación Avance Fí­sico Vrs. Real</h4>
                    </hr>
                    <?php
                        $this->Widget('ext.highcharts.HighchartsWidget', array(
                            'options' => array(
                                'title' => array(
                                    'text' => ''
                                ),
                                'xAxis' => array(
                                    'categories' => $cat
                                ),
                                'yAxis' => array(
                                    'title' => array(
                                        'text' => '% Avances'
                                    )
                                ),
                                'xAxis' => array(
                                    'title' => array(
                                        'text' => 'Meses'
                                    )
                                ),
                                'colors' => array(
                                    '#0C0',
                                    '#F00'
                                ),
                                'credits' => array(
                                    'enabled' => false
                                ),
                                'series' => array(
                                    array(
                                        'name' => 'Avance Obras Real',
                                        'data' => $array_porcent_real
                                    ),
                                    array(
                                        'name' => 'Avance Obras Programado',
                                        'data' => $array_porcent_programado
                                    )
                                )
                            )
                        ));
                        ?>
                </td>
            </tr>
        </table>
        <?php
            }
            ?>
    </div>
    <div style="display: none;" id="tab10">
        <!-- ****************   MAPA   **************** -->
        <!--<div id="mapa"></div>-->
        <?php
            $lat_inicio = 1;
            $lon_inicio = 1;

            // coordenadas por defecto

            $lat_inicio = 14.060521;
            $lon_inicio = -87.164521;
            $lat_fin    = 14.011226;
            $lon_fin    = -87.010884;

            if ($IdInicioEjecucion != null) {
              $UbicacionPuntos = Yii::app()->db->createCommand('SELECT * FROM cs_proyecto WHERE     idProyecto='. $IdProyecto)->queryRow();

              $lat_inicio=$UbicacionPuntos['lat1'];
              $lon_inicio=$UbicacionPuntos['lon1'];
              $lat_fin=$UbicacionPuntos['lat2'];
              $lon_fin=$UbicacionPuntos['lon2'];

            }

            ?>
        <iframe width="625" height="550" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" <?php
            if((($lat_inicio>0 || $lat_inicio<0) && ($lon_inicio>0||$lon_inicio<0)) && (($lat_fin>0||$lat_fin<0) && ($lon_fin>0||$lon_fin<0)))
            {
              echo 'src="https://maps.google.com/maps?f=d&source=sd&saddr=' . $lat_inicio . ',' . $lon_inicio . '&daddr=' . $lat_fin . ',' . $lon_fin . '&hl=es&sll=14.853494,-87.022642&ie=UTF8&output=embed">';
            }
            else if ((($lat_inicio>0 || $lat_inicio<0) && ($lon_inicio>0||$lon_inicio<0)) && $lat_fin==0 && $lon_fin==0)
            {
              echo 'src="https://maps.google.com/maps?f=d&source=sd&saddr=' . $lat_inicio . ',' . $lon_inicio . '&daddr=' . $lat_inicio . ',' . $lon_inicio . '&hl=es&sll=14.853494,-87.022642&ie=UTF8&output=embed">';
            }

            ?></iframe>
    </div>
    <div style="display: none;" id="tab11">
        <!-- **************** FINALIZACION **************** -->
        <?php
            if (!empty($ejecucion)) {
            $finalizacion = Yii::app()->db->createCommand()
                                              ->select('*')
                                              ->from('cs_final_ejecucion')
                                              ->where('idInicioEjecucion=:id', array(':id' => $ejecucion[0]['idInicioEjecucion']))
                                              ->queryAll();
            ?>
        <table class="general">
            <tr>
                <td width="49%" valign="top" style="text-align:left;">
                    <table width="100%">
                        <tr>
                            <td width="49%"><strong>Id Finalización:<strong></td>
                            <td width="51%"><?php echo (!empty($finalizacion[0]['idFinalizacion'])) ? $finalizacion[0]['idFinalizacion'] : 'No ha divulgado esta información'; ?></td>
                        </tr>
                        <tr>
                            <td width="49%"><strong>Costo Finalización:<strong></td>
                            <td width="51%"><?php echo (!empty($finalizacion[0]['costoFinalizacion'])) ? $finalizacion[0]['costoFinalizacion'] : 'No ha divulgado esta información'; ?></td>
                        </tr>
                        <tr>
                            <td width="49%"><strong>Alcance Finalización:<strong></td>
                            <td width="51%"><?php echo (!empty($finalizacion[0]['alcanceFinalizacion'])) ? $finalizacion[0]['alcanceFinalizacion'] : 'No ha divulgado esta información'; ?></td>
                        </tr>
                        <tr>
                            <td width="49%"><strong>Fecha Finalización:<strong></td>
                            <td width="51%"><?php echo (!empty($finalizacion[0]['fechaFinalizacion'])) ? $finalizacion[0]['fechaFinalizacion'] : 'No ha divulgado esta información'; ?></td>
                        </tr>
                        <tr>
                            <td width="49%"><strong>Razones de Cambios en el Proyecto :<strong></td>
                            <td width="51%"><?php echo (!empty($finalizacion[0]['razonesCambios'])) ? $finalizacion[0]['razonesCambios'] : 'No ha divulgado esta información'; ?></td>
                        </tr>
                        <tr>
                            <td width="49%"><strong>Razones de Cambios en el Presupuesto:<strong></td>
                            <td width="51%"><?php echo (!empty($finalizacion[0]['razonesCambiosPresupuesto'])) ? $finalizacion[0]['razonesCambiosPresupuesto'] : 'No ha divulgado esta información'; ?></td>
                        </tr>
                        <tr>
                            <td width="42%"><strong>Fecha Publicado :<strong></td>
                            <td width="58%"><?php echo (!empty($finalizacion[0]['fecha_creacion'])) ? $finalizacion[0]['fecha_publicacion'] : 'No ha divulgado esta información'; ?></td>
                        </tr>

                    </table>
                </td>
                <td width="2%">&nbsp;</td>
                <td width="49%" valign="top" class="general-031e" style="text-align:left;">
                    <?php
                        $totali = 0;

                        $transparencia = (!empty($finalizacion[0]['indicador1'])) ? $finalizacion[0]['indicador1'] : 0;
                        $montos = (!empty($finalizacion[0]['indicador2'])) ? $finalizacion[0]['indicador2'] : 0;
                        $plazo = (!empty($finalizacion[0]['indicador3'])) ? $finalizacion[0]['indicador3'] : 0;
                        $supervision = (!empty($finalizacion[0]['indicador4'])) ? $finalizacion[0]['indicador4'] : 0;
                        $contratos = (!empty($finalizacion[0]['indicador5'])) ? $finalizacion[0]['indicador5'] : 0;
                        $ejecucion = (!empty($finalizacion[0]['indicador6'])) ? $finalizacion[0]['indicador6'] : 0;
                        $cumplimiento = (!empty($finalizacion[0]['indicador7'])) ? $finalizacion[0]['indicador7'] : 0;
                        $divulgacion = (!empty($finalizacion[0]['indicador8'])) ? $finalizacion[0]['indicador8'] : 0;

                        $totali = $transparencia + $montos + $plazo + $supervision + $contratos + $ejecucion + $cumplimiento + $divulgacion;
                     ?>
                    <!-- <table align="center" border="1" cellpadding="1" cellspacing="1" style="width:80%;">
                        <caption><strong>Indicadores de desempeño</strong></caption>
                        <thead>
                            <tr>
                                <th style="width: 164px; text-align: center; background-color: rgb(51, 51, 51);"><span style="color:#ffffff;">Indicador</span></th>
                                <th style="width: 167px; text-align: center; background-color: rgb(51, 51, 51);"><span style="color:#ffffff;">Valor</span></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th style="width: 164px; text-align: center; background-color: rgb(51, 51, 51);"><span style="color:#ffffff;">TOTAL</span></th>
                                <th style="width: 167px; text-align: center; background-color: rgb(51, 51, 51);"><span style="color:#ffffff;"><?php echo number_format($totali, 2, '.', ','); ?></span></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td style="width: 164px; text-align: center;">Gestión de la Adquisición</td>
                                <td style="width: 164px; text-align: center;"><?php //echo number_format($transparencia, 2, '.', ','); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 164px; text-align: center;">Gestión de montos</td>
                                <td style="width: 164px; text-align: center;"><?php //echo number_format($montos, 2, '.', ','); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 164px; text-align: center;">Gestión de plazos</td>
                                <td style="width: 164px; text-align: center;"><?php //echo number_format($plazo, 2, '.', ','); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 164px; text-align: center;">Razonabilidad de la supervisión</td>
                                <td style="width: 164px; text-align: center;"><?php //echo number_format($supervision, 2, '.', ','); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 164px; text-align: center;">Gestión de los contratos</td>
                                <td style="width: 164px; text-align: center;"><?php //echo number_format($contratos, 2, '.', ','); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 164px; text-align: center;">Efectividad de la ejecución</td>
                                <td style="width: 164px; text-align: center;"><?php //echo number_format($ejecucion, 2, '.', ','); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 164px; text-align: center;">Nota de prioridad</td>
                                <td style="width: 164px; text-align: center;"><?php //echo number_format($cumplimiento, 2, '.', ','); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 164px; text-align: center;">Divulgación</td>
                                <td style="width: 164px; text-align: center;"><?php //echo number_format($divulgacion, 2, '.', ','); ?></td>
                            </tr>
                        </tbody>
                    </table> -->
                </td>
            </tr>
        </table>
        <table class="general">
            <tr>
                <td style="text-align:center">
                    <?php echo CHtml::Button('Ver información de respaldo', array('onclick' => '$("#modal_finalizacion").dialog("open"); return false;','id'=>'btnFinalEjecucionAdj')); ?>
                </td>
            </tr>
        </table>
        <?php } else {
              echo "<p>No ha divulgado esta información </p>";
            }?>
    </div>
</div>
<?php
    // *****************************************************************************************
    // ***************************  SECCION DE LOS ADJUNTOS ************************************
    // *****************************************************************************************
    // ========================= PROYECTO ======================================================

    //$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'respProyecto'));
        //echo '<div class="modal-header"><h3>Información de respaldo de Proyectos</h3></div>';
        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => "respProyecto",
            'options' => array(
                'title' => 'Información de Respaldo del Proyecto',
                'autoOpen' => false,
                'modal' => true,
                'width' => 900,
                'resizable' => false,
                'show' => array(
                    'effect' => 'blind',
                    'duration' => 1000,
                    'scrolling' => false
                ),
                'hide' => array(
                    'effect' => 'blind',
                    'duration' => 500
                )
            )
        ));
        $this->widget('zii.widgets.CDetailView', array(
            'data' => $proyecto,
            'attributes' => array(
                array(
                    'label' => 'Especificaciones y Planos de la Obra',
                    'type' => 'raw',
                    'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_especificaciones_planos'])), $this->getNameFromEnlace($proyecto[0]['adj_especificaciones_planos']), array(
                        'target' => '_blank'
                    )), $proyecto[0]['adj_especificaciones_planos'])
                ),
                array(
                    'label' => 'Presupuesto y Programa Multianual del Proyecto',
                    'type' => 'raw',
                    'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_presupuesto_programa'])), $this->getNameFromEnlace($proyecto[0]['adj_presupuesto_programa']), array(
                        'target' => '_blank'
                    )), $proyecto[0]['adj_presupuesto_programa'])
                ),
                array(
                    'label' => 'Estudio de Factibilidad',
                    'type' => 'raw',
                    'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_estudio_factibilidad'])), $this->getNameFromEnlace($proyecto[0]['adj_estudio_factibilidad']), array(
                        'target' => '_blank'
                    )), $proyecto[0]['adj_estudio_factibilidad'])
                ),
                array(
                    'label' => 'Estudio de Impacto Ambiental',
                    'type' => 'raw',
                    'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_estudio_impacto'])), $this->getNameFromEnlace($proyecto[0]['adj_estudio_impacto']), array(
                        'target' => '_blank'
                    )), $proyecto[0]['adj_estudio_impacto'])
                ),
                array(
                    'label' => 'Licencia Ambiental y Contrato de Medidas de Mitigación',
                    'type' => 'raw',
                    'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_licencia_ambiental'])), $this->getNameFromEnlace($proyecto[0]['adj_licencia_ambiental']), array(
                        'target' => '_blank'
                    )), $proyecto[0]['adj_licencia_ambiental'])
                ),
                array(
                    'label' => 'Plan de Reasentamiento y Compensación',
                    'type' => 'raw',
                    'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_plan_reasentamiento'])), $this->getNameFromEnlace($proyecto[0]['adj_plan_reasentamiento']), array(
                        'target' => '_blank'
                    )), $proyecto[0]['adj_plan_reasentamiento'])
                ),
                array(
                    'label' => 'Acuerdo de Financiamiento',
                    'type' => 'raw',
                    'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_acuerdo_financiamiento'])), $this->getNameFromEnlace($proyecto[0]['adj_acuerdo_financiamiento']), array(
                        'target' => '_blank'
                    )), $proyecto[0]['adj_acuerdo_financiamiento'])
                ),
                array(
                    'label' => 'Nota Prioridad',
                    'type' => 'raw',
                    'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_nota_prioridad'])), $this->getNameFromEnlace($proyecto[0]['adj_nota_prioridad']), array(
                        'target' => '_blank'
                    )), $proyecto[0]['adj_nota_prioridad'])
                ),
                array(
                    'label' => 'Otro',
                    'type' => 'raw',
                    'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_otro'])), $this->getNameFromEnlace($proyecto[0]['adj_otro']), array(
                        'target' => '_blank'
                    )), $proyecto[0]['adj_otro'])
                )
            )
        ));
        echo '<div class="modal-footer"></div>';
    $this->endWidget();

    // ========================= CALIFICACION ======================================================

    if (!empty($calificacion)) {
        //$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'respCalificacion','htmlOptions' => array('style' => 'width: 800px;')));
            //echo '<div class="modal-header"><h3>Información de respaldo de Calificación</h3></div>';
            $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                'id' => "respCalificacion",
                'options' => array(
                    'title' => 'Información de Respaldo de Calificación',
                    'autoOpen' => false,
                    'modal' => true,
                    'width' => 900,
                    'resizable' => false,
                    'show' => array(
                        'effect' => 'blind',
                        'duration' => 1000,
                        'scrolling' => false
                    ),
                    'hide' => array(
                        'effect' => 'blind',
                        'duration' => 500
                    )
                )
            ));

            $this->widget('zii.widgets.CDetailView', array(
                'data' => $calificacion,
                'attributes' => array(
                    array(
                        'label' => 'Invitación a los Interesados para Participar en el Proceso de Calificación para la Ejecución del Proyecto o en la Calificación para el Concurso para la Supervición de Obras',
                        'type' => 'raw',
                        'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($calificacion[0]['adj_invitacion_interesados'])), $this->getNameFromEnlace($calificacion[0]['adj_invitacion_interesados']), array(
                            'target' => '_blank'
                        )), $calificacion[0]['adj_invitacion_interesados'])
                    ),
                    array(
                        'label' => 'Bases de Precalificación del Proceso',
                        'type' => 'raw',
                        'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($calificacion[0]['adj_bases_precalificacion'])), $this->getNameFromEnlace($calificacion[0]['adj_bases_precalificacion']), array(
                            'target' => '_blank'
                        )), $calificacion[0]['adj_bases_precalificacion'])
                    ),
                    array(
                        'label' => 'Resolución declarando la Precalificación de los Interesados que Acreditaron los Requisitos Exigidos en las Bases',
                        'type' => 'raw',
                        'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($calificacion[0]['adj_resolucion'])), $this->getNameFromEnlace($calificacion[0]['adj_resolucion']), array(
                            'target' => '_blank'
                        )), $calificacion[0]['adj_resolucion'])
                    ),
                    array(
                        'label' => 'Convocatoria o Invitación a Licitar',
                        'type' => 'raw',
                        'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($calificacion[0]['adj_convocatoria'])), $this->getNameFromEnlace($calificacion[0]['adj_convocatoria']), array(
                            'target' => '_blank'
                        )), $calificacion[0]['adj_convocatoria'])
                    ),
                    array(
                        'label' => 'Pliego de Condiciones o Bases del Concurso (TdR)',
                        'type' => 'raw',
                        'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($calificacion[0]['adj_pliego_condiciones'])), $this->getNameFromEnlace($calificacion[0]['adj_pliego_condiciones']), array(
                            'target' => '_blank'
                        )), $calificacion[0]['adj_pliego_condiciones'])
                    ),
                    array(
                        'label' => 'Aclaraciones o Enmiendas al Pliego de Condiciones',
                        'type' => 'raw',
                        'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($calificacion[0]['adj_pliego_condiciones'])), $this->getNameFromEnlace($calificacion[0]['adj_pliego_condiciones']), array(
                            'target' => '_blank'
                        )), $calificacion[0]['adj_pliego_condiciones'])
                    ),
                    array(
                        'label' => 'Acta de Recepción/ Presentación de Ofertas',
                        'type' => 'raw',
                        'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($calificacion[0]['adj_acta_recepcion'])), $this->getNameFromEnlace($calificacion[0]['adj_acta_recepcion']), array(
                            'target' => '_blank'
                        )), $calificacion[0]['adj_acta_recepcion'])
                    ),
                    array(
                        'label' => 'Otro',
                        'type' => 'raw',
                        'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($calificacion[0]['adj_otro'])), $this->getNameFromEnlace($calificacion[0]['adj_otro']), array(
                            'target' => '_blank'
                        )), $calificacion[0]['adj_otro'])
                    )
                )
            ));
            echo '<div class="modal-footer"></div>';
        $this->endWidget();
    }

    // ========================= ADJUDICACION ======================================================

    if (!empty($adjudicacion)) {
        //$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'respAdjudicacion'));
        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => "respAdjudicacion",
            'options' => array(
                'title' => 'Información de Respaldo de Adjudicacion',
                'autoOpen' => false,
                'modal' => true,
                'width' => 900,
                'resizable' => false,
                'show' => array(
                    'effect' => 'blind',
                    'duration' => 1000,
                    'scrolling' => false
                ),
                'hide' => array(
                    'effect' => 'blind',
                    'duration' => 500
                )
            )
        ));
            //echo '<div class="modal-header"><h3>Información de respaldo de Adjudicación</h3></div>';
            $this->widget('zii.widgets.CDetailView', array(
                'data' => $adjudicacion,
                'attributes' => array(
                    array(
                        'label' => 'Acta de Apertura de las Ofertas',
                        'type' => 'raw',
                        'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($adjudicacion[0]['actaaper'])), $this->getNameFromEnlace($adjudicacion[0]['actaaper']), array(
                            'target' => '_blank'
                        )), $adjudicacion[0]['actaaper'])
                    ),
                    array(
                        'label' => 'Informe y Acta de Recomendación',
                        'type' => 'raw',
                        'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($adjudicacion[0]['informeacta'])), $this->getNameFromEnlace($adjudicacion[0]['informeacta']), array(
                            'target' => '_blank'
                        )), $adjudicacion[0]['informeacta'])
                    ),
                    array(
                        'label' => 'Resolución de la Adjudicación',
                        'type' => 'raw',
                        'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($adjudicacion[0]['resoladju'])), $this->getNameFromEnlace($adjudicacion[0]['resoladju']), array(
                            'target' => '_blank'
                        )), $adjudicacion[0]['resoladju'])
                    ),
                    array(
                        'label' => 'Otro',
                        'type' => 'raw',
                        'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($adjudicacion[0]['otro'])), $this->getNameFromEnlace($adjudicacion[0]['otro']), array(
                            'target' => '_blank'
                        )), $adjudicacion[0]['otro'])
                    )
                )
            ));
            //echo '<div class="modal-footer"></div>';
        $this->endWidget();
    }

    // ========================= CONTRATACION ======================================================

    if (!empty($contratacion)) {
        //$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'respContratacion'));
          //  echo '<div class="modal-header"><h3>Información de respaldo de Contratación</h3></div>';
          $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id' => "respContratacion",
                        'options' => array(
                            'title' => 'Información de Respaldo de Contratación',
                            'autoOpen' => false,
                            'modal' => true,
                            'width' => 900,
                            'resizable' => false,
                            'show' => array(
                                'effect' => 'blind',
                                'duration' => 1000,
                                'scrolling' => false
                            ),
                            'hide' => array(
                                'effect' => 'blind',
                                'duration' => 500
                            )
                        )
                    ));
            $this->widget('zii.widgets.CDetailView', array(
                'data' => $contratacion,
                'attributes' => array(
                    array(
                        'label' => 'Documento de Contrato y Condiciones',
                        'type' => 'raw',
                        'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($contratacion[0]['adj_contrato_condiciones'])), $this->getNameFromEnlace($contratacion[0]['adj_contrato_condiciones']), array(
                            'target' => '_blank'
                        )), $contratacion[0]['adj_contrato_condiciones'])
                    ),
                    array(
                        'label' => 'Registro, Antecedentes e Información del Consultor o Propietario(s) de la Firma Contratada',
                        'type' => 'raw',
                        'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($contratacion[0]['adj_antecedentes'])), $this->getNameFromEnlace($contratacion[0]['adj_antecedentes']), array(
                            'target' => '_blank'
                        )), $contratacion[0]['adj_antecedentes'])
                    ),
                    array(
                        'label' => 'Especificaciones y Planos del Proyecto a Ejecutar Cuando Corresponda',
                        'type' => 'raw',
                        'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($contratacion[0]['adj_especificaciones_planos'])), $this->getNameFromEnlace($contratacion[0]['adj_especificaciones_planos']), array(
                            'target' => '_blank'
                        )), $contratacion[0]['adj_especificaciones_planos'])
                    ),
                    array(
                        'label' => 'Otro',
                        'type' => 'raw',
                        'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($contratacion[0]['adj_otro'])), $this->getNameFromEnlace($contratacion[0]['adj_otro']), array(
                            'target' => '_blank'
                        )), $contratacion[0]['adj_otro'])
                    )
                )
            ));
            echo '<div class="modal-footer"></div>';
        $this->endWidget();
    }


    // ========================= INICIO DE EJECUCION ======================================================

    if (!empty($ejecucion2)) {
      //$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'respEjecucion'));
      //echo '<div class="modal-header"><h3>Información de respaldo de Ejecución</h3></div>';
      $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                    'id' => "respEjecucion",
                    'options' => array(
                        'title' => 'Información de Respaldo de Ejecución',
                        'autoOpen' => false,
                        'modal' => true,
                        'width' => 900,
                        'resizable' => false,
                        'show' => array(
                            'effect' => 'blind',
                            'duration' => 1000,
                            'scrolling' => false
                        ),
                        'hide' => array(
                            'effect' => 'blind',
                            'duration' => 500
                        )
                    )
                ));
      $this->widget('zii.widgets.CDetailView', array(
        'data' => $ejecucion2,
        'attributes' => array(
          array(
            'label' => 'Programación inicial',
            'type' => 'raw',
            'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($ejecucion2[0]['programainicial'])), $this->getNameFromEnlace($ejecucion2[0]['programainicial']), array(
              'target' => '_blank'
            )), $ejecucion2[0]['programainicial'])
          )
        )
      ));
      echo '<div class="modal-footer"></div>';
      $this->endWidget();
    }
    ?>

    <?php
    // ========================= FINALIZACIÓN ======================================================
    $Final_Ejecucion= Yii::app()->db->createCommand('SELECT * FROM cs_final_ejecucion WHERE estado="PUBLICADO" AND idInicioEjecucion='.$IdInicioEjecucion)->queryAll();
if(!empty($Final_Ejecucion)){
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => "modal_finalizacion",
        'options' => array(
            'title' => 'Información de Respaldo de la Finalización',
            'autoOpen' => false,
            'modal' => true,
            'width' => 900,
            'resizable' => false,
            'show' => array(
                'effect' => 'blind',
                'duration' => 1000,
                'scrolling' => false
            ),
            'hide' => array(
                'effect' => 'blind',
                'duration' => 500
            )
        )
    ));

    $this->widget('zii.widgets.CDetailView', array(
        'data' => $Final_Ejecucion,
        'attributes' => array(
            array(
                'label' => 'Documento de Garantía',
                'type' => 'raw',
                'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($Final_Ejecucion[0]['adj_documentoGarantia'])), $this->getNameFromEnlace($Final_Ejecucion[0]['adj_documentoGarantia']), array(
                    'target' => '_blank'
                )), $Final_Ejecucion[0]['adj_documentoGarantia'])
            ),
            array(
                'label' => 'Acta de Recepción',
                'type' => 'raw',
                'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($Final_Ejecucion[0]['adj_actaRecepcion'])), $this->getNameFromEnlace($Final_Ejecucion[0]['adj_actaRecepcion']), array(
                    'target' => '_blank'
                )), $Final_Ejecucion[0]['adj_actaRecepcion'])
            ),
            array(
                'label' => 'Informes de Evaluación',
                'type' => 'raw',
                'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($Final_Ejecucion[0]['adj_informesEvaluacion'])), $this->getNameFromEnlace($Final_Ejecucion[0]['adj_informesEvaluacion']), array(
                    'target' => '_blank'
                )), $Final_Ejecucion[0]['adj_informesEvaluacion'])
            ),
            array(
                'label' => 'Informes de Disconformidad',
                'type' => 'raw',
                'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($Final_Ejecucion[0]['adj_informeDisconformidad'])), $this->getNameFromEnlace($Final_Ejecucion[0]['adj_informeDisconformidad']), array(
                    'target' => '_blank'
                )), $Final_Ejecucion[0]['adj_informeDisconformidad'])
            ),
            array(
                'label' => 'Informe de Aseguramiento de Calidad',
                'type' => 'raw',
                'value' => $this->getEnlaceVacio(CHtml::link(CHtml::encode($this->getNameFromURL($Final_Ejecucion[0]['adj_informeAseguramientoCalidad'])), $this->getNameFromEnlace($Final_Ejecucion[0]['adj_informeAseguramientoCalidad']), array(
                    'target' => '_blank'
                )), $Final_Ejecucion[0]['adj_informeAseguramientoCalidad'])
            )
        )
    ));
    echo '<div class="modal-footer"></div>';
$this->endWidget();
}
else
{
  echo '<script>document.getElementById("btnFinalEjecucionAdj").disabled=true;</script><style> #btnFinalEjecucionAdj{color: gray;}</style>';
}
     ?>