<template>
  <main class="max-h-full pt-0 md:pt-2">
    <section class="mt-6 flex flex-col justify-center items-center">
      <div class="mb-6">
        <h1 class="uppercase">— Actualités —</h1>
      </div>
      <!--Afficher tous les articles-->
      <section id="articles">
        <ArticleItem v-for="item in articles" :key="item.id" :item="item" />
      </section>
    </section>
  </main>
</template>

<script>
import ArticleItem from "../components/ArticleItem.vue";
import apiClient from "../axios";

export default {
  name: "Informations",
  components: {
    ArticleItem,
  },
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
      console.log(response);
    } catch (error) {
      console.log("Erreur lors de la récupération des articles :", error);
    }
  },
};
</script>
