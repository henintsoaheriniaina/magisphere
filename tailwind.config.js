/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: [
                    "Poppins",
                    "system-ui",
                    "-apple-system",
                    "BlinkMacSystemFont",
                    "Segoe UI",
                    "Helvetica Neue",
                    "Arial",
                    "sans-serif",
                ],
            },
            colors: {
                vintageRed: {
                    default: "#B22222",
                    dark: "#8B0000",
                    light: "#CD5C5C",
                },
                classic: {
                    white: "#F2F2F2",
                    black: "#1A1A1A",
                },
            },
        },
    },
    plugins: [],
};
