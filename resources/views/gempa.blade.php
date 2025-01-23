<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-size: 16px;
            font-family: Arial, sans-serif;
        }

        body {
            overflow: hidden;
        }

        #map {
            height: 100vh;
        }
    </style>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>

<body>
    <div id="map"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const map = L.map("map").setView([-0.3155398750904368, 117.1371634207888], 5);

            L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 18,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            }).addTo(map);

            let datas = {!! file_get_contents('https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.json') !!}
            let gempas = datas.Infogempa.gempa;
            let number = 1;
            gempas.forEach(gempa => {
                let koordinat = gempa.Coordinates.split(",");
                let _lat = koordinat[0];
                let _long = koordinat[1];
                let marker = L.marker([_lat, _long]).addTo(map);
                marker.bindPopup(
                    `<h3>${gempa.Wilayah}</h3>
                    <p><strong>Tanggal:</strong> ${gempa.Tanggal}</p>
                    <p><strong>Jam:</strong> ${gempa.Jam}</p>
                    <p><strong>Kedalaman:</strong> ${gempa.Kedalaman}</p>
                    <p><strong>Magnitude:</strong> ${gempa.Magnitude} SR</p>
                    <p><strong>Potensi:</strong> ${gempa.Potensi} SR</p>`
                )
            });
        });
    </script>
</body>

</html>
