<?php if(!empty($Contratacion)){?>
	<table border="1">
		<tr>
		<th colspan="8">Lista de Contrataciones</th>
		</tr>
		<tr>
		<th>Código de Contratación</th>
		<th>Número del Proceso</th>
		<th>Entidad de Administración de Contrato</th>
		<th>Consultor / Firma Contratada</th>
                <th>Precio</th>
		</tr>

<?php foreach($Contratacion as $data){
    $data->idEntidad=Yii::app()->db->createCommand()
                              ->select('descripcion')
                              ->from('cs_entes')
                              ->where('idente ='.$data->idEntidad)
                              ->queryScalar();
$data->idoferente=Yii::app()->db->createCommand()
                              ->select('nombre_empresa')
                              ->from('cs_empresa')
                              ->where("idempresa ='".$data->idoferente."'")
                              ->queryScalar();
$np=Yii::app()->db->createCommand()
                              ->select('nomprocesoproyecto')
                              ->from('cs_adjudicacion')
                              ->where("idAdjudicacion ='".$data->idAdjudicacion."'")
                              ->queryScalar();?>
	<tr>
		<td><?php echo CHtml::link(CHtml::encode($data->idContratacion), array('Contratacion/view', 'id'=>$data->idContratacion)); ?></td>
		<td><?php echo $np;?></td>
		<td><?php echo $data->idEntidad;?></td>
                <td><?php echo $data->idoferente;?></td>
		<td><?php echo number_format($data->precio,2,'.',',');?></td>		
	</tr>
<?php }?>
	</table>
	<?php }else{ }?>
