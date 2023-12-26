<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() =>
    props.active
        ? 'flex items-center px-2 py-3 rounded-lg bg-blue-700 text-md font-medium text-white ' +
        'focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
        : 'flex items-center px-2 py-3 rounded-lg text-md font-medium text-gray-500 ' +
        'hover:text-white hover:border-gray-300 hover:bg-blue-700 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot class="" />
    </Link>
</template>
