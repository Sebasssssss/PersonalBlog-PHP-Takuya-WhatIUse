/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      './src/**/*.php',
      './src/frontend/**/*.php',
      './src/backend/**/*.php',
  ],
  darkMode: 'class',
  theme: {
    extend: {
		  fontFamily: {
				mplus: ["'M PLUS Rounded 1c'", 'Verdana', 'sans-serif']
			}
    },
  },
  plugins: [],
}
