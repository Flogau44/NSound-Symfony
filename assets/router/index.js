import { createRouter, createWebHistory } from "vue-router";
import store from "../store/store";
import Home from "../views/public/Home.vue";
import Accessibilite from "../views/public/Accessibilite.vue";
import ArticleDetail from "../views/public/ArticleDetail.vue";
import ArtisteDetail from "../views/public/ArtisteDetail.vue";
import Billetterie from "../views/public/Billetterie.vue";
import Contact from "../views/public/Contact.vue";
import Faq from "../views/public/Faq.vue";
import Faq1 from "../views/public/Faq1.vue";
import Informations from "../views/public/Informations.vue";
import Infos_pratiques from "../views/public/Infos_pratiques.vue";
import Mentions_legales from "../views/public/Mentions_legales.vue";
import NotFound from "../views/public/NotFound.vue";
import Ou_dormir from "../views/public/Ou_dormir.vue";
import Partenaires from "../views/public/Partenaires.vue";
import Programmation from "../views/public/Programmation.vue";
import Sur_place from "../views/public/Sur_place.vue";
import RegisterForm from "../views/auth/RegisterForm.vue";
import LoginForm from "../views/auth/LoginForm.vue";
import DefaultLayout from "../layouts/DefaultLayout.vue";
import AuthLayout from "../layouts/AuthLayout.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
    meta: { layout: DefaultLayout },
  },
  {
    path: "/Informations",
    name: "Informations",
    component: Informations,
    meta: { layout: DefaultLayout },
    props: true,
  },
  {
    path: "/ArticleDetail/:id",
    name: "ArticleDetail",
    component: ArticleDetail,
    meta: { layout: DefaultLayout },
    props: true,
  },
  {
    path: "/Programmation",
    name: "Programmation",
    component: Programmation,
    meta: { layout: DefaultLayout },
    props: true,
  },
  {
    path: "/ArtisteDetail/:id",
    name: "ArtisteDetail",
    component: ArtisteDetail,
    meta: { layout: DefaultLayout },
    props: true,
  },
  {
    path: "/Billetterie",
    name: "Billetterie",
    component: Billetterie,
    meta: { layout: DefaultLayout },
  },
  {
    path: "/Infos_pratiques",
    name: "Infos_pratiques",
    component: Infos_pratiques,
    meta: { layout: DefaultLayout },
  },
  {
    path: "/Ou_dormir",
    name: "Ou_dormir",
    component: Ou_dormir,
    meta: { layout: DefaultLayout },
  },
  {
    path: "/Accessibilite",
    name: "Accessibilite",
    component: Accessibilite,
    meta: { layout: DefaultLayout },
  },
  {
    path: "/Sur_place",
    name: "Sur_place",
    component: Sur_place,
    meta: { layout: DefaultLayout },
  },
  {
    path: "/Faq1",
    name: "Faq1",
    component: Faq1,
    meta: { layout: DefaultLayout },
  },
  {
    path: "/Partenaires",
    name: "Partenaires",
    component: Partenaires,
    meta: { layout: DefaultLayout },
  },
  {
    path: "/contactez-nous",
    name: "Contact",
    component: Contact,
    meta: { layout: DefaultLayout },
    alias: "/contact",
  },
  {
    path: "/Faq",
    name: "Faq",
    component: Faq,
    meta: { layout: DefaultLayout },
  },
  {
    path: "/Mentions_legales",
    name: "Mentions_legales",
    component: Mentions_legales,
    meta: { layout: DefaultLayout },
  },
  {
    path: "/Login",
    name: "LoginForm",
    component: LoginForm,
    meta: { layout: AuthLayout, requiresGuest: true },
  },
  {
    path: "/Register",
    name: "RegisterForm",
    component: RegisterForm,
    meta: { layout: AuthLayout, requiresGuest: true },
  },
  {
    path: "/:catchAll(.*)",
    component: NotFound,
    meta: { layout: DefaultLayout },
  },
];
// Création du router
const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Guard de navigation pour bloquer Login et Register si déjà authentifié
router.beforeEach((to, from, next) => {
  if (to.meta.requiresGuest && store.getters.isAuthenticated) {
    next("/"); // Redirige vers la page d'accueil ou une autre page pour les utilisateurs connectés
  } else {
    next();
  }
});

export default router;
