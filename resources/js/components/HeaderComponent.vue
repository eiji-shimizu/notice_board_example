<template>
  <div class="container">
    <div class="container">
      <span>{{ state.message }}</span>
    </div>
    <div class="right_container">
      <form action="logout" method="POST">
        <button type="submit">{{ state.logout }}</button>
        <input type="hidden" name="_token" v-model="state.token" />
      </form>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive, MetaHTMLAttributes } from "vue";
import { get } from "./rest";

interface State {
  token: string;
  message: string;
  logout: string;
}

async function createMessage(): Promise<string> {
  let msg: string = "";
  await get("words/hello").then((res) => {
    msg = (res as any).contents;
  });
  await get("userInfo").then((user) => {
    msg += " " + (user as any).name;
  });
  return msg;
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
      message: "",
      logout: "",
    });
    createMessage().then((msg) => {
      state.message = msg;
    });
    get("words/logout").then((res) => {
      state.logout = (res as any).contents;
    });
    return { state };
  },
});
</script>