<template>
  <main class="max-h-full pt-0 md:pt-2">
    <section class="mt-6">
      <div class="ml-6 mb-6 flex flex-row justify-start">
        <!-- Bouton pour revenir aux actualités -->
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
        <!-- Image de l'article -->
        <img :src="article.pictureUrl" class="imgArticle" />
        <div class="informationArticle">
          <div class="headerArticle">
            <h1 class="titleArticle">{{ article.title }}</h1>
            <p class="dateArticle">{{ article.date }}</p>
          </div>
          <!-- Contenu de l'article -->
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
import apiClient from "../../axios";

export default {
  name: "ArticleDetail",
  data() {
    return {
      article: null, // Détails de l'article
    };
  },
  async mounted() {
    const id = this.$route.params.id;
    const isAuthenticated = this.$store.getters.isAuthenticated; // Vérifie la connexion
    const restUrl = "/news";

    try {
      const response = await apiClient.get(restUrl);
      const item = response.data.member.find((news) => news.slug == id);

      if (!item) {
        console.warn("Article introuvable :", id);
        this.$router.push({ name: "NotFound" }); // Redirige si l'article n'existe pas
        return;
      }

      // Extraction de l'ID de la catégorie
      const articleCategoryId = parseInt(item.type.split("/").pop(), 10);

      // Bloquer les visiteurs qui accèdent à un article "Actualité"
      if (articleCategoryId === 4 && !isAuthenticated) {
        console.warn(
          "Accès interdit à un article 'Actualité' pour un visiteur."
        );
        this.$router.push({ name: "NotFound" }); // Redirection vers NotFound.vue
        return;
      }

      // Formatage des données
      this.article = {
        title: item.title,
        content: item.content,
        url: item.url,
        pictureUrl: `/build/images/${item.picture}`,
        date: new Date(item.created_at).toLocaleDateString("fr-FR", {
          year: "numeric",
          month: "numeric",
          day: "numeric",
        }),
      };
    } catch (error) {
      console.log("Erreur lors de la récupération de l'article :", error);
      this.$router.push({ name: "NotFound" }); // Redirection en cas d'erreur API
    }
  },
};
</script>
