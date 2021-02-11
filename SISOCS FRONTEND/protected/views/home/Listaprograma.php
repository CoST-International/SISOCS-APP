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

<?php if(!empty($Programas)){?>
	<table border="1" class="tg">
		<tr>
		<td colspan="8">Lista de Programas</br>
                        <img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px !important" /></td>
		</tr>
                </table >
             <table class="tab_cont">
		<tr>
		<th>Código del Programa</th>
		<th>Nombre del Programa</th>
		<th>Descripción</th>
		<th>Costo estimado Lps</th>
		<th>Fecha de aprobacion</th>
		<th>BIP</th>
		<th>Funcionario</th>
		<th>Ficha</th>
		</tr>
<?php 
					$row=0;
					$total_x=count($Programas); //print_r($Programas);
					?>  
				  
<?php 
$td_style = false;
while ($row< $total_x){?>
	<tr>
                <?php if ($td_style == false){ ?>
		<!-- <td><?php echo CHtml::link(CHtml::encode($Programas[$row] ['idPrograma']), array('viewprograma', 'id'=>$Programas[$row] ['idPrograma'])); ?></td> -->
		<td><?php echo $Programas[$row] ['programa_codigo'];?></td>
		<td><?php echo $Programas[$row] ['programa_nombre'];?></td>
		<td><?php echo $Programas[$row] ['programa_descripcion'];?></td>
		<td><?php echo number_format($Programas[$row] ['programa_costo'],2,'.',',');?></td>	
		<td><?php echo $Programas[$row] ['programa_fecha'];?></td>
		<td><?php echo $Programas[$row] ['BIP'];?></td>
		<td><?php echo $Programas[$row] ['programa_funcionario'];?></td>
		<td><?php echo CHtml::link(CHtml::Button('Ver información detallada'), array('FichaTecnica', 'control'=>'Programa', 'id'=>$Programas[$row]['idPrograma'])); ?></td>	
	         <?php $td_style = true; }
                 else { ?>
                <td id="styled_td"><?php echo $Programas[$row] ['programa_codigo'];?></td>
		<td id="styled_td"><?php echo $Programas[$row] ['programa_nombre'];?></td>
		<td id="styled_td"><?php echo $Programas[$row] ['programa_descripcion'];?></td>
		<td id="styled_td"><?php echo number_format($Programas[$row] ['programa_costo'],2,'.',',');?></td>	
		<td id="styled_td"><?php echo $Programas[$row] ['programa_fecha'];?></td>
		<td id="styled_td"><?php echo $Programas[$row] ['BIP'];?></td>
		<td id="styled_td"><?php echo $Programas[$row] ['programa_funcionario'];?></td>
		<td id="styled_td"><?php echo CHtml::link(CHtml::Button('Ver información detallada'), array('FichaTecnica', 'control'=>'Programa', 'id'=>$Programas[$row]['idPrograma'])); ?></td>	
                 <?php $td_style = false;
               }?>   
        </tr>
	
<?php $row++;} ?>
	</table>
	<?php }else{ }?>