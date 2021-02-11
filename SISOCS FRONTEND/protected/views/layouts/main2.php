<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
    
  <head>
        
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/themes/sisocs_mobile.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/themes/jquery.mobile.icons.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/themes/jquery.mobile.structure-1.4.5.min.css" />
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/themes/jquery-1.11.1.min.js"></script>
         
        
        <!-- modulo ciudadano  -->
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/ammap.js' ?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/hondurasLow.js' ?>"></script>
 <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/ammap.css' ?>" type="text/css"> 
        <!-- modulo ciudadano  -->
       
        
        <!-- resumen de ejecucion   -->
        <!--script type="text/javascript" src="<?php //echo Yii::app()->baseUrl.'/css/themes/googlemap.js' ?>"></script-->
        
        <!-- resumen de ejecucion   googlemap.js   -->  
        
             <script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/css/themes/jquery-1.11.1.min.js' ?>"></script>
        
       	<!--script src="http://code.jquery.com/jquery-1.11.1.min.js"></script-->
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.flexslider-min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/scripts.js"></script>
 
            
       
        
    </head>
    
    <body>
        <div class="container" id="page">
                       <?php 
                echo $content;              
            ?>

            <div class="clear"></div>
        </div><!-- page -->
    </body>
    
</html>
