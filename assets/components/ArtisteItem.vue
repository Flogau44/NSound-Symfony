<template>
  <div id="artists">
    <article
      v-for="item in artists"
      :key="item.id"
      class="artist"
      :data-name="item.date ? item.date.slice(0, 10) : ''"
    >
      <router-link
        :to="{ name: 'ArtisteDetail', params: { id: item.id } }"
        class="linkArtist"
        :title="item.slug"
      >
        <img
          :src="
            item.picture
              ? `http://127.0.0.1:8000/build/images/${item.picture}`
              : ''
          "
          class="imgArtists"
          :alt="item.slug"
        />
        <div class="descriptionArtist">
          <h2 class="nameArtist">{{ item.name }}</h2>
          <p class="dateArtists">
            {{ item.date ? formatDate(item.date) : "" }}
          </p>
        </div>
      </router-link>
    </article>
  </div>
  <div id="planning" style="display: none">
    <div
      v-for="scene in scenes"
      :key="scene.name"
      class="sceneContainer"
      :data-scene="scene.name"
    >
      <h2 class="nameScene">{{ scene.name.toUpperCase() }}</h2>
      <div class="sceneArtists">
        <div v-for="day in scene.days" :key="day.date" class="dayContainer">
          <div class="dayArtist">
            <h3 class="day">{{ getDayName(day.date) }}</h3>
            <h4 class="dayMonthYear">{{ convertDate(day.date) }}</h4>
          </div>
          <div class="dayArtists">
            <article
              v-for="artist in day.artists"
              :key="artist.id"
              class="artistHour"
            >
              <router-link
                :to="{ name: 'ArtisteDetail', params: { id: artist.id } }"
                class="linkArtistHour"
                :title="artist.slug"
              >
                <img
                  :src="
                    artist.picture
                      ? `http://127.0.0.1:8000/build/images/${artist.picture}`
                      : ''
                  "
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
      artists: [],
      scenes: [],
    };
  },
  async mounted() {
    const concertDetailsUrl = "/concert_details";
    const artistsUrl = "/artists";
    const scenesUrl = "/scenes";
    const datesUrl = "/dates";
    const schedulesUrl = "/schedules";

    try {
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

      console.log(concertDetails);
      console.log(artistsData);
      console.log(scenesData);
      console.log(datesData);
      console.log(schedulesData);

      const sceneNames = scenesData.map((scene) => scene.name);
      const days = datesData.map((date) => date.date.split("T")[0]);

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
    getDayName(dateString) {
      const [year, month, day] = dateString.split("-");
      const date = new Date(`${year}-${month}-${day}`);
      return date.toLocaleDateString("fr-FR", { weekday: "long" });
    },
    convertDate(dateString) {
      const [year, month, day] = dateString.split("-");
      const date = new Date(`${year}-${month}-${day}`);
      return date.toLocaleDateString("fr-FR", {
        day: "numeric",
        month: "long",
        year: "numeric",
      });
    },
    getDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleDateString("fr-FR", {
        year: "numeric",
        month: "long",
        day: "numeric",
      });
    },
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
