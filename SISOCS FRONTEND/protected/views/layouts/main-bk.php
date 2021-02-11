<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rbac.css" />;
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
    <div id="logo" align="center">
                 <?php //echo CHtml::image(YII::app()->baseUrl."/images/soptravi01.jpg", 150,array('id'=>"img2"));?>
                 <img src="images/Imagen1.png" width="300">
                    <!--Sistema de Información y Seguimiento de Obras y Contratos de Supervisión-->
                </div>
  </div><!-- header -->
<div id="menu-top">
<?php $this->widget('application.extensions.mbmenu.MbMenu',array(
            'items'=>array(
                array('label'=>'Inicio', 'url'=>array('/site/index')),
                array('label'=>'Menu SISOCS', 'url'=>array('/mantenimiento'),
                  'items'=>array(
                    array('label'=>'Planificación del Programa','url'=>array('/programa')),
                    array('label'=>'Planificación del Proyecto','url'=>array('/proyecto')),
                    array('label'=>'Invitación y Calificación','url'=>array('/calificacion')),
                    array('label'=>'Evaluación de las Ofertas/Adjudicación','url'=>array('/adjudicacion')),
                    array('label'=>'Contratación','url'=>array('/contratacion')),  
                    array('label'=>'Gestión de los Contratos','url'=>array('/contratos')),
                    array('label'=>'Avances en Ejecucion de Proyectos','url'=>array('/InicioEjecucion')),   
                  ),
                ),
//                array('label'=>'Mantenimientos',
//                  'items'=>array(
//                    array('label'=>'Entes', 'url'=>array('/entes')),//,'visible'=>Yii::app()->user->checkAccess('admin')),
//                    array('label'=>'Proposito', 'url'=>array('/proposito')),
//                    array('label'=>'Estados', 'url'=>array('/estado')),
//                    array('label'=>'Departamentos', 'url'=>array('/departamento')),
//                    array('label'=>'Municipio', 'url'=>array('/municipio')),
//                    array('label'=>'Funcionarios', 'url'=>array('/funcionarios')),
//                    array('label'=>'Fuente de Financiamiento', 'url'=>array('/fuentesfinan')),
//                    array('label'=>'Estado red vial', 'url'=>array('/estadored')),
//                    array('label'=>'Tipo aquisición', 'url'=>array('/tiposadquisicion')),
//                    array('label'=>'Tipo de contrato', 'url'=>array('/tipocontrato')),
//                    array('label'=>'Estatus del proceso', 'url'=>array('/estadoproceso')),
//                      
//                    array('label'=>'Ruta', 'url'=>array('/ruta')),
//                    array('label'=>'Tramo', 'url'=>array('/tramo')),
//                    array('label'=>'Region', 'url'=>array('/region')),
//                    
//                  ),
//                ),
                array('label'=>'Admin. Usuarios',
                  'items'=>array(
                        array('label'=>Yii::app()->getModule('user')->t("Register"),'url'=>Yii::app()->getModule('user')->registrationUrl,  'visible'=>Yii::app()->user->isGuest),
                        array('label'=>Yii::app()->getModule('user')->t("Profile"), 'url'=>Yii::app()->user->ui->userManagementAdminUrl, 'visible'=>Yii::app()->user->isSuperAdmin),
                    ),
                ),
                 array('label'=>'Manuales','url'=>array('http://soptravi.net/sisocs//images/Manual.pdf')),
                 array('label'=>'Informes','url'=>array('#'),
                  'items'=>array(
                    array('label'=>'Informes de Cumplimiento de Registro de la Información','url'=>array('')),
                    array('label'=>'Informe de Visitas o Ingresos al Sistema','url'=>array('Ciudadano/Informeingsistema')),
                    array('label'=>'Informes Técnicos de los Proyectos','url'=>array('Ciudadano/Informetecproyecto')),
                    array('label'=>'Informes Técnicos de los Programas','url'=>array('Ciudadano/Informetecprograma')),
                    array('label'=>'Informes Gerenciales','url'=>array('Ciudadano/Informes')),  
                  ),),
                 array('label'=>'Login', 'url'=>array('/cruge/ui/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')','url'=>Yii::app()->getModule('user')->logoutUrl,  'visible'=>!Yii::app()->user->isGuest),
              ),
    )); 

?>
</div>
	<div id="mainmenu">
		<?php
//                $this->widget('zii.widgets.CMenu',array(
//			'items'=>array(
//				array('label'=>'Inicio', 'url'=>array('/site/index')),
//				array('label'=>'Acerca de', 'url'=>array('/site/page', 'view'=>'about')),
//				array('label'=>'Contactenos', 'url'=>array('/site/contact')),
//				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
//				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
//			),
//		));
                ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content;
          
        ?>

	<div class="clear"></div>

	<div id="footer">
            <?php echo CHtml::image(YII::app()->baseUrl."/images/eslogan1.png",50);
        echo '<br/>';
            ?>
        Copyright &copy; <?php echo date('Y'); ?>.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
