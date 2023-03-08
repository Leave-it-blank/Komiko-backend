import { createPinia } from "pinia";
import { useMainStore } from "@/stores/main";
import { useReaderStore } from "@/stores/reader";
import { darkModeKey, styleKey } from "@/config.js";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { Inertia } from "@inertiajs/inertia";
import ScriptX from "vue-scriptx";
import Ads from "vue-google-adsense";

const pinia = createPinia();

//const appName = window.document.getElementsByTagName('title')[0]?.innerText ||' '

createInertiaApp({
  title: (title) => `${title} `,
  resolve: (name) => require(`./Pages/${name}.vue`),
  setup({ el, app, props, plugin }) {
    return createApp({ render: () => h(app, props) })
      .use(plugin)
 
      .use(pinia)
      .mixin({ methods: { route } })
      .mount(el);
  },
});

InertiaProgress.init({ color: "#4B5563" });

const mainStore = useMainStore(pinia);
const readerStore = useReaderStore(pinia);
/* App style */
// mainStore.setStyle(localStorage[styleKey] ?? 'basic')

/* Dark mode */
if (
  (!localStorage[darkModeKey] &&
    window.matchMedia("(prefers-color-scheme: dark)").matches) ||
  localStorage[darkModeKey] === "1"
) {
  mainStore.setDarkMode(true);
  readerStore.setDarkMode(true);
}

if (!localStorage["bookmarks"]) {
  localStorage.setItem("bookmarks", JSON.stringify([...new Map()]));
}
/* Collapse mobile aside menu on route change */
Inertia.on("navigate", (event) => {
  mainStore.asideMobileToggle(false);
  mainStore.asideLgToggle(false);
  readerStore.asideMobileToggle(false);
  readerStore.asideLgToggle(false);
});
