<style media="screen">
    /*var date = "03-11-2014";
var newdate = date.split("-").reverse().join("-"); #Convertir fecha*/

    .code-box {
        border: 1px solid #e9e9e9;
        border-radius: 4px;
        display: inline-block;
        width: 100%;
        position: relative;
        margin: 0 auto;
        -webkit-transition: all .2s;
        transition: all .2s;
        padding: 30px 10px 10px 10px;
        overflow: hidden;
    }

    td {
        padding-bottom: 1em;
        margin-right: 50em;

    }

    .general td {
        text-align: left;
        font-size: 12px;
    }

    .tabla_interna td {
        text-align: left;
        font-size: 12px;


    }

    .tabla_interna .fila_azul {
        font-size: 12px;

    }

    .tabla_interna .fila_blanco {
        font-size: 12px;
    }

    #sidebar .list-group-item {
        border-radius: 0;
        background-color: rgb(40, 40, 40);
        color: #ccc;
        border-left: 0;
        border-right: 0;
        border-color: #2c2c2c;
        white-space: nowrap;
        padding-top: 25px;
        padding-bottom: 15px;
    }

    /* highlight active menu */

    #sidebar .list-group-item:not(.collapsed) {
        background-color: #222;
    }

    /* closed state */

    #sidebar .list-group .list-group-item[aria-expanded="false"]::after {
        content: " \f0d7";
        font-family: FontAwesome;
        display: inline;
        text-align: right;
        padding-left: 5px;
    }

    /* open state */

    #sidebar .list-group .list-group-item[aria-expanded="true"] {
        background-color: #222;
    }

    #sidebar .list-group .list-group-item[aria-expanded="true"]::after {
        content: " \f0da";
        font-family: FontAwesome;
        display: inline;
        text-align: right;
        padding-left: 5px;
    }

    /* level 1*/

    #sidebar .list-group .collapse .list-group-item {
        padding-left: 20px;
    }

    /* level 2*/

    #sidebar .list-group .collapse>.collapse .list-group-item {
        padding-left: 30px;
    }

    /* level 3*/

    #sidebar .list-group .collapse>.collapse>.collapse .list-group-item {
        padding-left: 40px;
    }

    @media (max-width:48em) {
        /* overlay sub levels on small screens */
        #sidebar .list-group .collapse.in,
        #sidebar .list-group .collapsing {
            position: absolute;
            z-index: 1;
            width: 190px;
        }
        #sidebar .list-group>.list-group-item {
            text-align: center;
            padding: .75rem .5rem;
        }
        /* hide caret icons of top level when collapsed */
        #sidebar .list-group>.list-group-item[aria-expanded="true"]::after,
        #sidebar .list-group>.list-group-item[aria-expanded="false"]::after {
            display: none;
        }
    }

    /* change transition animation to width when entire sidebar is toggled */

    #sidebar.collapse {
        -webkit-transition-timing-function: ease;
        -o-transition-timing-function: ease;
        transition-timing-function: ease;
        -webkit-transition-duration: .2s;
        -o-transition-duration: .2s;
        transition-duration: .2s;
    }

    #sidebar.collapsing {
        opacity: 0.8;
        width: 0;
        -webkit-transition-timing-function: ease-in;
        -o-transition-timing-function: ease-in;
        transition-timing-function: ease-in;
        -webkit-transition-property: width;
        -o-transition-property: width;
        transition-property: width;

    }
</style>

<?php //Avances
    $IdInicioEjecucion='';
    if(!empty($ejecucion)){
    $IdInicioEjecucion = $ejecucion[0]['idInicioEjecucion'];
    // if(file_exist(Yii::getPathOfAlias('webroot').'/'.'adjuntos/93/163/157/225/119/222/42/99/IMG_0798.JPG')){
    // echo Yii::getPathOfAlias('webroot').'/'.'adjuntos/93/163/157/225/119/222/42/99/IMG_0798.JPG';
    // EWideImage::load(Yii::getPathOfAlias('webroot').'/'.'adjuntos/93/163/157/225/119/222/42/99/IMG_0817.JPG')->resize(400, 300)->saveToFile(Yii::getPathOfAlias('webroot').'/'.'adjuntos/93/163/157/225/119/222/42/99/small_IMG_0817.JPG');
    // EWideImage::load(Yii::getPathOfAlias('webroot').'/adjuntos/93/163/157/225/119/222/42/99/IMG_0798.JPG')->resize(400, 300)->saveToFile(Yii::getPathOfAlias(Yii::getPathOfAlias('webroot').'/adjuntos/93/163/157/225/119/222/42/99/small_IMG_0798.JPG');
    // }
    // EWideImage::load(Yii::getPathOfAlias('webroot').'/'.'adjuntos/93/163/157/225/119/222/42/99/IMG_0798.JPG')->resize(50, 30)->saveToFile(Yii::getPathOfAlias('webroot').'/'.'adjuntos/93/163/157/225/119/222/42/99/small_IMG_0798.JPG');
    }
    ?>
<?php

    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/fichatecnica.js');
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/fichatecnica.css');
    Yii::app()->clientScript->registerScriptFile('https://maps.googleapis.com/maps/api/js', CClientScript::POS_END);
    ?>
    <?php

$IdProyecto = $proyecto[0]['idProyecto'];

