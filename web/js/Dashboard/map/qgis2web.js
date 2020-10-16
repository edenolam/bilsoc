

var container;// = document.getElementById('popup');
var content;// = document.getElementById('popup-content');
var closer;// = document.getElementById('popup-closer');
if(closer!=undefined){
    closer.onclick = function() {
        container.style.display = 'none';
        closer.blur();
        return false;
    };
}

var overlayPopup;/* = new ol.Overlay({
    element: container
});*/

var expandedAttribution;/* = new ol.control.Attribution({
    collapsible: false
});*/

var map;/* = new ol.Map({
    controls: ol.control.defaults({attribution:false}).extend([
        expandedAttribution
    ]),
    target: document.getElementById('map'),
    renderer: 'canvas',
    overlays: [overlayPopup],
    layers: layersList,
    view: new ol.View({
         maxZoom: 28, minZoom: 1, zoom: 2, center: [0,0]
    })
});*/

var searchLayer;/* = new ol.SearchLayer({
  layer: lyr_COMMUNE0,
  colName: 'Etat des lieux cdgtout Feuil1_Field2',
  zoom: 10,
  collapsed: true,
  map: map
});*/

//map.addControl(searchLayer);
//map.getView().fit([-412458.187146, 5924596.590769, 80298.544309, 6289339.564153], map.getSize());

var NO_POPUP = 0
var ALL_FIELDS = 1

function initOlMap(){
    container = document.getElementById('popup');
    content = document.getElementById('popup-content');
    closer = document.getElementById('popup-closer');
    closer.onclick = function() {
        container.style.display = 'none';
        closer.blur();
        return false;
    };
    overlayPopup = new ol.Overlay({
        element: container
    });

    expandedAttribution = new ol.control.Attribution({
        collapsible: false
    });

    map = new ol.Map({
        controls: ol.control.defaults({attribution:false}).extend([
            expandedAttribution
        ]),
        target: document.getElementById('map'),
        renderer: 'canvas',
        overlays: [overlayPopup],
        layers: layersList,
        view: new ol.View({
             maxZoom: 28, minZoom: 1, zoom: 2, center: [0,0]
        })
    });

    searchLayer = new ol.SearchLayer({
      layer: lyr_COMMUNE0,
      colName: 'Etat des lieux cdgtout Feuil1_Field2',
      zoom: 10,
      collapsed: true,
      map: map
    });

    map.addControl(searchLayer);
    map.getView().fit([-412458.187146, 5924596.590769, 80298.544309, 6289339.564153], map.getSize());

    NO_POPUP = 0
    ALL_FIELDS = 1

    collection = new ol.Collection();
    featureOverlay = new ol.layer.Vector({
        map: map,
        source: new ol.source.Vector({
            features: collection,
            useSpatialIndex: false // optional, might improve performance
        }),
        style: [new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: '#f00',
                width: 1
            }),
            fill: new ol.style.Fill({
                color: 'rgba(255,0,0,0.1)'
            }),
        })],
        updateWhileAnimating: true, // optional, for instant visual feedback
        updateWhileInteracting: true // optional, for instant visual feedback
    });

    doHighlight = false;
    doHover = true;
    map.on('pointermove', function(evt) {
        onPointerMove(evt);
    });
    map.on('singleclick', function(evt) {
        onSingleClick(evt);
    });

    attribution = document.getElementsByClassName('ol-attribution')[0];
    attributionList = attribution.getElementsByTagName('ul')[0];
    firstLayerAttribution = attributionList.getElementsByTagName('li')[0];
    qgis2webAttribution = document.createElement('li');
    qgis2webAttribution.innerHTML = '<a href="https://github.com/tomchadwin/qgis2web">qgis2web</a>';
    attributionList.insertBefore(qgis2webAttribution, firstLayerAttribution);
}

/**
 * Returns either NO_POPUP, ALL_FIELDS or the name of a single field to use for
 * a given layer
 * @param layerList {Array} List of ol.Layer instances
 * @param layer {ol.Layer} Layer to find field info about
 */
function getPopupFields(layerList, layer) {
    // Determine the index that the layer will have in the popupLayers Array,
    // if the layersList contains more items than popupLayers then we need to
    // adjust the index to take into account the base maps group
    var idx = layersList.indexOf(layer) - (layersList.length - popupLayers.length);
    return popupLayers[idx];
}


var collection;// = new ol.Collection();
var featureOverlay;/* = new ol.layer.Vector({
    map: map,
    source: new ol.source.Vector({
        features: collection,
        useSpatialIndex: false // optional, might improve performance
    }),
    style: [new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: '#f00',
            width: 1
        }),
        fill: new ol.style.Fill({
            color: 'rgba(255,0,0,0.1)'
        }),
    })],
    updateWhileAnimating: true, // optional, for instant visual feedback
    updateWhileInteracting: true // optional, for instant visual feedback
});*/

var doHighlight = false;
var doHover = true;

