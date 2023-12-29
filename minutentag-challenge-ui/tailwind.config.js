/** @type {import('tailwindcss').Config} */

export default {
    content: [
        "./index.html",
        "./src/**/*.{vue,js,ts,jsx,tsx}",
    ],
    theme: {
        extend: {
            colors: {
                'primary': {
                    '50': '#fafafa',
                    '100': '#efefef',
                    '200': '#dcdcdc',
                    '300': '#bdbdbd',
                    '400': '#989898',
                    '500': '#7c7c7c',
                    '600': '#656565',
                    '700': '#525252',
                    '800': '#464646',
                    '900': '#3d3d3d',
                    '950': '#292929',
                    DEFAULT: '#fafafa'
                },
                'secondary': {
                    '50': '#fff8eb',
                    '100': '#ffebc6',
                    '200': '#ffd488',
                    '300': '#ffb84a',
                    '400': '#ff9f24',
                    '500': '#f97807',
                    '600': '#dd5402',
                    '700': '#b73706',
                    '800': '#94290c',
                    '900': '#7a230d',
                    '950': '#460f02',
                    DEFAULT: '#ff9f24'
                }
            },
        },
    },
    plugins: [
    ],
}

