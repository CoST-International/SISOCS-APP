<?php
/* @var $this CiudadanoController */

$this->breadcrumbs=array(
	'Ciudadano'=>array('index'),
);
define('YII_DEBUG', true);

?>
<!--*************************************************DATOS PROGRAMA*************************************************************-->
<table class="detail-view">
<tr>
<td colspan="4">
<?php //print_r($calificacion); ?>
<u><h3><center>Planificación del Programa</center></h3></u>
</td>
</tr>
<tr class="odd">
<td>
<strong>Código: </strong> <?php echo $proyecto->codigo ?>
</td>
<td colspan="3">
<strong>Nombre del Programa:</strong> <?php echo $programa->nombreprograma ?>
</td>
<td>
<strong>Funcionario responsable del programa: </strong><br/>
<?php 
      $resp = Funcionarios::Model()->find("idfuncionario ='".$programa->idFuncionario."'");
      
      echo "<strong>Nombre : </strong>$resp->nombre<br>
            <strong>Puesto : </strong>$resp->puesto<br>
            <strong>Teléfono : </strong>$resp->telefono<br>
            <strong>Correo : </strong>$resp->correo"; ?>
</td>
</tr>
<tr class="even">
<td >
<strong>Programa:</strong> <?php echo $programa->programa ?>
</td>

<td colspan="3"><strong>Detalle Propositos </strong>
		<?php $filtro_grid =$programa->idPrograma;
				     if($filtro_grid==''){$filtro_grid='0';}			
				;?>
	<?php
				$dataProvider=new CActiveDataProvider('Proposito',array(
									'criteria'=>array(
									    'condition'=>'idproposito in (select idproposito from cs_programa_proposito where idprograma='.$filtro_grid.')',
									    'order'=>'idproposito ASC',									    
									),
						//			'countCriteria'=>array(
							//		    'condition'=>'idoferentes='.$filtro_grid,
									    // 'order' and 'with' clauses have no meaning for the count query
								//	),
									'pagination'=>array(
									    'pageSize'=>20,
									),));

				
				$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'contratos-grid',
					'dataProvider'=>$dataProvider,
					'columns'=>array(
						'idproposito',
						'proposito',
						
					),
				)); ?>
		
</td>
</tr>
<tr>
<td>
</td>
<td colspan="3"><strong>Detalle Fuentes  </strong>
		<?php $filtro_grid =$programa->idPrograma;
				     if($filtro_grid==''){$filtro_grid='0';}			
				;?>
	<?php
				$dataProvider=new CActiveDataProvider('Fuentesfinan',array(
									'criteria'=>array(
									    'condition'=>'idfuente in (select idfuente from cs_programa_fuente where idprograma='.$filtro_grid.')',
									    'order'=>'idfuente ASC',									    
									),
						//			'countCriteria'=>array(
							//		    'condition'=>'idoferentes='.$filtro_grid,
									    // 'order' and 'with' clauses have no meaning for the count query
								//	),
									'pagination'=>array(
									    'pageSize'=>20,
									),));

				
				$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'contratos-grid',
					'dataProvider'=>$dataProvider,
					'columns'=>array(
						'idfuente',
						'fuente',
						
					),
				)); ?>
		
</td>
<td>
</td>
</tr>
<td>
<strong>Ubicación:</strong> <?php echo $depto->departamento ?>
</td>
</tr>


<tr class="odd">
<td >
<strong>Entidad:</strong> 
<?php 
      $resp = Entes::Model()->find("idente ='".$programa->entes."'");
      echo "$resp->descripcion<br>"; ?>
</td>

<td>
<strong>Rol:</strong> 
<?php 
      $resp = Rol::Model()->find("idrol ='".$programa->idRol."'");
      echo "$resp->rol<br>"; ?>
</td>
<td>
<strong>Sector:</strong>
<?php 
      $resp = Sector::Model()->find("idsector ='".$programa->idSector."'");
      echo "$resp->sector<br>"; ?>
</td>
<td >
<strong>Sub Sector:</strong>
<?php 
      $resp = Subsector::Model()->find("idsubsector ='".$programa->idSubSector."'");
      echo "$resp->subsector<br>"; ?>
</td>
</tr>


<tr class="even">
<td colspan="3">
<strong>Descripción y alcances del Programa: </strong><?php echo $proyecto->descrip ?>
</td>

</tr>
<tr class="odd">
<td colspan="2">
<strong>Costo Estimado de la Obra:</strong> <br/>
<?php echo number_format($programa->costoesti,2,'.',',') ?>
</td>
<td colspan="2">
<strong>Moneda:</strong> <br/>
<?php echo $programa->moneda ?>
</td>

<td>
<?php echo CHtml::Button('Ver información de respaldo',array('onclick' => '$("#proadquisicion").dialog("open"); return false;',));?>
</td>
</tr>
</table>


