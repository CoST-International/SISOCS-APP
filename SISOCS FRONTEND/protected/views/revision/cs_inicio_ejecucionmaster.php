<?php

// codigo
// idContratacion
// imagen
// cod_contacto_01
// cod_contacto_02
// cod_contacto_03
// tipo_garant_01
// tipo_garant_02
// tipo_garant_03
// monto_garant_01
// monto_garant_02
// monto_garant_03
// estado_garant_01
// estado_garant_02
// estado_garant_03
// fecha_venc_01
// fecha_venc_02
// fecha_venc_03
// geo_latitud
// geo_longitud
// geo_lati_final
// geo_long_final
// fecha_inicio
// estado_sol
// fecha_registro
// user_registro

?>
<?php if ($cs_inicio_ejecucion->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $cs_inicio_ejecucion->TableCaption() ?></h4> -->
<table id="tbl_cs_inicio_ejecucionmaster" class="table table-bordered table-striped ewViewTable">
	<tbody>
<?php if ($cs_inicio_ejecucion->codigo->Visible) { // codigo ?>
		<tr id="r_codigo">
			<td><?php echo $cs_inicio_ejecucion->codigo->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->codigo->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_codigo">
<span<?php echo $cs_inicio_ejecucion->codigo->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->codigo->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->idContratacion->Visible) { // idContratacion ?>
		<tr id="r_idContratacion">
			<td><?php echo $cs_inicio_ejecucion->idContratacion->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->idContratacion->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_idContratacion">
<span<?php echo $cs_inicio_ejecucion->idContratacion->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->idContratacion->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->imagen->Visible) { // imagen ?>
		<tr id="r_imagen">
			<td><?php echo $cs_inicio_ejecucion->imagen->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->imagen->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_imagen">
<span<?php echo $cs_inicio_ejecucion->imagen->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->imagen->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->cod_contacto_01->Visible) { // cod_contacto_01 ?>
		<tr id="r_cod_contacto_01">
			<td><?php echo $cs_inicio_ejecucion->cod_contacto_01->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->cod_contacto_01->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_cod_contacto_01">
<span<?php echo $cs_inicio_ejecucion->cod_contacto_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->cod_contacto_01->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->cod_contacto_02->Visible) { // cod_contacto_02 ?>
		<tr id="r_cod_contacto_02">
			<td><?php echo $cs_inicio_ejecucion->cod_contacto_02->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->cod_contacto_02->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_cod_contacto_02">
<span<?php echo $cs_inicio_ejecucion->cod_contacto_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->cod_contacto_02->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->cod_contacto_03->Visible) { // cod_contacto_03 ?>
		<tr id="r_cod_contacto_03">
			<td><?php echo $cs_inicio_ejecucion->cod_contacto_03->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->cod_contacto_03->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_cod_contacto_03">
<span<?php echo $cs_inicio_ejecucion->cod_contacto_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->cod_contacto_03->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->tipo_garant_01->Visible) { // tipo_garant_01 ?>
		<tr id="r_tipo_garant_01">
			<td><?php echo $cs_inicio_ejecucion->tipo_garant_01->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->tipo_garant_01->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_tipo_garant_01">
<span<?php echo $cs_inicio_ejecucion->tipo_garant_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->tipo_garant_01->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->tipo_garant_02->Visible) { // tipo_garant_02 ?>
		<tr id="r_tipo_garant_02">
			<td><?php echo $cs_inicio_ejecucion->tipo_garant_02->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->tipo_garant_02->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_tipo_garant_02">
<span<?php echo $cs_inicio_ejecucion->tipo_garant_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->tipo_garant_02->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->tipo_garant_03->Visible) { // tipo_garant_03 ?>
		<tr id="r_tipo_garant_03">
			<td><?php echo $cs_inicio_ejecucion->tipo_garant_03->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->tipo_garant_03->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_tipo_garant_03">
<span<?php echo $cs_inicio_ejecucion->tipo_garant_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->tipo_garant_03->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->monto_garant_01->Visible) { // monto_garant_01 ?>
		<tr id="r_monto_garant_01">
			<td><?php echo $cs_inicio_ejecucion->monto_garant_01->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->monto_garant_01->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_monto_garant_01">
<span<?php echo $cs_inicio_ejecucion->monto_garant_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->monto_garant_01->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->monto_garant_02->Visible) { // monto_garant_02 ?>
		<tr id="r_monto_garant_02">
			<td><?php echo $cs_inicio_ejecucion->monto_garant_02->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->monto_garant_02->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_monto_garant_02">
<span<?php echo $cs_inicio_ejecucion->monto_garant_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->monto_garant_02->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->monto_garant_03->Visible) { // monto_garant_03 ?>
		<tr id="r_monto_garant_03">
			<td><?php echo $cs_inicio_ejecucion->monto_garant_03->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->monto_garant_03->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_monto_garant_03">
<span<?php echo $cs_inicio_ejecucion->monto_garant_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->monto_garant_03->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->estado_garant_01->Visible) { // estado_garant_01 ?>
		<tr id="r_estado_garant_01">
			<td><?php echo $cs_inicio_ejecucion->estado_garant_01->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->estado_garant_01->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_estado_garant_01">
<span<?php echo $cs_inicio_ejecucion->estado_garant_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->estado_garant_01->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->estado_garant_02->Visible) { // estado_garant_02 ?>
		<tr id="r_estado_garant_02">
			<td><?php echo $cs_inicio_ejecucion->estado_garant_02->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->estado_garant_02->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_estado_garant_02">
<span<?php echo $cs_inicio_ejecucion->estado_garant_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->estado_garant_02->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->estado_garant_03->Visible) { // estado_garant_03 ?>
		<tr id="r_estado_garant_03">
			<td><?php echo $cs_inicio_ejecucion->estado_garant_03->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->estado_garant_03->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_estado_garant_03">
<span<?php echo $cs_inicio_ejecucion->estado_garant_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->estado_garant_03->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->fecha_venc_01->Visible) { // fecha_venc_01 ?>
		<tr id="r_fecha_venc_01">
			<td><?php echo $cs_inicio_ejecucion->fecha_venc_01->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->fecha_venc_01->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_fecha_venc_01">
<span<?php echo $cs_inicio_ejecucion->fecha_venc_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_venc_01->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->fecha_venc_02->Visible) { // fecha_venc_02 ?>
		<tr id="r_fecha_venc_02">
			<td><?php echo $cs_inicio_ejecucion->fecha_venc_02->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->fecha_venc_02->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_fecha_venc_02">
<span<?php echo $cs_inicio_ejecucion->fecha_venc_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_venc_02->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->fecha_venc_03->Visible) { // fecha_venc_03 ?>
		<tr id="r_fecha_venc_03">
			<td><?php echo $cs_inicio_ejecucion->fecha_venc_03->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->fecha_venc_03->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_fecha_venc_03">
<span<?php echo $cs_inicio_ejecucion->fecha_venc_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_venc_03->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->geo_latitud->Visible) { // geo_latitud ?>
		<tr id="r_geo_latitud">
			<td><?php echo $cs_inicio_ejecucion->geo_latitud->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->geo_latitud->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_geo_latitud">
<span<?php echo $cs_inicio_ejecucion->geo_latitud->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->geo_latitud->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->geo_longitud->Visible) { // geo_longitud ?>
		<tr id="r_geo_longitud">
			<td><?php echo $cs_inicio_ejecucion->geo_longitud->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->geo_longitud->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_geo_longitud">
<span<?php echo $cs_inicio_ejecucion->geo_longitud->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->geo_longitud->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->geo_lati_final->Visible) { // geo_lati_final ?>
		<tr id="r_geo_lati_final">
			<td><?php echo $cs_inicio_ejecucion->geo_lati_final->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->geo_lati_final->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_geo_lati_final">
<span<?php echo $cs_inicio_ejecucion->geo_lati_final->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->geo_lati_final->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->geo_long_final->Visible) { // geo_long_final ?>
		<tr id="r_geo_long_final">
			<td><?php echo $cs_inicio_ejecucion->geo_long_final->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->geo_long_final->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_geo_long_final">
<span<?php echo $cs_inicio_ejecucion->geo_long_final->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->geo_long_final->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->fecha_inicio->Visible) { // fecha_inicio ?>
		<tr id="r_fecha_inicio">
			<td><?php echo $cs_inicio_ejecucion->fecha_inicio->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->fecha_inicio->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_fecha_inicio">
<span<?php echo $cs_inicio_ejecucion->fecha_inicio->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_inicio->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->estado_sol->Visible) { // estado_sol ?>
		<tr id="r_estado_sol">
			<td><?php echo $cs_inicio_ejecucion->estado_sol->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->estado_sol->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_estado_sol">
<span<?php echo $cs_inicio_ejecucion->estado_sol->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->estado_sol->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->fecha_registro->Visible) { // fecha_registro ?>
		<tr id="r_fecha_registro">
			<td><?php echo $cs_inicio_ejecucion->fecha_registro->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->fecha_registro->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_fecha_registro">
<span<?php echo $cs_inicio_ejecucion->fecha_registro->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_registro->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->user_registro->Visible) { // user_registro ?>
		<tr id="r_user_registro">
			<td><?php echo $cs_inicio_ejecucion->user_registro->FldCaption() ?></td>
			<td<?php echo $cs_inicio_ejecucion->user_registro->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_user_registro">
<span<?php echo $cs_inicio_ejecucion->user_registro->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->user_registro->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
