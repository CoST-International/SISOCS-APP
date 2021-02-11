

<?php if(!empty($Contratos)){?>
	<table border="1" class="tg">
		<tr >
                    <td class="tg-encabezados">Lista de Contrataciones</br>
                        <img src="<?php echo Yii::app()->baseUrl.'/images/ciudadano_reportes/u6_line.png' ?>" style="height:2px !important" /></td>
		</tr>
        </table >
             <table class="tab_cont">
		<tr>
            <th>Código de Contrato</th>
            <th>Título del contrato</th>
            <th>Alcances del contrato</th>
            <th>Precio del contrato Lps</th>
            <th>Fecha de inicio</th>
            <th>Fecha de finalización</th>
            <th>Duración del contrato</th>
            <th width="100px">Ficha</th>
		</tr>
<?php 
    $row=0;
    $total_x=count($Contratos);
?>
<?php 

$td_style = false;

while ($row< $total_x){?>
        <tr>
        <?php if ($td_style == false){ ?>
            <td><?php echo $Contratos[$row] ['contratacion_numero'];?></td>
            <td><?php echo $Contratos[$row] ['contratacion_nombre'];?></td>
            <td><?php echo $Contratos[$row] ['contratacion_alcances'];?></td>
            <td><?php echo number_format($Contratos[$row] ['contratacion_precio'],2,'.',',');?></td>	
            <td><?php echo $Contratos[$row] ['contratacion_inicio'];?></td>
            <td><?php echo $Contratos[$row] ['contratacion_final'];?></td>
            <td><?php echo $Contratos[$row] ['contratacion_duracion'];?></td>
            <td><?php echo CHtml::link(CHtml::Button('Ver información detallada'), array('FichaTecnica', 'control'=>'Contratacion', 'id'=>$Contratos[$row] ['idContratacion'])); ?></td>      
            <?php $td_style = true; }
           else { ?>
            <td id="styled_td"><?php echo $Contratos[$row] ['contratacion_numero'];?></td>
            <td id="styled_td"><?php echo $Contratos[$row] ['contratacion_nombre'];?></td>
            <td id="styled_td"><?php echo $Contratos[$row] ['contratacion_alcances'];?></td>
            <td id="styled_td"><?php echo number_format($Contratos[$row] ['contratacion_precio'],2,'.',',');?></td>	
            <td id="styled_td"><?php echo $Contratos[$row] ['contratacion_inicio'];?></td>
            <td id="styled_td"><?php echo $Contratos[$row] ['contratacion_final'];?></td>
            <td id="styled_td"><?php echo $Contratos[$row] ['contratacion_duracion'];?></td>
            <td id="styled_td"><?php echo CHtml::link(CHtml::Button('Ver información detallada'), array('FichaTecnica', 'control'=>'Contratacion', 'id'=>$Contratos[$row] ['idContratacion'])); ?></td>      
           <?php $td_style = false;
         } ?>               
        </tr>
	
<?php $row++; } ?>
        
             </table>
        </br>

	<?php }else{  }?>