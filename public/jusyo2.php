<!DOCTYPE html>
<html>
<head><style>html, body, #map { width: 100%; height: 100%; }</style></head>
<body>
<div id="map"></div>

<script>
function initMap() {
    // ルート検索の条件
    var request = {
        origin: new google.maps.LatLng(34.66217144205834, 135.211640825866), // 出発地
        destination: new google.maps.LatLng(34.66217144205834, 135.211640825866), // 目的地
        waypoints: [ // 経由地点(指定なしでも可)
            { location: new google.maps.LatLng(34.69594510434359, 135.191867623567) },
            { location: new google.maps.LatLng(34.698766632284304, 135.19709613525328) },
            { location: new google.maps.LatLng(34.70022100178433, 135.19280925128044) },
            { location: new google.maps.LatLng(34.69841630588382, 135.18923254386937) },
            { location: new google.maps.LatLng(34.69743963051207, 135.190872406112) },
            { location: new google.maps.LatLng(34.69178008949605, 135.1923613530752) },
            { location: new google.maps.LatLng(34.69205613984837, 135.18917186039073) },
            { location: new google.maps.LatLng(34.69269754740632, 135.19658767774695) },
        ],
        travelMode: google.maps.DirectionsTravelMode.WALKING, // 交通手段(歩行。DRIVINGの場合は車)
    };

    // マップの生成
    var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(35.681382,139.766084), // マップの中心
        zoom: 7 // ズームレベル
    });

    var d = new google.maps.DirectionsService(); // ルート検索オブジェクト
    var r = new google.maps.DirectionsRenderer({ // ルート描画オブジェクト
        map: map, // 描画先の地図
        preserveViewport: true, // 描画後に中心点をずらさない
    });
    // ルート検索
    d.route(request, function(result, status){
        // OKの場合ルート描画
        if (status == google.maps.DirectionsStatus.OK) {
            r.setDirections(result);
        }
    });
}


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBo2VNB_ibg1-_1E_dAbkOFMUW5iCPQwuU&callback=initMap" async defer></script>


</body>
</html>