<!-- *************************************DATOS PROYECTO********************************************************************-->
<table class="detail-view">
<tr>
<td colspan="5">
<u><h3><center>Planificación del Proyecto</center></h3></u>
</td>
</tr>
<tr class="odd">
<td>
<strong>Código: </strong> <?php echo $proyecto->codigo ?>
</td>
<td colspan="3">
<strong>Nombre del Proyecto:</strong> <?php echo $proyecto->nombre_proyecto ?>
</td>
<td>
<strong>Funcionario responsable del proyecto: </strong><br/>
<?php 
      $resp = Funcionarios::Model()->find("idfuncionario ='".$programa->idFuncionario."'");
      
      echo "<strong>Nombre : </strong>$resp->nombre<br>
            <strong>Puesto : </strong>$resp->puesto<br>
            <strong>Teléfono : </strong>$resp->telefono<br>
            <strong>Correo : </strong>$resp->correo"; ?>
</td>
</tr>
<tr class="even">
<td>
<strong>Propósito:</strong> <?php echo $proposito->proposito ?>
</td>
<td >
<strong>Ubicación:</strong> <?php echo $depto->departamento ?>
</td>
<td>
<strong>Costo Estimado de la Obra:</strong> <br/>
<?php echo number_format($programa->costoesti,2,'.',',') ?>
</td>
</tr>
<tr class="odd">
<td colspan="4">
<strong>Descripción y alcances del Proyecto: </strong><?php echo $proyecto->descrip ?>
</td>
<td>
<?php echo CHtml::Button('Ver información de respaldo',array('onclick' => '$("#proadquisicion").dialog("open"); return false;',));?>
</td>
</tr>
<tr class="even">
<td >
<strong>Proyecto: </strong><?php echo $proyecto->codigo ?>
</td>
<td >
<strong>Clase: </strong>
<?php 
      $resp = Clase::Model()->find("idclase ='".$proyecto->clase."'");
      echo "$resp->clase<br>"; ?>
</td>
<td >
<strong>Ubicación: </strong>
<?php 
      $resp = Ubicacionvial::Model()->find("idUbicacion ='".$proyecto->idUbicacion."'");
      echo "$resp->codigo<br>"; ?>

</td>
<td >
<strong>Región: </strong>
<?php 
      $resp = Region::Model()->find("idregion ='".$proyecto->idRegion."'");
      echo "$resp->region<br>"; ?>
</td>
<td >
<strong>Departamento: </strong>
<?php 
      $resp = Departamento::Model()->find("codigodepto ='".$proyecto->idDepto."'");
      echo "$resp->departamento<br>"; ?>

</td>
</tr>
<tr class="odd">
<td >
<strong>Tramo: </strong><?php echo $proyecto->idTramo ?>
</td>
<td >
<strong>Ruta: </strong><?php echo $proyecto->idRuta ?>
</td>
<td colspan="2" >
<strong>Tipo Red: </strong>
<?php 
      $resp = Tipored::Model()->find("Idtipored ='".$proyecto->idTipoRed."'");
      echo "$resp->descripción_tipo<br>"; ?>
</td>
<td colspan="2">
<?php echo CHtml::Button('Ver información de respaldo',array('onclick' => '$("#proadquisicion").dialog("open"); return false;',));?>
</td>
</tr>
<tr class="even">
<td>
</td>
<td colspan="3"><strong>Detalle de Benficiarios </strong>

 
?>
		<?php $filtro_grid =$proyecto->idProyecto;
				     if($filtro_grid==''){$filtro_grid='0';}			
				;?>
	<?php
				$dataProvider=new CActiveDataProvider('Beneficiario',array(
									'criteria'=>array(
									    'condition'=>'idbeneficiarios in (select idbeneficiario from cs_proyecto_beneficiario where idproyecto='.$filtro_grid.')',
									    'order'=>'idbeneficiarios ASC',									    
									),
						//			'countCriteria'=>array(
							//		    'condition'=>'idoferentes='.$filtro_grid,
									    // 'order' and 'with' clauses have no meaning for the count query
								//	),
									'pagination'=>array(
									    'pageSize'=>20,
									),));

				
				$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'contratos-grid',
					'dataProvider'=>$dataProvider,
					'columns'=>array(
						'idbeneficiarios',
						'depto',
						'muni',
					),
				)); ?>
		
</td>
<td>
</td>
</tr>
</tr>
<tr class="even">
<td>
</td>
<td colspan="3"><strong>Detalle Fuentes Financiamiento </strong>
		<?php $filtro_grid =$proyecto->idProyecto;
				     if($filtro_grid==''){$filtro_grid='0';}			
				;?>
	<?php
				$dataProvider=new CActiveDataProvider('Fuentesfinan',array(
									'criteria'=>array(
									    'condition'=>'idFuente in (select idfuente from cs_proyecto_fuente	where idproyecto='.$filtro_grid.')',
									    'order'=>'idFuente ASC',									    
									),
						//			'countCriteria'=>array(
							//		    'condition'=>'idoferentes='.$filtro_grid,
									    // 'order' and 'with' clauses have no meaning for the count query
								//	),
									'pagination'=>array(
									    'pageSize'=>20,
									),));

				
				$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'contratos-grid',
					'dataProvider'=>$dataProvider,
					'columns'=>array(
						'idfuente',
						'fuente',
						
					),
				)); ?>
		
</td>
<td>
</td>
</tr>

