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
  mounted() {
    const restUrl =
      "https://flo-perso.alwaysdata.net/nationsound/wordpress/wp-json/wp/v2/posts?_embed&categories=5&per_page=60";

    const updateData = async () => {
      try {
        const reponseJSON = await fetch(restUrl);
        const reponseJS = await reponseJSON.json();
        this.articles = reponseJS;
      } catch (error) {
        console.log(error, "erreur");
      }
    };

    updateData();
  },
};
</script>
