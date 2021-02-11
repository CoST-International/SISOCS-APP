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
.tab_cont th{background:#EAB200;border-width:1px;border-top:thin;border-left:thin;white-space:nowrap;border-right:thin;font-size:15px;font-weight:bold;margin:0px;padding:3px !important;}
//.tab_cont th{color:#000;font-size:15px;}
.tab_cont td{border-width:1px;background:#E7E7FF;font-size:12px;margin:0px;padding:3px;text-align:center !important;}
//.tab_cont td{border-width:20px;background:#E7E7FF;font-size:12px;margin:0px;padding:3px;text-align:center !important;}
#styled_td {border-width:1px;background:#FFF;margin:2px;padding:0px !important;}





</style>

<?php
/* @var $this CiudadanoController */

$this->breadcrumbs=array(
	'Ciudadano'=>array('index'),
);
//define('YII_DEBUG', true);
?>

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
      <td class="tg-header" colspan="3"  align="center"><strong>Ficha Tecnica</strong></td>
  </tr>
<?php if(!empty($programa)){?>
  <tr>
   <td height="40">
   </td>
  </tr> 
    <td class="tg-encabezados" colspan="3">Planificación del Programa</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
</table>
<table  class="tg">
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
         <table width="100%">
             <tr>
              <td width="10%"><strong>Código:<strong></td>
              <td><?php echo (!empty($programa[0]['programa_codigo']))? $programa[0]['programa_codigo'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="10%"><strong>BIP:<strong></td>
             <td> <?php echo (!empty($programa[0]['programa_BIP']))? $programa[0]['programa_BIP'] : '&nbsp;'; ?> </td> 
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
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
        <table width="100%">
             <tr>
              <td width="25%"><strong>Nombre del Programa:<strong></td>
              <td> <?php echo (!empty($programa[0]['programa_nombre']))? $programa[0]['programa_nombre'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="20%"><strong>Costo Estimado:<strong></td>
             <td> <!--?php echo (!empty($programa[0]['programa_costo']))? number_format($programa[0]['programa_costo'], 2) : '&nbsp;'; ?--> </td> 
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
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
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
               <td width="10%"><strong>Telefono:<strong></td>
             <td><?php echo (!empty($programa[0]['funcionario_telefono']))? $programa[0]['funcionario_telefono'] : '&nbsp;'; ?></td> 
             </tr>
             <tr>
               <td width="10%"><strong>Proposito:<strong></td>
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
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
        <table width="100%">
             <tr>
              <td width="25%"><strong>Fecha de Aprobación:<strong></td>
              <td><?php echo (!empty($programa[0]['programa_fecha']))? $programa[0]['programa_fecha'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="20%"><strong>Fecha de Recepción:<strong></td>
             <td> <?php echo (!empty($programa[0]['programa_fecha_recibido']))? $programa[0]['programa_fecha_recibido'] : '&nbsp;'; ?> </td> 
             </tr>
              <tr>
               <td width="20%"><strong>Fecha de Registro:<strong></td>
             <td><?php echo (!empty($programa[0]['programa_fecha_registro']))? $programa[0]['programa_fecha_registro'] : '&nbsp;'; ?></td> 
             </tr>
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
            <th>Tasa</th>            
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
            <td><?php echo number_format($programa_fuentes[$row] ['tasa_cambio'],2,'.',',');?></td>	             
           <?php $td_style = true; }
           else { ?>
            <td id="styled_td"><?php echo $programa_fuentes[$row] ['fuente'];?></td>
            <td id="styled_td"><?php echo number_format($programa_fuentes[$row] ['monto'],2,'.',',');?></td>
            <td id="styled_td"><?php echo $programa_fuentes[$row] ['moneda'];?></td>
            <td id="styled_td"><?php echo number_format($programa_fuentes[$row] ['tasa_cambio'],2,'.',',');?></td>               
           <?php $td_style = false;
               }?>               
        </tr>
	
<?php $row++;}
?>
             </table>
    </td>
</table>
<table class="tg">
    <td class="tg-031e"  colspan="3" style="text-align:center">
          <?php echo CHtml::Button('Ver información de respaldo',array('onclick' => '$("#respPrograma").dialog("open"); return false;',));?>
        
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
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
         <table width="100%">
             <tr>
              <td width="25%"><strong>Código:<strong></td>
              <td><?php echo (!empty($proyecto[0]['proyecto_codigo']))? $proyecto[0]['proyecto_codigo'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="20%"><strong>Nombre del Proyecto:<strong></td>
             <td> <?php echo (!empty($proyecto[0]['proyecto_nombre']))? $proyecto[0]['proyecto_nombre'] : '&nbsp;'; ?>  </td> 
             </tr>              
          </table>
     </td>
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
        <table width="100%">
             <tr>
              <td width="10%"><strong>Presupuesto:<strong></td>
              <td>L. <?php echo (!empty($proyecto[0]['proyecto_presupuesto']))? number_format($proyecto[0]['proyecto_presupuesto'],2) : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="10%"><strong>Descripción:<strong></td>
             <td> <?php echo (!empty($proyecto[0]['proyecto_descripcion']))? $proyecto[0]['proyecto_descripcion'] : '&nbsp;'; ?></td> 
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
              <td width="10%"><strong>Telefono:<strong></td>
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
            <th>Código Departamento</th>
            <th>Departamento</th>
            <th>Código Municipio</th>
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
            <td><?php echo $proyecto_beneficiario[$row] ['codigo_depto'];?></td>
            <td><?php echo $proyecto_beneficiario[$row] ['departamento'];?></td>
            <td><?php echo $proyecto_beneficiario[$row] ['codigo_muni'];?></td>
            <td><?php echo $proyecto_beneficiario[$row] ['municipio'];?></td>
            <td><?php echo $proyecto_beneficiario[$row] ['km'];?></td>
           <?php $td_style = true; }
           else { ?>            
            <td id="styled_td"><?php echo $proyecto_beneficiario[$row] ['codigo_depto'];?></td>
            <td id="styled_td"><?php echo $proyecto_beneficiario[$row] ['departamento'];?></td>
            <td id="styled_td"><?php echo $proyecto_beneficiario[$row] ['codigo_muni'];?></td>
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
            <th>Abreviatura</th>
            <th>Monto</th>
            <th>Moneda</th>
            <th>Tasa</th>            
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
            <td><?php echo $proyecto_fuente[$row] ['abreviatura'];?></td>
            <td><?php echo number_format($proyecto_fuente[$row] ['monto'],2,'.',',');?></td>
            <td><?php echo $proyecto_fuente[$row] ['moneda'];?></td>
            <td><?php echo number_format($proyecto_fuente[$row] ['tasa_cambio'],2,'.',',');?></td>	             
           <?php $td_style = true; }
           else { ?>
            <td id="styled_td"><?php echo $proyecto_fuente[$row] ['fuente'];?></td>
            <td id="styled_td"><?php echo $proyecto_fuente[$row] ['abreviatura'];?></td>
            <td id="styled_td"><?php echo number_format($proyecto_fuente[$row] ['monto'],2,'.',',');?></td>
            <td id="styled_td"><?php echo $proyecto_fuente[$row] ['moneda'];?></td>
            <td id="styled_td"><?php echo number_format($proyecto_fuente[$row] ['tasa_cambio'],2,'.',',');?></td>               
           <?php $td_style = false;
               }?>               
        </tr>
	
<?php $row++;}
?>
             </table>
    </td>
</table>

<table class="tg">
    <td class="tg-031e"  colspan="3" style="text-align:center">
        <?php echo CHtml::Button('Ver información de respaldo',array('onclick' => '$("#respProyecto").dialog("open"); return false;',));?>
    </td>    
</table>
<?php }else{ }?>

<?php if(!empty($calificacion)){?>
<table class="tg" style="table-layout: fixed;"> 
    <td class="tg-encabezados" colspan="3">Invitación y Calificación</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
</table>
    
<table  class="tg">
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
         <table width="100%">
             <tr>
              <td width="25%"><strong>Numero de Calificación:<strong></td>
              <td><?php echo (!empty($calificacion[0]['calificacion_numero']))? $calificacion[0]['calificacion_numero'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="20%"><strong>Nombre:<strong></td>
             <td><?php echo (!empty($calificacion[0]['calificacion_nombre']))? $calificacion[0]['calificacion_nombre'] : '&nbsp;'; ?>   </td> 
             </tr>
              <tr>
               <td width="20%"><strong>Tipo de Calificación:<strong></td>
             <td><?php echo (!empty($calificacion[0]['calificacion_tipo']))? $calificacion[0]['calificacion_tipo'] : '&nbsp;'; ?></td> 
             </tr>
          </table>
     </td>
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
        <table width="100%">
             <tr>
              <td width="25%"><strong>Entidad Ejecutora:<strong></td>
              <td>  <?php echo (!empty($calificacion[0]['calificacion_entidad']))? $calificacion[0]['calificacion_entidad'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="10%"><strong>Costo Estimado:<strong></td>
             <td> <?php echo (!empty($calificacion[0]['calificacion_estatus']))? $calificacion[0]['calificacion_estatus'] : '&nbsp;'; ?> </td> 
             </tr>
              <tr>
               <td width="10%"><strong>Estado:<strong></td>
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
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
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
               <td width="10%"><strong>Telefono:<strong></td>
             <td> <?php echo (!empty($calificacion[0]['funcionario_telefono']))? $calificacion[0]['funcionario_telefono'] : '&nbsp;'; ?></td> 
             </tr>
          </table>
     </td>
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
        <table width="100%">
             <tr>
              <td width="25%"><strong>Fecha de Aprobación:<strong></td>
              <td> <?php echo (!empty($calificacion[0]['calificacion_fecha']))? $calificacion[0]['calificacion_fecha'] : '&nbsp;'; ?></td>             
             </tr>
             <tr>
               <td width="20%"><strong>Fecha de Recepción:<strong></td>
             <td><?php echo (!empty($calificacion[0]['calificacion_fecha_recibido']))? $calificacion[0]['calificacion_fecha_recibido'] : '&nbsp;'; ?></td> 
             </tr>
              <tr>
               <td width="20%"><strong>Fecha de Registro:<strong></td>
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
             <table class="tg" >
                 <tr>
                                           
                <td width="50%%" valign="top" class="tg-031e" style="text-align:center">
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
                </td>
                     <td width="50%" valign="top" class="tg-031e" style="text-align:center">
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
                     </td>
             </table>
    </td>
</table>
<table class="tg">
    <td class="tg-031e"  colspan="3" style="text-align:center">
      <?php echo CHtml::Button('Ver información de respaldo',array('onclick' => '$("#respCalificacion").dialog("open"); return false;',));?>
    </td>    
</table>
<?php }else{ }?>
<?php if(!empty($adjudicacion)){?>
 <table class="tg" style="table-layout: fixed;"> 
    <td class="tg-encabezados" colspan="3">Adjudicación</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
</table>
 
<table  class="tg">
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
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
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
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
<table class="tg">
    <td class="tg-031e"  colspan="3" style="text-align:center">
          <?php echo CHtml::Button('Ver información de respaldo',array('onclick' => '$("#respAdjudicacion").dialog("open"); return false;',));?>
    </td>    
</table>
<?php }else{ }?>    
<?php if(!empty($contratacion)){?>
  <table class="tg" style="table-layout: fixed;"> 
    <td class="tg-encabezados" colspan="3">Contratación</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
</table>
    
<table  class="tg">
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
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
     <td width="50%" valign="top" class="tg-031e"  style="text-align:left;">
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
<table class="tg">
    <td class="tg-031e"  colspan="3" style="text-align:center">
       <?php echo CHtml::Button('Ver información de respaldo',array('onclick' => '$("#respContratacion").dialog("open"); return false;',));?>
    </td>    
</table>
<?php }else{ }?>
    
<?php if(!empty($contratos_gestion)){?>    
  <table class="tg" style="table-layout: fixed;"> 
    <td class="tg-encabezados" colspan="3">Gestión de los Contratos</br><img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px;width: 100% !important" /></td>
</table>
<!--table  class="tg">
    <td width="100%" valign="top" class="tg-031e"  style="text-align:left;"-->
        
     
     <?php //$dataProvider=new CActiveDataProvider('contratos');
              $IdContr = $contratacion[0]['idContratacion'];
            
           $dataProvider=new CActiveDataProvider('Contratos', array(
                            'criteria'=>array(
                            'condition'=>'idContratacion='.$IdContr,
                          //  'order'=>'create_time DESC',
                          //  'with'=>array('author'),
                        ),
                    //  'criteria'=>array(
                      //  'idContratacion=:id',array(':id'=>$contratacion[0]['idContratacion']),
                      //  'order'=>'create_time DESC',
                       // 'with'=>array('author'),
                  //  ),
                   // 'countCriteria'=>array(
                   //     'condition'=>'status=1',
                        // 'order' and 'with' clauses have no meaning for the count query
                   // ),
                    'pagination'=>array(
                        'pageSize'=>1,
                    ),
                ));     
     
           //$dataProvider=$contratos_gestion;
     $this->widget('zii.widgets.CListView', array(
           'dataProvider'=>$dataProvider,
            'itemView'=>'_view_gescon',
         //   'summaryText'=>$attributeLabels, //summary text
           //  'EmptyText' => 'N/A' ,
          // 'template'=>',, {items} and {pager}.', //template
          //  'pagerCssClass'=>'page-number',//contain class
            'pager'=>array(
         //               'cssFile'=>true,//disable all css property
                    'header'=>'Nro. de Gestión ',//text before it
          //          'firstPageLabel'=>'Primera',//overwrite firstPage lable
          //          'lastPageLabel'=>'Ultima',//overwrite lastPage lable
          //          'nextPageLabel'=>'Siguiente',//overwrite nextPage lable
          //          'prevPageLabel'=>'Anterior',//overwrite prePage lable
                    )
        ));
     
     
     ?>   
    <!--/td>
</table-->
           
<br/>
<br/>
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
             <td> <?php echo (!empty($ejecucion[0]['vencimiento_garantia1']))? $ejecucion[0]['vencimiento_garantia1'] : '&nbsp;'; ?></td> 
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
              <tr>
               <td width="10%"><strong>Teléfono Celular:<strong></td>
             <td> <?php echo (!empty($ejecucion[0]['contratista_celular']))? $ejecucion[0]['contratista_celular'] : '&nbsp;'; ?></td> 
             </tr>
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
              <td> <?php echo (!empty($ejecucion[0]['garanatia2']))? $ejecucion[0]['garanatia2'] : '&nbsp;'; ?>  </td>             
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
             <td> <?php echo (!empty($ejecucion[0]['vencimiento_garantia2']))? $ejecucion[0]['vencimiento_garantia2'] : '&nbsp;'; ?></td> 
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
              <tr>
               <td width="10%"><strong>Teléfono Celular:<strong></td>
             <td> <?php echo (!empty($ejecucion[0]['supervision_celular']))? $ejecucion[0]['supervision_celular'] : '&nbsp;'; ?></td> 
             </tr>
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
              <td> <?php echo (!empty($ejecucion[0]['garanatia3']))? $ejecucion[0]['garanatia3'] : '&nbsp;'; ?>  </td>             
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
             <td> <?php echo (!empty($ejecucion[0]['vencimiento_garantia3']))? $ejecucion[0]['vencimiento_garantia3'] : '&nbsp;'; ?></td> 
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
 <?php echo (!empty($ejecucion[0]['fecha_inicio']))? $ejecucion[0]['fecha_inicio'] : '&nbsp;'; ?>
        <div style="margin:10px"></div>
    <?php echo (!empty($ejecucion[0]['estado']))? $ejecucion[0]['estado'] : '&nbsp;'; ?>        
    </td>
</table>
<table class="tg">
    <td class="tg-031e"  colspan="3" style="text-align:center">
       <?php echo CHtml::Button('Resumen de Ejecución',array('submit' => 'index.php?r=ciudadano/resumendeejecucion&IdPrograma='.$programa[0]['idPrograma'].'&IdProyecto='.$proyecto[0]['idProyecto'].'&IdContratacion='.$contratacion[0]['idContratacion']));?>
    </td>    
</table>
<?php }else{ }?>
<?php 
    $resultX=  Yii::app()->db->createCommand()
                            ->select('*')
                            ->from('v_avance_ft')
                            ->where('idContratacion=:id',array(':id'=>$contratacion[0]['idContratacion']))										   
                            ->queryAll();

    $row=0;
    $total_x=count($resultX);  
           //  {            
?>
<?php if(!empty($resultX)){?>
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
            <th>Fecha de Avance</th>
            <th>Descripción de Problemas</th>
            <th>Descripción de Temas</th>
            <th>Documentos</th>
            <th>Imágenes</th>
		</tr>

<?php 
$td_style = false;
while ($row< $total_x) {
?>
        <tr>
            <td <?php echo ($td_style)?'id="styled_td"':''; ?> ><?php echo (!empty($resultX[$row]['porcent_programado']))? number_format($resultX[$row]['porcent_programado'],2) : '&nbsp;'; ?></td>
            <td <?php echo ($td_style)?'id="styled_td"':''; ?> ><?php echo (!empty($resultX[$row]['porcent_real']))? number_format($resultX[$row]['porcent_real'],2) : '&nbsp;'; ?></td>
            <td <?php echo ($td_style)?'id="styled_td"':''; ?> ><?php echo (!empty($resultX[$row]['finan_programado']))? number_format($resultX[$row]['finan_programado'],2) : '&nbsp;'; ?></td>
            <td <?php echo ($td_style)?'id="styled_td"':''; ?> ><?php echo (!empty($resultX[$row]['finan_real']))? number_format($resultX[$row]['finan_real'],2) : '&nbsp;'; ?></td>
            <td <?php echo ($td_style)?'id="styled_td"':''; ?> ><?php echo $resultX[$row]['fecha_registro'];?></td>
            <td <?php echo ($td_style)?'id="styled_td"':''; ?> ><?php echo $resultX[$row]['desc_problemas'];?></td>
            <td <?php echo ($td_style)?'id="styled_td"':''; ?> ><?php echo $resultX[$row]['desc_temas'];?></td>
            <td <?php echo ($td_style)?'id="styled_td"':''; ?> >
                <?php 
                
                    $cod = $resultX[$row]['codigo'];
                    
                    echo CHtml::Button( 'Ver información',
                            array('onclick' => "$('#respAvances$cod').dialog('open'); return false;")
                         ); 
                
                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id'=>"respAvances$cod",    
                        'options'=>array(
                                        'title'=>'Información de respaldo de Avances',
                                        'autoOpen'=>false,
                                        'modal'=>true,
                                        'width'=>900,
                                        'resizable'=>false,
                                        'show'=>array(
                                            'effect'=>'blind',
                                            'duration'=>1000,
                                            'scrolling'=>false
                                        ),        
                                        'hide'=>array(
                                            'effect'=>'blind',
                                            'duration'=>500,
                                        ),
                                    ),
                        )
                    );

                        

                        $this->widget('zii.widgets.CDetailView', array(
                            'data'=>$resultX[$row],
                            'attributes'=>array(
                                array ('label'=>'Documento de garantía que puede ser i) Fianza o Garantía bancaria, emitida por una institución financiera autorizada; ii) Bonos del Estado y; iii) Cheques Certificados',
                                       'type'=>'raw',
                                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($resultX[$row]['adj_garantias'])), $resultX[$row]['adj_garantias'], array('target'=>'_blank'))
                                       ),
                                array ('label'=>'Informes de avance de implementación que presentan los contratistas',
                                       'type'=>'raw',
                                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($resultX[$row]['adj_avances'])), $resultX[$row]['adj_avances'], array('target'=>'_blank'))
                                       ),
                                array ('label'=>'Informes de supervisión de la construcción',
                                       'type'=>'raw',
                                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($resultX[$row]['adj_supervicion'])), $resultX[$row]['adj_supervicion'], array('target'=>'_blank'))
                                       ),
                                array ('label'=>'Informes de evaluación de proyecto (continuos y al finalizar)',
                                       'type'=>'raw',
                                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($resultX[$row]['adj_evaluacion'])), $resultX[$row]['adj_evaluacion'], array('target'=>'_blank'))
                                       ),
                                array ('label'=>'Informes de auditoría técnica',
                                       'type'=>'raw',
                                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($resultX[$row]['adj_tecnica'])), $resultX[$row]['adj_tecnica'], array('target'=>'_blank'))
                                       ),
                                array ('label'=>'Informes de auditoría financiera',
                                       'type'=>'raw',
                                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($resultX[$row]['adj_financiero'])), $resultX[$row]['adj_financiero'], array('target'=>'_blank'))
                                       ),
                                array ('label'=>'Acta de recepción definitiva',
                                       'type'=>'raw',
                                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($resultX[$row]['adj_recepcion'])), $resultX[$row]['adj_recepcion'], array('target'=>'_blank'))
                                       ),
                                array ('label'=>'Informe de disconformidad, cuando corresponda',
                                       'type'=>'raw',
                                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($resultX[$row]['adj_disconformidad'])), $resultX[$row]['adj_disconformidad'], array('target'=>'_blank'))
                                       ),

                            ),
                        ));


                    $this->endWidget('zii.widgets.jui.CJuiDialog');

                ?>
            </td>
            <td <?php echo ($td_style)?'id="styled_td"':''; ?> >
                
                <?php 
                    echo CHtml::Button(
                            'Ver imagenes',
                            array(
                                'onclick' => "$('#imaAvances$cod').dialog('open'); return false;", 
                            )
                         );
                    
                    $this->beginWidget(
                        'zii.widgets.jui.CJuiDialog', 
                        array(
                            'id'=>"imaAvances$cod",
                            'options'=>array(
                                'title'=>'Galeria de Imagenes',
                                'autoOpen'=>false,
                                'modal'=>true,
                                'width'=>630,
                                'height'=>700,
                                'resizable'=>false,
                                'show'=>array(
                                    'effect'=>'blind',
                                    'duration'=>1000,
                                    'scrolling'=>false
                                    ),        
                                'hide'=>array(
                                    'effect'=>'blind',
                                    'duration'=>500,
                                ),
                            ),
                        )
                    );

                        if ($cod>0) {

                            $imgX=  Yii::app()->db->createCommand()
                                                   ->select('*')
                                                   ->from('v_imagenes_poravance')
                                                   ->where('cod_avance=:id',array(':id'=>$cod))										   
                                                   ->queryAll();
                            $r=0;
                            $t_x=count($imgX);  
                            unset($arr_fin);
                            $arr_fin = array();
                            if ($t_x>0) {
                                while ($r < $t_x){
                                    $arr_fin[] = $imgX[$r]['nombre_img'];
                                    $r++;
                                }
                                $this->widget(
                                    'ext.SimpleFadeSlideShow.SimpleFadeSlideShow',
                                     array('images' => $arr_fin)
                                );
                            }
                        }
                        
                        
                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                ?>
            </td>
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
                    <th>Nro.</th>
                    <th>Descripción</th>
                    <th>Monto</th>
                    <th>Fecha Desembolso</th>
		</tr>
