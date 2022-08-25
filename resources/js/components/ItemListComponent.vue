<template>
  <div>
    <div v-for="item in state.itemList" :key="item.itemId">
      <item-component
        v-bind:text="item.text"
        v-bind:imageFilePath="item.imageFilePath"
        v-bind:userName="item.userName"
        v-bind:createdAt="item.createdAt"
      ></item-component>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive, onMounted, onBeforeUnmount } from "vue";
import { get, createUrl } from "./rest";

interface Item {
  itemId: bigint;
  text: string;
  imageFilePath: string;
  userName: string;
  createdAt: string;
}

interface State {
  itemList: Array<Item>;
  // ポーリング用
  intervalId: any;
}

export default defineComponent({
  setup() {
    const state = reactive<State>({
      itemList: new Array<Item>(),
      intervalId: null,
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
          userName: element.name,
          createdAt: element.created_at,
        };
        addItemToList(i);
      });
    });

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
            addItemToList(i);
          });
        });
      }, 5000);
    });

    onBeforeUnmount(() => {
      console.log("clearInterval");
      clearInterval(state.intervalId);
    });

    const addItemToList = (i: Item) => {
      // この処理は並列アクセスを考慮しておらず本当はNGなので
      // 実際のプロジェクトでは何らかの状態管理手法を導入するべき
      const ret = state.itemList.find((element) => {
        return element.itemId === i.itemId;
      });
      if (ret === undefined) {
        state.itemList.push(i);
      }
    };

    return { state };
  },
});
</script>
