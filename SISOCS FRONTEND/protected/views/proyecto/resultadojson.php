<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (count($datos)>0) {
    //foreach ($datos as $v) {
        echo json_encode($datos);
   // }
}  else {
  echo 'no hay datos';  
}
?>
