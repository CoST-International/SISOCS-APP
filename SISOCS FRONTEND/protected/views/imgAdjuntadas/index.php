<?php
/* @var $this ImgAdjuntadasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Img Adjuntadases',
);

$this->menu=array(
	array('label'=>'Crear ImgAdjuntadas', 'url'=>array('create')),
	array('label'=>'Gestionar ImgAdjuntadas', 'url'=>array('admin')),
);
?>

<h1>Img Adjuntadases</h1>

<?php 
Yii::import('ext.EWideImage.*');
	$criteria = new CDbCriteria();
	$criteria->compare('cod_avance', 92);
    $imagenes=ImgAdjuntadas::model()->findAll($criteria);
    $valo=0;
    foreach ($imagenes as $content ){
	if(file_exists(Yii::getPathOfAlias("webroot")."/".$content['nombre_img'])){		
		//echo Yii::app()->getBaseUrl(true);
		//echo $content['nombre_img'];
		//echo $content['nombre_img'];
		echo "</br>";
		$rutaDelaImg=Yii::getPathOfAlias("webroot")."/".$content['nombre_img'];
		$rutaDirectorio=dirname(Yii::getPathOfAlias("webroot")."/".$content['nombre_img']);
		$rutaNombreImg=basename(Yii::getPathOfAlias("webroot")."/".$content['nombre_img']);
		$rutaGuardarSmall=$rutaDirectorio."/small_".$rutaNombreImg;

		if(file_exists($rutaGuardarSmall)){
		
		}
		else{
		
		//echo '<img src="'.Yii::app()->getBaseUrl(true)."/".$content['nombre_img'].'"></>';
		//echo $content['nombre_img'];
		//EWideImage::load($rutaDelaImg)->resize(400, 300)->saveToFile($rutaGuardarSmall);
		}

	}

	  
	  }
	  
	  //ver el contenido del directorio 
      $rutaDirectorio=dirname(Yii::getPathOfAlias("webroot")."/".$content['nombre_img']);
	  $directorio = opendir($rutaDirectorio); //ruta actual
	  $rutaDirectorio=dirname($rutaDirectorio);
			while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
			{
				if (is_dir($archivo))//verificamos si es o no un directorio
				{
					echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
				}
				else
				{
					
					//$trozos = explode(".", $archivo); 
					//$extension = end($trozos);
					//validar la extencion del archivo 
					if($extension=='jpg'){
					//$rutaDirectorio."/".$archivo;
					//echo $rutaNombreImg=basename($rutaDirectorio);
					//$rutaDirectorio;
					//echo "</br>";
					echo $rutaDirectorio."/".$archivo;
					echo "</br>";
					 $rutaDirectorio."/small_".$archivo;
						for($i=0;$i<1;$i++){
						//EWideImage::load($rutaDirectorio."/".$archivo)->resize(400, 300)->saveToFile($rutaDirectorio."/small_".$archivo); 
						}
						//EWideImage::load($rutaDirectorio."/".$archivo)->resize(400, 300)->saveToFile($rutaDirectorio."/small_".$archivo);  
						//echo $archivo . "<br />";
					}
						
					
				}
			}
?>

<?php /* $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));  */?>
