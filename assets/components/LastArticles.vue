<template>
  <div
    id="slider3"
    class="splide px-16 md:px-20"
    role="group"
    aria-label="Splide Basic HTML Example"
  >
    <div class="splide__track">
      <ul class="splide__list" id="slider3-list">
        <li v-for="item in articles" :key="item.id" class="splide__slide">
          <router-link
            :to="{ name: 'ArticleDetail', params: { id: item.id } }"
            class="articleCarousel"
            :title="item.title"
          >
            <img
              :src="item.pictureUrl"
              class="imgArticlesCarousel"
              :alt="item.slug"
            />
            <div class="descriptionArticleCarousel">
              <h2 class="titleLastArticle">{{ item.title }}</h2>
              <p class="dateLastArticle">
                {{ formatDate(item.created_at) }}
              </p>
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
  name: "Informations",
  data() {
    return {
      articles: [],
    };
  },
  async mounted() {
    const restUrl = "/news";

    try {
      const response = await apiClient.get(restUrl);
      this.articles = response.data.member.map((item) => {
        return {
          ...item,
          pictureUrl: `http://127.0.0.1:8000/build/images/${item.picture}`,
        };
      });
      this.$nextTick(() => {
        new Splide("#slider3", {
          type: "loop",
          drag: "free",
          perPage: 4,
          gap: "20px",
          breakpoints: {
            1280: { perPage: 3, gap: "10px" },
            1024: { perPage: 2 },
            480: { perPage: 1 },
          },
        }).mount();
      });
    } catch (error) {
      console.log("Erreur lors de la récupération des articles :", error);
    }
  },
  methods: {
    formatDate(maDate) {
      const event = new Date(maDate);
      const options = { year: "numeric", month: "numeric", day: "numeric" };
      return event.toLocaleDateString("fr-FR", options);
    },
  },
};
</script>
