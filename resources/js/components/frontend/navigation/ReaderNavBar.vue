<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Disclosure
    as="nav"
    class="bg-neutral-200 dark:bg-neutral-900"
    v-slot="{ open }"
  >
    <div class="mx-auto px-2 sm:px-6 lg:px-8 font-roboto">
      <div class="relative flex items-center justify-between h-16">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button-->
          <DisclosureButton
            class="inline-flex items-center justify-center p-2 rounded-md text-red-400 hover:text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
          >
            <span class="sr-only">Open main menu</span>
            <MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
            <XIcon v-else class="block h-6 w-6" aria-hidden="true" />
          </DisclosureButton>
        </div>
        <div
          class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start text-purple-800 dark:text-purple-500 font-extrabold capitalize font-roboto dark:hover:text-purple-800 cursor-pointer"
        >
          <div class="flex-shrink-0 flex items-center font-bold text-2xl">
            {{ $page.props.sitedata.site_name }}
          </div>
          <div class="hidden sm:block sm:ml-6">
            <div class="flex space-x-4">
              <Link
                v-for="item in navigation"
                :key="item.name"
                :href="item.href"
                :class="[
                  item.current
                    ? 'text-purple-500 dark:text-purple-300 border-b border-purple-900 hover:animate-pulse'
                    : 'hover:animate-pulse text-gray-800  dark:text-gray-300 hover:border-b hover:border-purple-900 hover:text-gray-900 dark:hover:text-white',
                  'px-3 py-2 rounded-md text-sm font-medium',
                ]"
                :aria-current="item.current ? 'page' : undefined"
                >{{ item.name }}</Link
              >
            </div>
          </div>
        </div>
        <div
          class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0"
        >
          <button
            v-if="$page.props.sitedata.dark_mode"
            type="button"
            class="bg-gray-300 dark:bg-gray-800 p-1 rounded-full dark:text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-purple-500"
          >
            <span class="sr-only">View notifications</span>
            <Switch
              @click="toggleLightDark(enabled)"
              v-model="enabled"
              :class="enabled ? 'bg-purple-400' : '  bg-purple-600'"
              class="relative inline-flex h-6 w-11 items-center rounded-full hover:animate-pulse"
            >
              <span class="sr-only">Dark Mode</span>
              <span
                :class="enabled ? 'translate-x-1' : '  translate-x-6'"
                class="inline-block h-4 w-4 transform rounded-full bg-white"
              />
            </Switch>
          </button>

          <!-- Profile dropdown -->
          <Menu as="div" class="ml-3 relative">
            <div>
              <MenuButton
                class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
              >
                <span class="sr-only">Open user menu</span>
                <img
                  class="h-8 w-8 rounded-full hover:animate-spin"
                  src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                  alt=""
                />
              </MenuButton>
            </div>
            <transition
              enter-active-class="transition ease-out duration-100"
              enter-from-class="transform opacity-0 scale-95"
              enter-to-class="transform opacity-100 scale-100"
              leave-active-class="transition ease-in duration-75"
              leave-from-class="transform opacity-100 scale-100"
              leave-to-class="transform opacity-0 scale-95"
            >
              <MenuItems
                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white dark:bg-black first-line: ring-1 ring-purple-400 ring-opacity-25 focus:outline-none"
              >
                <MenuItem v-slot="{ active }">
                  <Link
                    :href="profile"
                    :class="[
                      active ? 'bg-gray-100 dark:bg-gray-600' : '',
                      'block px-4 py-2 text-sm text-gray-700 dark:text-gray-200',
                    ]"
                    >Your Profile</Link
                  >
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <Link
                    href="#"
                    :class="[
                      active ? 'bg-gray-100 dark:bg-gray-600' : '',
                      'block px-4 py-2 text-sm text-gray-700 dark:text-gray-200',
                    ]"
                    >Settings
                  </Link>
                </MenuItem>
                <div v-if="$page.props.auth.user">
                  <MenuItem
                    v-slot="{ active }"
                    v-if="
                      $page.props.auth.user.permissions.filter((x) =>
                        permArray.includes(x)
                      ).length !== 0
                    "
                  >
                    <a
                      :href="dashboard"
                      :class="[
                        active ? 'bg-gray-100 dark:bg-gray-600' : '',
                        'block px-4 py-2 text-sm text-gray-700 dark:text-gray-200',
                      ]"
                      >Dashboard</a
                    >
                  </MenuItem>
                </div>

                <MenuItem v-slot="{ active }" v-if="$page.props.auth.user">
                  <a
                    @click="logout"
                    :class="[
                      active ? 'bg-gray-100 dark:bg-gray-600' : '',
                      'block px-4 py-2 text-sm text-gray-700 dark:text-gray-200',
                    ]"
                    >Sign out</a
                  >
                </MenuItem>
                <MenuItem v-slot="{ active }" v-if="!$page.props.auth.user">
                  <Link
                    :href="login"
                    :class="[
                      active ? 'bg-gray-100 dark:bg-gray-600' : '',
                      'block px-4 py-2 text-sm text-gray-700 dark:text-gray-200',
                    ]"
                    >Login</Link
                  >
                </MenuItem>
              </MenuItems>
            </transition>
          </Menu>
        </div>
      </div>
    </div>

    <DisclosurePanel class="sm:hidden">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <DisclosureButton
          v-for="item in navigation"
          :key="item.name"
          as="div"
          :class="[
            item.current
              ? 'bg-purple-600 text-gray-200'
              : 'text-gray-800  dark:text-gray-300 hover:bg-purple-800 font-roboto hover:text-gray-50',
            'block px-3 py-2 rounded-md text-base font-medium',
          ]"
          :aria-current="item.current ? 'page' : undefined"
        >
          <Link :href="item.href"> {{ item.name }} </Link>
        </DisclosureButton>
      </div>
    </DisclosurePanel>
  </Disclosure>
</template>

<script setup>
import {
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  Switch,
} from "@headlessui/vue";
import { MenuIcon, XIcon } from "@heroicons/vue/outline";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { computed, ref } from "vue";
import { useMainStore } from "@/stores/main";
import { usePage } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

const mainStore = useMainStore();
const enabled = ref(!mainStore.darkMode);

const toggleLightDark = (enabled) => {
  mainStore.setDarkMode(enabled);
};
const permArray = [
  "view dashboard",
  "handle dashboard",
  "view comic management",
];
const logout = () => {
  Inertia.post(route("logout"));
};
const profile = route("profile.show");
const login = route("login");
const dashboard = route("dashboard");
const navigation = [
  {
    name: "Home",
    href: route("reader.homepage.view"),
    current: route().current() === "reader.homepage.view" ? true : false,
  },
  {
    name: "Latest",
    href: route("reader.latestpage.view"),
    current: route().current() === "reader.latestpage.view" ? true : false,
  },
  {
    name: "Comics",
    href: route("reader.comicspage.view"),
    current: route().current() === "reader.comicspage.view" ? true : false,
  },
];
</script>
