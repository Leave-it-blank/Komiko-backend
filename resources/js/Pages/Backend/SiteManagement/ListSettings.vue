<script setup>
import AppLayout from "@/Layouts/App.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head } from "@inertiajs/inertia-vue3";
import { ref, reactive, computed } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import SectionMain from "@/components/backend/SectionMain.vue";
import { useSiteStore } from "@/stores/site";
import { useMainStore } from "@/stores/main";
const props = defineProps({
  settings: {
    type: Object,
    default: null,
  },
  errors: {
    type: Object,
  },
});

//console.log(props.settings)
const settingsForm = useForm({
  site_name: String(props.settings.site_name),
  site_url: String(props.settings.site_url),
  debug_mode: props.settings.debug_mode,
  session_encryption: props.settings.session_encryption,
  cache_drive: String(props.settings.cache_drive),
  patreon: String(props.settings.patreon),
  disqus_shortname: String(props.settings.disqus_shortname),
  discord_server_id: String(props.settings.discord_server_id),
  discord_invite: String(props.settings.discord_invite),
  adsense: String(props.settings.adsense),
  tag_manager: String(props.settings.tag_manager),
  search: props.settings.search,
  dark_mode: props.settings.dark_mode,
  side_bar: props.settings.side_bar,
  carousel: props.settings.carousel,
});
const siteStore = useSiteStore();

function submit() {
  let url = route("site.management.settings.store");
  settingsForm.post(url);
}

function setSiteModal() {
  //console.log(siteStore.show_site_store);
  siteStore.show_site_store == true
    ? (siteStore.show_site_store = false)
    : (siteStore.show_site_store = true);
  //console.log(siteStore.show_site_store);
}
function setDisqModal() {
  siteStore.show_disq_store == true
    ? (siteStore.show_disq_store = false)
    : (siteStore.show_disq_store = true);
}
function setAnalyticsModal() {
  siteStore.show_analytics_store == true
    ? (siteStore.show_analytics_store = false)
    : (siteStore.show_analytics_store = true);
}
function setDiscordModal() {
  siteStore.show_discord_store == true
    ? (siteStore.show_discord_store = false)
    : (siteStore.show_discord_store = true);
}
function setPatreonModal() {
  siteStore.show_patreon_store == true
    ? (siteStore.show_patreon_store = false)
    : (siteStore.show_patreon_store = true);
}
</script>

