<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import JetApplicationMark from '@/Jetstream/ApplicationMark.vue';
import JetBanner from '@/Jetstream/Banner.vue';
import JetDropdown from '@/Jetstream/Dropdown.vue';
import JetDropdownLink from '@/Jetstream/DropdownLink.vue';
import JetNavLink from '@/Jetstream/NavLink.vue';
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue';
import ReaderNavBar from '@/components/frontend/navigation/ReaderNavBar.vue'
defineProps({
  title: String,
});

const showingNavigationDropdown = ref(false);


const logout = () => {
  Inertia.post(route('logout'));
};
</script>

<template>
  <div>
    <Head :title="title" />
      <!-- Page Content -->
      <ReaderNavBar />
      <main>
          <div class="dark:bg-black w-full h-screen">
                 <slot />
         </div>

      </main>

    </div>

</template>
