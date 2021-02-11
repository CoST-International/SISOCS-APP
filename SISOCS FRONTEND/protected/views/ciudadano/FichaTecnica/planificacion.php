<div class="animated fadeIn">
<?php if (!empty($proyecto)) {
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/protected/views/ciudadano/FichaTecnica/assets/js/timeline.js');
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/protected/views/ciudadano/FichaTecnica/assets/css/timeline.css'); ?>
<form class="form-horizontal" role="form" style="padding-top:10px">
    <div class="row">

        <div class="col-md-12 col-xs-12 col-sm-12">
            <label for="name" class="control-label col-sm-3" style="font-weight:bold">Código del proyecto:</label>
            <div class="col-sm-9" style="text-align:justify">
                <p>
                    <?php echo (!empty($proyecto[0]['codigo'])) ? $proyecto[0]['codigo'] : 'No ha divulgado esta información'; ?>
                </p>
            </div>
        </div>
        <div class="col-md-12 col-xs-12 col-sm-12">
            <label for="name" class="control-label col-sm-3" style="font-weight:bold">Nombre del proyecto:</label>
            <div class="col-sm-9" style="text-align:justify">
                <p>
                    <?php echo (!empty($proyecto[0]['nombre_proyecto'])) ? $proyecto[0]['nombre_proyecto'] : 'No ha divulgado esta información'; ?>
                </p>
            </div>
        </div>
        <div class="col-md-12 col-xs-12 col-sm-12">
            <label for="name" class="control-label col-sm-3" style="font-weight:bold">Ubicación:</label>
            <div class="col-sm-9" style="text-align:justify">
                <p>
                    <?php echo (!empty($proyecto[0]['departamento'])) ? $proyecto[0]['departamento'] : 'No ha divulgado esta información'; ?>
                </p>
            </div>
        </div>
        <div class="col-md-12 col-xs-12 col-sm-12">
            <label for="name" class="control-label col-sm-3" style="font-weight:bold">Sector:</label>
            <div class="col-sm-9" style="text-align:justify">
                <p>
                    <?php echo (!empty($proyecto[0]['proyecto_sector'])) ? $proyecto[0]['proyecto_sector'] : 'No ha divulgado esta información'; ?>
                </p>
            </div>
        </div>
        <div class="col-md-12 col-xs-12 col-sm-12">
            <label for="name" class="control-label col-sm-3" style="font-weight:bold">Sub sector:</label>
            <div class="col-sm-9" style="text-align:justify">
                <p>
                    <?php echo (!empty($proyecto[0]['proyecto_subsector'])) ? $proyecto[0]['proyecto_subsector'] : 'No ha divulgado esta información'; ?>
                </p>
            </div>
        </div>
        <div class="col-md-12 col-xs-12 col-sm-12">
            <label for="name" class="control-label col-sm-3" style="font-weight:bold">Adicionalidad del proyecto:</label>
            <div class="col-sm-9" style="text-align:justify">
                <p>
                    <?php echo (!empty($proyecto[0]['idProposito'])) ? $proyecto[0]['idProposito'] : 'No ha divulgado esta información'; ?>
                </p>
            </div>
        </div>
        <div class="col-md-12 col-xs-12 col-sm-12">
            <label for="name" class="control-label col-sm-3" style="font-weight:bold">Descripción de activos y/o servicios:</label>
            <div class="col-sm-9" style="text-align:justify">
                <p>
                    <?php echo (!empty($proyecto[0]['descrip'])) ? $proyecto[0]['descrip'] : 'No ha divulgado esta información'; ?>
                </p>
            </div>
        </div>
        <div class="col-md-12 col-xs-12 col-sm-12">
            <label for="name" class="control-label col-sm-3" style="font-weight:bold">Valor estimado del proyecto :</label>
            <div class="col-sm-9" style="text-align:justify">
                <p>
                    LPS.
                    <?php echo (!empty($proyecto[0]['presupuesto'])) ? number_format($proyecto[0]['presupuesto'], 2) : 'No ha divulgado esta información'; ?>
                </p>
            </div>
        </div>
        <div class="col-md-12 col-xs-12 col-sm-12">
            <label for="name" class="control-label col-sm-3" style="font-weight:bold">Fecha de aprobación:</label>
            <div class="col-sm-9" style="text-align:justify">
                <p>
                    <?php echo (!empty($proyecto[0]['fechaaprob'])) ?  date("d/m/y", strtotime($proyecto[0]['fechaaprob'])) : 'No ha divulgado esta información'; ?>
                </p>
            </div>
        </div>
    </div>
</form>

<?php
    $generidData = PlanningDocuments::model()->findAll(array(
        'condition' => 'idProyecto=:id',
        'params' => array(
            ':id' => $proyecto[0]['idProyecto']
        )
    ));
    if (count($generidData) != 0) {
?>
<div class="code-boxInverse">
    <h5 >  Documentos de la información básica </h5>
        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
        <table class="display hover row-border" id="PlanningDocumentsTable" cellspacing="0" style="width:100%;">
            <thead>
                <tr style="background:#29a4dd;color:#fff">
                    <th>Título</th>
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
                                <a href="<?php echo $generidData[$row] ['url']; ?>" target="_blank">Descargar / Ver</a>
                            </span>
                        </td>
                    </tr>

                <?php
                        $row++;
                    }
                ?>
            </tbody>
        </table>
</div>
<?php
    }
