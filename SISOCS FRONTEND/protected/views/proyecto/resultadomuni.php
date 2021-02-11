<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (count($datos)>0) {
   // var_dump($datos);
    foreach($datos as $value=>$municipio)
      {echo CHtml::tag('option', array('value'=>$value),CHtml::encode($municipio),true);}
       
}  else {
  echo 'no hay datos';  
}
?>
