<template>
  <article class="article">
    <router-link
      :to="{ name: 'ArticleDetail', params: { id: item.id } }"
      class="linkArticle"
      :title="item.title"
    >
      <img :src="item.pictureUrl" class="imgArticles" :alt="item.slug" />
      <div class="descriptionArticle">
        <h2 class="titleArticle">{{ item.title }}</h2>
        <p class="dateArticle">
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
    formateDate(maDate) {
      const event = new Date(maDate);
      const options = { year: "numeric", month: "numeric", day: "numeric" };
      return event.toLocaleDateString("fr-FR", options);
    },
  },
};
</script>