?>

<?php
    $datos_BudgetBreakdown = $breakModel->findAll(array(
        'condition' => 'idProyecto=:id',
        'params' => array(
            ':id' => $proyecto[0]['idProyecto']
        )
    ));
    $datos_For= $foreCast ->findAll(array(
        'condition' => 'idProyecto=:id',
        'params' => array(
            ':id' => $proyecto[0]['idProyecto']
        )
    ));
?>


<div class="code-boxInverse">
    <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
        <?php
            if (count($proyecto_beneficiario) != 0){
        ?>
            <li class="nav-item">
                <a class="nav-link active   " id="deptos" data-toggle="tab" href="#tab3" role="tab" aria-controls="deptos" aria-selected="true">Beneficiarios</a>
            </li>
        <?php
            }
        ?>
        <?php
            if(count($proyecto_fuente) != 0){
        ?>
        <li class="nav-item">
            <a class="nav-link" id="finan" data-toggle="tab" href="#tab2" role="tab" aria-controls="finan" aria-selected="false">Fuentes de financiamiento </a>
        </li>
        <?php
            }
        ?>
        <?php
            if (count($datos_BudgetBreakdown) != 0){
        ?>
            <li class="nav-item">
                <a class="nav-link" id="des" data-toggle="tab" href="#tab1" role="tab" aria-controls="des" aria-selected="false">Desglose del presupuesto</a>
            </li>
        <?php
            }
        ?>
        <?php
            if (count($datos_For) != 0){
        ?>
        <li class="nav-item">
            <a class="nav-link" id="fuen" data-toggle="tab" href="#tab5" role="tab" aria-controls="fuen" aria-selected="false">Demanda estimada anual</a>
        </li>
        <?php
            }
        ?>
    </ul>

    <div class="tab-content" id="myTabContent">
        <?php
            if (count($datos_BudgetBreakdown) != 0){
        ?>
            <div class="tab-pane fade in" id="tab1" role="tabpanel" aria-labelledby="des">
                <div class="code-boxInverse">
                    <h5 >  Desglose del presupuesto </h5>

                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                        <table class="display hover row-border" id="tabla_budget" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr style="background:#29a4dd;color:#fff">
                                    <th>Monto</th>
                                    <th>Moneda</th>
                                    <th>Descripción</th>
                                    <th>Fuente</th>
                                    <th>Fecha inicial</th>
                                    <th>Fecha final</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                                                        $total_x=count($datos_BudgetBreakdown);
                            $row=0;
                            while ($row< $total_x) {
                            ?>
                                    <tr>
                                        <td>
                                            <span>
                                                <?php echo number_format($datos_BudgetBreakdown[$row]['amount'], 2, '.', ','); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $datos_BudgetBreakdown[$row] ['currency']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $datos_BudgetBreakdown[$row] ['description']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $datos_BudgetBreakdown[$row] ['sourceParty_name']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $datos_BudgetBreakdown[$row] ['startDate']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $datos_BudgetBreakdown[$row] ['endDate']; ?>
                                            </span>
                                        </td>


                                    </tr>

                                    <?php
                                                                            $row++;
                                            } ?>
                            </tbody>
                        </table>
                </div>
            </div>
        <?php
            }
        ?>
        <?php
            if(count($proyecto_fuente) != 0){
        ?>
            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="finan">
                <div class="code-boxInverse">
                    <h5 > Fuentes de financiamiento</h5>
                    <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                    <table class="display hover row-border" id="tabla_financiamiento" cellspacing="0" style="width:100%;">
                        <thead>
                            <tr style="background:#29a4dd;color:#fff">
                                <th>Fuente de financiamiento</th>
                                <th>Monto</th>
                                <th>Moneda</th>
                                <th>Tasa</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                                $row      = 0;
                                $total_x  = count($proyecto_fuente);
                                $td_style = false;
                                while ($row < $total_x) {
                                    ?>
                                <tr>
                                    <?php  if ($td_style == false) {
                                    ?>
                                    <td>
                                        <?php echo $proyecto_fuente[$row]['fuente']; ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($proyecto_fuente[$row]['monto'], 2, '.', ','); ?>
                                    </td>
                                    <td>
                                        <?php echo $proyecto_fuente[$row]['moneda']; ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($proyecto_fuente[$row]['tasa_cambio'], 2, '.', ','); ?>
                                    </td>
                                    <?php    $td_style = true;
                                } else {
                                    ?>
                                    <td>
                                        <?php echo $proyecto_fuente[$row]['fuente']; ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($proyecto_fuente[$row]['monto'], 2, '.', ','); ?>
                                    </td>
                                    <td>
                                        <?php echo $proyecto_fuente[$row]['moneda']; ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($proyecto_fuente[$row]['tasa_cambio'], 2, '.', ','); ?>
                                    </td>
                                    <?php
                                                    $td_style = false;
                                            } ?>
                                </tr>
                                <?php
                                                $row++;
                                    } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php
            }
        ?>

        <?php
            if (count($proyecto_beneficiario) != 0){
        ?>
        <div class="tab-pane fade in active" id="tab3" role="tabpanel" aria-labelledby="deptos">
            <div class="code-boxInverse">
                <h5 > Beneficiarios</h5>
                <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">

                <table class="display hover row-border" id="tabla_departamentos" cellspacing="0" style="width:100%;">
                    <thead>
                        <tr style="background:#29a4dd;color:#fff">
                            <th>Departamento</th>
                            <th>Municipio</th>
                            <th>Beneficio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                                    $row     = 0;
                        $total_x = count($proyecto_beneficiario);
                        $td_style = false;
                        while ($row < $total_x) {
                            ?>
                            <tr>
                                <?php if ($td_style == false) {
                        ?>

                                <td>
                                    <?php echo $proyecto_beneficiario[$row]['departamento']; ?>
                                </td>

                                <td>
                                    <?php echo $proyecto_beneficiario[$row]['municipio']; ?>
                                </td>
                                <td>
                                    <?php echo $proyecto_beneficiario[$row]['Beneficio']; ?>
                                </td>
                                <?php   $td_style = true;
                            } else {
                                ?>

                                <td>
                                    <?php echo $proyecto_beneficiario[$row]['departamento']; ?>
                                </td>

                                <td>
                                    <?php echo $proyecto_beneficiario[$row]['municipio']; ?>
                                </td>
                                <td>
                                    <?php echo $proyecto_beneficiario[$row]['Beneficio']; ?>
                                </td>
                                <?php $td_style = false;
                             } ?>
                            </tr>
                            <?php $row++;
                         } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
            }
        ?>

        <?php
            if (count($datos_For) != 0){
        ?>
        <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="fuen">
                <div class="code-boxInverse">
                    <h5 > Demanda estimada anual</h5>
                    <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                    <table class="display hover row-border" id="tabla_forecast" cellspacing="0" style="width:100%;">
                        <thead>
                            <tr style="background:#29a4dd;color:#fff">
                                <th>Título</th>
                                <th>Unidad</th>
                                <th>Medida</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                                                $total_x=count($datos_For);
                            $row=0;
                            while ($row< $total_x) {
                                ?>
                                <tr>
                                    <td>
                                        <span>
                                            <?php echo $datos_For[$row] ['title']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <?php echo $datos_For[$row] ['unidad']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <?php echo number_format($datos_For[$row]['medida'],2,".",","); ?>
                                        </span>
                                    </td>

                                </tr>

                                <?php
                                                                    $row++;
                         } ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div id="filas_forecastObs"></div>
                    </div>
                </div>
        </div>
        <?php
            }
        ?>
    </div>
