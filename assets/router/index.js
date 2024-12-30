import { createRouter, createWebHistory } from "vue-router";
import Accessibilite from "../views/Accessibilite.vue";
import ArticleDetail from "../views/ArticleDetail.vue";
import ArtisteDetail from "../views/ArtisteDetail.vue";
import Billetterie from "../views/Billetterie.vue";
import Contact from "../views/Contact.vue";
import Faq from "../views/Faq.vue";
import Faq1 from "../views/Faq1.vue";
import Home from "../views/Home.vue";
import Informations from "../views/Informations.vue";
import Infos_pratiques from "../views/Infos_pratiques.vue";
import LoginForm from "../views/LoginForm.vue";
import Mentions_legales from "../views/Mentions_legales.vue";
import NotFound from "../views/NotFound.vue";
import Ou_dormir from "../views/Ou_dormir.vue";
import Partenaires from "../views/Partenaires.vue";
import Programmation from "../views/Programmation.vue";
import RegisterForm from "../views/RegisterForm.vue";
import Sur_place from "../views/Sur_place.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/Informations",
    name: "Informations",
    component: Informations,
    props: true,
  },
  {
    path: "/ArticleDetail/:id",
    name: "ArticleDetail",
    component: ArticleDetail,
    props: true,
  },
  {
    path: "/Programmation",
    name: "Programmation",
    component: Programmation,
    props: true,
  },
  {
    path: "/ArtisteDetail/:id",
    name: "ArtisteDetail",
    component: ArtisteDetail,
    props: true,
  },
  {
    path: "/Billetterie",
    name: "Billetterie",
    component: Billetterie,
  },
  {
    path: "/Infos_pratiques",
    name: "Infos_pratiques",
    component: Infos_pratiques,
  },
  {
    path: "/Ou_dormir",
    name: "Ou_dormir",
    component: Ou_dormir,
  },
  {
    path: "/Accessibilite",
    name: "Accessibilite",
    component: Accessibilite,
  },
  {
    path: "/Sur_place",
    name: "Sur_place",
    component: Sur_place,
  },
  {
    path: "/Faq1",
    name: "Faq1",
    component: Faq1,
  },
  {
    path: "/Partenaires",
    name: "Partenaires",
    component: Partenaires,
  },
  {
    path: "/contactez-nous",
    name: "Contact",
    component: Contact,
    alias: "/contact",
  },
  {
    path: "/Faq",
    name: "Faq",
    component: Faq,
  },
  {
    path: "/Mentions_legales",
    name: "Mentions_legales",
    component: Mentions_legales,
  },
  {
    path: "/Login",
    name: "LoginForm",
    component: LoginForm,
  },
  {
    path: "/Register",
    name: "RegisterForm",
    component: RegisterForm,
  },
  {
    path: "/:catchAll(.*)",
    component: NotFound,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
