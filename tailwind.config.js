/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{php,html,js}", "./index.php"],
  theme: {
    extend: {
      fontFamily: {
        'pop': ['Poppins', 'sans-serif'],
      },
      backgroundImage: {
        'main': "url('./../assets/bg.webp')",
      },
    },
  },
  plugins: [],
}