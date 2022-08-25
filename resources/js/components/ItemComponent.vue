<template>
  <div class="itemBox">
    <div class="space_between_container">
      <div>{{ text }}</div>
      <div>
        <div>{{ additionalInfo() }}</div>
      </div>
    </div>
    <div v-if="imageFilePath.length > 0">
      <img v-bind:src="imageFilePath" />
    </div>
    <br />
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { get, post } from "./rest";

export default defineComponent({
  props: {
    text: String,
    imageFilePath: String,
    userName: String,
    createdAt: String,
  },
  setup(props) {
    const additionalInfo = () => {
      return " " + props.userName + " " + props.createdAt;
    };
    return { additionalInfo };
  },
});
</script>
