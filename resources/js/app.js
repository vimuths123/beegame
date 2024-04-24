import './bootstrap';

import { createApp } from 'vue';
import BeeGame from './components/BeeGame.vue';
import App from './App.vue'
const app = createApp(App);
app.component('BeeGame', BeeGame);

app.mount("#app");