</table>
<!-- ********************************************************INVITACION Y CALIFICACION***********************************************************************-->
<table class="detail-view">
<tr>
<td colspan="10">
<u><h3><center>Invitación y Calificación</center></h3></u>
</td>
</tr>
<tr class="odd">
<td>
<strong>N° Proyecto: </strong><br/>
<?php echo $calificacion->idProyecto ?>
</td>
<td colspan="4">
<strong>Nombre del Proyecto:</strong> <?php echo $adjudicacion->nomprocesoproyecto ?>
</td>
<td colspan="2">
<strong>Funcionario responsable del proyecto: </strong><br/>
<?php 
      $resp = Funcionarios::Model()->find("idfuncionario ='".$programa->idFuncionario."'");
      
      echo "<strong>Nombre : </strong>$resp->nombre<br>
            <strong>Puesto : </strong>$resp->puesto<br>
            <strong>Teléfono : </strong>$resp->telefono<br>
            <strong>Correo : </strong>$resp->correo"; ?>
</td>
</tr>
<tr class="even">
<td>
<strong>Costo estimado:</strong> <?php echo number_format($adjudicacion->costoesti,2,'.',',') ?>
</td>
<td >
<strong>Fecha Recepción:</strong> <br/>
<?php echo $adjudicacion->fecharecibido ?>
</td>
<td >
<strong>Estado:</strong> <?php echo $adjudicacion->estadoproceso ?>
</td>
<td >
<strong>Método y Proceso de Adquisición:</strong> <?php $resp = Tipoadquisicion::Model()->find("idtipo ='".$calificacion->idmetodo."'");
      
      echo "$resp->adquisicion<br>"; ?><br/>
</td>
<td >
</td>

<td >
<?php echo CHtml::Button('Ver información de respaldo',array('onclick' => '$("#procalificacion").dialog("open"); return false;',));?>
</td>

</tr>
<tr class="odd">
<td >
<strong>Numero de Proceso:</strong> <?php echo $adjudicacion->numproceso ?><br/>
</td>
<td >
<strong>Fecha Actualización:</strong> <?php echo $calificacion->fechactualizacion ?><br/>
</td>
<td colspan="2">
<strong>Entidadad adquisición:</strong> <?php $resp = Entes::Model()->find("idente ='".$calificacion->identidadadquisicion."'");
      
      echo "$resp->descripcion<br>"; ?><br/>
</td>
<td >
<strong>Tipo Contrato:</strong> <?php echo $calificacion->tipocontrato ?><br/>
</td>
<td >
<strong>Proceso Evaluación:</strong> <?php echo $calificacion->proceseval ?><br/>
</td>

</tr>
<tr>
<td colspan="2"><strong>Detalle de Oferentes </strong>
		<?php $filtro_grid =$calificacion->idCalificacion;
				     if($filtro_grid==''){$filtro_grid='0';}			
				;?>
	<?php
				$dataProvider=new CActiveDataProvider('Oferente',array(
									'criteria'=>array(
									    'condition'=>'idoferentes in (select idoferente from cs_calificacion_oferente where idcalificacion='.$filtro_grid.')',
									    'order'=>'idoferentes ASC',									    
									),
						//			'countCriteria'=>array(
							//		    'condition'=>'idoferentes='.$filtro_grid,
									    // 'order' and 'with' clauses have no meaning for the count query
								//	),
									'pagination'=>array(
									    'pageSize'=>20,
									),));

				
				$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'contratos-grid',
					'dataProvider'=>$dataProvider,
					'columns'=>array(
						'idoferentes',
						'nombre_oferente',
						
					),
				)); ?>
		
</td>
<td colspan="2"><strong>Detalle de Empresas </strong>
		<?php $filtro_grid =$calificacion->idCalificacion;
				     if($filtro_grid==''){$filtro_grid='0';}			
				;?>
	<?php
				$dataProvider=new CActiveDataProvider('Empresa',array(
									'criteria'=>array(
									    'condition'=>'idempresa in (select idempresa from cs_calificacion_empresa where idcalificacion='.$filtro_grid.')',
									    'order'=>'idempresa ASC',									    
									),
						//			'countCriteria'=>array(
							//		    'condition'=>'idoferentes='.$filtro_grid,
									    // 'order' and 'with' clauses have no meaning for the count query
								//	),
									'pagination'=>array(
									    'pageSize'=>20,
									),));

				
				$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'contratos-grid',
					'dataProvider'=>$dataProvider,
					'columns'=>array(
						'idempresa',
						'nombre_empresa',
						
					),
				)); ?>
		
</td>
<td colspan="2"><strong>Detalle de Firmas </strong>
		<?php $filtro_grid =$calificacion->idCalificacion;
				     if($filtro_grid==''){$filtro_grid='0';}			
				;?>
	<?php
				$dataProvider=new CActiveDataProvider('CalificacionFirma',array(
									'criteria'=>array(
									    'condition'=>'idfirma in (select idfirma from cs_calificacion_firma where idcalificacion='.$filtro_grid.')',
									    'order'=>'idfirma ASC',									    
									),
						//			'countCriteria'=>array(
							//		    'condition'=>'idoferentes='.$filtro_grid,
									    // 'order' and 'with' clauses have no meaning for the count query
								//	),
									'pagination'=>array(
									    'pageSize'=>20,
									),));

				
				$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'contratos-grid',
					'dataProvider'=>$dataProvider,
					'columns'=>array(
						'idfirma',
						'nombre_firma',
						
					),
				)); ?>
		
