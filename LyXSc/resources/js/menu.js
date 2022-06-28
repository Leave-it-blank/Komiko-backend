import {
  mdiAccountCircle,
  mdiDesktopMac,
  mdiGithub,
  mdiLock,
  mdiAlertCircle,
  mdiMonitorShimmer,
  mdiSquareEditOutline,
  mdiTable,
  mdiViewList,
  mdiTelevisionGuide,
  mdiResponsive,
  mdiPalette
} from '@mdi/js'

export default [
  'General',
  [
    {
      route: 'dashboard',
      icon: mdiDesktopMac,
      label: 'Dashboard'
    }
  ],
  'Examples',
  [
    {
      route: 'dashboard',
      label: 'Tables',
      icon: mdiTable
    },
    {
      route: 'authentication.users',
      label: 'Users',
      icon: mdiSquareEditOutline
    },
    {
      route: 'dashboard',
      label: 'UI',
      icon: mdiTelevisionGuide
    },
    {
      route: 'dashboard',
      label: 'Responsive',
      icon: mdiResponsive
    },
    {
      route: 'dashboard',
      label: 'Styles',
      icon: mdiPalette
    },
    {
      route: 'profile.show',
      label: 'Profile',
      icon: mdiAccountCircle
    },
    {
      route: 'dashboard',
      label: 'Login',
      icon: mdiLock
    },
    {
      route: 'dashboard',
      label: 'Error',
      icon: mdiAlertCircle
    },
    {
      label: 'dashboard',
      subLabel: 'Submenus Example',
      icon: mdiViewList,
      menu: [
        {
          label: 'Sub-item One'
        },
        {
          label: 'Sub-item Two'
        }
      ]
    }
  ],
  'About',
  [
    {
      href: 'https://justboil.me/tailwind-admin-templates/vue-dashboard/',
      label: 'Premium version',
      icon: mdiMonitorShimmer,
      target: '_blank'
    },
    {
      href: 'https://github.com/justboil/admin-one-vue-tailwind',
      label: 'GitHub',
      icon: mdiGithub,
      target: '_blank'
    }
  ]
]
