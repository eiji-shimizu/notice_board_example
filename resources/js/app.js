require('./bootstrap');

import { createApp } from 'vue';

import HeaderComponent from "./components/HeaderComponent.vue";
import HelloComponent from "./components/HelloComponent.vue";

const app = createApp({});
app.component('header-component', HeaderComponent);
app.component('hello-component', HelloComponent);
app.mount('#app');
