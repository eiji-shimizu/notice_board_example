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
    <div>
      <button type="button" @click="removeItem">{{ state.remove }}</button>
    </div>
    <br />
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive } from "vue";
import { useStore } from "vuex";

import { Item } from "./ItemList";
import { get, post } from "./rest";

interface State {
  remove: string;
}

export default defineComponent({
  props: {
    itemId: Number,
    text: String,
    imageFilePath: String,
    userName: String,
    createdAt: String,
  },
  setup(props) {
    const state = reactive<State>({
      remove: "",
    });
    get("words/remove").then((res) => {
      state.remove = (res as any).contents;
    });

    const store = useStore();

    const additionalInfo = () => {
      return " " + props.userName + " " + props.createdAt;
    };

    const removeItem = () => {
      const data: FormData = new FormData();
      if (props.itemId) {
        data.append("id", String(props.itemId));
        post("removeItem", data).then((res) => {
          // noop
        });
        // リストから削除する
        const i: Item = {
          itemId: BigInt(props.itemId),
          text: "",
          imageFilePath: "",
          userName: "",
          createdAt: "",
        };
        store.commit("remove", i);
      }
    };
    return { state, additionalInfo, removeItem };
  },
});
</script>
