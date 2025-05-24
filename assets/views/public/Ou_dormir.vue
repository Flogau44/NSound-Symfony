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
        <h2 class="uppercase">Camping</h2>
        <p>
          Des navettes sont mises en place depuis les parkings relais du
          festival et depuis le centre de Paris
        </p>
      </div>
      <img
        src="../../images/camping_2.jpg"
        class="max-w-full h-full md:max-w-[400px] lg:max-w-[600px]"
        alt="Camping"
      />
    </article>
    <article
      class="bg-darkblue text-white px-6 py-10 text-base flex flex-col justify-between gap-y-6 md:px-16 md:text-xl md:flex-row md:items-start md:gap-x-12 md:justify-center"
    >
      <img
        src="../../images/tipi.jpg"
        class="max-w-full h-full md:max-w-[400px] lg:max-w-[600px]"
        alt="Tipi"
      />
      <div
        class="max-w-full flex flex-col md:max-w-[500px] lg:max-w-[700px] js-show-on-scroll3"
      >
        <h2 class="uppercase text-lightblue">TiPi Village</h2>
        <p>
          Envie d’une alternative au camping ou d’un peu plus de confort ? le
          village de Tipi te propose de venir les mains dans les poches, ou
          presque !
        </p>
        <p>
          Ces tipis en coton naturel offrent un espace parfaitement imperméable
          de 7 à 20m2 avec 2, 4 ou 6 couchages. Vous disposerez d’une lampe et
          de matelas confortables en mousse de 10cm d’épaisseur. Une version «
          confort » avec couette + oreiller + kit de draps est également
          disponible en option. Le village TiPi comprend des douches et
          toilettes réservés, un espace détente avec transats, prises
          électriques et un accès contrôlé 24H/24H par des agents de sécurité.
        </p>
      </div>
    </article>
    <article
      class="px-6 py-10 text-base flex flex-col justify-between gap-y-6 md:px-16 md:text-xl md:flex-row md:items-start md:gap-x-12 md:justify-center"
    >
      <div
        class="max-w-full flex flex-col md:max-w-[500px] lg:max-w-[700px] js-show-on-scroll3"
      >
        <h2 class="uppercase">Gîtes, villages vacances, maisons d’hôtes…</h2>
        <p>
          Vous n’êtes pas très camping ? Gîtes, villages vacances, maisons
          d’hôtes… l'ile de france regorge de solutions.
        </p>
      </div>
      <img
        src="../../images/gite.jpg"
        class="max-w-full h-full md:max-w-[400px] lg:max-w-[600px]"
        alt="Gite"
      />
    </article>
  </main>
</template>

<script setup>
import { onMounted } from "vue";
import NavSub from "../../components/NavSub.vue";

onMounted(() => {});
</script>