<?php 

$td_style = false;

while ($rowY< $total_y){?>
        <tr>
        <?php if ($td_style == false){ ?>
            <td><?php echo $resultY[$rowY] ['desembolso'];?></td>
            <td><?php echo $resultY[$rowY] ['descripcion'];?></td>
            <td><?php echo (!empty($resultY[$rowY]['monto']))? number_format($resultY[$rowY]['monto'],2) : '&nbsp;';?></td> 
            <td><?php echo $resultY[$rowY] ['fecha_desembolso'];?></td>  
           <?php $td_style = true; }
           else { ?>   
            <td id="styled_td"><?php echo $resultY[$rowY] ['desembolso'];?></td>
            <td id="styled_td"><?php echo $resultY[$rowY] ['descipcion'];?></td>
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
<?php




//*****************************************************************************************
//***************************  SECCION DE LOS ADJUNTOS ************************************
//*****************************************************************************************

//========================= PROGRAMAS ======================================================
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'respPrograma',   
'options'=>array(
                'title'=>'Información de respaldo de Programas',
                'autoOpen'=>false,
                'modal'=>true,
                'width'=>900,
               // 'height'=>700,
                'resizable'=>false,
                'show'=>array(
                'effect'=>'blind',
                'duration'=>1000,
                'scrolling'=>false
            ),        
                'hide'=>array(
                'effect'=>'blind',
                'duration'=>500,
            ),
                ),
                ));

        //print_r($programa[0]);
        $this->widget('zii.widgets.CDetailView', array(
            'data'=>$programa,
            'attributes'=>array(
                 array('label'=>'Carta convenio de crédito o de fondos reembolsables',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($programa[0]['adj_carta_convenio'])), $programa[0]['adj_carta_convenio'], array('target'=>'_blank'))
                           ),
                      array('label'=>'Plan operativo anual',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($programa[0]['adj_plan_operativo'])), $programa[0]['adj_plan_operativo'], array('target'=>'_blank'))
                           ),
                     array('label'=>'Presupuesto aprobado',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($programa[0]['adj_presupuesto'])), $programa[0]['adj_presupuesto'], array('target'=>'_blank'))
                           ),
                     array('label'=>'Perfil del programa',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($programa[0]['adj_perfil_programa'])), $programa[0]['adj_perfil_programa'], array('target'=>'_blank'))
                           ),
                     array('label'=>'Otro',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($programa[0]['adj_otro'])), $programa[0]['adj_otro'], array('target'=>'_blank'))
                           ),
            ),
        ));

