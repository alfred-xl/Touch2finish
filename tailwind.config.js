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
            // ─────────────────────────────────────────────────────────────
            // TYPOGRAPHY
            // Geist is set as the default sans-serif font.
            // ─────────────────────────────────────────────────────────────
            fontFamily: {
                sans: ["Geist", ...defaultTheme.fontFamily.sans],
            },

            // ─────────────────────────────────────────────────────────────
            // COLOUR PALETTE
            //
            // brand-teal   (#127194) — PRIMARY ACCENT only.
            //   Use for: headings, icon highlights, buttons, borders,
            //            focus rings, and the teal footer/hero backgrounds.
            //   Do NOT use for: body copy, labels, paragraph text.
            //
            // brand-yellow (#F6E304) — SECONDARY ACCENT / CTA colour.
            //   Use for: CTA buttons, hover states, underline accents,
            //            icon backgrounds, badge fills.
            //
            // brand-light  (#F3F3F3) — PAGE BACKGROUND.
            //   Use for: section backgrounds, input backgrounds, card fills.
            //
            // brand-charcoal (#1f1f1f) — BASE BODY TEXT.
            //   Use for: all general paragraph and body copy text.
            //   This replaces the old pattern of using text-brand-teal on
            //   body text, which was saturated and hard to read at length.
            //
            // brand-muted (#6b7280 = Tailwind gray-500) — SECONDARY TEXT.
            //   Use for: captions, labels, meta text, placeholder-style copy.
            //   Available via Tailwind's built-in text-gray-500/600 utilities
            //   — no custom token needed, listed here for documentation only.
            // ─────────────────────────────────────────────────────────────
            colors: {
                brand: {
                    teal: "#127194", // Primary accent
                    yellow: "#F6E304", // CTA / secondary accent
                    light: "#F3F3F3", // Page/section background
                    white: "#FFFFFF", // Pure white surfaces
                    charcoal: "#1f1f1f", // Base body text colour
                    // Legacy alias kept so no existing classes break
                    navy: "#127194",
                },
            },

            // ─────────────────────────────────────────────────────────────
            // SHADOWS
            // All shadows use the brand-teal hue so they feel on-brand
            // rather than the default grey.
            // ─────────────────────────────────────────────────────────────
            boxShadow: {
                soft: "0 4px 20px -2px rgba(18, 113, 148, 0.10)",
                "soft-hover": "0 10px 30px -4px rgba(18, 113, 148, 0.22)",
                "soft-lg": "0 20px 40px -8px rgba(18, 113, 148, 0.18)",
            },
        },
    },

    plugins: [forms],
};
