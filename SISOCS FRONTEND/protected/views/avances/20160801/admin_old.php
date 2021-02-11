<?php
/* @var $this AvancesController */
/* @var $model Avances */

$this->breadcrumbs=array(
	'Avances'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Lista Avances', 'url'=>array('index')),
	array('label'=>'Crear Avances', 'url'=>Yii::app()->createUrl("/avances/create", array("idInicioEjecucion"=>$model->idInicioEjecucion))),
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#avances-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestionar avances en la ejecuci&oacute;n</h1>

<p>
Tambi�n puede escribir un operador de comparaci�n (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
o <b>=</b>) al principio de cada uno de los valores de b�squeda para especificar c�mo se debe hacer la comparaci�n.
</p>

<?php echo CHtml::link('Busqueda avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php

Yii::import('zii.widgets.grid.CGridColumn');
 
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
        
    };


	
	$this->widget('application.extensions.tablesorter.Sorter', array(
    'data'=>$records,
    'columns'=>array(
       'codigo',
        'idInicioEjecucion',
        'porcent_programado',
        'porcent_real',
        'finan_programado',
        'finan_real',
    )
));

?>
