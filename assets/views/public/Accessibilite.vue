<template>
  <main class="max-h-full pt-0 md:pt-2">
    <h1 class="my-4 uppercase flex justify-center">— Infos Pratiques —</h1>
    <NavSub />
    <article
      class="px-6 py-10 text-base flex flex-col justify-between gap-y-6 md:px-16 md:text-xl md:flex-row md:items-start md:gap-x-12 md:justify-center"
    >
      <div
        class="max-w-full flex flex-col md:max-w-[500px] lg:max-w-[700px] js-show-on-scroll3"
      >
        <h2 class="uppercase">Accueil PSH</h2>
        <p>
          À votre arrivée sur le site du festival, vous bénéficiez d'une entrée
          réservée aux personnes en situation de handicap. Cette entrée est
          tenue par une équipe de bénévoles sensibilisés aux questions
          d’accessibilité. Ils sont là pour répondre à toutes vos questions et
          vous accompagner si besoin. Les bénévoles vous remettront un bracelet
          qui vous permettra d’accéder aux plateformes et aménagements.
        </p>
      </div>
      <img
        src="../../images/accueil_PSH_PMR.jpg"
        class="max-w-full h-full md:max-w-[400px] lg:max-w-[600px]"
        alt="Accueil PSH PMR"
      />
    </article>
    <article
      class="bg-darkblue text-white px-6 py-10 text-base flex flex-col justify-between gap-y-6 md:px-16 md:text-xl md:flex-row md:items-start md:gap-x-12 md:justify-center"
    >
      <img
        src="../../images/accompagnant_psh.jpg"
        class="max-w-full h-full md:max-w-[400px] lg:max-w-[600px]"
        alt="Accompagnat PSH"
      />
      <div
        class="max-w-full flex flex-col md:max-w-[500px] lg:max-w-[700px] js-show-on-scroll3"
      >
        <h2 class="uppercase text-lightblue">Accompagnants</h2>
        <p>
          Une équipe coordonnée par la MDPH est à votre disposition pour vous
          accompagner sur le site du festival.
        </p>
      </div>
    </article>
    <article
      class="px-6 py-10 text-base flex flex-col justify-between gap-y-6 md:px-16 md:text-xl md:flex-row md:items-start md:gap-x-12 md:justify-center"
    >
      <div
        class="max-w-full flex flex-col md:max-w-[500px] lg:max-w-[700px] js-show-on-scroll3"
      >
        <h2 class="uppercase">Plateforme PSH</h2>
        <p>
          Nation Sound dispose de trois plateformes PSH permettant une vue
          imprenable sur les 5 scènes du festival. Ces plateformes sont
          accessibles grâce au bracelet qui vous sera remis lors de votre
          arrivée à l’Accueil PSH.
        </p>
      </div>
      <img
        src="../../images/plateforme_psh.jpg"
        class="max-w-full h-full md:max-w-[400px] lg:max-w-[600px]"
        alt="Plateforme PSH"
      />
    </article>
    <article
      class="bg-darkblue text-white px-6 py-10 text-base flex flex-col justify-between gap-y-6 md:px-16 md:text-xl md:flex-row md:items-start md:gap-x-12 md:justify-center"
    >
      <img
        src="../../images/navette_psh.png"
        class="max-w-full h-full md:max-w-[400px] lg:max-w-[600px]"
        alt="Navette PSH"
      />
      <div
        class="max-w-full flex flex-col md:max-w-[500px] lg:max-w-[700px] js-show-on-scroll3"
      >
        <h2 class="uppercase text-lightblue">Navettes Festival et handicap</h2>
        <p>
          Une navette spécifique vous conduira du parking PSH jusqu’à l’enceinte
          du site concert du festival. Elle circulera avec un véhicule adapté en
          continu durant les heures d’ouverture de l’espace concert.
        </p>
      </div>
    </article>
    <article
      class="px-6 py-10 text-base flex flex-col justify-between gap-y-6 md:px-16 md:text-xl md:flex-row md:items-start md:gap-x-12 md:justify-center"
    >
      <div
        class="max-w-full flex flex-col md:max-w-[500px] lg:max-w-[700px] js-show-on-scroll3"
      >
        <h2 class="uppercase">WC et douches adaptés</h2>
        <p>
          Des WC & douches adaptés sont accessibles au camping ainsi que des WC
          adaptés sur chaque zone sanitaire de l’espace concerts.
        </p>
      </div>
      <img
        src="../../images/WC_PSH.png"
        class="max-w-full h-full md:max-w-[400px] lg:max-w-[600px]"
        alt="WC PSH"
      />
    </article>
  </main>
</template>

<script setup>
import { onMounted } from "vue";
import NavSub from "../../components/NavSub.vue";

onMounted(() => {});
</script>
