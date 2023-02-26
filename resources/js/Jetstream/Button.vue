<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-purple-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-400 focus:outline-none focus:border-purple-900 focus:ring focus:ring-purple-300 disabled:opacity-25 transition">
        <slot />
    </button>
</template>
