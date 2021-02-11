<?php

/*
echo '<scrtipt> alert("'.$id.'"); </script>';

echo "<hr>$id<hr>";

echo '<b>'.Chtml::Label($model, 'puesto').'</b>';
echo Chtml::activeTextField($model, 'puesto', array('readonly'=>false));

echo '<b>'.Chtml::Label($model, 'telefono').'</b>';
echo Chtml::activeTextField($model, 'telefono', array('readonly'=>false));

echo '<b>'.Chtml::Label($model, 'correo').'</b>';
echo Chtml::activeTextField($model, 'correo', array('readonly'=>false));
*/


	echo ' <div class="row">';
	echo  '<form >'   ;           
	echo '<strong>Puesto</strong><br>' ;
	echo  '<input type="text" name="puesto"readonly="true" value="'.$model->puesto.'">';
	echo   '</br>';
	echo    '</br>';
	echo    '<strong>Telefono</strong></br>';
	echo    '<input type="text" name="telefono" readonly="true" value="'.$model->telefono.'">';
	echo    '</br>';
	echo    '</br>';
	echo    '<strong>Correo</strong></br>';
	echo    '<input type="text" name="correo"  readonly="true" value="'.$model->correo.'">';
	echo   '</form>';
	echo   '</div>';

?>