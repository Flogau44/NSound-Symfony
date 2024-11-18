<template>
  <section
    id="articles"
    class="intersect:animate-fade-up intersect:animate-duration-1000 intersect:animate-delay-500"
  >
    <article v-for="item in articles" :key="item.id" class="article">
      <router-link
        :to="{ name: 'ArticleDetail', params: { id: item.id } }"
        class="linkArticle"
        :title="item['_embedded']['wp:featuredmedia'][0]['slug']"
      >
        <img
          :src="item['_embedded']['wp:featuredmedia'][0]['source_url']"
          class="imgArticles"
          :alt="item['_embedded']['wp:featuredmedia'][0]['slug']"
        />
        <div class="descriptionArticle">
          <h2 class="titleLastArticle">{{ item.title.rendered }}</h2>
          <p class="dateLastArticle">{{ formateDate(item.date) }}</p>
        </div>
      </router-link>
    </article>
  </section>
</template>

<script>
import { ref, onMounted } from "vue";

export default {
  name: "LastArticles",
  setup() {
    const articles = ref([]);

    const formateDate = (maDate) => {
      const event = new Date(maDate);
      const options = { year: "numeric", month: "numeric", day: "numeric" };
      return event.toLocaleDateString("fr-FR", options);
    };

    const fetchArticles = async () => {
      const restUrl2 =
        "https://flo-perso.alwaysdata.net/nationsound/wordpress/wp-json/wp/v2/posts?_embed&categories=5&per_page=3";
      try {
        const response = await fetch(restUrl2);
        const data = await response.json();
        articles.value = data;
      } catch (error) {
        console.error("Erreur lors de la récupération des articles :", error);
      }
    };

    onMounted(fetchArticles);

    return {
      articles,
      formateDate,
    };
  },
};
</script>
