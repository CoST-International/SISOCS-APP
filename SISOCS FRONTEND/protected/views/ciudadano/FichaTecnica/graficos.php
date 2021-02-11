<div class="row">
    <h5 style="text-align:center">Etapas del proceso de adquisición en el proyecto</h5>
    <hr>
    <div class="col-sm-12 col-md-12 col-xs-12">
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

                                            if ($vidpathsControl['idProyecto'] != null) {
                                                $fechaIncioProyecto        = Yii::app()->db->createCommand('SELECT * FROM  cs_proyecto WHERE idProyecto=' . $IdProyecto)->queryRow();
                                                $Fecha_Aprobacion_Proyecto = $fechaIncioProyecto['fechaaprob'];
                                            } else {
                                                $tdProyecto = false;
                                            }

                                            // ======================================Calificacion==============================================

                                            if ($vidpathsControl['idCalificacion'] != null) {
                                                $fechaIncioCalificacion        = Yii::app()->db->createCommand('SELECT * FROM cs_calificacion WHERE idCalificacion=' . $IdCalificacion)->queryRow();
                                                $Fecha_Aprobacion_Calificacion = $fechaIncioCalificacion['fecha_publicacion'];
                                            } else {
                                                $tdCalificacion = false;
                                            }

                                            // =====================================Adjudicacion===============================================

                                            if ($vidpathsControl['idAdjudicacion'] != null) {
                                                $fechaIncioAjudicacion         = Yii::app()->db->createCommand('SELECT * FROM cs_adjudicacion WHERE idAdjudicacion=' . $IdAdjudicacion)->queryRow();
                                                $Fecha_Aprobacion_Adjudicacion = $fechaIncioAjudicacion['fecha_creacion'];
                                            } else {
                                                $tdAdjudicacion = false;
                                            }

                                            // ======================================CONTRATACION========================================================

                                            if ($vidpathsControl['idContratacion'] != null) {
                                                $fechaIncioContratacion        = Yii::app()->db->createCommand('SELECT * FROM  cs_contratacion WHERE idContratacion=' . $IdContratacion)->queryRow();
                                                $Fecha_Aprobacion_Contratacion = $fechaIncioContratacion['fecha_publicacion'];
                                            } else {
                                                $tdContratacion = false;
                                            }

                                            // ===========================================INICIO EJECUCION =====================================================================

                                            if ($vidpathsControl['idInicioEjecucion'] != null) {
                                                $fechaIncioInicioEjecucion        = Yii::app()->db->createCommand('SELECT * FROM cs_inicio_ejecucion WHERE idInicioEjecucion=' . $IdInicioEjecucion)->queryRow();
                                                $Fecha_Aprobacion_InicioEjecucion = $fechaIncioInicioEjecucion['fecha_creacion'];
                                            } else {
                                                $tdInicioEjecucion = false;
                                            }

                                            // =============================================AVANCE==================================================================================

                                            if ($vidpathsControl['idAvances'] != null) {
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

                                            if ($vidpathsControl['idProyecto'] != null) {
                                                $fechaIncioProyecto        = Yii::app()->db->createCommand('SELECT * FROM  cs_proyecto WHERE idProyecto=' . $IdProyecto)->queryRow();
                                                $Fecha_Aprobacion_Proyecto = $fechaIncioProyecto['fechaaprob'];
                                            } else {
                                                $tdProyecto = false;
                                            }

                                            // ======================================Calificacion==============================================

                                            if ($vidpathsControl['idCalificacion'] != null) {
                                                $fechaIncioCalificacion        = Yii::app()->db->createCommand('SELECT * FROM cs_calificacion WHERE idCalificacion=' . $IdCalificacion)->queryRow();
                                                $Fecha_Aprobacion_Calificacion = $fechaIncioCalificacion['fecha_creacion'];
                                            } else {
                                                $tdCalificacion = false;
                                            }

                                            // =====================================Adjudicacion===============================================

                                            if ($vidpathsControl['idAdjudicacion'] != null) {
                                                $fechaIncioAjudicacion         = Yii::app()->db->createCommand('SELECT * FROM cs_adjudicacion WHERE idAdjudicacion=' . $IdAdjudicacion)->queryRow();
                                                $Fecha_Aprobacion_Adjudicacion = $fechaIncioAjudicacion['fecha_creacion'];
                                            } else {
                                                $tdAdjudicacion = false;
                                            }

                                            // ======================================CONTRATACION========================================================

                                            if ($vidpathsControl['idContratacion'] != null) {
                                                $fechaIncioContratacion        = Yii::app()->db->createCommand('SELECT * FROM  cs_contratacion WHERE idContratacion=' . $IdContratacion)->queryRow();
                                                $Fecha_Aprobacion_Contratacion = $fechaIncioContratacion['fecha_publicacion'];
                                            } else {
                                                $tdContratacion = false;
                                            }

                                            // ===========================================INICIO EJECUCION =====================================================================

                                            if ($vidpathsControl['idInicioEjecucion'] != null) {
                                                $fechaIncioInicioEjecucion        = Yii::app()->db->createCommand('SELECT * FROM cs_inicio_ejecucion WHERE idInicioEjecucion=' . $IdInicioEjecucion)->queryRow();
                                                $Fecha_Aprobacion_InicioEjecucion = $fechaIncioInicioEjecucion['fecha_creacion'];
                                            } else {
                                                $tdInicioEjecucion = false;
                                            }

                                            // =============================================AVANCE==================================================================================

                                            if ($vidpathsControl['idAvances'] != null) {
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

                                            if ($vidpathsControl['idProyecto'] != null) {
                                                $fechaIncioProyecto        = Yii::app()->db->createCommand('SELECT * FROM  cs_proyecto WHERE idProyecto=' . $IdProyecto)->queryRow();
                                                $Fecha_Aprobacion_Proyecto = $fechaIncioProyecto['fechaaprob'];
                                            } else {
                                                $tdProyecto = false;
                                            }

                                            // ======================================Calificacion==============================================

                                            if ($vidpathsControl['idCalificacion'] != null) {
                                                $fechaIncioCalificacion        = Yii::app()->db->createCommand('SELECT * FROM cs_calificacion WHERE idCalificacion=' . $IdCalificacion)->queryRow();
                                                $Fecha_Aprobacion_Calificacion = $fechaIncioCalificacion['fecha_creacion'];
                                            } else {
                                                $tdCalificacion = false;
                                            }

                                            // =====================================Adjudicacion===============================================

                                            if ($vidpathsControl['idAdjudicacion'] != null) {
                                                $fechaIncioAjudicacion         = Yii::app()->db->createCommand('SELECT * FROM cs_adjudicacion WHERE idAdjudicacion=' . $IdAdjudicacion)->queryRow();
                                                $Fecha_Aprobacion_Adjudicacion = $fechaIncioAjudicacion['fecha_creacion'];
                                            } else {
                                                $tdAdjudicacion = false;
                                            }

                                            // ======================================CONTRATACION========================================================

                                            if ($vidpathsControl['idContratacion'] != null) {
                                                $fechaIncioContratacion        = Yii::app()->db->createCommand('SELECT * FROM  cs_contratacion WHERE idContratacion=' . $IdContratacion)->queryRow();
                                                $Fecha_Aprobacion_Contratacion = $fechaIncioContratacion['fecha_publicacion'];
                                            } else {
                                                $tdContratacion = false;
                                            }

                                            // ===========================================INICIO EJECUCION =====================================================================

                                            if ($vidpathsControl['idInicioEjecucion'] != null) {
                                                $fechaIncioInicioEjecucion        = Yii::app()->db->createCommand('SELECT * FROM cs_inicio_ejecucion WHERE idInicioEjecucion=' . $IdInicioEjecucion)->queryRow();
                                                $Fecha_Aprobacion_InicioEjecucion = $fechaIncioInicioEjecucion['fecha_creacion'];
                                            } else {
                                                $tdInicioEjecucion = false;
                                            }

                                            // =============================================AVANCE==================================================================================

                                            if ($vidpathsControl['idAvances'] != null) {
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

                                            if ($vidpathsControl['idProyecto'] != null) {
                                                $fechaIncioProyecto        = Yii::app()->db->createCommand('SELECT * FROM  cs_proyecto WHERE idProyecto=' . $IdProyecto)->queryRow();
                                                $Fecha_Aprobacion_Proyecto = $fechaIncioProyecto['fechaaprob'];
                                            } else {
                                                $tdProyecto = false;
                                            }

                                            // ======================================Calificacion==============================================

                                            if ($vidpathsControl['idCalificacion'] != null) {
                                                $fechaIncioCalificacion        = Yii::app()->db->createCommand('SELECT * FROM cs_calificacion WHERE idCalificacion=' . $IdCalificacion)->queryRow();
                                                $Fecha_Aprobacion_Calificacion = $fechaIncioCalificacion['fecha_publicacion'];
                                            } else {
                                                $tdCalificacion = false;
                                            }

                                            // =====================================Adjudicacion===============================================

                                            if ($vidpathsControl['idAdjudicacion'] != null) {
                                                $fechaIncioAjudicacion         = Yii::app()->db->createCommand('SELECT * FROM cs_adjudicacion WHERE idAdjudicacion=' . $IdAdjudicacion)->queryRow();
                                                $Fecha_Aprobacion_Adjudicacion = $fechaIncioAjudicacion['fecha_publicacion'];
                                            } else {
                                                $tdAdjudicacion = false;
                                            }

                                            // ======================================CONTRATACION========================================================

                                            if ($vidpathsControl['idContratacion'] != null) {
                                                $fechaIncioContratacion        = Yii::app()->db->createCommand('SELECT * FROM  cs_contratacion WHERE idContratacion=' . $IdContratacion)->queryRow();
                                                $Fecha_Aprobacion_Contratacion = $fechaIncioContratacion['fecha_publicacion'];
                                            } else {
                                                $tdContratacion = false;
                                            }

                                            // ===========================================INICIO EJECUCION =====================================================================

                                            if ($vidpathsControl['idInicioEjecucion'] != null) {
                                                $fechaIncioInicioEjecucion        = Yii::app()->db->createCommand('SELECT * FROM cs_inicio_ejecucion WHERE idInicioEjecucion=' . $IdInicioEjecucion)->queryRow();
                                                $Fecha_Aprobacion_InicioEjecucion = $fechaIncioInicioEjecucion['fecha_publicacion'];
                                            } else {
                                                $tdInicioEjecucion = false;
                                            }

                                            // =============================================AVANCE==================================================================================

                                            if ($vidpathsControl['idAvances'] != null) {
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
            <table width="100%%" border="0" bordercolordark="#000000" class="table table-responsive" style="font-size:.8em">
                <tr>
                    <?php
                                            if ($tdProyecto == true) {
                                                echo '<td width="14%" bgcolor="#EAB200">&nbsp;</td>' . '<td width="0%" bgcolor="#999999">&nbsp;</td>';
                                            }
                                            if ($tdCalificacion == true) {
                                                echo '<td width="14%" bgcolor="#EAB200">&nbsp;</td>' . '<td width="0%" bgcolor="#999999">&nbsp;</td>';
                                            }
                                            if ($tdAdjudicacion == true) {
                                                echo '<td width="14%" bgcolor="#EAB200">&nbsp;</td>' . '<td width="0%" bgcolor="#999999">&nbsp;</td>';
                                            }
                                            if ($tdContratacion == true) {
                                                echo '<td width="14%" bgcolor="#EAB200">&nbsp;</td>' . '<td width="0%" bgcolor="#999999">&nbsp;</td>';
                                            }
                                            if ($tdInicioEjecucion == true) {
                                                echo '<td width="14%" bgcolor="#EAB200">&nbsp;</td>' . '<td width="0%" bgcolor="#999999">&nbsp;</td>';
                                            }
                                            if ($tdAvances == true) {
                                                echo '<td width="14%" bgcolor="#EAB200">&nbsp;</td>' . '<td width="0%" bgcolor="#999999">&nbsp;</td>';
                                            }
                                            ?>
                </tr>
                <tr>
                    <?php
                                            if ($tdAdjudicacion == true) {
                                                echo '<td>';
                                                echo '<ol class="progtrckr" data-progtrckr-steps="5">';
                                                echo '<li  class="progtrckr-done"><b> Aprobación  Proyecto</b> </br><b>' . $Fecha_Aprobacion_Proyecto . '</b></li>';
                                                echo '</ol>';
                                                echo '</td>';
                                                echo '<td>&nbsp;</td>';
                                            }

                                            if ($tdContratacion == true) {
                                                $createDate = new DateTime($Fecha_Aprobacion_Calificacion);
                                                echo '<td>';
                                                echo '<ol class="progtrckr" data-progtrckr-steps="5">';
                                                echo '<li  class="progtrckr-done"><b> Aprobación  Calificación </b> </br><b>' .$createDate->format('d/m/Y')  . '</b></li>';
                                                echo '</ol>';
                                                echo '</td>';
                                                echo '<td>&nbsp;</td>';
                                            }

                                            if ($tdAdjudicacion == true) {
                                                $createDate = new DateTime($Fecha_Aprobacion_Adjudicacion);
                                                echo '<td>';
                                                echo '<ol class="progtrckr" data-progtrckr-steps="5">';
                                                echo '<li  class="progtrckr-done"><b> Aprobación  Adjudicación </b> </br><b>' . $createDate->format('d/m/Y') . '</b></li>';
                                                echo '</ol>';
                                                echo '</td>';
                                                echo '<td>&nbsp;</td>';
                                            }

                                            if ($tdCalificacion == true) {
                                                $createDate = new DateTime($Fecha_Aprobacion_Contratacion);
                                                echo '<td>';
                                                echo '<ol class="progtrckr" data-progtrckr-steps="5">';
                                                echo '<li  class="progtrckr-done"><b> Aprobación  Contratación </b> </br><b>' . $createDate->format('d/m/Y') . '</b></li>';
                                                echo '</ol>';
                                                echo '</td>';
                                                echo '<td>&nbsp;</td>';
                                            }

                                            if ($tdInicioEjecucion == true) {
                                                $createDate = new DateTime($Fecha_Aprobacion_InicioEjecucion);
                                                echo '<td>';
                                                echo '<ol class="progtrckr" data-progtrckr-steps="5">';
                                                echo '<li  class="progtrckr-done"><b> Aprobación  Implementación </b> </br><b>' . $createDate->format('d/m/Y') . '</b></li>';
                                                echo '</ol>';
                                                echo '</td>';
                                                echo '<td>&nbsp;</td>';
                                            }

                                            if ($tdAvances == true) {
                                                echo '<td>';
                                                echo '<ol class="progtrckr" data-progtrckr-steps="5">';
                                                echo '<li  class="progtrckr-done"><b> Avance</b> </br><b>' . $Fecha_Aprobacion_Avance . '</b> </br> <b>- % Físico Real: ' . $porcentageAvance . '</b></br><b> - % Financiero Real: ' . number_format($finan_programado, 2). '</b></li>';
                                                echo '</ol>';
                                                echo '</td>';
                                                echo '<td>&nbsp;</td>';
                                            }
                                            ?>
                </tr>
            </table>
            <br/>
            <br/>
    </div>
</div>
<!-- ***********************  GRAFICOS ***********************  -->
<div class="row">

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

            <div class="col-md-6 col-sm-12 col-xs-12" style="text-align:center">
                <h5 style="font-size:1.2em">Comparación avance Financiero vs. Real</h5>
                <hr>
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
                                                )); ?>

            </div>
            <div class="col-md-6 col-sm-12 col-xs-12" style="text-align:center">
                <h5 style="font-size:1.2em">Comparación avance Fí­sico vs. Real</h5>
                <hr>
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
                                                )); ?>
            </div>
            <?php
                }
            ?>

</div>
