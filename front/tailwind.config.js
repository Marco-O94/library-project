/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors');
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{html,vue,js,ts,jsx,tsx}",
    "./node_modules/flowbite/**/*.js",
    './node_modules/tw-elements/dist/js/**/*.js',
    "./src/assets/css/safelist.txt"
  ],
  theme: {
    colors: {
      'primary': '#1E90FF',
      'secondary': '#001162'
    },
    extend: {
      colors: {
        orange: colors.amber,
        red: colors.red,
        yellow: colors.yellow,
        green: colors.green,
        blue: colors.blue,
        indigo: colors.indigo,
        violet: colors.purple,
      }
    },
  },
  plugins: [
    require('flowbite/plugin'),
    require('tw-elements/dist/plugin')
  ],
}
