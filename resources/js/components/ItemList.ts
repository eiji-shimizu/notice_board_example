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
        },
        remove(state: any, i: Item) {
            const index = state.items.findIndex((element: Item) => {
                return BigInt(element.itemId) === BigInt(i.itemId);
            });
            if (index != -1) {
                state.items.splice(index, 1);
            }
        }
    }
}