$this->beginWidget(
    'zii.widgets.jui.CJuiDialog',
    array(
        'id'=>'imagen-dialog',
            'options'=>array(
                'title'=>Yii::t('job', 'Imagenes'),
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

echo "<div id='ImagenesDialog'></div>";
$this->endWidget('zii.widgets.jui.CJuiDialog');

Yii::import('ext.EWideImage.*');
    Yii::import('ext.gmaps.*');
    $gMap = new EGMap();
    $gMap->zoom = 10;
    $gMap->setCenter(39.721089311812094, 2.91165944519042);
    // $gMap->zoom = 22;

    $mapTypeControlOptions       = array(
        'position' => EGMapControlPosition::LEFT_BOTTOM,
        'style' => EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
    );
    $gMap->mapTypeControlOptions = $mapTypeControlOptions;
    $lat1                        = 15.4365949;
    $lon1                        = -87.9808419;
    $lat2                        = 15.4696470;
    $lon2                        = -88.0057300;

    // Crear markers

    $marker = new EGMapMarker($lat1, $lon1, array(
        'title' => 'Marker With Custom Image'
    ));
    $marker->addHtmlInfoWindow(new EGMapInfoWindow('<div>I am a marker with custom image!</div>'));
    $gMap->addMarker($marker);

    // Crear direction

    $loc1                                = new EGMapCoord($lat1, $lon1);
    $loc2                                = new EGMapCoord($lat2, $lon2);
    $direction                           = new EGMapDirection($loc1, $loc2, 'direccion');
    $direction->optimizeWaypoints        = true;
    $direction->provideRouteAlternatives = true;
    $renderer                            = new EGMapDirectionRenderer();
    $renderer->draggable                 = false;
    $renderer->panel                     = "mapa";

    // $renderer->setPolylineOptions(array('strokeColor'=>'#6dc066'));

    $renderer->setPolylineOptions(array(
        'strokeColor' => '#dd2831'
    ));
    $direction->setRenderer($renderer);
    $gMap->addDirection($direction);

    if (!empty($contratacion)) {
        $total_x = count(Yii::app()->db->createCommand()->select('*')->from('v_avance_ft')->where('idContratacion=:id', array(
            ':id' => $contratacion[0]['idContratacion']
        ))->queryAll());
        $row     = 0;
    }

    if (!empty($desembolso) &&!empty($ejecucion)) {
        $desembolso = Yii::app()->db->createCommand()->select('*')->from('cs_desembolsos_montos')->where('idInicioEjecucion=:id', array(
            ':id' => $ejecucion[0]['idInicioEjecucion']
        ))->queryAll();
        $rowY       = 0;
        $total_y    = count($desembolso);
    }
    $ejecucion2=$ejecucion;
    $proyecto_departamento = 'N/D';
    /* @var $this CiudadanoController */
    $this->breadcrumbs     = array(
        'Ciudadano' => array(
            'index'
        )
    );

    $breakModel = BudgetBreakdown::model();

    $PreModel=PreQualification::model();
    $BeneModel= ProyectoMunicipio::model();
    $FuenModel= Fuentesfinan::model();
    $PlanModel=PlanningMilestone::model();
    $foreCast=Forecast::model();
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/protected/views/ciudadano/FichaTecnica/assets/js/modernizr.custom.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/protected/views/ciudadano/FichaTecnica/assets/js/customizer.js');
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/protected/views/ciudadano/FichaTecnica/assets/css/component.css');

    ?>

        <div class="container-fluid">

            <div class="row">
                <div class="section-title-double col-md-12 col-xs-12">
                    <h1 style="font-size: 2em;text-align:justify;padding-left:20px">
                        <?php echo (!empty($proyecto[0]['nombre_proyecto'])) ? '<center><h1>'.$proyecto[0]['nombre_proyecto'].'</h1></center>' : ''; ?>
                    </h1>
                    <?php
                                if (!empty($calificacion)){
                                $contratoTipo  = Yii::app()->db->createCommand('SELECT contrato FROM cs_tipocontrato WHERE idTipoContrato ='.$calificacion[0]['idTipoContrato'])->queryAll();
                            ?>

                        <h3 style="padding-left: 20px;text-transform: none;color: #999;margin-top: 10px;font-size: 20px;">
                            <?php
                                    //echo (!empty($calificacion[0]['nomprocesoproyecto'])) ? $calificacion[0]['nomprocesoproyecto']: '';
                                    echo (!empty($contratoTipo[0]['contrato'])) ? '<center>'.$contratoTipo[0]['contrato'].'</center><br/>' : '';
                                    ?>
                                <h3>
                                    <?php
                                }
                            ?>
                                        <div class="project-info">
                                            <h3></h3>
                                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-12 col-xs-12">
                    <div class="main clearfix" style="background:transparent !important;">
                        <nav id="menu" class="nav">
                            <ul id="sNav">
                                <?php if (!empty($proyecto)) {?>
                                <li>
                                    <a class="scroll" target="tab01">
                                        <!--data-toggle="collapse" aria-expanded="true"-->
                                        <span class="icon">
                                            <i aria-hidden="true" class="fa fa-paper-plane-o"></i>
                                        </span>
                                        <span class="iconText">Información básica del proyecto</span>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                                    <li>
                                        <a class="scroll" target="tab02">
                                            <!--data-toggle="collapse" aria-expanded="false"> -->
                                            <span class="icon">
                                                <i aria-hidden="true" class="fa fa-handshake-o"></i>
                                            </span>
                                            <span class="iconText">Proceso de contratación</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="scroll" target="tab20">
                                            <!--data-toggle="collapse" aria-expanded="false"> -->
                                            <span class="icon">
                                                <i aria-hidden="true" class="fa fa-info-circle"></i>
                                            </span>
                                            <span class="iconText">Información financiera</span>
                                        </a>
                                    </li>
                                    <?php if (!empty($ejecucion)) {?>
                                    <li>
                                        <a class="scroll" target="tab08">
                                            <!--data-toggle="collapse" aria-expanded="false"> -->
                                            <span class="icon">
                                                <i aria-hidden="true" class="fa fa-building-o"></i>
                                            </span>
                                            <span class="iconText">Implementación</span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                                        <li>
                                            <a class="scroll" target="tab09">
                                                <!--data-toggle="collapse" aria-expanded="false"> -->
                                                <span class="icon">
                                                    <i aria-hidden="true" class="fa fa-bar-chart-o"></i>
                                                </span>
                                                <span class="iconText">Mapa</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a class="scroll" target="tab12">
                                                <!--data-toggle="collapse" aria-expanded="false"> -->
                                                <span class="icon">
                                                    <i aria-hidden="true" class="fa fa-files-o"></i>
                                                </span>
                                                <span class="iconText">Contratos relacionados</span>
                                            </a>
                                        </li>

                            </ul>
                        </nav>
                    </div>

                </div>
                <div class="row-offcanvas row-offcanvas-right">
                    <main class="col-md-12 col-xs-12" style="margin-top:50px">
                        <div class="insideContent col-md-9 col-xs-9 col-xs-12">
                            <p class="float-right hidden-md-up" style="text-align: right;" id="specialButton">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="offcanvas">Hitos</button>
                            </p>
                            <div class="componentTab" id="tab01" name="tab01">
                                <!--class="collapse in"-->
                                <?php if (!empty($proyecto)) {?>
                                <div class="page-title section-title-double animated fadeIn">
                                    <h2>Resumen proyecto</h2>
                                    <span></span>
                                </div>
                                <button type="button" class="btn btn-primary printB" name="button" style="margin-bottom: 10px;" onclick="imprimirFicha()">
                                    <i aria-hidden="true" class="fa fa-print"></i>
                                    Imprimir
                                </button>
                                <!-- **************** PLANIFICACION DE PROYECTOS **************** -->
                                <?php include(dirname(__FILE__).'/FichaTecnica/resumen.php');
                                }?>
                            </div>
                            <div class="componentTab" id="tab01" name="tab01">
                                <!--class="collapse in"-->
                                <?php if (!empty($proyecto)) {?>
                                <div class="page-title section-title-double animated fadeIn">
                                    <h2>Información básica del proyecto</h2>
                                    <span></span>
                                </div>

                                <!-- **************** PLANIFICACION DE PROYECTOS **************** -->
                                <?php include(dirname(__FILE__).'/FichaTecnica/planificacion.php');
                                }?>
                            </div>

                            <div class="componentTab" id="tab02">
                                <!-- class="collapse"> -->
                                <div class="page-title section-title-double animated fadeIn">
                                    <h2>Proceso de contratación</h2>
                                    <span></span>
                                </div>

                                <?php
                                        $datos_Pre= $PreModel->findAll(array(
                                            'condition' => 'idProyecto=:id',
                                            'params' => array(
                                                ':id' => $proyecto[0]['idProyecto']
                                            )
                                        ));
                                        if (count($datos_Pre) != 0){
                                    ?>
                                    <div class="code-boxInverse">
                                        <h5> Pre-Calificación</h5>
                                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                                        <table class="display hover row-border" id="tabla_pre" cellspacing="0" style="width:100%;">
                                            <thead>
                                                <tr style="background:#29a4dd;color:#fff">
                                                    <th>Fecha inicio</th>
                                                    <th>Fecha final</th>
                                                    <th>Duración(días)</th>
                                                    <th>Fecha de inicio del período de consulta</th>
                                                    <th>Fecha de finalización del período de consulta</th>
                                                    <th>Fecha de inicio del período de calificación</th>
                                                    <th>Fecha de finalización del período de calificación</th>
                                                    <th>Criterio de elegibilidad</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                            $total_x=count($datos_Pre);
                                            $row=0;
                                            while ($row< $total_x) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <span>
                                                                <?php echo $datos_Pre[$row] ['startDate']; ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <?php echo $datos_Pre[$row] ['endDate']; ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <?php echo $datos_Pre[$row] ['durationInDays']; ?>
                                                            </span>
                                                        </td>

                                                        <td>
                                                            <span>
                                                                <?php echo $datos_Pre[$row] ['enquiryPeriod_startDate']; ?>
                                                            </span>
                                                        </td>

                                                        <td>
                                                            <span>
                                                                <?php echo $datos_Pre[$row] ['enquiryPeriod_endDate']; ?>
                                                            </span>
                                                        </td>

                                                        <td>
                                                            <span>
                                                                <?php echo $datos_Pre[$row] ['qualificationPeriod_startDate']; ?>
                                                            </span>
                                                        </td>

                                                        <td>
                                                            <span>
                                                                <?php echo $datos_Pre[$row] ['qualificationPeriod_endDate']; ?>
                                                            </span>
                                                        </td>
                                                        <td>

                                                            <span>
                                                                <?php echo $datos_Pre[$row] ['eligibilityCriteria']; ?>
                                                            </span>
                                                        </td>


                                                    </tr>

                                                    <?php
                                                                $row++;
                                            } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                    <?php
                                        }
                                    ?>


                                        <?php if (!empty($calificacion)) {
                                    ?>

                                        <div class="page-title animated fadeIn">
                                            <h5>Invitación</h5>
                                        </div>
                                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                                        <!-- ********************* INVITACION Y CALIFICACION ***************** -->
                                        <?php include(dirname(__FILE__).'/FichaTecnica/invitacionCalificacion.php');
                            }
                            ?>

                                        <?php if (!empty($adjudicacion)) {
                                ?>

                                        <div class="page-title animated fadeIn">
                                            <h5>Adjudicación</h5>
                                        </div>
                                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                                        <!-- **************** ADJUDICACION **************** -->

                                        <?php include(dirname(__FILE__).'/FichaTecnica/adjudicacion.php');
                                }
                                ?>
                                        <?php if (!empty($contratacion)) {
                                    ?>
                                        <div class="page-title animated fadeIn">
                                            <h4>
                                                <?php if ($CPrincipal>0)
                                                            echo 'Resumen del contrato APP';
                                                        else
                                                            echo 'Resumen del contrato';
                                                ?>
                                            </h4>
                                        </div>
                                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                                        <!-- **************** CONTRATACION **************** -->
                                        <?php include(dirname(__FILE__).'/FichaTecnica/contratacion.php');
                                    }
                                    ?>
                                        <?php  if (!empty($contratos_gestion)) { ?>
                                        <div class="page-title animated fadeIn">
                                            <h4>Renegociaciones</h4>
                                        </div>
                                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                                        <!-- **************** GESTION DE CONTRATOS **************** -->
                                        <?php include(dirname(__FILE__).'/FichaTecnica/gestionContratos.php');
                                    } ?>
                            </div>
                            <!-- **************** DESEMBOLSOS Y MONTOS   **************** -->
                            <?php if (!(empty($ejecucion)&&empty($avances)&&empty($finalizacion))) {?>
                            <div class="componentTab" id="tab08">
                                <?php
                                if (!empty($ejecucion)) {?>
                                    <div class="page-title section-title-double animated fadeIn">
                                        <h2>Implementación</h2>
                                        <span></span>
                                    </div>
                                    <?php include(dirname(__FILE__).'/FichaTecnica/implementacion.php');?>
                                    <!--
                                <div class="page-title animated fadeIn">
                                    <h4>Plan de desembolsos</h4>
                                </div>
                                <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                                <?php include(dirname(__FILE__).'/FichaTecnica/desembolsosMontos.php');
                                }
                                ?>
                                -->

                                    <?php if (!empty($avances)) {
                                ?>
                                    <div class="page-title animated fadeIn">
                                        <h4>Avances</h4>
                                    </div>
                                    <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                                    <!-- **************** AVANCES **************** -->
                                    <?php include(dirname(__FILE__).'/FichaTecnica/avances.php');
                            }
                            ?>
                                    <?php
                            if (!empty($finalizacion)) {
                                ?>
                                        <div class="page-title animated fadeIn">
                                            <h4>Finalización</h4>
                                        </div>
                                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                                        <!-- **************** FINALIZACION **************** -->
                                        <?php
                                include(dirname(__FILE__).'/FichaTecnica/finalizacion.php');
                            }

                            ?>

                            </div>
                            <?php  }

                            ?>
                            <div class="componentTab" id="tab09">
                                <!-- class="collapse"> -->
                                <!--
                                <div class="page-title section-title-double animated fadeIn">
                                    <h2>Gráficos</h2>
                                    <span></span>
                                </div>
                                -->
                                <!-- **************** GRAFICOS   **************** -->
                                <?php //include(dirname(__FILE__).'/FichaTecnica/graficos.php');?>
                            </div>
                            <div class="componentTab" id="tab10">
                                <!-- class="collapse"> -->
                                <div class="page-title section-title-double animated fadeIn">
                                    <h2>Mapa</h2>
                                    <span></span>
                                </div>
                                <!-- <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;"> -->
                                <!-- ****************   MAPA   **************** -->
                                <!--<div id="mapa"></div>-->
                                <?php include(dirname(__FILE__).'/FichaTecnica/mapa.php');?>
                            </div>
                            <div class="componentTab" id="tab12">
                                <!-- class="collapse"> -->
                                <div class="page-title section-title-double animated fadeIn">
                                    <h2>Contratos relacionados</h2>
                                    <span></span>
                                </div>

                                <!-- **************** Contratos RELACIONADOS **************** -->
                                <?php include(dirname(__FILE__).'/FichaTecnica/contratosRelacionados.php');
                                ?>
                            </div>
                            <!-- ****************** ANUNCIOS  ****************** -->
                            <?php
                                $anuncios = Yii::app()->db->createCommand('SELECT * FROM cs_announcement WHERE idProyecto='.$proyecto[0]['idProyecto'])->queryRow();
                                if (count($anuncios)>0) {
                            ?>
                                    <div class="componentTab" id="tab13">
                                        <h4>Anuncios</h4>
                                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                                        <div class="row animated fadeIn">
                                            <div class=" col-md-12">
                                                <!-- <div class="inner"> -->
                                                    <h6>Título</h6>
                                                    <p>
                                                        <?php echo $anuncios['title']?> </p>
                                                <!-- </div> -->
                                            </div>
                                            <div class="col-md-12">
                                                <!-- <div class="inner"> -->
                                                    <h6>Descripción</h6>
                                                    <p>
                                                        <?php echo $anuncios['description'] ?> </p>
                                                <!-- </div> -->
                                            </div>
                                            <!-- <div class="basic-info-box col-md-4">
                                                <div class="inner">
                                                    <p>
                                                        Fecha de publicación
                                                    </p>
                                                    <h6> -->
                                                        <?php
                                                        // if (!empty($proyecto[0]['fecha_publicacion'])) {
                                                        //     $date=date_create($proyecto[0]['fecha_publicacion']);
                                                        //     echo date_format($date, 'd/m/Y');
                                                        // }
                                                        // else {
                                                        //     echo 'No ha divulgado esta información';
                                                        // }
                                                        ?>
                                                    <!-- </h6>
                                                </div>
                                            </div> -->

                                        </div>
                                    </div>
                            <?php
                                }
                            ?>

                            <?php if (!(empty($galeriaImagenes))) { ?>
                            <div class="componentTab" id="tab13">
                                <!-- class="collapse"> -->
                                <div class="page-title section-title-double animated fadeIn">
                                    <h2>Galería de Imágenes</h2>
                                    <span></span>
                                </div>

                                <!-- **************** Contratos RELACIONADOS **************** -->
                                <?php include(dirname(__FILE__).'/FichaTecnica/galeriaImagenes.php');
                                    ?>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="insideContent col-md-3 hidden-xs sidebar-offcanvas" id="sidebar" style="border-radius:4px">
                            <div class="page-title section-title-double animated fadeIn">
                                <h2>Hitos</h2>
                                <span></span>
                            </div>
                            <div class="timeline-centered">
                                <h4> Hitos principales </h4>
                                <?php
                                    $tempIdProyecto = -1;
                                    if (!empty($proyecto)) {
                                        $tempIdProyecto = $proyecto[0]['idProyecto'];
                                    }

                                    $tempIdContratacion = -1;
                                    if (!empty($contratacion)) {
                                        $tempIdContratacion = $contratacion[0]['idContratacion'];
                                    }

                                    $tempIdImplementacion = -1;
                                    if (!empty($ejecucion)) {
                                        $tempIdImplementacion = $ejecucion[0]['idInicioEjecucion'];
                                    }
                                //     $generidData = PlanningMilestone::model()->findAll(array(
                                //     'order' => 'dueDate',
                                //     'condition' => 'idProyecto=:id',
                                //     'params' => array(
                                //         ':id' => $tempIdContrata
                                //     )
                                // ));
                                    $generidData = Yii::app()->db->createCommand('SELECT * FROM cs_planning_milestone WHERE idProyecto='.$tempIdProyecto.' UNION SELECT * from cs_contracts_milestone WHERE idContratacion='.$tempIdContratacion.' UNION SELECT * FROM cs_implementation_milestone WHERE idInicioEjecucion='.$tempIdImplementacion.' ORDER BY dueDate')->queryAll();
                                    $total_x=count($generidData);
                                    $row=0;

                                    if ($total_x!=0) {
                                        while ($row< $total_x) {
                                            ?>
                                    <article class="timeline-entry">
                                        <div class="timeline-entry-inner">
                                            <div class="timeline-icon">
                                                <p class="year">
                                                    <?php echo date( "Y", strtotime($generidData[$row] [ 'dueDate'])); ?>
                                                </p>
                                            </div>
                                            <div class="timeline-label">
                                                <div class="timeline-title">
                                                    <p>
                                                        <?php
                                                        setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
                                                        echo date( "j M", strtotime($generidData[$row] [ 'dueDate']));
                                                        ?>
                                                    </p>
                                                    <h3>
                                                        <?php echo $generidData[$row] [ 'title']; ?>
                                                    </h3>
                                                </div>
                                                <div class="timeline-description">
                                                    <p>
                                                        <?php echo $generidData[$row] ['description']; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <?php
                                $row++;
                                    }
                                    } else {
                                    echo "No hay Hitos disponibles";
                                    } ?>

                            </div>




                            <!-- <div class="timeline-centered">
                                <h4> Hitos de implementación </h4> -->

                            <!-- Article -->


                            <!-- </div> -->
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


                        $this->endWidget();
                    }
                    ?>
                            <?php
                    // ========================= FINALIZACIÓN ======================================================
                if ($IdInicioEjecucion == '') {
                    $IdInicioEjecucion = '-1';
                }
        $Final_Ejecucion= Yii::app()->db->createCommand('SELECT * FROM cs_final_ejecucion WHERE estado="PUBLICADO" AND idInicioEjecucion='.$IdInicioEjecucion)->queryAll();
                if (!empty($Final_Ejecucion)) {
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
                } else {
                    echo '<script>document.getElementById("btnFinalEjecucionAdj").disabled = true;</script><style> #btnFinalEjecucionAdj{color: gray;}</style>';
                }
                     ?>
                    </main>
                </div>
            </div>
        </div>

        <script type="text/javascript">

            $(document).ready(function () {
                $('[data-toggle="offcanvas"]').click(function () {
                    $('.row-offcanvas').toggleClass('active');

                });
                $('#PlanningDocumentsTable').DataTable({

                    "bPaginate": false,
                    "bLengthChange": false,
                    "searching": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#GestionContratosTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#ContratosDocumentsTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#AdvanceDocumentsTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#FinalizacionDocumentsTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });

                $('#TransactionsTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#TariffsTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#ImplementationMilestoneTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#ImplementationDocumentsTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#LendersSuppliersTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#ProyectosRelacionadosTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });

                $('#ShareholdersTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#AmendmentTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#ActualIrrTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#ShareCapitalTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#RiskAllocationTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#PreferredBiddersTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#GovSupportGuaranteeTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#DebtEquityRatioTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });

                $('#desembolsos_table').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });

                $('#ContractDocumentsTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#ContractsSignatoriesTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#ContractsOrganizationDetailsTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#ContractsMilestoneTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#CalificacionDocumentsTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#AwardDocumentsTable').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#tabla_financiamiento').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });

                $('#tabla_departamentos').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "bAutoWidth": false,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });

                $('#tabla_budget').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });

                $('#tabla_pre').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    fixedHeader: true,
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });

                var tabla_forecast = $('#tabla_forecast').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true,
                    "scrollCollapse": true,


                });
                $('#tabla_forecast tbody').on('click', 'tr', function () {
                    if ($(this).hasClass('selected')) {
                        $(this).removeClass('selected');
                    }
                    else {
                        tabla_forecast.$('tr.selected').removeClass('selected');
                        $(this).addClass('selected');
                        var value = $(this).find('td:first').html();
                        value = value.split("<span>")[1];
                        value = value.split("</span>")[0];
                        value = $.trim(value);
                        // console.log(value);
                        cargarForecastObs(value);
                    }
                });

                var table_milestone = $('#table_plan_desembolos').DataTable({
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true

                });



                var table_milestone = $('#table_milestone').DataTable({
                    "display": false,
                    "searching": false, "bPaginate": false, "bLengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    "pagingType": "simple",
                    "scrollX": true,
                    "processing": true,
                    "autoWidth": true,
                    "info": true,
                    "responsive": true

                });
                $('#table_milestone tbody').on('click', 'tr', function () {
                    if ($(this).hasClass('selected')) {
                        $(this).removeClass('selected');
                    }
                    else {
                        table_milestone.$('tr.selected').removeClass('selected');
                        $(this).addClass('selected');
                    }
                });

                //  table_milestone.columns.adjust().draw();

                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                    $($.fn.dataTable.tables(true)).DataTable()
                        .columns.adjust()
                        .responsive.recalc();
                });
                $("div[id^='tab0'],div[id^='tab1']").on('shown.bs.collapse', function (e) {
                    $($.fn.dataTable.tables(true)).DataTable()
                        .columns.adjust()
                        .responsive.recalc();
                });
                $("div[id^='tab0'],div[id^='tab1']").on('show.bs.collapse', function () {
                    $('.insideContent').find('.collapse.in').collapse('hide');
                });
            });

            function cargarForecastObs(value) {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo CController::createUrl("/Proyecto/ViewForecastObservations");?>' + "&idForecast=" + value,

                    success: function (data) {
                        $('#filas_forecastObs').html(data);
                    },
                    error: function (data) { // if error occured

                    },
                    dataType: 'html'
                });
            }

            function verImagenes(id) {

                $.ajax({
                    type: 'GET',
                    url: '<?php echo CController::createUrl("/Ciudadano/ViewImagenes");?>' + "&id=" + id,

                    success: function (data) {
                        dialogoDeUpdate.dialog("open");
                        $('#ImagenesDialog').html(data);
                    },
                    error: function (data) { // if error occured

                    },
                    dataType: 'html'
                });
            }
            var dialogoDeUpdate;
            $(document).ready(function () {
                dialogoDeUpdate = $("#imagen-dialog").dialog({
                    autoOpen: false,
                    modal: true,
                    width: 550,
                    height: 650,
                    title: 'Details'
                });
            });
        </script>

        <script type="text/javascript">
            //  The function to change the class
            var changeClass = function (r, className1, className2) {
                var regex = new RegExp("(?:^|\\s+)" + className1 + "(?:\\s+|$)");
                if (regex.test(r.className)) {
                    r.className = r.className.replace(regex, ' ' + className2 + ' ');
                }
                else {
                    r.className = r.className.replace(new RegExp("(?:^|\\s+)" + className2 + "(?:\\s+|$)"), ' ' + className1 + ' ');
                }
                return r.className;
            };

            //  Creating our button in JS for smaller screens
            var menuElements = document.getElementById('menu');
            menuElements.insertAdjacentHTML('afterBegin', '<button type="button" id="menutoggle" class="navtoogle" aria-hidden="true"><i aria-hidden="true" class="icon-menu"> </i> Menu</button>');

            //  Toggle the class on click to show / hide the menu
            document.getElementById('menutoggle').onclick = function () {
                changeClass(this, 'navtoogle active', 'navtoogle');
            }
            document.onclick = function (e) {
                var mobileButton = document.getElementById('menutoggle'),
                    buttonStyle = mobileButton.currentStyle ? mobileButton.currentStyle.display : getComputedStyle(mobileButton, null).display;

                if (buttonStyle === 'block' && e.target !== mobileButton && new RegExp(' ' + 'active' + ' ').test(' ' + mobileButton.className + ' ')) {
                    changeClass(mobileButton, 'navtoogle active', 'navtoogle');
                }
            }

            $('.scroll').click(function () {
                $('body').animate({
                    scrollTop: eval($('#' + $(this).attr('target')).offset().top - 70)
                }, 1000);
            });


        </script>
        <?php
        $valorIdProyecto=!empty($proyecto) ? $proyecto[0]['idProyecto'] : 0;
        $valorIdCalificacion=!empty($calificacion) ? $calificacion[0]['idCalificacion'] : 0;
        $valorIdAdjudicacion=!empty($adjudicacion) ? $adjudicacion[0]['idAdjudicacion'] : 0;
        $valorIdContratacion=!empty($contratacion) ? $contratacion[0]['idContratacion'] : 0;
        $valorIdInicioEjecucion=!empty($ejecucion) ? $ejecucion[0]['idInicioEjecucion'] : 0;
        ?>
            <script>
                function sizeObject(obj) {
                    var count = 0;

                    for (var property in obj) {
                        if (Object.prototype.hasOwnProperty.call(obj, property)) {
                            count++;
                        }
                    }

                    return count;
                }
                function basicProject(dataDocs, etapa) {
                    ArrayBasicProject = [];
                    if (sizeObject(dataDocs) > 0) {
                        ArrayBasicProject.push(
                            ['\n\nSector: \n ' + dataDocs['proyecto_sector'] + '\n\n', '\n\nUbicación: \n ' + dataDocs['departamento'] + '\n\n'],
                            ['\n\nValor estimado del proyecto: \n ' + Intl.NumberFormat().format(dataDocs['presupuesto'], 2) + '\n\n', '\n\nEtapa: \n ' + etapa + '\n\n'],
                            ['\n\nEntidad contratante: \n ' + dataDocs['entes_nombre'] ,'\n\nFecha de publicación: \n ' + dataDocs['fecha_publicacion'] + '\n\n' + '\n\n'],
                        )
                    }
                    return ArrayBasicProject;
                }
                function basicProject2(dataDocs) {
                    ArrayBasicProject = [];

                    if (sizeObject(dataDocs) > 0) {
                        ArrayBasicProject.push(
                            { text: "\nInformación básica del proyecto\n\n", style: 'headerMain' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 150 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\nCódigo del Proyecto", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + dataDocs['codigo'] + "\n\n", style: 'contenido' },

                            { text: "\nNombre del Proyecto", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + dataDocs['nombre_proyecto'] + "\n\n", style: 'contenido' },

                            { text: "\nUbicación", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + dataDocs['departamento'] + "\n\n", style: 'contenido' },

                            { text: "\nSector", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + dataDocs['proyecto_sector'] + "\n\n", style: 'contenido' },

                            { text: "\nSub sector", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + dataDocs['proyecto_subsector'] + "\n\n", style: 'contenido' },

                            { text: "\nAdicionalidad del proyecto", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + dataDocs['idProposito'] + "\n\n", style: 'contenido' },

                            { text: "\nDescripción de activos y/o servicios", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + dataDocs['descrip'] + "\n\n", style: 'contenido', },

                            { text: "\nValor estimado del proyecto", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + Intl.NumberFormat().format(dataDocs['presupuesto'], 2) + "\n\n", style: 'contenido', },

                            { text: "\nFecha de aprobación", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + dataDocs['fechaaprob'] + "\n\n", style: 'contenido', },
                        )
                    }
                    return ArrayBasicProject;

                }
                function basicProject3(dataDocs) {
                    ArrayBasicProject = [];
                    if (sizeObject(dataDocs) > 0) {
                        ArrayBasicProject.push(
                            [{ text: "\nNOMBRE", style: 'contenido2' }, { text: "\nPUESTO", style: 'contenido2' }, { text: "\nCORREO", style: 'contenido2' }, { text: "\nTELEFONO", style: 'contenido2' }, { text: "\nAUTORIDAD PÚBLICA(PATROCINADOR)", style: 'contenido2' }],
                            [dataDocs['funcionario_nombre'], dataDocs['funcionario_correo'], dataDocs['funcionario_puesto'], dataDocs['funcionario_telefono'], dataDocs['entes_nombre']],
                        )

                    }
                    return ArrayBasicProject;
                }
                function printBasicProject(dataDocs, dataEtapa) {
                    ArrayBasicProjectPrint = [];
                    if (sizeObject(dataDocs) > 0) {
                        ArrayBasicProjectPrint.push(
                            { text: "\n" + dataDocs['nombre_proyecto'] + "\n\n", style: 'header' },
                            { text: '\n\n\nResumen proyecto\n\n', style: 'headerMain' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 150 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: '\n' },
                            {

                                table: {

                                    widths: ['50%', '50%'],
                                    body: basicProject(dataDocs, dataEtapa),
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        );
                    }
                    return ArrayBasicProjectPrint;

                }
                function printPreCalificacion(dataDocs) {
                    ArrayPrecalificacionPrint = [];
                    if (sizeObject(dataDocs) > 0) {

                        ArrayPrecalificacionPrint.push(
                            { text: '\n\n\nProceso de contratación\n\n', style: 'headerMain' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 150 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\nPre-Calificación", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {

                                    widths: ['33%', '33%', '33%'],
                                    body: precalificacionToPdf(dataDocs)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayPrecalificacionPrint;
                }
                function printDatosFuncionarioProject(dataDocs) {
                    ArrayDatosFuncionariosPrint = [];
                    if (sizeObject(dataDocs) > 0) {
                        ArrayDatosFuncionariosPrint.push(
                            { text: "\nDetalles de contacto de la autoridad contratante", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n", },
                            {

                                table: {
                                    body: basicProject3(dataDocs),
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayDatosFuncionariosPrint;
                }
                function printPronostico(data) {
                    ArrayPronosticoPrint = []
                    if (sizeObject(data) > 0) {
                        ArrayPronosticoPrint.push(
                            { text: "\nDemanda estimada anual", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {

                                    widths: ['25%', '25%', '25%', '25%'],
                                    body: pronosticoToPdf(data),
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )

                    }
                    return ArrayPronosticoPrint;
                }
                function printHitos(data) {
                    ArrayHitosPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayHitosPrint.push(
                            { text: "\nHitos de la planificación", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {

                                    widths: ['33%', '33%', '33%'],
                                    body: pHitosToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayHitosPrint;
                }
                function printProjectDocs(data) {
                    ArrayProjectDocs = [];
                    if (sizeObject(data) > 0) {
                        ArrayProjectDocs.push(
                            { text: "\nDocumentos de la información básica", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" },
                            {

                                table: {

                                    widths: ['50%', '50%'],
                                    body: docsToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayProjectDocs;
                }
                function printPresupuesto(data) {
                    ArrayBudgetPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayBudgetPrint.push(
                            { text: "\nDesglose del presupuesto", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {

                                    widths: ['25%', '25%', '25%', '25%'],
                                    body: budgetToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        );
                    }
                    return ArrayBudgetPrint;
                }
                function printFuentesFinanciamiento(data) {
                    var ArrayFuentesPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayFuentesPrint.push(
                            { text: "\nFuentes de financiamiento", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {

                                    widths: ['60%', '20%', '10%', '10%'],
                                    body: fuentesToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayFuentesPrint;
                }
                function printBeneficiarios(data) {
                    ArrayBeneficiarioPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayBeneficiarioPrint.push(
                            { text: "\nBeneficiarios", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {

                                    widths: ['14%', '14%', '72%'],
                                    body: beneficiariosToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayBeneficiarioPrint;
                }

                function basicCalificacion(dataDocs) {
                    ArrayBasicCalificacion = [];
                    if (sizeObject(dataDocs) > 0) {
                        ArrayBasicCalificacion.push(
                            { text: '\n\n\nInvitación\n', style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\nNombre del proceso", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + dataDocs[0]['nomprocesoproyecto'] + "\n\n", style: 'contenido' },

                            { text: "\nTipo de contrato", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + dataDocs[0]['tipo_contrato'] + "\n\n", style: 'contenido', },

                            { text: "\nMétodo de adquisiciones", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + dataDocs[0]['metodo_adquisicion'] + "\n\n", style: 'contenido', },

                            // { text: "\nNúmero del proceso", style: 'header' },
                            // { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            // { text: "\n" + dataDocs[0]['numproceso'] + "\n\n", style: 'contenido' },





                            // { text: "\nNúmero de empresas participantes", style: 'header' },
                            // { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            // { text: "\n" + dataDocs.length + "\n\n", style: 'contenido', },
                            //
                            // { text: "\nFecha de publicación", style: 'header' },
                            // { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            // { text: "\n" + dataDocs[0]['fecha_publicacion'] + "\n\n", style: 'contenido', },



                            /*{ text: "\nDatos del Funcionario", style: 'header' },
                            {canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595-2*40, y2: 5, lineWidth: 0.1, lineColor:"#29a4dd",}]},
                            { text: "\n", },
                            {

                                table:{
                                    widths: ['20%', '20%','20%','20%','20%'],
                                    body:[
                                        [{ text: "\nNOMBRE", style:'contenido2'},{ text: "\nPUESTO", style:'contenido2'},{ text: "\nCORREO", style:'contenido2'},{ text: "\nTELEFONO", style:'contenido2'},{ text: "\nAUTORIDAD PÚBLICA(PATROCINADOR)", style:'contenido2'}],
                                        [dataDocs[0]['funcionario_nombre'],dataDocs[0]['funcionario_puesto'],dataDocs[0]['funcionario_correo'],dataDocs[0]['funcionario_telefono'],dataDocs[0]['entes_nombre']],
                                    ],
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ?  'white' : null;
                                    },
                                     hLineColor: function (i, node) {
                                        return '#0984e3';
                                      },
                                      vLineColor: function (i, node) {
                                        return '#0984e3';
                                      },
                                      hLineWidth: function (i, node) {
                                        return 1;
                                      },
                                      vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },*/
                        )
                    }
                    return ArrayBasicCalificacion;
                }
                function printFuncionarioCalificacion(dataDocs) {
                    ArrayBasicCalificacion = [];
                    if (sizeObject(dataDocs) > 0) {
                        ArrayBasicCalificacion.push(

                            { text: "\nDetalles de contacto de la entidad de adquisición", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n", },
                            {

                                table: {
                                    widths: ['20%', '20%', '20%', '20%', '20%'],
                                    body: [
                                        [{ text: "\nNOMBRE", style: 'contenido2' }, { text: "\nPUESTO", style: 'contenido2' }, { text: "\nCORREO", style: 'contenido2' }, { text: "\nTELEFONO", style: 'contenido2' }, { text: "\nAUTORIDAD PÚBLICA(PATROCINADOR)", style: 'contenido2' }],
                                        [dataDocs[0]['funcionario_nombre'], dataDocs[0]['funcionario_puesto'], dataDocs[0]['funcionario_correo'], dataDocs[0]['funcionario_telefono'], dataDocs[0]['entes_nombre']],
                                    ],
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayBasicCalificacion;
                }
                function printOferentesParticipantes(data) {
                    ArrayOferentesPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayOferentesPrint.push(
                            { text: "\nOferentes Participantes", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n", },
                            {

                                table: {
                                    widths: ['10%', '90%'],
                                    body: oferentesToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        );
                    }
                    return ArrayOferentesPrint;
                }
                function printDocsCalificacion(data) {
                    ArrayCDocsPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayCDocsPrint.push(
                            { text: "\nDocumentos de la licitación", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {

                                    widths: ['50%', '50%'],
                                    body: CalificacionDocsToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        );
                    }
                    return ArrayCDocsPrint;
                }

                function basicAdjudicacion(data) {
                    ArrayBasicAdjudicacion = [];
                    if (sizeObject(data) > 0) {
                        ArrayBasicAdjudicacion.push(
                            { text: '\n\n\nAdjudicación\n\n', style: 'headerMain' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\nNúmero de adjudicación", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + data[0]['numproceso'] + "\n\n", style: 'contenido' },

                            // { text: "\nCosto estimado", style: 'header' },
                            // { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            // { text: "\n" + Intl.NumberFormat().format(data[0]['costoesti'], 2) + "\n\n", style: 'contenido' },

                            { text: "\nMetodo de la adjudicación", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + data[0]['nombre'] + "\n\n", style: 'contenido' },

                            // { text: "\nFecha publicación", style: 'header' },
                            // { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            // { text: "\n" + data[0]['fecha_publicacion'] + "\n\n", style: 'contenido' },
                        )
                    }
                    return ArrayBasicAdjudicacion;
                }
                function printDocsAdjudicacion(data) {
                    ArrayADocsPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayADocsPrint.push(
                            { text: "\nDocumentos de la adjudicación", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" },
                            {

                                table: {

                                    widths: ['50%', '50%'],
                                    body: AdjudicacionDocsToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        );
                    }
                    return ArrayADocsPrint;
                }
                function printOferentesPreferidos(data) {
                    ArrayOferentesPreferidosPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayOferentesPreferidosPrint.push(
                            { text: "\nOferentes Preferidos", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            {

                                table: {

                                    widths: ['100%'],
                                    body: AdjudicacionOferentesPreferidosToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        );
                    }
                    return ArrayOferentesPreferidosPrint;
                }

                function basicContratacion(data) {
                    ArrayBasicContratacion = [];
                    if (sizeObject(data) > 0) {
                        ArrayBasicContratacion.push(
                            { text: '\n\n\nResumen del Contrato\n\n', style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\nNúmero de contratación", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + data[0]['ncontrato'] + "\n\n", style: 'contenido' },

                            { text: "\nNombre del contrato", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + data[0]['titulocontrato'] + "\n\n", style: 'contenido' },

                            { text: "\nEmpresa", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + data[0]['legalName'] + "\n\n", style: 'contenido' },

                            { text: "\nAlcance", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + data[0]['alcances'] + "\n\n", style: 'contenido' },

                            { text: "\nFecha de inicio", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + data[0]['fechainicio'] + "\n\n", style: 'contenido' },

                            { text: "\nFecha final", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + data[0]['fechafinal'] + "\n\n", style: 'contenido' },

                            { text: "\nCosto en lempiras", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + Intl.NumberFormat().format(data[0]['precioLPS'], 2) + "\n\n", style: 'contenido' },

                            { text: "\nCosto equivalente doláres", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" + Intl.NumberFormat().format(data[0]['precioUSD'], 2) + "\n\n", style: 'contenido' },

                            // { text: "\nFecha de publicación", style: 'header' },
                            // { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            // { text: "\n" + data[0]['fecha_publicacion'] + "\n\n", style: 'contenido' },
                        )
                    }
                    return ArrayBasicContratacion;
                }
                function printFirmantes(data) {
                    ArrayFirmantesPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayFirmantesPrint.push(
                            { text: "\nFirmantes", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" },
                            {

                                table: {

                                    widths: ['100%'],
                                    body: ContratacionFirmantesToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayFirmantesPrint;
                }
                function printDetallesOrganizacion(data) {
                    ArrayDetallesOrganizacionPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayDetallesOrganizacionPrint.push(
                            { text: "\nDetalles de Organización ", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {

                                    widths: ['100%'],
                                    body: ContratacionOrganizacionToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayDetallesOrganizacionPrint;
                }
                function printAccionista(data) {
                    ArrayAccionistaPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayAccionistaPrint.push(
                            { text: "\nAccionista ", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {

                                    widths: ['25%', '25%', '25%', '25%'],
                                    body: ContratacionAccionistaToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayAccionistaPrint;
                }
                function printPrestamista(data) {
                    ArrayPrestamistaPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayPrestamistaPrint.push(
                            { text: "\nPrestamista ", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {

                                    widths: ['25%', '25%', '25%', '25%'],
                                    body: ContratacionAccionistaToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayPrestamistaPrint;
                }
                function printGarantiaGovierno(data) {
                    ArrayGarantiaGoviernoPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayGarantiaGoviernoPrint.push(
                            { text: "\nGarantia de govierno ", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {

                                    widths: ['25%', '10%', '15%', '15%', '20%', '15%'],
                                    body: ContratacionGovGarantiaToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayGarantiaGoviernoPrint;
                }
                function printRiesgos(data) {
                    ArrayRiesgosPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayRiesgosPrint.push(
                            { text: "\nRiesgos ", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {

                                    widths: ['50%', '50%'],
                                    body: ContratacionRiskToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayRiesgosPrint;
                }
                function printRatio(data) {
                    ArrayRatioPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayRatioPrint.push(
                            { text: "\nRatio del capital de la deuda ", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {

                                    widths: ['20%', '20%', '20%', '20%', '20%'],
                                    body: ContratacionRatioToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayRatioPrint;
                }
                function printTir(data) {
                    ArrayTirPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayTirPrint.push(
                            { text: "\nTIR ", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" },
                            {

                                table: {

                                    widths: ['33%', '33%', '33%'],
                                    body: ContratacionIrrToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayTirPrint;
                }
                function printCapitalCompartido(data) {
                    ArrayCapitalCompartidoPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayCapitalCompartidoPrint.push(
                            { text: "\nCapital Compartido ", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" },
                            {

                                table: {

                                    widths: ['33%', '33%', '33%'],
                                    body: ContratacionShareCapitalToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayCapitalCompartidoPrint;
                }
                function printEnmiendas(data) {
                    ArrayEnmiendasPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayEnmiendasPrint.push(
                            { text: "\nEnmiendas ", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\n" },
                            {

                                table: {

                                    widths: ['33%', '33%', '33%'],
                                    body: ContratacionEnmiendaToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayEnmiendasPrint;
                }
                function printCDocs(data) {
                    ArrayECDocsPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayECDocsPrint.push(
                            { text: "\nDocumentos de la Contratación", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {

                                    widths: ['50%', '50%'],
                                    body: ContratacionDocsToPdf(data),
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },

                            { text: "\n\n\nInformación financiera\n\n", style: 'headerMain' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 150 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                        )
                    }
                    return ArrayECDocsPrint;
                }
                function printGestioContratos(data) {
                    ArrayGestioContratossPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayGestioContratossPrint.push(
                            { text: "\nRenegociaciones ", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {

                                    widths: ['16%', '16%', '16%', '16%', '16%', '16%'],
                                    body: ContratacionContratosToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayGestioContratossPrint;
                }
                function printDocsGestCont(data) {
                    ArrayDocsGestContPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayDocsGestContPrint.push(
                            { text: "\nDocumentos de la Renegociación", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {

                                    widths: ['50%', '50%'],
                                    body: ContratosDocsToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayDocsGestContPrint;
                }

                function basicImplementacion(data) {
                    ArrayImplementacionPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayImplementacionPrint.push(
                            { text: '\n\n\nImplementación\n\n', style: 'headerMain' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 150 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },
                            { text: "\nDatos de Contacto del Proveedor de Servicios", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {
                                    widths: ['20%', '20%', '20%', '20%', '20%'],
                                    body: [
                                        [{ text: "\nNombre", style: 'contenido2' }, { text: "\nDirección", style: 'contenido2' }, { text: "\nTeléfono Fijo", style: 'contenido2' }, { text: "\nCorreo Electrónico", style: 'contenido2' }, { text: "\nFecha de Inicio", style: 'contenido2' }],
                                        [data[0]['Nombres'], data[0]['direccion'], data[0]['telefono'], data[0]['email'], data[0]['fecha_inicio']],
                                    ],
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayImplementacionPrint;
                }
                function printInversiones(data) {
                    ArrayInversionesPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayInversionesPrint.push(
                            { text: "\nInversiones Realizadas", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {
                                    widths: ['25%', '25%', '25%', '25%'],
                                    body: PlanDesembolsosToPdf(data),
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayInversionesPrint;
                }
                function printHitosImplementacion(data) {
                    ArrayHitosImplementacionPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayHitosImplementacionPrint.push(
                            { text: "\nHitos de Implementación", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {
                                    widths: ['25%', '25%', '25%', '25%'],
                                    body: HitosImplementacionToPdf(data),
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayHitosImplementacionPrint;
                }
                function printTarifas(data) {
                    ArrayHTarifasPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayHTarifasPrint.push(
                            { text: "\nTarifas", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {
                                    widths: ['20%', '20%', '20%', '20%', '20%'],
                                    body: TarifasToPdf(data),
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayHTarifasPrint;
                }
                function printTransacciones(data) {
                    ArrayTransaccionesPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayTransaccionesPrint.push(
                            { text: "\nTransacciones", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {
                                    widths: ['20%', '20%', '20%', '20%', '20%'],
                                    body: TransaccionToPdf(data),
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayTransaccionesPrint;
                }
                function printDocsImplementacion(data) {
                    ArrayDocsImplementacionPrint = [];
                    if (sizeObject(data) > 0) {
                        ArrayDocsImplementacionPrint.push(
                            { text: "\nDocumentos de la Implementación", style: 'header' },
                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd", }] },

                            { text: "\n" },
                            {

                                table: {

                                    widths: ['50%', '50%'],
                                    body: ImplementacionDocToPdf(data)
                                },
                                layout: {
                                    fillColor: function (i, node) {
                                        return (i % 2 === 0) ? 'white' : null;
                                    },
                                    hLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    vLineColor: function (i, node) {
                                        return '#0984e3';
                                    },
                                    hLineWidth: function (i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function (i, node) {
                                        return 1;
                                    },
                                }
                            },
                        )
                    }
                    return ArrayDocsImplementacionPrint;
                }


                function docsToPdf(dataDocs) {

                    ArrayDocs = [];
                    ArrayDocs.push([
                        {
                            text: "\nTítulo",
                            style: 'contenido2'
                        },
                        {
                            text: "\nDescripción",
                            style: 'contenido2'
                        }]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayDocs.push(
                            [
                                {
                                    text: "\n" + row["title"],
                                    link: row["url"],
                                    style: "linkStyle"
                                },
                                {
                                    text: "\n" + row["description"]
                                }
                            ]);
                    });
                    return ArrayDocs;
                }
                function budgetToPdf(dataDocs) {

                    ArrayBudget = [];
                    ArrayBudget.push([
                        {
                            text: "\nMonto",
                            style: 'contenido2'
                        },
                        {
                            text: "\nMoneda",
                            style: 'contenido2'
                        },
                        {
                            text: "\nDescripción",
                            style: 'contenido2'
                        },
                        {
                            text: "\nFuente",
                            style: 'contenido2'
                        },
                    ]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayBudget.push(
                            [
                                { text: "\n" + Intl.NumberFormat().format(row["amount"], 2) },
                                { text: "\n" + row["currency"] },
                                { text: "\n" + row["description"] },
                                { text: "\n" + row["sourceParty_name"] },
                            ]);
                    });
                    return ArrayBudget;
                }

                function beneficiariosToPdf(dataDocs) {

                    ArrayBeneficiario = [];
                    ArrayBeneficiario.push([
                        {
                            text: "\nDepartamento",
                            style: 'contenido2'
                        },
                        {
                            text: "\nMunicipio",
                            style: 'contenido2'
                        },
                        {
                            text: "\nBeneficio",
                            style: 'contenido2'
                        },
                    ]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayBeneficiario.push(
                            [
                                { text: "\n" + row["a"] },
                                { text: "\n" + row["b"] },
                                { text: "\n" + row["c"] },
                            ]);
                    });
                    return ArrayBeneficiario;
                }
                function fuentesToPdf(dataDocs) {

                    ArrayFuentes = [];
                    ArrayFuentes.push([
                        {
                            text: "\nFuente de financiamiento",
                            style: 'contenido2'
                        },
                        {
                            text: "\nMonto",
                            style: 'contenido2'
                        },
                        {
                            text: "\nMoneda",
                            style: 'contenido2'
                        },
                        {
                            text: "\nTasa",
                            style: 'contenido2'
                        },
                    ]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayFuentes.push(
                            [
                                { text: "\n" + row["a"] },
                                { text: "\n" + Intl.NumberFormat().format(row["b"], 2) },
                                { text: "\n" + row["c"] },
                                { text: "\n" + row["d"] },
                            ]);
                    });
                    return ArrayFuentes;
                }

                function precalificacionToPdf(dataDocs) {
                    ArrayPrecalificacion = [];
                    ArrayPrecalificacion.push([
                        {
                            text: "\nFecha inicial",
                            style: 'contenido2'
                        },
                        {
                            text: "\nFecha Final",
                            style: 'contenido2'
                        },
                        {
                            text: "\nDuración en días",
                            style: 'contenido2'
                        },
                    ]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayPrecalificacion.push(
                            [
                                { text: "\n" + row["startDate"] },
                                { text: "\n" + row["endDate"] },
                                { text: "\n" + row["durationInDays"] },
                            ]);
                    });
                    return ArrayPrecalificacion;
                }

                function pronosticoToPdf(dataDocs) {

                    ArrayPronostico = [];
                    ArrayPronostico.push([
                        {
                            text: "\nTítulo",
                            style: 'contenido2'
                        },
                        {
                            text: "\nUnidad",
                            style: 'contenido2'
                        },
                        {
                            text: "\nMedida",
                            style: 'contenido2'
                        },
                        {
                            text: "\nMonto",
                            style: 'contenido2'
                        },
                    ]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayPronostico.push(
                            [
                                { text: "\n" + row["title"] },
                                { text: "\n" + row["unidad"] },
                                { text: "\n" + row["medida"] },
                                { text: "\n" + Intl.NumberFormat().format(row["obs_amount"], 2) },
                            ]);
                    });
                    return ArrayPronostico;
                }

                function pHitosToPdf(dataDocs) {

                    ArrayPHitos = [];
                    ArrayPHitos.push([
                        {
                            text: "\nTítulo",
                            style: 'contenido2'
                        },
                        {
                            text: "\nDue Date",
                            style: 'contenido2'
                        },
                        {
                            text: "\nDate Met",
                            style: 'contenido2'
                        },
                    ]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayPHitos.push(
                            [
                                { text: "\n" + row["title"] },
                                { text: "\n" + row["dueDate"] },
                                { text: "\n" + row["dateMet"] },
                            ]);
                    });
                    return ArrayPHitos;
                }

                function imprimirPlanificacion() {
                    var dataProyecto;
                    var dataProyectoDocs;
                    var dataBudget;
                    var dataBeneficiarios;
                    var dataFuentes;

                    var dataPronostico;
                    var dataPHitos;
                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BProyectoPdf");?>' + "&criterio=" + '<?php echo $valorIdProyecto?>',
                        success: function (data) {
                            dataProyecto = JSON.parse(data);
                            dataControlEtapa = '<?php echo $control ?>';
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BProyectoDocsPdf");?>' + "&criterio=" + '<?php echo $valorIdProyecto?>',
                        success: function (data) {
                            dataProyectoDocs = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BProyectoBudgetPdf");?>' + "&criterio=" + '<?php echo $valorIdProyecto?>',
                        success: function (data) {
                            dataBudget = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BProyectoBeneficiariosPdf");?>' + "&criterio=" + '<?php echo $valorIdProyecto?>',
                        success: function (data) {
                            dataBeneficiarios = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BProyectoFuentesPdf");?>' + "&criterio=" + '<?php echo $valorIdProyecto?>',
                        success: function (data) {
                            dataFuentes = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BProyectoPronosticoPdf");?>' + "&criterio=" + '<?php echo $valorIdProyecto?>',
                        success: function (data) {
                            dataPronostico = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BProyectoHitosPdf");?>' + "&criterio=" + '<?php echo $valorIdProyecto?>',
                        success: function (data) {
                            dataPHitos = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });



                    var logo = "<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/logo.png";
                    var logo2 = "<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/LOGO_GOB.png";
                    var docDefinitionProyecto = {
                        content: [
                            { image: "data:image/png;base64,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", width: 200 },

                            { canvas: [{ type: 'line', x1: 0, y1: 5, x2: 595 - 2 * 40, y2: 5, lineWidth: 0.1, lineColor: "#29a4dd" }] },
                            "\n\n",
                            printBasicProject(dataProyecto, dataControlEtapa),
                            basicProject2(dataProyecto),
                            printProjectDocs(dataProyectoDocs),
                            printBeneficiarios(dataBeneficiarios),
                            printFuentesFinanciamiento(dataFuentes),
                            printPresupuesto(dataBudget),
                            printPronostico(dataPronostico),
                            printHitos(dataPHitos),
                            printDatosFuncionarioProject(dataProyecto),


                            imprimirContratacion(),
                            //imprimirCalificacion(),
                            //imprimirAdjudicacion(),

                            imprimirImplementacion(),



                        ],

                        styles: {
                            header: {
                                fontSize: 15,

                                color: 'black',
                            },
                            headerMain: {
                                fontSize: 25,

                                color: 'black',
                            },
                            titulo: {
                                fontSize: 25,
                                bold: true,
                                color: '#29a4dd',
                            },
                            contenido: {
                                fontSize: 12,
                                alignment: 'justify',
                            },
                            contenido2: {
                                fontSize: 12,
                                bold: true,
                                alignment: 'center',
                            },
                            linkStyle: {
                                fontSize: 12,
                                color: 'blue',
                                underline: true,
                            },


                        }
                    };
                    return docDefinitionProyecto;

                }
                function oferentesToPdf(dataDocs) {
                    var numeroLinea = 1;
                    ArrayOferentes = [];
                    ArrayOferentes.push([
                        {
                            text: "\nNo.",
                            style: 'contenido2'
                        },
                        {
                            text: "\nNombre de los Oferentes",
                            style: 'contenido2'
                        },
                    ]
                    );
                    dataDocs.forEach(function (row) {
                        ArrayOferentes.push(
                            [
                                { text: "\n" + numeroLinea.toString() },
                                { text: "\n" + row["a"] },
                            ]);
                        numeroLinea = numeroLinea + 1;
                    });
                    return ArrayOferentes;
                }

                function CalificacionDocsToPdf(dataDocs) {

                    ArrayDocs = [];
                    ArrayDocs.push([
                        {
                            text: "\nTítulo",
                            style: 'contenido2'
                        },
                        {
                            text: "\nDescripción",
                            style: 'contenido2'
                        }]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayDocs.push(
                            [
                                {
                                    text: "\n" + row["title"],
                                    link: row["url"],
                                    style: "linkStyle"
                                },
                                {
                                    text: "\n" + row["description"]
                                }
                            ]);
                    });
                    return ArrayDocs;
                }

                function AdjudicacionDocsToPdf(dataDocs) {

                    ArrayDocs = [];
                    ArrayDocs.push([
                        {
                            text: "\nTítulo",
                            style: 'contenido2'
                        },
                        {
                            text: "\nDescripción",
                            style: 'contenido2'
                        }]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayDocs.push(
                            [
                                {
                                    text: "\n" + row["title"],
                                    link: row["url"],
                                    style: "linkStyle"
                                },
                                {
                                    text: "\n" + row["description"]
                                }
                            ]);
                    });
                    return ArrayDocs;
                }
                function AdjudicacionOferentesPreferidosToPdf(dataDocs) {

                    ArrayOferentesPreferidos = [];
                    ArrayOferentesPreferidos.push([
                        {
                            text: "\nOferentes",
                            style: 'contenido2'
                        }]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayOferentesPreferidos.push(
                            [

                                { text: "\n" + row["legalName"] }

                            ]);
                    });
                    return ArrayOferentesPreferidos;
                }
                function ContratacionFirmantesToPdf(dataDocs) {

                    ArrayContratacionFirmantes = [];
                    ArrayContratacionFirmantes.push([
                        {
                            text: "\nFirmantes",
                            style: 'contenido2'
                        }]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayContratacionFirmantes.push(
                            [

                                { text: "\n" + row["parties_name"] }

                            ]);
                    });
                    return ArrayContratacionFirmantes;
                }

                function ContratacionOrganizacionToPdf(dataDocs) {

                    ArrayContratacionOrganizacion = [];
                    ArrayContratacionOrganizacion.push([
                        {
                            text: "\nOrganización",
                            style: 'contenido2'
                        }]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayContratacionOrganizacion.push(
                            [

                                { text: "\n" + row["legalName"] }

                            ]);
                    });
                    return ArrayContratacionOrganizacion;
                }

                function ContratacionAccionistaToPdf(dataDocs) {

                    ArrayContratacionAccionista = [];
                    ArrayContratacionAccionista.push(
                        [
                            { text: "\nNombre", style: 'contenido2' },
                            { text: "\nDerechos de Votación", style: 'contenido2' },
                            { text: "\nDetalles del derecho de votación", style: 'contenido2' },
                            { text: "\nAccionado", style: 'contenido2' },
                        ]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayContratacionAccionista.push(
                            [

                                { text: "\n" + row["shareholder_name"] },
                                { text: "\n" + row["votingRights"] },
                                { text: "\n" + row["votingRightsDetails"] },
                                { text: "\n" + row["shareholding"] },

                            ]);
                    });
                    return ArrayContratacionAccionista;
                }

                function ContratacionGovGarantiaToPdf(dataDocs) {

                    ArrayContratacionGovGarantia = [];
                    ArrayContratacionGovGarantia.push(
                        [
                            { text: "\nTítulo", style: 'contenido2' },
                            { text: "\nCategoria de Financiación", style: 'contenido2' },
                            { text: "\nFecha Inicio", style: 'contenido2' },
                            { text: "\nFecha Final", style: 'contenido2' },
                            { text: "\nMonto", style: 'contenido2' },
                            { text: "\nMoneda", style: 'contenido2' },
                        ]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayContratacionGovGarantia.push(
                            [

                                { text: "\n" + row["title"] },
                                { text: "\n" + row["financeCategory"] },
                                { text: "\n" + row["startDate"] },
                                { text: "\n" + row["endDate"] },
                                { text: "\n" + Intl.NumberFormat().format(row["amount"], 2) },
                                { text: "\n" + row["currency"] },

                            ]);
                    });
                    return ArrayContratacionGovGarantia;
                }

                function ContratacionRiskToPdf(dataDocs) {

                    ArrayContratacionRisk = [];
                    ArrayContratacionRisk.push(
                        [
                            { text: "\nDescripción", style: 'contenido2' },
                            { text: "\nResponsable", style: 'contenido2' },
                        ]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayContratacionRisk.push(
                            [

                                { text: "\n" + row["description"] },
                                { text: "\n" + row["legalName"] },

                            ]);
                    });
                    return ArrayContratacionRisk;
                }

                function ContratacionRatioToPdf(dataDocs) {

                    ArrayContratacionRatio = [];
                    ArrayContratacionRatio.push(
                        [
                            { text: "\nEquidad de capital de la deuda", style: 'contenido2' },
                            { text: "\nCantidad del capital social", style: 'contenido2' },
                            { text: "\nMoneda del capital social", style: 'contenido2' },
                            { text: "\nDetalles de la razón de la equidad de la deuda", style: 'contenido2' },
                            { text: "\nRelación de subsidio", style: 'contenido2' },
                        ]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayContratacionRatio.push(
                            [

                                { text: "\n" + row["debtEquityRatio"] },
                                { text: "\n" + Intl.NumberFormat().format(row["shareCapital_amount"], 2) },
                                { text: "\n" + row["shareCapital_currency"] },
                                { text: "\n" + row["debtEquityRatioDetails"] },
                                { text: "\n" + row["subsidyRatio"] },

                            ]);
                    });
                    return ArrayContratacionRatio;
                }

                function ContratacionIrrToPdf(dataDocs) {

                    ArrayContratacionIrr = [];
                    ArrayContratacionIrr.push(
                        [
                            { text: "\nTítulo", style: 'contenido2' },
                            { text: "\nDescripción", style: 'contenido2' },
                            { text: "\nDuración de periodo en días", style: 'contenido2' },
                        ]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayContratacionIrr.push(
                            [

                                { text: "\n" + row["title"] },
                                { text: "\n" + row["description"] },
                                { text: "\n" + row["period_durationInDays"] },

                            ]);
                    });
                    return ArrayContratacionIrr;
                }

                function ContratacionShareCapitalToPdf(dataDocs) {

                    ArrayContratacionShareCapital = [];
                    ArrayContratacionShareCapital.push(
                        [
                            { text: "\nRatio de capital de la deuda", style: 'contenido2' },
                            { text: "\nMonto del capital compartido", style: 'contenido2' },
                            { text: "\nMoneda del capital compartido", style: 'contenido2' },
                        ]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayContratacionShareCapital.push(
                            [

                                { text: "\n" + row["debtEquityRatio"] },
                                { text: "\n" + Intl.NumberFormat().format(row["shareCapital_amount"], 2) },
                                { text: "\n" + row["shareCapital_currency"] },

                            ]);
                    });
                    return ArrayContratacionShareCapital;
                }

                function ContratacionEnmiendaToPdf(dataDocs) {

                    ArrayContratacionEnmienda = [];
                    ArrayContratacionEnmienda.push(
                        [
                            { text: "\nDescripción", style: 'contenido2' },
                            { text: "\nFecha", style: 'contenido2' },
                            { text: "\nRazón", style: 'contenido2' },
                        ]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayContratacionEnmienda.push(
                            [

                                { text: "\n" + row["description"] },
                                { text: "\n" + row["date"] },
                                { text: "\n" + row["rationale"] },

                            ]);
                    });
                    return ArrayContratacionEnmienda;
                }

                function ContratacionDocsToPdf(dataDocs) {

                    ArrayCDocs = [];
                    ArrayCDocs.push([
                        {
                            text: "\nTítulo",
                            style: 'contenido2'
                        },
                        {
                            text: "\nDescripción",
                            style: 'contenido2'
                        }]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayCDocs.push(
                            [
                                {
                                    text: "\n" + row["title"],
                                    link: row["url"],
                                    style: "linkStyle"
                                },
                                {
                                    text: "\n" + row["description"]
                                }
                            ]);
                    });
                    return ArrayCDocs;
                }

                function ContratacionContratosToPdf(dataDocs) {

                    ArrayContratacionContratos = [];
                    ArrayContratacionContratos.push(
                        [
                            { text: "\nNúmero de modificación", style: 'contenido2' },
                            { text: "\nFecha de modificación del contrato", style: 'contenido2' },
                            { text: "\nTipo de modificación", style: 'contenido2' },
                            { text: "\nJustificación de contrato", style: 'contenido2' },
                            { text: "\nCambio en el precio original del contrato", style: 'contenido2' },
                            { text: "\nAlcance actual del contrato", style: 'contenido2' },
                        ]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayContratacionContratos.push(
                            [

                                { text: "\n" + row["nmodifica"] },
                                { text: "\n" + row["fecha"] },
                                { text: "\n" + row["tipomodifica"] },
                                { text: "\n" + row["justimodcontrato"] },
                                { text: "\n" + Intl.NumberFormat().format(row["precioactual"], 2) },
                                { text: "\n" + row["alcanceactucontrato"] },
                            ]);
                    });
                    return ArrayContratacionContratos;
                }

                function ContratosDocsToPdf(dataDocs) {

                    ArrayContratosDocs = [];
                    ArrayContratosDocs.push([
                        {
                            text: "\nTítulo",
                            style: 'contenido2'
                        },
                        {
                            text: "\nDescripción",
                            style: 'contenido2'
                        }]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayContratosDocs.push(
                            [
                                {
                                    text: "\n" + row["title"],
                                    link: row["url"],
                                    style: "linkStyle"
                                },
                                {
                                    text: "\n" + row["description"]
                                }
                            ]);
                    });
                    return ArrayContratosDocs;
                }

                function PlanDesembolsosToPdf(dataDocs) {

                    ArrrayPlanDesembolsos = [];
                    ArrrayPlanDesembolsos.push(
                        [
                            { text: "\nNúmero", style: 'contenido2' },
                            { text: "\nDescripción", style: 'contenido2' },
                            { text: "\nMonto", style: 'contenido2' },
                            { text: "\nFecha desembolso", style: 'contenido2' },
                        ]
                    )
                    dataDocs.forEach(function (row) {
                        ArrrayPlanDesembolsos.push(
                            [

                                { text: "\n" + row["desembolso"] },
                                { text: "\n" + row["descripcion"] },
                                { text: "\n" + Intl.NumberFormat().format(row["monto"], 2) },
                                { text: "\n" + row["fecha_desembolso"] },
                            ]);
                    });
                    return ArrrayPlanDesembolsos;
                }

                function HitosImplementacionToPdf(dataDocs) {

                    ArrrayHitosImplementacion = [];
                    ArrrayHitosImplementacion.push(
                        [
                            { text: "\nTítulo", style: 'contenido2' },
                            { text: "\nDescripción", style: 'contenido2' },
                            { text: "\nFecha Prometida", style: 'contenido2' },
                            { text: "\nFecha Entrega", style: 'contenido2' },
                        ]
                    )
                    dataDocs.forEach(function (row) {
                        ArrrayHitosImplementacion.push(
                            [

                                { text: "\n" + row["title"] },
                                { text: "\n" + row["description"] },
                                { text: "\n" + row["dueDate"] },
                                { text: "\n" + row["dateMet"] },
                            ]);
                    });
                    return ArrrayHitosImplementacion;
                }

                function TarifasToPdf(dataDocs) {

                    ArrayTarifas = [];
                    ArrayTarifas.push(
                        [
                            { text: "\nTítulo", style: 'contenido2' },
                            { text: "\nNotas", style: 'contenido2' },
                            { text: "\nDimensiones", style: 'contenido2' },
                            { text: "\nMonto", style: 'contenido2' },
                            { text: "\nMoneda", style: 'contenido2' },
                        ]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayTarifas.push(
                            [
                                { text: "\n" + row["tittle"] },
                                { text: "\n" + row["notes"] },
                                { text: "\n" + row["dimensions"] },
                                { text: "\n" + Intl.NumberFormat().format(row["amount"], 2) },
                                { text: "\n" + row["currency"] },
                            ]);
                    });
                    return ArrayTarifas;
                }

                function TransaccionToPdf(dataDocs) {

                    ArrayTransaccion = [];
                    ArrayTransaccion.push(
                        [
                            { text: "\nFecha", style: 'contenido2' },
                            { text: "\nNombre de Pagador", style: 'contenido2' },
                            { text: "\nNombre del Beneficiario", style: 'contenido2' },
                            { text: "\nMonto", style: 'contenido2' },
                            { text: "\nMoneda", style: 'contenido2' },
                        ]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayTransaccion.push(
                            [

                                { text: "\n" + row["date"] },
                                { text: "\n" + row["payer_name"] },
                                { text: "\n" + row["payee_name"] },
                                { text: "\n" + Intl.NumberFormat().format(row["amount"], 2) },
                                { text: "\n" + row["currency"] },
                            ]);
                    });
                    return ArrayTransaccion;
                }

                function ImplementacionDocToPdf(dataDocs) {

                    ArrayImplementacionDoc = [];
                    ArrayImplementacionDoc.push([
                        {
                            text: "\nTítulo",
                            style: 'contenido2'
                        },
                        {
                            text: "\nDescripción",
                            style: 'contenido2'
                        }]
                    )
                    dataDocs.forEach(function (row) {
                        ArrayImplementacionDoc.push(
                            [
                                {
                                    text: "\n" + row["title"],
                                    link: row["url"],
                                    style: "linkStyle"
                                },
                                {
                                    text: "\n" + row["description"]
                                }
                            ]);
                    });
                    return ArrayImplementacionDoc;
                }


                function imprimirCalificacion() {
                    var docDefinitionCalificacion = [];
                    var dataCalificacion;
                    var dataOferentes;
                    var dataCalificacionDocs;
                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BCalificacionPdf");?>' + "&criterio=" + '<?php echo $valorIdCalificacion?>',
                        success: function (data) {
                            dataCalificacion = JSON.parse(data);
                            //console.log(dataCalificacion.length);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });
                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BOferentesPdf");?>' + "&criterio=" + '<?php echo $valorIdCalificacion?>',
                        success: function (data) {
                            dataOferentes = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BCalificacionDocsPdf");?>' + "&criterio=" + '<?php echo $valorIdCalificacion?>',
                        success: function (data) {
                            dataCalificacionDocs = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    docDefinitionCalificacion.push(
                        basicCalificacion(dataCalificacion),

                        printOferentesParticipantes(dataOferentes),
                        printDocsCalificacion(dataCalificacionDocs),
                        printFuncionarioCalificacion(dataCalificacion)
                    );
                    return docDefinitionCalificacion;
                }

                function imprimirAdjudicacion() {
                    var docDefinitionAdjudicacion = [];
                    var dataAdjudicacion;
                    var dataAdjudicacionDocs;
                    var dataOferentesPreferidos;
                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BAdjudicacionPdf");?>' + "&criterio=" + '<?php echo $valorIdAdjudicacion?>',
                        success: function (data) {
                            dataAdjudicacion = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BAdjudicacionDocsPdf");?>' + "&criterio=" + '<?php echo $valorIdAdjudicacion?>',
                        success: function (data) {
                            dataAdjudicacionDocs = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BAdjudicacionOferentesPreferidosPdf");?>' + "&criterio=" + '<?php echo $valorIdAdjudicacion?>',
                        success: function (data) {
                            dataOferentesPreferidos = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    docDefinitionAdjudicacion.push(
                        basicAdjudicacion(dataAdjudicacion),
                        printDocsAdjudicacion(dataAdjudicacionDocs),
                        printOferentesPreferidos(dataOferentesPreferidos),
                    );
                    return docDefinitionAdjudicacion;
                }

                function imprimirContratacion() {
                    var docDefinitionContratacion = [];
                    var dataContratacion;
                    var dataContratacionDocs;
                    var dataFirmantes;
                    var dataOrganizacion;
                    var dataAccionista;
                    var dataPrestamista;
                    var dataGovGarantia;
                    var dataRisk;
                    var dataRatio;
                    var dataIrr;
                    var dataShareCapital;
                    var dataEnmienda;
                    var dataContratos;
                    var dataContratosDocs;
                    var dataPrecalificacion;
                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
                        success: function (data) {
                            dataContratacion = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionFirmantesPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
                        success: function (data) {
                            dataFirmantes = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionOrganizacionPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
                        success: function (data) {
                            dataOrganizacion = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionAccionistasPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
                        success: function (data) {
                            dataAccionista = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionPrestamistaPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
                        success: function (data) {
                            dataPrestamista = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionGovGarantiaPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
                        success: function (data) {
                            dataGovGarantia = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionRiskPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
                        success: function (data) {
                            dataRisk = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionRatioPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
                        success: function (data) {
                            dataRatio = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionIrrPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
                        success: function (data) {
                            dataIrr = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionShareCapitalPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
                        success: function (data) {
                            dataShareCapital = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionEnmiendaPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
                        success: function (data) {
                            dataEnmienda = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BContratacionDocsPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
                        success: function (data) {
                            dataContratacionDocs = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BContratosPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
                        success: function (data) {
                            dataContratos = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BContratoDocsPdf");?>' + "&criterio=" + '<?php echo $valorIdContratacion?>',
                        success: function (data) {
                            dataContratosDocs = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BProyectoPrecalificacionPdf");?>' + "&criterio=" + '<?php echo $valorIdProyecto?>',
                        success: function (data) {
                            dataPrecalificacion = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });
                    docDefinitionContratacion.push(
                        printPreCalificacion(dataPrecalificacion),
                        imprimirCalificacion(),
                        imprimirAdjudicacion(),
                        basicContratacion(dataContratacion),
                        printCDocs(dataContratacionDocs),
                        printGarantiaGovierno(dataGovGarantia),
                        printRiesgos(dataRisk),
                        printRatio(dataRatio),
                        printTir(dataIrr),
                        printCapitalCompartido(dataShareCapital),
                        printFirmantes(dataFirmantes),
                        printDetallesOrganizacion(dataOrganizacion),
                        printAccionista(dataAccionista),
                        printPrestamista(dataPrestamista),
                        printEnmiendas(dataEnmienda),
                        printGestioContratos(dataContratos),
                        printDocsGestCont(dataContratosDocs),




                    );
                    return docDefinitionContratacion;
                }

                function imprimirImplementacion() {
                    var docDefinitionImplementacion = [];
                    var dataImplementacion;
                    var dataPlanDesembolsos;
                    var dataHitosImplementacion;
                    var dataTarifas;
                    var dataTransaccion;
                    var dataImplementacionDoc;

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BImplementacionContactoPdf");?>' + "&criterio=" + '<?php  echo $valorIdInicioEjecucion;?>',
                        success: function (data) {
                            dataImplementacion = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });


                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BPlanDesembolsoPdf");?>' + "&criterio=" + '<?php  echo $valorIdInicioEjecucion;?>',
                        success: function (data) {
                            dataPlanDesembolsos = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BHitosImplementacionPdf");?>' + "&criterio=" + '<?php  echo $valorIdInicioEjecucion;?>',
                        success: function (data) {
                            dataHitosImplementacion = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BTarifasPdf");?>' + "&criterio=" + '<?php  echo $valorIdInicioEjecucion;?>',
                        success: function (data) {
                            dataTarifas = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BTransaccionPdf");?>' + "&criterio=" + '<?php  echo $valorIdInicioEjecucion;?>',
                        success: function (data) {
                            dataTransaccion = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '<?php echo CController::createUrl("/Ciudadano/BImplementacionDocPdf");?>' + "&criterio=" + '<?php  echo $valorIdInicioEjecucion;?>',
                        success: function (data) {
                            dataImplementacionDoc = JSON.parse(data);
                        },
                        error: function (data) { // if error occured
                            console.log("Error");
                        },
                        dataType: 'html'
                    });

                    docDefinitionImplementacion.push(
                        basicImplementacion(dataImplementacion),
                        printInversiones(dataPlanDesembolsos),
                        printHitosImplementacion(dataHitosImplementacion),
                        printTarifas(dataTarifas),
                        printTransacciones(dataTransaccion),
                        printDocsImplementacion(dataImplementacionDoc),

                    );
                    return docDefinitionImplementacion;
                }
                function imprimirFicha() {
                    alert("Asegurece que las ventanas emergentes no esten bloqueadas para este sitio");
                    var docDefinition = imprimirPlanificacion();

                    pdfMake.createPdf(docDefinition).open();

                }
            </script>
