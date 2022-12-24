<script setup>
import { RouterLink, useRouter } from "vue-router";
import { mdiGithub } from "@mdi/js";
import SectionTitle from "@/components/backend/SectionTitle.vue";
import BaseIcon from "@/components/backend/BaseIcon.vue";

const routes = useRouter().getRoutes();

const screens = [];

for (const routeIndex in routes) {
  const path = routes[routeIndex].path;
  const title =
    routes[routeIndex].meta && routes[routeIndex].meta.title
      ? routes[routeIndex].meta.title
      : null;

  if (title) {
    screens.push({
      path,
      title,
    });
  }
}
</script>

<template>
  <SectionTitle last>
    <h1
      class="flex items-center justify-center flex-col md:flex-row text-2xl text-gray-500 dark:text-gray-400 mb-12"
    >
      2022@Mimo Github - BLaaS
    </h1>
  </SectionTitle>
</template>