$this->endWidget('zii.widgets.jui.CJuiDialog');

//========================= PROYECTO ======================================================
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'respProyecto',
    'options'=>array(
                'title'=>'Información de respaldo de Proyectos',
                'autoOpen'=>false,
                'modal'=>true,
                'width'=>900,
               // 'height'=>700,
                'resizable'=>false,
                'show'=>array(
                'effect'=>'blind',
                'duration'=>1000,
                'scrolling'=>false
            ),        
                'hide'=>array(
                'effect'=>'blind',
                'duration'=>500,
            ),
                ),
                ));



        $this->widget('zii.widgets.CDetailView', array(
            'data'=>$proyecto,
            'attributes'=>array(
                array ('label'=>'Especificaciones y Planos de la Obra',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_especificaciones_planos'])), $proyecto[0]['adj_especificaciones_planos'], array('target'=>'_blank'))
                       ),
                array ('label'=>'Presupuesto y Programa Multianual del Proyecto',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_presupuesto_programa'])), $proyecto[0]['adj_presupuesto_programa'], array('target'=>'_blank'))
                       ),
                array ('label'=>'Estudio de Factibilidad',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_estudio_factibilidad'])), $proyecto[0]['adj_estudio_factibilidad'], array('target'=>'_blank'))
                       ),
                array ('label'=>'Estudio de Impacto Ambiental',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_estudio_impacto'])), $proyecto[0]['adj_estudio_impacto'], array('target'=>'_blank'))
                       ),
                array ('label'=>'Licencia Ambiental y Contrato de Medidas de Mitigación',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_licencia_ambiental'])), $proyecto[0]['adj_licencia_ambiental'], array('target'=>'_blank'))
                       ),
                array ('label'=>'Estudio de Impacto en Tierras y Reasentamiento',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_estudio_tierras'])), $proyecto[0]['adj_estudio_tierras'], array('target'=>'_blank'))
                       ),
                array ('label'=>'Plan de Reasentamiento y Compensación',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_plan_reasentamiento'])), $proyecto[0]['adj_plan_reasentamiento'], array('target'=>'_blank'))
                       ),
                array ('label'=>'Plan Anual de Compras y Contrataciones (PACC) de SOPTRAVI o del Fondo VIAL',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_plan_anual_compras'])), $proyecto[0]['adj_plan_anual_compras'], array('target'=>'_blank'))
                       ),
                array ('label'=>'Acuerdo de Financiamiento',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_acuerdo_financiamiento'])), $proyecto[0]['adj_acuerdo_financiamiento'], array('target'=>'_blank'))
                       ),
                array ('label'=>'Nota Prioridad',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_nota_prioridad'])), $proyecto[0]['adj_nota_prioridad'], array('target'=>'_blank'))
                       ),
                array ('label'=>'Constancia del Banco',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_constancia_banco'])), $proyecto[0]['adj_constancia_banco'], array('target'=>'_blank'))
                       ),
                array ('label'=>'Otro',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($proyecto[0]['adj_otro'])), $proyecto[0]['adj_otro'], array('target'=>'_blank'))
                       ),
            ),
        ));

