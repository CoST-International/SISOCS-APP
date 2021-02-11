<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<?php 
echo '-------------------------------------------------------------------------------Ejemplo 1 usando php y js-----------------------------------------------------------------------------';
$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
      'title' => array('text' => 'Fruit Consumption'),
      'xAxis' => array(
         'categories' => //array('Apples', 'Bananas', 'Oranges')
          array("Jan", "Feb", "Mar", "Apr", "May", "Jun",
                    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec")
      ),
      'yAxis' => array(
         'title' => array('text' => 'Proyectos')
      ),
      'series' => array(
         array('name' => 'Proyecto 1', 'data' => array(1,1,1,1,1,1,1,1,1,1,1,1)),
         array('name' => 'Proyeco 2', 'data' => array(2,2,2,2,2,2,2,2,2,2,2,2))
      )
   )
));
echo '-----------------------------------------------------------------------------------Ejemplo 2 utilizando json-----------------------------------------------------------------';
$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>'{
      "title": { "text": "Fruit Consumption" },
      "xAxis": {
         //"categories": ["Apples", "Bananas", "Oranges"]
             "categories": ["Jan 1%", "Feb 2%", "Mar 3%", "Apr 4%", "May 5%", "Jun 6%",
                    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
      },
      "yAxis": {
         "title": { "text": "Fruit eaten" }
      },
      "series": [
         { "name": "Proyecto1", "data": [1,1,1,1,1,1,1,1,1,1,1,1] },
         { "name": "Proyecto2", "data": [2,2,2,2,2,2,2,2,2,2,2,2] }
      ]
   }'
));
echo '-----------------------------------------------------------------------------------Ejemplo 2 Grafico de Barras-----------------------------------------------------------------';

$this->Widget('ext.highcharts.HighchartsWidget',
array(
'id' => 'grafbarra',
'options'=> array(
'chart' => array('defaultSeriesType' => 'column','style' => array('fontFamily' => 'Verdana, Arial, Helvetica, sans-serif',),),
'title' => array('text' => 'Distribution of Population',),
'xAxis' => array('title' => array('text' => 'Place',),
        'categories' => array('Rural','Urban'),
        'labels' => array(
        'step' => 1,
        'rotation' => 0,
        'y' => 20,),
        ),
'yAxis' => array('title' => array('text' => 'Number of Population',),),
'series' => array(array('name' => 'Boys','data' => array(20,60),),
array(
'name' => 'Girls',
'data' => array(80,120),
),))));

echo '-----------------------------------------------------------------------------------Ejemplo 3 Grafico de Pastel-----------------------------------------------------------------';
$this->Widget('ext.highcharts.HighchartsWidget',
array(
'id' => 'grafpie',
'options'=> array(
'chart' => array('defaultSeriesType' => 'pie','style' => array('fontFamily' => 'Verdana, Arial, Helvetica, sans-serif',),),
'title' => array('text' => 'Distribution of Population',),
'xAxis' => array('title' => array('text' => 'Place',),
        'categories' => array('Rural','Urban'),
        'labels' => array(
        'step' => 1,
        'rotation' => 0,
        'y' => 20,),
        ),
'yAxis' => array('title' => array('text' => 'Number of Population',),),
'series' => array(array('name' => 'Boys','data' => array(20,60),),
array(
'name' => 'Girls',
'data' => array(80,120),
),))));

echo '-----------------------------------------------------------------------------------Ejemplo Manejo de fechas con PHP-----------------------------------------------------------------';
$fechainicial = new DateTime('2012-01-01');
echo '<br/>Fecha Inicial:2012-01-01';
$fechafinal = new DateTime('2013-09-01');
echo '<br/>Fecha Final:2013-09-01';
$diferencia=$fechainicial->diff($fechafinal);
echo '<br/>Tiempo en Años:'.$diferencia->y." y ".$diferencia->m;
echo '<br/>Tiempo en Meses:'.(($diferencia->y*12)+$diferencia->m);
echo '<br/>Tiempo en Dias:'.$diferencia->days;
?>
