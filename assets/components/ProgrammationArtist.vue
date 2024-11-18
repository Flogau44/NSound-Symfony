<template>
  <div
    id="slider2"
    class="splide px-16 md:px-20"
    role="group"
    aria-label="Splide Basic HTML Example"
  >
    <div class="splide__track">
      <ul class="splide__list" id="slider2-list">
        <li v-for="item in items" :key="item.id" class="splide__slide">
          <router-link
            :to="{ name: 'ArtisteDetail', params: { id: item.id } }"
            class="artistProg"
            :title="item['_embedded']['wp:featuredmedia'][0]['slug']"
          >
            <img
              :src="item['_embedded']['wp:featuredmedia'][0]['source_url']"
              class="imgArtistsProg"
              :alt="item['_embedded']['wp:featuredmedia'][0]['slug']"
            />
            <div class="descriptionArtist">
              <h2 class="nameArtist">{{ item.title.rendered }}</h2>
              <p class="dateArtists">{{ item.class_list[11].slice(11) }}</p>
            </div>
          </router-link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProgrammationArtist",
  data() {
    return {
      items: [],
    };
  },
  async mounted() {
    await this.updateData();
    this.$nextTick(() => {
      new Splide("#slider2", {
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
  },
  methods: {
    async updateData() {
      const restUrl =
        "https://flo-perso.alwaysdata.net/nationsound/wordpress/wp-json/wp/v2/posts?_embed&categories=4&per_page=12";
      try {
        const response = await fetch(restUrl);
        const data = await response.json();
        this.items = data;
      } catch (error) {
        console.log(error, "erreur");
      }
    },
  },
};
</script>
