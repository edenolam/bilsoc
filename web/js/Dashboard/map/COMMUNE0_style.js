var size = 0;
function categories_COMMUNE0(feature, value) {
                switch(value) {default:
                    return [ new ol.style.Style({
        stroke: new ol.style.Stroke({color: 'rgba(255,255,255,1.0)', lineDash: null, lineCap: 'butt', lineJoin: 'miter', width: 0}), fill: new ol.style.Fill({color: 'rgba(205,205,205,1.0)'})
    })];
                    break;
case 'En cours de saisie':
                    return [ new ol.style.Style({
        stroke: new ol.style.Stroke({color: 'rgba(255,255,255,1.0)', lineDash: null, lineCap: 'butt', lineJoin: 'miter', width: 0}), fill: new ol.style.Fill({color: 'rgba(50,46,100,1.0)'})
    })];
                    break;
case 'Non connecté':
                    return [ new ol.style.Style({
        stroke: new ol.style.Stroke({color: 'rgba(255,255,255,1.0)', lineDash: null, lineCap: 'butt', lineJoin: 'miter', width: 0}), fill: new ol.style.Fill({color: 'rgba(227,82,84,1.0)'})
    })];
                    break;
case 'Non saisie':
                    return [ new ol.style.Style({
        stroke: new ol.style.Stroke({color: 'rgba(255,255,255,1.0)', lineDash: null, lineCap: 'butt', lineJoin: 'miter', width: 0}), fill: new ol.style.Fill({color: 'rgba(227,179,171,1.0)'})
    })];
                    break;
case 'Transmis en attente de validation':
                    return [ new ol.style.Style({
        stroke: new ol.style.Stroke({color: 'rgba(255,255,255,1.0)', lineDash: null, lineCap: 'butt', lineJoin: 'miter', width: 0}), fill: new ol.style.Fill({color: 'rgba(140,198,63,1.0)'})
    })];
                    break;
case 'Transmis validé':
                    return [ new ol.style.Style({
        stroke: new ol.style.Stroke({color: 'rgba(255,255,255,1.0)', lineDash: null, lineCap: 'butt', lineJoin: 'miter', width: 0}), fill: new ol.style.Fill({color: 'rgba(72,198,42,1.0)'})
    })];
                    break;}};
var styleCache_COMMUNE0={}
var style_COMMUNE0 = function(feature, resolution){
    var context = {
        feature: feature,
        variables: {}
    };
    var value = feature.get("Etat des lieux cdgtout Feuil1_Field2");
    var style = categories_COMMUNE0(feature, value);
    if ("" !== null) {
        var labelText = String("");
    } else {
        var labelText = ""
    }
    var key = value + "_" + labelText

    if (!styleCache_COMMUNE0[key]){
        var text = new ol.style.Text({
              font: '10.725px \'MS Shell Dlg 2\', sans-serif',
              text: labelText,
              textBaseline: "center",
              textAlign: "left",
              offsetX: 5,
              offsetY: 3,
              fill: new ol.style.Fill({
                color: 'rgba(0, 0, 0, 255)'
              }),
            });
        styleCache_COMMUNE0[key] = new ol.style.Style({"text": text})
    }
    var allStyles = [styleCache_COMMUNE0[key]];
    allStyles.push.apply(allStyles, style);
    return allStyles;
};