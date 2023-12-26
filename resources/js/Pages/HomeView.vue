<template>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
        <div
            class="w-full max-w-lg mt-6 px-6 py-4 overflow-hidden">
            <h1 class="text-7xl font-extrabold text-blue-700">Web_Technical</h1>
        </div>
        <div class="my-5">
            <Link
                :href="route('login')"
                class="text-lg text-white px-12 py-2 mr-5 rounded-md focus:outline-none bg-indigo-700 hover:bg-indigo-500
                focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Login
            </Link>
            <Link
                :href="route('register')"
                class="text-lg text-white px-12 py-2 rounded-md focus:outline-none bg-indigo-700 hover:bg-indigo-500
                focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Register
            </Link>
        </div>
    </div>
</template>
<script setup>

import {Link} from "@inertiajs/vue3";
</script>

<style lang="scss" scoped>

</style>
