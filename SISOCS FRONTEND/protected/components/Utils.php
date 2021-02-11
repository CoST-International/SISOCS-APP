<?php

class Utils extends CApplicationComponent {
 
    public function GetPathFor($base, $component, $id) {
     
        //      1 = Programas
        //      2 = Proyectos
        //      3 = Calificacion
        //      4 = Adjudicacion
        //      5 = Contratacion
        //      6 = Gestion de contratos
        //      7 = Implementacion
        //      8 = Avances
        $arr = array();
        $where = '';
        $i=1;
        $dir = $base;
        
        $connection=Yii::app()->db;
        $sql = 'Select '
            . '     idPrograma , '
            . '     idProyecto , '
            . '     idCalificacion , '
            . '     idAdjudicacion , '
            . '     idContratacion , '
            . '     idContratos , '
            . '     idEjecucion , '
            . '     idAvances '
            . ' From '
            . ' vIDPaths ' ;
        
        switch ($componet) {
            case 1:
                $where = " Where idPrograma = :id";
                break;
            case 2:
                $where = " Where idProyecto = :id";
                break;
            case 3:
                $where = " Where idCalificacion = :id";
                break;
            case 4:
                $where = " Where idAdjudicacion = :id";
                break;
            case 5:
                $where = " Where idContratacion = :id";
                break;
            case 6:
                $where = " Where idContratos = :id";
                break;
            case 7:
                $where = " Where idEjecucion = :id";
                break;
            case 8:
                $where = " Where idAvances = :id";
                break;
        };
           
        $command=$connection->createCommand($sql.$where)->prepare(array(
            ":id" => $id
        ));
        $row=$command->queryRow();
        foreach($row as $r) {  $arr[$i] = $r; $i++; }
        
        $path = Yii::getPathOfAlias("$base");
        for ($i=1;$i<=$component;$i++) {
            $dir = $dir.'.'.$arr[$i];
            $path = Yii::getPathOfAlias($dir); 
            /*
            if (!is_dir($path)) {
                    mkdir($path);
                } */
        };
        
         return $path;
    }
 
}

?>