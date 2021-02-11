<?php
/* @var $this AvancesController */
/* @var $model Avances */

$this->breadcrumbs=array(
	'Avances'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Avances', 'url'=>array('index')),
	array('label'=>'Crear Avances', 'url'=>Yii::app()->createUrl("/avances/create", array("idInicioEjecucion"=>$model->idInicioEjecucion))),
);

?>

<h1>Gestionar Avances en la Ejecuci&oacute;n # <?php echo $model->idInicioEjecucion; ?></h1>

<p>
    Tambi&eacuten puede escribir un operador de comparaci&oacuten (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    o <b>=</b>) al principio de cada uno de los valores de b&uacutesqueda para especificar c&oacutemo se debe hacer la comparaci&oacuten.
</p>


</div><!-- search-form -->

<?php

/* Yii::import('zii.widgets.grid.CGridColumn');
 
    class Indicador extends CGridColumn {
     
        private $_indic = 0;
        private $_semaforo= '';
        public function renderDataCellContent($row, $model) { // $row number is ignored
     
            $this->_indic = $model->porcent_real-$model->porcent_programado;
            $pathX = YiiBase::getPathOfAlias('webroot.images.avances_img.');

            if($this->_indic<0){
            
                $this->_semaforo="<img src='images/avances_img/1.png' border='0' width='60' height='20'>";}
                
                if($this->_indic==0){
                $this->_semaforo="<img src='images/avances_img/2.png' border='0' width='60' height='20'>";}
                if($this->_indic>0){
                $this->_semaforo="<img src='images/avances_img/3.png' border='0' width='60' height='20'>";}	
                
            echo $this->_semaforo;
        }
        
    }; */

   // $this->widget('zii.widgets.grid.CGridView', array(
    //'id'=>'avances-grid',
    //'dataProvider'=>$model->search(),
    //'filter'=>$model,
   // 'columns'=>array(
        //'codigo',
        //'codigo_inicio_ejecucion',
        //'porcent_programado',
        //'porcent_real',
        //'finan_programado',
        //'finan_real',
        // array(
       // 'header' => 'Indicador Avance',
       // 'class'  => 'Indicador',
      // ),
     //   array('class'=>'CButtonColumn',),
   //     ),
   // )
 //   ); 

 if (count($records) > 0) {
    $this->widget('application.extensions.tablesorter.Sorter', array(
        
	'data'=>$records,
	'columns'=>array(
	    array('header'=>'Id Avance',
              'value'=>'idAvances'),
        array('header'=>'% Físico Programado',
              'value'=>'porcent_programado'),			  
        array('header'=>'% Físico Real',
              'value'=>'porcent_real'),
        array('header'=>'% Fínanciero Programado',
              'value'=>'finan_programado'),
        array('header'=>'% Fínanciero Real',
              'value'=>'finan_real'),
        
            ),
    )); 
}
else {
    echo 'Na hay avances registrados en esta ejecicion.';
}
  



?>