$this->endWidget('zii.widgets.jui.CJuiDialog');

//========================= CALIFICACION ======================================================
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'respCalificacion',    
'options'=>array(
                'title'=>'Información de Respaldo de Calificación',
                'autoOpen'=>false,
                'modal'=>true,
                'width'=>900,
               // 'height'=>700,
                'resizable'=>false,
                'show'=>array(
                'effect'=>'blind',
                'duration'=>1000,
                'scrolling'=>false
            ),        
                'hide'=>array(
                'effect'=>'blind',
                'duration'=>500,
            ),
                ),
                ));

        $this->widget('zii.widgets.CDetailView', array(
            'data'=>$calificacion,
            'attributes'=>array(
                 array('label'=>'Invitación a los Interesados para Participar en el Proceso de Calificación para la Ejecución del Proyecto o en la Calificación para el Concurso para la Supervición de Obras',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($calificacion[0]['adj_invitacion_interesados'])), $calificacion[0]['adj_invitacion_interesados'], array('target'=>'_blank'))
                           ),
                      array('label'=>'Bases de Precalificación del Proceso',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($calificacion[0]['adj_bases_precalificacion'])), $calificacion[0]['adj_bases_precalificacion'], array('target'=>'_blank'))
                           ),
                     array('label'=>'Resolución declarando la Precalificación de los Interesados que Acreditaron los Requisitos Exigidos en las Bases',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($calificacion[0]['adj_resolucion'])), $calificacion[0]['adj_resolucion'], array('target'=>'_blank'))
                           ),
                     array('label'=>'Nombre y Antecedentes de las Empresas Pre-calificadas para Participar en la Licitación',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($calificacion[0]['adj_antecedentes_empresas'])), $calificacion[0]['adj_antecedentes_empresas'], array('target'=>'_blank'))
                           ),
                     array('label'=>'Convocatoria o Invitación a Licitar',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($calificacion[0]['adj_convocatoria'])), $calificacion[0]['adj_convocatoria'], array('target'=>'_blank'))
                           ),
					array('label'=>'Pliego de Condiciones o Bases del Concurso (TdR)',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($calificacion[0]['adj_pliego_condiciones'])), $calificacion[0]['adj_pliego_condiciones'], array('target'=>'_blank'))
                           ),
					array('label'=>'Aclaraciones o Enmiendas al Pliego de Condiciones',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($calificacion[0]['adj_aclaraciones'])), $calificacion[0]['adj_aclaraciones'], array('target'=>'_blank'))
                           ),
					array('label'=>'Acta de Recepción/ Presentación de Ofertas',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($calificacion[0]['adj_acta_recepcion'])), $calificacion[0]['adj_acta_recepcion'], array('target'=>'_blank'))
                           ),
					array('label'=>'Otro',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($calificacion[0]['adj_otro'])), $calificacion[0]['adj_otro'], array('target'=>'_blank'))
                           ),
            ),
        ));

