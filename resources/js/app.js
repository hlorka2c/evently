require('./bootstrap');

import Vue from 'vue';
import App from './vue/App';
import { createApp } from 'vue';

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
    components,
    directives,
})

const app = createApp(App);
app.use(vuetify);
app.mount('#app');