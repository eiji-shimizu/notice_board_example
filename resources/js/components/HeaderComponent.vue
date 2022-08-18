<template>
  <div>
    ヘッダー
    <form action="logout" method="POST">
      <button type="submit" @click="logout">ログアウト</button>
      <input type="hidden" name="_token" v-model="state.token" />
    </form>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive, toRefs, MetaHTMLAttributes } from "vue";

interface State {
  token: string;
}

export default defineComponent({
  setup() {
    let csrfToken: string = "";
    let meta = document.head.children.namedItem("csrf-token");
    if (meta !== null) {
      csrfToken = (meta as MetaHTMLAttributes).content as string;
    }
    const state = reactive<State>({
      token: csrfToken,
    });
    return { state };
  },
});
</script>