$this->endWidget('zii.widgets.jui.CJuiDialog');

//========================= ADJUDICACION ======================================================

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'respAdjudicacion',    
'options'=>array(
                'title'=>'Información de Respaldo de Adjudicación',
                'autoOpen'=>false,
                'modal'=>true,
                'width'=>900,
               // 'height'=>700,
                'resizable'=>false,
                'show'=>array(
                'effect'=>'blind',
                'duration'=>1000,
                'scrolling'=>false
            ),        
                'hide'=>array(
                'effect'=>'blind',
                'duration'=>500,
            ),
                ),
                ));

        $this->widget('zii.widgets.CDetailView', array(
            'data'=>$adjudicacion,
            'attributes'=>array(
                 array('label'=>'Acta de Apertura de las Ofertas',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($adjudicacion[0]['adj_acta_apertura'])), $adjudicacion[0]['adj_acta_apertura'], array('target'=>'_blank'))
                           ),
                      array('label'=>'Informe y Acta de Recomendación',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($adjudicacion[0]['adj_informe_acta'])), $adjudicacion[0]['adj_informe_acta'], array('target'=>'_blank'))
                           ),
                     array('label'=>'Resolución de la Adjudicación',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($adjudicacion[0]['adj_resolucion'])), $adjudicacion[0]['adj_resolucion'], array('target'=>'_blank'))
                           ),
                     array('label'=>'Otro',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($adjudicacion[0]['adj_otro'])), $adjudicacion[0]['adj_otro'], array('target'=>'_blank'))
                           ),
                     ),
        ));

