<template>
  <div v-show="isShow">
    <component v-bind:is="componentName"></component>
  </div>
</template>

<script lang="ts">
import { defineComponent, computed } from "vue";
import { useStore } from "vuex";

export default defineComponent({
  props: {
    componentName: String,
    flagName: String,
  },
  setup(props) {
    const store = useStore();
    store.commit("off", props.flagName);

    const isShow = computed(() => {
      console.log("there");
      return store.getters.isAddItemOn;
    });

    return { isShow };
  },
});
</script>