import { defineStore } from 'pinia'
import * as styles from '@/styles'
import { darkModeKey, styleKey } from '@/config'
import axios from 'axios'

export const useMainStore = defineStore('main', {
  state: () => ({ }),

  actions: {
    getVolume(){
      Inertia.visit(url, {
        only: ['volumes'],
      })
    }
  }

  });
