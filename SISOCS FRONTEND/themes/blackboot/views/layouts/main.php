<?php
Yii::app()->clientscript

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-113746630-1"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'UA-113746630-1');
  </script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script src="<?php echo Yii::app()->theme->baseUrl?>/assets/js/pdfmake.js"></script>
  <script src="<?php echo Yii::app()->theme->baseUrl?>/assets/js/vfs_fonts.js"></script>
  <!-- Viewport Meta Tag -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php echo CHtml::encode($this->pageTitle); ?>
  </title>
  <meta name="language" content="en" />
  <link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/bootstrap.min.css">
  <!-- Main Style -->
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/main.css">
  <!-- Responsive Style -->
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/responsive.css">
  <!-- Tables Style -->
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/tables.css">
  <!-- Custom Style -->
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/custom.css">

  <!--Fonts-->
  <link rel="stylesheet" media="screen" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/fonts/font-awesome/font-awesome.min.css">
  <link rel="stylesheet" media="screen" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/fonts/simple-line-icons.css">

  <!-- Extras -->
  <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/extras/owl/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/extras/owl/owl.theme.css">
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/extras/animate.css">
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/extras/normalize.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.4.2/b-colvis-1.4.2/b-flash-1.4.2/b-html5-1.4.2/b-print-1.4.2/cr-1.4.1/fc-3.2.3/fh-3.1.3/kt-2.3.2/r-2.2.0/rg-1.0.2/rr-1.2.3/sc-1.4.3/sl-1.2.3/datatables.min.css"
  />
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/colors/lightblue.css" media="screen"
  />
  <!-- Sweet Style -->
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/sweetalert2.min.css" media="all">
  <!-- Slider Style -->
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/slider-pro.css" media="all">

  <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" media="all">



