// INICIA MAPA
const map = L.map('map').setView(
    [-23.550520, -46.633308],
    12
);


// TILE LAYER
L.tileLayer(
    'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png',
    {
        attribution: '&copy; OpenStreetMap & CartoDB',
        subdomains: 'abcd',
        maxZoom: 20
    }
).addTo(map);


// ICONES
const iconeDoador = L.divIcon({
    className: 'custom-marker doador',
    html: '<div class="pin"></div>',
    iconSize: [20, 20],
    iconAnchor: [10, 20]
});

const iconeReceptor = L.divIcon({
    className: 'custom-marker receptor',
    html: '<div class="pin"></div>',
    iconSize: [20, 20],
    iconAnchor: [10, 20]
});


// MARCADORES
locais.forEach(local => {

    const marker = L.marker(
        [local.lat, local.lng],
        {
            icon:
                local.tipo === 'doador'
                ? iconeDoador
                : iconeReceptor
        }
    ).addTo(map);

    marker.bindPopup(`
        <strong>${local.nome}</strong><br>
        Tipo: ${local.tipo}
    `);

});