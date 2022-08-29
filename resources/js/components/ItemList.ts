export interface Item {
    itemId: bigint;
    text: string;
    imageFilePath: string;
    userName: string;
    createdAt: string;
}

export default {
    state() {
        return {
            items: new Array<Item>(),
        };
    },
    mutations: {
        add(state: any, i: Item) {
            const ret = state.items.find((element: Item) => {
                return element.itemId === i.itemId;
            });
            if (ret === undefined) {
                state.items.push(i);
            }
        }
    }
}