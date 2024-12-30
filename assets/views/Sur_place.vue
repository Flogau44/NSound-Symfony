<template>
  <main class="max-h-full pt-0 md:pt-2">
    <h1 class="my-4 uppercase flex justify-center">— Infos Pratiques —</h1>
    <NavSub />
    <section class="py-10 px-4 md:px-16 flex flex-col text-base md:text-xl">
      <h2 class="uppercase flex justify-center">Plan du festival</h2>
      <Map />
    </section>
    <section>
      <article
        class="bg-darkblue text-white px-6 py-10 text-base flex flex-col justify-between gap-y-6 md:px-16 md:text-xl md:flex-row md:items-start md:gap-x-12 md:justify-center"
      >
        <img
          src="../images/entree_festival.png"
          class="max-w-full h-full md:max-w-[400px] lg:max-w-[600px]"
          alt="Entree du festival"
        />
        <div
          class="max-w-full flex flex-col md:max-w-[500px] lg:max-w-[700px] js-show-on-scroll3"
        >
          <h2 class="uppercase text-lightblue">Entrée du festival</h2>
          <p>
            Un contrôle des billets sera effectué à l’entrée du festival. Un
            bracelet à usage unique vous sera remis. Il ne pourra pas être
            enlevé et remis à quelqu’un d’autre. Attention : vous risqueriez de
            vous faire refuser l’accès au festival.
          </p>
          <p>
            Les portes du festival ouvrent le Vendredi 11 juillet à 14h30, le
            Samedi 12 juillet à 14h30 et le Dimanche 13 juillet à 14h30. Les
            concerts commencent environ 1h30 après ces horaires.
          </p>
          <p>
            L’introduction de drogues, d’alcool et d’appareils photos
            professionnels sont strictement interdits dans l’enceinte du
            festival. Pour des raisons de sécurité, des objets ne sont pas
            autorisés sur site : les récipients en verre, les outils tranchants
            et/ou dangereux (cutters, couteaux…), les bouchons de bouteilles en
            plastique…
          </p>
        </div>
      </article>
      <article
        class="px-6 py-10 text-base flex flex-col justify-between gap-y-6 md:px-16 md:text-xl md:flex-row md:items-start md:gap-x-12 md:justify-center"
      >
        <div
          class="max-w-full flex flex-col md:max-w-[500px] lg:max-w-[700px] js-show-on-scroll3"
        >
          <h2 class="uppercase">Espace familles</h2>
          <p>
            Familles, au festival, pour recharger les batteries, l’Espace
            Familles vous est dédié jusqu’à 23h, près du camping. Vous pourrez
            vous y détendre et profiter de nombreux services et animations :
            espace détente, massage, coloriage, maquillage, jeux de société…
            Comment accéder à l’Espace Familles ? Présentez-vous à l’accueil du
            festival pour récupérer votre accès spécifique, indiquez le nom de
            votre enfant, son prénom et votre numéro de téléphone. Rendez-vous
            ensuite sur le site, dans une zone à l’écart des scènes, en toute
            tranquillité, pour accéder au château. Afin que l’Espace Familles
            reste un endroit calme et agréable, sa capacité reste limitée. Un
            peu d’attente pourra vous être demandée.
          </p>
        </div>
        <img
          src="../images/espace_detente.jpg"
          class="max-w-full h-full md:max-w-[400px] lg:max-w-[600px]"
          alt="Espace detente"
        />
      </article>
      <article
        class="bg-darkblue text-white px-6 py-10 text-base flex flex-col justify-between gap-y-6 md:px-16 md:text-xl md:flex-row md:items-start md:gap-x-12 md:justify-center"
      >
        <img
          src="../images/stand_prevention.png"
          class="max-w-full h-full md:max-w-[400px] lg:max-w-[600px]"
          alt="Stand de prevention"
        />
        <div
          class="max-w-full flex flex-col md:max-w-[500px] lg:max-w-[700px] js-show-on-scroll3"
        >
          <h2 class="uppercase text-lightblue">Stand de prévention</h2>
          <p>
            Pour limiter et sensibiliser sur les comportements liés à l’excès
            d’alcool, à la consommation de drogues ou les risques auditifs, un
            stand de prévention est accessible à tous.
          </p>
          <p>
            Des bénévoles dispensent informations et conseils auprès du public.
            Des bouchons d’oreille, casques, préservatifs, éthylotests et autres
            sont à disposition durant le festival.
          </p>
        </div>
      </article>
      <article
        class="px-6 py-10 text-base flex flex-col justify-between gap-y-6 md:px-16 md:text-xl md:flex-row md:items-start md:gap-x-12 md:justify-center"
      >
        <div
          class="max-w-full flex flex-col md:max-w-[500px] lg:max-w-[700px] js-show-on-scroll3"
        >
          <h2 class="uppercase">Safe zone</h2>
          <p>
            Cette année encore Nation Sound renforce sa vigilance en proposant
            un espace Safe Zone ouvert à tous et toutes, où les
            festivaliers.ières trouveront une zone de refuge en cas de danger ou
            incident. Un espace safe et calme afin de proposer un festival
            toujours plus bienveillant !
          </p>
        </div>
        <img
          src="../images/safe_zone.jpg"
          class="max-w-full h-full md:max-w-[400px] lg:max-w-[600px]"
          alt="Safe zone"
        />
      </article>
    </section>
  </main>
</template>

<script setup>
import { onMounted } from "vue";
import NavSub from "../components/NavSub.vue";
import Map from "../components/Map.vue";

onMounted(() => {});
</script>
