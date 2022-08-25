<template>
  <div>
    <div v-for="item in state.itemList" :key="item.itemId">
      <item-component
        v-bind:text="item.text"
        v-bind:imageFilePath="item.imageFilePath"
      ></item-component>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive, MetaHTMLAttributes } from "vue";
import { get, post, createUrl } from "./rest";

interface Item {
  itemId: bigint;
  text: string;
  imageFilePath: string;
}

interface State {
  itemList: Array<Item>;
}

export default defineComponent({
  setup() {
    const state = reactive<State>({
      itemList: new Array<Item>(),
    });

    get("getItems").then((data) => {
      console.log(data);
      (data as any).items.forEach((element: any) => {
        let imageUrl = "";
        if (element.image_id) {
          imageUrl = createUrl("getImage/" + element.image_id + ".png");
        }
        const i: Item = {
          itemId: element.id,
          text: element.text,
          imageFilePath: imageUrl,
        };
        state.itemList.push(i);
      });
    });

    return { state };
  },
});
</script>
