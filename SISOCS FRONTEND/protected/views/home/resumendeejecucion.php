c

<?php

//$config = Yii::app()->baseUrl.'/images/ciudadano_reportes/config.php';

include('config.php');



$IdPrograma = $_GET['IdPrograma'];
$IdProyecto = $_GET['IdProyecto'];
$idContratacion = $_GET['IdContratacion'];

//$IdPrograma = 93;depar
//$IdProyecto = 147;


 $SQL_ = "SELECT nombreprograma,
  (SELECT descripcion FROM cs_entes e WHERE p.entes = e.idente)AS entes,
  (SELECT sector FROM cs_sector s WHERE p.idSector = s.idsector) AS sector,
  (SELECT subsector FROM cs_subsector su WHERE p.idsector =su.idsector and su.idSubSector = p.idSubSector) AS SubSector,
  descripcion FROM cs_programa p where idPrograma =$IdPrograma;";
                $result_=mysql_query($SQL_);	
	       
	     	  $row_ = mysql_fetch_array($result_);
                    {						  
			  $programa = $row_['nombreprograma'];
			  $entes = $row_['entes'];
			  $sector = $row_['sector'];
			  $SubSector = $row_['SubSector'];
			  $descripcion = $row_['descripcion']; 
					}
					
	$sql2="select p.nombre_proyecto,
  (select departamento from cs_departamento d where p.idDepto = d.codigoDepto) as departamento,
  p.descrip  
 from cs_proyecto p, cs_programa pro where pro.idPrograma = $IdPrograma and pro.idPrograma = p.idPrograma and p.idProyecto=$IdProyecto;";
                   $result2=mysql_query($sql2);	
	       
	     	  $row2 = mysql_fetch_array($result2);
                    {  
			  $nombre_proyecto = $row2['nombre_proyecto'];
			  $departamento = $row2['departamento'];		
			  $descrip = $row2['descrip'];					 
					}
					
		$sql3="select c.titulocontrato,
(select nombre_oferente from cs_oferente o where o.idoferentes = c.idoferente) as Firma,
c.precio as Monto_Lps,
co.precioactual as Monto_Lps_Ultimo,
c.precio2 as Monto_USD,
c.alcances,
c.fechainicio,
c.fechafinal,
ca.tipocontrato,
co.nmodifica,
co.fechatercontra as FechaFinalActualizada
from cs_contratos co, cs_contratacion c, cs_programa p, cs_proyecto pr,cs_adjudicacion a, cs_calificacion ca
where c.idAdjudicacion = a.idAdjudicacion and a.idCalificacion = ca.idCalificacion and ca.idProyecto = pr.idProyecto
and pr.idProyecto = $IdProyecto and pr.idPrograma = p.idPrograma and p.idPrograma = $IdPrograma and co.idContratacion = c.idContratacion and ca.tipocontrato like 'Cons%'
order by co.nmodifica desc limit 1; ";
                   $result3=mysql_query($sql3);	
	       
	     	  $row3 = mysql_fetch_array($result3);
                    {  
			  $titulocontrato = $row3['titulocontrato'];
			  $Firma_Contrato = $row3['Firma'];		
			  $Monto_Lps_Contrato = $row3['Monto_Lps'];
                          $Monto_Lps_Ultimo = $row3['Monto_Lps_Ultimo'];
			  $Monto_USD_Contrato = $row3['Monto_USD'];	
			  $alcances_Contrato = $row3['alcances'];	
			  $fechainicio_Contrato = $row3['fechainicio'];
			  $fechafinal_Contrato = $row3['fechafinal'];
                          $tipocontrato = $row3['tipocontrato'];
                          $fechafinaActualizada = $row3['FechaFinalActualizada'];
					}
					
