

<?php if(!empty($Adjudicacion)){?>
	<table border="1"  class="tg">
		<tr>
		<td class="tg-encabezados">Lista de Adjudicaciones</br>
                        <img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px !important" />
                </td>
		</tr>
                 </table >
             <table class="tab_cont">
		<tr>
		<th>Código de Adjudicación</th>
		<th>Número del Proceso</th>
		<th>Nombre del Proceso</th>
		<th># Consultores Nac</th>
		<th># Consultores Inter</th>
		<th>Costo Estimado</th>
		<th>Estado del Proceso</th>
        <th width="100px">Ficha</th>
		</tr>

		
<?php 
					$row=0;
					$total_x=count($Adjudicacion);
					?>
<?php 
$td_style = false;
while ($row < $total_x){?>
	<tr>
 <?php if ($td_style == false) { ?>
            <td><?php echo $Adjudicacion[$row]['idAdjudicacion']; ?></td>
            <td><?php echo $Adjudicacion[$row]['adjudicacion_codigo'];?></td>
            <td><?php echo $Adjudicacion[$row]['adjudicacion_nombre'];?></td>
            <td><?php echo $Adjudicacion[$row]['adjudicacion_nacionales'];?></td>	
            <td><?php echo $Adjudicacion[$row]['adjudicacion_internacionales'];?></td>	
            <td><?php echo (is_numeric($Adjudicacion[$row]['adjudicacion_costo']))?number_format($Adjudicacion[$row]['adjudicacion_costo'],2,'.',','):'0.00';?></td>
            <td><?php echo $Adjudicacion[$row]['adjudicacion_proceso'];?></td>	
            <td><?php echo CHtml::link(CHtml::Button('Ver información detallada'), array('FichaTecnica', 'control'=>'Adjudicacion', 'id'=>$Adjudicacion[$row]['idAdjudicacion'])); ?></td>
            <?php $td_style = true; }
       else { ?>
            <td id="styled_td"><?php echo $Adjudicacion[$row]['idAdjudicacion']; ?></td>
            <td id="styled_td"><?php echo $Adjudicacion[$row]['adjudicacion_codigo'];?></td>
            <td id="styled_td"><?php echo $Adjudicacion[$row]['adjudicacion_nombre'];?></td>
            <td id="styled_td"><?php echo $Adjudicacion[$row]['adjudicacion_nacionales'];?></td>	
            <td id="styled_td"><?php echo $Adjudicacion[$row]['adjudicacion_internacionales'];?></td>	
            <td id="styled_td"><?php echo (is_numeric($Adjudicacion[$row]['adjudicacion_costo']))?number_format($Adjudicacion[$row]['adjudicacion_costo'],2,'.',','):'0.00';?></td>
            <td id="styled_td"><?php echo $Adjudicacion[$row]['adjudicacion_proceso'];?></td>
            <td id="styled_td"><?php echo CHtml::link(CHtml::Button('Ver información detallada'), array('FichaTecnica', 'control'=>'Adjudicacion', 'id'=>$Adjudicacion[$row]['idAdjudicacion'])); ?></td>
            <?php $td_style = false;
       } ?>   
	</tr>
	
<?php $row++; } ?>		
	</table>
                 </br>
	<?php }else{ }?>
