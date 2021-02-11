<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SISOCS V.3</title>
  
        
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
jQuery(function($) {

jQuery('body').on('click','#yt0',function(){jQuery.ajax({'type':'POST','url':'/sisocs/index.php?r=Ciudadano/BProyecto','cache':false,'data':jQuery(this).parents("form").serialize(),'success':function(html){jQuery("#proyectos").html(html)}});return false;});
/*jQuery('body').on('click','#yt1',function(){jQuery.ajax({'type':'POST','data':{'id':'15'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt2',function(){jQuery.ajax({'type':'POST','data':{'id':'09'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt3',function(){jQuery.ajax({'type':'POST','data':{'id':'02'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt4',function(){jQuery.ajax({'type':'POST','data':{'id':'07'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt5',function(){jQuery.ajax({'type':'POST','data':{'id':'06'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt6',function(){jQuery.ajax({'type':'POST','data':{'id':'17'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt7',function(){jQuery.ajax({'type':'POST','data':{'id':'08'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt8',function(){jQuery.ajax({'type':'POST','data':{'id':'18'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt9',function(){jQuery.ajax({'type':'POST','data':{'id':'01'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt10',function(){jQuery.ajax({'type':'POST','data':{'id':'11'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt11',function(){jQuery.ajax({'type':'POST','data':{'id':'03'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt12',function(){jQuery.ajax({'type':'POST','data':{'id':'12'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt13',function(){jQuery.ajax({'type':'POST','data':{'id':'05'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt14',function(){jQuery.ajax({'type':'POST','data':{'id':'16'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt15',function(){jQuery.ajax({'type':'POST','data':{'id':'10'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt16',function(){jQuery.ajax({'type':'POST','data':{'id':'13'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt17',function(){jQuery.ajax({'type':'POST','data':{'id':'04'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt18',function(){jQuery.ajax({'type':'POST','data':{'id':'14'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});*/
  $("#nav li").hover(
    function () {
      if ($(this).hasClass("parent")) {
        $(this).addClass("over");
      }
    },
    function () {
      $(this).removeClass("over");
    }
  );

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
					selectedColor: "#16a085"
				},
			
				smallMap: {}
			});
			
			
			map.addListener("clickMapObject", function (event) {
					var id = event.mapObject.id;
					var title = event.mapObject.title;
					//alert("Clicked on: " + title + " (" + id + ")");
                                        
                                        if(id==='HN-FM'){
                                          ClickMap('Francisco Morazán');
                                          jQuery.ajax({'type':'POST','data':{'id':'08'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                        else if (id==='HN-IB'){
                                           ClickMap('Islas de la Bahía');
                                           jQuery.ajax({'type':'POST','data':{'id':'11'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }                                        
                                        else if (id==='HN-CR'){
                                           ClickMap('Cortés');
                                           jQuery.ajax({'type':'POST','data':{'id':'05'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                        else if (id==='HN-AT'){
                                           ClickMap('Atlántidad');
                                           jQuery.ajax({'type':'POST','data':{'id':'01'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                        else if (id==='HN-CL'){
                                           ClickMap('Colón');
                                           jQuery.ajax({'type':'POST','data':{'id':'02'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }                                                                               
                                          else if (id==='HN-GD'){
                                           ClickMap('Gracias a Dios');
                                           jQuery.ajax({'type':'POST','data':{'id':'09'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-OL'){
                                           ClickMap('Olancho');
                                           jQuery.ajax({'type':'POST','data':{'id':'15'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-EP'){
                                           ClickMap('El Paraíso');
                                           jQuery.ajax({'type':'POST','data':{'id':'07'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-YO'){
                                           ClickMap('Yoro');
                                           jQuery.ajax({'type':'POST','data':{'id':'18'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-CM'){
                                           ClickMap('Comayagua');
                                           jQuery.ajax({'type':'POST','data':{'id':'03'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-CH'){
                                           ClickMap('Choluteca');
                                           jQuery.ajax({'type':'POST','data':{'id':'06'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-VA'){
                                           ClickMap('Valle');
                                           jQuery.ajax({'type':'POST','data':{'id':'17'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-LP'){
                                           ClickMap('La Paz');
                                           jQuery.ajax({'type':'POST','data':{'id':'12'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-IN'){
                                           ClickMap('Intibucá');
                                           jQuery.ajax({'type':'POST','data':{'id':'10'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-LE'){
                                           ClickMap('Lempira');
                                           jQuery.ajax({'type':'POST','data':{'id':'13'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-OC'){
                                           ClickMap('Ocotopeque');
                                           jQuery.ajax({'type':'POST','data':{'id':'14'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-CP'){
                                           ClickMap('Copán');
                                           jQuery.ajax({'type':'POST','data':{'id':'04'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
                                           }
                                           else if (id==='HN-SB'){
                                           ClickMap('Santa Bárbara');
                                           jQuery.ajax({'type':'POST','data':{'id':'16'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;
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
  <script>
/*  $(document).ready(function () {
  alert('Page has finished loading');
}); */
    
   /*  $(document).ready(function() {
                alert ("done");
            });*/
    
  </script>      
</head>
<body onload="">
	<div data-role="page" data-theme="a">
	
	<div data-role="panel" id="mypanel"  data-theme="a" >   
<ul data-role="listview" data-inset="true">
           <li><a href="/sisocs/index.php?r=mobile/index" data-transition="slide"  data-icon="home">Pagina Principal</a></li>
            <li><a href="#" class="ui-btn ui-state-disabled" data-icon="location">Modulo Ciudadano</a></li>
            <li><a href="#mypanel" data-icon="calendar">Reportes Gerenciales</a></li>  
            <li><a href="#" data-icon="action">Manual de Usuario</a></li>
        </ul>
    </div>
	
	
		<div data-role="header" data-position="inline" style="overflow:hidden;">
			<h1><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u21.png' ?>"/> </h1>
			<a href="#mypanel" data-icon="bars" class="ui-btn-right">Menu</a>
		</div>
		<div data-role="content" data-theme="b" >
                    
                    
                <div class="ui-corner-all custom-corners" >
                              <div class="ui-bar ui-bar-a">
                                <h3>Modulo Ciudadano</h3>
                              </div>
                            
                            
      <div class="ui-body ui-body-a">
          <div id="Div_showBoton" style="display:none;" >   
        <input type="submit" onclick="ShowMap()" value="Mostrar Mapa"  /> 
            </div>
     
         
         
  <div id="Div_Map">
  <form name="form" method="POST">
    <input id="filter-for-listview" data-type="search" placeholder="Buscar Proyecto">
    <input  type="submit" name="yt0" onclick="ClickMap('Resultado de la Busqueda')" value="Buscar" id="yt0" width="200px" />
</form>
 <div id="mapdiv" style="width:100%;height:300px;"></div>   

                                     
                                
                                
                                
            
                              </div>
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
                </div>
        </div>
</body>
</html>