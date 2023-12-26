<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Admin Dashboard" />

    <AuthenticatedLayout>
        <slot></slot>
    </AuthenticatedLayout>
</template>