$sql4="select c.titulocontrato,
(select nombre_oferente from cs_oferente o where o.idoferentes = c.idoferente) as Firma,
c.precio as Monto_Lps,
c.precio2 as Monto_USD,
c.alcances,
c.fechainicio,
c.fechafinal,
ca.tipocontrato
from cs_contratacion c, cs_programa p, cs_proyecto pr,cs_adjudicacion a, cs_calificacion ca
where c.idAdjudicacion = a.idAdjudicacion and a.idCalificacion = ca.idCalificacion and ca.idProyecto = pr.idProyecto
and pr.idProyecto = $IdProyecto and pr.idPrograma = p.idPrograma and p.idPrograma = $IdPrograma and ca.tipocontrato not like 'Cons%' ;";
                   $result4=mysql_query($sql4);	
	       
	     	  $row4 = mysql_fetch_array($result4);
                    {  
			  $S_titulocontrato = $row4['titulocontrato'];
			  $S_Firma_Contrato = $row4['Firma'];		
			  $S_Monto_Lps_Contrato = $row4['Monto_Lps'];
			  $S_Monto_USD_Contrato = $row4['Monto_USD'];	
			  $S_alcances_Contrato = $row4['alcances'];	
			  $S_fechainicio_Contrato = $row4['fechainicio'];
			  $S_fechafinal_Contrato = $row4['fechafinal'];
                          $S_tipocontrato = $row4['tipocontrato'];
					}
	
	$sql5="select c.idContratacion,
c.titulocontrato,
 CASE c.precio WHEN 0 THEN concat('USD ',cast(c.precio2 as char)) ELSE concat('Lps. ',cast(c.precio as char)) END as Monto,
c.fechainicio,
c.fechafinal 
from cs_contratacion c, cs_programa p, cs_proyecto pr,cs_adjudicacion a, cs_calificacion ca
where c.idAdjudicacion = a.idAdjudicacion and a.idCalificacion = ca.idCalificacion and ca.idProyecto = pr.idProyecto
and pr.idProyecto = $IdProyecto and pr.idPrograma = p.idPrograma and p.idPrograma = $IdPrograma ;";
                   $result5=mysql_query($sql5);	
	       
	     	  $row5 = mysql_fetch_array($result5);
                    {  
			  $A_titulocontrato = $row5['titulocontrato'];				
			  $A_Monto = $row5['Monto'];			 
			  $A_fechainicio_Contrato = $row5['fechainicio'];
			  $A_fechafinal_Contrato = $row5['fechafinal'];						 
					}
					
 $sql6 = "select e.codigo, 
e.geo_latitud,
e.geo_longitud,
e.fecha_inicio,
e.fecha_registro 
from cs_inicio_ejecucion e, cs_contratacion c,cs_adjudicacion a,cs_calificacion ca, cs_proyecto p, cs_programa pro
where e.idContratacion = c.idContratacion and c.idAdjudicacion = a.idAdjudicacion and a.idCalificacion = ca.idCalificacion
and ca.idProyecto = p.idProyecto and p.idProyecto = $IdProyecto and p.idPrograma = pro.idPrograma and pro.idPrograma = $IdPrograma order by codigo desc limit 1;"; 					
           $result6=mysql_query($sql6);	
	       
	     	  $row6 = mysql_fetch_array($result6);
                    {  
			  $map_latitud = (int)$row6['geo_latitud'];
			  $map_longitud = (int)$row6['geo_longitud'];
					}
?>
<?php
/* @var $this CiudadanoController */

