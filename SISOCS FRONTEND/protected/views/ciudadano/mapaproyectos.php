<?php echo CHtml::link('Regresar',array('site/index'),array('class'=>'specialLinks')); ?><br><br>
<style media="screen">
#map_wrapper {
  height: 400px;
}

#map_canvas {
  width: 100%;
  height: 100%;
}
</style>
<script type="text/javascript">
jQuery(function($) {
  // Asynchronously Load the map API
  var script = document.createElement('script');
  script.src = "//maps.googleapis.com/maps/api/js?key=AIzaSyCPt5UoYmCmEf2179XGsKA_psTOHNRk0Sg&callback=initialize";
  document.body.appendChild(script);
});
//AIzaSyCPt5UoYmCmEf2179XGsKA_psTOHNRk0Sg
function initialize() {
  var map;
  var bounds = new google.maps.LatLngBounds();
  var mapOptions = {
      mapTypeId: 'roadmap'
  };

  // Display a map on the page
  map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
  map.setTilt(45);

  // Multiple Markers
  var markers=[];
  var infoWindowContent=[];
  <?php 
    $UbicacionPuntos = Yii::app()->db->createCommand('SELECT idProyecto,codigo,presupuesto,nombre_proyecto,descrip,lat1,lon1 FROM cs_proyecto WHERE estado="PUBLICADO"')->queryAll();
    
    ?>
  <?php 
    foreach ($UbicacionPuntos as $Ubicacion) {
      if (($Ubicacion['lat1']>0||$Ubicacion['lat1']<0) && ($Ubicacion['lon1']>0||$Ubicacion['lon1']<0)) {
          $truncated = (strlen($Ubicacion['nombre_proyecto']) > 55) ? substr($Ubicacion['nombre_proyecto'], 0, 55) . '<br/>'. substr($Ubicacion['nombre_proyecto'], 55, 55) . '...' : $Ubicacion['nombre_proyecto'];
          $control="";
          $idFicha="";
          $ids = Yii::app()->db->createCommand('SELECT * FROM vidpaths WHERE idProyecto='.$Ubicacion['idProyecto'])->queryAll();
          foreach ($ids as $value) {
            if ($value['idProyecto']!=null) {
                $control="Proyecto";
                $idFicha=$value['idProyecto'];
                if ($value['idCalificacion']!=null) {
                    $control="Calificacion";
                    $idFicha=$value['idCalificacion'];
                    if ($value['idAdjudicacion']!=null) {
                        $control="Adjudicacion";
                        $idFicha=$value['idAdjudicacion'];
                        if ($value['idContratacion']!=null) {
                            $control="Contratacion";
                            $contratoPrincipal = Yii::app()->db->createCommand('SELECT primario FROM cs_contratacion WHERE idContratacion='.$value['idContratacion'])->queryScalar();
                            if ($contratoPrincipal==1) {
                                $idFicha=$value['idContratacion'];
                                break;
                            }
                        }
                    }
                }
            }
        }
    ?>
  markers.push([<?php echo ($Ubicacion['idProyecto'])?>,<?php echo($Ubicacion['lat1'])?>,<?php echo($Ubicacion['lon1'])?>]);
  // Info Window Content
  infoWindowContent.push(['<div class="info_content"><strong><a href="index.php?r=ciudadano/FichaTecnica&control=<?php echo $control ?>&id=<?php echo $idFicha ?>"><strong><?php echo "</strong>$truncated"?></a></strong><br/>Valor estimado del proyecto: Lps. <?php echo(number_format($Ubicacion['presupuesto'],2,".",","))?></div>']);
  <?php }} ?>
  // Display multiple markers on a map
  var infoWindow = new google.maps.InfoWindow(), marker, i;

  // Loop through our array of markers & place each one on the map
  for( i = 0; i < markers.length; i++ ) {
      var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
      bounds.extend(position);
      marker = new google.maps.Marker({
          position: position,
          map: map,
          title: markers[i][0]
      });

      // Allow each marker to have an info window
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
              infoWindow.setContent(infoWindowContent[i][0]);
              infoWindow.open(map, marker);
          }
      })(marker, i));

      // Automatically center the map fitting all markers on the screen
      map.fitBounds(bounds);
  }

  // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
  var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
      this.setZoom(7);
      google.maps.event.removeListener(boundsListener);
  });

}
</script>
<div id="map_wrapper" >
    <div id="map_canvas" class="mapping"></div>
</div>
