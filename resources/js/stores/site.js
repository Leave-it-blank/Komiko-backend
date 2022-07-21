import { defineStore } from 'pinia'
import * as styles from '@/styles'
import { darkModeKey, styleKey } from '@/config'
import axios from 'axios'

export const useSiteStore = defineStore('site', {
  state: () => ({
  show_disq_store: false,
  show_site_store: false,
  show_analytics_store: false,
  show_discord_store: false,
  show_patreon_store: false,
    /* User */
    userName: null,
    userEmail: null,
    userAvatar: null,

    /* User update*/
    userDataName: null,
    userDataEmail: null,

    /* fullScreen - fullscreen form layout (e.g. login page) */
    isFullScreen: true,

    /* Aside */
    isAsideMobileExpanded: false,
    isAsideLgActive: false,

    /* Dark mode */
    darkMode: false,
    comicId: 0,

    /* Field focus with ctrl+k (to register only once) */
    isFieldFocusRegistered: false,

    /* Sample data (commonly used) */
    clients: [],
    history: [],
    comics: []
  }),
  actions: {
    setUser (payload) {
      if (payload.name) {
        this.userName = payload.name
      }
      if (payload.email) {
        this.userEmail = payload.email
      }
      if (payload.avatar) {
        this.userAvatar = payload.avatar
      }
    },

    setStyle (payload) {
      if (!styles[payload]) {
        return
      }

      this.style = payload

      const style = styles[payload]

      document.body.className = style.body

      if (localStorage[styleKey] !== payload) {
        localStorage.setItem(styleKey, payload)
      }

      for (const key in style) {
        this[`${key}Style`] = style[key]
      }
    },



    setDarkMode (payload = null) {
      const value = payload !== null ? payload : !this.darkMode

      document.documentElement.classList[value ? 'add' : 'remove']('dark')

      localStorage.setItem(darkModeKey, value ? '1' : '0')

      this.darkMode = value
    },

    fetch (sampleDataKey) {
      axios
        .get(`data-sources/${sampleDataKey}.json`)
        .then(r => {
          if (r.data && r.data.data) {
            this[sampleDataKey] = r.data.data
          }
        })
        .catch(error => {
          alert(error.message)
        })
    }
  }
})
