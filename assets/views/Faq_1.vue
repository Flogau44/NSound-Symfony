<template>
  <main class="max-h-full pt-0 md:pt-2">
    <h1 class="my-4 uppercase flex justify-center">— Infos Pratiques —</h1>
    <Nav_sub />>
    <section class="px-4 mb-10 md:px-16">
      <FaqItem />
    </section>
  </main>
</template>

<script>
import FaqItem from "../components/FaqItem.vue";

export default {
  name: "Faq_1",
  components: {
    FaqItem,
  },
  mounted() {},
};
</script>
