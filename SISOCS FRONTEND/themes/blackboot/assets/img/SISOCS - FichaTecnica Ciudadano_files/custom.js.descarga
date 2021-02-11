
$(function () {
    'use strict';

    $('.carousel .carousel-item[data-src]').each(function () {
        var $this = $(this);

        $this.prepend([
            '<div style="background-image: url(', $this.attr('data-src'), ')"></div>'
        ].join(''));
    });
});

$(document).ready(function () {

    jQuery.ajax({ 'type': 'POST', 'data': { 'id': 'TODOS' }, 'url': 'index.php?r=Ciudadano/BMapa', 'cache': false, 'success': function (html) { jQuery("#proyectos").html(html) } });

});

var map = AmCharts.makeChart("chartdiv", {
    "type": "map",
    "zoomOnDoubleClick": false,
    "addClassNames": true,
    "fontSize": 15,
    "color": "#FFFFFF",
    "projection": "mercator",
    "backgroundAlpha": 1,
    "dataProvider": {
        "map": "hondurasLow",
        "getAreasFromMap": true,
        "images": [
            {
                "top": 40,
                "left": 60,
                "width": 80,
                "height": 40,
                "pixelMapperLogo": true,
            }
        ]
    },
    "balloon": {
        "horizontalPadding": 15,
        "borderAlpha": 0,
        "borderThickness": 1,
        "verticalPadding": 15
    },
    "areasSettings": {
        "color": "#29a4dd",
        "outlineColor": "rgba(80,80,80,1)",
        "rollOverOutlineColor": "rgba(80,80,80,1)",
        "rollOverBrightness": 20,
        "selectedBrightness": 20,
        "selectable": true,
        "unlistedAreasAlpha": 0,
        "unlistedAreasOutlineAlpha": 0,
        "selectedColor": "#2980b9",
        "legend": true
    },
    "imagesSettings": {
        "alpha": 1,
        "color": "rgba(0,175,150,1)",
        "outlineAlpha": 0,
        "rollOverOutlineAlpha": 0,
        "outlineColor": "rgba(80,80,80,1)",
        "rollOverBrightness": 20,
        "selectedBrightness": 20,
        "selectable": true
    },
    "linesSettings": {
        "color": "rgba(0,175,150,1)",
        "selectable": true,
        "rollOverBrightness": 20,
        "selectedBrightness": 20
    },
    "zoomControl": {
        "zoomControlEnabled": false,
        "homeButtonEnabled": false,
        "panControlEnabled": false,
        "right": 38,
        "bottom": 30,
        "minZoomLevel": 0.25,
        "gridHeight": 100,
        "gridAlpha": 0.1,
        "gridBackgroundAlpha": 0,
        "gridColor": "#FFFFFF",
        "draggerAlpha": 1,
        "buttonCornerRadius": 2
    },

    "legend": {
        "useGraphSettings": true,
        "enabled": true,
    },
});


map.addListener("clickMapObject", function (event) {

    var id = event.mapObject.id;
    var title = event.mapObject.title;
    $("#checkbox" + id).click();
    map.selectedObject = map.dataProvider;

    // toggle showAsSelected
    event.mapObject.showAsSelected = !event.mapObject.showAsSelected;

    // bring it to an appropriate color
    map.returnInitialColor(event.mapObject);

    // let's build a list of currently selected states
    var states = [];
    for (var i in map.dataProvider.areas) {
        var area = map.dataProvider.areas[i];
        if (area.showAsSelected) {
            states.push(area.title);
        }
    }

});


map.addListener("positionChanged", updateCustomMarkers);

function ClickMap(param) {
    // alert(param);

    $('#Cont_Encabezado').hide(500);
    $('#Div_Encabezado1').hide(500);
    $('#Div_Encabezado2').hide(500);
    $('#Div_Encabezado3').hide(500);
    $('#Div_Map').hide(1500);
    $('#Div_showBoton').show(500);
    document.getElementById('LblMunicipio').textContent = param;
}

function ShowMap() {
    $('#Div_showBoton').hide(1500);
    $('#Div_Map').show(500);
    $('#Cont_Encabezado').show(500);
    $('#Div_Encabezado1').show(500);
    $('#Div_Encabezado2').show(500);
    $('#Div_Encabezado3').show(500);
}

$("a[title='JavaScript charts']").remove();

// this function will take current images on the map and create HTML elements for them
function updateCustomMarkers(event) {
    // get map object
    var map = event.chart;

    // go through all of the images
    for (var x in map.dataProvider.images) {
        // get MapImage object
        var image = map.dataProvider.images[x];

        // check if it has corresponding HTML element
        if ('undefined' == typeof image.externalElement)
            image.externalElement = createCustomMarker(image);

        // reposition the element accoridng to coordinates
        var xy = map.coordinatesToStageXY(image.longitude, image.latitude);
        image.externalElement.style.top = xy.y + 'px';
        image.externalElement.style.left = xy.x + 'px';
    }
}

// this function creates and returns a new marker element
function createCustomMarker(image) {
    // create holder
    var holder = document.createElement('div');
    holder.className = 'map-marker';
    holder.title = image.title;
    holder.style.position = 'absolute';

    // maybe add a link to it?
    if (undefined != image.url) {
        holder.onclick = function () {
            window.location.href = image.url;
        };
        holder.className += ' map-clickable';
    }

    // create dot
    var dot = document.createElement('div');
    dot.className = 'dot';
    holder.appendChild(dot);

    // create pulse
    var pulse = document.createElement('div');
    pulse.className = 'pulse';
    holder.appendChild(pulse);

    // append the marker to the map container
    image.chart.chartDiv.appendChild(holder);

    return holder;
}