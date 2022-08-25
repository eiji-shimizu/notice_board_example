<template>
  <div>
    <div>{{ text }}</div>
    <br />
    <div v-if="imageFilePath.length > 0">
      <img v-bind:src="imageFilePath" />
    </div>
    <br />
  </div>
</template>

<script lang="ts">
import { defineComponent, defineProps } from "vue";
import { get, post } from "./rest";

export default defineComponent({
  props: {
    text: String,
    imageFilePath: String,
  },
  setup() {},
});
</script>
