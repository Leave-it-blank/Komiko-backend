<template>
  <footer
    class="relative w-full bottom-0 dark:bg-neutral-900 bg-neutral-200 pb-6"
  >
    <div class="container mx-auto px-4">
      <hr class="mb-6 border-b-1 border-gray-700" />
      <div
        class="flex flex-wrap items-center md:justify-between justify-center"
      >
        <div class="w-full md:w-4/12 px-4">
          <div
            class="text-sm text-neutral-900 hover:text-gray-900 dark:text-white dark:hover:text-gray-400 font-semibold py-1"
          >
            {{ $page.props.sitedata.site_name }} © {{ date }}
            <a
              href="#"
              class="text-neutral-900 hover:text-gray-900 dark:text-white dark:hover:text-gray-400 text-sm font-semibold py-1"
              >MIMI</a
            >
          </div>
        </div>
        <div class="w-full md:w-8/12 px-4">
          <ul class="flex flex-wrap list-none md:justify-end justify-end">
            <li>
              <a
                href="#"
                class="text-neutral-900 hover:text-gray-900 dark:text-white dark:hover:text-gray-400 text-sm font-semibold block py-1 px-3"
                >Back To Top</a
              >
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
</template>
<script setup>
const date = new Date().getFullYear();
</script>
