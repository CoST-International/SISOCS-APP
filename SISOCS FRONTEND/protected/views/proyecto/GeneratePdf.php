<?php
$pdf = Yii::createComponent('application.extensions.MPDF56.mpdf');

$html='
<link rel="stylesheet" type="text/css" href="'.Yii::app()->request->baseUrl.'/css/pdf.css" />

<table id="yw0" class="detail-view2">
<tr class="principal">
<td colspan="2" align="center"><b>DATOS PROYECTO</b></td>
<tr>
<tr class="odd"><td> <b>N° Control</b> </td><td> '.$model->idProyecto.'</td></tr>
<tr class="even"><td> <b>Trimestre Ejecucion</b> </td><td> '.$model->codigo.'</td></tr>
<tr class="odd"><td> <b>Nombre Estado</b> </td><td> '.$model->nombre_proyecto.'</td></tr>
<tr class="even"><td> <b>Empresa</b> </td><td> '.$model->idProposito.'</td></tr>
<tr class="odd"><td> <b>Personal Actuante</b> </td><td> '.$model->descrip.'</td></tr>
<tr class="even"><td> <b>Nombre Tipo Informe</b> </td><td> '.$model->idSector.'</td></tr>
<tr class="even"><td> <b>N° Contrato</b> </td><td> '.$model->idSubSector.'</td></tr>
<tr class="odd"><td> <b>Monto Contratado</b> </td><td> '.$model->idEnte.'</td></tr>
<tr class="even"><td> <b>Monto Auditado</b> </td><td> '.$model->idUnidad.'</td></tr>
<tr class="odd"><td> <b>Porcentaje Ejecucion</b> </td><td> '.$model->idFuncionario.'</td></tr>
<tr class="even"><td> <b>Objeto Contrato</b> </td><td> '.$model->idRol.'</td></tr>
<tr class="odd"><td> <b>Observaciones</b> </td><td> '.$model->presupuesto.'</td></tr>
<tr class="even"><td> <b>Recomendaciones</b> </td><td> '.$model->fechaaprob.'</td></tr>
<tr class="odd"><td> <b>Monto Hallazgo</b> </td><td> '.$model->codsefin.'</td></tr>
<tr class="even"><td> <b>Origen Tramite</b> </td><td> '.$model->descambiental.'</td></tr>
</table>

';
$mpdf=new mPDF('win-1252','LETTER','','',15,15,25,12,5,7);
$mpdf->WriteHTML($html);
$mpdf->Output('Ficha-Proyecto-'.$model->codigo.'.pdf','D');
exit;
?>
