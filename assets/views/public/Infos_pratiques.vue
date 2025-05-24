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
        <h2 class="uppercase">Navette</h2>
        <p>
          Des navettes sont mises en place depuis les parkings relais du
          festival et depuis le centre de Paris
        </p>
        <p>
          <span class="text-darkblue font-bold">Horaires :</span> de 14h à 20h30
          puis de 23h jusqu'à 1 heure après la fin des concerts.
        </p>
        <div class="flex flex-row gap-x-4">
          <h3>L1</h3>
          <div class="flex flex-col">
            <h3>Paris centre</h3>
            <p>Gare routière Paris Montparnasse > Festival Nation Sound</p>
          </div>
        </div>
        <div class="flex flex-row gap-x-4">
          <h3>L2</h3>
          <div class="flex flex-col">
            <h3>Paris aéroport</h3>
            <p>Aéroport Charles de Gaulle > Festival Nation Sound</p>
          </div>
        </div>
      </div>
      <img
        src="../../images/aeroport.jpg"
        class="max-w-full h-full md:max-w-[400px] lg:max-w-[600px]"
        alt="Aeroport"
      />
    </article>
    <article
      class="bg-darkblue text-white px-6 py-10 text-base flex flex-col justify-between gap-y-6 md:px-16 md:text-xl md:flex-row md:items-start md:gap-x-12 md:justify-center"
    >
      <img
        src="../../images/train.jpg"
        class="max-w-full h-full md:max-w-[400px] lg:max-w-[600px]"
        alt="Train"
      />
      <div
        class="max-w-full flex flex-col md:max-w-[500px] lg:max-w-[700px] js-show-on-scroll3"
      >
        <h2 class="uppercase text-lightblue">Train</h2>
        <p>Temps de trajet à titre indicatif :</p>
        <ul class="fa-ul">
          <li>
            <span class="fa-li"
              ><i class="fa-solid fa-square fa-2xs text-white"></i></span
            >Paris : 58 minutes
          </li>
          <li>
            <span class="fa-li"
              ><i class="fa-solid fa-square fa-2xs text-white"></i></span
            >Beauvais : 1 heure 40 minutes
          </li>
          <li>
            <span class="fa-li"
              ><i class="fa-solid fa-square fa-2xs text-white"></i></span
            >Reims : 2 heures 25 minutes
          </li>
          <li>
            <span class="fa-li"
              ><i class="fa-solid fa-square fa-2xs text-white"></i></span
            >Rennes : 2 heures 51 minutes
          </li>
          <li>
            <span class="fa-li"
              ><i class="fa-solid fa-square fa-2xs text-white"></i></span
            >Lille : 2 heures 53 minutes
          </li>
          <li>
            <span class="fa-li"
              ><i class="fa-solid fa-square fa-2xs text-white"></i></span
            >Lyon : 3 heures 22 minutes
          </li>
        </ul>
      </div>
    </article>
    <article
      class="px-6 py-10 text-base flex flex-col justify-between gap-y-6 md:px-16 md:text-xl md:flex-row md:items-start md:gap-x-12 md:justify-center"
    >
      <div
        class="max-w-full flex flex-col md:max-w-[500px] lg:max-w-[700px] js-show-on-scroll3"
      >
        <h2 class="uppercase">Vélo & deux roues</h2>
        <p>Parking à 15min. à pied de l'entrée du festival</p>
        <p>
          Parking à vélos de plus de 1000 places pouvant également accueillir
          des deux roues. Gratuit et sans réservation, il vous permettra de vous
          garer à proximité de l'entrée du festival.
        </p>
        <p>
          Le parking est gardienné, cependant, le festival décline toute
          responsabilité en cas de vol ou de dégradation.
        </p>
      </div>
      <img
        src="../../images/parking_velo.jpg"
        class="max-w-full h-full md:max-w-[400px] lg:max-w-[600px]"
        alt="Velo"
      />
    </article>
  </main>
</template>

<script setup>
import { onMounted } from "vue";
import NavSub from "../../components/NavSub.vue";

onMounted(() => {});
</script>
