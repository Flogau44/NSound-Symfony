/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./assets/**/*.{vue,js,ts,jsx,tsx}", "./templates/**/*.html.twig"],
  theme: {
    colors: {
      white: "#ffffff",
      "white-800": "rgba(255, 255, 255, 0.8)",
      black: "#000000",
      "black-500": "rgba(0, 0, 0, 0.5)",
      red: "#FF4545",
      "red-100": "rgba(255, 69, 69, 0.1)",
      "red-400": "rgba(255, 69, 69, 0.4)",
      "red-700": "rgba(255, 69, 69, 0.7)",
      darkblue: "#0B162C",
      "darkblue-100": "rgba(11, 24, 44, 0.1)",
      "darkblue-300": "rgba(11, 24, 44, 0.3)",
      "darkblue-500": "rgba(11, 24, 44, 0.5)",
      "darkblue-700": "rgba(11, 24, 44, 0.7)",
      "darkblue-900": "rgba(11, 24, 44, 0.9)",
      navyblue: "#1C2942",
      "navyblue-700": "rgba(28, 41, 66, 0.7)",
      "navyblue-900": "rgba(28, 41, 66, 0.9)",
      blue: "#3B556D",
      "blue-100": "rgba(59, 85, 109, 0.1)",
      "blue-300": "rgba(59, 85, 109, 0.3)",
      "blue-500": "rgba(59, 85, 109, 0.5)",
      "blue-700": "rgba(59, 85, 109, 0.7)",
      "blue-900": "rgba(59, 85, 109, 0.9)",
      lightblue: "#5FC2BA",
      "lightblue-700": "rgba(95, 194, 186, 0.7)",
      "lightblue-900": "rgba(95, 194, 186, 0.9)",
    },
    extend: {
      fontFamily: {
        Roboto: ["Roboto", "sans-serif"],
        "cormorant-garamond": ["Cormorant Garamond", "serif"],
      },
      zIndex: {
        100: "100",
        999: "999",
      },
      keyframes: {
        "slide-in-left": {
          "0%": {
            opacity: "0",
            transform: "translateX(-400px)",
          },
          "100%": {
            opacity: "1",
            transform: "translateX(0)",
          },
        },
      },
      animation: {
        slideinleft: "slide-in-left 1s ease-in-out 0s 1",
      },
    },
  },
  plugins: [],
};