var highlight;
function onPointerMove(evt) {
    if (!doHover && !doHighlight) {
        return;
    }
    var pixel = map.getEventPixel(evt.originalEvent);
    var coord = evt.coordinate;
    var popupField;
    var popupText = '';
    var currentFeature;
    var currentLayer;
    var currentFeatureKeys;
    map.forEachFeatureAtPixel(pixel, function(feature, layer) {
        // We only care about features from layers in the layersList, ignore
        // any other layers which the map might contain such as the vector
        // layer used by the measure tool
        if (layersList.indexOf(layer) === -1) {
            return;
        }
        currentFeature = feature;
        currentLayer = layer;
        currentFeatureKeys = currentFeature.getKeys();
        var doPopup = false;
        for (k in layer.get('fieldImages')) {
            if (layer.get('fieldImages')[k] != "Hidden") {
                doPopup = true;
            }
        }
        if (doPopup) {
            popupText = '<table>';
            for (var i=0; i<currentFeatureKeys.length; i++) {
                if (currentFeatureKeys[i] != 'geometry') {
                    popupField = '';
                    if (layer.get('fieldLabels')[currentFeatureKeys[i]] == "inline label") {
                        popupField += '<th>' + layer.get('fieldAliases')[currentFeatureKeys[i]] + ':</th><td>';
                    } else {
                        popupField += '<td colspan="2">';
                    }
                    if (layer.get('fieldLabels')[currentFeatureKeys[i]] == "header label") {
                        popupField += '<strong>' + layer.get('fieldAliases')[currentFeatureKeys[i]] + ':</strong><br />';
                    }
                    if (layer.get('fieldImages')[currentFeatureKeys[i]] != "Photo") {
                        popupField += (currentFeature.get(currentFeatureKeys[i]) != null ? Autolinker.link(String(currentFeature.get(currentFeatureKeys[i]))) + '</td>' : '');
                    } else {
                        popupField += (currentFeature.get(currentFeatureKeys[i]) != null ? '<img src="images/' + currentFeature.get(currentFeatureKeys[i]).replace(/[\\\/:]/g, '_').trim()  + '" /></td>' : '');
                    }
                    popupText = popupText + '<tr>' + popupField + '</tr>';
                }
            }
            popupText = popupText + '</table>';
        }
    });

    if (doHighlight) {
        if (currentFeature !== highlight) {
            if (highlight) {
                featureOverlay.getSource().removeFeature(highlight);
            }
            if (currentFeature) {
                var styleDefinition = currentLayer.getStyle().toString();

                if (currentFeature.getGeometry().getType() == 'Point') {
                    var radius = styleDefinition.split('radius')[1].split(' ')[1];

                    highlightStyle = new ol.style.Style({
                        image: new ol.style.Circle({
                            fill: new ol.style.Fill({
                                color: "#ffff00"
                            }),
                            radius: radius
                        })
                    })
                } else if (currentFeature.getGeometry().getType() == 'LineString') {

                    var featureWidth = styleDefinition.split('width')[1].split(' ')[1].replace('})','');

                    highlightStyle = new ol.style.Style({
                        stroke: new ol.style.Stroke({
                            color: '#ffff00',
                            lineDash: null,
                            width: featureWidth
                        })
                    });

                } else {
                    highlightStyle = new ol.style.Style({
                        fill: new ol.style.Fill({
                            color: '#ffff00'
                        })
                    })
                }
                featureOverlay.getSource().addFeature(currentFeature);
                featureOverlay.setStyle(highlightStyle);
            }
            highlight = currentFeature;
        }
    }

    if (doHover) {
        if (popupText) {
            overlayPopup.setPosition(coord);
            content.innerHTML = popupText;
            container.style.display = 'block';        
        } else {
            container.style.display = 'none';
            closer.blur();
        }
    }
};

function onSingleClick(evt) {
    if (doHover) {
        return;
    }
    var pixel = map.getEventPixel(evt.originalEvent);
    var coord = evt.coordinate;
    var popupField;
    var popupText = '';
    var currentFeature;
    var currentFeatureKeys;
    map.forEachFeatureAtPixel(pixel, function(feature, layer) {
        currentFeature = feature;
        currentFeatureKeys = currentFeature.getKeys();
        var doPopup = false;
        for (k in layer.get('fieldImages')) {
            if (layer.get('fieldImages')[k] != "Hidden") {
                doPopup = true;
            }
        }
        if (doPopup) {
            popupText = '<table>';
            for (var i=0; i<currentFeatureKeys.length; i++) {
                if (currentFeatureKeys[i] != 'geometry') {
                    popupField = '';
                    if (layer.get('fieldLabels')[currentFeatureKeys[i]] == "inline label") {
                        popupField += '<th>' + layer.get('fieldAliases')[currentFeatureKeys[i]] + ':</th><td>';
                    } else {
                        popupField += '<td colspan="2">';
                    }
                    if (layer.get('fieldLabels')[currentFeatureKeys[i]] == "header label") {
                        popupField += '<strong>' + layer.get('fieldAliases')[currentFeatureKeys[i]] + ':</strong><br />';
                    }
                    if (layer.get('fieldImages')[currentFeatureKeys[i]] != "Photo") {
                        popupField += (currentFeature.get(currentFeatureKeys[i]) != null ? Autolinker.link(String(currentFeature.get(currentFeatureKeys[i]))) + '</td>' : '');
                    } else {
                        popupField += (currentFeature.get(currentFeatureKeys[i]) != null ? '<img src="images/' + currentFeature.get(currentFeatureKeys[i]).replace(/[\\\/:]/g, '_').trim()  + '" /></td>' : '');
                    }
                    popupText = popupText + '<tr>' + popupField + '</tr>';
                }
            }
            popupText = popupText + '</table>';
        }
    });

    if (popupText) {
        overlayPopup.setPosition(coord);
        content.innerHTML = popupText;
        container.style.display = 'block';        
    } else {
        container.style.display = 'none';
        closer.blur();
    }
};



/*map.on('pointermove', function(evt) {
    onPointerMove(evt);
});
map.on('singleclick', function(evt) {
    onSingleClick(evt);
});*/





/*var attribution = document.getElementsByClassName('ol-attribution')[0];
var attributionList = attribution.getElementsByTagName('ul')[0];
var firstLayerAttribution = attributionList.getElementsByTagName('li')[0];
var qgis2webAttribution = document.createElement('li');
qgis2webAttribution.innerHTML = '<a href="https://github.com/tomchadwin/qgis2web">qgis2web</a>';
attributionList.insertBefore(qgis2webAttribution, firstLayerAttribution);*/
