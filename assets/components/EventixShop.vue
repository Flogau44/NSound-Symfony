<template>
  <div>
    <iframe
      :src="shopUrl"
      style="width: 100%; min-height: 900px; border: none"
      @load="onLoad"
    ></iframe>
  </div>
</template>

<script>
export default {
  name: "EventixShop",
  props: {
    shopUrl: {
      type: String,
      required: true,
    },
  },
  methods: {
    onLoad() {
      console.log("Eventix shop loaded successfully");
    },
  },
};
</script>