$this->breadcrumbs=array(
   'Contratación'=>array('FichaTecnica&control=Contratacion&id='.$idContratacion), 'Resumen de Ejecución',
);
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile("assets/bootstrap/js/bootstrap.min.js");
Yii::app()->clientScript->registerCssFile("assets/bootstrap/css/bootstrap.min.css");
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="UTF-8">
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/jquery-1.11.1.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/jquery.cycle2.js' ?>"></script>
<script>$.fn.cycle.defaults.autoSelector = '.slideshow';</script>
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
</style>


 <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
      function initialize() {
		var latitud = <?php echo $map_latitud ?>;  
		var longitud = <?php echo $map_longitud ?>;  
		
	
  var mapCanvas = document.getElementById('map_canvas');
      // var image = '/mapa_sisocs.png';
	  var iconBase = 'https://maps.google.com/mapfiles/kml/paddle/';
       var myLatlng = new google.maps.LatLng(latitud,longitud);
	   
        var mapOptions = {
          center: myLatlng,
          zoom: 10,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
	      var map = new google.maps.Map(mapCanvas, mapOptions);
		
		var marker = new google.maps.Marker({
			position: myLatlng,
                       
			//icon: image
			 icon: iconBase + 'ylw-stars.png'
		});
		
		// To add the marker to the map, call setMap();
		marker.setMap(map);
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Resumen de Ejecución - SISOCS</title>
</head>

<body>
<table class="tg" style="table-layout: fixed;">
<colgroup>
<col >
<col>
<col >
</colgroup>
  <tr>
    <th class="tg-qp8u"></th>
    <th class="tg-031e"></th>
    <th class="tg-031e"> <img  src="<?php //echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u21.png' ?>" /></th>
  </tr>
  <tr>
    <td class="tg-header" colspan="3"  align="center"><strong>Resumen de Ejecución</strong></td>
  </tr>
  <tr>
   <td height="40">
   </td>
  </tr>
 
    <td class="tg-encabezados" colspan="3">Información del programa</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
</table>

<table  class="tg">
     <td width="70%" valign="top" class="tg-031e"  style="text-align:left;">
         <table width="100%">
             <tr>
              <td width="10%"><strong>Ente(s) Responsable(s):<strong></td>
              <td><?php echo $entes ?></td>             
             </tr>
             <tr>
               <td width="10%"><strong>Sector:<strong></td>
             <td><?php echo $sector ?></td> 
             </tr>
              <tr>
               <td width="10%"><strong>Sub Sector Vial:<strong></td>
             <td> <?php echo $SubSector ?></td> 
             </tr>
              <tr>
               <td width="10%"><strong>Descripción del Programa:<strong></td>
             <td><?php echo $descripcion ?></td> 
             </tr>
          </table>
     </td>
     <td width="30%" valign="left" class="tg-031e"  style="text-align:left;">
        <?php  
			/*include('config.php');*/
			
			$result = mysql_query("select distinct proposito from soptravidb2.cs_proposito p, soptravidb2.cs_proyecto pr, soptravidb2.cs_programa po
where po.idPrograma = $IdPrograma and po.idPrograma = pr.idPrograma and pr.idProposito = p.idproposito ;");
			
			echo "<table class='tab_cont' width='100%'>
			<tr >			
			<th>Propósito</th>
			</tr>";
			
			$td_style = false;
			
			while($row = mysql_fetch_array($result))
			{
			
			echo "<tr >";
			if ($td_style == false){
			echo "<td>" . $row['proposito'] . "</td>";
			     $td_style = true;	
			}
			else{
				echo "<td id='styled_td' >" . $row['proposito'] . "</td>";
				 $td_style = false;	
				}
			echo "</tr>";
			}
			echo "</table>";
			
			
			?>
     </td>    
</table>    

<table class="tg">
  <tr>
    <td class="tg-031e" align="center" style="text-align:center" colspan="3">
      <?php
			/*include('config.php');*/
			
			$result = mysql_query("SELECT 
   (SELECT fuente FROM cs_fuentesfinan f WHERE f.idFuente = pf.idFuente )AS fuente,
    monto,
   (SELECT moneda FROM cs_monedas m WHERE pf.idMoneda = m.idMoneda) AS moneda,
   tasa_cambio
   FROM   cs_programa_fuente pf WHERE idPrograma = $IdPrograma;");
			
			echo "<table width='100%' class='tab_cont'>
			<tr>			
			<th>Fuente</th>
			<th>Monto</th>
			<th>Moneda</th>
			<th>Tasa Cambio</th>
			</tr>";
			
			$td_style = false;
			while($row = mysql_fetch_array($result))
			{
			echo "<tr>";
			if ($td_style == false){
			echo "<td>" . $row['fuente'] . "</td>";
			echo "<td>" . number_format($row['monto'],2) . "</td>";
			echo "<td>" . $row['moneda'] . "</td>";
			echo "<td>" . $row['tasa_cambio'] . "</td>";
			$td_style = true;
			}
			else{
				echo "<td id='styled_td'>" . $row['fuente'] . "</td>";
				echo "<td id='styled_td'>" . number_format($row['monto'],2) . "</td>";
				echo "<td id='styled_td'>" . $row['moneda'] . "</td>";
				echo "<td id='styled_td'>" . $row['tasa_cambio'] . "</td>";
			    $td_style = false;
				
				}
						
			echo "</tr>";
			}
			echo "</table>";
			
			
			?>

    </td>

</table>
<div style="padding-top:5%">
<table  class="tg"  >
  <tr >
    <th class="tg-qp8u"></th>
    <th class="tg-031e"></th>
    <th class="tg-031e"></th>
  </tr>
  
  <tr>
   <td ></td>
  </tr>
  
  <tr>
    <td class="tg-encabezados" colspan="3">Información del proyecto</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
</table>
    
<table  class="tg">
     <td width="70%" valign="top" class="tg-031e"  style="text-align:left;">
         <table width="100%">
             <tr>
              <td width="10%"><strong>Nombre del Proyecto:<strong></td>
              <td><?php echo $nombre_proyecto ?></td>             
             </tr>
             <tr>
               <td width="10%"><strong>Departamento:<strong></td>
             <td><?php echo $departamento ?></td> 
             </tr>
              <tr>
               <td width="10%"><strong>Descripción del Proyecto:<strong></td>
             <td> <?php echo $descrip ?></td> 
             </tr>             
          </table>
     </td>
     <td width="30%" valign="center" class="tg-031e"  style="text-align:left;">
        <div style="font-size:16px" class="tg-031e"><strong>Municipios beneficiados</strong></div>
        
	<?php  
			/*include('config.php');*/
			
			$result = mysql_query("select pb.idProyecto,d.idbeneficiarios,d.depto,d.muni,
                            f.departamento as departamento ,e.municipio as municipio,pb.km
                            from cs_beneficiario d,cs_departamento f,cs_municipio e,cs_proyecto_beneficiario pb
                            where d.depto=f.codigoDepto and d.muni=e.id and e.depto=f.codigoDepto
                            and pb.idbeneficiario = Convert(d.idbeneficiarios,UNSIGNED) and pb.idproyecto = $IdProyecto;");

			echo "<table class='tab_cont' width='100%' >
			<tr>			
			<th>Departamento</th>
			<th>Municipio</th>
			<th>KM</th>
			</tr>";
			$td_style = false;
			while($row = mysql_fetch_array($result))
			{
			echo "<tr>";
			if ($td_style == false){
			echo "<td>" . $row['departamento'] . "</td>";
			echo "<td>" . $row['municipio'] . "</td>";
     		        echo "<td>" . $row['km'] . "</td>";
			$td_style = true;
			}
			else{
			echo "<td id='styled_td'>" . $row['departamento'] . "</td>";
			echo "<td id='styled_td'>" . $row['municipio'] . "</td>";
     		echo "<td id='styled_td'>" . $row['km'] . "</td>";
			$td_style = false;
				}
			echo "</tr>";
			}
			echo "</table>";
			
			
			?>
     </td>    
</table>    
<table class="tg">
  <tr>
    <td class="tg-031e" align="center" style="text-align:center" colspan="3">
      <?php
			/*include('config.php');*/
			
			$result = mysql_query("SELECT 
   (SELECT fuente FROM cs_fuentesfinan f WHERE f.idFuente = pf.idFuente )AS fuente,
    monto,
   (SELECT moneda FROM cs_monedas m WHERE pf.idMoneda = m.idMoneda) AS moneda,
   tasa_cambio
   FROM  cs_proyecto_fuente pf ,cs_proyecto p, cs_programa pro WHERE pro.idPrograma = $IdPrograma and  pro.idPrograma = p.idPrograma AND p.idProyecto = $IdProyecto and p.idProyecto = pf.idProyecto;");
			
			echo "<table width='100%'   class='tab_cont'>
			<tr >			
			<th>Fuente</th>
			<th>Monto</th>
			<th>Moneda</th>
			<th>Tasa Cambio</th>
			</tr>";
			$td_style = false;
			while($row = mysql_fetch_array($result))
			{
			echo "<tr >";
                        if ($td_style == false){
			echo "<td >" . $row['fuente'] . "</td>";
			echo "<td >" . number_format($row['monto'],2) . "</td>";
			echo "<td >" . $row['moneda'] . "</td>";
			echo "<td >" . $row['tasa_cambio'] . "</td>";
                        $td_style = true;
                        }
                        else{
                          echo "<td id='styled_td'>" . $row['fuente'] . "</td>";
			  echo "<td id='styled_td'>" .number_format($row['monto'],2) . "</td>";
			  echo "<td id='styled_td'>" . $row['moneda'] . "</td>";
			  echo "<td id='styled_td'>" . $row['tasa_cambio'] . "</td>";
                           $td_style = false; 
                        }
			echo "</tr>";
			}
			echo "</table>";
			
			
			?>

    </td>

</table>
</div>
<div style="padding-top:2%">
<table  class="tg"  >
  <tr >
    <th class="tg-qp8u"></th>
    <th class="tg-031e"></th>
    <th class="tg-031e"></th>
  </tr>
  
  <tr>
   <td height="25"></td>
  </tr>
  <tr>
    <td class="tg-encabezados" colspan="3">Contrato de Supervisión</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
</table>

<table  class="tg">
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
         <table width="100%">
             <tr>
              <td width="25%"><strong>Título de Contrato:<strong></td>
              <td> <?php echo $S_titulocontrato;  ?></td>             
             </tr>
             <tr>
               <td width="10%"><strong>Contratada:<strong></td>
             <td> <?php echo $S_Firma_Contrato ?> </td> 
             </tr>
              <tr>
               <td width="10%"><strong>Monto Contratado (LPS):<strong></td>
             <td>  <?php echo $S_Monto_Lps_Contrato; ?></td> 
             </tr>
              <!--tr>
               <td width="10%"><strong>Monto Contratado (USD):<strong></td>
             <td> <!--?php echo $S_Monto_USD_Contrato; ?></td> 
             </tr-->              
          </table>
     </td>
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
        <table width="100%">
             <tr>
              <td width="25%"><strong>Alcances de Trabajo en el Contrato:<strong></td>
              <td><?php echo $S_alcances_Contrato; ?></td>             
             </tr>
               <tr>
               <td width="20%"><strong>Fecha Inicio:<strong></td>
             <td> <?php echo $S_fechainicio_Contrato; ?> </td> 
             </tr>
              <tr>
               <td width="20%"><strong>Fecha Finalización:<strong></td>
             <td><?php echo $S_fechafinal_Contrato; ?></td> 
             </tr>         
          </table>
     </td>    
</table>    

<table  class="tg">
 <tr>
     <td width="50%" class="tg-031e"  style="text-align:center" >
       <?php
			/*include('config.php');*/
			
			$result = mysql_query("select * from v_avance_ft where idContratacion =".$idContratacion);
			
			echo "<table   width='100%'  class='tab_cont'>
			<tr >			
			<th>Avance Físico Real</th>			
			<th>Avance Físico Programado</th>
			<th>Financiero Real</th>
			<th>Financiero Programado</th>			
			
			</tr>";
			
					
			$td_style = false;
			while($row = mysql_fetch_array($result))
			{
			echo "<tr>";
			if ($td_style == false){			
			echo "<td >" . number_format($row['porcent_real'],2) . "</td>";
			echo "<td >" . number_format($row['porcent_programado'],2) . "</td>";			
     		        echo "<td >" . number_format($row['finan_real'],2)  . "</td>";
			echo "<td >" . number_format($row['finan_programado'],2) . "</td>";	
			$td_style = true;
			}
			else{				
				echo "<td id='styled_td'>" . number_format($row['porcent_real'],2) . "</td>";
				echo "<td id='styled_td'>" . number_format($row['porcent_programado'],2) . "</td>";			
				echo "<td id='styled_td'>" . number_format($row['finan_real'],2) . "</td>";
				echo "<td id='styled_td'>" . number_format($row['finan_programado'],2) . "</td>";	
			    $td_style = false;				
				}
						
			echo "</tr>";
			}
			echo "</table>";
			
			
			?>

     </td>
     <td width="50%" class="tg-031e"  style="text-align:center" >
      <?php
			/*include('config.php');*/
			
			$result = mysql_query("select distinct  c.nmodifica,
c.fecha,
c.tipomodifica,
c.justimodcontrato
from cs_contratos c, cs_contratacion co,cs_adjudicacion a, cs_calificacion ca, cs_proyecto p, cs_programa pr 
where c.idContratacion = co.idContratacion and co.idAdjudicacion = a.idAdjudicacion and
	a.idCalificacion = ca.idCalificacion and ca.idProyecto = p.idProyecto and p.idProyecto = $IdProyecto and p.idPrograma = pr.idPrograma
and pr.idPrograma = $IdPrograma   order by nmodifica;");
			
			echo "<table   width='100%'  class='tab_cont'>
			<tr >			
			<th>Modificación</th>			
			<th>Justificación</th>
			<th>Tipo</th>
			<th>Fecha</th>
			</tr>";
			
					
			$td_style = false;
			while($row = mysql_fetch_array($result))
			{
			echo "<tr>";
			if ($td_style == false){
			echo "<td >" . $row['nmodifica'] . "</td>";
			echo "<td >" . $row['justimodcontrato'] . "</td>";			
     		echo "<td >" . $row['tipomodifica'] . "</td>";
			echo "<td >" . $row['fecha'] . "</td>";
			$td_style = true;
			}
			else{
			echo "<td id='styled_td'>" . $row['nmodifica'] . "</td>";
			echo "<td id='styled_td'>" . $row['justimodcontrato'] . "</td>";			
     		echo "<td id='styled_td'>" . $row['tipomodifica'] . "</td>";
			echo "<td id='styled_td'>" . $row['fecha'] . "</td>";
			    $td_style = false;
				
				}
						
			echo "</tr>";
			
			
			
			}
			echo "</table>";
			
			
			?>
     </td>
     </tr>
 </table>
</div>
<div>
<table  class="tg"  >
  <tr >
    <th class="tg-qp8u"></th>
    <th class="tg-031e"></th>
    <th class="tg-031e"></th>
  </tr>
  
  <tr>
   <td height="25"></td>
  </tr>
  <tr>
    <td class="tg-encabezados" colspan="3">Contrato de Construcción</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
</table>
    
 <table  class="tg">
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
         <table width="100%">
             <tr>
              <td width="25%"><strong>Titulo de Contrato:<strong></td>
              <td><?php echo $titulocontrato; ?></td>             
             </tr>
             <tr>
               <td width="10%"><strong>Firma Contratada:<strong></td>
             <td> <?php echo $Firma_Contrato; ?> </td> 
             </tr>
              <tr>
               <td width="10%"><strong>Monto Contratado (LPS):<strong></td>
             <td><?php echo number_format($Monto_Lps_Ultimo,2) ; ?></td> 
             </tr>
              <!--tr>
               <td width="10%"><strong>Monto Contratado (USD):<strong></td>
             <td><!--?php echo $Monto_USD_Contrato; ?></td> 
             </tr-->
              
          </table>
     </td>
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
        <table width="100%">
             <tr>
              <td width="25%"><strong>Alcances de Trabajo en el Contrato:<strong></td>
              <td> <?php echo $alcances_Contrato; ?></td>             
             </tr>
               <tr>
               <td width="20%"><strong>Fecha Inicio:<strong></td>
             <td> <?php echo $fechainicio_Contrato; ?> </td> 
             </tr>
              <tr>
               <td width="20%"><strong>Fecha Finalización:<strong></td>
             <td><?php echo $fechafinaActualizada; ?></td> 
             </tr>            
          </table>
     </td>    
</table>   

<table  class="tg">
 <tr>
     <td width="50%" class="tg-031e"  style="text-align:center" > 
      <div style="text-align:center;font-size:16px" class="tg-031e"><strong>Comparación Avance Financiero Vrs. Real</strong></div>      
<?php 
//$contratacion->fechafinal=strtotime($contratacion->fechafinal);
//$fa=date("d/m/Y",strtotime($fa));

$resultX = mysql_query("select * from v_avance_ft where idContratacion =".$idContratacion);

$i=0;
while($rowX = mysql_fetch_array($resultX))
             {
            $array_porcent_real[] = (int)$rowX['porcent_real'];
            $array_porcent_programado[] = (int)$rowX['porcent_programado'];
            $array_fina_real[] = (int)$rowX['finan_real'];
            $array_finan_programado[] = (int)$rowX['finan_programado'];
            $i++;
            $cat[]=strval($i);
             }

$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
      'title' => array('text' => ''),
      'xAxis' => array(
         'categories' => $cat
      ),
      'yAxis' => array(
         'title' => array('text' => 'Avances')
      ),
	  'colors'=>array('#6AC36A', '#FFD148'),
      'credits' => array('enabled' => false),
      'series'  => array(
                            array('name' => 'Avance Financiero Real', 'data' => $array_fina_real),
                            array('name' => 'Avance Financiero Programado', 'data' =>$array_finan_programado),
          
                        )
   )
));

?>

     </td>
    <td width="50%" valign="top" class="tg-031e" style="text-align:center">
     <div style="text-align:center;font-size:16px" class="tg-031e"><strong>Comparación Avance Físico Vrs. Real</strong></div>
  <?php
    $this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
      'title' => array('text' => ''),
      'xAxis' => array(
         'categories' => $cat
      ),
      'yAxis' => array(
         'title' => array('text' => 'Avances')
      ),
	  'colors'=>array('#0C0', '#F00'),
      'credits' => array('enabled' => false),
      'series'  => array(
                            array('name' => 'Avance Obras Real', 'data' => $array_porcent_real),
                            array('name' => 'Avance Obras Programado', 'data' =>$array_porcent_programado),
          
                        )
   )
));
  
  
  ?>  
      
    </td>
    </tr>   
</table>
</div>
<div style="padding-top:2%;">
<table  class="tg"  >
  <tr >
    <th class="tg-qp8u"></th>
    <th class="tg-031e"></th>
    <th class="tg-031e"></th>
  </tr>
  <tr>
    <td class="tg-encabezados" colspan="3">Ubicación</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
</table>
<table  class="tg" >
<tr>
<td colspan="4" ><div id="map_canvas"></div></td>
 </tr>
</table>
</div>
<div style="padding-bottom:5%">
<table  class="tg"  >
  <tr >
    <th class="tg-qp8u"></th>
    <th class="tg-031e"></th>
    <th class="tg-031e"></th>
  </tr>
  <tr>
    <td class="tg-encabezados" colspan="3">Galería de Imágenes</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
</table>
<table class="tg">
<td class="tg-031e"  colspan="3"></td>    
  </tr>
  <tr>
    <td class="tg-031e"  align="center" valign="middle"  style="text-align:center"  colspan="3">
 <!--div class="slideshow" 
    data-cycle-fx=carousel
    data-cycle-timeout=0
    data-cycle-carousel-visible=5
    data-cycle-next="#next"
    data-cycle-prev="#prev"
    data-cycle-pager="#pager"
    -->
    <div>
   
    
    <?php
    $result = mysql_query("select * from v_proyectos_carrousel where idProyecto = ".$IdProyecto." Limit 5");
									
			while($row = mysql_fetch_array($result))
			{			
			echo "<img src='" . $row['ubicacion_img'] . "' width='200px' height='200px'>";			
			}
			?>
    
    
    
   
</div>

<div>
 <?php
  //   $this->widget('bootstrap.widgets.TbMenu', array(
 //'type'=>'pills',
 //'items'=>array(
  //array('label'=>'Crear', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'), 'linkOptions'=>array()),
                //array('label'=>'Listar', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'),'active'=>true, 'linkOptions'=>array()),
  //array('label'=>'Search', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
 // array('label'=>'Exportar a PDF', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GeneratePdf_ResumendeEjecucion'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
  

// ),
//));
  
   ?>
</div>
    </td>
</table>

</div>

  
</body>
</html>