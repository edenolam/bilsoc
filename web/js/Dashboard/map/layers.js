var layersList = [];
var lyr_COMMUNE0;
var loadMap =  function(urlMap){
	if(!isEmpty(urlMap)){
		var format_COMMUNE0 = new ol.format.GeoJSON();
		/*var features_COMMUNE0 = format_COMMUNE0.readFeatures(geojson_COMMUNE0, 
		    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'}
		);*/
		/*var mapSourceLoader = function(extent,resolution,projection){
			var url = 'js/Dashboard/COMMUNE0.json';
			$.ajax({
		     	url: url,
		      	dataType: 'json'
		    });
		}*/
		var loadFeatures = function(response) {
			var features = vectorSource.readFeatures(response);
			vectorSource.addFeatures(features);
		};
		/*var vectorLoadedSource = new ol.source.ServerVector({
			format: format_COMMUNE0,
			loader: mapSourceLoader,
			strategy: ol.loadingstrategy.createTile(new ol.tilegrid.XYZ({
			  	maxZoom: 19
			}))
		});*/
		/*var jsonSource_COMMUNE0 = new ol.source.Vector({
		    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
		});*/

		var vectorSource = new ol.source.Vector({
		      url: urlMap,//'/js/Dashboard/map/COMMUNE0.json',//Routing.generate('ajax_get_cdg_map'),
		      format: format_COMMUNE0
	    });
		//jsonSource_COMMUNE0.addFeatures(features_COMMUNE0);
		lyr_COMMUNE0 = new ol.layer.Vector({
		    source: vectorSource, 
		    style: style_COMMUNE0,
		    title: "COMMUNE"
		});

		lyr_COMMUNE0.setVisible(true);
		layersList = [lyr_COMMUNE0];
		/*var view = new ol.View({
			center: [0,0],
			zoom: 1
		});
		var map = new ol.Map({
			target: 'map',
			layers: layersList,
			view: view
		});*/
		
		lyr_COMMUNE0.set('fieldAliases', {'ID_GEOFLA': 'ID_GEOFLA', 'CODE_COM': 'CODE_COM', 'INSEE_COM': 'INSEE_COM', 'NOM_COM': 'NOM_COM', 'STATUT': 'STATUT', 'X_CHF_LIEU': 'X_CHF_LIEU', 'Y_CHF_LIEU': 'Y_CHF_LIEU', 'X_CENTROID': 'X_CENTROID', 'Y_CENTROID': 'Y_CENTROID', 'Z_MOYEN': 'Z_MOYEN', 'SUPERFICIE': 'SUPERFICIE', 'POPULATION': 'POPULATION', 'CODE_CANT': 'CODE_CANT', 'CODE_ARR': 'CODE_ARR', 'CODE_DEPT': 'CODE_DEPT', 'NOM_DEPT': 'NOM_DEPT', 'CODE_REG': 'CODE_REG', 'NOM_REG': 'NOM_REG', 'Etat des lieux cdgtout Feuil1_Field2': 'Etat des lieux cdgtout Feuil1_Field2', });
		lyr_COMMUNE0.set('fieldImages', {'ID_GEOFLA': 'TextEdit', 'CODE_COM': 'TextEdit', 'INSEE_COM': 'TextEdit', 'NOM_COM': 'TextEdit', 'STATUT': 'TextEdit', 'X_CHF_LIEU': 'TextEdit', 'Y_CHF_LIEU': 'TextEdit', 'X_CENTROID': 'TextEdit', 'Y_CENTROID': 'TextEdit', 'Z_MOYEN': 'TextEdit', 'SUPERFICIE': 'TextEdit', 'POPULATION': 'TextEdit', 'CODE_CANT': 'TextEdit', 'CODE_ARR': 'TextEdit', 'CODE_DEPT': 'TextEdit', 'NOM_DEPT': 'TextEdit', 'CODE_REG': 'TextEdit', 'NOM_REG': 'TextEdit', 'Etat des lieux cdgtout Feuil1_Field2': 'TextEdit', });
		lyr_COMMUNE0.set('fieldLabels', {'ID_GEOFLA': 'no label', 'CODE_COM': 'no label', 'INSEE_COM': 'no label', 'NOM_COM': 'no label', 'STATUT': 'no label', 'X_CHF_LIEU': 'no label', 'Y_CHF_LIEU': 'no label', 'X_CENTROID': 'no label', 'Y_CENTROID': 'no label', 'Z_MOYEN': 'no label', 'SUPERFICIE': 'no label', 'POPULATION': 'no label', 'CODE_CANT': 'no label', 'CODE_ARR': 'no label', 'CODE_DEPT': 'no label', 'NOM_DEPT': 'no label', 'CODE_REG': 'no label', 'NOM_REG': 'no label', 'Etat des lieux cdgtout Feuil1_Field2': 'inline label', });
		lyr_COMMUNE0.on('precompose', function(evt) {
		    evt.context.globalCompositeOperation = 'normal';
		});
		initOlMap();
	}
}