<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0; width:100%;column-span:1;table-layout: fixed;border:none}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;width:33.3%}
.tg .tg-qp8u{color:#ffffff;text-align:center}
.tg .tg-header{font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;font-size:36px;border:0px}
.tg .tg-encabezados{font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;font-size:23px;}
.tg .tg-spacer{width:20%}

#map_canvas {
        width: 100%;
        height: 500px;
      }
	  
.slideshow { margin: auto;width:auto; height:auto; }
.slideshow img { width: 100%; height: 100%; padding: 2px; }

.tab_cont {border-color:#000;margin:0px;padding:0px;border-style:dashed;border:none;text-align:center;height:10%;font-family:Calibri, sans-serif;width:100% !important}
.tab_cont tr th{background:#000;border-width:1px;border-top:thin;border-left:thin;border-right:thin;font-size:15px;font-weight:bold;margin:0px;padding:0px;white-space:nowrap;padding:2px !important;}
.tab_cont th{color:#FFF;font-size:15px;}
.tab_cont tr td{border-width:0px;background:#FFCC33;font-size:12px;vertical-align:central;margin:0px;padding:0px !important;}
#styled_td {border-width:0px;background:#FFF;margin:2px;padding:0px !important;}


</style>
<?php if(!empty($Proyecto)){?>
	<table border="1" class="tg">
		<tr>
		<td class="tg-encabezados">Lista de Proyectos</br>
                        <img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px !important" /></td>
		</tr>
                </table >
             <table class="tab_cont">
		<tr>     
		<th>Código del Proyecto</th>
		<th>Nombre del Proyecto</th>
		<th>Descripción del Proyecto</th>
		<th>Presupuesto</th>
		<th>Ubicación</th>
		<th>Funcionario Responsable</th>
		<th>Estado</th>
		<th>Ficha</th>
		</tr>
		<?php 
					$row=0;
					$total_x=count($Proyecto);
					?>
<?php 
$td_style = false;
while ($row< $total_x){?>
	<tr>
                <?php if ($td_style == false){ ?>
		<!-- <td><?php //echo CHtml::link(CHtml::encode($Proyecto[$row] ['proyecto_codigo']), array('viewproyecto', 'id'=>$Proyecto[$row] ['idProyecto'])); ?></td> -->
		<td><?php echo $Proyecto[$row] ['proyecto_codigo'];?></td>
		<td><?php echo $Proyecto[$row] ['proyecto_nombre'];?></td>
		<td><?php echo $Proyecto[$row] ['proyecto_descripcion'];?></td>
		<td><?php echo number_format($Proyecto[$row] ['proyecto_presupuesto'],2,'.',',');?></td>	
		<td><?php echo $Proyecto[$row] ['proyecto_ubicacion'];?></td>
		<td><?php echo $Proyecto[$row] ['proyecto_funcionario'];?></td>	
                <td><?php echo $Proyecto[$row] ['proyecto_estado'];?></td>	
		<td><?php echo CHtml::link(CHtml::Button('Ver información detallada'), array('FichaTecnica', 'control'=>'Proyecto', 'id'=>$Proyecto[$row]['idProyecto'])); ?></td>	
	         <?php $td_style = true; }
                 else { ?>
                <td id="styled_td"><?php echo $Proyecto[$row] ['proyecto_codigo'];?></td>
		<td id="styled_td"><?php echo $Proyecto[$row] ['proyecto_nombre'];?></td>
		<td id="styled_td"><?php echo $Proyecto[$row] ['proyecto_descripcion'];?></td>
		<td id="styled_td"><?php echo number_format($Proyecto[$row] ['proyecto_presupuesto'],2,'.',',');?></td>	
		<td id="styled_td"><?php echo $Proyecto[$row] ['proyecto_ubicacion'];?></td>
		<td id="styled_td"><?php echo $Proyecto[$row] ['proyecto_funcionario'];?></td>	
                <td id="styled_td"><?php echo $Proyecto[$row] ['proyecto_estado'];?></td>	
		<td id="styled_td"><?php echo CHtml::link(CHtml::Button('Ver información detallada'), array('FichaTecnica', 'control'=>'Proyecto', 'id'=>$Proyecto[$row]['idProyecto'])); ?></td>	
                <?php $td_style = false;
               }?>   
        </tr>
	
<?php $row++;}?>
	</table>
                </br>
	<?php }else{ }?>