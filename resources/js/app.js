require('./bootstrap');

import { createApp } from 'vue';

import HeaderComponent from "./components/HeaderComponent.vue";
import AddItemComponent from "./components/AddItemComponent.vue";
import ItemListComponent from "./components/ItemListComponent.vue";
import ItemComponent from "./components/ItemComponent.vue";

const app = createApp({});
app.component('header-component', HeaderComponent);
app.component('add-item-component', AddItemComponent);
app.component('item-list-component', ItemListComponent);
app.component('item-component', ItemComponent);
app.mount('#app');
