import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.jsx",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Poppins", ...defaultTheme.fontFamily.sans],
                porter: ["Porter Sans Block", "sans-serif"],
            },
            keyframes: {
                float: {
                    "0%, 100%": {
                        transform: "translateY(0)",
                    },
                    "50%": {
                        transform: "translateY(-10px)",
                    },
                },
            },
            colors: {
                bgGreen: "#D4DB95",
                pillPink: "#F1B2BA",
                textRed: "#D07270",
                lineColor: "#D07270",
                cardBorder: "#eab3bb",
                starYellow: "#FFFAD0",
                workGreen: "#BADD7F",
                flowRed: "#d06b72",
                glowYellow: "#FFFBD6",
                textGreen: "#6f8746",
            },
            animation: {
                "spin-slow": "spin 8s linear infinite",
                float: "float 3s ease-in-out infinite",
            },
        },
    },

    plugins: [forms],
};
