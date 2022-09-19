<template>
  <div>
    <button type="button" @click="add">{{ state.add }}</button>
    <br />
    <br />
    <div v-for="item in list" :key="item.itemId">
      <item-component
        v-bind:itemId="item.itemId"
        v-bind:text="item.text"
        v-bind:imageFilePath="item.imageFilePath"
        v-bind:userName="item.userName"
        v-bind:createdAt="item.createdAt"
      ></item-component>
    </div>
  </div>
</template>

<script lang="ts">
import {
  defineComponent,
  reactive,
  computed,
  onMounted,
  onBeforeUnmount,
} from "vue";
import { useStore } from "vuex";

import { Item } from "./ItemList";
import { get, createUrl } from "./rest";

interface State {
  add: string;
  // ポーリング用
  intervalId: any;
}

export default defineComponent({
  setup() {
    const store = useStore();

    const state = reactive<State>({
      add: "",
      intervalId: null,
    });
    get("words/add").then((res) => {
      state.add = (res as any).contents;
    });

    get("getItems").then((data) => {
      (data as any).items.forEach((element: any) => {
        let imageUrl = "";
        if (element.image_id) {
          imageUrl = createUrl("getImage/" + element.image_id + ".png");
        }
        const i: Item = {
          itemId: element.id,
          text: element.text,
          imageFilePath: imageUrl,
          userName: element.name,
          createdAt: element.created_at,
        };
        store.commit("add", i);
      });
    });

    const add = () => {
      console.log("modal show.");
      store.commit("on", "isAddItemShow");
    };

    onMounted(async () => {
      state.intervalId = setInterval(function () {
        console.log("interval");
        get("getItems").then((data) => {
          (data as any).items.forEach((element: any) => {
            let imageUrl = "";
            if (element.image_id) {
              imageUrl = createUrl("getImage/" + element.image_id + ".png");
            }
            const i: Item = {
              itemId: element.id,
              text: element.text,
              imageFilePath: imageUrl,
              userName: element.name,
              createdAt: element.created_at,
            };
            store.commit("add", i);
          });
        });
      }, 5000);
    });

    onBeforeUnmount(() => {
      console.log("clearInterval");
      clearInterval(state.intervalId);
    });

    const list = computed(() => {
      return store.state.itemList.items;
    });

    return { state, list, add };
  },
});
</script>
