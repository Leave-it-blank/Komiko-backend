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
      label: 'Dashboard',
      permission: ['handle dashboard' , 'view dashboard']
    }
  ],
  'Management',
  [{
    route: 'comics_management.comics',
    label: 'Comics',
    icon: mdiTable,
    permission: ['view comic management' , 'handle comic management']
  },
  {
    route: 'admin.management.tags',
    label: 'Tags',
    icon: mdiTelevisionGuide,
    permission: ['handle management' , 'view management']
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
      icon: mdiSquareEditOutline,
      permission: ['handle authentication' , 'view authentication']

    },
    {
      route: 'admin.management.carousel',
      label: 'Carousels',
      icon: mdiTelevisionGuide,
      permission: ['handle management' , 'view management']
    },
    {
      route: 'site.management.advertisements.view',
      label: 'Advertisement',
      icon: mdiResponsive,
      permission: ['handle management' , 'view management']
    },
    {
      route: 'dashboard',
      label: 'Styles',
      icon: mdiPalette,
      permission: ['admin']
    },
    {
      route: 'profile.show',
      label: 'Profile',
      icon: mdiAccountCircle,
      permission: ['reader' , 'view dashboard' ]
    }

  ],
  'Site',
  [
    {

      label: 'Subcriptions',
      icon: mdiMonitorShimmer,
      permission: ['admin' , 'view dashboard']

    },
    {
      route: 'site.management.settings',
      label: 'Settings',
      icon: mdiGithub,
      permission: ['handle settings management' , 'view settings']

    }
  ]
]
