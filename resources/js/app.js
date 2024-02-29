import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import Layout from "./Shared/Layout.vue"
import PrimeVue from "primevue/config";
import InputText from 'primevue/inputtext';
import InputMask from 'primevue/inputmask';
import Textarea from 'primevue/textarea';
import Button from 'primevue/button';
import 'primevue/resources/themes/lara-light-green/theme.css'
createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]
        page.default.layout = page.default.layout || Layout
        return page
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(PrimeVue)
            .component('InputText', InputText)
            .component('InputMask', InputMask)
            .component('Textarea', Textarea)
            .component('Button', Button)
            .mount(el)
    },
})
