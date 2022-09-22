<template>
  <div>
    <textarea v-model="state.text" class="textAreaInput"></textarea>
    <input
      id="fileInput"
      type="file"
      accept="image/png"
      @change="fileSelected"
    /><br />
    <button type="button" @click="addItem">{{ state.add }}</button>
    <button type="button" @click="close">{{ state.close }}</button>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive } from "vue";
import { useStore } from "vuex";

import { get, post } from "./rest";

interface State {
  add: string;
  close: string;
  text: string;
  file: File;
}

export default defineComponent({
  setup() {
    const store = useStore();

    const state = reactive<State>({
      add: "",
      close: "",
      text: "",
      file: new File([], ""),
    });
    get("words/add").then((res) => {
      state.add = (res as any).contents;
    });
    get("words/close").then((res) => {
      state.close = (res as any).contents;
    });

    const addItem = () => {
      const data: FormData = new FormData();
      data.append("text", state.text);
      data.append("file", state.file);
      post("addItem", data).then((res) => {
        // noop
      });

      // 入力欄をクリアして非表示にする
      state.text = "";
      state.file = new File([], "");

      // @ts-ignore
      document.getElementById("fileInput").value = "";

      store.commit("off", "isAddItemShow");
    };

    const close = () => {
      store.commit("off", "isAddItemShow");
    };

    const fileSelected = (e: Event) => {
      if (e != null && e.target != null) {
        if (e.target instanceof HTMLInputElement) {
          if (e.target.files != null) {
            state.file = e.target.files[0];
          }
        }
      }
    };

    return { state, addItem, close, fileSelected };
  },
});
</script>
