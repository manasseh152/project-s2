/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/**/*.twig",
  ],
  theme: {
    extend: {},
  },
  plugins: [require("daisyui")],
}