</td>
</tr>				
</table>



<!-- ********************************************************EVALUACION Y ADJUDICACION***********************************************************************-->
<table class="detail-view">
<tr>
<td colspan="7">
<u><h3><center>Proceso de Evaluación de las Ofertas  y Adjudicación</center></h3></u>
</td>
</tr>
<tr class="odd">
<td>
<strong>N° Proceso: </strong><br/>
<?php echo $adjudicacion->numproceso ?>
</td>
<td colspan="3">
<strong>Nombre del Proceso:</strong> <?php echo $proyecto->nombre_proyecto ?>
</td>
<td colspan="3">
<strong>Funcionario responsable de este proceso:</strong> <br/>
<?php 
      $resp = Funcionarios::Model()->find("idfuncionario ='".$calificacion->idFuncionario."'");
      
      echo "<strong>Nombre : </strong>$resp->nombre<br>
            <strong>Puesto : </strong>$resp->puesto<br>
            <strong>Teléfono : </strong>$resp->telefono<br>
            <strong>Correo : </strong>$resp->correo"; ?>
</td>
</tr>
<tr class="even">
<td>
<strong>Responsable:</strong> <?php echo $responsable->nombre ?>
</td>
<td> 
<strong>Metodo de Adjudicación: </strong><?php 
echo Yii::app()->db->createCommand()
                              ->select('adquisicion')
                              ->from('cs_tiposadquisicion')
                              ->where("idtipo ='".$calificacion->idmetodo."'")
                              ->queryScalar(); ?>
</td>
<td colspan="5">
<strong>Tipo de Contrato:</strong> <br/>
<?php echo $calificacion->tipocontrato ?>
</td>
</tr>
<tr class="odd">
<td>
<strong>Numero de firmas que Licitaron:</strong> <?php echo $adjudicacion->numfirmasnac." Nacionales y ".$adjudicacion->numfimasinter." Internacionales" ?>
</td>
<td>
<strong>Numero de firmas en lista corta: </strong><?php echo $adjudicacion->numconsulcorta ?>
</td>
<td>
<strong>Precio Base: </strong><br/>
<?php echo number_format($adjudicacion->costoesti,2,'.',',') ?>
</td>
<td colspan="4">
<strong>Status del Proceso: </strong><br />
<?php echo $calificacion->estatusproceso ?>
</td>
</tr>
<tr class="even">
<td>
<strong>Número Contrato:</strong> <br/>
<?php echo $contratacion->ncontrato ?>
</td>
<td>
<strong>Título del Contrato: </strong><br/>
<?php echo $contratacion->titulocontrato ?>
</td>
<td>
<strong>Entidad Administracion: </strong><br />
<?php echo $admon->descripcion ?>
</td>
<td>
<strong>Precio del Contrato: </strong><br />
<?php echo number_format($contrato->precioactual,2,'.',',') ?>
</td>
<td>
<strong>Fecha de inicio del contrato: </strong>
<?php echo $contratacion->fechainicio ?>
</td>
<td>
<strong>Fecha de fin del contrato: </strong><?php echo $contratacion->fechafinal ?>
</td>
<td>
<strong>Duración del contrato: </strong><?php echo $contratacion->duracioncontrato ?>
</td>
</tr>
<tr class="odd">
<td >
<strong>Alcances de trabajo en el contrato: </strong><?php echo $contrato->alcanceactucontrato ?>
</td>
<td >
<strong>Número Consultores Nacionales: </strong><?php echo $adjudicacion->nconsulnac ?>
</td>
<td >
<strong>Número Consultores Internacionales: </strong><?php echo $adjudicacion->nconsulinter ?>
</td>

<td colspan="4">
<?php echo CHtml::Button('Ver información de respaldo',array('onclick' => '$("#procalificacion").dialog("open"); return false;',));?>
</td>
</tr>
</table>
<!--***********************************************************************CONTRATACION**********************************************************************************-->
<table class="detail-view">
<tr>
<td colspan="4">
<u><h3><center>Contratación </center></h3></u>
</td>
</tr>
<tr class="odd">
<td>
<strong>Número de Contrato: </strong><br /><?php echo $contratacion->ncontrato ?>
</td>
<td>
<strong>Título del Contrato: </strong><br /><?php echo $contratacion->titulocontrato ?>
</td>
<td colspan="2">
<strong>Status del contrato: </strong><?php echo $contrato->estatuscontrato ?>
</td>
</tr>
<tr class="even">
<td>
<strong>Alcance: </strong><?php echo $contratacion->alcances ?>
</td>
<td>
<strong>Fecha Inicio: </strong><br/><?php echo $contratacion->fechainicio ?>
</td>
<td>
<strong>Fecha Final: </strong><br/><?php echo $contratacion->fechafinal ?>
</td>
<td>
<strong>Duración: </strong><br/><?php echo $contratacion->duracioncontrato ?>
</td>
<tr class="odd">
<td >
<strong>Entidad: </strong>
<?php 
      $resp = Entes::Model()->find("idente ='".$contratacion->idEntidad."'");
      
      echo "$resp->descripcion<br>"; ?>

