<template>
  <main class="max-h-full pt-0 md:pt-2">
    <section class="mt-6">
      <div class="ml-6 mb-6 flex flex-row justify-start">
        <button
          id="filterButtonArtist"
          type="button"
          class="h-10 px-5 rounded-md outline-none transition-colors duration-700 text-xl font-bold"
        >
          <router-link
            :to="{ name: 'Programmation' }"
            title="Revenir aux artistes"
          >
            Revenir à la programmation
          </router-link>
        </button>
      </div>
      <section id="artist" v-if="artist">
        <img
          :src="artist.pictureUrl"
          :alt="artist.pictureAlt"
          class="imgArtist"
        />
        <div class="informationArtist">
          <div class="headerArtist">
            <h1 class="nameArtist">{{ artist.title }}</h1>
            <p class="genreArtist">{{ artist.genres.join(", ") }}</p>
          </div>
          <div class="concertArtist">
            <p class="dateArtist">{{ artist.date }}</p>
            <p class="horaireArtist">{{ artist.horaire }}</p>
            <p class="sceneArtist">{{ artist.scene }}</p>
          </div>
          <div class="urlsArtist" v-html="artist.url"></div>
          <div class="resumeArtist" v-html="artist.content"></div>
          <div class="pt-6 flex justify-center" v-html="artist.video"></div>
        </div>
      </section>
    </section>
  </main>
</template>

<script>
import apiClient from "../../axios";

export default {
  name: "ArtisteDetail",
  data() {
    return {
      artist: null,
    };
  },
  async mounted() {
    const id = this.$route.params.id;
    const concertDetailsUrl = "/concert_details";
    const artistsUrl = "/artists";
    const genresUrl = "/genres";
    const scenesUrl = "/scenes";
    const datesUrl = "/dates";
    const schedulesUrl = "/schedules";

    try {
      // Récupérer les données de l'API
      const [
        concertDetailsResponse,
        artistResponse,
        genreResponse,
        sceneResponse,
        dateResponse,
        scheduleResponse,
      ] = await Promise.all([
        apiClient.get(concertDetailsUrl),
        apiClient.get(artistsUrl),
        apiClient.get(genresUrl),
        apiClient.get(scenesUrl),
        apiClient.get(datesUrl),
        apiClient.get(schedulesUrl),
      ]);

      // Trouver les détails du concert correspondant
      const concertDetails = concertDetailsResponse.data.member.find(
        (detail) => detail.id == id
      );

      // Trouver l'artiste correspondant
      const artist = artistResponse.data.member.find(
        (item) => item["@id"] === concertDetails.artist
      );

      // Trouver les genres correspondants
      const genres = genreResponse.data.member
        .filter((item) => artist.genres.includes(item["@id"]))
        .map((item) => item.genre);

      // Trouver la scène correspondante
      const scene = sceneResponse.data.member.find(
        (item) => item["@id"] === concertDetails.scene
      );

      // Trouver la date correspondante
      const date = dateResponse.data.member.find(
        (item) => item["@id"] === concertDetails.date
      );

      // Trouver l'horaire correspondant
      const schedule = scheduleResponse.data.member.find(
        (item) => item["@id"] === concertDetails.schedule
      );

      // Assigner les données de l'artiste
      this.artist = {
        title: artist.name,
        genres: genres,
        content: artist.content,
        video: artist.video,
        pictureUrl: `/build/images/${artist.picture}`,
        pictureAlt: artist.slug,
        url: artist.url,
        date: new Date(date.date).toLocaleDateString("fr-FR", {
          year: "numeric",
          month: "numeric",
          day: "numeric",
        }),
        horaire: schedule.schedule,
        scene: scene.name,
      };
    } catch (error) {
      console.error("Erreur lors de la récupération de l'artiste :", error);
    }
  },
};
</script>
