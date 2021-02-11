<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SISOCS MOBILE</title>

<script type="text/javascript">

//if (screen.width >= 800) {
//window.location = "index.php?r=site/index";
//}

</script>
 <script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/css/themes/jquery-1.11.1.min.js' ?>"></script>

  <!-- Modulo Ciudadano  -->

   <style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0; width:100%;column-span:1;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:3px 3px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;font-family:"Lucida Sans Unicode", "Lucida Grande"}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:3px 3px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;width:33.3%;;font-family:"Lucida Sans Unicode", "Lucida Grande"}
.tg .tg-qp8u{color:#ffffff;text-align:center;margin:0px;}
.tg .tg-header{font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;font-size:36px;}
.tg .tg-encabezados{font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;font-size:23px;}
.tg .tg-sub-encabezados{font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;font-size:15px;}
.tg .tg-spacer{width:20%}

#map_canvas {
        width: 100%;
        height: 500px;
      }

.slideshow { margin: auto;width:auto; height:auto; }
.slideshow img { width: 100%; height: 100%; padding: 2px; }

/*.tab_cont {border-color:#000;border-style:dashed;text-align:center;height:10%;font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;height:20px !important}
.tab_cont tr th{background:#000;border-width:1px;font-size:20px;white-space:nowrap;}
.tab_cont th{color:#FFF;font-size:18px;}
.tab_cont tr td{border-width:1px;background:#FFCC33;font-size:12px}
#styled_td {border-width:1px;background:#FFF;} */

