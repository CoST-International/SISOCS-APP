<?php
/* @var $this CiudadanoController */

$this->breadcrumbs=array(
    'Informe Técnico de Proyecto',
);
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile("assets/bootstrap/js/bootstrap.min.js");
Yii::app()->clientScript->registerCssFile("assets/bootstrap/css/bootstrap.min.css");
?><div align="center">
<table>
<tr>
<td>
Proyectos Registrados: <br /> <input type="text" name="nobras" value="<?php echo count(Proyecto::Model()->findAll());?>" readonly="true">
</td>
<td>
<?php $sum=Yii::app()->db->createCommand()
                ->select('sum(precio)')
                ->from('cs_contratacion')
                ->queryScalar();?>
Montos Contratados: <br /> <input type="text" name="moncon" size="40" value="LPS. <?php echo number_format($sum,2,'.',',');?>" readonly="true">
</td>
</tr>
</table>
<?php 
$programas=Programa::Model()->findAll();
if($programas!==null)
{
	foreach ($programas as $prg) 
	{
		$Proyectos=Proyecto::model()->findAll("idPrograma ='".$prg->idPrograma."'");		
		if(!empty($Proyectos)){?>
			<table class="detail-view">
				<tr bgcolor="#1D7BFE">
				<th colspan="5" style="">Lista de Proyectos del Programa # <?php echo $prg->idPrograma ?></th>
				</tr>
				<tr bgcolor="#5A9EFF">
				<th><u>Proyecto #</u></th>
				<th><u>Nombre del Proyecto</u></th>
				<th><u>Presupuesto</u></th>
				<th><u>Fecha de Creación</u></th>
				<th><u>Ficha</u></th>
				</tr>
		<?php foreach($Proyectos as $data){?>
			<tr class="odd">
				<td width="50"><?php echo CHtml::link(CHtml::encode($data->idProyecto), array('viewproyecto', 'id'=>$data->idProyecto)); ?></td>
				<td width="400"><?php echo $data->nombre_proyecto;?></td>
				<td width="100"><?php echo number_format($data->presupuesto,2,'.',',');?></td>	
				<td width="75"><?php echo $data->fechacreacion;?></td>		
				<td width="50"><?php echo CHtml::link(CHtml::Button('Ver Información Detallada'), array('fichatecnicapro', 'idpro'=>$data->idProyecto)); ?></td>	
			</tr>
		<?php }?>
			</table>
		<?php 
		}
		else
		{ }
	}

}?>
</div>
