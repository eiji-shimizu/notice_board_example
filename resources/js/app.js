require('./bootstrap');

import { createApp } from 'vue';
import { createStore } from "vuex";

import ModalComponent from "./components/ModalComponent.vue";
import HeaderComponent from "./components/HeaderComponent.vue";
import AddItemComponent from "./components/AddItemComponent.vue";
import ItemListComponent from "./components/ItemListComponent.vue";
import ItemComponent from "./components/ItemComponent.vue";

import ItemList from './components/ItemList'
import Modal from './components/Modal'

const app = createApp({});
app.component('modal-component', ModalComponent);
app.component('header-component', HeaderComponent);
app.component('add-item-component', AddItemComponent);
app.component('item-list-component', ItemListComponent);
app.component('item-component', ItemComponent);

const store = createStore({
    modules: {
        itemList: ItemList,
        modal: Modal
    }
});
app.use(store);

app.mount('#app');

