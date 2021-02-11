<?php
/* @var $this CiudadanoController */

$this->breadcrumbs=array(
    'Informe de Cumplimiento de Registro de la Información',
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
                ->select('sum(precioLPS)')
                ->from('cs_contratacion')
                ->queryScalar();?>
Montos Contratados: <br /> <input type="text" name="moncon" size="40" value="LPS. <?php echo number_format($sum,2,'.',',');?>" readonly="true">
</td>
</tr>
</table>
<form name="form1" method="POST">
<table border="4" width="1000" cellspacing="5" cellpadding="7">
<tr >
<h3>Cumplimiento a la Fecha</h3>
</tr>
<tr>
<td  rowspan="2"><strong>Descripción</strong>
</td>
<td colspan="4" align="center" ><strong>Numero de Procesos por Duración</strong>
</td>
</tr>
<tr>

<td  align="center"><strong>Menos 2 dias</strong>
</td>
<td align="center"><strong>Entre 2 y 5 dias</strong>
</td>
<td align="center"><strong>Entre 5 y 10 dias</strong>
</td>
<td align="center"><strong>Mas de 10 dias</strong>
</td>
</tr>
<?php 
	$row=2;
	$fin=7;
	$tot1=0;
	$tot2=0;
	$tot3=0;
	$tot4=0;
	while ($row<=$fin)
		{
			if ($row==1)
				{
					$desc='Planificación del Programa';
					$col1=count(Programa::Model()->findAll("(fecharecibido-fechacreacion) <= 2"));
					$col2=count(Programa::Model()->findAll("(fecharecibido-fechacreacion) > 2 and (fecharecibido-fechacreacion) <= 5"));
					$col3=count(Programa::Model()->findAll("(fecharecibido-fechacreacion) > 5 and (fecharecibido-fechacreacion) <= 10"));
					$col4=count(Programa::Model()->findAll("(fecharecibido-fechacreacion) > 10"));
					$tot1=$tot1+$col1;
					$tot2=$tot2+$col2;
					$tot3=$tot3+$col3;
					$tot4=$tot4+$col4;
				}
			if ($row==2)
				{
					$desc='Planificación del Proyecto';
					$col1=count(Proyecto::Model()->findAll("(fecharecibido-fechacreacion) <= 2"));
					$col2=count(Proyecto::Model()->findAll("(fecharecibido-fechacreacion) > 2 and (fecharecibido-fechacreacion) <= 5"));
					$col3=count(Proyecto::Model()->findAll("(fecharecibido-fechacreacion) > 5 and (fecharecibido-fechacreacion) <= 10"));
					$col4=count(Proyecto::Model()->findAll("(fecharecibido-fechacreacion) > 10"));
					$tot1=$tot1+$col1;
					$tot2=$tot2+$col2;
					$tot3=$tot3+$col3;
					$tot4=$tot4+$col4;
				}
			if ($row==3)
				{
					$desc='Invitación y Calificación';
					$col1=count(Calificacion::Model()->findAll("(fecharecibido-fechaingreso) <= 2"));
					$col2=count(Calificacion::Model()->findAll("(fecharecibido-fechaingreso) > 2 and (fecharecibido-fechaingreso) <= 5"));
					$col3=count(Calificacion::Model()->findAll("(fecharecibido-fechaingreso) > 5 and (fecharecibido-fechaingreso) <= 10"));
					$col4=count(Calificacion::Model()->findAll("(fecharecibido-fechaingreso) > 10"));
					$tot1=$tot1+$col1;
					$tot2=$tot2+$col2;
					$tot3=$tot3+$col3;
					$tot4=$tot4+$col4;
				}
			if ($row==4)
				{
					$desc='Evaluación de las Ofertas/Adjudicación';
					$col1=count(Adjudicacion::Model()->findAll("(fecharecibido-fechacreacion) <= 2"));
					$col2=count(Adjudicacion::Model()->findAll("(fecharecibido-fechacreacion) > 2 and (fecharecibido-fechacreacion) <= 5"));
					$col3=count(Adjudicacion::Model()->findAll("(fecharecibido-fechacreacion) > 5 and (fecharecibido-fechacreacion) <= 10"));
					$col4=count(Adjudicacion::Model()->findAll("(fecharecibido-fechacreacion) > 10"));
					$tot1=$tot1+$col1;
					$tot2=$tot2+$col2;
					$tot3=$tot3+$col3;
					$tot4=$tot4+$col4;
				}
			if ($row==5)
				{
					$desc='Contratación';
					$col1=count(Contratacion::Model()->findAll("(fecharecibido-fechacreacion) <= 2"));
					$col2=count(Contratacion::Model()->findAll("(fecharecibido-fechacreacion) > 2 and (fecharecibido-fechacreacion) <= 5"));
					$col3=count(Contratacion::Model()->findAll("(fecharecibido-fechacreacion) > 5 and (fecharecibido-fechacreacion) <= 10"));
					$col4=count(Contratacion::Model()->findAll("(fecharecibido-fechacreacion) > 10"));
					$tot1=$tot1+$col1;
					$tot2=$tot2+$col2;
					$tot3=$tot3+$col3;
					$tot4=$tot4+$col4;
				}
			if ($row==6)
				{
					$desc='Gestión de los Contratos';
					$col1=count(Contratos::Model()->findAll("(fecharecibido-fechacreacion) <= 2"));
					$col2=count(Contratos::Model()->findAll("(fecharecibido-fechacreacion) > 2 and (fecharecibido-fechacreacion) <= 5"));
					$col3=count(Contratos::Model()->findAll("(fecharecibido-fechacreacion) > 5 and (fecharecibido-fechacreacion) <= 10"));
					$col4=count(Contratos::Model()->findAll("(fecharecibido-fechacreacion) > 10"));
					$tot1=$tot1+$col1;
					$tot2=$tot2+$col2;
					$tot3=$tot3+$col3;
					$tot4=$tot4+$col4;
				}
			if ($row==7)
				{
					$desc='Avances en Ejecución de Proyectos';
					$col1=count(Avances::Model()->findAll("(fecha_registro-fecha_avance) <= 2"));
					$col2=count(Avances::Model()->findAll("(fecha_registro-fecha_avance) > 2 and (fecha_registro-fecha_avance) <= 5"));
					$col3=count(Avances::Model()->findAll("(fecha_registro-fecha_avance) > 5 and (fecha_registro-fecha_avance) <= 10"));
					$col4=count(Avances::Model()->findAll("(fecha_registro-fecha_avance) > 10"));
					$tot1=$tot1+$col1;
					$tot2=$tot2+$col2;
					$tot3=$tot3+$col3;
					$tot4=$tot4+$col4;
				}
			echo "<tr ><td ><strong>".$desc."</strong></td><td align='center'>".$col1."</td><td align='center'>".$col2."</td><td align='center'>".$col3."</td><td align='center'>".$col4."</td></tr>";
			$row++;		 
		}
			echo "<tr><td><strong>Totales</strong></td><td align='center'><strong>".$tot1."</strong></td><td align='center'><strong>".$tot2."</strong></td><td align='center'><strong>".$tot3."</strong></td><td align='center'><strong>".$tot4."</strong></td></tr>";
?>



<!--<th colspan="2">
<h3>Criterio de Búsqueda</h3>
</th>
<tr>
<td><strong>Rango de días</strong></td>
<td><strong>Tipo de registro</strong></td>
</tr>
<tr>
<td>
<input type="radio" name="criterio" value="1" /> 2 o menos <br/>
<input type="radio" name="criterio" value="2" /> más de 2 y menos de 5 <br/>
<input type="radio" name="criterio" value="3" /> más de 5 y menos de 10 <br/>
<input type="radio" name="criterio" value="4" /> más de 10 <br/>
</td>
<td>
	<select id="tipo" name="tipo" >
	<option value="programa">Programa</option>
  	<option value="proyecto">Proyecto</option>
  	<option value="calificacion">Calificación</option>
  	<option value="adjudicacion">Adjudicación</option>
  	<option value="contratacion">Contratación</option>
  	<option value="contrato">Contrato</option>
	</select>
</td>
</tr>-->
</table>
<?php /*echo CHtml::ajaxSubmitButton(
	'Buscar',
	array('Ciudadano/BCumplimiento'),
	array('update' =>'#listado')
	);*/
?> 
</form>
<div id='listado'></div>