$this->endWidget('zii.widgets.jui.CJuiDialog');

//========================= CONTRATACION ======================================================
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'respContratacion',   
'options'=>array(
                'title'=>'Información de Respaldo de Contratación',
                'autoOpen'=>false,
                'modal'=>true,
                'width'=>900,
               // 'height'=>700,
                'resizable'=>false,
                'show'=>array(
                'effect'=>'blind',
                'duration'=>1000,
                'scrolling'=>false
            ),        
                'hide'=>array(
                'effect'=>'blind',
                'duration'=>500,
            ),
                ),
                ));
        $this->widget('zii.widgets.CDetailView', array(
            'data'=>$contratacion,
            'attributes'=>array(
                 array('label'=>'Documento de Contrato y Condiciones',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($contratacion[0]['adj_contrato_condiciones'])), $contratacion[0]['adj_contrato_condiciones'], array('target'=>'_blank'))
                           ),
                      array('label'=>'Registro, Antecedentes e Información del Consultor o Propietario(s) de la Firma Contratada',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($contratacion[0]['adj_antecedentes'])), $contratacion[0]['adj_antecedentes'], array('target'=>'_blank'))
                           ),
                     array('label'=>'Especificaciones y Planos del Proyecto a Ejecutar Cuando Corresponda',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($contratacion[0]['adj_especificaciones_planos'])), $contratacion[0]['adj_especificaciones_planos'], array('target'=>'_blank'))
                           ),
                     array('label'=>'Otro',
                           'type'=>'raw',
                           'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($contratacion[0]['adj_otro'])), $contratacion[0]['adj_otro'], array('target'=>'_blank'))
                ),
                     ),
        ));

$this->endWidget('zii.widgets.jui.CJuiDialog');




?>

