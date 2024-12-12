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
  name: "informations",
  components: {
    ArticleItem,
  },
  data() {
    return {
      articles: [],
    };
  },
  async mounted() {
    const newsUrl = "/news";
    const typesUrl = "/news_categories";

    try {
      const [newsResponse, typesResponse] = await Promise.all([
        apiClient.get(newsUrl),
        apiClient.get(typesUrl),
      ]);

      const types = typesResponse.data.member;

      // Créez un objet pour mapper les catégories par leur ID
      const categoriesMap = types.reduce((acc, category) => {
        acc[category["@id"]] = category;
        return acc;
      }, {});

      // Ajoutez la gravité et filtrez les articles récents
      this.articles = newsResponse.data.member
        .map((item) => {
          const category = categoriesMap[item.type];
          return {
            ...item,
            pictureUrl: `http://127.0.0.1:8000/build/images/${item.picture}`,
            gravity: category ? parseInt(category.gravity, 10) : null,
            type: category ? category.type : null,
          };
        })
        .filter((item) => {
          // Filtrer les articles récents pour les catégories "Urgente" et "Sécurité"
          if (item.type === "Urgente" || item.type === "Sécurité") {
            return this.isRecent(item.created_at);
          }
          // Toujours afficher les articles des catégories "Générale" et "Actualité"
          return item.type === "Générale" || item.type === "Actualité";
        })
        .filter((item) => item.publish); // Filtrer les articles publiés

      // Triez les articles par gravité du plus grand au plus petit
      this.articles.sort((a, b) => b.gravity - a.gravity);

      console.log(this.articles);
    } catch (error) {
      console.log("Erreur lors de la récupération des articles :", error);
    }
  },
  methods: {
    isRecent(date) {
      const articleDate = new Date(date);
      const currentDate = new Date();
      const diffTime = Math.abs(currentDate - articleDate);
      const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
      return diffDays <= 3;
    },
  },
};
</script>
