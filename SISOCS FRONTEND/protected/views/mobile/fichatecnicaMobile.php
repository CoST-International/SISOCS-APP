<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SISOCS MOBILE</title>
<?php
/*
if($ejecucion[0]['estado']!=='PUBLICADO'){
  // echo 'alert("hello")';
    header('Location: index.php?r=mobile/index' );
}
*/
?>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0; width:100%;column-span:1;}
.tg td{font-family:Arial, sans-serif;font-size:10px;padding:3px 3px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;font-family:"Lucida Sans Unicode", "Lucida Grande"}
.tg th{font-family:Arial, sans-serif;font-size:10px;font-weight:normal;padding:3px 3px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;width:33.3%;;font-family:"Lucida Sans Unicode", "Lucida Grande"}
.tg .tg-qp8u{color:#ffffff;text-align:center;margin:0px;}
.tg .tg-header{font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;font-size:36px;}
.tg .tg-encabezados{font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;font-size:15px;}
.tg .tg-sub-encabezados{font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;font-size:12px;}
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
.tab_cont th{background:#EAB200;border-width:1px;border-top:thin;border-left:thin;white-space:nowrap;border-right:thin;font-size:12px;font-weight:bold;margin:0px;padding:3px !important;}
//.tab_cont th{color:#000;font-size:15px;}
.tab_cont td{border-width:1px;background:#E7E7FF;font-size:10px;margin:0px;padding:3px;text-align:center !important;}
//.tab_cont td{border-width:20px;background:#E7E7FF;font-size:12px;margin:0px;padding:3px;text-align:center !important;}
#styled_td {border-width:1px;background:#FFF;margin:2px;padding:0px !important;}


.box{
    border: 1px solid red;
    margin-left: 100px; 
      position: relative;
    
}
.link{
      
}

.popup{    
    width: 300px;
    height: 300px;
    background: green;
    color: #FFFFFF;
    display: none;
    position: absolute;
    left: -30px;
     outline:0;
}


</style>

<script>   
    $(document).on('pagebeforecreate', '[data-role="page"]', function(){     
    var interval = setInterval(function(){
        $.mobile.loading('show');
        clearInterval(interval);
    },1);    
});

$(document).on('pageshow', '[data-role="page"]', function(){  
    var interval = setInterval(function(){
        $.mobile.loading('hide');
        clearInterval(interval);
    },300);      
});
    </script>

</head>

<body>

    <div data-role="page" id="principal" data-theme="a">
	<div data-role="header" data-position="inline" style="overflow:hidden;">
            <h1><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u21.png' ?>" width="100%"/> </h1>
                        <a data-rel="back"  data-icon="back" class="ui-btn-left">Regresar</a>
                        <a href="<?php echo 'index.php?r=mobile/resumendeejecucion&IdPrograma='.$programa[0]['idPrograma'].'&IdProyecto='.$proyecto[0]['idProyecto'].'&IdContratacion='.$contratacion[0]['idContratacion'] ; ?>"  data-icon="gear" class="ui-btn-right">Resumen de Ejecución</a>
		</div>


<table class="tg" style="table-layout: fixed;">
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
  <tr>
      <td class="tg-header" colspan="3"  align="center"><strong>Ficha Técnica</strong></td>
  </tr>
<?php if(!empty($programa)){?>
  <tr>
   <td height="40">
   </td>
  </tr> 
    <td class="tg-encabezados" colspan="3">Planificación del Programa</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
</table>
<table  class="tg">
     <td width="80%" valign="top" class="tg-031e"  style="text-align:left;">
         <table width="100%">
             <tr>
              <td width="10%"><strong>Código:<strong></td>
              <td><?php echo (!empty($programa[0]['programa_codigo']))? $programa[0]['programa_codigo'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
              <td width="25%"><strong>Nombre del Programa:<strong></td>
              <td> <?php echo (!empty($programa[0]['programa_nombre']))? $programa[0]['programa_nombre'] : '&nbsp;'; ?></td>             
             </tr>
              <tr>
               <td width="10%"><strong>Sector:<strong></td>
             <td><?php echo (!empty($programa[0]['programa_sector']))? $programa[0]['programa_sector'] : '&nbsp;'; ?></td> 
             </tr>
              <tr>
               <td width="10%"><strong>Descripción:<strong></td>
             <td><?php echo (!empty($programa[0]['programa_descripcion']))? $programa[0]['programa_descripcion'] : '&nbsp;'; ?></td> 
             </tr>
          </table>
     </td>
     <td width="20%" valign="top" class="tg-031e"  style="text-align:left;">
        <table width="100%">
              <tr>
               <td width="10%"><strong>BIP:<strong></td>
             <td> <?php echo (!empty($programa[0]['programa_BIP']))? $programa[0]['programa_BIP'] : '&nbsp;'; ?> </td> 
             </tr>
            
             
             <tr>
               <td width="20%"><strong>Costo Estimado:<strong></td>
             <td> <?php echo (!empty($programa[0]['programa_costo']))? number_format($programa[0]['programa_costo'], 2) : '&nbsp;'; ?> </td> 
             </tr>
              <tr>
               <td width="20%"><strong>Moneda:<strong></td>
             <td><?php echo (!empty($programa[0]['programa_moneda']))? $programa[0]['programa_moneda'] : '&nbsp;'; ?></td> 
             </tr>
              <tr>
               <td width="20%"><strong>Sub-Sector:<strong></td>
             <td><?php echo (!empty($programa[0]['programa_subsector']))? $programa[0]['programa_subsector'] : '&nbsp;'; ?></td> 
             </tr>
          </table>
     </td>    
</table>
<table class="tg" style="table-layout: fixed;">
  <tr>
     <td class="tg-sub-encabezados" colspan="3" style='text-align:center'>Detalles de contacto</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>  
  </tr> 
</table>
<table  class="tg">
     <td width="80%" valign="top" class="tg-031e"  style="text-align:left;">
         <table width="100%">
             <tr>
              <td width="10%"><strong>Nombre:<strong></td>
                          <td><?php echo (!empty($programa[0]['funcionario_nombre']))? $programa[0]['funcionario_nombre'] : '&nbsp;'; ?></td>
             </tr>
             <tr>
               <td width="10%"><strong>Puesto:<strong></td>
             <td>   <?php echo (!empty($programa[0]['funcionario_puesto']))? $programa[0]['funcionario_puesto'] : '&nbsp;'; ?></td> 
             </tr>
              <tr>
               <td width="10%"><strong>Correo:<strong></td>
             <td><?php echo (!empty($programa[0]['funcionario_correo']))? $programa[0]['funcionario_correo'] : '&nbsp;'; ?></td> 
             </tr>
            
             <tr>
               <td width="10%"><strong>Propósito:<strong></td>
             <td><?php 
    $resultX=  Yii::app()->db->createCommand()
                                           ->select('*')
                                           ->from('cs_programa_proposito')
                                           ->where('idPrograma=:id',array(':id'=>$programa[0]['idPrograma']))										   
                                           ->queryAll();
                                   
        //foreach ($resultX as $rowY)
    $row=0;
    $total_x=count($resultX);  
           //  {            
?>
<?php 

$td_style = false;
while ($row< $total_x){
?>
             <li><?php echo (!empty($resultX[$row]['idproposito']))? $resultX[$row]['idproposito'] : '&nbsp;'; ?></li>
<?php $row++;}
?></td> 
             </tr>
          </table>
     </td>
     <td width="20%" valign="top" class="tg-031e"  style="text-align:left;">
        <table width="100%">
             <tr>
              <td width="25%"><strong>Fecha de Aprobación:<strong></td>
              <td><?php echo (!empty($programa[0]['programa_fecha']))? $programa[0]['programa_fecha'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="20%"><strong>Fecha de Recepción:<strong></td>
                           <td> <?php echo str_replace('-','/',$programa[0]['programa_fecha_recibido'])  ?> </td> 
             </tr>
               <tr>
               <td width="10%"><strong>Teléfono:<strong></td>
             <td><?php echo (!empty($programa[0]['funcionario_telefono']))? $programa[0]['funcionario_telefono'] : '&nbsp;'; ?></td> 
             </tr>
              <!--tr>
               <td width="20%"><strong>Fecha de Registro:<strong></td>
             <td><?php // echo (!empty($programa[0]['programa_fecha_registro']))? $programa[0]['programa_fecha_registro'] : '&nbsp;'; ?></td> 
             </tr-->
              <tr>
               <td width="20%"><strong>Estado:<strong></td>
             <td> Publicado</td> 
             </tr>
          </table>
     </td>    
</table>
<table class="tg" >
<td class="tg-031e"  colspan="3"></td>    
  </tr>
  <tr>
    <td class="tg-031e"  align="center" valign="middle"  style="text-align:center"  colspan="3">
          <table  class="tg" >
		<tr >
                    <td class="tg-sub-encabezados" width="75%">Fuentes de financiamiento</br>
                        <img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
		</tr>
        </table >
             <table class="tab_cont" width="100%" >
		<tr>
            <th>Fuente</th>
            <th>Monto</th>
            <th>Moneda</th>              
		</tr>
<?php 
    $row=0;
    $total_x=count($programa_fuentes);
?>
<?php 

$td_style = false;

while ($row< $total_x){?>
        <tr>
        <?php if ($td_style == false){ ?>
            <td><?php echo $programa_fuentes[$row] ['fuente'];?></td>
            <td><?php echo number_format($programa_fuentes[$row] ['monto'],2,'.',',');?></td>
            <td><?php echo $programa_fuentes[$row] ['moneda'];?></td>
                        
           <?php $td_style = true; }
           else { ?>
            <td id="styled_td"><?php echo $programa_fuentes[$row] ['fuente'];?></td>
            <td id="styled_td"><?php echo number_format($programa_fuentes[$row] ['monto'],2,'.',',');?></td>
            <td id="styled_td"><?php echo $programa_fuentes[$row] ['moneda'];?></td>                       
           <?php $td_style = false;
               }?>               
        </tr>
	
<?php $row++;}
?>
             </table>
    </td>
</table>

<?php }else{ }?>

<?php if(!empty($proyecto)){?>
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
    <td class="tg-encabezados" colspan="3">Planificación del Proyecto</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
</table>
<table  class="tg">
     <td width="80%" valign="top" class="tg-031e"  style="text-align:left;">
         <table width="100%">            
             <tr>
               <td width="20%"><strong>Nombre del Proyecto:<strong></td>
             <td> <?php echo (!empty($proyecto[0]['proyecto_nombre']))? $proyecto[0]['proyecto_nombre'] : '&nbsp;'; ?>  </td> 
             </tr>
              <tr>
               <td width="10%"><strong>Descripción:<strong></td>
             <td> <?php echo (!empty($proyecto[0]['proyecto_descripcion']))? $proyecto[0]['proyecto_descripcion'] : '&nbsp;'; ?></td> 
             </tr>    
          </table>
     </td>
     <td width="20%" valign="top" class="tg-031e"  style="text-align:left;">
        <table width="100%">
             <tr>
              <td width="25%"><strong>Código:<strong></td>
              <td><?php echo (!empty($proyecto[0]['proyecto_codigo']))? $proyecto[0]['proyecto_codigo'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
              <td width="10%"><strong>Presupuesto:<strong></td>
              <td>L. <?php echo (!empty($proyecto[0]['proyecto_presupuesto']))? number_format($proyecto[0]['proyecto_presupuesto'],2) : '&nbsp;'; ?></td>             
             </tr>
                     
          </table>
     </td>    
</table>    

<table class="tg" style="table-layout: fixed;">
  <tr>
     <td class="tg-sub-encabezados" colspan="3" style='text-align:center'>Detalles de contacto</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>  
  </tr> 
</table>
  
<table  class="tg">
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
         <table width="100%">
             <tr>
              <td width="20%"><strong>Nombre:<strong></td>
              <td><?php echo (!empty($proyecto[0]['funcionario_nombre']))? $proyecto[0]['funcionario_nombre'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="20%"><strong>Puesto:<strong></td>
             <td> <?php echo (!empty($proyecto[0]['funcionario_puesto']))? $proyecto[0]['funcionario_puesto'] : '&nbsp;'; ?>  </td> 
             </tr>              
          </table>
     </td>
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
        <table width="100%">
             <tr>
              <td width="10%"><strong>Teléfono:<strong></td>
              <td> <?php echo (!empty($proyecto[0]['funcionario_telefono']))? $proyecto[0]['funcionario_telefono'] : '&nbsp;'; ?> </td>             
             </tr>
             <tr>
               <td width="10%"><strong>Correo:<strong></td>
             <td> <?php echo (!empty($proyecto[0]['funcionario_correo']))? $proyecto[0]['funcionario_correo'] : '&nbsp;'; ?></td> 
             </tr>             
          </table>
     </td>    
</table>    

    <table class="tg" style="table-layout: fixed;">
  <tr>
     <td class="tg-sub-encabezados" colspan="3" style='text-align:center'>Ubicación</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>  
  </tr> 
</table>

<table  class="tg">
     <?php 
    $result_ubicacionproyecto=  Yii::app()->db->createCommand()
                                           ->select('*')
                                           ->from('v_ubicacion_poridproyecto')
                                           ->where('idProyecto=:id',array(':id'=>$proyecto[0]['idProyecto']))										   
                                           ->queryAll();
                                   
        //foreach ($resultX as $rowY)
    $row=0;
    $total_x=count($resultX);  
           //  {            
?>  
    <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
         <table width="100%">
             <tr>
              <td width="10%"><strong>Región:<strong></td>
              <td> <?php echo (!empty($result_ubicacionproyecto[0]['region']))? $result_ubicacionproyecto[0]['region'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="10%"><strong>Departamento:<strong></td>
             <td> <?php echo (!empty($result_ubicacionproyecto[0]['departamento']))? $result_ubicacionproyecto[0]['departamento'] : '&nbsp;'; ?> </td> 
             </tr>
              <!--tr>
               <td width="10%"><strong>Clase:<strong></td>
             <td> <?php //echo (!empty($result_ubicacionproyecto[0]['clase']))? $result_ubicacionproyecto[0]['clase'] : '&nbsp;'; ?></td> 
             </tr-->
              <tr>
               <td width="10%"><strong>Estado:<strong></td>
             <td> <?php echo (!empty($proyecto[0]['proyecto_estado']))? $proyecto[0]['proyecto_estado'] : '&nbsp;'; ?>  </td> 
             </tr>
          </table>
     </td>
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
        <table width="100%">
             <tr>
              <td width="25%"><strong>Fecha de Aprobación:<strong></td>
              <td>  <?php echo (!empty($proyecto[0]['proyecto_aprobacion']))? $proyecto[0]['proyecto_aprobacion'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="20%"><strong>Fecha de Recepción:<strong></td>
             <td> <?php echo (!empty($proyecto[0]['proyecto_fecha_recibido']))? $proyecto[0]['proyecto_fecha_recibido'] : '&nbsp;'; ?> </td> 
             </tr>
              <tr>
               <td width="20%"><strong>Fecha de Registro:<strong></td>
             <td><?php echo (!empty($proyecto[0]['proyecto_fecha_registro']))? $proyecto[0]['proyecto_fecha_registro'] : '&nbsp;'; ?></td> 
             </tr>             
          </table>
     </td>    
</table>
<table class="tg">
<td class="tg-031e"  colspan="3"></td>    
  </tr>
  <tr>
    <td class="tg-031e"  align="center" valign="middle"  style="text-align:center"  colspan="3">
          <table  class="tg"  >
		<tr >
                    <td class="tg-sub-encabezados">Beneficiarios</br>
                        <img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
		</tr>
        </table >
             <table class="tab_cont" width="100%">
		<tr>
           
            <th>Departamento</th>          
            <th>Municipio</th>
            <th>KM</th>
            
		</tr>
<?php 
    $row=0;
    $total_x=count($proyecto_beneficiario);
?>
<?php 

$td_style = false;

while ($row< $total_x){?>
        <tr>
        <?php if ($td_style == false){ ?>           
            <td><?php echo $proyecto_beneficiario[$row] ['departamento'];?></td>          
            <td><?php echo $proyecto_beneficiario[$row] ['municipio'];?></td>
            <td><?php echo $proyecto_beneficiario[$row] ['km'];?></td>
           <?php $td_style = true; }
           else { ?>    
            <td id="styled_td"><?php echo $proyecto_beneficiario[$row] ['departamento'];?></td>            
            <td id="styled_td"><?php echo $proyecto_beneficiario[$row] ['municipio'];?></td>
            <td id="styled_td"><?php echo $proyecto_beneficiario[$row] ['km'];?></td>           
           <?php $td_style = false;
               }?>               
        </tr>
	
<?php $row++;}
?>
             </table>
    </td>
</table>
<table class="tg">
<td class="tg-031e"  colspan="3"></td>    
  </tr>
  <tr>
    <td class="tg-031e"  align="center" valign="middle"  style="text-align:center"  colspan="3">
          <table  class="tg"  >
		<tr >
                    <td class="tg-sub-encabezados">Fuentes de financiamiento</br>
                        <img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
		</tr>
        </table >
             <table class="tab_cont" width="100%">
		<tr>
            <th>Fuente</th>           
            <th>Monto</th>
            <th>Moneda</th>
                      
		</tr>
<?php 
    $row=0;
    $total_x=count($proyecto_fuente);
?>
<?php 

$td_style = false;

while ($row< $total_x){?>
        <tr>
        <?php if ($td_style == false){ ?>
            <td><?php echo $proyecto_fuente[$row] ['fuente'];?></td>          
            <td><?php echo number_format($proyecto_fuente[$row] ['monto'],2,'.',',');?></td>
            <td><?php echo $proyecto_fuente[$row] ['moneda'];?></td>         	             
           <?php $td_style = true; }
           else { ?>
            <td id="styled_td"><?php echo $proyecto_fuente[$row] ['fuente'];?></td>           
            <td id="styled_td"><?php echo number_format($proyecto_fuente[$row] ['monto'],2,'.',',');?></td>
            <td id="styled_td"><?php echo $proyecto_fuente[$row] ['moneda'];?></td>                      
           <?php $td_style = false;
               }?>               
        </tr>
	
<?php $row++;}
?>
             </table>
    </td>
</table>


<?php }else{ }?>

<?php if(!empty($calificacion)){?>
<table class="tg" style="table-layout: fixed;"> 
    <td class="tg-encabezados" colspan="3">Invitación y Calificación</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
</table>
    
<table  class="tg">
     <td width="65%" valign="top" class="tg-031e"  style="text-align:left;">
         <table width="100%">
             <tr>
              <td width="25%"><strong>Número de Calificación:<strong></td>
              <td><?php echo (!empty($calificacion[0]['calificacion_numero']))? $calificacion[0]['calificacion_numero'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="20%"><strong>Nombre:<strong></td>
             <td><?php echo (!empty($calificacion[0]['calificacion_nombre']))? $calificacion[0]['calificacion_nombre'] : '&nbsp;'; ?>   </td> 
             </tr>
             <tr>
              <td width="25%"><strong>Entidad Ejecutora:<strong></td>
              <td>  <?php echo (!empty($calificacion[0]['calificacion_entidad']))? $calificacion[0]['calificacion_entidad'] : '&nbsp;'; ?></td>             
             </tr>
          </table>
     </td>
     <td width="35%" valign="top" class="tg-031e"  style="text-align:left;">
        <table width="100%">
              <tr>
               <td width="20%"><strong>Tipo de Calificación:<strong></td>
             <td><?php echo (!empty($calificacion[0]['calificacion_tipo']))? $calificacion[0]['calificacion_tipo'] : '&nbsp;'; ?></td> 
             </tr> 
             <tr>
               <td width="10%"><strong>Estatus del Proceso:<strong></td>
             <td> <?php echo (!empty($calificacion[0]['calificacion_estatus']))? $calificacion[0]['calificacion_estatus'] : '&nbsp;'; ?> </td> 
             </tr>
              <tr>
               <td width="10%"><strong>Tipo de Contrato:<strong></td>
             <td><?php echo (!empty($calificacion[0]['calificacion_tipocontrato']))? $calificacion[0]['calificacion_tipocontrato'] : '&nbsp;'; ?></td> 
             </tr>
          </table>
     </td>    
</table>    
<table class="tg" style="table-layout: fixed;">
  <tr>
     <td class="tg-sub-encabezados" colspan="3" style='text-align:center'>Detalles de contacto</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>  
  </tr> 
</table>
 
<table  class="tg">
     <td width="80%" valign="top" class="tg-031e"  style="text-align:left;">
         <table width="100%">
             <tr>
              <td width="10%"><strong>Nombre:<strong></td>
              <td <?php echo (!empty($calificacion[0]['funcionario_nombre']))? $calificacion[0]['funcionario_nombre'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="10%"><strong>Puesto:<strong></td>
             <td>  <?php echo (!empty($calificacion[0]['funcionario_puesto']))? $calificacion[0]['funcionario_puesto'] : '&nbsp;'; ?> </td> 
             </tr>
              <tr>
               <td width="10%"><strong>Correo:<strong></td>
             <td> <?php echo (!empty($calificacion[0]['funcionario_correo']))? $calificacion[0]['funcionario_correo'] : '&nbsp;'; ?></td> 
             </tr>
              <tr>
               <td width="10%"><strong>Teléfono:<strong></td>
             <td> <?php echo (!empty($calificacion[0]['funcionario_telefono']))? $calificacion[0]['funcionario_telefono'] : '&nbsp;'; ?></td> 
             </tr>
          </table>
     </td>
     <td width="20%" valign="top" class="tg-031e"  style="text-align:left;">
        <table width="100%">
             <tr>
              <td width="25%"><strong>Fecha de Actualización:<strong></td>
              <td> <?php echo (!empty($calificacion[0]['calificacion_fecha']))? $calificacion[0]['calificacion_fecha'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="20%"><strong>Fecha en que se Genera Información:<strong></td>
             <td><?php echo (!empty($calificacion[0]['calificacion_fecha_recibido']))? $calificacion[0]['calificacion_fecha_recibido'] : '&nbsp;'; ?></td> 
             </tr>
              <tr>
               <td width="20%"><strong>Fecha Ingreso de la Información:<strong></td>
             <td><?php echo (!empty($calificacion[0]['calificacion_fecha_registro']))? $calificacion[0]['calificacion_fecha_registro'] : '&nbsp;'; ?></td> 
             </tr>
              <tr>
               <td width="20%"><strong>Estado:<strong></td>
             <td><?php echo (!empty($calificacion[0]['calificacion_estado']))? $calificacion[0]['calificacion_estado'] : '&nbsp;'; ?></td> 
             </tr>
          </table>
     </td>    
</table>    

<table class="tg">
<td class="tg-031e"  colspan="3"></td>    
  </tr>
  <tr>
    <td class="tg-031e"  align="center" valign="middle"  style="text-align:center"  colspan="3">
          <table  class="tg"  >
		<tr >
                    <td class="tg-sub-encabezados"></br>
                        <img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
		</tr>
        </table >
        
        
             <table class="tg" width="100%" >
                 <tr>
                                           
                <td width="100%" valign="top" class="tg-031e" style="text-align:center">
                  <?php   if ($calificacion[0]['calificacion_tipocontrato']==='Diseño' || $calificacion[0]['calificacion_tipocontrato']==='Supervision' || $calificacion[0]['calificacion_tipocontrato']==='Diseño y Supervision' ) { ?>
        
                    <table class="tab_cont" width="100%">     
		<tr>
            <th>Firmas</th>                  
		</tr>
<?php 
    $row=0;
    $total_x=count($calificacion_firma);
?>
<?php 

$td_style = false;

while ($row< $total_x){?>
        <tr>
        <?php if ($td_style == false){ ?>
            <td><?php echo $calificacion_firma[$row] ['nombre_firma'];?></td>                         
           <?php $td_style = true; }
           else { ?>
            <td id="styled_td"><?php echo $calificacion_firma[$row] ['nombre_firma'];?></td>                         
           <?php $td_style = false;
               }?>               
        </tr>
	
<?php $row++;}
?>
                   </table>
                      <?php } else if($calificacion[0]['calificacion_tipocontrato']==='Mantenimiento' || $calificacion[0]['calificacion_tipocontrato']==='Construcción') { ?>
               
                         <table class="tab_cont" width="100%">     
		<tr>
            <th>Oferentes</th>                  
		</tr>
<?php 
    $row=0;
    $total_x=count($calificacion_oferente);
?>
<?php 

$td_style = false;

while ($row< $total_x){?>
        <tr>
        <?php if ($td_style == false){ ?>
            <td><?php echo $calificacion_oferente[$row] ['nombre_oferente'];?></td>                         
           <?php $td_style = true; }
           else { ?>
            <td id="styled_td"><?php echo $calificacion_oferente[$row] ['nombre_oferente'];?></td>                         
           <?php $td_style = false;
               }?>               
        </tr>
	
<?php $row++;}
?>
                   </table>
                    <?php } ?>
                    
                </td>
                    
             </table>
    </td>
</table>

<?php }else{ }?>
<?php if(!empty($adjudicacion)){?>
 <table class="tg" style="table-layout: fixed;"> 
    <td class="tg-encabezados" colspan="3">Adjudicación</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
</table>
 
<table  class="tg">
     <td width="70%" valign="top" class="tg-031e"  style="text-align:left;">
         <table width="100%">
             <tr>
              <td width="24%"><strong>No. de Adjudicación:<strong></td>
              <td <?php echo (!empty($adjudicacion[0]['adjudicacion_numero']))? $adjudicacion[0]['adjudicacion_numero'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="10%"><strong>Nombre:<strong></td>
             <td>  <?php echo (!empty($adjudicacion[0]['adjudicacion_nombre']))? $adjudicacion[0]['adjudicacion_nombre'] : '&nbsp;'; ?> </td> 
             </tr>
              <tr>
               <td width="10%"><strong>Costo:<strong></td>
             <td> L.<?php echo (!empty($adjudicacion[0]['adjudicacion_costo']))? number_format($adjudicacion[0]['adjudicacion_costo'],2) : '&nbsp;'; ?></td> 
             </tr>
              <tr>
               <td width="10%"><strong>Fecha de Recepción:<strong></td>
             <td>   <?php echo (!empty($adjudicacion[0]['adjudicacion_fecha_recibido']))? $adjudicacion[0]['adjudicacion_fecha_recibido'] : '&nbsp;'; ?></td> 
             </tr>
          </table>
     </td>
     <td width="30%" valign="top" class="tg-031e"  style="text-align:left;">
        <table width="100%">
             <tr>
              <td width="25%"><strong>Estado del Proceso:<strong></td>
              <td>  <?php echo (!empty($adjudicacion[0]['calificacion_estado']))? $adjudicacion[0]['calificacion_estado'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="20%"><strong>Fecha de Registro:<strong></td>
             <td>  <?php echo (!empty($adjudicacion[0]['adjudicacion_fecha_registro']))? $adjudicacion[0]['adjudicacion_fecha_registro'] : '&nbsp;'; ?></td> 
             </tr>
              <tr>
               <td width="20%"><strong>Estado:<strong></td>
             <td> <?php echo (!empty($adjudicacion[0]['adjudicacion_estado']))? $adjudicacion[0]['adjudicacion_estado'] : '&nbsp;'; ?></td> 
             </tr>
             
          </table>
     </td>    
</table>    

<table  class="tg">
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
   <table class="tg" style="table-layout: fixed;">
  <tr>
     <td class="tg-sub-encabezados" colspan="3" style='text-align:center'>Consultores</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>  
  </tr> 
</table>
     <table  class="tg">
 </tr>
     <td width="11%" valign="top" class="tg-031e"  style="text-align:right;">
     <div><strong>Nacionales:<strong></div>
     <div style="margin:10px"></div>
     <div><strong>Internacionales:<strong></div>  
                 
     </td>
    <td width="45%" valign="top" class="tg-031e" style="text-align:left">
   <?php echo (!empty($adjudicacion[0]['adjudicacion_consultores_nacionales']))? $adjudicacion[0]['adjudicacion_consultores_nacionales'] : '&nbsp;'; ?>
      <div style="margin:10px"></div>
  <?php echo (!empty($adjudicacion[0]['adjudicacion_consultores_internacionales']))? $adjudicacion[0]['adjudicacion_consultores_internacionales'] : '&nbsp;'; ?>
    </td>
   
</table>    
         
     
     </td>
    <td width="50%" valign="top" class="tg-031e" style="text-align:left">
  <table class="tg" style="table-layout: fixed;">
  <tr>
     <td class="tg-sub-encabezados" colspan="3" style='text-align:center'>Firmas que Licitarón</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>  
  </tr> 
</table>
          <table  class="tg">
 </tr>
     <td width="11%" valign="top" class="tg-031e"  style="text-align:right;">
     <div><strong>Nacionales:<strong></div>
     <div style="margin:10px"></div>
     <div><strong>Internacionales:<strong></div>  
                 
     </td>
    <td width="45%" valign="top" class="tg-031e" style="text-align:left">
  <?php echo (!empty($adjudicacion[0]['adjudicacion_firmas_nacionales']))? $adjudicacion[0]['adjudicacion_firmas_nacionales'] : '&nbsp;'; ?>
      <div style="margin:10px"></div>
  <?php echo (!empty($adjudicacion[0]['adjudicacion_firmas_internacionales']))? $adjudicacion[0]['adjudicacion_firmas_internacionales'] : '&nbsp;'; ?>
    </td>
   
</table>    
    </td>
    
</table>

<?php }else{ }?>    
<?php if(!empty($contratacion)){?>
  <table class="tg" style="table-layout: fixed;"> 
    <td class="tg-encabezados" colspan="3">Contratación</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
</table>
    
<table  class="tg">
     <td width="75%" valign="top" class="tg-031e"  style="text-align:left;">
         <table width="100%">
             <tr>
              <td width="25%"><strong>No. de Contratación:<strong></td>
              <td> <?php echo (!empty($contratacion[0]['contratacion_numero']))? $contratacion[0]['contratacion_numero'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="10%"><strong>Nombre:<strong></td>
             <td><?php echo (!empty($contratacion[0]['contratacion_nombre']))? $contratacion[0]['contratacion_nombre'] : '&nbsp;'; ?> </td> 
             </tr>
              <tr>
               <td width="10%"><strong>Entidad:<strong></td>
             <td> <?php echo (!empty($contratacion[0]['contratacion_entidad']))? $contratacion[0]['contratacion_entidad'] : '&nbsp;'; ?></td> 
             </tr>
              <tr>
               <td width="10%"><strong>Empresa:<strong></td>
             <td> <?php echo (!empty($contratacion[0]['contratacion_empresa']))? $contratacion[0]['contratacion_empresa'] : '&nbsp;'; ?></td> 
             </tr>              
             <tr>
               <td width="10%"><strong>Alcance:<strong></td>
             <td><?php echo (!empty($contratacion[0]['contratacion_alcances']))? $contratacion[0]['contratacion_alcances'] : '&nbsp;'; ?></td> 
             </tr>
          </table>
     </td>
     <td width="25%" valign="top" class="tg-031e"  style="text-align:left;">
        <table width="100%">
             <tr>
              <td width="25%"><strong>Fecha de Inicio:<strong></td>
              <td> <?php echo (!empty($contratacion[0]['contratacion_fecha_inicio']))? $contratacion[0]['contratacion_fecha_inicio'] : '&nbsp;'; ?>   </td>             
             </tr>
             <tr>
               <td width="20%"><strong>Fecha Final:<strong></td>
             <td> <?php echo (!empty($contratacion[0]['contratacion_fecha_final']))? $contratacion[0]['contratacion_fecha_final'] : '&nbsp;'; ?></td> 
             </tr>            
              <tr>
               <td width="20%"><strong>Fecha de Recepción:<strong></td>
             <td><?php echo (!empty($contratacion[0]['contratacion_fecha_recibido']))? $contratacion[0]['contratacion_fecha_recibido'] : '&nbsp;'; ?></td> 
             </tr>
             <tr>
               <td width="20%"><strong>Fecha de Registro:<strong></td>
             <td> <?php echo (!empty($contratacion[0]['contratacion_fecha_registro']))? $contratacion[0]['contratacion_fecha_registro'] : '&nbsp;'; ?></td> 
             </tr>
             <tr>
               <td width="20%"><strong>Estado:<strong></td>
             <td><?php echo (!empty($contratacion[0]['contratacion_estado']))? $contratacion[0]['contratacion_estado'] : '&nbsp;'; ?></td> 
             </tr>
             <tr>
               <td width="10%"><strong>Costo L.:<strong></td>
             <td> <?php echo (!empty($contratacion[0]['contratacion_precio']))? number_format($contratacion[0]['contratacion_precio'],2) : '&nbsp;'; ?></td> 
             </tr>
             <tr>
               <td width="10%"><strong>Costo Equivalente $:<strong></td>
             <td>  <?php echo (!empty($contratacion[0]['contratacion_precio2']))? number_format($contratacion[0]['contratacion_precio2'],2) : '&nbsp;'; ?></td> 
             </tr>
          </table>
     </td>    
</table>

<?php }else{ }?>

<?php if(!empty($ejecucion)){?>
  <table class="tg" style="table-layout: fixed"> 
    <td class="tg-encabezados" colspan="3">Ejecución</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
</table>
<table class="tg" style="table-layout: fixed;">
  <tr>
     <td class="tg-sub-encabezados" colspan="3" style='text-align:center'>Datos de Contacto del Consultor a Cargo del Diseño del Proyecto</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>  
  </tr> 
</table>

<table  class="tg">
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
         <table width="100%">
             <tr>
              <td width="20%"><strong>Nombre:<strong></td>
              <td><?php echo (!empty($ejecucion[0]['diseno_nombre']))? $ejecucion[0]['diseno_nombre'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="10%"><strong>Dirección:<strong></td>
             <td> <?php echo (!empty($ejecucion[0]['diseno_direccion']))? $ejecucion[0]['diseno_direccion'] : '&nbsp;'; ?> </td> 
             </tr>
              <tr>
               <td width="10%"><strong>Teléfono Fijo:<strong></td>
             <td>  <?php echo (!empty($ejecucion[0]['diseno_telefono']))? $ejecucion[0]['diseno_telefono'] : '&nbsp;'; ?></td> 
             </tr>
              <!--tr>
               <td width="10%"><strong>Teléfono Celular:<strong></td>
             <td><?php // echo (!empty($ejecucion[0]['diseno_celular']))? $ejecucion[0]['diseno_celular'] : '&nbsp;'; ?></td> 
             </tr-->
             <tr>
               <td width="10%"><strong>Correo Electrónico:<strong></td>
             <td><?php echo (!empty($ejecucion[0]['diseno_email']))? $ejecucion[0]['diseno_email'] : '&nbsp;'; ?> </td> 
             </tr>
          </table>
     </td>
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
        <table width="100%">
             <tr>
              <td width="25%"><strong>Tipo de Garantía:<strong></td>
              <td> <?php echo (!empty($ejecucion[0]['garanatia1']))? $ejecucion[0]['garanatia1'] : '&nbsp;'; ?>  </td>             
             </tr>
             <tr>
               <td width="20%"><strong>Monto de la Garantía:<strong></td>
             <td> <?php echo (!empty($ejecucion[0]['monto_garantia1']))? number_format($ejecucion[0]['monto_garantia1'],2) : '&nbsp;'; ?> </td> 
             </tr>
              <tr>
               <td width="20%"><strong>Estado de la Garantía:<strong></td>
             <td> <?php echo (!empty($ejecucion[0]['estado_garantia1']))? $ejecucion[0]['estado_garantia1'] : '&nbsp;'; ?></td> 
             </tr>
              <tr>
               <td width="20%"><strong>Fecha de Vencimiento:<strong></td>
             <td> <?php echo str_replace('-','/',$ejecucion[0]['vencimiento_garantia1']); ?></td> 
             </tr>
          </table>
     </td>    
</table>


<table class="tg" style="table-layout: fixed;">
  <tr>
     <td class="tg-sub-encabezados" colspan="3" style='text-align:center'>Datos de Contacto del Representante del Contratista</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>  
  </tr> 
</table>	
<table  class="tg">
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
         <table width="100%">
             <tr>
              <td width="20%"><strong>Nombre:<strong></td>
              <td> <?php echo (!empty($ejecucion[0]['contratista_nombre']))? $ejecucion[0]['contratista_nombre'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="10%"><strong>Dirección:<strong></td>
             <td> <?php echo (!empty($ejecucion[0]['contratista_direccion']))? $ejecucion[0]['contratista_direccion'] : '&nbsp;'; ?> </td> 
             </tr>
              <tr>
               <td width="10%"><strong>Teléfono Fijo:<strong></td>
             <td>   <?php echo (!empty($ejecucion[0]['contratista_telefono']))? $ejecucion[0]['contratista_telefono'] : '&nbsp;'; ?></td> 
             </tr>
              <!--tr>
               <td width="10%"><strong>Teléfono Celular:<strong></td>
             <td> <?php// echo (!empty($ejecucion[0]['contratista_celular']))? $ejecucion[0]['contratista_celular'] : '&nbsp;'; ?></td> 
             </tr-->
             <tr>
               <td width="10%"><strong>Correo Electrónico:<strong></td>
             <td> <?php echo (!empty($ejecucion[0]['contratista_email']))? $ejecucion[0]['contratista_email'] : '&nbsp;'; ?>  </td> 
             </tr>
          </table>
     </td>
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
        <table width="100%">
             <tr>
              <td width="25%"><strong>Tipo de Garantía:<strong></td>
              <td> <?php echo (!empty($ejecucion[0]['garantia2']))? $ejecucion[0]['garantia2'] : '&nbsp;'; ?>  </td>             
             </tr>
             <tr>
               <td width="20%"><strong>Monto de la Garantía:<strong></td>
             <td> <?php echo (!empty($ejecucion[0]['monto_garantia2']))? number_format($ejecucion[0]['monto_garantia2'],2) : '&nbsp;'; ?> </td> 
             </tr>
              <tr>
               <td width="20%"><strong>Estado de la Garantía:<strong></td>
             <td> <?php echo (!empty($ejecucion[0]['estado_garantia2']))? $ejecucion[0]['estado_garantia2'] : '&nbsp;'; ?></td> 
             </tr>
              <tr>
               <td width="20%"><strong>Fecha de Vencimiento:<strong></td>
             <td> <?php echo str_replace('-','/',$ejecucion[0]['vencimiento_garantia2']); ?></td> 
             </tr>
          </table>
     </td>    
</table>


   

<table class="tg" style="table-layout: fixed;">
  <tr>
     <td class="tg-sub-encabezados" colspan="3" style='text-align:center'>Datos de Contacto del Representante del Supervisor</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>  
  </tr> 
</table>

<table  class="tg">
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
         <table width="100%">
     
             <tr>
              <td width="20%"><strong>Nombre:<strong></td>
              <td> <?php echo (!empty($ejecucion[0]['supervision_nombre']))? $ejecucion[0]['supervision_nombre'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="10%"><strong>Dirección:<strong></td>
             <td> <?php echo (!empty($ejecucion[0]['supervision_direccion']))? $ejecucion[0]['supervision_direccion'] : '&nbsp;'; ?> </td> 
             </tr>
              <tr>
               <td width="10%"><strong>Teléfono Fijo:<strong></td>
             <td>   <?php echo (!empty($ejecucion[0]['supervision_telefono']))? $ejecucion[0]['supervision_telefono'] : '&nbsp;'; ?></td> 
             </tr>
              <!--tr>
               <td width="10%"><strong>Teléfono Celular:<strong></td>
             <td> <?php// echo (!empty($ejecucion[0]['supervision_celular']))? $ejecucion[0]['supervision_celular'] : '&nbsp;'; ?></td> 
             </tr-->
             <tr>
               <td width="10%"><strong>Correo Electrónico:<strong></td>
             <td> <?php echo (!empty($ejecucion[0]['supervision_email']))? $ejecucion[0]['supervision_email'] : '&nbsp;'; ?>  </td> 
             </tr>
          </table>
     </td>
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
        <table width="100%">
             <tr>
              <td width="25%"><strong>Tipo de Garantía:<strong></td>
              <td> <?php echo (!empty($ejecucion[0]['garantia3']))? $ejecucion[0]['garantia3'] : '&nbsp;'; ?>  </td>             
             </tr>
             <tr>
               <td width="20%"><strong>Monto de la Garantía:<strong></td>
             <td> <?php echo (!empty($ejecucion[0]['monto_garantia3']))? number_format($ejecucion[0]['monto_garantia3'],2) : '&nbsp;'; ?> </td> 
             </tr>
              <tr>
               <td width="20%"><strong>Estado de la Garantía:<strong></td>
             <td> <?php echo (!empty($ejecucion[0]['estado_garantia3']))? $ejecucion[0]['estado_garantia3'] : '&nbsp;'; ?></td> 
             </tr>
              <tr>
               <td width="20%"><strong>Fecha de Vencimiento:<strong></td>
             <td> <?php echo str_replace('-','/',$ejecucion[0]['vencimiento_garantia3']); ?></td> 
             </tr>
          </table>
     </td>    
</table>



<table class="tg" style="table-layout: fixed;">
  <tr>
     <td class="tg-sub-encabezados" colspan="3" style='text-align:center'>Datos de Ubicación del Proyecto</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>  
  </tr>
</table>	    
<table  class="tg">
 </tr>
     <td width="22%" valign="top" class="tg-031e"  style="text-align:left;">
     <div><strong>Ubicación aproximada del proyecto (Latitud):<strong></div>
     <div style="margin:10px"></div>
     <div><strong>Ubicación aproximada del proyecto (Longitud):<strong></div> 
     </td>
    <td width="28%" valign="top" class="tg-031e" style="text-align:left">
 <?php echo (!empty($ejecucion[0]['geo_latitud']))? $ejecucion[0]['geo_latitud'] : '&nbsp;'; ?>
      <div style="margin:10px"></div>
 <?php echo (!empty($ejecucion[0]['geo_longitud']))? $ejecucion[0]['geo_longitud'] : '&nbsp;'; ?>     
    </td>
    <td width="11%" valign="top" class="tg-031e"  style="text-align:left;">
     <div><strong>Fecha de Inicio:<strong></div>
     <div style="margin:10px"></div>
     <div><strong>Estado:<strong></div>       
     </td>
    <td width="45%" valign="top" class="tg-031e" style="text-align:left">
        <?php if($ejecucion[0]['estado']==='PUBLICADO'){ ?>
 <?php echo (!empty($ejecucion[0]['fecha_inicio']))? $ejecucion[0]['fecha_inicio'] : '&nbsp;'; ?>
        <?php } else { echo 'N/A' ;} ?>
        <div style="margin:10px"></div>
    <?php echo (!empty($ejecucion[0]['estado']))? $ejecucion[0]['estado'] : '&nbsp;'; ?>        
    </td>
</table>
<?php 
    $avances=  Yii::app()->db->createCommand()
                            ->select('*')
                            ->from('v_avance_ft')
                            ->where('idContratacion=:id',array(':id'=>$contratacion[0]['idContratacion']))										   
                            ->queryAll();

    $row=0;
    $total_x=count($avances);  
           //  {            
?>
<?php if(!empty($avances)){?>
 <table class="tg" style="table-layout: fixed;"> 
    <td class="tg-encabezados" colspan="3">Avances</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
</table>
<table class="tg" valign="middle" align="center" style="text-align:center">
<td class="tg-031e"  colspan="3"></td>    
  <tr>
    <td class="tg-031e"  align="center" valign="middle"  style="text-align:center"  colspan="3">
        
        
        
             <table class="tab_cont" width="100%">
		<tr>
            <th>% Físico Progra.</th>
            <th>% Físico Real</th>
            <th>% Finan. Progra.</th>
            <th>% Finan. Real</th>
           
           
		</tr>

<?php 
$td_style = false;
while ($row< $total_x) {
?>
        <tr>
            <td <?php echo ($td_style)?'id="styled_td"':''; ?> ><?php echo (!empty($avances[$row]['porcent_programado']))? number_format($avances[$row]['porcent_programado'],2) : '&nbsp;'; ?></td>
            <td <?php echo ($td_style)?'id="styled_td"':''; ?> ><?php echo (!empty($avances[$row]['porcent_real']))? number_format($avances[$row]['porcent_real'],2) : '&nbsp;'; ?></td>
            <td <?php echo ($td_style)?'id="styled_td"':''; ?> ><?php echo (!empty($avances[$row]['finan_programado']))? number_format($avances[$row]['finan_programado'],2) : '&nbsp;'; ?></td>
            <td <?php echo ($td_style)?'id="styled_td"':''; ?> ><?php echo (!empty($avances[$row]['finan_real']))? number_format($avances[$row]['finan_real'],2) : '&nbsp;'; ?></td>
        </tr>
<?php 
    $td_style = !$td_style;
    $row++;
}
?>
             </table>
    </td>
 
</table>
</br>
</br>
<?php }else{ }?>    
<?php }else{ }?>

<?php 
    $resultY=  Yii::app()->db->createCommand()
                            ->select('*')
                            ->from('cs_desembolsos_montos')
                            ->where('cod_contrato=:id',array(':id'=>$contratacion[0]['idContratacion']))										   
                            ->queryAll();

    $rowY=0;
    $total_y=count($resultY);  
           //  {            
?>
<?php if(!empty($resultY)){?>
 <table class="tg" style="table-layout: fixed;"> 
    <td class="tg-encabezados" colspan="3">Desembolsos y Montos</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
</table>
<table class="tg" valign="middle" align="center" style="text-align:center">
<td class="tg-031e"  colspan="3"></td>    
  <tr>
    <td class="tg-031e"  align="center" valign="middle"  style="text-align:center"  colspan="3">
<table class="tab_cont" width="100%">
		<tr>                 
                    <th>Descripción</th>
                    <th>Monto</th>
                    <th>Fecha</th>
		</tr>
<?php 

$td_style = false;

while ($rowY< $total_y){?>
        <tr>
        <?php if ($td_style == false){ ?>           
            <td><?php echo $resultY[$rowY] ['descripcion'];?></td>
            <td><?php echo (!empty($resultY[$rowY]['monto']))? number_format($resultY[$rowY]['monto'],2) : '&nbsp;';?></td> 
            <td><?php echo $resultY[$rowY] ['fecha_desembolso'];?></td>  
           <?php $td_style = true; }
           else { ?>              
            <td id="styled_td"><?php echo $resultY[$rowY] ['descripcion'];?></td>
           <td id="styled_td"><?php echo (!empty($resultY[$rowY]['monto']))? number_format($resultY[$rowY]['monto'],2) : '&nbsp;'; ?></td>  
            <td id="styled_td"><?php echo $resultY[$rowY] ['fecha_desembolso'];?></td>  
           <?php $td_style = false;
               }?>               
        </tr>
	
<?php $rowY++;}
?>
             </table>
    </td>
  </tr>
</table>




<?php }else{ }?>
</div>
	
	</br>
	</br>  
	</br>
	</br>  
	</br></br>
	
	
    <p style="color:#F00">Para consultar documentos de interés referentes a esta contratación ingrese a <A HREF="http://insep.gob.hn/sisocs" TARGET="_blank">http://insep.gob.hn/sisocs</A>  desde su computadora.</p>

</br>
	</br>
	</br>
</div>
<!-- Prueba de Modal Click outside closed   -->
<!--script>
 $(".link").click(function(e){
    e.preventDefault();
    $(".popup").fadeIn(300,function(){$(this).focus();});
});

$('.close').click(function() {
   $(".popup").fadeOut(300);
});
$(".popup").on('blur',function(){
    $(this).fadeOut(300);
});
 </script>
 
 
 
 <div class="container">
    <div class="box">
        <a href="#"  class="link">Open</a>
         <div class="popup" tabindex="-1">
             Hello world
             <a class="close" href="#">Close</a>
        </div>
    </div>
 </div-->




    
	
</body>
</html>

