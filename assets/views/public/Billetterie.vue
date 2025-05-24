<template>
  <main class="max-h-full pt-0 md:pt-2">
    <section class="mt-6">
      <div class="mb-4 flex flex-row justify-center">
        <h1 class="uppercase">— Billetterie —</h1>
      </div>
      <EventixShop
        shopUrl="https://shop.eventix.io/a30cb309-6515-11ef-a9cb-7e126431635e"
      />
    </section>
  </main>
</template>

<script>
import EventixShop from "../../components/EventixShop.vue";

export default {
  components: {
    EventixShop,
  },
};
</script>
