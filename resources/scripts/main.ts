import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import axios from "axios";
import '../css/app.css'
axios.defaults.baseURL=import.meta.env.VITE_APP_URL;

createInertiaApp({
    resolve: (name) => resolvePageComponent(`../views/pages/${name}.vue`, import.meta.glob('../views/pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)
    },
    title: title => `${title} | Tasks`,
    progress: {

        delay: 250,
        color: '#29d',
        includeCSS: true,
        showSpinner: false,
    },
});
