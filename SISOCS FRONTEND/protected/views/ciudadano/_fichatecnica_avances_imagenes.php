
<?php
   if(!empty($data)){

      $resultX=  Yii::app()->db->createCommand()
                                           ->select('*')
                                           ->from('v_imagenes_poravance')
                                           ->where('cod_avance=:id',array(':id'=>$data))										   
                                           ->queryAll();
    $row=0;
    $total_x=count($resultX);  
    
while ($row< $total_x){
    $arr_final[] = $resultX[$row]['nombre_img'];
   // $resultX[$row]['ubicacion_img'].",";
   // echo  rtrim($string,",");
    
$row++;}

$this->widget(
  'ext.SimpleFadeSlideShow.SimpleFadeSlideShow',
   array(
  'images' => $arr_final));

}



// print_r($string); 
//}

//echo print_r($resultX[0]['ubicacion_img']);

//       $this->widget(
//    'ext.SimpleFadeSlideShow.SimpleFadeSlideShow',
//    array(
//        'images' => array(Yii::app()->baseUrl.'/images/ciudadano_reportes/calle1.jpg',Yii::app()->baseUrl.'/images/ciudadano_reportes/calle2.jpg',
//            Yii::app()->baseUrl.'/images/ciudadano_reportes/calle3.jpg',Yii::app()->baseUrl.'/images/ciudadano_reportes/calle4.jpg')
//    )
//);
 ?>
                <!--</br>-->
	<!--?php  else  echo "Este avance no tiene imagenes disponibles.";  ? -->