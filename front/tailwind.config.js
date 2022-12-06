/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{html,vue,js,ts,jsx,tsx}",
    "./node_modules/flowbite/**/*.js",
    './node_modules/tw-elements/dist/js/**/*.js'
  ],
  theme: {
    colors: {
      'primary': '#1E90FF',
      'secondary': '#001162',
    },
    extend: {},
  },
  plugins: [
    require('flowbite/plugin'),
    require('tw-elements/dist/plugin')
  ],
}
