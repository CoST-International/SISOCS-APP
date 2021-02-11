<?php
    /*
    var_dump($proyecto);
    echo '<hr>';
    var_dump($adquisicion);
    exit();*/
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/prefichatecnica.css');

    //quries

    $rows = Yii::app()->db->createCommand(
        "  SELECT DISTINCT
        `ncontrato`,
        `precioLPS`
    FROM
        `cs_contratacion` inner join `vCiudadano` on
            `cs_contratacion`.`idContratacion` = `vCiudadano`.`idContratacion`
    WHERE `idProyecto` = ".$proyecto[0]['idProyecto']
    )->queryAll();
    $data = array();
    $total = 0;

    foreach ($rows as $row) {
        $total += $row['precioLPS'];
    };

    if ($total == 0) {
        $total = 1;
    }

    foreach ($rows as $row) {
        //array_push($data, array($row['ncontrato']. '; Lps.'.number_format($row['precioLPS'],2,'.',','), round(($row['precioLPS']/$total)*100,2)));
        array_push($data, array('Lps.'.number_format($row['precioLPS'], 2, '.', ','), round(($row['precioLPS']/$total)*100, 2)));
    }

    $ultimaModificacionGarantias = Yii::app()->db->createCommand("SELECT max(garantias.fecha_publicacion) fecha FROM cs_garantias garantias
    JOIN cs_inicio_ejecucion inicioEjecucion
    ON
    inicioEjecucion.idInicioEjecucion = garantias.idInicioEjecucion
    JOIN cs_contratacion contratacion
    ON
    contratacion.idContratacion = inicioEjecucion.idContratacion
    JOIN cs_adjudicacion adju
    ON
    adju.idAdjudicacion = contratacion.idAdjudicacion
    JOIN cs_calificacion cali
    ON
    cali.idCalificacion = adju.idCalificacion
    WHERE cali.idProyecto=".$proyecto[0]['idProyecto'])->queryAll();

    $ultimaModificacionContratos = Yii::app()->db->createCommand("SELECT MAX(contratos.fecha_publicacion) fecha FROM cs_contratos contratos
    JOIN cs_contratacion contratacion
    ON
    contratacion.idContratacion= contratos.idContratacion
    JOIN cs_adjudicacion adju
    ON
    adju.idAdjudicacion = contratacion.idAdjudicacion
    JOIN cs_calificacion cali
    ON
    cali.idCalificacion= adju.idCalificacion
    WHERE idContratos =".$proyecto[0]['idProyecto'])->queryAll();

    $ultimaModificacionAvances = Yii::app()->db->createCommand("SELECT MAX(avances.fecha_publicacion) fecha FROM cs_avances avances
    JOIN cs_inicio_ejecucion inicioEjecucion
    ON
    inicioEjecucion.idInicioEjecucion= avances.idInicioEjecucion
    JOIN cs_contratacion contratacion
    ON
    contratacion.idContratacion = inicioEjecucion.idContratacion
    JOIN cs_adjudicacion adju
    ON
    adju.idAdjudicacion=contratacion.idAdjudicacion
    JOIN cs_calificacion cali
    ON
    cali.idCalificacion= adju.idCalificacion
    WHERE cali.idProyecto =".$proyecto[0]['idProyecto'])->queryAll();
    $ultimaModificacion= [$ultimaModificacionGarantias[0]['fecha'],$ultimaModificacionContratos[0]['fecha'],$ultimaModificacionAvances[0]['fecha']];

    $transparencia = 0;
    $montos = 0;
    $plazo = 0;
    $supervision = 0;
    $contratos = 0;
    $ejecucion = 0;
    $cumplimiento = 0;
    $divulgacion = 0;
    $totali = 0;

    $supervicion_actual = 0;
    $supervision_original = 0;
    $dsmonto = 0;
    $dsplazo = 0;

    $ejecucion_actual = 0;
    $ejecucion_original = 0;
    $demonto = 0;
    $deplazo = 0;

    $command = Yii::app()->db->createCommand("SELECT fn_indicador1(".$proyecto[0]['idProyecto'].");");
    $transparencia = $command->queryScalar();

    $command = Yii::app()->db->createCommand("SELECT fn_indicador2(".$proyecto[0]['idProyecto'].");");
    $montos = $command->queryScalar();

    $command = Yii::app()->db->createCommand("SELECT fn_indicador3(".$proyecto[0]['idProyecto'].");");
    $plazo = $command->queryScalar();

    $command = Yii::app()->db->createCommand("SELECT fn_indicador4(".$proyecto[0]['idProyecto'].");");
    $supervision = $command->queryScalar();

    $command = Yii::app()->db->createCommand("SELECT fn_indicador5(".$proyecto[0]['idProyecto'].");");
    $contratos = $command->queryScalar();

    $command = Yii::app()->db->createCommand("CALL sp_indicador6(".$proyecto[0]['idProyecto'].");");
    $ejecucion = $command->queryScalar();

    $command = Yii::app()->db->createCommand("SELECT fn_indicador7(".$proyecto[0]['idProyecto'].");");
    $cumplimiento = $command->queryScalar();

    $command = Yii::app()->db->createCommand("SELECT fn_indicador8(".$proyecto[0]['idProyecto'].");");
    $divulgacion = $command->queryScalar();


    $totali = $transparencia + $montos + $plazo + $supervision + $contratos + $ejecucion + $cumplimiento + $divulgacion;

    ?>

    <div class="preFicha"></div>
    <div class="row">
        <h1 class="section-title wow fadeIn animated" data-wow-delay=".2s">
            Detalle de Proyecto
        </h1>
        <p class="section-subcontent"></p>
        <hr class="lineOne">
        <div class="container">
            <div class="row row-offcanvas row-offcanvas-right">

                <div class="col-12 col-md-9">
                    <p class="float-right hidden-md-up" style="text-align: right;">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="offcanvas">Contratos</button>
                    </p>
                    <div class="jumbotron">
                        <h5 style="font-size:1.2em">
                            <?php echo $proyecto[0]['proyecto_nombre'];?>
                        </h5>

                    </div>
                    <div class="row col-12 col-md-12" id="borderBox">
                        <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Información General</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contratos-tab" data-toggle="tab" href="#contratos" role="tab" aria-controls="contratos" aria-selected="false">Contrato</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="grafico-tab" data-toggle="tab" href="#grafico" role="tab" aria-controls="grafico" aria-selected="false">Gráfico</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade in active" id="info" role="tabpanel" aria-labelledby="info-tab">
                                <form class="form-horizontal" role="form" style="padding-top:10px">
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                            <label for="name" class="control-label col-xs-12 col-sm-3" style="font-weight:bold">Código</label>
                                            <div class="col-xs-12 col-sm-9" style="text-align:justify">
                                                <p>
                                                    <?php echo $proyecto[0]['proyecto_codigo'];?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                            <label for="name" class="control-label col-xs-12 col-sm-3" style="font-weight:bold">Descripción</label>
                                            <div class="col-xs-12 col-sm-9" style="text-align:justify">
                                                <p>
                                                    <?php echo $proyecto[0]['proyecto_descripcion'];?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                            <label for="name" class="control-label col-xs-12 col-sm-3" style="font-weight:bold">Sector</label>
                                            <div class="col-xs-12 col-sm-9" style="text-align:justify">
                                                <p>
                                                    <?php echo $proyecto[0]['proyecto_sector'];?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                            <label for="name" class="control-label col-xs-12 col-sm-3" style="font-weight:bold">Sub Sector</label>
                                            <div class="col-xs-12 col-sm-9" style="text-align:justify">
                                                <p>
                                                    <?php echo $proyecto[0]['proyecto_subsector'];?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                            <label for="name" class="control-label col-xs-12 col-sm-3" style="font-weight:bold">Ente Responsable</label>
                                            <div class="col-xs-12 col-sm-9" style="text-align:justify">
                                                <p>
                                                    <?php echo $proyecto[0]['proyecto_ente'];?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                            <label for="name" class="control-label col-xs-12 col-sm-3" style="font-weight:bold">Propósito</label>
                                            <div class="col-xs-12 col-sm-9" style="text-align:justify">
                                                <p>
                                                    <?php
                                                        if ($proyecto) {
                                                            $Proposito = Yii::app()->db->createCommand('SELECT Proposito FROM cs_proyecto WHERE idProyecto='.$proyecto[0]['idProyecto'])->queryScalar();
                                                            echo $Proposito;
                                                        } else {
                                                            echo $proyecto[0]['proyecto_proposito'];
                                                        }?>

                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                            <label for="name" class="control-label col-xs-12 col-sm-3" style="font-weight:bold">Fecha de aprobación</label>
                                            <div class="col-xs-12 col-sm-9" style="text-align:justify">
                                                <p>
                                                    <?php echo $proyecto[0]['proyecto_fecha_aprobacion'];?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                            <label for="name" class="control-label col-xs-12 col-sm-3" style="font-weight:bold">Presupuesto</label>
                                            <div class="col-xs-12 col-sm-9" style="text-align:justify">
                                                <p>
                                                    <?php echo number_format($proyecto[0]['proyecto_presupuesto'], 2, '.', ',');?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                            <label for="name" class="control-label col-xs-12 col-sm-3" style="font-weight:bold">Última modificación en el sistema</label>
                                            <div class="col-xs-12 col-sm-9" style="text-align:justify">
                                                <p>
                                                    <?php echo max($ultimaModificacion);?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:10px;margin-bottom:10px">
                                        <strong>Monto de cada contrato</strong>
                                        <br>
                                        <table class="table table-bordered table-hover" align="center" border="1" cellpadding="1" cellspacing="1" style="width:80%; margin-top:20px">
                                            <thead>
                                                <tr>
                                                    <th style="width: 164px; text-align: center; background-color: rgb(51, 51, 51);">
                                                        <span style="color:#ffffff;">Num. Contrato</span>
                                                    </th>
                                                    <th style="width: 167px; text-align: center; background-color: rgb(51, 51, 51);">
                                                        <span style="color:#ffffff;">Monto en Lps.</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($rows as $row) {
                                                            ?>
                                                <tr>
                                                    <td style="width: 164px; text-align: center;">
                                                        <?php echo $row['ncontrato']; ?>
                                                    </td>
                                                    <td style="width: 164px; text-align: center;">
                                                        <?php echo number_format($row['precioLPS'], 2, '.', ','); ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                        } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:10px;margin-bottom:10px">
                                        <strong>Indicadores de Proceso</strong>
                                        <br>
                                        <table class="table table-bordered table-hover" align="center" border="1" cellpadding="1" cellspacing="1" style="width:80%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 164px; text-align: center; background-color: rgb(51, 51, 51);">
                                                        <span style="color:#ffffff;">Indicador</span>
                                                    </th>
                                                    <th style="width: 167px; text-align: center; background-color: rgb(51, 51, 51);">
                                                        <span style="color:#ffffff;">Valor</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th style="width: 164px; text-align: center; background-color: rgb(51, 51, 51);">
                                                        <span style="color:#ffffff;">TOTAL</span>
                                                    </th>
                                                    <th style="width: 167px; text-align: center; background-color: rgb(51, 51, 51);">
                                                        <span style="color:#ffffff;">
                                                            <?php echo number_format($totali, 2, '.', ','); ?>
                                                        </span>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td style="width: 164px; text-align: center;">Gestión de la Adquisición</td>
                                                    <td style="width: 164px; text-align: center;">
                                                        <?php echo number_format($transparencia, 2, '.', ','); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 164px; text-align: center;">Gestión de montos</td>
                                                    <td style="width: 164px; text-align: center;">
                                                        <?php echo number_format($montos, 2, '.', ','); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 164px; text-align: center;">Gestión de plazos</td>
                                                    <td style="width: 164px; text-align: center;">
                                                        <?php echo number_format($plazo, 2, '.', ','); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 164px; text-align: center;">Razonabilidad de la supervisión</td>
                                                    <td style="width: 164px; text-align: center;">
                                                        <?php echo number_format($supervision, 2, '.', ','); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 164px; text-align: center;">Gestión de los contratos</td>
                                                    <td style="width: 164px; text-align: center;">
                                                        <?php echo number_format($contratos, 2, '.', ','); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 164px; text-align: center;">Efectividad de la ejecución</td>
                                                    <td style="width: 164px; text-align: center;">
                                                        <?php echo number_format($ejecucion, 2, '.', ','); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 164px; text-align: center;">Nota de prioridad</td>
                                                    <td style="width: 164px; text-align: center;">
                                                        <?php echo number_format($cumplimiento, 2, '.', ','); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 164px; text-align: center;">Divulgación</td>
                                                    <td style="width: 164px; text-align: center;">
                                                        <?php echo number_format($divulgacion, 2, '.', ','); ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="contratos" role="tabpanel" aria-labelledby="contratos-tab">
                                <section>
                                    <div class="contratos-area">
                                        <!-- BEGIN TABLE CONTAINER -->
                                        <div class="row" style="margin:0 auto">
                                            <!-- BEGIN HOVER AREA -->
                                            <?php
                                                for ($i=0;$i<count($adquisicion);$i++) {
                                                    if ($adquisicion[$i]['calificacion_numero']  == ''){
                                                        continue;
                                                    }
                                                    if ($idContratacion=$adquisicion[$i]['idContratacion']!=null) {
                                                        $idContratacion=$adquisicion[$i]['idContratacion'];
                                                        $command = Yii::app()->db->createCommand("SELECT `fn_avance_programado`($idContratacion) AS `fn_avance_programado`");
                                                        $command2= Yii::app()->db->createCommand("SELECT `fn_avance_real`($idContratacion) AS `fn_avance_real`");
                                                        $avanceProgramado = $command->queryScalar();
                                                        $avanceReal = $command2->queryScalar();
                                                    } else {
                                                        $avanceProgramado=0;
                                                        $avanceReal=0;
                                                    } ?>
                                                <div class="mainContractContainer">
                                                    <div class="col-md-12 col-xs-12 col-sm-12 contratosTitle">
                                                        <strong>Contrato #
                                                            <?php echo $adquisicion[$i]['calificacion_numero']; ?>
                                                        </strong>
                                                    </div>
                                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                                        <label for="name" class="control-label col-xs-12 col-sm-3" style="font-weight:bold">Nombre:</label>
                                                        <div class="col-xs-12 col-sm-9" style="text-align:justify">
                                                            <p>
                                                                <?php echo $adquisicion[$i]['calificacion_nombre']; ?>

                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:10px;margin-bottom:10px">
                                                        <label for="name" class="control-label col-xs-12 col-sm-3" style="font-weight:bold">Tiempos:</label>
                                                        <div class="col-xs-12 col-sm-9" style="text-align:justify">
                                                            <table class="table table-bordered table-hover" align="center" border="1" cellpadding="1" cellspacing="1" style="width:80%;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="width: 164px; text-align: center; background-color: rgb(51, 51, 51);">
                                                                            <span style="color:#ffffff;">Fecha de Inicio</span>
                                                                        </td>
                                                                        <td style="width: 167px; text-align: center; background-color: rgb(51, 51, 51);">
                                                                            <span style="color:#ffffff;">Fecha Final</span>
                                                                        </td>
                                                                        <td style="width: 134px; text-align: center; background-color: rgb(51, 51, 51);">
                                                                            <span style="color:#ffffff;">Duraci&oacute;n</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 164px; text-align: center;">
                                                                            <?php echo $adquisicion[$i]['contratacion_fecha_inicio']; ?>
                                                                        </td>
                                                                        <td style="width: 164px; text-align: center;">
                                                                            <?php echo $adquisicion[$i]['contratacion_fecha_final']; ?>
                                                                        </td>
                                                                        <td style="width: 164px; text-align: center;">
                                                                            <?php echo $adquisicion[$i]['contratacion_duracion'].' días'; ?>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:10px;">
                                                        <label for="name" class="control-label col-xs-12 col-sm-3" style="font-weight:bold">Alcances:</label>
                                                        <div class="col-xs-12 col-sm-9" style="text-align:justify">
                                                            <p>
                                                                <?php echo $adquisicion[$i]['contratacion_alcances']; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                                        <label for="name" class="control-label col-xs-12 col-sm-3" style="font-weight:bold">Metodo:</label>
                                                        <div class="col-xs-12 col-sm-9" style="text-align:justify">
                                                            <p>
                                                                <?php echo $adquisicion[$i]['calificacion_metodo']; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                                        <label for="name" class="control-label col-xs-12 col-sm-3" style="font-weight:bold">Oferente:</label>
                                                        <div class="col-xs-12 col-sm-9" style="text-align:justify">
                                                            <p>
                                                                <?php echo $adquisicion[$i]['contratacion_oferente']; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                                        <label for="name" class="control-label col-xs-12 col-sm-3" style="font-weight:bold">Monto en LPS:</label>
                                                        <div class="col-xs-12 col-sm-9" style="text-align:justify">
                                                            <p>
                                                                <?php echo number_format($adquisicion[$i]['contratacion_precioLPS'], 2, '.', ','); ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                                        <label for="name" class="control-label col-xs-12 col-sm-3" style="font-weight:bold">Monto en USD:</label>
                                                        <div class="col-xs-12 col-sm-9" style="text-align:justify">
                                                            <p>
                                                                <?php echo number_format($adquisicion[$i]['contratacion_precioUSD'], 2, '.', ','); ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                                        <label for="name" class="control-label col-xs-12 col-sm-3" style="font-weight:bold"> Avance Programado:</label>
                                                        <div class="col-xs-12 col-sm-6" style="text-align:justify">
                                                            <div class="progress" style="height: 25px">
                                                                <div class="progress-bar bg-info progress-bar-striped" role="progressbar" style=<?php echo "width:".$avanceProgramado.
                                                                    "%;". "height: 20px;"; ?> aria-valuenow=
                                                                    <?php echo $avanceProgramado; ?> aria-valuemin="0" aria-valuemax="100">
                                                                    <?php echo $avanceProgramado."%"; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                                        <label for="name" class="control-label col-xs-12 col-sm-3" style="font-weight:bold"> Avance Real:</label>
                                                        <div class="col-xs-12 col-sm-6" style="text-align:justify">
                                                            <div class="progress" style="height: 25px">
                                                                <div class="progress-bar bg-success progress-bar-striped" role="progressbar" style=<?php echo "width:".$avanceReal. "%;".
                                                                    "height: 20px;"?>aria-valuenow=
                                                                    <?php echo $avanceReal; ?> aria-valuemin="0" aria-valuemax="100">
                                                                    <?php echo $avanceReal."%"; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                                        <label for="name" class="control-label col-xs-12 col-sm-3" style="font-weight:bold">Ver Detalles:</label>
                                                        <div class="col-xs-12 col-sm-9" style="text-align:justify">
                                                            <p>
                                                                <?php
                                                                    $control="";
                                                                    $idFicha="";
                                                                    if ($adquisicion[$i]['idProyecto']!=null) {
                                                                        $control="Proyecto";
                                                                        $idFicha=$adquisicion[$i]['idProyecto'];
                                                                        if ($adquisicion[$i]['idCalificacion']!=null) {
                                                                            $control="Calificacion";
                                                                            $idFicha=$adquisicion[$i]['idCalificacion'];
                                                                            if ($adquisicion[$i]['idAdjudicacion']!=null) {
                                                                                $control="Adjudicacion";
                                                                                $idFicha=$adquisicion[$i]['idAdjudicacion'];
                                                                                if ($adquisicion[$i]['idContratacion']!=null) {
                                                                                    $control="Contratacion";
                                                                                    $idFicha=$adquisicion[$i]['idContratacion'];
                                                                                }
                                                                            }
                                                                         }
                                                                    } ?>
                                                                    <?php echo CHtml::link('Ver Ficha Tecnica', array('FichaTecnica', 'control'=>$control, 'id'=>$idFicha), array('class'=>'hvr-grow tableButton')); ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                ?>

                                                </div>
                                                <!-- END HOVER AREA -->
                                        </div>
                                        <!-- END TABLE CONTAINER -->
                                </section>
                                </div>

                                <div class="tab-pane fade" id="grafico" role="tabpanel" aria-labelledby="grafico-tab" style="text-align:center">
                                    <div class="col-md-12 col-xs-12 col-sm-12" id="chartBox">
                                        <?php
                                            $this->Widget(
                                                        'ext.highcharts.HighchartsWidget',
                                            array(  'options' => array(
                                                                //'colors'=> array('#0563FE', '#FF2F2F', '#6AC36A', '#FFD148',),
                                                                'exporting' => array('enabled' => false),

                                                                'legend' => array(
                                                                    'enabled' => false,
                                                                ),
                                                                'credits' => array(
                                                                    'enabled' => false
                                                                ) ,
                                                                'title' => array(
                                                                    'text' => 'Distribucion de montos'
                                                                ),
                                                                'chart' => array(
                                                                    'plotBackgroundColor' => null,
                                                                    'backgroundColor' => 'transparent',
                                                                    'plotBorderWidth' => null,
                                                                    'plotShadow' => false,

                                                                ) ,
                                                                'tooltip' => array(
                                                                    'pointFormat' => '{series.name}: <b>{point.percentage}%</b>',
                                                                    'percentageDecimals' => 1,
                                                                ),
                                                                'plotOptions' => array(
                                                                                    'pie' => array(
                                                                                        'allowPointSelect' => true,
                                                                                        'cursor' => 'pointer',
                                                                                        'dataLabels' => array(
                                                                                                'enabled' => true,
                                                                                                'color' => '#000000',
                                                                                                'connectorColor' => '#000000',
                                                                                                'formatter' => "js:function(){return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';}",
                                                                                        ),
                                                                                    )
                                                                 ),
                                                                'series' => array(
                                                                                array(
                                                                                    'type' => 'pie',
                                                                                    'name' => '% de inversion',
                                                                                    'data' => $data
                                                                                )
                                                                ),
                                                       )
                                               )
                                );
                                            ?>
                                    </div>
                                </div>

                            </div>
                            <!--div class="col-6 col-lg-4">

                                <p>
                                    <?php echo $proyecto[0]['proyecto_nombre'];?>
                                </p>
                                <p>
                                    <a class="btn btn-secondary" href="#" role="button">View details »</a>
                                </p>
                            </div-->
                            <!--/span-->

                        </div>
                        <!--/row-->
                    </div>
                    <!--/span-->

                    <div class="col-6 col-md-3 sidebar-offcanvas" id="sidebar">
                        <h4 style="text-align: center;color: #141414;">Contratos del Proyecto</h4>
                        <div class="list-group">
                            <?php for ($i=0;$i<count($adquisicion);$i++) {
                                                ?>
                            <?php
                            if ($adquisicion[$i]['calificacion_numero']  == ''){
                                continue;
                            }
                                $control="";
                                                $idFicha="";
                                                if ($adquisicion[$i]['idProyecto']!=null) {
                                                    $control="Proyecto";
                                                    $idFicha=$adquisicion[$i]['idProyecto'];
                                                    if ($adquisicion[$i]['idCalificacion']!=null) {
                                                        $control="Calificacion";
                                                        $idFicha=$adquisicion[$i]['idCalificacion'];
                                                        if ($adquisicion[$i]['idAdjudicacion']!=null) {
                                                            $control="Adjudicacion";
                                                            $idFicha=$adquisicion[$i]['idAdjudicacion'];
                                                            if ($adquisicion[$i]['idContratacion']!=null) {
                                                                $control="Contratacion";
                                                                $idFicha=$adquisicion[$i]['idContratacion'];
                                                            }
                                                        }
                                                    }
                                                } ?>
                                <?php echo CHtml::link($adquisicion[$i]['calificacion_numero'], array('FichaTecnica', 'control'=>$control, 'id'=>$idFicha), array('class'=>'list-group-item')); ?>


                                <?php
                                            } ?>
                        </div>
                    </div>
                    <?php 
                        if (count($relatedProcess) > 0 ) {
                    ?>
                    <div class="col-6 col-md-3 sidebar-offcanvas" id="sidebar" style="margin-top: 2vh;">
                        <h4 style="text-align: center;color: #141414;">Proyectos Relacionados</h4>
                        <div class="list-group">
                            <?php 
                                for ($i=0;$i<count($relatedProcess);$i++) {
                                    $control="";
                                    $idFicha="";
                                    if ($relatedProcess[$i]['idProyecto']!=null) {
                                        $control="Proyecto";
                                        $idFicha=$relatedProcess[$i]['idProyecto'];
                                    } 
                                    echo CHtml::link($relatedProcess[$i]['proyecto_nombre'], array('PreFichaTecnica', 'control'=>$control, 'id'=>$idFicha), array('class'=>'list-group-item'));
                                } 
                            ?>
                        </div>
                    </div>
                    <?php
                        } 
                    ?>
                    <!--/span-->
                </div>

            </div>


        </div>
        <?php
?>

    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('[data-toggle="offcanvas"]').click(function () {
                $('.row-offcanvas').toggleClass('active');

            });



            $('.list-group-item').on("click", function () {
                console.log('Calling');
                $('#myTabContent li:eq(1) a').tab('show');
            });


        });

    </script>