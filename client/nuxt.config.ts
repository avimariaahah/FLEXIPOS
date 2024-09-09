// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    devtools: { enabled: true },
    modules: ['@pinia/nuxt'],
    css: ["~/assets/css/main.css"],
    postcss: {
        plugins: {
            tailwindcss: {},
            autoprefixer: {},
        },
    },
    runtimeConfig: {
        public: {
            appName: process.env.APP_NAME,
            apiBaseURL: process.env.API_BASE_URL,
        },
    },
    ssr: false,

    compatibilityDate: "2024-07-10",
});