</td>
<td >
<strong>Oferente: </strong>
<?php 
      $resp = Oferente::Model()->find("idoferentes ='".$contratacion->idoferente."'");
      
      echo "$resp->nombre_oferente<br>"; ?>
</td>
<td>
<strong>Precio: </strong><br/><?php echo number_format($contratacion->precio,2,'.',',') ?>
</td>
<td >
<?php echo CHtml::Button('Ver información de respaldo',array('onclick' => '$("#procalificacion").dialog("open"); return false;',));?>
</td>

</tr>

</table >
<!--*******************************************************************GESTION CONTRATOS************************************************************-->

<table class="detail-view">
<tr>
<td colspan="4">
<u><h3><center>Gestión de Contratos </center></h3></u>
</td>
</tr>
<tr class="odd">
<td>
<strong>Número Contratación: </strong><?php echo $contrato->idContratacion ?>
</td>
<td>
<strong>Modificaciones Aprobadas: </strong><?php echo $contrato->nmodifica ?>
</td>
<td colspan="2">
<strong>Justificacion Modificación: </strong><?php echo $contrato->justimodcontrato ?>
</td>
</tr>
<tr class="even">
<td>
</td>
<td colspan="2">
<strong>Detalle de Modificación de Contratos </strong>
				<?php $filtro_grid =$contrato->idContratos;
				     if($filtro_grid==''){$filtro_grid='0';}			
				;?>
	<?php
				$dataProvider=new CActiveDataProvider('Contratos',array(
									'criteria'=>array(
									    'condition'=>'idContratos='.$filtro_grid,
									    'order'=>'idContratos ASC',									    
									),
									'countCriteria'=>array(
									    'condition'=>'idContratos='.$filtro_grid,
									    // 'order' and 'with' clauses have no meaning for the count query
									),
									'pagination'=>array(
									    'pageSize'=>20,
									),));

				
				$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'contratos-grid',
					'dataProvider'=>$dataProvider,
					'columns'=>array(
						'idContratacion',
						'nmodifica',
						'fecha',
						'tipomodifica',
						'justimodcontrato',
						'alcanceactucontrato',
						'estado',
					),
				)); ?>

</td>
<td>
</td>
</tr>
<tr class="odd">
<td colspan="4">
<strong>Fechas de las modificaciones o cambios aprobados: </strong><?php echo $contrato->fecha ?>
</td>
</tr>
<tr class="even">
<td>
<strong>Número de Desembolsos Realizados: </strong><?php echo $desembolsos->desembolso ?>
</td>
<td>
<strong>Monto de los desembolsos: </strong><br/><?php echo number_format($desembolsos->monto,2,'.',',') ?>
</td>
<td>
<strong>Precio Actualizado del Contrato:</strong> <?php echo number_format($contrato->precioactual,2,'.',',') ?>
</td>
<td>
<strong>Fecha Actualizada de Terminación del Contrato:</strong> <?php echo $contrato->fechatercontra ?>
</td>
</tr>
<tr class="odd">
<td>
</td>

<td  colspan="2">
<strong>Detalle de Desembolsos Efectuados: </strong>
				<?php $filtro_grid =$avances->codigo;
				     if($filtro_grid==''){$filtro_grid='0';}			
				;?>
	<?php
				$dataProvider=new CActiveDataProvider('DesembolsosMontos',array(
									'criteria'=>array(
									    'condition'=>'cod_contrato='.$filtro_grid,
									    'order'=>'cod_contrato ASC',									    
									),
									'countCriteria'=>array(
									    'condition'=>'cod_contrato='.$filtro_grid,
									    // 'order' and 'with' clauses have no meaning for the count query
									),
									'pagination'=>array(
									    'pageSize'=>20,
									),));

				
				$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'desembolsosm-grid',
					'dataProvider'=>$dataProvider,
					'columns'=>array(
						'cod_contrato',
						'desembolso',
						'monto',
						'descripcion',
						'fecha_desembolso',
						'fecha_registro',
						),
				)); ?>


</td>
<td>
</td>

</tr>

<tr class="even">
<td>
<strong>Fecha de Vencimiento:</strong> <br /><?php echo $contrato->fechatercontra ?>
</td>
<td>
<strong>Detalles de re adjudicación al contratista:</strong> <br /> <?php echo $contrato->detallesreadju ?>
</td>


