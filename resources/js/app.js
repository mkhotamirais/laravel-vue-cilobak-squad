import "./bootstrap";
import "vue-select/dist/vue-select.css";
import "../css/app.css";
import { createApp, h } from "vue";
import { createInertiaApp, Head, Link } from "@inertiajs/vue3";
import Main from "./Layouts/Main.vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { setThemeOnLoad } from "./theme";
import VueSelect from "vue-select";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        page.default.layout = page.default.layout || Main;
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component("Head", Head)
            .component("Link", Link)
            .component("v-select", VueSelect)
            .mount(el);
    },
});

setThemeOnLoad();
