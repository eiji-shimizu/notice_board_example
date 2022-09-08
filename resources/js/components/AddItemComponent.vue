<template>
  <div>
    <textarea v-model="state.text" class="textAreaInput"></textarea>
    <input type="file" accept="image/png" @change="fileSelected" /><br />
    <button type="button" @click="addItem">{{ state.add }}</button>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive } from "vue";
import { get, post } from "./rest";

interface State {
  add: string;
  text: string;
  file: File;
}

export default defineComponent({
  setup() {
    const state = reactive<State>({
      add: "",
      text: "",
      file: new File([], ""),
    });
    get("words/add").then((res) => {
      state.add = (res as any).contents;
    });

    const addItem = () => {
      const data: FormData = new FormData();
      data.append("text", state.text);
      data.append("file", state.file);
      post("addItem", data).then((res) => {
        // noop
      });
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

    return { state, addItem, fileSelected };
  },
});
</script>
