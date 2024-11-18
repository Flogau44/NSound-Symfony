<template>
  <article class="article">
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
        <h2 class="titleArticle">{{ item.title.rendered }}</h2>
        <p class="dateArticle">{{ formateDate(item.date) }}</p>
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