</div>
<div class="code-boxInverse">
        <h5 > Detalles de contacto de la autoridad contratante</h5>
        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
        <label for="name" class="control-label col-sm-2" style="font-weight:bold">Nombre:</label>
        <div class="col-sm-4" style="text-align:justify">
            <p>
                <?php echo (!empty($proyecto[0]['funcionario_nombre'])) ? $proyecto[0]['funcionario_nombre'] : 'No ha divulgado esta información'; ?>
            </p>
        </div>

        <label for="name" class="control-label col-sm-2" style="font-weight:bold">Puesto:</label>
        <div class="col-sm-4"  style="text-align:justify">
            <p>
                <?php echo (!empty($proyecto[0]['funcionario_puesto'])) ? $proyecto[0]['funcionario_puesto'] : 'No ha divulgado esta información'; ?>
            </p>
        </div>
        <label for="name" class="control-label col-sm-2" style="font-weight:bold">Correo:</label>
        <div class="col-sm-4"  style="text-align:justify">
            <p>
                <?php echo (!empty($proyecto[0]['funcionario_correo'])) ? $proyecto[0]['funcionario_correo'] : 'No ha divulgado esta información'; ?>
            </p>
        </div>
        <label for="name" class="control-label col-sm-2" style="font-weight:bold">Teléfono:</label>
        <div class="col-sm-4"  style="text-align:justify">
            <p>
                <?php echo (!empty($proyecto[0]['funcionario_telefono'])) ? $proyecto[0]['funcionario_telefono'] : 'No ha divulgado esta información'; ?>
            </p>
        </div>
        <label for="name" class="control-label col-sm-2" style="font-weight:bold">Autoridad contratante:</label>
        <div class="col-sm-4"  style="text-align:justify">
            <p>
                <?php
                                            echo (!empty($proyecto[0]['funcionario_ente'])) ? $proyecto[0]['funcionario_ente'] : 'No ha divulgado esta información'; ?>
            </p>
        </div>
    </div>
<?php
} ?>
</div>
