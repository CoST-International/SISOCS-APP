

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