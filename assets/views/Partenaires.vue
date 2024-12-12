<template>
  <main class="max-h-full pt-0 md:pt-2">
    <section class="mt-6 mb-6 flex flex-col gap-y-20">
      <div class="flex flex-row justify-center">
        <h1 class="uppercase">— Nos partenaires —</h1>
      </div>
      <div id="partners">
        <div
          v-for="(partners, categoryName) in categorizedPartners"
          :key="categoryName"
          class="categoryPartner"
          :data-partenaires="categoryName"
        >
          <div class="nameCategory">
            <h2 class="categoryTitle">{{ categoryName.toUpperCase() }}</h2>
          </div>
          <div class="categoryPartners">
            <div v-for="partner in partners" :key="partner.id" class="partner">
              <a
                :href="partner.url"
                class="linkPartner"
                :title="partner.slug"
                target="_blank"
              >
                <img
                  :src="`http://127.0.0.1:8000/build/images/${partner.logo}`"
                  class="imgPartner"
                  :alt="partner.slug"
                />
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
import apiClient from "../axios";

export default {
  name: "Partenaires",
  data() {
    return {
      categorizedPartners: {},
    };
  },
  async mounted() {
    const restUrl = "/partners";
    const categoriesUrl = "/partner_categories";

    try {
      const [partnersResponse, categoriesResponse] = await Promise.all([
        apiClient.get(restUrl),
        apiClient.get(categoriesUrl),
      ]);

      const partners = partnersResponse.data.member;
      const categories = categoriesResponse.data.member;
      const categorizedPartners = {};

      categories.forEach((category) => {
        const categoryName = category.slug.split("-")[1]; // Extraire le mot après le tiret
        categorizedPartners[categoryName] = partners
          .filter(
            (partner) => partner.type === category["@id"] && partner.publish
          )
          .map((partner) => ({
            id: partner.id,
            url: partner.url,
            slug: partner.slug,
            logo: partner.logo,
          }));
      });

      this.categorizedPartners = categorizedPartners;
    } catch (error) {
      console.log(error, "erreur");
    }
  },
};
</script>
