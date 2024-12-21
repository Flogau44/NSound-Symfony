<template>
  <div
    id="slider3"
    class="splide px-16 md:px-20"
    role="group"
    aria-label="Splide Basic HTML Example"
  >
    <div class="splide__track">
      <ul class="splide__list" id="slider3-list">
        <!-- Boucle sur les artistes pour les afficher -->
        <li v-for="item in artists" :key="item.id" class="splide__slide">
          <!-- Lien vers le détail de l'artiste -->
          <router-link
            :to="{ name: 'ArtisteDetail', params: { id: item.id } }"
            class="artistProg"
            :title="item.slug"
          >
            <!-- Image de l'artiste -->
            <img
              :src="`/build/images/${item.picture}`"
              class="imgArtistsProg"
              :alt="item.slug"
            />
            <div class="descriptionArtist">
              <h2 class="nameArtist">{{ item.name }}</h2>
              <p class="dateArtists">{{ formatDate(item.date) }}</p>
            </div>
          </router-link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import apiClient from "../axios";

export default {
  name: "ProgrammationArtist",
  data() {
    return { artists: [] };
  },
  async mounted() {
    const concertDetailsUrl = "/concert_details";
    const artistsUrl = "/artists";
    const datesUrl = "/dates";
    try {
      const [concertDetailsResponse, artistsResponse, datesResponse] =
        await Promise.all([
          apiClient.get(concertDetailsUrl),
          apiClient.get(artistsUrl),
          apiClient.get(datesUrl),
        ]);
      const concertDetails = concertDetailsResponse.data.member.filter(
        (detail) => detail.publish
      );
      const artistsData = artistsResponse.data.member;
      const datesData = datesResponse.data.member;

      const visibleArtists = concertDetails.map((detail) => {
        const artist = artistsData.find((a) => a["@id"] === detail.artist);
        const date = datesData.find((d) => d["@id"] === detail.date)?.date;
        return { ...artist, date: date };
      });

      this.artists = visibleArtists.slice(0, 12);

      // Initialiser le carrousel Splide
      this.$nextTick(() => {
        new Splide("#slider3", {
          type: "loop",
          focus: 0,
          pagination: false,
          perPage: 6,
          gap: "20px",
          breakpoints: {
            1280: { perPage: 5, gap: "10px" },
            1024: { perPage: 4 },
            768: { perPage: 3 },
            640: { perPage: 2 },
            480: { perPage: 1 },
          },
        }).mount();
      });
    } catch (error) {
      console.error("Erreur lors de la récupération des artistes :", error);
    }
  },
  methods: {
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
