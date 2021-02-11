<?php
$this->breadcrumbs=array(
    'Avances'=>array('index'),
    $model->codigo,
    );

$this->menu=array(
    array('label'=>'Crear Avances', 'url'=>array('admin')),
    );

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jqueryNumeric.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScript('test', "
    $(function(){

        $('#target').hide();
        $('#publicar').hide();
        $('.target').hide();
        if ($('#estado').val() == 'BORRADOR') {
            $('#del').show();
            $('#publicar').show();
        } else {
            $('#del').hide();
            $('#publicar').hide();
        }

        $('#btnMostrarOcultar').click(function(){
            if ($('#btnMostrarOcultar').val() == 'Mostrar Adjuntos')
            {
                $('#btnMostrarOcultar').val('Ocultar Adjuntos');
                $('#target').show();
                $('.target').show();
            }
            else
            {
                $('#btnMostrarOcultar').val('Mostrar Adjuntos');
                $('#target').hide();
                $('.target').hide();            
            }
        });

if ($('#getVal').val() > 0) {
    $('#store').hide();
    $('#cancel').hide();
    $('#add').show();
    $('#fisico_programado').prop('readonly', true);
    $('#fisico_real').prop('readonly', true);
    $('#financia_programado').prop('readonly', true);
    $('#financia_real').prop('readonly', true);
    $('#problemas').prop('readonly', true);
    $('#temas').prop('readonly', true);
} else {
    $('#publicar').hide();
    $('#del').hide();
    $('#store').hide();
    $('#cancel').hide();
    $('#add').hide();
    $('#fisico_programado').prop('readonly', true);
    $('#fisico_real').prop('readonly', true);
    $('#financia_programado').prop('readonly', true);
    $('#financia_real').prop('readonly', true);
    $('#problemas').prop('readonly', true);
    $('#temas').prop('readonly', true);
}

$('#store').click(function(){
    if($('#fisico_programado').val() != '' && $('#fisico_real').val() != '' && $('#financia_programado').val() != '' && $('#financia_real').val() != '' && $('#problemas').val() != '' && $('#temas').val() != ''){
        $('#variable').val('salv');
        this.form.submit();
    } else {
        alert('Todos los campos son requeridos.');
    }
});

$('#del').click(function(){
    if(confirm('¿Seguro que desea eliminar este avance?')){
        $('#variable').val('elim');
        this.form.submit();
    }
});

$('#publicar').click(function(){
    if(confirm('¿Seguro que desea publicar este avance?')){
        if(confirm('Publicar es irreversible ¿está seguro?')){
            $('#variable').val('publicar');
            this.form.submit();
        }
    }
});

$('#add').click(function(){
    $('#btnMostrarOcultar').hide();
    $('#upAvance').hide();
    $('#publicar').hide();
    $('#store').show();
    $('#cancel').show();
    $('#add').hide();
    $('#del').hide();
    $('#fisico_programado').numeric(',');
    $('#fisico_real').numeric(',');
    $('#financia_programado').numeric(',');
    $('#financia_real').numeric(',');
    $('#fisico_programado').val('');
    $('#fisico_real').val('');
    $('#financia_programado').val('');
    $('#financia_real').val('');
    $('#problemas').val('');
    $('#temas').val('');
    $('#impresion').val('');
    $('#fisico_programado').prop('readonly', false);
    $('#fisico_real').prop('readonly', false);
    $('#financia_programado').prop('readonly', false);
    $('#financia_real').prop('readonly', false);
    $('#problemas').prop('readonly', false);
    $('#temas').prop('readonly', false);
});
function FormEdicion()
{
    function mostrarEntrada(obj)
    {
        id = $($($($(obj).parent()).parent())).find('td').text();           
        $($(obj).parent()).html('<input name=mId type=hidden /><input id=a_vance name=a_vance type=text />');   
        $('input[name=a_vance]').focus();
        $('input[name=mId]').val(id);
        reEventos();
    }
    function ocultarEntrada(obj)
    {
        $($(obj).parent()).html('<a id=ifAdd>Agregar</a>');
        $(obj).remove();        
        eventos();
    }
    function eventos()
    {
        $('a#ifAdd').click(function(){ mostrarEntrada(this); });
    }
    function reEventos()
    {
        $('input[name=a_vance]').focusout(function() { ocultarEntrada(this); });        
        $('input[name=a_vance]').keydown(function(e){
            if (e.keyCode == 13)
            {
                respuesta = confirm('¿Guardar los datos?');
                if (respuesta)
                {
                    this.form.submit();
                }
            }           
            if (e.keyCode == 27)
            {
                ocultarEntrada(this);
            }
        });
}
eventos();
$('form#upAvance').bind('submit',function(){ return false; });
}
new FormEdicion();
});
");

class archivos {
    public $estimacion ="";
    public $llave = "";
    public $target_dir = "";
    public $archivo = "";
    public $extension = "";
    public $imagenes = "<tr><td style='width:30px;'>Número</td><td style='width:150px;'>Imágen</td></tr>";

    public function __construct($id){
        $this->estimacion = $id;
    }
    function generar(){
        for($i = 0; $i<12; $i++){
            $tipo = mt_rand(0,2);
            if($tipo > 2){
                $abc = mt_rand(0,26);
                $this->abecedario($abc);
            } else {
                $numero = mt_rand(0,9);
                $this->llave .= $numero;
            }
        }
    }
    function abecedario($dato){
        $array = array(
            1 => "a",2 => "b",3 => "c",4 => "d",5 => "e",6 => "f",7 => "g",8 => "h",9 => "i",10 => "j",
            11 => "k",12 => "l",13 => "m",14 => "n",15 => "o",16 => "p",17 => "q",18 => "r",19 => "s",20 => "t",
            21 => "u",22 => "v",23 => "w",24 => "x",25 => "y",26 => "z",);
        $this->llave .= $array[$dato]; 
    }
    public function misArchivos(){
        //$this->target_dir = "adjuntos/avances/".;
        echo "<script> alert('aqui'); </script>";
        $this->target_dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 8, $this->estimacion);
        echo "<script> alert('{$this->target_dir}'); </script>";
        for($i = 1; $i < 9; $i++){
            $tmp = "archivo".$i;
            if(isset($_FILES[$tmp]["name"])){
                if($this->verificar($i)){
                    $this->updateFileSQL($tmp,$i);
                } else {
                    $this->guardarFileSQL($tmp,$i);
                }
            }
        }
    }
    public function misImagenes(){
        //$this->target_dir = "images/avances/"; 
        $this->target_dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 8, $this->estimacion);
        if(isset($_FILES["imagen"]["name"])){
            $this->guardarPicSQL("imagen");
        }
    }
    public function verificar($numero){
        $con = Yii::app()->db;
        $data = $con->createCommand("SELECT * FROM `cs_archivos_avances` WHERE avance = ".$this->estimacion." AND numero = ".$numero.";")->query();
        if (!empty($data)){
            while (($linea = $data->read()) !== false){
                return true;
            }
            return false;
        } 
    }
    public function uploadFiles($archivo, $tipo){
        $this->llave = "";
        $this->generar();
        $this->extension = "";
        $this->extension = $_FILES[$archivo]["name"];
        $this->extension = explode('.',$this->extension,2);
        $nombre = $tipo." - ".$this->estimacion." - ".$this->llave.".".$this->extension[1];
        $this->archivo = $nombre;
        $_FILES[$archivo]["name"] = $nombre;
        $target_file = $this->target_dir . basename($_FILES[$archivo]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if($tipo == "Imagen"){
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES[$archivo]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "Este archivo no es una imágen.";
                    $uploadOk = 0;
                }
            }
        }
        if ($uploadOk == 0) {
            echo "No se pudo subir su archivo.";
        } else {
            move_uploaded_file($_FILES[$archivo]["tmp_name"], $target_file);
        } 
    }
    public function updateFileSQL($archivo,$numero){
        $this->uploadFiles($archivo,"Documento");
        $usuario = Yii::app()->user->id;
        $con = Yii::app()->db;  
        $row = $con->createCommand("UPDATE `cs_archivos_avances` SET archivo = '".$this->archivo."' 
            WHERE avance = ".$this->estimacion." AND numero = ".$numero.";")->query();
        return true;
    }
    public function guardarFileSQL($archivo,$numero){
        $this->uploadFiles($archivo,"Documento");
        if($this->extension[1] != ""){
            $usuario = Yii::app()->user->id;
            $con = Yii::app()->db;  
            $row = $con->createCommand("INSERT INTO cs_archivos_avances (avance, numero, archivo) 
                VALUES(".$this->estimacion.", ".$numero." ,'".$this->archivo."');")->query();
            return true;
        }
    }
    public function guardarPicSQL($archivo){
        $this->uploadFiles($archivo,"Imagen");
        $usuario = Yii::app()->user->id;
        $con = Yii::app()->db;  
        $row = $con->createCommand("INSERT INTO cs_imagenes_avances (avance, imagen) 
            VALUES(".$this->estimacion.", '".$this->archivo."');")->query();
        return true;
    }
    public function listarArchivos(){
        try
            {
                $con = Yii::app()->db;          
                $row = $con->createCommand("SELECT * FROM `cs_avances` where codigo = '$id';")->query();
                while (($linea = $row->read()) !== false){
                    
                }
            }
            catch(Exception $e) {  }  
    }
    public function listarimagenes(){
        try
            {
                $con = Yii::app()->db;          
                $row = $con->createCommand("SELECT * FROM `cs_imagenes_avances` WHERE avance = '".$estimacion."';")->query();
                $i = 0;
                while (($linea = $row->read()) !== false){
                    $i++;
                    $this->imagenes .= "<tr><td>".$i."</td><td><a href='images/avances/".$linea['imagen']."'>".$linea['imagen']."</a></td></tr>";
                }
            }
            catch(Exception $e) {  }  
    }
}

class estimacionAvance
{
    public $contrato = "";
    public $estimacion = "";
    public $fisico_programado = "";
    public $fisico_real = "";
    public $financiamiento_programado = "";
    public $financiamiento_real = "";
    public $problema = "";
    public $tema = "";
    public $estado = "";
    public $listaAvances = "<tr><td colspan=9>No se encontraron datos</td></tr>";
    public $listaMultimedia = "<tr><th></th><th>No hay datos</th></tr>";
    
    function __construct($avance)
    {
        $this->contrato = $avance;
    }
    public function comboEstimaciones($select =""){
        $items = "";

        try{
            $con = Yii::app()->db;
            if($this->contrato != 0){
                $data = $con->createCommand("SELECT * FROM `cs_avances` where idEjecucion = '".$this->contrato."';")->query();
                if (!empty($data)){
                    $unico = 1;
                    while (($linea = $data->read()) !== false){
                        if ($unico == 1) { 
                            $unico++; 
                            $this->estimacion = $linea["codigo"];
                        }
                        $items .= "<option value='".$linea["codigo"]."' ".$this->isSelect($linea["codigo"],$select)." >Estimacion - ".$linea["codigo"]."</option>"; 
                    }
                    if($unico == 1){
                        $items = "<option value=''>-- NO HAY DATOS --</option>";
                    }
                    return $this->drawCombo($items,"estimaciones");
                }
            }           
        }catch(Exception $e){
            echo "error: ".$e;
        }
        $items = "<option value=''>-- NO HAY DATOS --</option>";
        return $this->drawCombo($items,"estimaciones");
    }
    public function isSelect($id,$select)
    {
        if ($id == $select)
        {
            return "selected";
        }
        else
        {
            return "";
        }
    }
    public function drawCombo($items,$nombre)
    {
        return "<select name='$nombre' onchange='this.form.submit()'>$items</select>";
    }
    public function colocarEstimacion()
    {
        $id = $this->estimacion;
        if ($_POST['estimaciones'] != "")
        {
            $id = $_POST['estimaciones'];
        }
        if ($id != "")
        {
            try
            {
                $con = Yii::app()->db;          
                $row = $con->createCommand("SELECT * FROM `cs_avances` where codigo = '$id';")->queryRow();
                if (!empty($row))
                {
                    $this->estimacion = $row["codigo"];
                    $this->fisico_programado = $row["porcent_programado"];
                    $this->fisico_real = $row["porcent_real"];
                    $this->financiamiento_programado = $row["finan_programado"];
                    $this->financiamiento_real = $row["finan_real"];
                    $this->problema = $row["desc_problemas"];
                    $this->tema = $row["desc_temas"];
                    $this->estado = $row["estado"];
                    $this->listarAvances($row["estado"],$row["fecha_registro"],$row["codigo"]);
                }
            }
            catch(Exception $e) {  }    
        }
    }
    public function random($cantidad){
        for($i = 0; $i < $cantidad; $i++ ){
            $temporal .= mt_rand(0,9);
        }
        return $temporal;
    }
    public function nuevaEstimacion($fisico_programado,$fisico_real,$fina_programado,$financia_real,$problemas,$temas)
    {
        try
        {
            $usuario = Yii::app()->user->id;
            $random = $this->random(8);
            $con = Yii::app()->db;  
            $row1 = $con->createCommand("INSERT INTO cs_avances (idEjecucion, porcent_programado, porcent_real,finan_programado, finan_real, fecha_registro, estado,  user_registro, desc_problemas, desc_temas) 
                VALUES('".$this->contrato."','$fisico_programado','$fisico_real','$fina_programado','$fina_real',NOW(),'".$random."','".$usuario."','$problemas','$temas');")->query();
            $row2 = $con->createCommand("SELECT * FROM `cs_avances` WHERE estado = '".$random."';")->query();
            $linea1 = $row2->read();
            $row3 = $con->createCommand("UPDATE `cs_avances` SET estado='BORRADOR' WHERE estado='".$random."';")->query();
            $row4 = $con->createCommand("SELECT * FROM `cs_catg_sub_actividades` WHERE idEjecucion = '".$this->contrato."';")->query();
            while (($linea2 = $row4->read()) !== false){
                $row5 = $con->createCommand("INSERT INTO cs_actividades_avance (idAvance, idEstimacion, idEjecucion, avance, usuario) 
                    VALUES(".$linea2['id'].",".$linea1['codigo'].",".$this->contrato.",0, '".$usuario."') ")->query();
            }

            
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
    }
    public function eliminarEstimacion($id,$estado)
    {
        if($estado == "BORRADOR"){
            try
            {
                echo "<script>alert('hola')</script>";
                $con = Yii::app()->db;
                $row1 = $con->createCommand("SELECT * FROM `cs_actividades_avance` where idEstimacion = '$id';")->query();          
                while (($linea = $row1->read()) !== false){
                    $borrado = $con->createCommand("DELETE FROM `cs_actividades_avance` where id = ".$linea['id'].";")->query();
                }
                $row2 = $con->createCommand("DELETE FROM `cs_avances` where codigo = '$id';")->query();
                return true;
            }
            catch(Exception $e)
            {
                return false;
            }
        }
        
    }
    public function publicar($id)
    {
        try
        {
            $con = Yii::app()->db;          
            $row = $con->createCommand("UPDATE `cs_avances` SET estado = 'PUBLICADO' where codigo = '$id';")->query();
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
        
        
    }
    public function listarAvances($editable,$fecha,$codigo){
        $fecha = substr($fecha,0,10);
        $id = $this->contrato;
        $salida = ""; 
        try { 
            $con = Yii::app()->db;          
            $data2 = $con->createCommand("SELECT * FROM `cs_actividades_avance` where idEstimacion = '$this->estimacion';")->query();
            if (!empty($data2)){
                $i = 0;
                while (($linea2 = $data2->read()) !== false){
                    $data1 = $con->createCommand("SELECT * FROM `cs_catg_sub_actividades` where id = '".$linea2['idAvance']."';")->query();
                    $linea1 = $data1->read();
                    $calculo = $this->avancesCalculos($linea1["id"],$linea2["id"],$codigo);
                    $diferencia = 100 - $calculo;           
                    $agregar = "-";
                    if ($editable == "BORRADOR"){
                        $agregar = "<a id='ifAdd'>Agregar</a>";
                    }
                    $salida .= "<tr><td>{$linea2["id"]}-</td><td>{$linea1["descripcion"]}</td><td>{$linea1["precio"]}</td><td>$calculo</td><td>$agregar</td><td>{$linea2["avance"]}</td><td>$diferencia</td></tr>";
                    $i++;
                }
                $this->listaAvances = $salida;
            } else {
                $salida = "<tr><td colspan=9>No se encontraron datos</td></tr>";
            }
        }
        catch(Exception $e){
            $salida = "<tr><td colspan=9>No se encontraron datos</td></tr>";
        }
    }
    public function avancesCalculos($idAvance,$fecha,$idEstimacion)
    {
        try
        {
            $tmp = 0;
            $cc = Yii::app()->db;
            $row1 = $cc->createCommand("SELECT * FROM `cs_actividades_avance` where idAvance = '$idAvance' and id < '$fecha';")->query();
            $row2 = $cc->createCommand("SELECT * FROM `cs_actividades_avance` where idEstimacion = '$idEstimacion' and idAvance = '$idAvance';")->query();
            $linea2 = $row2->read();
            while (($linea1 = $row1->read()) !== false){
                $tmp += $linea1['avance'];
            }
            $tmp += $linea2['avance'];
            return $tmp;
        }
        catch(Exception $e)
        {
            return $e;
        }
    }
    public function updateActividad($id,$avance)
    {
        try{
            $tmp = 0;
            $con = Yii::app()->db;
            $row1 = $con->createCommand("SELECT * FROM `cs_actividades_avance` where id = '$id';")->query();
            $linea1 = $row1->read();
            $row2 = $con->createCommand("SELECT * FROM `cs_actividades_avance` where idAvance = '".$linea1['idAvance']."';")->query();
            while (($linea2 = $row2->read()) !== false){
                $tmp += $linea1['avance'];
            }
            if(($tmp+$avance)<101){
                $row = $con->createCommand("UPDATE `cs_actividades_avance` SET avance='".$avance."' WHERE id='".$id."';")->query();
            } else {
                echo "<script>alert('Sobrepasó por ".(($tmp+$avance)-100)." al 100% de su avance.')</script>";
            }
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }   
}

$numEstim = "".$_POST['estimaciones'];
if($numEstim == ""){
    $numEstim = 0;
}
$elid = "".$_GET["id"];
if($elid == ""){
    $elid = 0;
}
$estimacion = new estimacionAvance($elid);
$multimedia = new archivos($_POST['upEstimacion']);
if($numEstim == 0){
    $numEstim = $estimacion->estimacion;
}
if ($_POST['variable'] == "salv"){
    $estimacion->nuevaEstimacion($_POST["fisico_programado"],$_POST["fisico_real"],$_POST["financia_programado"],$_POST["financia_real"],$_POST["problemas"],$_POST["temas"]);
}
if ($_POST["variable"] == "elim"){
    $estimacion->eliminarEstimacion($numEstim,$_POST['estado']);
}
if ($_POST["variable"] == "publicar"){
    $estimacion->publicar($numEstim);
}
if ($_POST["mId"] != ""){
    $jUpdate = explode('-',$_POST['mId'],2);
    $estimacion->updateActividad($jUpdate[0],$_POST['a_vance']);
}
if ($_POST["upPic"] == "upPic"){
    $multimedia->misImagenes();
}
if ($_POST["myFiles"] == "myFiles"){
    $multimedia->misArchivos();
}
?>
<div style="width:900px;">
    <h1>Agregar avances de ejecución</h1>

    <div style="width:900px;float:left;">
        <!--Formulario estimaciones!--> 
        <form method="POST" <?php echo "action='index.php?r=avances/admin&id=".$_GET["id"]."'"; ?> > 
            <label for="">Historial de avances</label>
            <div style="width:900px;float:left;">
                <?php echo $estimacion->comboEstimaciones($numEstim); $estimacion->colocarEstimacion(); ?>
                <br>
            </div>
            <div style="width:100%">
                <div class="btn-group">
                    <input type="button" id="add" value="Agregar nueva" >
                    <input type="button" id="del" value="Eliminar" >
                    <input type="button" id="store" value="Guardar" >
                    <input type="button" id="cancel" onClick="window.location.reload();" value="Cancelar">
                    <input type="button" id="publicar" value="Publicar" >
                    <input type="hidden" name="variable" id="variable" value="0">
                    <input type="hidden" name="getVal" id="getVal" <?php echo "value='".$elid."'"; ?>>
                    <input type="hidden" name="estado" id="estado" <?php echo "value='".$estimacion->estado."'"; ?>>
                </div>
                <div style="width:100%; height:10px; "></div>
            </div>
            <div style="width:30%; float:left;">
                <div class="form-group">
                    <label for="exampleInputEmail1">Fisico Programado</label>
                    <input style="width:95%;" type="text" class="form-control" name="fisico_programado"  id="fisico_programado" <?php echo "value='".$estimacion->fisico_programado."'"; ?> placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Fisico Real</label>
                    <input style="width:95%;" type="text" class="form-control" name="fisico_real" id="fisico_real" <?php echo "value='".$estimacion->fisico_real."'"; ?> placeholder="" >
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Financiero Programado</label>
                    <input style="width:95%;" type="text" class="form-control"  name="financia_programado" id="financia_programado" <?php echo "value='".$estimacion->financiamiento_programado."'"; ?> placeholder="" >
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Financiero Real</label>
                    <input  style="width:95%;" type="text" class="form-control" name="financia_real" id="financia_real" <?php echo "value='".$estimacion->financiamiento_programado."'"; ?> placeholder="" >
                </div>
            </div>
            <div style="width:30%; float:left;">
                <div class="form-group">
                    <label for="exampleInputPassword1" >Descripcion de Problemas</label>
                    <textarea name="problemas" id="problemas" style="width:95%; min-height:20px;" ><?php echo $estimacion->problema; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" >Descripcion de Temas</label>
                    <textarea name="temas" id="temas" style="width:95%; min-height:20px;" ><?php echo $estimacion->tema; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Estado</label>
                    <input  style="width:95%;" id="impresion" type="text" class="form-control"  <?php echo "value='".$estimacion->estado."'"; ?> placeholder="" disabled>
                </div>
            </div>
        </form>
    </div>
    

    <div style="width:900px;float:left;">
        <div class="row"></div>
        <div class="row">
            <h3>Subir imágenes</h3>
        </div>
        <form method="POST" <?php echo "action='index.php?r=avances/admin&id=".$_GET["id"]."'"; ?> enctype="multipart/form-data">  
            <table>
                <tr style="width:400px">
                    <td style="width:40%"><input type="file" name="imagen" id="imagen"></td>
                    <td style="width:20%"><input type="submit" style="margin:0; margin-rigth:10px;" value="Subir Imágenes" name="submit"></td>
                    <td style="width:20%"><button type="button" class="" data-toggle="modal" data-target=".bs-example-modal-lg">Ver Galería</button></td>
                </tr>
            </table>
            
            <input type="hidden" value="upPic" name="upPic" id="upPic">
            <input type="hidden" <?php echo 'value="'.$estimacion->estimacion.'"';?> name="upEstimacion" id="upEstimacion">
            
            <!-- Large modal -->


<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div style="float:left; width:700px; min-height:400px;">
            <table>
                <?php
                    $multimedia->listarimagenes();
                    echo $multimedia->imagenes;
                ?>
            </table>
        </div>
    </div>
  </div>
</div>
        </form>
        <div class="row"></div>
        <div class="row"><h3>Subir Archivos</h3></div>
        <div class="row">
            <form method="POST" <?php echo "action='index.php?r=avances/admin&id=".$_GET["id"]."'"; ?> enctype="multipart/form-data">  
            <div class="row">
            <label>Documento de garantía que puede ser I) Fianza o Garantía bancaria, emitida por una institución financiera autorizada; II) Bonos del Estado y; III) Cheques Certificados.</label>             
            <input type="file" name="archivo1" id="archivo1">
            <a href="" >Descargar</a>
            </div>
            <div class="row">
            <label>Informes de avance de implementación que presentan los contratistas</label>
            <input type="file" name="archivo2" id="archivo2">
            <a href="" >Descargar</a>
            </div>
            <div class="row">
            <label>Informes de supervisión de la construcción</label>
            <input type="file" name="archivo3" id="archivo3">
            <a href="" >Descargar</a>
            </div>
            <div class="row">
            <label>Informes de evaluación de proyecto (continuos y al finalizar)</label>
            <input type="file" name="archivo4" id="archivo4">
            <a href="" >Descargar</a>
            </div>
            <div class="row">
            <label>Informes de auditoría técnica</label>
            <input type="file" name="archivo5" id="archivo5">
            <a href="" >Descargar</a>
            </div>
            <div class="row">
            <label>Informes de auditoría financiera</label>
            <input type="file" name="archivo6" id="archivo6">
            <a href="" >Descargar</a>
            </div>
            <div class="row">
            <label>Acta de recepción definitiva</label>
            <input type="file" name="archivo7" id="archivo7">
            <a href="" >Descargar</a>
            </div>
            <div class="row">
            <label>Informe de disconformidad, cuando corresponda</label>
            <input type="file" name="archivo8" id="archivo8">
            <a href="" >Descargar</a>
            </div>
            
            
            <input type="hidden" value="myFiles" name="myFiles" id="myFiles">
            <input type="hidden" <?php echo 'value="'.$estimacion->estimacion.'"';?> name="upEstimacion" id="upEstimacion">
            <input type="submit" value="Subir Documentos" name="submit">
        </form>

        </div>

