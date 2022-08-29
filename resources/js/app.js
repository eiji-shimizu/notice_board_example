require('./bootstrap');

import { createApp } from 'vue';
import { createStore } from "vuex";

import HeaderComponent from "./components/HeaderComponent.vue";
import AddItemComponent from "./components/AddItemComponent.vue";
import ItemListComponent from "./components/ItemListComponent.vue";
import ItemComponent from "./components/ItemComponent.vue";

import ItemList from './components/ItemList'

const app = createApp({});
app.component('header-component', HeaderComponent);
app.component('add-item-component', AddItemComponent);
app.component('item-list-component', ItemListComponent);
app.component('item-component', ItemComponent);

const store = createStore({
    modules: {
        itemList: ItemList
    }
});
app.use(store);

app.mount('#app');

