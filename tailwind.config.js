module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontSize: {
                xxs: [
                    "0.625rem",
                    {
                        lineHeight: "1rem",
                    },
                ],
            },
            transitionProperty: {
                padding: "padding, spacing, margin",
            },
        },
    },
    plugins: [
        require("flowbite/plugin"),
        require("@tailwindcss/forms"),
        require("tailwind-scrollbar"),
        require('@tailwindcss/typography'),
    ],
};
