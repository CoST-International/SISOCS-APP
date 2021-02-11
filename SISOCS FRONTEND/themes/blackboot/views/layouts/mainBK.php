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
<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl;?>/css/style-blue.css" />
    <?php
        $cs->registerScriptFile($baseUrl.'/js/bootstrap.min.js');
        $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.sparkline.js');
        $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.min.js');
        $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.pie.min.js');
        $cs->registerScriptFile($baseUrl.'/js/charts.js');
        $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.knob.js');
        $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.masonry.min.js');
    ?>

</head>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<!-- <a class="brand" href="#"><?php echo Yii::app()->name ?></a> -->
                <a class="brand" href="#"><img src="images/logo.png" tittle="Sistema Información y Seguimiento de Obras y Contratos de Supervisión" /></a>
				<div class="nav-collapse">
					<?php $this->widget('zii.widgets.CMenu',array(
                        'htmlOptions'=>array('class'=>'pull-right nav'),
                        'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
                        'itemCssClass'=>'item-test',
                        'encodeLabel'=>false,
                        
                        'items'=>array(
                            array('label'=>'Inicio', 'url'=>array('/site/index')),
                            array('label'=>'Menu SISOCS <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                              'items'=>array(
                                array('label'=>'Planificación del Programa','url'=>array('/programa')),
                                array('label'=>'Planificación del Proyecto','url'=>array('/proyecto/admin')),
                                array('label'=>'Invitación y Calificación','url'=>array('/calificacion')),
                                array('label'=>'Evaluación de las Ofertas/Adjudicación','url'=>array('/adjudicacion')),
                                array('label'=>'Contratación','url'=>array('/contratacion')),  
                                array('label'=>'Gestión de los Contratos','url'=>array('/contratos')),
                                array('label'=>'Avances en ejecución de proyectos','url'=>array('/InicioEjecucion/admin')),   
                              ),
                            ),
                            array('label'=>'Admin. Usuarios <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                              'items'=>array(
                                    array('label'=>Yii::app()->getModule('user')->t("Register"),'url'=>array('/cruge/ui/registration'),  'visible'=>Yii::app()->user->isGuest),
                                    array('label'=>Yii::app()->getModule('user')->t("Profile"), 'url'=>Yii::app()->user->ui->userManagementAdminUrl, 'visible'=>Yii::app()->user->isSuperAdmin),
                                ),
                            ),
                             array('label'=>'Manual','url'=>"images/Manual.pdf"),
                             array('label'=>'Informes <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
                              'items'=>array(
                                array('label'=>'Informes de Cumplimiento de Registro de la Información','url'=>array('Ciudadano/Informecumplimiento')),
                                array('label'=>'Informe de Visitas o Ingresos al Sistema','url'=>array('Ciudadano/Informeingsistema')),
                                array('label'=>'Informes Técnicos de los Proyectos','url'=>array('Ciudadano/Informetecproyecto')),
                                array('label'=>'Informes Técnicos de los Programas','url'=>array('Ciudadano/Informetecprograma')),
                                array('label'=>'Informes Gerenciales','url'=>array('Ciudadano/Informes')),  
                              ),),
                            array('label'=>'SMQ','url'=>Yii::app()->getBaseUrl(true).'/smq'),
                            array('label'=>'Login', 'url'=>array('/cruge/ui/login'), 'visible'=>Yii::app()->user->isGuest),
                            array('label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')','url'=>Yii::app()->getModule('user')->logoutUrl,  'visible'=>!Yii::app()->user->isGuest),
                          ),
                )); 

            ?>
					
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	
	<div class="cont">
	<div class="container-fluid">
	  <?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
				'homeLink'=>false,
				'tagName'=>'ul',
				'separator'=>'',
				'activeLinkTemplate'=>'<li><a href="{url}">{label}</a> <span class="divider">/</span></li>',
				'inactiveLinkTemplate'=>'<li><span>{label}</span></li>',
				'htmlOptions'=>array ('class'=>'breadcrumb')
			)); ?>
		<!-- breadcrumbs -->
	  <?php endif?>
	
	<?php echo $content ?>
	
	
	</div><!--/.fluid-container-->
	</div>
    
    
	
	<div class="extra">
	  <div class="container">
		<div class="row">
			<div class="col-md-3">
				<h4>Menu SISOCS</h4>
				<ul>
					<li><a href="#">Planificación del Programa</a></li>
					<li><a href="#">Planificación del Proyecto</a></li>
					<li><a href="#">Invitación y Calificación</a></li>
					<li><a href="#">Evaluación de las Ofertas/Adjudicación</a></li>
                                        <li><a href="#">Contratación</a></li>
                                        <li><a href="#">Gestión de los Contratos</a></li>
                                        <li><a href="#">Avances en ejecución de proyectos</a></li>
				</ul>
			</div> <!-- /span3 -->
			
                        
                        
			<div class="col-md-3">
				<h4>Informes</h4>
				<ul>
					<li><a href="#">Informes de Cumplimiento de Registro de la Información</a></li>
					<li><a href="#">Informe de Visitas o Ingresos al Sistema</a></li>
					<li><a href="#">Informes Técnicos de los Proyectos</a></li>
					<li><a href="#">Informes Técnicos de los Programas</a></li>
                                        <li><a href="#">Informes Gerenciales</a></li>
				</ul>
			</div> <!-- /span3 -->
			
			
		</div> <!-- /container -->
	</div>
	
	<div class="footer">
	  <div class="container">
		<div class="row">
			<div id="footer-copyright" class="col-md-6">
				Inicio | SMQ | Login
			</div> <!-- /span6 -->
			<div id="footer-terms" class="col-md-6">
				2014 todos los derechos reservados. <a href="#" target="_blank">SOPTRAVI</a>.
			</div> <!-- /.span6 -->
		 </div> <!-- /row -->
	  </div> <!-- /container -->
	</div>
</body>
</html>