<template>
  <AppLayout>
    <SectionMain>
      <div class="container p-2 py-5 mx-auto md:px-10">
        <form
          @submit.prevent="submit"
          enctype="multipart/form-data"
          class="p-2 rounded-md div-text-color md:p-5"
        >
          <div class="text-primary-dark text-gray-300">
            <div class="py-2 text-lg capitalize text-black dark:text-gray-300">
              {{ "Website" }}
            </div>
            <div
              class="grid-rows-2 py-3 text-gray-300 bg-gray-800 rounded-md md:px-2 dark:bg-gray-900"
            >
              <div class="row-span-1">
                <div>
                  <div @click="setSiteModal" class="py-3 hover:cursor-pointer">
                    <div class="flex">
                      <span>
                        <i class="fas fa-blog"></i>
                      </span>
                      <span class="px-2">
                        <div>{{ props.settings.site_name }}</div>
                        <div class="text-xs text-gray-500 muted">
                          {{ props.settings.site_url }}
                        </div>
                      </span>
                    </div>
                  </div>
                  <div
                    v-if="siteStore.show_site_store"
                    class="grid w-full grid-cols-2 px-2 my-2 text-sm"
                  >
                    <div href="#" class="block col-span-1 px-4 py-2">
                      <div>Website Name</div>
                      <div>
                        <input
                          v-model="settingsForm.site_name"
                          class="block w-full px-3 py-2 mt-1 border border-gray-400 text-black rounded-md"
                          placeholder="Jane Doe"
                        />
                      </div>
                    </div>
                    <div href="#" class="block col-span-1 px-4 py-2">
                      <div>Website Url</div>
                      <div>
                        <input
                          v-model="settingsForm.site_url"
                          class="block w-full px-3 py-2 mt-1 border border-gray-400 text-black rounded-md"
                          placeholder="Jane Doe"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row-span-1">
                <div class="flex justify-between py-2">
                  <span class="px-2">
                    <div>Debug Mode</div>
                    <div class="text-xs text-gray-500 muted">
                      Shows the errors in the application to users.
                    </div>
                  </span>
                  <div>
                    <div>
                      <select
                        v-model="settingsForm.debug_mode"
                        class="rounded-md bg-transparent text-gray-300"
                      >
                        <option class="p-2 m-2 bg-gray-800" :value="true">
                          Enabled
                        </option>
                        <option class="p-2 m-2 bg-gray-800" :value="false">
                          Disabled
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="text-primary-dark text-gray-300">
            <div class="py-2 text-lg capitalize text-black dark:text-gray-300">
              {{ "Session & Auth [wip]" }}
            </div>
            <div
              class="grid-rows-2 py-3 text-gray-300 bg-gray-800 rounded-md md:px-2 dark:bg-gray-900"
            >
              <div class="row-span-1">
                <div class="flex justify-between py-2">
                  <span class="px-2">
                    <div>Session Encryption</div>
                    <div class="text-xs text-gray-500 muted">
                      Improve security by encrypting session data.
                    </div>
                  </span>
                  <div>
                    <div class="justify-end">
                      <select
                        v-model="settingsForm.session_encryption"
                        class="rounded-md bg-transparent text-gray-300"
                      >
                        <option class="p-2 m-2 bg-gray-800" :value="true">
                          Enabled
                        </option>
                        <option class="p-2 m-2 bg-gray-800" :value="false">
                          Disabled
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row-span-1">
                <div class="flex justify-between py-2">
                  <span class="px-2">
                    <div>Cache Driver</div>
                    <div class="text-xs text-gray-500 muted">
                      Improve performance by changing the cache driver.
                    </div>
                  </span>
                  <div>
                    <div class="justify-end">
                      <select
                        v-model="settingsForm.cache_drive"
                        class="rounded-md bg-transparent text-gray-300"
                      >
                        <option class="p-2 m-2 bg-gray-800" value="redis">
                          Redis
                        </option>
                        <option class="p-2 m-2 bg-gray-800" value="database">
                          Database
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="text-primary-dark text-gray-300">
            <div class="py-2 text-lg capitalize text-black dark:text-gray-300">
              {{ "Misc" }}
            </div>
            <div
              class="grid-rows-2 py-3 text-gray-300 bg-gray-800 rounded-md md:px-2 dark:bg-gray-900"
            >
              <div class="row-span-1">
                <div>
                  <div
                    @click="setDiscordModal"
                    class="py-3 hover:cursor-pointer"
                  >
                    <div class="flex px-2">
                      <span>
                        <i class="fab fa-discord"></i>
                      </span>
                      <span class="">
                        <div>Discord</div>
                        <div class="text-xs text-gray-500 muted">
                          Enable the widget or add your invite link.
                        </div>
                      </span>
                    </div>
                  </div>
                  <div
                    v-if="siteStore.show_discord_store"
                    class="grid w-full grid-cols-2 px-2 my-2 text-sm"
                  >
                    <div class="block col-span-1 px-4 py-2">
                      <div>Discord Server ID:</div>
                      <div>
                        <input
                          v-model="settingsForm.discord_server_id"
                          class="block w-full px-3 py-2 mt-1 border border-gray-400 rounded-md text-black"
                          placeholder="23213123132313"
                        />
                      </div>
                    </div>
                    <div href="#" class="block col-span-1 px-4 py-2">
                      <div>Invite Link</div>
                      <div>
                        <input
                          v-model="settingsForm.discord_invite"
                          class="block w-full px-3 py-2 mt-1 border border-gray-400 rounded-md text-black"
                          placeholder="kario.io"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row-span-1">
                <div>
                  <div
                    @click="setPatreonModal"
                    class="py-3 hover:cursor-pointer"
                  >
                    <div class="flex px-2">
                      <span>
                        <i class="fab fa-patreon"></i>
                      </span>
                      <span class="">
                        <div>Patreon</div>
                        <div class="text-xs text-gray-500 muted">
                          Add your donation link provided by Patreon.
                        </div>
                      </span>
                    </div>
                  </div>
                  <div
                    v-if="siteStore.show_patreon_store"
                    class="grid w-full grid-cols-1 px-2 my-2 text-sm"
                  >
                    <div href="#" class="block col-span-1 px-4 py-2">
                      <div>Patreon Link</div>
                      <div>
                        <input
                          v-model="settingsForm.patreon"
                          class="block w-full px-3 py-2 mt-1 border border-gray-400 rounded-md text-black"
                          placeholder="Patreon.com"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row-span-1">
                <div>
                  <div
                    @click="setAnalyticsModal"
                    class="py-3 hover:cursor-pointer"
                  >
                    <div class="flex px-2">
                      <span>
                        <i class="fab fa-adn"></i>
                      </span>
                      <span class=" ">
                        <div>Adsense and Tag Manager</div>
                        <div class="text-xs text-gray-500 muted">
                          Add your analytics code to monitor your website
                          traffic or tag Manager to change stuff on fly in your
                          site.
                        </div>
                      </span>
                    </div>
                  </div>
                  <div
                    v-if="siteStore.show_analytics_store"
                    class="grid w-full grid-cols-1 px-2 my-2 text-sm"
                  >
                    <div href="#" class="block w-full col-span-1 px-4 py-2">
                      <div>
                        <div class="text-sm pb-1">
                          <label>Tag Manager</label>
                        </div>

                        <input
                          v-model="settingsForm.tag_manager"
                          class="block w-full px-3 py-2 mt-1 border border-gray-400 rounded-md text-black"
                        />
                      </div>
                    </div>
                    <div href="#" class="block col-span-1 px-4 py-2 text-sm">
                      <div class="pb-1">
                        <label>Adsense Code</label>
                      </div>
                      <textarea
                        v-model="settingsForm.adsense"
                        class="w-full border border-gray-400 text-black rounded-md"
                      ></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row-span-1">
                <div>
                  <div @click="setDisqModal" class="py-3 hover:cursor-pointer">
                    <div class="flex px-2">
                      <span>
                        <i class="fas fa-disease"></i>
                      </span>
                      <span class="">
                        <div>Disque</div>
                        <div class="text-xs text-gray-500 muted">
                          Enable comments on comics and chapters using Disqus.
                        </div>
                      </span>
                    </div>
                  </div>
                  <div
                    v-if="siteStore.show_disq_store"
                    class="grid w-full grid-cols-1 px-2 my-2 text-sm"
                  >
                    <div class="block col-span-1 px-4 py-2">
                      <div class="text-sm">Short Name</div>
                      <div>
                        <input
                          v-model="settingsForm.disqus_shortname"
                          class="block w-full px-3 py-2 mt-1 border border-gray-400 rounded-md text-black"
                          placeholder="https-scans-com"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="text-black dark:text-gray-300">
            <div class="py-2 text-lg capitalize">{{ "General" }}</div>
            <div
              class="grid-rows-1 py-3 text-gray-300 bg-gray-800 rounded-md md:px-2 dark:bg-gray-900 er dark:text-gray-300"
            >
              <div class="row-span-1">
                <div class="flex justify-between py-2">
                  <span class="px-2">
                    <div class="dark:text-gray-300">Comic Search</div>
                    <div class="text-xs text-gray-500 muted">
                      Enable comic searching that allows your users to filter
                      the comics in your collection.
                    </div>
                  </span>
                  <div>
                    <div class="justify-end">
                      <select
                        v-model="settingsForm.search"
                        class="rounded-md bg-transparent text-gray-300"
                      >
                        <option class="p-2 m-2 bg-gray-800" :value="true">
                          Enabled
                        </option>
                        <option class="p-2 m-2 bg-gray-800" :value="false">
                          Disabled
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="text-primary-dark dark:text-gray-300">
            <div class="py-2 text-lg capitalize">{{ "Homepage" }}</div>
            <div
              class="grid-rows-2 py-3 text-gray-300 bg-gray-800 rounded-md md:px-2 dark:bg-gray-900 er dark:text-gray-300"
            >
              <div class="row-span-1">
                <div class="flex justify-between py-2">
                  <span class="px-2">
                    <div class="dark:text-gray-300">Sidebar</div>
                    <div class="text-xs text-gray-500 muted">
                      Enable the sidebar on the homepage to display additional
                      widgets.
                    </div>
                  </span>
                  <div>
                    <div class="justify-end">
                      <select
                        v-model="settingsForm.side_bar"
                        class="rounded-md bg-transparent text-gray-300"
                      >
                        <option class="p-2 m-2 bg-gray-800" :value="true">
                          Enabled
                        </option>
                        <option class="p-2 m-2 bg-gray-800" :value="false">
                          Disabled
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row-span-1">
                <div class="flex justify-between py-2">
                  <span class="px-2">
                    <div class="dark:text-gray-300">Carousel</div>
                    <div class="text-xs text-gray-500 muted">
                      Enable the carousel on the homepage to display the items
                      added in the Carousel section.
                    </div>
                  </span>
                  <div>
                    <div class="justify-end">
                      <select
                        v-model="settingsForm.carousel"
                        class="rounded-md bg-transparent text-gray-300"
                      >
                        <option class="p-2 m-2 bg-gray-800" :value="true">
                          Enabled
                        </option>
                        <option class="p-2 m-2 bg-gray-800" :value="false">
                          Disabled
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="text-primary-dark dark:text-gray-300">
            <div class="py-2 text-lg capitalize">{{ "Reader" }}</div>
            <div
              class="grid-rows-2 py-3 text-gray-300 bg-gray-800 rounded-md md:px-2 dark:bg-gray-900 er dark:text-gray-300"
            >
              <div class="row-span-1">
                <div class="flex justify-between py-2">
                  <span class="px-2">
                    <div class="dark:text-gray-300">Dark Mode</div>
                    <div class="text-xs text-gray-500 muted">
                      Enables the toggle.
                    </div>
                  </span>
                  <div>
                    <div class="justify-end">
                      <select
                        v-model="settingsForm.dark_mode"
                        class="rounded-md bg-transparent text-gray-300"
                      >
                        <option class="p-2 m-2 bg-gray-800" :value="true">
                          Enabled
                        </option>
                        <option class="p-2 m-2 bg-gray-800" :value="false">
                          Disabled
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div
              v-if="
                props.errors.site_name ||
                props.errors.site_url ||
                props.errors.debug_mode ||
                props.errors.session_encryption ||
                props.errors.cache_drive ||
                props.errors.patreon ||
                props.errors.disqus_shortname ||
                props.errors.discord_server_id ||
                props.errors.discord_invite ||
                props.errors.analytics ||
                props.errors.tag_manager ||
                props.errors.search ||
                props.errors.dark_mode ||
                props.errors.side_bar ||
                props.errors.carousel
              "
              class="text-primary-dark dark:text-gray-300"
            >
              <div class="py-2 text-lg capitalize">{{ "Errors" }}</div>
              <div
                class="grid-rows-2 py-3 text-gray-300 bg-gray-800 rounded-md md:px-2 dark:bg-gray-900 er dark:text-gray-300"
              >
                <div class="row-span-1">
                  {{
                    props.errors.site_name +
                    props.errors.site_url +
                    props.errors.debug_mode +
                    props.errors.session_encryption +
                    props.errors.cache_drive +
                    props.errors.patreon +
                    props.errors.disqus_shortname +
                    props.errors.discord_server_id +
                    props.errors.discord_invite +
                    props.errors.analytics +
                    props.errors.tag_manager +
                    props.errors.search +
                    props.errors.dark_mode +
                    props.errors.side_bar +
                    props.errors.carousel
                  }}
                </div>
              </div>
            </div>
            <div class="flex justify-end m-2 mt-5 md:m-4">
              <button
                type="submit"
                class="justify-center w-1/3 p-4 bg-gray-800 dark:bg-gray-900 text-white rounded-md my-2 dark:border dark:border-gray-400"
              >
                Update Settings
              </button>
            </div>
          </div>
        </form>
      </div>
    </SectionMain>
  </AppLayout>
</template>
