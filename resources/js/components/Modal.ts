export default {
    state() {
        return {
            isAddItemShow: Boolean,
        };
    },
    mutations: {
        on(state: any, flagName: string) {
            if (Object.keys(state).indexOf(flagName) !== -1) {
                state[flagName] = true;
            }
        },
        off(state: any, flagName: string) {
            if (Object.keys(state).indexOf(flagName) !== -1) {
                state[flagName] = false;
            }
        }
    },
    getters: {
        isOn: (state: any) => (flagName: string) => {
            return state[flagName];
        }
    }
}