<td colspan="2">
<?php echo CHtml::Button('Ver información de respaldo',array('onclick' => '$("#gestcontrato").dialog("open"); return false;',));?>
</td>
</tr>
</table>
<table class="detail-view">
<tr>
<td colspan="4">
<u><h3><center>Avances en ejecución de Proyectos </center></h3></u>
</td>
</tr>
<tr class="odd"> 
<td>
<strong>Código:</strong> <?php echo $calificacion->idCalificacion ?>
</td>
<td colspan="3">
<strong>Nombre de la Calificación:</strong> <?php echo $proyecto->nombre_proyecto ?>
</td>
<td colspan="3">
<strong>Responsable de la Calificación:</strong> <br/>
<?php echo $responsable->nombre ?>
</td>
</tr>
<tr class="even">
<td colspan="3">
<strong>Ejecutor de la Calificación:</strong> <?php echo $ejecutor->Nombres ?>
</td>
<td >
<strong>Supervisor de la Calificación:</strong> <?php echo $supervisor->Nombres ?>
</td>
</tr>
<tr class="odd">
<td colspan="5">
<strong>Ultima Actualización:</strong> <?php echo $contrato->fecha ?>
</td>
</tr>
<tr>
<td>
</td>
<td colspan="3">
<strong>Detalle de Avances </strong>
				<?php $filtro_grid =$contrato->idContratacion;
				     if($filtro_grid==''){$filtro_grid='0';}			
				;?> 
	<?php
				$dataProvider=new CActiveDataProvider('Avances',array(
									'criteria'=>array(
									    'condition'=>'codigo_inicio_ejecucion='.$filtro_grid,
									    'order'=>'codigo ASC',									    
									),
									'countCriteria'=>array(
									    'condition'=>'codigo_inicio_ejecucion='.$filtro_grid,
									    // 'order' and 'with' clauses have no meaning for the count query
									),
									'pagination'=>array(
									    'pageSize'=>20,
									),));

				$docsGrid='$("#gestcontrato").dialog("open"); return false;';
				$imgGrid='$("#proImagenes").dialog("open"); return false;';
				$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'avances-grid',
					'dataProvider'=>$dataProvider,
					'columns'=>array(
						'codigo',
						'codigo_inicio_ejecucion',
						'porcent_programado',
						'porcent_real',
						'finan_programado',
						'finan_real',
									array(
								'header'=>'Documentación',
								'type'=>'raw',
								'value'=>"CHtml::Button('Ver información de respaldo',array('onclick' => '".$docsGrid."',));",
								),   
						 array(
								'header' => 'Imagenes',
								'type'=>'raw',
								//'value' => "CHtml::link(CHtml::Button('Galeria de Fotos'), array('galeriafotos', 'idcon'=>'0000000089'));",
								//'value' => "CHtml::link(CHtml::Button('Galeria de Fotos'), array('galeriafotos', 'idcon'=>'".$galer."'));"
								//'value'=>"CHtml::Button('Ver Galería',array('onclick' => '".$imgGrid."',));",
								'value' => "CHtml::link(CHtml::Button('Galeria de Fotos'), array('galeriafotos', 'idcon'=>'$contratacion->idContratacion'));",
								//'value'=>"CHtml::Button('Galeria de Fotos',array('onclick' => '".$imgGrid."',));",
								)		

					),
				)); ?>
</td>
<td>
</td>
</tr>
<tr class="odd">
<td colspan="2">
<strong>Problemas presentados en el período:</strong> <br />
<?php echo $avance->desc_problemas ?>
</td>
<td colspan="2">
<strong>Temas pendientes:</strong> <br />
<?php echo $avance->desc_temas ?>
</td><!--
<td>
<?php
  echo "Programa #: ".$programa->idPrograma."<br />";
  echo "Proyecto #: ".$proyecto->idProyecto."<br />";
  echo "Calificacion #: ".$calificacion->idCalificacion."<br />";
  echo "Adjudicacion #: ".$adjudicacion->idAdjudicacion."<br />";
  echo "contratacion #: ".$contratacion->idContratacion."<br />";
  echo "Contrato #: ".$contrato->idContratos."<br />";
  echo "Implementacion #: ".$inieje->codigo."<br />";
  echo "Avance #: ".$avance->codigo."<br />";
?>
</td>-->
<td colspan="2">
<?php echo CHtml::Button('Ver información de respaldo',array('onclick' => '$("#avcali").dialog("open"); return false;',));?>
</td>
</tr>
</table>

<table >
<tr>
<?php
$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options'=>"{
        'title': {
            'text': 'Linea de Tiempo',
            'x': -20 //center
        },
        'xAxis':{
            'categories':['Creado <br />$proyecto->fechacreacion', 'Aprobado <br />$proyecto->fechaaprob', 'Actualizado <br />$calificacion->fechactualizacion', 'Ingresado <br />$calificacion->fechaingreso', 'Inicio Contrato <br />$contratacion->fechainicio', 'Final Contrato <br />$contratacion->fechafinal',
            'Implementación $inieje->fecha_inicio']
        },
        'yAxis':{
            'title':{
                'text': 'Linea de Tiempo',
            },
        },
        'series': [{
            'name': 'Programa',
            'data': [1,1,1,1,1,1,1]
            }]
            }"
));
?>
</tr>
</table>
<!--<table>
	<tr>
		<h3 align="center">Galería de fotos</h3>
	</tr>
  <tr>-->
	<?php    /*
  $images=ImgAdjuntadas::model()->findAll("cod_contrato ='".$contratacion->idContratacion."'");
  //$images=ImgAdjuntadas::model()->findAll("cod_contrato ='0000000089'");   
	$a=1;
	if($images!=null)
	{
		foreach ($images as $img) 
    {
			$ubic=substr($img->ubicacion_img,44);
			if($a==3)
			{
				$a=0;
				?>
        <!--<img src="<?//php echo Yii::app()->request->baseUrl.'/images/profile.jpg'?>" width="94" height="92" />-->
        <td height="300" width="300">
		
        <img src="<?php echo $ubic ?>"  />
		</td>
        </tr>
        <tr>
        <?php //echo "<br/>";
			}
			else
			{
        //echo CHtml::image("protected/img_subidas/".$img->nombre_img,50);?>
        <td height="300" width="300">
         <img src=" <?php echo $ubic ?> "  />
		<!-- <?php //echo "<script language='JavaScript'>alert('".$ubic."');</script>"; ?>-->
        </td>
        <?php
				$a++;
			}
			
		}?>
     </tr>
  <tr>
  <td colspan="3">
  <?php echo CHtml::link(CHtml::Button('Galeria de Fotos'), array('galeriafotos', 'idcon'=>$contratacion->idContratacion));?>
  </td>
  </tr>
  <?php
	}
	else{
		echo "No hay imágenes";
  }
  
  
  */
	?>
 
