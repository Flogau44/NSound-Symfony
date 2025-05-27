<template>
  <section class="mt-2 mb-10 mx-4 md:mx-40">
    <div v-for="faqData in faqDatas" :key="faqData.id">
      <div class="my-10">
        <h2 class="uppercase font-bold">{{ faqData.category }}</h2>
      </div>
      <div
        v-for="questionData in faqData.questions"
        :key="questionData.id"
        class="border-black-500 border-t-2"
      >
        <div class="question" @click="toggleQuestion(questionData.id)">
          <h3>{{ questionData.question }}</h3>
          <i
            :class="[
              'fas',
              'fa-xl',
              openQuestions[questionData.id]
                ? 'fa-chevron-down'
                : 'fa-chevron-up',
            ]"
            aria-hidden="true"
          ></i>
        </div>
        <div v-if="openQuestions[questionData.id]" class="answer">
          <ul v-if="Array.isArray(questionData.answer)">
            <li v-for="(item, index) in questionData.answer" :key="index">
              {{ item }}
            </li>
          </ul>
          <p v-else>{{ questionData.answer }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { reactive } from "vue";

const faqDatas = reactive([
  {
    id: 1,
    category: "Général",
    questions: [
      {
        id: 101,
        question: "OÙ SE TROUVE LE FESTIVAL ?",
        answer: "Le festival se trouve à Atainville, à 48 min de Paris.",
      },
      {
        id: 102,
        question: "QUELLES SONT LES HEURES D'OUVERTURE DU FESTIVAL ?",
        answer:
          "Le festival ouvre ses portes à 12h30 et ferme à 2h00 du matin.",
      },
      {
        id: 103,
        question: "QUELS SONT LES OBJETS INTERDITS SUR LE FESTIVAL ?",
        answer: [
          "Les armes, substances explosives, inflammables ou volatiles.",
          "Les substances illicites, drogues.",
          "Les poussettes, les chariots.",
          "Les objets dangereux, tranchants ou contondants, les parapluies, ainsi que tout objet susceptible de servir de projectile.",
          "Les animaux (à l'exception des chiens-guides pour personnes malvoyantes).",
          "Les liquides et gels non-potables dans des contenants de plus de 100 ml.",
          "Les trépieds et perches à selfie, laser, drones.",
          "Les grands sacs à dos (sup 45 cm hauteur).",
          "Le gaz et becs à gaz.",
          "Tout autre objet pouvant être considéré comme dangereux par l’organisation.",
        ],
      },
    ],
  },
  {
    id: 2,
    category: "Tickets",
    questions: [
      {
        id: 201,
        question: "Je n'ai pas reçu d'email de confirmation",
        answer: "Les informations seront prochainement disponibles.",
      },
      {
        id: 202,
        question: "Je souhaite upgrader un billet acheté en magasin",
        answer:
          "Les upgrades de tickets ne sont possibles qu'avec les tickets achetés en ligne sur notre billetterie officielle.",
      },
      {
        id: 203,
        question: "Comment puis-je activer la protection de remboursement ?",
        answer:
          "Si tu as assuré tes billets au moment de ton achat et que tu souhaites te faire rembourser, rends-toi ici.",
      },
    ],
  },
  {
    id: 3,
    category: "Camping",
    questions: [
      {
        id: 301,
        question: "QUELLES SONT LES CONDITIONS D'ACCÈS AU CAMPING ?",
        answer:
          "Les campeurs sont susceptibles d’être soumis à des vérifications du contenu de leurs bagages, ainsi qu’à des palpations par les agents de sécurité, à l’entrée du camping.",
      },
      {
        id: 302,
        question: "Quel type de tente est autorisé au sein du camping ?",
        answer:
          "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi quis sapien erat.",
      },
      {
        id: 303,
        question: "QUELS SONT LES OBJETS INTERDITS SUR LE CAMPING ?",
        answer:
          "La surface maximum que tu peux utiliser pour installer ta tente est de 4m2 (emplacement 2 personnes) à 9m2 (emplacement 4 personnes). Les tentes avec coin salon intégré ne seront pas autorisées.",
      },
      {
        id: 304,
        question: "Mon véhicule est-il accepté au sein du camping ?",
        answer:
          "Les voitures, motos, remorques, caravanes, camping-car, etc. ne sont pas autorisés dans l’enceinte du camping et ses alentours.",
      },
    ],
  },
]);

const openQuestions = reactive({});

const toggleQuestion = (questionId) => {
  openQuestions[questionId] = !openQuestions[questionId];
};
</script>
