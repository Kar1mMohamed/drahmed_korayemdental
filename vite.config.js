import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        minify: "esbuild",
        rollupOptions: {
            output: {
                manualChunks: undefined,
            },
        },
        cssMinify: "esbuild",
        reportCompressedSize: false,
        chunkSizeWarningLimit: 1000,
        target: "es2015",
        // Optimize asset size
        assetsInlineLimit: 4096,
    },
    esbuild: {
        drop: ["console", "debugger"],
        legalComments: "none",
        minifyIdentifiers: true,
        minifySyntax: true,
        minifyWhitespace: true,
    },
    server: {
        hmr: {
            overlay: false,
        },
    },
});
