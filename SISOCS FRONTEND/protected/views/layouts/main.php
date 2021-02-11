<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="es" />
            <?php
          //  Yii::app()->clientScript->registerCoreScript('jquery');
          //  Yii::app()->clientScript->registerScriptFile("assets/bootstrap/js/bootstrap.min.js");
         //   Yii::app()->clientScript->registerCssFile("assets/bootstrap/css/bootstrap.min.css");
            ?>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rbac.css" />;
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/customDragon.css" />;
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    
    <body onLoad='calcRoute()'>
        <div class="container" id="page">
            <?php if(isset($this->breadcrumbs)):?>
                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links'=>$this->breadcrumbs,
                )); ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php 
                echo $content;              
            ?>

            <div class="clear"></div>
        </div><!-- page -->
    </body>
    
</html>
