<template>
  <router-link
    :to="to"
    :class="[
      'uppercase transition duration-0 hover:duration-500',
      isActive
        ? 'text-darkblue border-darkblue border-b-2'
        : 'text-blue-900 hover:text-darkblue hover:border-b-2 hover:border-darkblue',
    ]"
    :title="title"
  >
    <slot></slot>
  </router-link>
</template>

<script>
import { useRoute } from "vue-router";

export default {
  name: "NavLink",
  props: {
    to: {
      type: Object,
      required: true,
    },
    title: {
      type: String,
      required: true,
    },
  },
  computed: {
    isActive() {
      const route = useRoute();
      return route.name === this.to.name;
    },
  },
};
</script>
