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
  'Management',
  [{
    route: 'comics_management.comics',
    label: 'Comics',
    icon: mdiTable
  },
   /*  {
      label: 'Chapters',
      icon: mdiTelevisionGuide,
      menu: [
        {
          label: 'Upload',
          route: 'dashboard',
          icon: mdiResponsive
        },
        {
          label: 'View',
          route: 'comics_management.comics',
          icon: mdiPalette
        }
      ]
    }, */

    {
      route: 'authentication.users',
      label: 'Users',
      icon: mdiSquareEditOutline
    },
    {
      route: 'admin.management.carousel',
      label: 'Carousels',
      icon: mdiTelevisionGuide
    },
    {
      route: 'site.management.advertisements.view',
      label: 'Advertisement',
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
    }

  ],
  'About',
  [
    {

      label: 'Subcriptions',
      icon: mdiMonitorShimmer,

    },
    {
      route: 'site.management.settings',
      label: 'Settings',
      icon: mdiGithub,

    }
  ]
]
