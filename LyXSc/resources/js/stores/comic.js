import { defineStore } from 'pinia'
import * as styles from '@/styles'
import { darkModeKey, styleKey } from '@/config'
import axios from 'axios'

export const useComicStore = defineStore('main', {
  state: () => ({
  comics: [],
  chapters: [],
  })

  });