</head>
<!-- Header area wrapper starts -->
<header id="header-wrap">

  <!-- Roof area starts -->

  <!-- Roof area Ends -->

  <!-- Header area starts -->
  <section id="header" style="min-height:100px">

    <!-- Navbar Starts -->
    <nav class="navbar navbar-light" data-spy="affix" data-offset-top="50" style="min-height:100px">
      <div class="container" style="max-width:95%">
        <button class='navbar-toggler hidden-md-up pull-xs-right' data-target='#main-menu' data-toggle='collapse' type='button'>
          ☰
        </button>
        <!-- Brand -->
        <a class="navbar-brand" href="http://app.sisocs.org/index.php?r=Ciudadano/index" style="display:inline-flex">
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/logo_sisocs.png" alt="SISOCS" style="margin-top: -14px;height: 70px;">
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/LOGO_GOB.png" alt="Honduras" style="margin-top: -14px;height: 70px;">
        </a>
        <div class="collapse navbar-toggleable-sm pull-xs-left pull-md-right" id="main-menu" style="font-size: .9em;">
          <!-- Navbar Starts -->
          <?php
                      $actual_link = "http://$_SERVER[HTTP_HOST]";
                        $this->widget('zii.widgets.CMenu', array(
                            'htmlOptions' => array('class' => 'nav nav-inline'),
                            'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
                                'itemCssClass' => 'nav-item dropdown',
                            'encodeLabel' => false,
                            'items' => array(
                                //inicio
                                //fin

                                //cambio
                                array('label' => 'Inicio', 'url' => array('Ciudadano/index')),
                                array('label' => 'Mapas de Proyectos', 'url' => array('Ciudadano/mapaProyectos')),


                                //array('label'=>'Permission', 'url'=>array('/permission'),'visible'=>!Yii::app()->user->isGuest),
                                array('label' => 'Menu∇', 'visible' => !Yii::app()->user->isGuest,'url' => '#', 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown" ,'onClick'=>'showDrop(1)'),
                                'submenuOptions' => array('class' => 'dropdown-menu','id'=>"dropdown-menu_1"),
                                'items' => array(
                                        array('label' => 'Planificación del Proyecto / Estructuración', 'url' => array('/proyecto/admin')),
                                        array('label' => 'Invitación y Calificación', 'url' => array('/calificacion/admin')),
                                        array('label' => 'Evaluación de las Ofertas/Adjudicación', 'url' => array('/adjudicacion/admin')),
                                        array('label' => 'Contratación', 'url' => array('/contratacion/admin')),
                                        array('label' => 'Gestión de los Contratos', 'url' => array('/contratos/admin')),
                                        array('label' => 'Implementación', 'url' => array('/InicioEjecucion/admin')),
                                        array('label' => 'Gestion de Avances y Garantias', 'url' => array('/GestionAvances/admin')),
                                        array('label' => 'Ficha de Finalizacion de Ejecución', 'url' => array('/GestionFinales/admin')),
                                    ),

                                //'visible'=>!Yii::app()->user->isGuest,
                                ),
                                array('label' => 'Catálogos∇','visible' => !Yii::app()->user->isGuest, 'url' => '#',  'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown",'onClick'=>'showDrop(2)'),
                                'submenuOptions' => array('class' => 'dropdown-menu','id'=>"dropdown-menu_2"),
                                'items' => array(
                                        //menu Planificacion de Programas
                                         array('label' => 'Planificación del Proyecto', 'url' => '#',  'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown",'onClick'=>'showDrop(11)'), 'itemOptions' => array('class' => 'anotherSubMenu'),
                                         'submenuOptions' => array('class' => 'dropdown-menu','id'=>"dropdown-menu_11"),
                                         'items' => array(
                                                array('label' => '<strong style="color:#404040">> </strong>Entidad de Adquisición', 'url' => array('/entes/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Funcionarios', 'url' => array('/funcionarios/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Rol', 'url' => array('/rol/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Entidad Unidad', 'url' => array('/entesUnidad/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Sector', 'url' => array('/sector/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Sub-Sector', 'url' => array('/subsector/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Fuentes de Financiamiento', 'url' => array('/parties/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Departamentos', 'url' => array('/departamento/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Propósito', 'url' => array('/proposito/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Municipio', 'url' => array('/municipio/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Party', 'url' => array('/parties/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Region', 'url' => array('/region/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Pais', 'url' => array('/country/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Localidad', 'url' => array('/locality/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Rol de Party', 'url' => array('/PartyRol/admin'),'itemOptions' => array('class' => 'subItem')),



                                            ),
                                        ),

                                        array('label' => 'Invitacion y Calificacion', 'url' => '#',  'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown",'onClick'=>'showDrop(10)'), 'itemOptions' => array('class' => 'anotherSubMenu'),
                                        'submenuOptions' => array('class' => 'dropdown-menu','id'=>"dropdown-menu_10"),
                                        'items' => array(
                                                array('label' => '<strong style="color:#404040">> </strong>Funcionarios', 'url' => array('/funcionarios/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Tipo de Contrato', 'url' => array('/tipocontrato/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Entidad de Adquisición', 'url' => array('/entes/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Entidad Unidad', 'url' => array('/entesUnidad/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Oferentes', 'url' => array('/parties/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Metodo de Adquisición', 'url' => array('/metodo/admin'),'itemOptions' => array('class' => 'subItem')),

                                            ),
                                        ),
                                         array('label' => 'Evaluación de las Ofertas/Adjudicacion','url' => '#',  'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown",'onClick'=>'showDrop(5)'), 'itemOptions' => array('class' => 'anotherSubMenu'),
                                         'submenuOptions' => array('class' => 'dropdown-menu','id'=>"dropdown-menu_5"),
                                         'items' => array(
                                                array('label' => '<strong style="color:#404040">> </strong>Entidad de Adquisición', 'url' => array('/entes/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Método de Adjudicación', 'url' => array('/MetodoAdjudicacion/admin'),'itemOptions' => array('class' => 'subItem')),
                                             ),
                                        ),
                                        array('label' => 'Contratación', 'url' => '#',  'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown",'onClick'=>'showDrop(6)'), 'itemOptions' => array('class' => 'anotherSubMenu'),
                                        'submenuOptions' => array('class' => 'dropdown-menu','id'=>"dropdown-menu_6"),
                                        'items' => array(
                                                array('label' => '<strong style="color:#404040">> </strong>Entidad de Administración de Contrato', 'url' => array('/entes/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Oferentes', 'url' => array('/parties/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Categoria de Financiamiento', 'url' => array('/FinanceCategory/create'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Categoria de Riesgo', 'url' => array('/RiskCategory/create'),'itemOptions' => array('class' => 'subItem')),

                                             ),
                                        ),
                                        array('label' => 'Gestión de Contratos', 'url' => '#',  'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown",'onClick'=>'showDrop(7)'), 'itemOptions' => array('class' => 'anotherSubMenu'),
                                        'submenuOptions' => array('class' => 'dropdown-menu','id'=>"dropdown-menu_7"),
                                        'items' => array(
                                                //array('label' => '<strong style="color:#404040">> </strong>Estatus Contrato', 'url' => array('/estadosgestcontra/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Tipo de Modificación al Contrato', 'url' => array('/tipoModContrato/admin'),'itemOptions' => array('class' => 'subItem')),

                                             ),
                                        ),
                                         array('label' => 'Implementación', 'url' => '#',  'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown",'onClick'=>'showDrop(8)'), 'itemOptions' => array('class' => 'anotherSubMenu'),
                                         'submenuOptions' => array('class' => 'dropdown-menu','id'=>"dropdown-menu_8"),
                                         'items' => array(
                                                 array('label' => '<strong style="color:#404040">> </strong>Datos de Contacto', 'url' => array('/contactos/admin'),'itemOptions' => array('class' => 'subItem')),
                                                 array('label' => '<strong style="color:#404040">> </strong>KPI', 'url' => array('/kpi/admin'),'itemOptions' => array('class' => 'subItem')),
                                                 array('label' => '<strong style="color:#404040">> </strong>Observaciones KPI', 'url' => array('/kpiObservations/admin'),'itemOptions' => array('class' => 'subItem')),
                                                //array('label' => 'Tipo de Garantía', 'url' => array('/garantias/admin')),
                                                //array('label'=> 'Desembolsos', 'url'=>array('/desembolsosMontos/admin')),

                                             ),
                                        ),
                                        /*array('label' => 'Avances de Ejecucion','url' =>array('#'), 'itemOptions' => array('class' => 'dropdown-menu'),
                                            'items' => array(
                                                array('label' => 'Avances', 'url' => array('/avances/index2')),
                                                array('label' => 'Garantias', 'url' => array('/garantias/admin2')),
                                             ),
                                        ),*/
                                        array('label' => 'Generales', 'url' => '#',  'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown",'onClick'=>'showDrop(9)'), 'itemOptions' => array('class' => 'anotherSubMenu'),
                                        'submenuOptions' => array('class' => 'dropdown-menu','id'=>"dropdown-menu_9"),
                                        'items' => array(
                                                array('label' => '<strong style="color:#404040">> </strong>Estados', 'url' => array('/estado/index'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Tipo de Moneda', 'url' => array('/currency/admin'),'itemOptions' => array('class' => 'subItem')),
                                                array('label' => '<strong style="color:#404040">> </strong>Tipos de Docuementos', 'url' => array('/documentTypes/create'),'itemOptions' => array('class' => 'subItem')),


                                             ),
                                        ),
                                    ),
                                ),
                                array('label' => 'Admin. Usuarios ∇', 'visible' => !Yii::app()->user->isGuest, 'url' => '#',  'linkOptions' => array('class' => 'nav-link dropdown-toggle', 'data-toggle' => "dropdown",'onClick'=>'showDrop(3)'),
                                'submenuOptions' => array('class' => 'dropdown-menu','id'=>"dropdown-menu_3"),
                                'items' => array(
                                        array('label' => Yii::app()->getModule('user')->t("Register"), 'url' => array('/cruge/ui/registration'), 'visible' => Yii::app()->user->isGuest),
                                        array('label' => Yii::app()->getModule('user')->t("Profile"), 'url' => Yii::app()->user->ui->userManagementAdminUrl, 'visible' => Yii::app()->user->isSuperAdmin),
                                    ),
                                ),
                                /*array('label' => 'Manual', 'url' => "images/Manual.pdf"),*/
                                array('label' => 'Informes ∇', 'url' => '#',  'linkOptions' => array('class' => 'nav-link dropdown-toggle', 'data-toggle' => "dropdown",'onClick'=>'showDrop(4)'),
                                'submenuOptions' => array('class' => 'dropdown-menu','id'=>"dropdown-menu_4"),
                                'items' => array(
                                        array('label' => 'Informe de divulgación<br/> en Honduras', 'url' => "images/Diagnostico_de_Divulgacion.pdf"),
                                        array('label' => 'Todos los Proyectos', 'url' => "http://app.sisocs.org:8080/sisocs/xls"),
                                        /*array('label' => 'Informe sobre las Adquisiciones', 'url' => array('/Ciudadano/adq')),
                                        array('label' => 'Informe de Visitas o Ingresos al Sistema', 'url' => array('/Ciudadano/Informeingsistema')),
                                        array('label' => 'Informes Técnicos de los Proyectos', 'url' => array('/Ciudadano/Informetecproyecto')),
                                        array('label' => 'Informe sobre los contratos y los proveedores', 'url' => array('Ciudadano/contrato_proveedor')),
                                        array('label' => 'Informes Gerenciales', 'url' => array('/Ciudadano/Informes')),
                                        array('label' => 'Descarga de Informacion', 'url' => array('/Ciudadano/pc')),*/
                                    ),),
                                    array('label' => 'Config. Sitio ∇', 'visible' => Yii::app()->user->isSuperAdmin,'url' => '#', 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown" ,'onClick'=>'showDrop(15)'),
                                    'submenuOptions' => array('class' => 'dropdown-menu','id'=>"dropdown-menu_15"),
                                    'items' => array(
                                  array('label' => '<strong style="color:#404040">> </strong>Cambiar Imagenes', 'visible' => Yii::app()->user->isSuperAdmin, 'url' => array('/SlidesImages/admin'),'itemOptions' => array('class' => 'anotherSubMenu')),
                                  array('label' => '<strong style="color:#404040">> </strong>Anuncios', 'visible' => Yii::app()->user->isSuperAdmin, 'url' => array('/Announcement/admin'),'itemOptions' => array('class' => 'anotherSubMenu')),


                                        /*array('label' => 'Informe sobre las Adquisiciones', 'url' => array('/Ciudadano/adq')),
                                        array('label' => 'Informe de Visitas o Ingresos al Sistema', 'url' => array('/Ciudadano/Informeingsistema')),
                                        array('label' => 'Informes Técnicos de los Proyectos', 'url' => array('/Ciudadano/Informetecproyecto')),
                                        array('label' => 'Informe sobre los contratos y los proveedores', 'url' => array('Ciudadano/contrato_proveedor')),
                                        array('label' => 'Informes Gerenciales', 'url' => array('/Ciudadano/Informes')),
                                        array('label' => 'Descarga de Informacion', 'url' => array('/Ciudadano/pc')),*/
                                    ),),

                               /* array('label' => 'SMQ', 'url' => 'http://insep.gob.hn/smq/'),
                                array('label' => 'Login', 'url' => array('/cruge/ui/login'), 'visible' => Yii::app()->user->isGuest),*/
                                array('label' => 'OCDS', 'linkOptions' => array('class' => 'ocds', 'onClick'=>'goToOCDS(\''.$actual_link.'/protected/ocdsShow\')'),'submenuOptions' => array('class' => 'dropdown-menu','id'=>"dropdown-menu")),
                                array('label' => Yii::app()->getModule('user')->t("Logout") . ' (' . Yii::app()->user->name . ')', 'url' => Yii::app()->getModule('user')->logoutUrl, 'visible' => !Yii::app()->user->isGuest),
                            ),
                        ));
                        ?>
        </div>
        <!-- Form for navbar search area -->
        <form class="full-search">
          <div class="container">
            <input type="text" placeholder="Type to Search">
            <a href="#" class="close-search">
              <span class="fa fa-times fa-2x">
              </span>
            </a>
          </div>
        </form>
        <!-- Search form ends -->
      </div>
    </nav>
    <!-- Navbar Ends -->

  </section>

  <!-- End Content -->
</header>
<!-- Header-wrap Section End -->

<body>
  <div class="cont">
    <div class="container-fluid">
      <?php /*if (isset($this->breadcrumbs)): ?>
      <?php
              $this->widget('zii.widgets.CBreadcrumbs', array(
                  'links' => $this->breadcrumbs,
                  'homeLink' => false,
                  'tagName' => 'ul',
                  'separator' => '',
                  'activeLinkTemplate' => '<li><a href="{url}">{label}</a> <span class="divider">/</span></li>',
                  'inactiveLinkTemplate' => '<li><span>{label}</span></li>',
                  'htmlOptions' => array('class' => 'breadcrumb')
              ));
              ?>
        <!-- breadcrumbs -->
        <?php endif */?>

        <?php echo $content ?>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="ourupdates-modal" tabindex="-1" role="dialog" aria-labelledby="ourupdates" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h3 class="small-title">
                  Suscribete
                </h3>
                <div class="contact-us">
                  <p>Recibe anuncios que sean publicados </p>
                  <form>
                    <div class="form-group">
                      <input type="text" class="form-control" id="nameInput" placeholder="Ingrese su nombre">
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control" id="emailInput" placeholder="Ingrese su correo">
                    </div>

                  </form>
                </div>
              </div>
              <div class="modal-footer">
                <div class="btn btn-secondary" onclick="subscribeUser()">Suscribirse</div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <!--/.fluid-container-->
  </div>
  <!-- Footer Section -->
  <footer>
    <!-- Container Starts -->
    <div class="container">
      <!-- Row Starts -->
      <div class="row section">
        <!-- Footer Widget Starts -->
        <div class="footer-widget col-md-3 col-xs-12 wow fadeIn">
          <h3 class="small-title">
            Acerca de COALIANZA1
          </h3>
          <p align="justify">
            La Comisión para la Promoción de la Alianza Público-Privada (COALIANZA) es la agencia responsable de la gestión del nuevo
            modelo de inversión participativa en Honduras, como una estrategia de desarrollo sostenible que es impulsada
            para elevar la competitividad del país y la calidad de vida de las familias. COALIANZA opera desde el año 2010,
            con la aprobación de la Ley de Promoción de la Alianza Público Privada mediante Decreto Legislativo No. 143-2010.
          </p>
          <div class="social-footer">
            <a href="#">
              <i class="fa fa-facebook icon-round"></i>
            </a>
            <a href="#">
              <i class="fa fa-twitter icon-round"></i>
            </a>
            <a href="#">
              <i class="fa fa-linkedin icon-round"></i>
            </a>
            <a href="#">
              <i class="fa fa-google-plus icon-round"></i>
            </a>
          </div>
        </div>
        <!-- Footer Widget Ends -->
        <!-- Footer Widget Starts -->
        <div class="footer-widget col-md-3 col-xs-12 wow fadeIn" data-wow-delay=".2s">
          <h3 class="small-title">
            Contacto
          </h3>
          <ul class="contact-us">
            <li>
              <h6>Tegucigalpa, Honduras, CA</h6>
              <p>Col. Altos de Miramontes, Diagonal Barro y Poseidón, Casa 2801, atrás de la Universidad José Cecilio del Valle.</p>
              <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
              <a href="tel:+(504) 2232-4647" target="_blank">+(504) 2232-4647</a>
              <p></p>
            </li>
            <li>
              <h6>San Pedro Sula, Honduras, CA</h6>
              <p>Centro Comercial Santa Mónica Oeste Torre 1, Local B Boulevard del Norte, salida a Puerto Cortés </p>
              <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
              <a href="tel:+(504) ) 2550-1172" target="_blank">+(504)2550-1172</a>
              <br>
              <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
              <a href="tel:+(504)2550-1353" target="_blank">+(504) 2550-1353</a>
              <br>
            </li>
            <li>
              <br>
              <li>
                <i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i>
                <a href="mailto:contactenos@coalianza.gob.hn" target="_blank">contactenos@coalianza.gob.hn</a>
              </li>

          </ul>
        </div>
        <div class="footer-widget col-md-3 col-xs-12 wow fadeIn">
          <h3 class="small-title">
            Acerca de SAPP
          </h3>
          <p align="justify">
            La Superintendencia de Alianza Público-Privada fue creada mediante Decreto No. 143-2010 del Poder Legislativo, como una entidad
            colegiada, adscrita al Tribunal Superior de Cuentas, respecto del cual funciona con independencia técnica, administrativa
            y financiera.

          </p>
          <div class="social-footer">
            <a href="#">
              <i class="fa fa-facebook icon-round"></i>
            </a>
            <a href="#">
              <i class="fa fa-twitter icon-round"></i>
            </a>
            <a href="#">
              <i class="fa fa-linkedin icon-round"></i>
            </a>
            <a href="#">
              <i class="fa fa-google-plus icon-round"></i>
            </a>
          </div>
        </div>
        <div class="footer-widget col-md-3 col-xs-12 wow fadeIn" data-wow-delay=".2s">
          <h3 class="small-title">
            Contacto
          </h3>
          <ul class="contact-us">
            <li>
              <h6>Tegucigalpa, Honduras, CA</h6>
              <p>Centro Morazán, 18 Nivel, Torre 01.</p>
              <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
              <a href="tel:+(504) 2221-2406" target="_blank"> +(504) 2221-2406</a>
              <br>
              <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
              <a href="tel:+(504) 2221-3296" target="_blank"> +(504) 2221-3296</a>
              <br>
              <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
              <a href="tel:+(504) 2221-3306/45/66/76" target="_blank"> +(504) 2221-3306/45/66/76</a>
            </li>
            <li>
              <br>
              <i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i>
              <a href="mailto:info@app.gob.hn" target="_blank">info@sapp.gob.hn</a>
            </li>
            <li>
              <i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i>
              <a href="mailto:superintendencia@sapp.gob.hn" target="_blank">superintendencia@sapp.gob.hn</a>
            </li>

          </ul>
        </div>
      </div>
      <!-- Row Ends -->
    </div>
    <!-- Container Ends -->

    <!-- Copyright -->
    <div id="copyright">
      <div class="container">
        <div class="row">
          <!-- <div class="col-md-6 col-sm-6">
          </div> -->
          <div class="col-md-6  col-sm-6">
            <ul class="nav nav-inline pull-xs-right">
              <li class="nav-item">
                <a class="nav-link" href="https://creativecommons.org/licenses/by/4.0/" target="_blank">
                  <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/cc_icon.png" alt="">
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://creativecommons.org/licenses/by/4.0/" target="_blank">
                  <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/attribution_icon.png" alt="">
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href=<?php echo Yii::app()->baseUrl."/index.php?r=Ciudadano/index"?>>Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href=<?php echo Yii::app()->baseUrl."/index.php?r=Ciudadano/mapaProyectos"?>>Mapa de proyectos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" target="_blanck" href=<?php echo Yii::app()->baseUrl."/images/Diagnostico_de_Divulgacion.pdf" ?>>Informe de divulgación en Honduras</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" target="_blanck" href=<?php echo Yii::app()->baseUrl."/sisocs/xls" ?>>Todos los Proyectos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" target="_blanck" href=<?php echo $actual_link.'/protected/ocdsShow'; ?>>OCDS</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Copyright  End-->

  </footer>
  <!-- Footer Section End-->

  <!-- Go To Top Link -->
  <div class="ourupdates hiddenAtPrint" style="display: block;">
    <i class="material-icons">mail_outline</i>
  </div>
  <a href="#" class="back-to-top" id="backButton" style="z-index:999; display:block !important">
    <div class="button-up hiddenAtPrint" style="display: block;">
      <i class="material-icons">expand_less</i>
    </div>
  </a>

  <?php
                $baseUrl = Yii::app()->theme->baseUrl;
                $cs = Yii::app()->getClientScript();
                Yii::app()->clientScript->registerCoreScript('jquery');
                ?>
    <?php
                $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.sparkline.js');
                $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.flot.min.js');
                $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.flot.pie.min.js');
                $cs->registerScriptFile($baseUrl . '/js/charts.js');
                $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.knob.js');
                $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.masonry.min.js');
                //Utils
                $cs->registerScriptFile($baseUrl . '/assets/js/utils.js');
                //Thether JS
                $cs->registerScriptFile($baseUrl . '/assets/js/tether.min.js');
                $cs->registerScriptFile($baseUrl . '/assets/js/bootstrap.min.js');
                $cs->registerScriptFile($baseUrl . '/assets/js/jquery.mixitup.js');
                $cs->registerScriptFile($baseUrl . '/assets/js/wow.js');
                $cs->registerScriptFile($baseUrl . '/assets/js/owl.carousel.js');
                $cs->registerScriptFile($baseUrl . '/assets/js/waypoints.min.js');
                $cs->registerScriptFile($baseUrl . '/assets/js/jquery.counterup.min.js');
                $cs->registerScriptFile($baseUrl . '/assets/js/scroll-top.js');
                $cs->registerScriptFile($baseUrl . '/assets/js/jquery.appear.js');

                $cs->registerScriptFile($baseUrl . '/assets/js/jquery.vide.js');
                $cs->registerScriptFile($baseUrl . '/assets/js/jquery-ui.min.js');
                $cs->registerScriptFile($baseUrl . '/assets/js/jquery-datepicker-es.min.js');
                $cs->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js');
                $cs->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js');
                $cs->registerScriptFile('https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.4.2/b-colvis-1.4.2/b-flash-1.4.2/b-html5-1.4.2/b-print-1.4.2/cr-1.4.1/fc-3.2.3/fh-3.1.3/kt-2.3.2/r-2.2.0/rg-1.0.2/rr-1.2.3/sc-1.4.3/sl-1.2.3/datatables.min.js');
                //MAPS
                $cs->registerScriptFile('https://www.amcharts.com/lib/3/ammap.js');
                $cs->registerScriptFile('https://www.amcharts.com/lib/3/plugins/export/export.min.js');
                $cs->registerScriptFile('https://www.amcharts.com/lib/3/pie.js');
                $cs->registerScriptFile('https://www.amcharts.com/lib/3/xy.js');
                $cs->registerScriptFile('https://www.amcharts.com/lib/3/themes/light.js');
                $cs->registerScriptFile($baseUrl . '/assets/js/main.js');
                $cs->registerScriptFile($baseUrl . '/assets/js/hondurasLow.js');
                $cs->registerScriptFile($baseUrl . '/assets/js/custom.js');
                $cs->registerScriptFile($baseUrl . '/assets/js/sweetalert2.min.js');
                $cs->registerScriptFile($baseUrl . '/assets/js/slider-pro.js');
                $cs->registerScriptFile($baseUrl . '/assets/js/modernizr.custom.js');
            ?>






      <script type="text/javascript">
        const goToOCDS = function (url) {
          window.location.href = url;
        }

        $(document).ready(function () {
          $(".ourupdates").click(function () {
            $('#ourupdates-modal').modal('show');
          });
        })


        const showDrop = function (n) {
          const id = ("#dropdown-menu_" + n).toString();
          for (let i = 1; i <= 4; i++) {
            let id2 = ("#dropdown-menu_" + i).toString();
            if (id2 != id && (n < 5 || n > 11)) {
              $(id2).hide();
            }

          }
          $(id).toggle();
        };

      </script>


      <script type="text/javascript">
        var subscribeUser = function () {
          var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          var data = {
            "name": $("#nameInput").val(),
            "email": $("#emailInput").val(),
          }
          if (data.name == "" || !re.test(String(data.email).toLowerCase())) {
            swal(
              'Camapos invalidos',
              'Nombre y un correo electrónico válido son requeridos para la subscripción',
              'warning'
            )
          }
          else {
            var Subscriptions = new FormData();
            for (var key in data) {
              Subscriptions.append("Subscriptions[" + key + "]", data[key]);
            }


            $.ajax({
              type: 'POST',
              url: '<?php echo CController::createUrl("Subscriptions/create"); ?>',
              data: Subscriptions,
              processData: false,  // Important!
              contentType: false,
              cache: false,
              success: function (data) {
                swal({
                  title: 'Subscripción completada correctamente',
                  text: 'Se le notificaran de los anuncios publicados en SISOCS',
                  type:'success',
                  confirmButtonText: 'Ok',
                }
                ).then(
                  function () {
                    $('#ourupdates-modal').modal('hide');
                  })
              },
              error: function (data) { // if error occured
                swal(
                  'Subscripción SISOCS',
                  'Ocurrio un error en la subscripción, intentelo más tarde',
                  "error"
                )
              },
              dataType: 'html'
            });
          }
        }
        //Search
        var openSearch = $('.open-search'),
          SearchForm = $('.full-search'),
          closeSearch = $('.close-search');

        openSearch.on('click', function (event) {
          event.preventDefault();
          if (!SearchForm.hasClass('active')) {
            SearchForm.fadeIn(300, function () {
              SearchForm.addClass('active');
            });
          }
        });

        closeSearch.on('click', function (event) {
          event.preventDefault();

          SearchForm.fadeOut(300, function () {
            SearchForm.removeClass('active');
            $(this).find('input').val('');
          });
        });





        //Owl Carousel
        $('#testimonial-item').owlCarousel({
          autoPlay: 5000,
          items: 3,
          itemsTablet: 3,
          margin: 90,
          stagePadding: 90,
          smartSpeed: 450,
          itemsDesktop: [1199, 4],
          itemsDesktopSmall: [980, 3],
          itemsTablet: [768, 3],
          itemsTablet: [767, 2],
          itemsTabletSmall: [480, 2],
          itemsMobile: [479, 1],
        });

        //Dark Testimonial Carousel
        $('#testimonial-dark').owlCarousel({
          autoPlay: 5000,
          items: 3,
          itemsTablet: 3,
          margin: 90,
          stagePadding: 90,
          smartSpeed: 450,
          itemsDesktop: [1199, 4],
          itemsDesktopSmall: [980, 3],
          itemsTablet: [768, 3],
          itemsTablet: [767, 2],
          itemsTabletSmall: [480, 2],
          itemsMobile: [479, 1],
        });

        // Single Testimonial
        $('#single-testimonial-item').owlCarousel({
          singleItem: true,
          autoPlay: 5000,
          items: 1,
          itemsTablet: 1,
          margin: 90,
          stagePadding: 90,
          smartSpeed: 450,
          itemsDesktop: [1199, 4],
          itemsDesktopSmall: [980, 3],
          itemsTablet: [768, 3],
          itemsTablet: [767, 2],
          itemsTabletSmall: [480, 2],
          itemsMobile: [479, 1],
          stopOnHover: true,
        });

        // Image Carousel
        $("#image-carousel").owlCarousel({
          autoPlay: 3000, //Set AutoPlay to 3 seconds
          items: 4,
          itemsDesktop: [1170, 3],
          itemsDesktopSmall: [1170, 3]

        });

        // Slider Carousel
        $("#carousel-image-slider").owlCarousel({
          navigation: false, // Show next and prev buttons
          slideSpeed: 300,
          paginationSpeed: 400,
          singleItem: true,
          pagination: false,
          autoPlay: 3000,
        });


        //About owl carousel Slider
        $(document).ready(function () {
          /*=== About us ====*/
          $('#carousel-about-us').owlCarousel({
            navigation: true, // Show next and prev buttons
            navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            slideSpeed: 800,
            paginationSpeed: 400,
            autoPlay: true,
            singleItem: true,
            pagination: false,
            items: 1,
            itemsCustom: false,
            itemsDesktop: [1199, 4],
            itemsDesktopSmall: [980, 3],
            itemsTablet: [768, 2],
            itemsTabletSmall: false,
            itemsMobile: [479, 1],
          });

        });


        // Testimonial
        $('testimonial-carousel').carousel();
        $('a[data-slide="prev"]').click(function () {
          $('#testimonial-carousel').carousel('prev');
        });

        $('a[data-slide="next"]').click(function () {
          $('#testimonial-carousel').carousel('next');
        });



        // Back Top Link
        var offset = 200;
        var duration = 500;
        $(window).scroll(function () {
          if ($(this).scrollTop() > offset) {
            $('#backButton').fadeIn(400).addClass('showTop');
            $('#backButton').fadeIn(400);
          } else {
            $('#backButton').fadeOut(400);
          }
        });

        $('#backButton').click(function (event) {
          event.preventDefault();
          $('#backButton').fadeIn(400).removeClass('showTop');
          $('html, body').animate({
            scrollTop: 0
          }, 600);

          return false;
        })

      </script>
</body>

</html>
