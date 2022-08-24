// app.js

import 'primevue/resources/primevue.min.css'              //core css
import 'primeicons/primeicons.css'                          //icons
import 'primevue/resources/themes/saga-blue/theme.css'     //theme
import './bootstrap';
import {createApp} from 'vue'
import router from '../router';
import App from './App.vue'
import PrimeVue from 'primevue/config';

import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Message from 'primevue/message';


const app = createApp(App)
app.use(PrimeVue)
app.use(router).mount('#app')

createApp(App).component('Button', Button);
createApp(App).component('InputText', InputText);
createApp(App).component('Message', Message);


