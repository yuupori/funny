<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <script src="https://unpkg.com/leaflet@1.3.0/dist/leaflet.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.0/dist/leaflet.css" />
  <title>map</title>

  <!-- 動作処理 -->
  <script>
  var mapobj; var marktxt;
      var mymark;  var watchTime;
      var minInterval = 5000; // 情報取得の最少間隔（単位 msec）
      var map_id=0; var Pset = []; var setPs = [];
      var watch_id = 0;  // 監視識別ID
      function getPosi2() {
          var button = document.getElementById('button2');
	  if( watch_id>0 ){
	    // リアルタイム監視を停止
	    window.navigator.geolocation.clearWatch(watch_id);
	    watch_id = 0;                    // 監視識別IDに0をセット
	    button.textContent = "測定開始"; // ボタン表記を変更
	  } else {
	    var p_options = {                // リアルタイム監視を開始
	      enableHighAccuracy: true,    // 高精度を要求する
	      timeout: 50000,              // 最大待ち時間（ミリ秒）
	      maximumAge: 0                // キャッシュ有効期間（ミリ秒）
	    };
            watch_id = window.navigator.geolocation.watchPosition(monitor,error,p_options); 
	    // ボタン表記を変更
	    button.textContent = "測定停止";
	  }
      };  // getPosi2()  --------------- 
 
      function error(err) {
        console.warn('ERROR(' + err.code + '): ' + err.message);
      }; // error(err)  ---------------
 
      // リアルタイム監視
      function monitor(event){
	if(event.coords.accuracy>1000){return};
        if( ( new Date().getTime()- watchTime )<minInterval ){return};
        watchTime = new Date().getTime();
	var latitude = event.coords.latitude;       // 緯度
	var longitude = event.coords.longitude;     // 経度
        document.querySelector('#accu').textContent = event.coords.accuracy.toFixed(0);
        var Pset = new L.LatLng(latitude,longitude);
        marktxt = latitude.toFixed(6)+ ', '+ longitude.toFixed(6);
        marker= L.marker(Pset).addTo(mapobj).bindPopup(marktxt).openPopup();
        mapobj.setView(Pset); //中心移動
      }; // monitor(event)  -----------------
      
      function drawMark( Pset ){
        marker= L.marker(Pset).addTo(mapobj).bindPopup(marktxt).openPopup();
      }; // drawMark( setP ) ------------------
 
      function init() {
        mapobj = L.map('mapDiv', { zoomControl:true });
        mapobj.setView([35.6802117,139.7576692], 13);  //図中心 富士山
        L.control.scale({maxWidth:200,position:'bottomleft',imperial:false}).addTo(mapobj);  // 右下にスケールを表示
        var gsiattr = "<a href='https://maps.gsi.go.jp/development/ichiran.html' target='_blank'>国土地理院</a>";
        var gsi = L.tileLayer('https://cyberjapandata.gsi.go.jp/xyz/std/{z}/{x}/{y}.png', { attribution: gsiattr });
        var gsiphot = L.tileLayer('https://cyberjapandata.gsi.go.jp/xyz/seamlessphoto/{z}/{x}/{y}.jpg', { attribution: gsiattr });
        var osm = L.tileLayer('http://tile.openstreetmap.jp/{z}/{x}/{y}.png',
          { attribution: "<a href='http://osm.org/copyright' target='_blank'>OpenStreetMap</a> contributors" });
        var baseMaps = {
          "地理院地図": gsi,
          "地理院写真": gsiphot,
          "O.S.Map": osm
        };
        L.control.layers(baseMaps).addTo(mapobj);
        gsi.addTo(mapobj);
      }; // init()  -------------------
  </script>
  <style>
     html, body{ height:50%; margin:0; padding:0; }
     #mapDiv {position:absolute;top:30px;left:30px;right:30px;bottom:30px;}
  </style>
</head>
<body onload="init()">
    <div style="text-align:center;" >
      <span style="font-size:24px;">現在地を確認する</span>
      <button id="button2" onclick="getPosi2()">測定開始</button>
       精度: <span id="accu">__</span>m
    </div>
    <div id="mapDiv">ここに地図を表示</div>
</body>
</html>
