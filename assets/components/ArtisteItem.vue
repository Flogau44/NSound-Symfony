<template>
  <div id="artists">
    <!-- Boucle sur les artistes pour les afficher -->
    <article
      v-for="item in artists"
      :key="item.id"
      class="artist"
      :data-name="item.date ? item.date.slice(0, 10) : ''"
    >
      <!-- Lien vers le détail de l'artiste -->
      <router-link
        :to="{ name: 'ArtisteDetail', params: { id: item.id } }"
        class="linkArtist"
        :title="item.slug"
      >
        <!-- Image de l'artiste -->
        <img
          :src="item.picture ? `/build/images/${item.picture}` : ''"
          class="imgArtists"
          :alt="item.slug"
        />
        <div class="descriptionArtist">
          <h2 class="nameArtist">{{ item.name }}</h2>
          <p class="dateArtists">
            <!-- Formate la date de l'artiste -->
            {{ item.date ? formatDate(item.date) : "" }}
          </p>
        </div>
      </router-link>
    </article>
  </div>
  <div id="planning" style="display: none">
    <!-- Boucle sur les scènes pour les afficher -->
    <div
      v-for="scene in scenes"
      :key="scene.name"
      class="sceneContainer"
      :data-scene="scene.name"
    >
      <h2 class="nameScene">{{ scene.name.toUpperCase() }}</h2>
      <div class="sceneArtists">
        <!-- Boucle sur les jours pour les afficher -->
        <div v-for="day in scene.days" :key="day.date" class="dayContainer">
          <div class="dayArtist">
            <h3 class="day">{{ getDayName(day.date) }}</h3>
            <h4 class="dayMonthYear">{{ convertDate(day.date) }}</h4>
          </div>
          <div class="dayArtists">
            <!-- Boucle sur les artistes du jour pour les afficher -->
            <article
              v-for="artist in day.artists"
              :key="artist.id"
              class="artistHour"
            >
              <!-- Lien vers le détail de l'artiste -->
              <router-link
                :to="{ name: 'ArtisteDetail', params: { id: artist.id } }"
                class="linkArtistHour"
                :title="artist.slug"
              >
                <!-- Image de l'artiste -->
                <img
                  :src="artist.picture ? `/build/images/${artist.picture}` : ''"
                  class="imgArtistHour"
                  :alt="artist.slug"
                />
                <div class="descriptionArtistHour">
                  <h2 class="nameArtistHour">{{ artist.name }}</h2>
                  <p class="horaireArtistHour">
                    {{ artist.schedule }}
                  </p>
                </div>
              </router-link>
            </article>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import apiClient from "../axios";

export default {
  name: "Programmation",
  data() {
    return {
      artists: [], // Liste des artistes
      scenes: [], // Liste des scènes
    };
  },
  async mounted() {
    const concertDetailsUrl = "/concert_details";
    const artistsUrl = "/artists";
    const scenesUrl = "/scenes";
    const datesUrl = "/dates";
    const schedulesUrl = "/schedules";

    try {
      // Récupère les détails des concerts, les artistes, les scènes, les dates et les horaires
      const [
        concertDetailsResponse,
        artistsResponse,
        scenesResponse,
        datesResponse,
        schedulesResponse,
      ] = await Promise.all([
        apiClient.get(concertDetailsUrl),
        apiClient.get(artistsUrl),
        apiClient.get(scenesUrl),
        apiClient.get(datesUrl),
        apiClient.get(schedulesUrl),
      ]);

      const concertDetails = concertDetailsResponse.data.member.filter(
        (detail) => detail.publish
      );
      const artistsData = artistsResponse.data.member;
      const scenesData = scenesResponse.data.member;
      const datesData = datesResponse.data.member;
      const schedulesData = schedulesResponse.data.member;

      const sceneNames = scenesData.map((scene) => scene.name);
      const days = datesData.map((date) => date.date.split("T")[0]);

      // Associe chaque scène à ses artistes et horaires
      const sceneData = sceneNames.map((scene) => {
        const sceneArtists = concertDetails
          .filter(
            (detail) =>
              scenesData.find((s) => s["@id"] === detail.scene)?.name === scene
          )
          .map((detail) => {
            const artist = artistsData.find((a) => a["@id"] === detail.artist);
            const schedule = schedulesData.find(
              (s) => s["@id"] === detail.schedule
            );
            const date = datesData.find((d) => d["@id"] === detail.date)?.date;
            return {
              ...artist,
              schedule: schedule?.schedule,
              date: date,
            };
          });

        // Associe chaque jour à ses artistes
        const dayData = days.map((day) => {
          const dayArtists = sceneArtists.filter((artist) =>
            artist.date.includes(day)
          );
          dayArtists.sort((a, b) => {
            const timeA = a.schedule;
            const timeB = b.schedule;
            return timeA.localeCompare(timeB);
          });
          return { date: day, artists: dayArtists };
        });

        return { name: scene, days: dayData };
      });

      // Filtre les artistes visibles
      const visibleArtists = concertDetails.map((detail) => {
        const artist = artistsData.find((a) => a["@id"] === detail.artist);
        const date = datesData.find((d) => d["@id"] === detail.date)?.date;
        return { ...artist, date: date };
      });

      this.artists = visibleArtists;
      this.scenes = sceneData;
    } catch (error) {
      console.error("Erreur lors de la récupération des artistes :", error);
    }
  },
  methods: {
    // Récupère le nom du jour à partir de la date
    getDayName(dateString) {
      const [year, month, day] = dateString.split("-");
      const date = new Date(`${year}-${month}-${day}`);
      return date.toLocaleDateString("fr-FR", { weekday: "long" });
    },
    // Convertit la date au format français
    convertDate(dateString) {
      const [year, month, day] = dateString.split("-");
      const date = new Date(`${year}-${month}-${day}`);
      return date.toLocaleDateString("fr-FR", {
        day: "numeric",
        month: "long",
        year: "numeric",
      });
    },
    // Formate la date au format français
    formatDate(dateString) {
      const date = new Date(dateString);
      const day = String(date.getDate()).padStart(2, "0");
      const month = String(date.getMonth() + 1).padStart(2, "0");
      const year = date.getFullYear();
      return `${day}-${month}-${year}`;
    },
  },
};
</script>
