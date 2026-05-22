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
            // ─────────────────────────────────────────────────────────────────
            // TYPOGRAPHY
            // Inter is a versatile, highly legible sans-serif that pairs well
            // with the premium but approachable Touch2finish brand.
            // ─────────────────────────────────────────────────────────────────
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
                display: ["Sora", ...defaultTheme.fontFamily.sans],
            },

            // ─────────────────────────────────────────────────────────────────
            // COLOUR PALETTE — Touch2finish Brand System
            //
            // brand-navy    (#071B3B) — PRIMARY DARK BACKGROUND / hero base.
            //   Use for: hero sections, footer, deep-contrast backgrounds.
            //
            // brand-teal    (#157D9A) — PRIMARY INTERACTIVE / accent.
            //   Use for: buttons, icon highlights, borders, links, headings on
            //            white/light backgrounds. NOT for body text.
            //
            // brand-deep    (#0D5876) — DEEP TEAL VARIANT.
            //   Use for: hover states on teal elements, section backgrounds
            //            that need more depth than teal but less than navy.
            //
            // brand-gold    (#E2AE49) — CTA / SECONDARY ACCENT.
            //   Use for: primary CTA buttons, active states, icon fills,
            //            decorative underlines, badge backgrounds.
            //
            // brand-blue    (#CBD9DC) — SOFT BLUE GREY.
            //   Use for: section backgrounds, card borders, subtle dividers,
            //            input backgrounds, table stripes.
            //
            // brand-slate   (#485465) — BODY TEXT / UI TEXT.
            //   Use for: body copy, labels, captions, secondary text.
            //            Replaces old brand-charcoal.
            //
            // brand-light   (#F4F7F8) — PAGE BACKGROUND.
            //   Use for: alternating section backgrounds, card fills.
            //
            // brand-white   (#FFFFFF) — PURE WHITE SURFACES.
            // ─────────────────────────────────────────────────────────────────
            colors: {
                brand: {
                    navy: "#071B3B", // Primary dark background
                    teal: "#157D9A", // Primary interactive accent
                    deep: "#0D5876", // Deep teal variant / hover
                    gold: "#E2AE49", // CTA / secondary accent
                    blue: "#CBD9DC", // Soft blue-grey backgrounds
                    slate: "#485465", // Body / UI text colour
                    light: "#F4F7F8", // Page section background
                    white: "#FFFFFF", // Pure white
                    // Aliases kept so nothing breaks if old names exist in templates
                    yellow: "#E2AE49", // Alias for brand-gold
                    charcoal: "#485465", // Alias for brand-slate
                },
            },

            // ─────────────────────────────────────────────────────────────────
            // SHADOWS
            // On-brand shadows using the teal hue for depth without grey muddy
            // shadows. Use brand-navy shadows on dark sections.
            // ─────────────────────────────────────────────────────────────────
            boxShadow: {
                soft: "0 4px 20px -2px rgba(21, 125, 154, 0.10)",
                "soft-hover": "0 10px 30px -4px rgba(21, 125, 154, 0.22)",
                "soft-lg": "0 20px 40px -8px rgba(21, 125, 154, 0.18)",
                gold: "0 4px 20px -2px rgba(226, 174, 73, 0.25)",
                "gold-hover": "0 10px 30px -4px rgba(226, 174, 73, 0.40)",
                navy: "0 20px 48px -8px rgba(7, 27, 59, 0.35)",
            },

            // ─────────────────────────────────────────────────────────────────
            // BORDER RADIUS
            // ─────────────────────────────────────────────────────────────────
            borderRadius: {
                "2xl": "1rem",
                "3xl": "1.5rem",
            },
        },
    },

    plugins: [forms],
};
