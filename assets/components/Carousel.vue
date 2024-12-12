<template>
  <section class="hidden lg:flex">
    <!-- Faire apparaitre les images -->
    <div
      id="slider1"
      class="splide"
      role="group"
      aria-label="Splide Basic HTML Example"
    >
      <div class="splide__track">
        <ul class="splide__list">
          <!-- Première image du carrousel -->
          <li class="splide__slide" data-splide-interval="100">
            <img
              src="../images/Scene1.jpg"
              class="w-screen h-[400px] md:h-[500px] object-cover"
              alt="Scène1"
            />
          </li>
          <!-- Deuxième image du carrousel -->
          <li class="splide__slide" data-splide-interval="100">
            <img
              src="../images/scene2.jpg"
              class="w-screen h-[400px] md:h-[500px] object-cover"
              alt="Scène2"
            />
          </li>
          <!-- Troisième image du carrousel -->
          <li class="splide__slide" data-splide-interval="100">
            <img
              src="../images/scene3.jpg"
              class="w-screen h-[400px] md:h-[500px] object-cover"
              alt="Scène3"
            />
          </li>
        </ul>
      </div>
      <div class="splide__pagination bottom-2"></div>
    </div>
  </section>
</template>

<script>
export default {
  name: "Carousel",

  mounted() {
    // Initialiser le carrousel Splide
    const splide1 = new Splide("#slider1", {
      type: "fade",
      rewind: true,
      arrows: false,
      height: 500,
    });
    splide1.mount();
  },
};
</script>
