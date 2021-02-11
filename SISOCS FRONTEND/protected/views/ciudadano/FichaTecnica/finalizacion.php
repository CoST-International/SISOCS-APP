<?php
                                    if (!empty($ejecucion)) {
                                        $finalizacion = Yii::app()->db->createCommand()
                                                                      ->select('*')
                                                                      ->from('cs_final_ejecucion')
                                                                      ->where('idInicioEjecucion=:id', array(':id' => $ejecucion[0]['idInicioEjecucion']))
                                                                      ->queryAll();

                                        if (!empty($finalizacion)) {
                                            ?>
                                <table class="general">
                                    <tr>
                                        <td width="49%" valign="top" style="text-align:left;">
                                            <table class="table table-bordered table-hover" width="100%">
                                                <tr>
                                                    <td width="51%">
                                                        <?php echo (!empty($finalizacion[0]['idFinalizacion'])) ? $finalizacion[0]['idFinalizacion'] : 'No ha divulgado esta información'; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="49%">
                                                        <strong>Costo finalización:
                                                            <strong>
                                                    </td>
                                                    <td width="51%">
                                                        <?php echo (!empty($finalizacion[0]['costoFinalizacion'])) ? $finalizacion[0]['costoFinalizacion'] : 'No ha divulgado esta información'; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="49%">
                                                        <strong>Alcance finalización:
                                                            <strong>
                                                    </td>
                                                    <td width="51%">
                                                        <?php echo (!empty($finalizacion[0]['alcanceFinalizacion'])) ? $finalizacion[0]['alcanceFinalizacion'] : 'No ha divulgado esta información'; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="49%">
                                                        <strong>Fecha finalización:
                                                            <strong>
                                                    </td>
                                                    <td width="51%">
                                                        <?php echo (!empty($finalizacion[0]['fechaFinalizacion'])) ?  date("d/m/y", strtotime($finalizacion[0]['fechaFinalizacion'])) : 'No ha divulgado esta información'; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="49%">
                                                        <strong>Razones de Cambios en el Proyecto :
                                                            <strong>
                                                    </td>
                                                    <td width="51%">
                                                        <?php echo (!empty($finalizacion[0]['razonesCambios'])) ? $finalizacion[0]['razonesCambios'] : 'No ha divulgado esta información'; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="49%">
                                                        <strong>Razones de cambios en el presupuesto:
                                                            <strong>
                                                    </td>
                                                    <td width="51%">
                                                        <?php echo (!empty($finalizacion[0]['razonesCambiosPresupuesto'])) ? $finalizacion[0]['razonesCambiosPresupuesto'] : 'No ha divulgado esta información'; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="42%">
                                                        <strong>Fecha publicación en el sistema:
                                                            <strong>
                                                    </td>
                                                    <td width="58%">
                                                        <?php echo (!empty($finalizacion[0]['fecha_creacion'])) ? date("d/m/y", strtotime($finalizacion[0]['fecha_publicacion'])) : 'No ha divulgado esta información'; ?>
                                                    </td>
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

                                            $totali = $transparencia + $montos + $plazo + $supervision + $contratos + $ejecucion + $cumplimiento + $divulgacion; ?>
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
                                                        <td style="width: 164px; text-align: center;"><?php //echo number_format($transparencia, 2, '.', ',');?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 164px; text-align: center;">Gestión de montos</td>
                                                        <td style="width: 164px; text-align: center;"><?php //echo number_format($montos, 2, '.', ',');?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 164px; text-align: center;">Gestión de plazos</td>
                                                        <td style="width: 164px; text-align: center;"><?php //echo number_format($plazo, 2, '.', ',');?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 164px; text-align: center;">Razonabilidad de la supervisión</td>
                                                        <td style="width: 164px; text-align: center;"><?php //echo number_format($supervision, 2, '.', ',');?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 164px; text-align: center;">Gestión de los contratos</td>
                                                        <td style="width: 164px; text-align: center;"><?php //echo number_format($contratos, 2, '.', ',');?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 164px; text-align: center;">Efectividad de la ejecución</td>
                                                        <td style="width: 164px; text-align: center;"><?php //echo number_format($ejecucion, 2, '.', ',');?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 164px; text-align: center;">Nota de prioridad</td>
                                                        <td style="width: 164px; text-align: center;"><?php //echo number_format($cumplimiento, 2, '.', ',');?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 164px; text-align: center;">Divulgación</td>
                                                        <td style="width: 164px; text-align: center;"><?php //echo number_format($divulgacion, 2, '.', ',');?></td>
                                                    </tr>
                                                </tbody>
                                            </table> -->
                                        </td>
                                    </tr>
                                </table>
                                <div class="code-boxInverse">
                                    <h5> Documentos de la finalización</h5>
                                    <?php
                                        $generidData = FinalizacionDocuments::model()->findAll(array(
                                            'condition' => 'idFinalizacion=:id',
                                            'params' => array(
                                                ':id' => $finalizacion[0]['idFinalizacion']
                                            )
                                        )); ?>

                                        <hr>
                                        <table class="display hover row-border" id="FinalizacionDocumentsTable" cellspacing="0" style="width:100%;">
                                            <thead>
                                                <tr style="background:#29a4dd;color:#fff">
                                                    <th>Titulo</th>
                                                    <th>Descripción</th>
                                                    <th>Documentos</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $total_x=count($generidData);
                                            $row=0;
                                            while ($row< $total_x) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <span>
                                                                <?php echo $generidData[$row] ['title']; ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <?php echo $generidData[$row] ['description']; ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <?php echo $generidData[$row] ['url']; ?>
                                                            </span>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                $row++;
                                            } ?>
                                            </tbody>
                                        </table>
                                </div>
                                <table class="general">
                                    <tr>
                                        <td style="text-align:center">
                                            <?php //echo CHtml::Button('Ver información de respaldo', array('onclick' => '$("#modal_finalizacion").dialog("open"); return false;','id'=>'btnFinalEjecucionAdj'));?>
                                        </td>
                                    </tr>
                                </table>
                                <?php
                                        }
                                    }?>