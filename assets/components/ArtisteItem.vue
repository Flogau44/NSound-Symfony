<template>
  <div id="artists">
    <article
      v-for="item in artists"
      :key="item.id"
      class="artist"
      :data-name="item.class_list[10].slice(9)"
    >
      <router-link
        :to="{ name: 'ArtisteDetail', params: { id: item.id } }"
        class="linkArtist"
        :title="item._embedded['wp:featuredmedia'][0].slug"
      >
        <img
          :src="item._embedded['wp:featuredmedia'][0].source_url"
          class="imgArtists"
          :alt="item._embedded['wp:featuredmedia'][0].slug"
        />
        <div class="descriptionArtist">
          <h2 class="nameArtist">{{ item.title.rendered }}</h2>
          <p class="dateArtists">{{ item.class_list[11].slice(11) }}</p>
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
                :title="artist._embedded['wp:featuredmedia'][0].slug"
              >
                <img
                  :src="artist._embedded['wp:featuredmedia'][0].source_url"
                  class="imgArtistHour"
                  :alt="artist._embedded['wp:featuredmedia'][0].slug"
                />
                <div class="descriptionArtistHour">
                  <h2 class="nameArtistHour">{{ artist.title.rendered }}</h2>
                  <p class="horaireArtistHour">
                    {{ artist.class_list[9].slice(11) }}
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
import { ref, onMounted } from "vue";

export default {
  name: "Programmation",
  setup() {
    const artists = ref([]);
    const scenes = ref([]);

    function getDayName(dateString) {
      const [day, month, year] = dateString.split("/");
      const date = new Date(`${year}-${month}-${day}`);
      return date.toLocaleDateString("fr-FR", { weekday: "long" });
    }

    // Convertir une date JJ/MM/AAAA en JJ Mois AAAA
    function convertDate(dateString) {
      const [jour, moisIndex, annee] = dateString.split("/");
      const date = new Date(`${annee}-${moisIndex}-${jour}`);
      return date.toLocaleDateString("fr-FR", {
        day: "numeric",
        month: "long",
        year: "numeric",
      });
    }

    const fetchArtists = async () => {
      const restUrl =
        "https://flo-perso.alwaysdata.net/nationsound/wordpress/wp-json/wp/v2/posts?_embed&categories=4&per_page=60";
      try {
        const response = await fetch(restUrl);
        const data = await response.json();
        artists.value = data.filter(
          (a) => a.class_list[7] === "category-artiste"
        );

        const sceneNames = [
          "mainstage-1",
          "mainstage-2",
          "sonata",
          "resonance",
          "reverb",
        ];
        const days = ["11/07/2025", "12/07/2025", "13/07/2025"];
        const sceneData = sceneNames.map((scene) => {
          const sceneArtists = artists.value.filter(
            (a) => a.class_list[8] === `category-scene-${scene}`
          );
          const dayData = days.map((day) => {
            const dayArtists = sceneArtists.filter((a) =>
              a._embedded["wp:term"][0][4].name.includes(day)
            );
            // Tri des artistes par horaire en ordre croissant
            dayArtists.sort((a, b) => {
              const timeA = a.class_list[9].slice(11);
              const timeB = b.class_list[9].slice(11);
              return timeA.localeCompare(timeB);
            });
            return { date: day, artists: dayArtists };
          });
          return { name: scene, days: dayData };
        });
        scenes.value = sceneData;
      } catch (error) {
        console.error("Erreur lors de la récupération des artistes :", error);
      }
    };

    onMounted(fetchArtists);

    return {
      artists,
      scenes,
      getDayName,
      convertDate,
    };
  },
};
</script>
