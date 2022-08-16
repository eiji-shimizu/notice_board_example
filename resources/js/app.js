require('./bootstrap');

import { createApp } from 'vue'

import HelloComponent from "./components/HelloComponent.vue";

const app = createApp();
app.component('hello-component', HelloComponent);
app.mount('#app');
