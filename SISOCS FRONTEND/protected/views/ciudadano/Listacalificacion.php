


<?php if(!empty($Calificacion)){?>
	<table border="1"  class="tg">
		<tr>
		<td class="tg-encabezados">Lista de Calificaciones</br>
                        <img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px !important" /></td>
		</tr>
                </table >
             <table class="tab_cont">
		<tr>
            <th>Código de Calificación</th>
            <th>Número del Proceso</th>
            <th>Nombre del Proceso</th>
            <th>Código de Evaluacion</th>
            <th>Entidad</th>
            <th>Nombre Funcionario</th>
            <th>Estatus</th>
            <th>Ficha Tecnica</th>		
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
            <td><?php echo $Calificacion[$row]['idCalificacion'];?></td>
            <td><?php echo $Calificacion[$row]['calificacion_codigo'];?></td>
            <td><?php echo $Calificacion[$row]['calificacion_nombre'];?></td>
            <td><?php echo $Calificacion[$row]['calificacion_evaluacion'];?></td>
            <td><?php echo $Calificacion[$row]['calificacion_entidad'];?></td>
            <td><?php echo $Calificacion[$row]['calificacion_funcionario'];?></td>
            <td><?php echo $Calificacion[$row]['calificacion_estatus'];?></td>
            <td><?php echo CHtml::link(CHtml::Button('Ver información detallada'), array('FichaTecnica', 'control'=>'Calificacion', 'id'=>$Calificacion[$row]['idCalificacion'])); ?></td>
            <?php $td_style = true; }
        else { ?>
            <td id="styled_td"><?php echo $Calificacion[$row]['idCalificacion'];?></td>
            <td id="styled_td"><?php echo $Calificacion[$row]['calificacion_codigo'];?></td>
            <td id="styled_td"><?php echo $Calificacion[$row]['calificacion_nombre'];?></td>
            <td id="styled_td"><?php echo $Calificacion[$row]['calificacion_evaluacion'];?></td>
            <td id="styled_td"><?php echo $Calificacion[$row]['calificacion_entidad'];?></td>
            <td id="styled_td"><?php echo $Calificacion[$row]['calificacion_funcionario'];?></td>
            <td id="styled_td"><?php echo $Calificacion[$row]['calificacion_estatus'];?></td>
            <td id="styled_td"><?php echo CHtml::link(CHtml::Button('Ver información detallada'), array('FichaTecnica', 'control'=>'Calificacion', 'id'=>$Calificacion[$row]['idCalificacion'])); ?></td>
            <?php $td_style = false;  }?>  
        </tr>
<?php $row++;}?>		
	</table>
	<?php }else{ }?>
