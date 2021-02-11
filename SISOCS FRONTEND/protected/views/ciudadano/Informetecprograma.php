
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
if(!empty($programas))
{
	foreach ($programas as $prg) 
	{
		$Proyectos=Proyecto::model()->findAll("idPrograma ='".$prg->idPrograma."'");
		$prg->idFuncionario=Yii::app()->db->createCommand()
                              ->select('nombre')
                              ->from('cs_funcionarios')
                              ->where('idFuncionario ='.$prg->idFuncionario)
                              ->queryScalar();
		$prg->entes=Yii::app()->db->createCommand()
                              ->select('descripcion')
                              ->from('cs_entes')
                              ->where("idente ='".$prg->entes."'")
                              ->queryScalar();
                              ?>
		<table class="tab_cont">
		<tr >
				<th><u>Programa #</u></th>
				<th><u>Nombre del Programa</u></th>
				<th><u>Ente(s) responsable(s)</u></th>
				<th><u>Funcionario responsable</u></th>
				<th><u>Costo estimado </u></th>
				<th><u>Fecha de Creación</u></th>
		</tr>
		<tr>
		
				<td width="50"><?php echo $prg->idPrograma;?></td>
				<td width="400"><?php echo $prg->nombreprograma;?></td>
				<td width="200"><?php echo $prg->entes;?></td>	
				<td width="75"><?php echo $prg->idFuncionario;?></td>		
				<td width="50"><?php echo number_format($prg->costoesti,2,'.',','); ?></td>	
				<td width="50"><?php echo $prg->fechacreacion;?></td>
		</tr>
		<?php $td_style = false; if(!empty($Proyectos)){?>			
				<tr bgcolor="#5A9EFF">
				<th><u>Proyecto #</u></th>
				<th><u>Nombre del Proyecto</u></th>
				<th><u>Presupuesto</u></th>
				<th><u>Responsable</u></th>
				<th colspan="2"><u>Propósito</u></th>
				</tr>
		<?php foreach($Proyectos as $data){?>
			<tr class="odd">
                            <?php if ($td_style == false){ ?>
			<?php
			$data->idFuncionario=Yii::app()->db->createCommand()
                              ->select('nombre')
                              ->from('cs_funcionarios')
                              ->where('idFuncionario ='.$data->idFuncionario)
                              ->queryScalar();
			$data->idProposito=Yii::app()->db->createCommand()
                              ->select('proposito')
                              ->from('cs_proposito')
                              ->where("idproposito ='".$data->idProposito."'")
                              ->queryScalar();
                              ?>
				<td width="50"><?php echo $data->idProyecto ?></td>
				<td width="400"><?php echo $data->nombre_proyecto;?></td>
				<td width="100"><?php echo number_format($data->presupuesto,2,'.',',');?></td>	
				<td width="75"><?php echo $data->idFuncionario;?></td>		
				<td width="50" colspan="2"><?php echo $data->idProposito; ?></td>
                                 <?php $td_style = true; }
                                    else { ?> 
                                	<?php
			$data->idFuncionario=Yii::app()->db->createCommand()
                              ->select('nombre')
                              ->from('cs_funcionarios')
                              ->where('idFuncionario ='.$data->idFuncionario)
                              ->queryScalar();
			$data->idProposito=Yii::app()->db->createCommand()
                              ->select('proposito')
                              ->from('cs_proposito')
                              ->where("idproposito ='".$data->idProposito."'")
                              ->queryScalar();
                              ?>
				<td width="50"  id="styled_td"><?php echo $data->idProyecto ?></td>
				<td width="400"  id="styled_td"><?php echo $data->nombre_proyecto;?></td>
				<td width="100"  id="styled_td"><?php echo number_format($data->presupuesto,2,'.',',');?></td>	
				<td width="75"  id="styled_td"><?php echo $data->idFuncionario;?></td>		
				<td width="50" colspan="2"  id="styled_td"><?php echo $data->idProposito; ?></td>
                                <?php $td_style = false;
               }?>              
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
