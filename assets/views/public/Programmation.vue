<template>
  <main class="max-h-full pt-0 md:pt-2">
    <section class="mt-6">
      <div class="mb-6 flex flex-row justify-center">
        <h1 class="uppercase">— Programmation —</h1>
      </div>
      <FilterArtists />
      <!--Afficher tous les Artistes-->
      <ArtisteItem />
    </section>
  </main>
</template>

<script setup>
import { onMounted } from "vue";
import FilterArtists from "../../components/FilterArtists.vue";
import ArtisteItem from "../../components/ArtisteItem.vue";

onMounted(() => {});
</script>