.tab_cont {border-color:#000;margin:0px;padding:0px;border-style:none;border:none;text-align:center;height:10%;font-family:Calibri, sans-serif;}
.tab_cont tr th{background:#EAB200;border-width:1px;border-top:thin;border-left:thin;white-space:nowrap;border-right:thin;font-size:15px;font-weight:bold;margin:0px;padding:3px !important;}
.tab_cont th{color:#000;font-size:15px;}
.tab_cont tr td{border-width:1px;background:#E7E7FF;font-size:12px;margin:0px;padding:3px;text-align:center !important;}
#styled_td {border-width:1px;background:#FFF;margin:2px;padding:0px !important;}

/*#mapdiv {
	width	: 100%;
	height	: 500px;
}	*/

</style>


<script type="text/javascript">
/*<![CDATA[*/
jQuery(function() {
//alert('#yto')
jQuery('body').on('click','#yt0',function(){jQuery.ajax({'type':'POST','url':'index.php?r=mobile/BProyecto','cache':false,'data':jQuery(this).parents("form").serialize(),'success':function(html){jQuery("#proyectos").html(html)}});return false;});

//  $("#nav li").hover(
//    function () {
//      if ($(this).hasClass("parent")) {
//        $(this).addClass("over");
//      }
//    },
//    function () {
//      $(this).removeClass("over");
//    }
//  );

//jQuery('#yii_bootstrap_collapse_0').collapse({'parent':false,'toggle':false});
});
/*]]>*/
</script>



      <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/themes/jquery-1.11.1.min.js"></script>
   <!-- Libreria MAPA HTML5 -->


 <script type="text/javascript">
			var map = AmCharts.makeChart("mapdiv", {
				type: "map",

				pathToImages: "<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/images_map/' ?>",

				balloon: {
					color: "#000000"
				},

				dataProvider: {
					map: "hondurasLow",
					getAreasFromMap: true
				},

				areasSettings: {
					autoZoom: true,
					selectedColor: "#CC0000"
				},

				smallMap: {}
			});


			map.addListener("clickMapObject", function (event) {
					var id = event.mapObject.id;
					var title = event.mapObject.title;
					//alert("Clicked on: " + title + " (" + id + ")");

                                        if(id==='HN-FM'){
                                          ClickMap('Francisco Morazán');
                                          jQuery.ajax({'type':'POST','data':{'id':'08'},'url':'index.php?r=mobile/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                        else if (id==='HN-IB'){
                                           ClickMap('Islas de la Bahía');
                                           jQuery.ajax({'type':'POST','data':{'id':'11'},'url':'index.php?r=mobile/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                        else if (id==='HN-CR'){
                                           ClickMap('Cortés');
                                           jQuery.ajax({'type':'POST','data':{'id':'05'},'url':'index.php?r=mobile/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                        else if (id==='HN-AT'){
                                           ClickMap('Atlántida');
                                           jQuery.ajax({'type':'POST','data':{'id':'01'},'url':'index.php?r=mobile/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                        else if (id==='HN-CL'){
                                           ClickMap('Colón');
                                           jQuery.ajax({'type':'POST','data':{'id':'02'},'url':'index.php?r=mobile/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                          else if (id==='HN-GD'){
                                           ClickMap('Gracias a Dios');
                                           jQuery.ajax({'type':'POST','data':{'id':'09'},'url':'index.php?r=mobile/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-OL'){
                                           ClickMap('Olancho');
                                           jQuery.ajax({'type':'POST','data':{'id':'15'},'url':'index.php?r=mobile/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-EP'){
                                           ClickMap('El Paraíso');
                                           jQuery.ajax({'type':'POST','data':{'id':'07'},'url':'index.php?r=mobile/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-YO'){
                                           ClickMap('Yoro');
                                           jQuery.ajax({'type':'POST','data':{'id':'18'},'url':'index.php?r=mobile/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-CM'){
                                           ClickMap('Comayagua');
                                           jQuery.ajax({'type':'POST','data':{'id':'03'},'url':'index.php?r=mobile/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-CH'){
                                           ClickMap('Choluteca');
                                           jQuery.ajax({'type':'POST','data':{'id':'06'},'url':'index.php?r=mobile/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-VA'){
                                           ClickMap('Valle');
                                           jQuery.ajax({'type':'POST','data':{'id':'17'},'url':'index.php?r=mobile/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-LP'){
                                           ClickMap('La Paz');
                                           jQuery.ajax({'type':'POST','data':{'id':'12'},'url':'index.php?r=mobile/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-IN'){
                                           ClickMap('Intibucá');
                                           jQuery.ajax({'type':'POST','data':{'id':'10'},'url':'index.php?r=mobile/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-LE'){
                                           ClickMap('Lempira');
                                           jQuery.ajax({'type':'POST','data':{'id':'13'},'url':'index.php?r=mobile/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-OC'){
                                           ClickMap('Ocotopeque');
                                           jQuery.ajax({'type':'POST','data':{'id':'14'},'url':'index.php?r=mobile/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-CP'){
                                           ClickMap('Copán');
                                           jQuery.ajax({'type':'POST','data':{'id':'04'},'url':'index.php?r=mobile/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-SB'){
                                           ClickMap('Santa Bárbara');
                                           jQuery.ajax({'type':'POST','data':{'id':'16'},'url':'index.php?r=mobile/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
				});

        </script>


<!-- Libreria MAPA HTML5 -->

  <script type="text/javascript" >

   function ClickMap(param){
       // alert(param);

          $('#Cont_Encabezado').hide(500);
          $('#Div_Encabezado1').hide(500);
          $('#Div_Encabezado2').hide(500);
          $('#Div_Encabezado3').hide(500);
          $('#Div_Map').hide(1500);
          $('#Div_showBoton').show(500);
          document.getElementById('LblMunicipio').textContent   = param;
    }
    function ShowMap(){
          $('#Div_showBoton').hide(1500);
          $('#Div_Map').show(500);
          $('#Cont_Encabezado').show(500);
          $('#Div_Encabezado1').show(500);
          $('#Div_Encabezado2').show(500);
          $('#Div_Encabezado3').show(500);
    }

   function addScript(filename)
{


 var scriptBlock=document.createElement('script')
 scriptBlock.setAttribute("type","text/javascript")
 scriptBlock.setAttribute("src", filename)
 document.getElementsByTagName("head")[0].appendChild(scriptBlock)
}
  function addScript2(filename)
{
 var scriptBlock=document.createElement('script')
 scriptBlock.setAttribute("type","text/javascript")
 scriptBlock.setAttribute("src", filename)
 document.getElementsByTagName("head")[0].appendChild(scriptBlock)
}

function reloadDIV(){
   $("#mapdiv").load(location.href + " #mapdiv");
   alert('hello');
};

    </script>

  <!-- Modulo Ciudadano   -->
</head>
<body>





    <div data-role="page" id="principal" data-theme="a">

		<div data-role="header" data-position="inline" style="overflow:hidden;">
                    <h1><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u21.png' ?>" width="100%"/> </h1>
		</div>

          <!--div data-role="panel" id="mypanel"  data-theme="a" >
<ul data-role="listview" data-inset="true">
           <li><a href="#" data-transition="slidedown" class="ui-btn ui-state-disabled" data-icon="home">Pagina Principal</a></li>
            <li><a href="#ModuloCiudadano"   data-transition="slide" data-icon="location">Modulo Ciudadano</a></li>
            <li><a href="#mypanel" data-icon="calendar">Reportes Gerenciales</a></li>  
            <li><a href="#" data-icon="action">Manual de Usuario</a></li>
        </ul>
    </div-->


		<div data-role="collapsible" data-collapsed="false" data-theme="a"  data-collapsed-icon="carat-d" data-expanded-icon="carat-u" >
                <!--div class="ui-corner-all custom-corners" -->
                              <!--div class="ui-bar ui-bar-a"-->
                                <h4>Sistema de Información y Seguimiento de Obras y Contratos de Supervisión</h4>
                              <!--/div-->




         <div class="slider grid col-one-half mq2-col-full">
		   <div class="flexslider">
		     <div class="slides">
		       <div class="slide">

                                    <img src="images/img2.jpg" width="100%" alt="">

		           </div>

		           <!--div class="slide">

                                    <img src="images/img.jpg" width="100%" alt="">


		               </div>

                         <div class="slide">

                                    <img src="images/img3.jpg" width="100%" alt="">


		               </div-->
		            </div>


		   </div>
		 </div>




             <p><strong>SISOCS es una herramienta mediante la cual se publica y difunde información relevante de los procesos de construcción, supervisión y mantenimiento de la red vial oficial del país, gestionados por la Dirección General de Carreteras y el Fondo Vial.

Mediante el SISOCS, puedes visualizar avances físicos y financieros de las obras, también obtienes un resumen con información básica de la planificación del proyecto, los procesos de adquisición, la gestión de contratos, fotos, y ubicación geográfica de los proyectos. También puedes descargar información pública relacionada.

El SISOCS es de fácil ingreso y consulta pero si necesitas ayuda puedes descargar el Manual Operativo que te guiará paso a paso en el uso del mismo.</strong></p>
                              <!--/div-->
                            </div>


		<!--form>
    <input id="filter-for-listview" data-type="search" placeholder="Buscar Departamento">

</form>
        <ul data-role="listview" data-inset="true" data-filter="true" data-input="#filter-for-listview">
            <li><a href="/sisocs/index.php?r=mobile/mob_ciudadano">Francisco Morazan</a></li>
            <li><a href="#">Choluteca</a></li>
            <li><a href="#">Islas de la Bahia</a></li>
            <li><a href="#">Gracias a Dios</a></li>
            <li><a href="#">Lempira</a></li>
        </ul-->

                <div data-role="collapsible" data-collapsed="false" data-theme="a"  data-collapsed-icon="carat-d" data-expanded-icon="carat-u" >
                               <!--div class="ui-corner-all custom-corners" -->
                              <!--div class="ui-bar ui-bar-a"-->
                                <h4>Módulo Ciudadano</h4>
                              <!--/div-->


      <!--div class="ui-body ui-body-a"-->
          <div id="Div_showBoton" style="display:none;" >
        <input type="submit" onclick="ShowMap()" value="Mostrar Mapa"  />
            </div>



  <div id="Div_Map">
  <form name="form" method="POST">
          <input id="criterio" name="criterio" data-type="search" placeholder="Buscar Proyecto">
    <input  type="submit" name="yt0" onclick="ClickMap('Resultado de la Busqueda')" value="Buscar" id="yt0" width="200px" />

       <!--?php echo CHtml::Button('Buscar',array('onclick'=>'send();ClickMap("Resultado de la Busqueda");')); ?-->

</form>
 <div id="mapdiv" style="width:100%;height:300px;"></div>
  </div>

       <table class="tg"  style="table-layout: fixed;">
<colgroup>
<col >
<col>
<col >
</colgroup>
  <tr>
    <th class="tg-qp8u"></th>
    <th class="tg-031e"></th>
    <th class="tg-031e"></th>
  </tr>
  <td class="tg-encabezados" colspan="3"  align="center"><strong><label style="font-size:30px;" id="LblMunicipio"></label></strong></td>
</table>






<div id='proyectos'></div>
<div id='programas'></div>




    </div>


             <div data-role="collapsible" data-collapsed="false" data-theme="a"  data-collapsed-icon="carat-d" data-expanded-icon="carat-u" >

                                <h4>Reportes Gerenciales</h4>


                   <table  class="tg">
 <tr>
     <td width="100%" class="tg-031e"  style="text-align:center" >
			 <?php

			 $command = Yii::app()->db->createCommand("CALL sp_portal_indicadores();");
			 $ind = $command->queryAll();

			 ?>
      <div  class="tg-031e"><strong> Proyectos Registrados: <br /> <input type="text" name="nobras" value="<?php echo $ind[0]['proyectos'];?>" readonly="true"></strong></div>
        <div class="tg-031e"><strong><?php $sum=Yii::app()->db->createCommand()
                ->select('sum(precioLPS)')
                ->from('cs_contratacion')
                ->queryScalar();?>
Montos Contratados: <br /> <input type="text" name="moncon" size="40" value="LPS. <?php echo number_format($ind[0]['contratado'],2,'.',',');?>" readonly="true"></strong></div>
<div align="center">
<?php
//$contratacion->fechafinal=strtotime($contratacion->fechafinal);
//$fa=date("d/m/Y",strtotime($fa));
$fa=date("d/m/Y");
echo $fa;
$eje=count(Contratacion::Model()->findAll("fechafinal >'".$fa."'"));///count(Contratacion::Model()->findAll())*100;
$fin=Count(Contratacion::Model()->findAll("fechafinal <'".$fa."'"));///count(Contratacion::Model()->findAll())*100;
$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options' => array(
            'gradient' => array('enabled'=> true),
        'credits' => array('enabled' => false),
        'exporting' => array('enabled' => false),
        'chart' => array(
        'plotBackgroundColor' => null,
        'backgroundColor' => 'transparent',
        'plotBorderWidth' => null,
        'plotShadow' => false,
       // 'height' => 300,
       // 'width' => 300,
        ),
        'legend' => array(
        'enabled' => false,
        ),
        'title' => array(
        'text' => 'Proyectos a Nivel Nacional'
        ),
        'plotOptions' => array(
        'pie' => array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array(
            'enabled' => true,
            'color' => '#000000',
            'connectorColor' => '#000000',
            'format'=>'<b>{point.name}</b>: {point.percentage:.1f} %',
            ),
        )
        ),
        'series' => array(
        array(
            'type' => 'pie',
            'name' => '# de Proyectos',
            'data' => array(array('En ejecucion', $eje), array('Finalizados', $fin),),
        )
        ),
        )));
?>
</div>

     </td>
 </tr>
 <tr>
    <td width="100%" valign="top" class="tg-031e" style="text-align:center">

        <div align="center">

            <?php
$bcie=count(ProyectoFuente::Model()->findAll("idFuente ='0000000001'"));
$bid=Count(ProyectoFuente::Model()->findAll("idFuente ='0000000002'"));
$bm=count(ProyectoFuente::Model()->findAll("idFuente ='0000000003'"));
$fn=Count(ProyectoFuente::Model()->findAll("idFuente ='0000000004'"));
$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options' => array(
            'gradient' => array('enabled'=> true),
        'credits' => array('enabled' => false),
        'exporting' => array('enabled' => false),
        'chart' => array(
        'plotBackgroundColor' => null,
        'backgroundColor' => 'transparent',
        'plotBorderWidth' => null,
        'plotShadow' => false,
      //  'height' => 500,
      //  'width' => 750,
        ),
        'legend' => array(
        'enabled' => false,
        ),
        'title' => array(
        'text' => 'Proyectos Según su Fuente de Financiamiento'
        ),
        'plotOptions' => array(
        'pie' => array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array(
            'enabled' => true,
            'color' => '#000000',
            'connectorColor' => '#000000',
            'format'=>'<b>{point.name}</b>: {point.percentage:.1f} %',
            ),
        )
        ),
        'series' => array(
        array(
            'type' => 'pie',
            'name' => '# de Proyectos',
            'data' => array(array('Banco Centroamericano de Integración Económica', $bcie),
                array('Banco Interamericano de Desarrollo ', $bid),
                array('Banco Mundial', $bm),
                array('Fondos Nacionales', $fn)),
        )
        ),
        )));
?>


        </div>

    </td>
    </tr>
    <tr>
    <td width="100%" valign="top" class="tg-031e" style="text-align:center">

        <div align="center">

          <?php
$arm=0; //count(Proyecto::Model()->findAll("idRegion ='0000000001'"));
$brp=0; //count(Proyecto::Model()->findAll("idRegion ='0000000002'"));
$cen=0; //count(Proyecto::Model()->findAll("idRegion ='0000000003'"));
$cnd=0; //count(Proyecto::Model()->findAll("idRegion ='0000000004'"));
$ep=0; //count(Proyecto::Model()->findAll("idRegion ='0000000005'"));
$gdf=0; //count(Proyecto::Model()->findAll("idRegion ='0000000006'"));
$lm=0; //count(Proyecto::Model()->findAll("idRegion ='0000000007'"));
$ndo=0; //count(Proyecto::Model()->findAll("idRegion ='0000000008'"));
$occ=0; //count(Proyecto::Model()->findAll("idRegion ='0000000009'"));
$rl=0; //count(Proyecto::Model()->findAll("idRegion ='0000000010'"));
$sb=0; //count(Proyecto::Model()->findAll("idRegion ='0000000011'"));
$vdc=0; //count(Proyecto::Model()->findAll("idRegion ='0000000012'"));
$vdl=0; //count(Proyecto::Model()->findAll("idRegion ='0000000013'"));

$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options' => array(
            'gradient' => array('enabled'=> true),
        'credits' => array('enabled' => false),
        'exporting' => array('enabled' => false),
        'chart' => array(
        'plotBackgroundColor' => null,
        'backgroundColor' => 'transparent',
        'plotBorderWidth' => null,
        'plotShadow' => false,
      //  'height' => 500,
      //  'width' => 750,
        ),
        'legend' => array(
        'enabled' => false,
        ),
        'title' => array(
        'text' => 'Obras por Región'
        ),
        'plotOptions' => array(
        'pie' => array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array(
            'enabled' => true,
            'color' => '#000000',
            'connectorColor' => '#000000',
            'format'=>'<b>{point.name}</b>: {point.percentage:.1f} %',
            ),
        )
        ),
        'series' => array(
        array(
            'type' => 'pie',
            'name' => '# de Obras',
            'data' => array(array('Arrecife Mesoamericano', $arm),
                    array('Biósfera Río Plátano', $brp),
                    array('Centro', $cen),
                    array('Cordillera Nombre de Dios', $cnd),
                    array('El Paraíso', $ep),
                    array('Golfo de Fonseca', $gdf),
                    array('La Mosquitia', $lm),
                    array('Norte de Olancho', $ndo),
                    array('Occidente', $occ),
                    array('Río Lempa', $rl),
                    array('Santa Bárbara', $sb),
                    array('Valle de Comayagua', $vdc),
                    array('Valle de Lean', $vdl),
        )
        ),
        ))));
?>


        </div>

    </td>
    </tr>
    <tr>
    <td width="100%" valign="top" class="tg-031e" style="text-align:center">

        <div align="center">

       <?php
$con=count(Proyecto::Model()->findAll("idProposito ='0000000001'"));
$ape=count(Proyecto::Model()->findAll("idProposito ='0000000002'"));
$pav=count(Proyecto::Model()->findAll("idProposito ='0000000003'"));
$reh=count(Proyecto::Model()->findAll("idProposito ='0000000002'"));
$mvp=count(Proyecto::Model()->findAll("idProposito ='0000000004'"));
$mvr=count(Proyecto::Model()->findAll("idProposito ='0000000005'"));
$sup=count(Proyecto::Model()->findAll("idProposito ='0000000006'"));

$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options' => array(
            'gradient' => array('enabled'=> true),
        'credits' => array('enabled' => false),
        'exporting' => array('enabled' => false),
        'chart' => array(
        'plotBackgroundColor' => null,
        'backgroundColor' => 'transparent',
        'plotBorderWidth' => null,
        'plotShadow' => false,
      //  'height' => 500,
      //  'width' => 750,
        ),
        'legend' => array(
        'enabled' => false,
        ),
        'title' => array(
        'text' => 'Obras por Propósito'
        ),
        'plotOptions' => array(
        'pie' => array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array(
            'enabled' => true,
            'color' => '#000000',
            'connectorColor' => '#000000',
            'format'=>'<b>{point.name}</b>: {point.percentage:.1f} %',
            ),
        )
        ),
        'series' => array(
        array(
            'type' => 'pie',
            'name' => '# de Obras',
            'data' => array(array('Construcción', $con),
                    array('Rehabilitación', $reh),
                    array('Pavimentación', $pav),
                    array('Mantenimiento Rutinario', $mvr),
                    array('Mantenimiento Períodico', $mvp),
                    array('Supervision', $sup),
        )
        ),
        ))));
?>


        </div>

    </td>
    </tr>
</table>

    </div>

                <a href="images/Manual.pdf" target="_blank" class="ui-btn ui-icon-info ui-btn-icon-left ui-corner-all ">Manual de Usuario</a>
		</div>







    <!-- Modulo Ciudadano -->

</body>
</html>
