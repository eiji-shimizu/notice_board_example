export default {
    state() {
        return {
            isAddItemShow: Boolean,
        };
    },
    mutations: {
        on(state: any, flagName: string) {
            if(Object.keys(state).indexOf(flagName) !== -1) {
                state[flagName] = true;
            }
        },
        off(state: any, flagName: string) {
            if(Object.keys(state).indexOf(flagName) !== -1) {
                console.log('here');
                state[flagName] = false;
            }
        }
    },
    getters: {
        isAddItemOn(state: any) {
            console.log(state.isAddItemShow);
            return state.isAddItemShow;
        }
    }
}