<script>
import Header from "../components/Header.vue";
import Footer from "../components/Footer.vue";

export default {
  name: "DefaultLayout",
  components: { Header, Footer },
};
</script>

<template>
  <Header />
  <slot></slot>
  <Footer />
</template>
