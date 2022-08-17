<template>
  <div>ヘッダー</div>
</template>

<script lang="ts">
import { defineComponent, reactive, watchEffect } from "vue";

interface State {
  inputValue: string
  hasError: boolean
}

export default {
  data() {
    return {
      message: "Hello World",
    };
  },
};
</script>