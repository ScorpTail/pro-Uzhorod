// https://nuxt.com/docs/api/configuration/nuxt-config
import Aura from "@primeuix/themes/aura";
import tailwindcss from "@tailwindcss/vite";
export default defineNuxtConfig({
    imports: {
        autoImport: true,
    },
    compatibilityDate: "2025-07-15",
    devtools: { enabled: true },
    css: ["./app/assets/main.css"],

    vite: {
        plugins: [tailwindcss()],
    },

    components: [
        {
            path: "~/components",
            pathPrefix: false,
        },
    ],

    modules: ["@nuxt/image", "@primevue/nuxt-module"],
    primevue: {
        autoImport: false,
        options: {
            theme: {
                preset: Aura,
            },
        },
    },
});