</table>
<div class="row" align="center">
<h3 align="center">Ubicación</h3>
        <?php
        if($inieje->geo_longitud!= null || $inieje->geo_latitud!= null){
          Yii::import('ext.jquery-gmap.*');
                    // create a map centered in the middle of the world ...
                    //$s=new Address();
                    // init the map
                    $gmap = new EGmap3Widget();
                    $gmap->setOptions(array('zoom' => 14)); 
                    // create the marker
                    $marker = new EGmap3Marker(array(
                        'title' => 'Ubicación',
                        'draggable' => false,
                        'icon' => 'http://google-maps-icons.googlecode.com/files/dolphins.png',
                    ));
                    $marker->address = $inieje->geo_latitud.','.$inieje->geo_longitud;
                    //$marker->latLng(array('latitude'=>$model->latitude,'longitude'=>$model->longitude));
                    $marker->capturePosition(   
                         // the model object
                         $inieje,
                         // model's latitude property name
                         'geo_latitud',
                         // model's longitude property name
                         'geo_longitud',
                         // Options set :
                         //   show the fields, defaults to hidden fields
                         //   update the fields during the marker drag event
                         array('hidden','drag')
                    );
                    $marker->latLng = array($inieje->geo_latitud,$inieje->geo_longitud);
                    
                    $marker->data = 'Datos del Punto1 !';
                    $js = "function(marker, event, data){
                            var map = $(this).gmap3('get'),
                            infowindow = $(this).gmap3({action:'get', name:'infowindow'});
                            if (infowindow){
                                infowindow.open(map, marker);
                                infowindow.setContent(data);
                            } else {
                                $(this).gmap3({action:'addinfowindow', anchor:marker, options:{content: data}});
                            }
                    }";
                    $marker->addEvent('click', $js);
                    $marker->centerOnMap();
                    // set the marker to relay its position information a model
        
                   
$gmap->add($marker);
//$gmap->add($marker2);

$gmap->renderMap();
        }
        else
          echo "No hay Datos";?>    
        </div>
<?php 
$model=Programa::model();
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'procalificacion',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Planificación de la Obra',
        'autoOpen'=>false,
        'width'=>900,
    ),
));

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		 array('label'=>'Invitación a los interesados',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($calificacion->invitainter), Yii::app()->baseUrl . '/images/'.$calificacion->invitainter)
                   ),
              array('label'=>'Bases de Precalificación',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($calificacion->basespreca), Yii::app()->baseUrl . '/images/'.$calificacion->basespreca)
                   ),
             array('label'=>'Resolución declarando la precalificación',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($calificacion->resolucion), Yii::app()->baseUrl . '/images/'.$calificacion->resolucion)
                   ),
             array('label'=>'Nombre y antecedentes de las empresas',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($calificacion->nombreante), Yii::app()->baseUrl . '/images/'.$calificacion->nombreante)
                   ),
            array('label'=>'Convocatoria o invitación a licitar',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($calificacion->convocainvi), Yii::app()->baseUrl . '/images/'.$calificacion->convocainvi)
                   ),
              array('label'=>'Pliego de Condiciones del Concurso',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($calificacion->tdr), Yii::app()->baseUrl . '/images/'.$calificacion->tdr)
                   ),
              array('label'=>'Aclaraciones  o Enmiendas al Pliego',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($calificacion->aclaraciones), Yii::app()->baseUrl . '/images/'.$calificacion->aclaraciones)
                   ),
              array('label'=>'Acta de recepción/ presentación de ofertas',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($calificacion->actarecpcion), Yii::app()->baseUrl . '/images/'.$calificacion->actarecpcion)
                   ),
             array('label'=>'Contrato y Condiciones',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($contratacion->documentocontra), Yii::app()->baseUrl . '/images/'.$ccontratacion->documentocontra)
                   ),				   
	),
));

$this->endWidget('zii.widgets.jui.CJuiDialog');







