<style type="text/css">
    .specialFilter select {
        max-width: 200px;
    }

    .custom-control {
        position: relative;
        display: -webkit-inline-box;
        display: -webkit-inline-flex;
        display: -ms-inline-flexbox;
        display: inline-flex;
        min-height: 1.5rem;
        padding-left: 1.5rem;
        margin-right: 1rem;
        cursor: pointer;
    }

    .custom-control-input {
        position: absolute;
        z-index: -1;
        opacity: 0;
    }

    .custom-control-input:checked~.custom-control-indicator {
        color: #fff;
        background-color: #0275d8;
    }

    .custom-control-input:focus~.custom-control-indicator {
        -webkit-box-shadow: 0 0 0 1px #fff, 0 0 0 3px #0275d8;
        box-shadow: 0 0 0 1px #fff, 0 0 0 3px #0275d8;
    }

    .custom-control-input:active~.custom-control-indicator {
        color: #fff;
        background-color: #8fcafe;
    }

    .custom-control-input:disabled~.custom-control-indicator {
        cursor: not-allowed;
        background-color: #eceeef;
    }

    .custom-control-input:disabled~.custom-control-description {
        color: #636c72;
        cursor: not-allowed;
    }

    .custom-control-indicator {
        position: absolute;
        top: 0.25rem;
        left: 0;
        display: block;
        width: 1rem;
        height: 1rem;
        pointer-events: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: #ddd;
        background-repeat: no-repeat;
        background-position: center center;
        -webkit-background-size: 50% 50%;
        background-size: 50% 50%;
    }

    .custom-checkbox .custom-control-indicator {
        border-radius: 0.25rem;
    }

    .custom-checkbox .custom-control-input:checked~.custom-control-indicator {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3E%3C/svg%3E");
    }

    .custom-checkbox .custom-control-input:indeterminate~.custom-control-indicator {
        background-color: #0275d8;
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 4'%3E%3Cpath stroke='%23fff' d='M0 2h4'/%3E%3C/svg%3E");
    }

    .custom-radio .custom-control-indicator {
        border-radius: 50%;
    }

    .custom-radio .custom-control-input:checked~.custom-control-indicator {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3E%3Ccircle r='3' fill='%23fff'/%3E%3C/svg%3E");
    }

    .custom-controls-stacked {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
    }

    .custom-controls-stacked .custom-control {
        margin-bottom: 0.25rem;
    }

    .custom-controls-stacked .custom-control+.custom-control {
        margin-left: 0;
    }
</style>
<script type="text/javascript">
    function listaProyectoLoadAll() {
        window.selectedDepartments = [];
        window.seletedEtapa = [];
        window.selectedSector = [];
        window.selectedTC= [];
        buildActiveFilters();
        $("input[name='sector-checkbox']").prop('checked', false);
        $("input[name='etapa-checkbox']").prop('checked', false);
        $("input[name='departamento-checkbox']").prop('checked', false);
        $("input[name='TC-checkbox']").prop('checked', false);
        $("#LblMunicipio").html("Todos los proyectos");
        $.ajax({
            type: 'POST',
            url: '<?php echo CController::createUrl("Ciudadano/GetMonto"); ?>',
            dataType: "json",
            data: {
                "id": 'TODO'
            },
            success: function (data) {
                $('#contract-amount-counter').text("LPS " + data.TOTAL + " M");
                $('#contract-usd-amount-counter').text("USD " + data.TOTAL_USD + " M");
            },
            error: function (data) {
            }
        });
        jQuery.ajax({
            'type': 'POST', 'data': { 'id': 'TODOS' }, 'url': 'index.php?r=Ciudadano/BMapa', 'cache': false, 'success': function (html) { jQuery("#proyectos").html(html) }
        });
    }
    function listaTC() {
        $.ajax({
            type: 'POST',
            url: '<?php echo CController::createUrl("Ciudadano/GetMonto"); ?>',
            dataType: "json",
            data: {
                "id": 'FIDEICOMISO'
            },
            success: function (data) {
                $('#contract-amount-counter').text("LPS " + data.TOTAL + " M");
                $('#contract-usd-amount-counter').text("USD " + data.TOTAL_USD + " M");
            },
            error: function (data) {
            }
        });
        jQuery.ajax({
            'type': 'POST', 'data': { 'id': 'TC' }, 'url': 'index.php?r=Ciudadano/BMapa', 'cache': false, 'success': function (html) { jQuery("#proyectos").html(html) }
        });
    }
