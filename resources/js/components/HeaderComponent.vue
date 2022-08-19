<template>
  <div class="container">
    <div class="container">ヘッダー</div>
    <div class="right_container">
      <form action="logout" method="POST">
        <button type="submit" @click="logout">ログアウト</button>
        <input type="hidden" name="_token" v-model="state.token" />
      </form>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive, toRefs, MetaHTMLAttributes } from "vue";
import { get } from "./rest";

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
    get("words/test").then((w) => {
      console.log((w as any).contents);
    });
    get("words/logout").then((w) => {
      console.log((w as any).contents);
    });
    return { state };
  },
});
</script>