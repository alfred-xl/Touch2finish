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
                sans: ["Geist", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    navy: "#081D3A",
                    yellow: "#F6E304",
                    light: "#F3F3F3",
                    white: "#FFFFFF",
                },
            },
            boxShadow: {
                soft: "0 4px 20px -2px rgba(8, 29, 58, 0.05)",
                "soft-hover": "0 10px 25px -2px rgba(8, 29, 58, 0.1)",
            },
        },
    },
    plugins: [forms],
};
