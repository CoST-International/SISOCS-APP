
<?php
/* @var $this SiteController */
//$this->pageTitle = Yii::app()->name;

if (Yii::app()->Controller->getIsMobile()) {

    Yii::app()->theme='classic';
    $url = $this->createAbsoluteUrl('/mobile/index');
    $this->redirect($url, true);

}
else {
  $url = $this->createAbsoluteUrl('Ciudadano/index');
  $this->redirect($url, true);
}

?>

</br>

<div class="home-page main">
    <section class="grid-wrap" >
        <header class="grid col-full">
            <hr>
            <center>
                <a href="<?php echo Yii::app()->getBaseUrl(true);  ?>/index.php?r=Ciudadano/index">
                <input type="button" value="Módulo de Información Ciudadana">
                </a>
				<a href="<?php echo Yii::app()->getBaseUrl(true);  ?>/index.php?r=Ciudadano/mapaproyectos">
                <input type="button" value="Mapa de Proyectos">
                </a>
            </center>
            <br/>
        </header>


        <div class="slider grid col-one-half mq2-col-full">
            <div class="flexslider">
                <div class="slides">
                    <?php

                           $imagenes2=  Yii::app()->db->createCommand()
                                                   ->select('*')
                                                   ->from('v_proyectos_carrousel')
                                                   ->order('ubicacion_imagen')
                                                   ->query();

                           foreach ($imagenes2 as $rowXY)
                            {
                                echo "<div class='slide'>";
                                    echo "<figure>";
                                        echo "<a href='?r=ciudadano/FichaTecnica&control=Contratacion&id=". $rowXY['idContratacion'] ."'>";
                                            echo "<img src='".$rowXY['ubicacion_imagen'] ."'>";
                                        echo "</a>";
                                        echo "<figcaption>";
                                            echo "<div>";
                                                echo "<h5>". $rowXY['nombre_proyecto']."</h5>";
                                                echo "<p>".$rowXY['descrip'].",<a href='?r=ciudadano/FichaTecnica&control=Contratacion&id=". $rowXY['idContratacion'] ."'>Ir a proyecto</a></p>";
                                            echo "</div>";
                                        echo "</figcaption>";
                                    echo "</figure>";
                                echo "</div>";
                            }
                    ?>
                </div>


            </div>

        </div>

        <div class="grid col-one-half mq2-col-full">

            <h7>SISOCS </h7>v 2.0
            <h1>Sistema de Información y Seguimiento de Obras y Contratos de Supervisión </h1>
            <table width="95%">
              <tr>
                <td><p align="justify" style="color: grey;">El Sistema de Información y Seguimiento de Obras y Contratos de Supervisión (SISOCS), fue creado mediante Decreto Ejecutivo 02-2015, como un subsistema del Sistema de Contratación y Adquisiciones del Estado, HonduCompras.</p></td>
                <td valign="middle" style="min-width:86px;"><img src="images/logos/bienvenida.png" alt="Bienvenida" height="88" width="86"></td>
              </tr>
            </table><br/>
            <table width="95%">
              <tr>
                <td valign="middle" style="min-width:86px;"><img src="images/logos/info.png" alt="Divulgacion" height="88" width="86"></td>
                <td><p align="justify" style="color: grey;">Mediante el SISOCS se divulga información completa y sistematizada, por fases, durante todo el ciclo de vida de los proyectos de infraestructura pública gestionados por las instituciones del Gabinete de Infraestructura Productiva y otras instituciones públicas.</p></td>
              </tr>
            </table><br/>
            <table width="95%">
              <tr>
                <td><p align="justify" style="color: grey;">Para acceder a la información de los proyectos haga clic en el logo de la institución de su interés y luego proceda al módulo de información ciudadana para búsqueda detallada vía texto o ubicación en el mapa de Honduras.</p></td>
                <td  valign="middle"  style="min-width:86px;"><img src="images/logos/busqueda.png" alt="" height="88" width="86"></td>
              </tr>
            </table>
            </br>
            <!--
            <p align="justify" style="color: grey;">SISOCS es una herramienta mediante la cual se publica y difunde información relevante de los procesos de construcción, supervisión y mantenimiento de la red vial oficial del país, gestionados por la Dirección General de Carreteras y el Fondo Vial.</p>
            <p align="justify" style="color: grey;">Mediante el SISOCS, puedes visualizar avances físicos y financieros de las obras, también obtienes un resumen con información básica de la planificación del proyecto, los procesos de adquisición, la gestión de contratos, fotos, y ubicación geográfica de los proyectos. También puedes descargar información pública relacionada.</p>
            <p align="justify" style="color: grey;" >El SISOCS es de fácil ingreso y consulta pero si necesitas ayuda puedes descargar el Manual Operativo que te guiará paso a paso  en el uso del mismo.</p>
            </br>
          -->

        </div>


    </section>
    </br>
    </br>
    </br>




</div> <!--main-->

<?php
//echo "<br/>". CHtml::image(YII::app()->baseUrl."/images/mapa01.jpg",50);
Yii::app()->clientScript->registerCoreScript('jquery');
//Yii::app()->clientScript->registerScriptFile("assets/bootstrap/js/bootstrap.min.js");
//Yii::app()->clientScript->registerCssFile("assets/bootstrap/css/bootstrap.min.css");
?>



<!-- Javascript - jQuery -->
<!--script src="http://code.jquery.com/jquery.min.js"></script-->
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/css/themes/jquery.min.js' ?>"></script>

<script>window.jQuery || document.write('<script src="js/jquery-1.7.2.min.js"><\/script>')</script>

<!--[if (gte IE 6)&(lte IE 8)]>
<script src="js/selectivizr.js"></script>
<![endif]-->

<script src="js/jquery.flexslider-min.js"></script>
<script src="js/scripts.js"></script>
<style>
    .slide figcaption{
        //background-color:none;
        background-image: url("images/cubo.png");
    }
</style>