$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'proadquisicion',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Proceso de Adquisicion',
        'autoOpen'=>false,
        'width'=>900,
    ),
));

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		 array('label'=>'Documento de contrato y condiciones',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($contratacion->documentocontra), Yii::app()->baseUrl . '/images/'.$contratacion->documentocontra)
                   ),
              array('label'=>'Registro, antecedentes e información',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($contratacion->regante), Yii::app()->baseUrl . '/images/'.$contratacion->regante)
                   ),
             array('label'=>'Especificaciones y planos del proyecto',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($contratacion->espeplanos), Yii::app()->baseUrl . '/images/'.$contratacion->espeplanos)
                   ),
             array('label'=>'Otro',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($contratacion->otro), Yii::app()->baseUrl . '/images/'.$contratacion->otro)
                   ),
             array('label'=>'Programa inicial de trabajo presentado',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($contrato->prograini), Yii::app()->baseUrl . '/images/'.$contrato->prograini)
                   ),
              array('label'=>'Adendas a los contratos debidamente suscritas',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($contrato->adendas), Yii::app()->baseUrl . '/images/'.$contrato->adendas)
                   ),
             array('label'=>'Programa actualizado de trabajo',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($contrato->prograactu), Yii::app()->baseUrl . '/images/'.$contrato->prograactu)
                   ),
             array('label'=>'Otro',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($contrato->otro), Yii::app()->baseUrl . '/images/'.$contrato->otro)
                   ),
	),
));

$this->endWidget('zii.widgets.jui.CJuiDialog');

/*$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'proImagenes',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Fotografias',
        'autoOpen'=>false,
        'width'=>900,
    ),
));


//'value' => "CHtml::link(CHtml::Button('Galeria de Fotos'), array('galeriafotos', 'idcon'=>'$contratacion->idContratacion'));",

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
					 array('label'=>'Ver',
                   'type'=>'raw',
                   'value'=>ImageGallery::read($imgAdjuntadas->ubicacion_img,"simplest") ,
 ),                  
),
));

$this->endWidget('zii.widgets.jui.CJuiDialog');
*/


$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'gestcontrato',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Gestión de Contratos',
        'autoOpen'=>false,
        'width'=>900,
    ),
));


$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		 array('label'=>'Acta de apertura de las ofertas',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($adjudicacion->actaaper), Yii::app()->baseUrl . '/images/'.$adjudicacion->actaaper)
                   ),
              array('label'=>'Informe y acta de recomendacion',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($adjudicacion->informeacta), Yii::app()->baseUrl . '/images/'.$adjudicacion->informeacta)
                   ),
             array('label'=>'Resolucion de la adjudicacion',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($adjudicacion->resoladju), Yii::app()->baseUrl . '/images/'.$adjudicacion->resoladju)
                   ),
             array('label'=>'Otro',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($adjudicacion->otro), Yii::app()->baseUrl . '/images/'.$adjudicacion->otro)
                   ),
            array('label'=>'Programa Inicial de Trabajo',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($contratos->adendas), Yii::app()->baseUrl . '/images/'.$contratos->adendas)
                   ),

				   ),
));

$this->endWidget('zii.widgets.jui.CJuiDialog');





$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'avcali',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Avance de Calificación',
        'autoOpen'=>false,
        'width'=>900,
    ),
));

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		 array('label'=>$calificacion->getAttributeLabel('invitainter'),
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($calificacion->invitainter), Yii::app()->baseUrl . '/images/'.$calificacion->invitainter)
                   ),
              array('label'=>$calificacion->getAttributeLabel('basespreca'),
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($calificacion->basespreca), Yii::app()->baseUrl . '/images/'.$calificacion->basespreca)
                   ),
              array('label'=>$calificacion->getAttributeLabel('resolucion'),
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($calificacion->resolucion), Yii::app()->baseUrl . '/images/'.$calificacion->resolucion)
                   ),
              array('label'=>$calificacion->getAttributeLabel('nombreante'),
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($calificacion->nombreante), Yii::app()->baseUrl . '/images/'.$calificacion->nombreante)
                   ),
              array('label'=>$calificacion->getAttributeLabel('convocainvi'),
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($calificacion->convocainvi), Yii::app()->baseUrl . '/images/'.$calificacion->convocainvi)
                   ),
              array('label'=>$calificacion->getAttributeLabel('tdr'),
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($calificacion->tdr), Yii::app()->baseUrl . '/images/'.$calificacion->tdr)
                   ),
              array('label'=>$calificacion->getAttributeLabel('aclaraciones'),
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($calificacion->aclaraciones), Yii::app()->baseUrl . '/images/'.$calificacion->aclaraciones)
                   ),
              array('label'=>$calificacion->getAttributeLabel('actarecpcion'),
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($calificacion->actarecpcion), Yii::app()->baseUrl . '/images/'.$calificacion->actarecpcion)
                   ),
	),
));

$this->endWidget('zii.widgets.jui.CJuiDialog');
/*$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		//array('label'=>'Crear', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'), 'linkOptions'=>array()),
                //array('label'=>'Listar', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'),'active'=>true, 'linkOptions'=>array()),
		//array('label'=>'Search', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
		//array('label'=>'Exportar a PDF', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GeneratePdf'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
		array('label'=>'Exportar a Excel', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateExcel'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true)


	),
	));*/  
?>