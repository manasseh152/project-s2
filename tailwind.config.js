/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/views/**/*.html",
  ],
  theme: {
    extend: {
      gridTemplateRows: {
        layout: "auto 1fr",
      }
    },
  },
  plugins: [require("daisyui")],
}