</script>
<?php
    /* @var $this CiudadanoController */

    $this->breadcrumbs=array(
        'Ciudadano',
    );
    Yii::app()->clientScript->registerCoreScript('jquery');
    //Yii::app()->clientScript->registerScriptFile("assets/bootstrap/js/bootstrap.min.js");
    //Yii::app()->clientScript->registerCssFile("assets/bootstrap/css/bootstrap.min.css");
    ?>

    <?php

    $command = Yii::app()->db->createCommand("CALL sp_portal_indicadores();");
    $ind = $command->queryAll();

    ?>

        <div id="slider_Pro" class="slider-pro">
            <div class="sp-slides">
                <?php
                    $sql     = 'SELECT * FROM cs_slides_images';
                    $command = Yii::app()->db->createCommand($sql);
                    $generidData      = $command->queryAll();
                    $total_x=count($generidData);
                    $row=0;
                    if ($total_x == 0) {
                        $generidData = [
                            [
                                "url" => "themes/blackboot/assets/img/slide5.jpg",
                                "title"=> "Consorcio Siglo XXI",
                                "description" => "Primera Alianza Público Privada en San Pedro Sula"
                            ]
                        ];
                        $total_x=count($generidData);
                    }
                    while ($row< $total_x) {
                        ?>
                    <div class="sp-slide">
                        <img class="sp-image" src=<?php echo $generidData[$row] [ 'url']; ?> data-retina=
                        <?php echo $generidData[$row] ['url']; ?> />'
                        <div class="smart-slider-canvas-inner">
                            <div class="sp-layer sp-static">
                                <img class="sp-image" src=<?php echo Yii::app()->baseUrl."/themes/blackboot/assets/img/logo.png"?> />
                            </div>

                            <h3 class="sp-layer sp-black" data-position="centerCenter" data-horizontal="10%" data-show-transition="right" data-show-delay="500">
                                <?php echo $generidData[$row] ['title']; ?>
                            </h3>

                            <p class="sp-layer sp-white sp-padding" data-position="centerCenter" data-vertical="40%" data-show-transition="left" data-show-delay="700">
                                <?php echo $generidData[$row] ['description']; ?>
                            </p>
                        </div>
                    </div>
                    <?php
                        $row++;
                    }
                ?>
            </div>
        </div>

        <!-- Service Block-1 Section -->
        <section id="service-block-main" class="section">
            <!-- Container Starts -->
            <div class="container">
                <div class="row">
                    <h1 class="section-title wow fadeIn animated" data-wow-delay=".2s">
                        Proyectos
                    </h1>
                    <hr style="border-top: 2px solid #29a4dd;width:5%;">
                    <!--<div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="coolBox">
                            <h5>
                                <strong style="font-size:.8em">Total de Proyectos:</strong>
                                <label style="float:right;font-size:.8em">
                                    <?php echo $ind[0]['proyectos']; ?>
                                </label>
                            </h5>
                        </div>
                    </div>-->
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="coolBox" style="float:right">
                            <h5>
                                <strong style="font-size:.8em">Monto total de contratos:</strong>
                                <label style="float:right;font-size:.8em">USD.
                                    <?php echo number_format(($ind[0]['contratadoUSD']/1000000), 2)." M";?>
                                </label>
                            </h5>
                        </div>
                    </div>
                    -->

                </div>
                <!-- Map-->
                <div class="row" style="margin:0 auto">
                    <div class="col-md-3 col-lg-3 col-sm-5 col-xs-12 mapColor" id="borderBox" style="border:none">
                        <h4 class="specialTitle wow fadeIn animated">Mapa</h4>
                        <hr style="border-top: 1px solid #29a4dd;">
                        <div id="chartdiv" class="chartdiv"></div>
                        <div id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="buttonFideicomisos">
                                <!-- <button class="btn btn-info homeFideo" onClick="listaFideicomiso()"> <h5>Fideicomisos</h5> </button> -->
                            </div>
                            <!--<div class="">
                                <button style="margin-bottom: 0.5vh;width: 100%;/* float:right; */" class="btn btn-info" onClick="listaProyectoLoadAll()">Listar todos los proyectos </button>
                            </div>
                            -->
                            <div class="accordion-title">
                                <div class="card-header" role="tab" id="headingOne">
                                    <h5 class="mb-0">
                                        <div data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <div style="float:left;" class="icon-holder">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </div>
                                            <span style="padding-left: 40px;">Departamento</span>

                                        </div>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="">
                                        <ul class="list-group">
                                            <?php
                                        $departmentName = [
                                            "HN-FM" => "Francisco Morazán",
                                            "HN-IB" => "Islas de la Bahía",
                                            "HN-CR" => "Cortés",
                                            "HN-AT" => "Atlántida",
                                            "HN-CL" => "Colón",
                                            "HN-GD" => "Gracias a Dios",
                                            "HN-OL" => "Olancho",
                                            "HN-EP" => "El Paraíso",
                                            "HN-YO" => "Yoro",
                                            "HN-CM" => "Comayagua",
                                            "HN-CH" => "Choluteca",
                                            "HN-VA" => "Valle",
                                            "HN-LP" => "La Paz",
                                            "HN-IN" => "Intibucá",
                                            "HN-LE" => "Lempira",
                                            "HN-OC" => "Ocotepeque",
                                            "HN-CP" => "Copán",
                                            "HN-SB" => "Santa Bárbara"
                                        ];

                                        $listDepartamento = [
                                            "HN-FM" => "08",
                                            "HN-IB" => "11",
                                            "HN-CR" => "05",
                                            "HN-AT" => "01",
                                            "HN-CL" => "02",
                                            "HN-GD" => "09",
                                            "HN-OL" => "15",
                                            "HN-EP" => "07",
                                            "HN-YO" => "18",
                                            "HN-CM" => "03",
                                            "HN-CH" => "06",
                                            "HN-VA" => "17",
                                            "HN-LP" => "12",
                                            "HN-IN" => "10",
                                            "HN-LE" => "13",
                                            "HN-OC" => "14",
                                            "HN-CP" => "04",
                                            "HN-SB" => "16"
                                        ];
                                        foreach ($listDepartamento as $key => $value):
                                            echo '<li class="list-group-item" style="border: 0px;border-bottom: 1px solid #f5f5f5;">';
                                            echo '<label class="custom-control custom-checkbox">';
                                            echo '<input id="checkbox'.$key.'" type="checkbox" class="custom-control-input" value="'.$value.'" name="departamento-checkbox">';
                                            echo '<span class="custom-control-indicator"></span>';
                                            echo '<span class="custom-control-description">'.$departmentName[$key].'</span>';
                                            echo '</label>';
                                            echo '</li>';
                                        endforeach;
                                    ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-title">
                                <div class="card-header" role="tab" id="headingOne">
                                    <h5 class="mb-0">
                                        <div data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                            <div style="float:left;" class="icon-holder">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </div>
                                            <span style="padding-left: 40px;">Sector</span>

                                        </div>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="">
                                        <ul class="list-group">
                                            <?php
                                        $listSector = Yii::app()->controller->listarSectores();
                                        $id = 1;
                                        foreach ($listSector as $obj):
                                            echo '<li class="list-group-item" style="border: 0px;border-bottom: 1px solid #f5f5f5;">';
                                            echo '<label class="custom-control custom-checkbox" style="margin-bottom: 0px">';
                                            echo '<input id="checkboxSector'.$id.'" type="checkbox" class="custom-control-input" value="'.$obj["sector"].'" name="sector-checkbox">';
                                            echo '<span class="custom-control-indicator"></span>';
                                            echo '<span class="custom-control-description">'.$obj["sector"].'</span>';
                                            echo '</label>';
                                            echo '</li>';
                                            $id++;
                                        endforeach;
                                    ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-title">
                                <div class="card-header" role="tab" id="headingOne" style="border:none">
                                    <h5 class="mb-0">
                                        <div data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                            <div style="float:left;" class="icon-holder">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </div>
                                            <span style="padding-left: 40px;">Etapa</span>
                                        </div>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="ulContainerHome">
                                        <ul class="list-group" style="margin-top:10px">
                                            <li class="list-group-item" style="border: 0px;border-bottom: 1px solid #f5f5f5;">
                                                <label class="custom-control custom-checkbox" style="margin-bottom: 0px;">
                                                    <input id="checkboxEtapa1" type="checkbox" class="custom-control-input" value='Estructuración' name="etapa-checkbox">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">Estructuración</span>
                                                </label>
                                            </li>
                                            <li class="list-group-item" style="border: 0px;border-bottom: 1px solid #f5f5f5;">
                                                <label class="custom-control custom-checkbox"  style="margin-bottom: 0px;">
                                                    <input id="checkboxEtapa2" type="checkbox" class="custom-control-input" value='Calificación' name="etapa-checkbox">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">Calificación</span>
                                                </label>
                                            </li>
                                            <li class="list-group-item" style="border: 0px;border-bottom: 1px solid #f5f5f5;">
                                                <label class="custom-control custom-checkbox" style="margin-bottom: 0px;" >
                                                    <input id="checkboxEtapa3" type="checkbox" class="custom-control-input" value='Adjudicación' name="etapa-checkbox">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">Adjudicación</span>
                                                </label>
                                            </li>
                                            <li class="list-group-item" style="border: 0px;border-bottom: 1px solid #f5f5f5;">
                                                <label class="custom-control custom-checkbox"  style="margin-bottom: 0px;">
                                                    <input id="checkboxEtapa4" type="checkbox" class="custom-control-input" value='Contratación' name="etapa-checkbox">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">Contratación</span>
                                                </label>
                                            </li>
                                            <li class="list-group-item" style="border: 0px;border-bottom: 1px solid #f5f5f5;">
                                                <label class="custom-control custom-checkbox"  style="margin-bottom: 0px;">
                                                    <input id="checkboxEtapa5" type="checkbox" class="custom-control-input" value='Implementación' name="etapa-checkbox">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">Implementación</span>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-title">
                                <div class="card-header" role="tab" id="headingOne">
                                    <h5 class="mb-0">
                                        <div data-toggle="collapse" data-parent="#accordion" href="#collapseTC" aria-expanded="true" aria-controls="collapseTC">
                                            <div style="float:left;" class="icon-holder">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </div>
                                            <span style="padding-left: 40px;">Tipos de contrato</span>
                                        </div>
                                    </h5>
                                </div>
                                <div id="collapseTC" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="ulContainerHome">
                                        <ul class="list-group" style="margin-top:10px">
                                            <?php
                                                $listadoTiposContratos = Yii::app()->controller->listaTipoContrato();
                                                $id = 1;
                                                foreach ($listadoTiposContratos as $obj):
                                                    echo '<li class="list-group-item" style="border: 0px;border-bottom: 1px solid #f5f5f5;">';
                                                    echo '<label class="custom-control custom-checkbox" style="margin-bottom: 0px">';
                                                    echo '<input id="checkboxTC'.$id.'" type="checkbox" class="custom-control-input" value="'.$obj["contrato"].'" name="TC-checkbox">';
                                                    echo '<span class="custom-control-indicator"></span>';
                                                    echo '<span class="custom-control-description">'.$obj["contrato"].'</span>';
                                                    echo '</label>';
                                                    echo '</li>';
                                                    $id++;
                                                endforeach;
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Table-->
                    <div class="col-md-9 col-lg-9 col-sm-7 col-xs-12 tableColor" id="borderBox" style="border:none">
                        <h4 class="specialTitle wow fadeIn animated" data-wow-delay=".2s">
                            Lista de Proyectos
                        </h4>
                        <hr style="border-top: 1px solid #29a4dd;">
                        <div class="code-boxInverse">
                            <div class="row">
                                <div class="col-md-2 col-sm-12 col-xs-12" style="margin-top:5px">
                                    <div class="project-counter-wrapper">
                                        <span id="project-counter" style="margin-top: -3px;"></span>
                                        <p>Proyecto(s)</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12" style="margin-top:5px">
                                    <div class="project-counter-wrapper">
                                        <span id="contract-amount-counter" style="margin-top: -3px;">
                                            <?php echo 'LPS '.number_format(($ind[0]['contratado']/1000000), 2)." M";?>
                                        </span>
                                        <p>Monto referencial</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12" style="margin-top:5px">
                                    <div class="project-counter-wrapper">
                                        <span id="contract-usd-amount-counter" style="margin-top: -3px;">
                                            <?php echo 'USD '.number_format(($ind[0]['contratadoUSD']/1000000), 2)." M";?>
                                        </span>
                                        <p>Monto referencial</p>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12" id="search" style="margin-top:5px">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-search"></i>
                                        </span>
                                        <input type="search" class="form-control" id="search-input" placeholder="Buscar proyectos">
                                    </div>
                                </div>
                            </div>
                            <div id='proyectos' class="table-responsive"></div>
                            <div id='programas'></div>
                        </div>
                    </div>
                </div>
        </section>

        <!-- Service Main Section Ends -->
        <!--  last Updates -->
        <div class="col-md-6 col-sm-12 col-xs-12">
            <?php
                $graficaBarra = Yii::app()->db->createCommand('select s.sector, count(distinct p.idProyecto) as total from cs_sector s left join cs_proyecto p ON p.idSector = s.idSector WHERE p.estado="PUBLICADO" group by s.sector HAVING COUNT(p.idProyecto)>0')->queryAll();
                for($i=0;$i<count($graficaBarra);$i++)
                {
                    $mrk[$i][]=intval($graficaBarra[$i]['total']);
                    $mrk2[$i][]=$graficaBarra[$i]['sector'];
                }

                $this->Widget('ext.highcharts.HighchartsWidget', array(
                    'options' => array(
                        'gradient' => array(
                            'enabled' => true
                        ) ,
                        'credits' => array(
                            'enabled' => false
                        ) ,
                        'exporting' => array(
                            'enabled' => false
                        ) ,
                        'chart' => array(
                            'plotBackgroundColor' => null,
                            'backgroundColor' => 'transparent',
                            'plotBorderWidth' => null,
                            'plotShadow' => false,
                            'height' => 500,
                            'width' => 500,
                        ) ,
                        'legend' => array(
                            'enabled' => false,
                        ) ,
                        'title' => array(
                            'text' => 'Proyectos según su sector'
                        ) ,
			'yAxis' =>array(
		            'title' => array('text' => 'Proyectos'),
        		),
                        'xAxis' => array(
                            'categories' => $mrk2,
                        ),
                        'plotOptions' => array(
                            'column' => array(
                                'allowPointSelect' => true,
                                'cursor' => 'pointer',
                                'dataLabels' => array(
                                    'enabled' => true,
                                    'color' => '#000000',
                                    'connectorColor' => '#000000',
                                    //'format' => '<b>{point.name}</b>',
                                ) ,
                            )
                        ) ,
                        'series' => array(
                            array(
                                'type' => 'column',
                                'name' => '# Proyectos',
                                'data' => $mrk,
                            )
                        ) ,
                    )
                ));
                ?>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <?php

                $NEtapaEstructuracion=count(Proyecto::Model()->findAll("idProyecto NOT IN (SELECT idProyecto FROM cs_calificacion) AND estado='PUBLICADO'"));
                $NEtapaCalificacion=count(Proyecto::Model()->findAll("idProyecto IN (SELECT idProyecto FROM cs_calificacion cal WHERE cal.estado='PUBLICADO' AND cal.idCalificacion NOT IN(SELECT idCalificacion FROM cs_adjudicacion WHERE estado='PUBLICADO')) AND estado='PUBLICADO'"));
                $NEtapaAdjudicacion=count(Proyecto::Model()->findAll("idProyecto IN (SELECT idProyecto FROM cs_calificacion cal WHERE cal.estado='PUBLICADO' AND cal.idCalificacion IN(SELECT idCalificacion FROM cs_adjudicacion adju WHERE adju.estado='PUBLICADO' AND adju.idAdjudicacion NOT IN (SELECT idAdjudicacion FROM cs_contratacion con WHERE con.estado='PUBLICADO' ) )) AND estado='PUBLICADO'"));
                $NEtapaContratacion=count(Proyecto::Model()->findAll("idProyecto IN (SELECT idProyecto FROM cs_calificacion cal WHERE cal.estado='PUBLICADO' AND cal.idCalificacion IN(SELECT idCalificacion FROM cs_adjudicacion adju WHERE adju.estado='PUBLICADO' AND adju.idAdjudicacion IN (SELECT idAdjudicacion FROM cs_contratacion con WHERE con.estado='PUBLICADO' AND con.primario=1 AND con.idContratacion NOT IN (SELECT idContratacion FROM cs_inicio_ejecucion ie WHERE ie.estado='PUBLICADO' )))) AND estado='PUBLICADO'"));
                $NEtapaImplementacion=count(Proyecto::Model()->findAll("idProyecto IN (SELECT idProyecto FROM cs_calificacion cal WHERE cal.estado='PUBLICADO' AND cal.idCalificacion IN(SELECT idCalificacion FROM cs_adjudicacion adju WHERE adju.estado='PUBLICADO' AND adju.idAdjudicacion IN (SELECT idAdjudicacion FROM cs_contratacion con WHERE con.estado='PUBLICADO' AND con.primario=1 AND con.idContratacion IN (SELECT idContratacion FROM cs_inicio_ejecucion ie WHERE ie.estado='PUBLICADO' )))) AND estado='PUBLICADO'"));

                $etapaEstructuracion=0;
                $etapaCalificacion=0;
                $etapaAdjudicacion=0;
                $etapaContratacion=0;
                $etapaImplementacion=0;
                $this->Widget('ext.highcharts.HighchartsWidget', array(
                    'options' => array(
                        'gradient' => array(
                            'enabled' => true
                        ) ,
                        'credits' => array(
                            'enabled' => false
                        ) ,
                        'exporting' => array(
                            'enabled' => false
                        ) ,
                        'chart' => array(
                            'plotBackgroundColor' => null,
                            'backgroundColor' => 'transparent',
                            'plotBorderWidth' => null,
                            'plotShadow' => false,
                            'height' => 600,
                            'width' => 600,
                        ) ,
                        'legend' => array(
                            'enabled' => false,
                        ) ,
                        'title' => array(
                            'text' => 'Proyectos según su etapa'
                        ) ,
                        'plotOptions' => array(
                            'pie' => array(
                                'allowPointSelect' => true,
                                'cursor' => 'pointer',
                                'dataLabels' => array(
                                    'enabled' => true,
                                    'color' => '#000000',
                                    'connectorColor' => '#000000',
                                    'format' => '<b>{point.name}</b>: {point.percentage:.1f} %',
                                ) ,
                            )
                        ) ,
                        'series' => array(
                            array(
                                'type' => 'pie',
                                'name' => '# de Proyectos',
                                'data' => array(
                                    array(
                                        'Estructuración',
                                        $NEtapaEstructuracion
                                    ) ,
                                    array(
                                        'Calificación',
                                        $NEtapaCalificacion
                                    ) ,
                                    array(
                                        'Adjudicación',
                                        $NEtapaAdjudicacion
                                    ) ,
                                    array(
                                        'Contratación',
                                        $NEtapaContratacion
                                    ) ,
                                    array(
                                        'Implementación',
                                        $NEtapaImplementacion
                                    ) ,
                                ) ,
                            )
                        ) ,
                    )
                ));
                ?>
        </div>

        <div class="col-md-8  col-sm-12 col-xs-12">
            <div style="text-align: center;" >
                <div class="container">
                    <div class="row text-center">
                        <h1 class="section-title wow fadeInUpQuick">
                            Últimos Proyectos
                        </h1>
                        <hr style="border-top: 2px solid #29a4dd;width:5%;">
                    </div>
                </div>
            </div>
            <div class="updates-container-wrapper">
                <!-- Container Starts -->
                <?php

                    $sql = "SELECT idProyecto, TRIM(substring(nombre_proyecto,1,100)) as nombre_proyecto, TRIM(substring(descrip,1,50)) as descrip FROM cs_proyecto WHERE ESTADO ='PUBLICADO' ORDER BY idProyecto DESC LIMIT 9";
                    $command=Yii::app()->db->createCommand($sql);
                    $latestProject=$command->queryAll();
                    $actual_link = "$_SERVER[HTTP_HOST]";
                    $total_x=count($latestProject);
                    $row=0;
                    $control="";
                    $idFicha="";

                    while ($row< $total_x) {
                        $adquisicion = Yii::app()->db->createCommand('SELECT * FROM vidpaths WHERE idProyecto='.$latestProject[$row]['idProyecto'])->queryAll();

                        foreach ($adquisicion as $value) {
                            if ($value['idProyecto']!=null) {
                                $control="Proyecto";
                                $idFicha=$value['idProyecto'];
                                if ($value['idCalificacion']!=null) {
                                    $control="Calificacion";
                                    $idFicha=$value['idCalificacion'];
                                    if ($value['idAdjudicacion']!=null) {
                                        $control="Adjudicacion";
                                        $idFicha=$value['idAdjudicacion'];
                                        if ($value['idContratacion']!=null) {
                                            $control="Contratacion";
                                            $contratoPrincipal = Yii::app()->db->createCommand('SELECT primario FROM cs_contratacion WHERE idContratacion='.$value['idContratacion'])->queryScalar();
                                            if ($contratoPrincipal==1) {
                                                $idFicha=$value['idContratacion'];
                                                break;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        $url =  CController::createUrl("Ciudadano/FichaTecnica", array('control'=>$control, 'id'=>$idFicha));
                    ?>

                        <div class="sk-news-container-element col-md-4  col-sm-12 col-xs-12" href="<?php echo $url; ?>">

                            <h3 href="<?php echo $url; ?>">
                                <a href="<?php echo $url; ?>">
                                </a>
                                <div class="submenu">
                                    <a href="<?php echo $url; ?>">
                                        <?php  echo $latestProject[$row]["nombre_proyecto"]; ?>
                                    </a>
                                </div>
                                <a href="<?php echo $url; ?>" style="font-size: 0.6em;font-weight: normal;">
                                    <?php  echo $latestProject[$row]["descrip"];  ?>
                                </a>
                            </h3>
                        </div>

                    <?php
                        $row++;
                    }
                ?>
                <!-- Container Ends -->
            </div>
        </div>
        <div class="col-md-4  col-sm-12 col-xs-12">
            <div style="text-align: center;" >
                <div class="container">
                    <div class="row text-center">
                        <h1 class="section-title wow fadeInUpQuick">
                            Anuncios
                        </h1>
                        <hr style="border-top: 2px solid #29a4dd;width:5%;">
                    </div>
                </div>
            </div>
            <div style="padding-top: 10px;">
                <!-- Container Starts -->
                <div class="announcement-container">
                    <ul>

                        <?php
                            $sql = "SELECT a.* FROM cs_announcement a ORDER BY a.id DESC LIMIT 5" ;
                            $command=Yii::app()->db->createCommand($sql);
                            $announcement=$command->queryAll();

                            $actual_link = "$_SERVER[HTTP_HOST]";
                            $total_x=count($announcement);
                            $row=0;
                            $control="";
                            $idFicha="";

                            while ($row< $total_x) {
                        ?>
                  			<?php
                    			$control="";
                    			$idFicha="";
                    				$adquisicion = Yii::app()->db->createCommand('SELECT * FROM vidpaths WHERE idProyecto='.$announcement[$row] ['idProyecto'])->queryAll();
                    				$totalAdq = count($adquisicion);
                    				foreach ($adquisicion as $value) {
                    					if ($value['idProyecto']!=null) {
                    						$control="Proyecto";
                    						$idFicha=$value['idProyecto'];
                    						if ($value['idCalificacion']!=null) {
                    							$control="Calificacion";
                    							$idFicha=$value['idCalificacion'];
                    							if ($value['idAdjudicacion']!=null) {
                    								$control="Adjudicacion";
                    								$idFicha=$value['idAdjudicacion'];
                    								if ($value['idContratacion']!=null) {
                    									$control="Contratacion";
                    									$contratoPrincipal = Yii::app()->db->createCommand('SELECT primario FROM cs_contratacion WHERE idContratacion='.$value['idContratacion'])->queryScalar();
                    									if ($contratoPrincipal==1) {
                    										$idFicha=$value['idContratacion'];
                    										break;
                    									}
                    								}
                    							}
                    						}
                    					}
                    				}
                            ?>
                                <li>
                                    <a href="<?php echo 'index.php?r=ciudadano/FichaTecnica&control='.$control.'&id='.$idFicha ?>#tab13">
                                    <div class="announcement-date">
                                        <div class="announcement-date-container">
                                            <?php echo date('d', strtotime($announcement[$row]["date"])); ?>
                                            <span><?php echo date('m', strtotime($announcement[$row]["date"])); ?></span>
                                            <p><?php echo date('Y', strtotime($announcement[$row]["date"])); ?></p>
                                        </div>
                                    </div>
                                    <div class="announcement-content">
                                        <h3><?php echo $announcement[$row]["title"]; ?></h3>
                                        <p><?php echo $announcement[$row]["description"]; ?></p>
                                    </div>
                                    </a>
                                </li>
                            <?php


                                $row++;
                            }

                        ?>
                    </ul>
                </div>
                <!-- Container Ends -->
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function ($) {
                $("#collapseOne").on("shown.bs.collapse", function (e) {
                    $(e.currentTarget).parent().find(".icon-holder").find("i").removeClass("fa-plus").addClass("fa-minus");
                });
                $("#collapseTwo").on("shown.bs.collapse", function (e) {
                    $(e.currentTarget).parent().find(".icon-holder").find("i").removeClass("fa-plus").addClass("fa-minus");
                });
                $("#collapseThree").on("shown.bs.collapse", function (e) {
                    $(e.currentTarget).parent().find(".icon-holder").find("i").removeClass("fa-plus").addClass("fa-minus");
                });
                $("#collapseTC").on("shown.bs.collapse", function (e) {
                    $(e.currentTarget).parent().find(".icon-holder").find("i").removeClass("fa-plus").addClass("fa-minus");
                });

                $("#collapseOne").on("hidden.bs.collapse", function (e) {
                    $(e.currentTarget).parent().find(".icon-holder").find("i").removeClass("fa-minus").addClass("fa-plus");
                });
                $("#collapseTwo").on("hidden.bs.collapse", function (e) {
                    $(e.currentTarget).parent().find(".icon-holder").find("i").removeClass("fa-minus").addClass("fa-plus");
                });
                $("#collapseThree").on("hidden.bs.collapse", function (e) {
                    $(e.currentTarget).parent().find(".icon-holder").find("i").removeClass("fa-minus").addClass("fa-plus");
                });
                $("#collapseTC").on("hidden.bs.collapse", function (e) {
                    $(e.currentTarget).parent().find(".icon-holder").find("i").removeClass("fa-minus").addClass("fa-plus");
                });



                $('#slider_Pro').sliderPro({
                    width: 2000,
                    height: 600,
                    arrows: true,
                    buttons: false,
                    waitForLayers: true,
                    thumbnailWidth: 200,
                    thumbnailHeight: 100,
                    thumbnailPointer: true,
                    autoplay: true,
                    autoScaleLayers: false,
                    breakpoints: {
                        500: {
                            thumbnailWidth: 120,
                            thumbnailHeight: 50
                        }
                    }
                });

                /*  var wow = new WOW(
                      {
                      boxClass:     'wow',      // animated element css class (default is wow)
                      animateClass: 'animated', // animation css class (default is animated)
                      offset:       0,          // distance to the element when triggering the animation (default is 0)
                      mobile:       false        // trigger animations on mobile devices (true is default)
                      });
                      wow.init();*/
            });
            var buildActiveFilters = function () {
                var codeDepartamento = {
                    "08": "HN-FM",
                    "11": "HN-IB",
                    "05": "HN-CR",
                    "01": "HN-AT",
                    "02": "HN-CL",
                    "09": "HN-GD",
                    "15": "HN-OL",
                    "07": "HN-EP",
                    "18": "HN-YO",
                    "03": "HN-CM",
                    "06": "HN-CH",
                    "17": "HN-VA",
                    "12": "HN-LP",
                    "10": "HN-IN",
                    "13": "HN-LE",
                    "14": "HN-OC",
                    "04": "HN-CP",
                    "16": "HN-SB"
                };
                var departmentName = {
                    "08": "Francisco Morazán",
                    "11": "Islas de la Bahía",
                    "05": "Cortés",
                    "01": "Atlántida",
                    "02": "Colón",
                    "09": "Gracias a Dios",
                    "15": "Olancho",
                    "07": "El Paraíso",
                    "18": "Yoro",
                    "03": "Comayagua",
                    "06": "Choluteca",
                    "17": "Valle",
                    "12": "La Paz",
                    "10": "Intibucá",
                    "13": "Lempira",
                    "14": "Ocotepeque",
                    "04": "Copán",
                    "16": "Santa Bárbara"
                };

                var activeFiltersContainer = $(".active-filters");
                var activeFiltersArray = [];
                if (selectedDepartments.length > 0) {
                    selectedDepartments.forEach(function (element) {
                        activeFiltersArray.push({
                            name: departmentName[element.name],
                            type: codeDepartamento[element.name]
                        });
                    });
                }
                if (selectedEtapa.length > 0) {
                    selectedEtapa.forEach(function (element, i) {
                        activeFiltersArray.push({
                            name: element.name,
                            type: (element.index)
                        });
                    });
                }
                if (selectedSector.length > 0) {
                    selectedSector.forEach(function (element, i) {
                        activeFiltersArray.push({
                            name: element.name,
                            type: (element.index)
                        });
                    });
                }
                if (selectedTC.length > 0) {
                    selectedTC.forEach(function (element, i) {
                        activeFiltersArray.push({
                            name: element.name,
                            type: (element.index)
                        });
                    });
                }

                if (activeFiltersArray.length > 0) {
                    // Clean container
                    activeFiltersContainer.html('<h6>Filtros Activos</h6>');
                    // Build container
                    activeFiltersArray.forEach(function (element, i) {

                        activeFiltersContainer.append('<span onClick="removeFilter(\'' + element.type + '\')" class="label label-primary active-filters-element">' + element.name + ' <i class="fa fa-times" aria-hidden="true"></i></span>');
                    });
                    activeFiltersContainer.append('<button onClick="listaProyectoLoadAll()" class="label btn-search-xs filters-reset-button"><i class="fa fa-filter" aria-hidden="true"></i> Quitar Filtros </button>');
                } else {
                    activeFiltersContainer.html('');
                }
            }
        </script>

         <style type="text/css">
                .announcement-container ul {
                margin: 0;
                padding: 0;
                }
                .announcement-container ul li {
                margin: 0 0 10px 0;
                }
                .announcement-container ul li a {
                text-decoration: none;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-pack: start;
                    justify-content: flex-start;
                -ms-flex-align: center;
                    align-items: center;
                border: 2px solid #e6e6e6;
                }
                .announcement-container ul li a:hover {
                border: 2px solid #2477a7;
                }
                .announcement-container ul li a:hover .announcement-date {
                background-color: #2477a7;
                }
                .announcement-container ul li a:hover .announcement-date-container {
                color: #fff;
                }
                .announcement-container p {
                margin: 0;
                }
                .announcement-date {
                padding: 7px 18px;
                position: relative;
                background-color: #f5f5f5;
                width: auto;
                min-width: 110px;
                }
                .announcement-date-container {
                font-size: 32px;
                font-weight: 700;
                text-align: center;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-direction: column;
                    flex-direction: column;
                -ms-flex-align: center;
                    align-items: center;
                -ms-flex-pack: center;
                    justify-content: center;
                color: #2477a7;
                height: 65px;
                }
                .announcement-date span {
                font-size: 14px;
                font-weight: 300;
                }
                .announcement-date p {
                font-size: 12px;
                font-weight: 300;
                line-height: 6px;
                }
                .announcement-content {
                padding: 7px 18px;
                }
                .announcement-content h3 {
                text-align: left;
                }
                .announcement-content p {
                font-size: 12px;
                line-height: 1.5;
                color: #666;
                }

            .sk-news-container-element {
                margin: 5px;
                text-align: center;
                position: relative;
                cursor: pointer;
                padding: 0 10px;
                background-color: #FFF;
                -ms-flex-positive: 1;
                padding: 10px 30px;
                border: 1px solid #ddd;
            }
            @media (min-width: 768px){
                .sk-news-container-element {
                    max-width:31%;
                }
            }
.sk-news-container-element img {
  width: 100%;
  max-height: 200px;
  overflow: hidden;
  position: relative;
  z-index: 0;
}
.sk-news-container-element h3 a {
  font-weight: 700;
  font-size: 0.8em;
  line-height: 1.4;
  text-transform: uppercase;
  color: black;
}
.sk-news-container-element h3 a:hover {
  color: #2477a7;
  text-decoration: none;
}
.sk-news-container-element h3 {
  position: relative;
  z-index: 1;
  font-weight: 700;
  font-size: 1.4em;
  line-height: 1.4;
  text-align: center;
  text-transform: uppercase;
  padding: 10px 0 25px 0;
  margin: 0;
  background: linear-gradient(to left, #fff 50%, #2477a7 50%);
  background-repeat: no-repeat;
  background-size: 200% 4px;
  background-position: right top;
  background-color: #fff;
  transition: margin-top 0.2s ease-out, background-position 0.2s linear;
}
.sk-news-container-element:hover h3 {

  background-position: left top;
  background-color: #fff;
}
.sk-news-container-element .submenu {
  font-size: 14px;
  font-weight: 400;
  padding-bottom: 15px;
  text-align: center;
}
.sk-news-container-element .submenu a {
  color: #2477a7;
  font-weight: 700;
}
.sk-news-container-element .submenu a:hover {
  text-decoration: underline;
}
.updates-container-wrapper {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
      flex-wrap: wrap;
  width: 100%;
  margin: 0 -10px;
}
        </style>

        <!-- last Updates -->
