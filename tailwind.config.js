const colors = require('tailwindcss/colors')
module.exports = {
    content: [
      './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
      './vendor/laravel/jetstream/**/*.blade.php',
      './storage/framework/views/*.php',
      './resources/views/**/*.blade.php',
      './resources/js/**/*.vue',
      './resources/js/**/*.js',
    ],

    darkMode: 'class',

    theme: {

      extend: {
        colors: {
          darkMode: '#0d0d0d',
        },
        zIndex: {
          '-1': '-1'
        },
        flexGrow: {
          5: '5'
        },
        maxHeight: {
          'screen-menu': 'calc(100vh - 3.5rem)',
          modal: 'calc(100vh - 160px)'
        },
        transitionProperty: {
          position: 'right, left, top, bottom, margin, padding',
          textColor: 'color'
        },
        keyframes: {
          fadeOut: {
            from: {opacity: 1},
            to: {opacity: 0}
          },
          fadeIn: {
            from: {opacity: 0},
            to: {opacity: 1}
          }
        },
        animation: {
          fadeOut: 'fadeOut 250ms ease-in-out',
          fadeIn: 'fadeIn 250ms ease-in-out'
        },
        fontFamily: {
          'sans': ['ui-sans-serif', 'system-ui'],
          'serif': ['ui-serif', 'Georgia'],
          'mono': ['ui-monospace', 'SFMono-Regular'],
          'roboto': ['Roboto', 'sans-serif'],
          'verdana': ['Verdana', 'sans-serif'],
          'catamaran': ['Catamaran', 'sans-serif'],

        }
      }
    },

    plugins: [
      require('@tailwindcss/forms'),
      require('@tailwindcss/typography'),
      require('@tailwindcss/line-clamp'),
    ],
  };
