<template>
  <!-- Conteneur pour la carte -->
  <div id="myMap" class="my-6 flex justify-center"></div>
</template>

<script>
import apiClient from "../axios";

export default {
  name: "Map",
  data() {
    return {
      // Initialisation des données
      markers: [],
      polygons: [],
      myMap: null,
    };
  },
  async mounted() {
    const markersUrl = "/markers"; // URL pour les markers
    const polygonsUrl = "/polygons"; // URL pour les polygones

    try {
      const [markersResponse, polygonsResponse] = await Promise.all([
        apiClient.get(markersUrl),
        apiClient.get(polygonsUrl),
      ]);

      // Afficher les réponses pour débogage
      console.log("Markers Response:", markersResponse.data.member);
      console.log("Polygons Response:", polygonsResponse.data.member);

      // Vérifiez que les données sont bien des tableaux
      this.markers = Array.isArray(markersResponse.data.member)
        ? markersResponse.data.member
        : [];
      this.polygons = Array.isArray(polygonsResponse.data.member)
        ? polygonsResponse.data.member
        : [];

      // Initialiser la carte après avoir récupéré les données
      this.initMap();
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  methods: {
    initMap() {
      // Initialise la carte
      this.myMap = L.map("myMap", {
        center: [49.05466, 2.37556],
        zoom: 13.5,
        fullscreenControl: true,
      });

      // Charge les tuiles OpenStreetMap
      L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution:
          '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        minZoom: 10,
        maxZoom: 18,
      }).addTo(this.myMap);

      var markerGroups = {};

      // Ajoute les markers à la carte
      this.markers.forEach((marker) => {
        console.log(
          "Adding marker with coordinates:",
          marker.latitude,
          marker.longitude
        );
        console.log("Marker icon URL:", `/build/images/${marker.iconUrl}`);

        var markerIcon = L.icon({
          iconUrl: `/build/images/${marker.iconUrl}`, // Utilisation du chemin relatif correct
          iconSize: [25, 25],
          iconAnchor: [0, 25],
          popupAnchor: [0, -25],
        });

        var newMarker = L.marker([marker.longitude, marker.latitude], {
          icon: markerIcon,
        }) // Correction des coordonnées inversées
          .bindPopup(marker.popup)
          .addTo(this.myMap);

        if (!markerGroups[marker.title]) {
          markerGroups[marker.title] = [];
        }
        markerGroups[marker.title].push(newMarker);
      });

      // Ajoute les polygones à la carte
      this.polygons.forEach((polygon) => {
        const coordinates = polygon.coordinates.map((coord) =>
          coord.split(", ").map(Number)
        );
        L.polygon(coordinates, {
          color: polygon.colors,
        }).addTo(this.myMap);
      });

      var overlayMaps = {};
      // Crée les groupes de layers pour la légende
      Object.keys(markerGroups).forEach((type) => {
        const iconUrl = markerGroups[type][0].options.icon.options.iconUrl;
        overlayMaps[
          `<div class='layers-control-img'><img src='${iconUrl}'/></div>${type}`
        ] = L.layerGroup(markerGroups[type]);
      });

      // Ajoute la légende à la carte
      var layerControl = L.control
        .layers({}, overlayMaps, {
          position: "topright",
          //collapsed: false,
        })
        .addTo(this.myMap);

      // Ajoute tous les groupes de markers à la carte pour que les checkboxes soient cochées par défaut
      Object.values(overlayMaps).forEach((layer) => {
        layer.addTo(this.myMap);
      });

      layerControl.expand();
    },
  },
};
</script>
