<template>
  <main class="max-h-full pt-0 md:pt-2">
    <section class="mt-6">
      <div class="ml-6 mb-6 flex flex-row justify-start">
        <button
          id="filterButtonArticle"
          type="button"
          class="h-10 px-5 rounded-md outline-none transition-colors duration-700 text-xl font-bold"
        >
          <router-link
            :to="{ name: 'Informations' }"
            title="Revenir aux actualités"
          >
            Revenir aux actualités
          </router-link>
        </button>
      </div>
      <section id="article" v-if="article">
        <img :src="article.pictureUrl" class="imgArticle" />
        <div class="informationArticle">
          <div class="headerArticle">
            <h1 class="titleArticle">{{ article.title }}</h1>
            <p class="dateArticle">{{ article.date }}</p>
          </div>
          <div class="resumeArticle" v-html="article.content"></div>
          <div>
            <a :href="article.url" class="urlArticle" target="_blank">{{
              article.url
            }}</a>
          </div>
        </div>
      </section>
    </section>
  </main>
</template>

<script>
import apiClient from "../axios";

export default {
  name: "ArticleDetail",
  data() {
    return {
      article: null,
    };
  },
  async mounted() {
    const id = this.$route.params.id;
    const restUrl = "/news";

    try {
      const response = await apiClient.get(restUrl);
      const item = response.data.member.find((news) => news.id == id);
      this.article = {
        title: item.title,
        content: item.content,
        url: item.url,
        pictureUrl: `http://127.0.0.1:8000/build/images/${item.picture}`,
        date: new Date(item.created_at).toLocaleDateString("fr-FR", {
          year: "numeric",
          month: "numeric",
          day: "numeric",
        }),
      };
    } catch (error) {
      console.log("Erreur lors de la récupération de l'article :", error);
    }
  },
};
</script>
