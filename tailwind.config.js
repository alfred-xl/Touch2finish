import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
                display: ["Sora", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "touch-dark": "#03403F",
                "touch-deep": "#064B4A",
                "touch-gold": "#D9A323",
                "touch-white": "#FFFFFF",
                "touch-text": "#172C2B",
                "touch-muted": "#637372",
                "touch-surface": "#F7F9F8",
                "touch-soft": "#EAF1F0",
                "touch-border": "#DCE6E4",
                // Compatibility aliases for untouched phase-one sections.
                brand: {
                    navy: "#03403F", teal: "#064B4A", deep: "#064B4A",
                    gold: "#D9A323", blue: "#DCE6E4", slate: "#637372",
                    light: "#F7F9F8", white: "#FFFFFF", yellow: "#D9A323",
                    charcoal: "#637372",
                },
            },
        },
    },
    plugins: [forms],
};
