<?php
Yii::app()->clientscript
// use it when you need it!
/*
  ->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap.css' )
  ->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap-responsive.css' )
  ->registerCoreScript( 'jquery' )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-transition.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-alert.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-modal.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-dropdown.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-scrollspy.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tab.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tooltip.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-popover.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-button.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-collapse.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-carousel.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-typeahead.js', CClientScript::POS_END )
 */
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="language" content="en" />
        <link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
            <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
            <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->
            <!-- Le styles -->
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" />
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/customDragon.css" />;
            <!-- Le fav and touch icons -->
            <?php
            $baseUrl = Yii::app()->theme->baseUrl;
            $cs = Yii::app()->getClientScript();
            Yii::app()->clientScript->registerCoreScript('jquery');
            ?>
            <?php
            //$cs->registerCssFile($baseUrl.'/css/bootstrap.min.css');
            //$cs->registerCssFile($baseUrl.'/css/bootstrap-responsive.min.css');
            //$cs->registerCssFile($baseUrl.'/css/abound.css');
            //$cs->registerCssFile($baseUrl.'/css/style-blue.css');
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/style-blue.css" />
            <?php
            $cs->registerScriptFile($baseUrl . '/js/bootstrap.min.js');
            $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.sparkline.js');
            $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.flot.min.js');
            $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.flot.pie.min.js');
            $cs->registerScriptFile($baseUrl . '/js/charts.js');
            $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.knob.js');
            $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.masonry.min.js');
            ?>

    </head>

   <body >
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#"><img src="images/logo.png"></img></a>
                    <div class="nav-collapse">
                        <?php
                        $this->widget('zii.widgets.CMenu', array(
                            'htmlOptions' => array('class' => 'pull-right nav'),
                            'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
                              'itemCssClass' => 'item-test hvr-underline-from-center',
                            'encodeLabel' => false,
                            'items' => array(
                                //inicio
                                //fin

                                array('label' => 'Inicio', 'url' => array('/site/index')),
                                //cambio
								array('label' => 'Módulo Ciudadano<span class="caret"></span>', 'url' => array('Ciudadano/index')), 
								
                                //array('label'=>'Permission', 'url'=>array('/permission'),'visible'=>!Yii::app()->user->isGuest),
                                array('label' => 'Menu<span class="caret"></span>', 'visible' => !Yii::app()->user->isGuest, 'url' => '#', 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                                    'items' => array(
                                       array('label' => 'Planificación del Programa', 'url' => array('/programa/admin')),
                                        array('label' => 'Planificación del Proyecto', 'url' => array('/proyecto/admin')),
                                        array('label' => 'Invitación y Calificación', 'url' => array('/calificacion/admin')),
                                        array('label' => 'Evaluación de las Ofertas/Adjudicación', 'url' => array('/adjudicacion/admin')),
                                        array('label' => 'Contratación', 'url' => array('/contratacion/admin')),
                                        array('label' => 'Gestión de los Contratos', 'url' => array('/contratos/admin')),
                                        array('label' => 'Avances en Ejecución de Proyectos', 'url' => array('/InicioEjecucion/admin')),
                                    ),
                                //'visible'=>!Yii::app()->user->isGuest,
                                ),
                                array('label' => 'Catálogos<span class="caret"></span>', 'itemOptions' => array('class' => 'dropdown-submenu'), 'visible' => !Yii::app()->user->isGuest, 'url' => '#', 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                                    'items' => array(
                                        //menu Planificacion de Programas                                      
                                        //array('label' => 'Operaciones', 'url' => array('/site/index'), 'itemOptions' => array('class' => 'dropdown-submenu'),
                                        //    'items' => array(
                                        //        array('label' => 'Listar Programas', 'url' => array('programa/index')),
                                        //       array('label' => 'Crear Programa', 'url' => array('programa/create')),
                                        //    ),
                                        //),
                                        //fin del sugmenu 
                                        array('label' => 'Planificación del Programa', 'url' => array('#'), 'itemOptions' => array('class' => 'dropdown-submenu'),
                                            'items' => array(
                                                 array('label' => 'Entidad de Adquisición', 'url' => array('entes/index')),
                                                array('label' => 'Funcionarios', 'url' => array('funcionarios/index')),
                                                array('label' => 'Rol', 'url' => array('rol/index')),
                                                array('label' => 'Sector', 'url' => array('sector/index')),
                                                array('label' => 'Sub-Sector', 'url' => array('subsector/index')),
                                                array('label' => 'Fuentes de Financiamiento', 'url' => array('fuentesfinan/index')),
                                            ),
                                        ),
                                         array('label' => 'Planificación del Proyecto', 'url' =>array('#'), 'itemOptions' => array('class' => 'dropdown-submenu'),
                                            'items' => array(
                                                array('label' => 'Clase', 'url' => array('clase/index')),
                                                array('label' => 'Funcionarios', 'url' => array('funcionarios/index')),
                                                array('label' => 'Ubicación Vial', 'url' => array('ubicacionvial/index')),
                                                array('label' => 'Región', 'url' => array('region/index')),
                                                array('label' => 'Departamentos', 'url' => array('departamento/index')),
                                                array('label' => 'Tramo', 'url' => array('tramo/index')),
                                                array('label' => 'Ruta', 'url' => array('ruta/index')),
                                                array('label' => 'Tipo de Red', 'url' => array('tipored/index')),
                                                array('label' => 'Propósito', 'url' => array('proposito/index')),
                                                array('label' => 'Municipio', 'url' => array('municipio/index')),
                                                array('label' => 'Fuentes de Financiamiento', 'url' => array('fuentesfinan/index')),
                                            
                                            ),
                                        ),
                                        array('label' => 'Invitacion y Calificacion', 'url' =>array('#'), 'itemOptions' => array('class' => 'dropdown-submenu'),
                                            'items' => array(
                                                array('label' => 'Funcionarios', 'url' => array('funcionarios/index')),
                                                array('label' => 'Tipo de Contrato', 'url' => array('tipocontrato/index')),
                                                array('label' => 'Entidad de Adquisición', 'url' => array('entes/index')),
                                                array('label' => 'Método de Adquisición', 'url' => array('tipoadquisicion/index')),
                                                array('label' => 'Oferentes/Empresas', 'url' => array('empresa/index')),
                                                
                                            ),
                                        ),
                                         array('label' => 'Evaluación de las Ofertas/Adjudicacion', 'url' =>array('#'), 'itemOptions' => array('class' => 'dropdown-submenu'),
                                            'items' => array(
                                                array('label' => 'Estatus del Proceso', 'url' => array('estadoproceso/index')),
                                                array('label' => 'Entidad de Adquisición', 'url' => array('entes/index')),
                                                array('label' => 'Oferentes/Empresas', 'url' => array('empresa/index')),
                                             ),
                                        ),
										array('label' => 'Contratación', 'url' =>array('#'), 'itemOptions' => array('class' => 'dropdown-submenu'),
                                            'items' => array(
                                                array('label' => 'Entidad de Administración de Contrato', 'url' => array('entes/admin')),
                                                array('label' => 'Consultor / Firma Contratada', 'url' => array('empresa/index')),
                                               
                                             ),
                                        ),
										array('label' => 'Gestión de Contratos', 'url' =>array('#'), 'itemOptions' => array('class' => 'dropdown-submenu'),
                                            'items' => array(
                                                array('label' => 'Estatus Contrato', 'url' => array('estadosgestcontra/admin')),
                                                array('label' => 'Tipo de Modificación al Contrato', 'url' => array('tipoModContrato/admin')),
                                               
                                             ),
                                        ),
                                         array('label' => 'Implementación', 'url' =>array('#'), 'itemOptions' => array('class' => 'dropdown-submenu'),
                                            'items' => array(
                                                 array('label' => 'Datos de Contacto', 'url' => array('contactos/index')),
                                                array('label' => 'Tipo de Garantía', 'url' => array('garantias/index')),
												array('label'=> 'Desembolsos', 'url'=>array('desembolsosMontos/admin')),
                                               
                                             ),
                                        ),
                                        array('label' => 'Avances de Ejecucion','url' =>array('#'), 'itemOptions' => array('class' => 'dropdown-submenu'),
                                            'items' => array(
                                                array('label' => 'Actividades', 'url' => array('catgTipoActividades/admin')),
                                                array('label' => 'Sub-Actividades', 'url' => array('catgSubActividades/admin')),
                                                array('label' => 'Unidad', 'url' => array('catgUnidades/admin')),
												
                                               
                                             ),
                                        ),
                                        array('label' => 'Generales', 'url' =>array('#'), 'itemOptions' => array('class' => 'dropdown-submenu'),
                                            'items' => array(
                                                array('label' => 'Estados', 'url' => array('estado/index')),
                                                array('label' => 'Tipo de Moneda', 'url' => array('monedas/index')),
                                           
                                               
                                             ),
                                        ),
                                        //array('label' => 'Planificación del Programa', 'url' => array('/funcionarios')),
                                        //array('label' => 'Planificación del Proyecto', 'url' => array('/funcionarios')),
                                        //array('label' => 'Invitacion y Calificacion', 'url' => array('/funcionarios')),
                                        //array('label' => 'Evaluación de las Ofertas/Adjudicacion', 'url' => array('/funcionarios')),
                                        //array('label' => 'Implementacion', 'url' => array('/funcionarios')),
                                        //array('label' => 'Avances de Ejecucion', 'url' => array('/funcionarios')),
                                        //array('label' => 'Generales', 'url' => array('/funcionarios')),
                                    ),
                                ),
                                array('label' => 'Admin. Usuarios <span class="caret"></span>', 'visible' => !Yii::app()->user->isGuest, 'url' => '#', 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                                    'items' => array(
                                        array('label' => Yii::app()->getModule('user')->t("Register"), 'url' => array('/cruge/ui/registration'), 'visible' => Yii::app()->user->isGuest),
                                        array('label' => Yii::app()->getModule('user')->t("Profile"), 'url' => Yii::app()->user->ui->userManagementAdminUrl, 'visible' => Yii::app()->user->isSuperAdmin),
                                    ),
                                ),
                                array('label' => 'Manual', 'url' => "images/Manual.pdf",/*'htmlOptions'=>array('target'=>'_blank')*/),
                                array('label' => 'Informes <span class="caret"></span>', 'url' => '#', 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                                    'items' => array(
                                        array('label' => 'Informes de Cumplimiento de Registro de la Información', 'url' => array('Ciudadano/Informecumplimiento')),
                                        array('label' => 'Informe de Visitas o Ingresos al Sistema', 'url' => array('Ciudadano/Informeingsistema')),
                                        array('label' => 'Informes Técnicos de los Proyectos', 'url' => array('Ciudadano/Informetecproyecto')),
                                        array('label' => 'Informes Técnicos de los Programas', 'url' => array('Ciudadano/Informetecprograma')),
                                        array('label' => 'Informes Gerenciales', 'url' => array('Ciudadano/Informes')),
                                    ),),
                               array('label' => 'SMQ', 'url' => '/smq'),
								//array('label' => 'SMQ', 'url' => http://soptravi.net/smq ,
				                array('label' => 'Login', 'url' => array('/cruge/ui/login'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => Yii::app()->getModule('user')->t("Logout") . ' (' . Yii::app()->user->name . ')', 'url' => Yii::app()->getModule('user')->logoutUrl, 'visible' => !Yii::app()->user->isGuest),
                            ),
                        ));
                        ?>
						<?php 
                            $this->widget('zii.widgets.CMenu', array(
                            'htmlOptions' => array('class' => 'pull-right nav'),
                            'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
                              'itemCssClass' => 'item-test hvr-underline-from-center',
                            'encodeLabel' => false,
                            'items' =>Yii::app()->user->rbac->getMenu(),
                        ));
                        ?>
                    </div><!--/.nav-collapse -->
                </div>

                <div class="container-fluid-bar">

                    </br>

                </div>

            </div>
        </div>

        <div class="cont">
            <div class="container-fluid">
<?php if (isset($this->breadcrumbs)): ?>
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
                <?php endif ?>

                <?php echo $content ?>


            </div><!--/.fluid-container-->
        </div>





            <div class="footer">
                <div class="container">
                    <div class="row">
                        <div id="footer-copyright" class="col-md-6">
                           <!-- Inicio | SMQ | Login -->
                        </div> <!-- /span6 -->
                        <div id="footer-terms" class="col-md-6" align="center">
                            <!--2014 Todos los Derechos Reservados. <a href="#" target="_blank">INSEP</a>. -->
							2014 Todos los Derechos Reservados. <a href="http://soptravi.net/site/" target="_blank">INSEP</a>.
                        </div> <!-- /.span6 -->
                    </div> <!-- /row -->
                </div> <!-- /container -->
            </div>
    </body>
</html>
