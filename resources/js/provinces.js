document.addEventListener("DOMContentLoaded", function () {
    const map = L.map("map").setView([-0.789275, 113.921327], 13);

    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 5,
        attribution:
            '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(map);

    fetch("/geojson")
        .then((response) => response.json())
        .then((data) => {
            L.geoJSON(data, {
                pointToLayer: (feature, latLng) => L.marker(latLng),
                onEachFeature: (feature, layer) => {
                    const { name, alt_name, latitude, longitude } =
                        feature.properties;
                    layer.bindPopup(
                        `<h3>${name}</h3>
                        <p><strong>Alt Name:</strong> ${alt_name}</p>
                        <p><strong>Latitude:</strong> ${latitude}</p>
                        <p><strong>Longitude:</strong> ${longitude}</p>`
                    );
                },
            }).addTo(map);
        })
        .catch((err) => console.error("Error loading GeoJSON:", err));
});
