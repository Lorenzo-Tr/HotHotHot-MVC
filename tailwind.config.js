const colors = require('tailwindcss/colors');

module.exports = {
  content: [
    './resources/views/**/*.{php,html}',
    './public/**/*.{js,jsx,ts,tsx,vue}'
  ],
  theme: {
    extend: {},
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      gray: colors.neutral,
      indigo: colors.indigo,
      yellow: colors.amber,
      blue: {
        50: '#F0F5FF',
        100: '#BED6FE',
        200: '#8BB6FD',
        300: '#5996FD',
        DEFAULT: '#2776FC',
        500: '#035AEC',
        600: '#0347BA',
        700: '#023488',
        800: '#012156',
      },
      red: {
        50: '#FDEBE8',
        100: '#F9C4B9',
        200: '#F49C8A',
        300: '#F0755B',
        DEFAULT: '#EC4D2C',
        500: '#D33413',
        600: '#A4280F',
        700: '#751D0B',
        800: '#461106',
      },
      purple: {
        50: '#EDDEFC',
        100: '#D2AFF8',
        200: '#B880F4',
        300: '#9D51F0',
        DEFAULT: '#8322EC',
        500: '#6A11CB',
        600: '#510D9B',
        700: '#39096C',
        800: '#20053D',
      },
      myBg: "#1E1E1E"
    }
  },
  plugins: [],
}