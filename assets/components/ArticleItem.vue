<template>
  <!-- Article contenant un lien vers le détail de l'article -->
  <article class="article">
    <router-link
      :to="{ name: 'ArticleDetail', params: { id: item.id } }"
      class="linkArticle"
      :title="item.title"
    >
      <!-- Image de l'article -->
      <img :src="item.pictureUrl" class="imgArticles" :alt="item.slug" />
      <div class="descriptionArticle">
        <h2 class="titleArticle">{{ item.title }}</h2>
        <p class="dateArticle">
          <!-- Formate la date de création de l'article -->
          {{ formateDate(item.created_at) }}
        </p>
      </div>
    </router-link>
  </article>
</template>

<script>
export default {
  name: "ArticleItem",
  props: {
    item: {
      type: Object,
      required: true,
    },
  },
  methods: {
    // Formate la date au format français
    formateDate(maDate) {
      const event = new Date(maDate);
      const options = { year: "numeric", month: "numeric", day: "numeric" };
      return event.toLocaleDateString("fr-FR", options);
    },
  },
};
</script>
