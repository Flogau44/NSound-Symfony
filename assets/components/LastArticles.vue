<template>
  <section
    id="articles"
    class="intersect:animate-fade-up intersect:animate-duration-1000 intersect:animate-delay-500"
  >
    <article v-for="item in articles" :key="item.id" class="article">
      <router-link
        :to="{ name: 'ArticleDetail', params: { id: item.id } }"
        class="linkArticle"
        :title="item.title"
      >
        <img :src="item.pictureUrl" class="imgArticles" :alt="item.slug" />
        <div class="descriptionArticle">
          <h2 class="titleLastArticle">{{ item.title }}</h2>
          <p class="dateLastArticle">
            {{ formatDate(item.created_at) }}
          </p>
        </div>
      </router-link>
    </article>
  </section>
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
      this.articles = response.data.member
        .map((item) => {
          return {
            ...item,
            pictureUrl: `http://127.0.0.1:8000/build/images/${item.picture}`,
          };
        })
        .sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
        .slice(0, 3);
      console.log(response);
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
