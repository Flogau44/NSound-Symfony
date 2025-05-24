<template>
  <main class="max-h-full pt-0 md:pt-2">
    <div class="flex flex-row justify-center">
      <h1 class="py-2 uppercase">— F.a.q. —</h1>
    </div>
    <section class="mt-2 mb-10 mx-4 md:mx-40">
      <FaqItem />
    </section>
  </main>
</template>

<script>
import FaqItem from "../../components/FaqItem.vue";

export default {
  name: "Faq",
  components: {
    FaqItem,
  },
  mounted() {},
};
</script>
