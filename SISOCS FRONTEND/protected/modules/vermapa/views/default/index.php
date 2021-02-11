<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<p>
This is the view content for action "<?php echo $this->action->id; ?>".
The action belongs to the controller "<?php echo get_class($this); ?>"
in the "<?php echo $this->module->id; ?>" module.
</p>
<p>
You may customize this page by editing <tt><?php echo __FILE__; ?></tt>
</p>
<?php
//
// ext is your protected.extensions folder
// gmaps means the subfolder name under your protected.extensions folder
//  
Yii::import('ext.EGMap.*');
 

//$gMap = new EGMap();
// 
//$gMap->setWidth(512);
//// it can also be called $gMap->height = 400;
//$gMap->setHeight(400);
//$gMap->zoom = 8; 
// 
//$m=Address::model()->findByPk('1');
//$x=$m->longitude;
//$y=$m->latitude;
//// set center to inca
////$gMap->setCenter(39.719588117933185, 2.9087440013885635);
// $gMap->setCenter($x, $y);
//// my house when i was a kid
//$home = new EGMapCoord($x, $y);
// 
//// my ex-school
//$school = new EGMapCoord($x, $y);
// 
//// some stops on the way
//$santo_domingo = new EGMapCoord($x,$y);
////$plaza_toros  = new EGMapCoord(39.71945607911511, 2.9049245357513565);
////$paso_del_tren = new EGMapCoord( 39.718762871171776, 2.903637075424208 );
// 
//// Waypoint samples
//$waypoints = array(
//      new EGMapDirectionWayPoint($santo_domingo),
//  //    new EGMapDirectionWayPoint($plaza_toros, false),
//   //   new EGMapDirectionWayPoint($paso_del_tren, false)
//    );
// 
//// Initialize GMapDirection
//$direction = new EGMapDirection($home, $school, 'direction_sample', array('waypoints' => $waypoints));
// 
//$direction->optimizeWaypoints = true;
//$direction->provideRouteAlternatives = true;
// 
//$renderer = new EGMapDirectionRenderer();
//$renderer->draggable = true;
//$renderer->panel = "direction_pane";
//$renderer->setPolylineOptions(array('strokeColor'=>'#FFAA00'));
// 
//$direction->setRenderer($renderer);
// 
//$gMap->addDirection($direction);
// 
//$gMap->renderMap();
$gMap = new EGMap();
$gMap->setJsName('test_map');
$gMap->width = '100%';
$gMap->height = 300;
$gMap->zoom = 14;
$gMap->setCenter(14.081803, -87.20943);
 
$info_box = new EGMapInfoBox('<div style="color:#fff;border: 1px solid black; margin-top: 8px; background: #000; padding: 5px;">I am a marker with info box!</div>');
 
// set the properties
$info_box->pixelOffset = new EGMapSize('0','-140');
$info_box->maxWidth = 0;
$info_box->boxStyle = array(
    'width'=>'"280px"',
    'height'=>'"120px"',
    'background'=>'"url(http://google-maps-utility-library-v3.googlecode.com/svn/tags/infobox/1.1.9/examples/tipbox.gif) no-repeat"'
);
$info_box->closeBoxMargin = '"10px 2px 2px 2px"';
$info_box->infoBoxClearance = new EGMapSize(1,1);
$info_box->enableEventPropagation ='"floatPane"';
 
// with the second info box, we don't need to 
// set its properties as we are sharing a global 
// info_box
$info_box2 = new EGMapInfoBox('<div style="color:#000;border: 1px solid #c0c0c0; margin-top: 8px; background: #c0c0c0; padding: 5px;">I am a marker with info box 2!</div>');
// Create marker
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
$marker = new EGMapMarker(14.0833, -87.2167, array('title' => 'Marker With Info Box'));
$marker_options = array(
  'draggable'=>true,
  'labelAnchor'=>new EGMapPoint(22,0),
  'raiseOnDrag'=>true
);

$marker->setOptions($marker_options);

/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
// add two 
$marker2 = new EGMapMarker(14.081803, -87.20943, array('title' => 'Marker With Info Box 2'));
$marker_options2 = array(
  'draggable'=>true,
  'labelAnchor'=>new EGMapPoint(22,0),
  'raiseOnDrag'=>true
);

$marker2->setOptions($marker_options2);
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
$marker->addHtmlInfoBox($info_box);
$marker2->addHtmlInfoBox($info_box2);
 
$gMap->addMarker($marker);
$gMap->addMarker($marker2);
 
$gMap->renderMap();




?>
<div id="direction_pane"></div>

<style type="text/css">
.labels {
   color: red;
   background-color: white;
   font-family: "Lucida Grande", "Arial", sans-serif;
   font-size: 10px;
   font-weight: bold;
   text-align: center;
   width: 40px;     
   border: 2px solid black;
   white-space: nowrap;
}
</style>
