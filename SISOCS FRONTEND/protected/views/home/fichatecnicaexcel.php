<?php if ($model !== null):?>
<!--*************************************************DATOS PROGRAMA*************************************************************-->
<table class="detail-view">
<tr>
<td colspan="4">
<u><h3><center>Planificación del Programa</center></h3></u>
</td>
</tr>
<tr class="odd">
<td>
<strong>Código: </strong> <?php echo $proyecto->idPrograma ?>
</td>
<td colspan="2">
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

<td>
<strong>Propósito:</strong> <?php echo $proposito->proposito ?>
</td>
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
<td>
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
<td>
<?php echo CHtml::Button('Ver información de respaldo',array('onclick' => '$("#proadquisicion").dialog("open"); return false;',));?>
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

</tr>
</table>

<?php endif; ?>