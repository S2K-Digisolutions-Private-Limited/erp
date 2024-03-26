import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";

import 'vuetify/styles'
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import '@mdi/font/css/materialdesignicons.css';

import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist'


const vuetify = createVuetify({
    components,
    directives,
})
createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(vuetify)
            .use(ZiggyVue)
            .mount(el)
    },
})
    .then(() => {
        document.getElementById('app').removeAttribute('data-page');
    });

import { InertiaProgress } from '@inertiajs/progress'

InertiaProgress.init({
    delay: 250,
    color: '#2196f3',
    includeCSS: true,
    showSpinner: true,
})


