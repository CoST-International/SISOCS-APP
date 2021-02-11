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

   <script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/css/themes/jquery-1.11.1.min.js' ?>"></script>


<?php if(!empty($Calificacion)){?>
	<table border="1" class="tg">
		<tr >
                    <td class="tg-encabezados">Lista de Procesos de Calificacion</br>
                        <img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px !important" /></td>
		</tr>
        </table >
             <table class="tab_cont">
		<tr>
            <th>Código</th>
            <th>Nombre del Proceso</th> 
            <th>Ficha</th>
		</tr>
<?php 
    $row=0;
    $total_x=count($Calificacion);
?>
<?php 

$td_style = false;

while ($row< $total_x){?>
        <tr>
        <?php if ($td_style == false){ ?>
            <td><?php echo $Calificacion[$row]['calificacion_codigo'];?></td>
            <td><?php echo $Calificacion[$row]['calificacion_nombre'];?></td> 
            <td><?php echo CHtml::link(CHtml::Button('Detalle'), array('FichaTecnica', 'control'=>'Calificacion', 'id'=>$Calificacion[$row]['idCalificacion'])); ?></td>      
           <?php $td_style = true; }
           else { ?>
            <td id="styled_td"><?php echo $Calificacion[$row]['calificacion_codigo'];?></td>
            <td id="styled_td"><?php echo $Calificacion[$row]['calificacion_nombre'];?></td>   
            <td id="styled_td"><?php echo CHtml::link(CHtml::Button('Detalle'), array('FichaTecnica', 'control'=>'Calificacion', 'id'=>$Calificacion[$row]['idCalificacion'])); ?></td>      
           <?php $td_style = false;
               }?>               
        </tr>
	
<?php $row++;}?>
        
             </table>
        </br>
	<?php }else{  }?>