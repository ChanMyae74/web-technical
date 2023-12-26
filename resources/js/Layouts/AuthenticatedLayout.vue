<script setup>
import {ref} from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import SideBarLink from "@/Components/SideBarLink.vue";
const props = defineProps({
    isAsideExpanded: Boolean,
});


const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="">
        <div class="min-h-screen bg-gray-100">
            <div class="" >
                <aside id="aside"
                       class="w-60 fixed flex z-[1000] top-0 h-screen transition-position overflow-hidden bg-white">
                    <div class=" flex-1 flex flex-col overflow-hidden">
                        <div class="flex flex-row h-14 items-center justify-center">
                            <div class="text-center flex-1 pl-0">
                                <a class="inline-flex items-center text-xl font-bold text-gray-500" href="/">Admin Dashboard </a>
                            </div>

                        </div>
                        <div class="flex-1 overflow-y-auto overflow-x-hidden"
                        >
                            <div class="px-3">
                                <div class="py-3">
                                    <SideBarLink
                                        :active="route().current('dashboard:categories:all')"
                                        :href="route('dashboard:categories:all')"
                                        class="font-bold"
                                    >
                                        <svg
                                            class="bi bi-postcard mr-4 text-gray-400"
                                            fill="currentColor"
                                            height="16"
                                            viewBox="0 0 16 16"
                                            width="16"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4Zm7.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7ZM2 5.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5ZM10.5 5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3ZM13 8h-2V6h2v2Z"
                                                fill-rule="evenodd"
                                            />
                                        </svg>
                                        Categories
                                    </SideBarLink>
                                    <SideBarLink
                                        :active="route().current('dashboard:items:all')"
                                        :href="route('dashboard:items:all')"
                                        class="font-bold"
                                    >
                                        <svg
                                            class="bi bi-postcard mr-4 text-gray-400"
                                            fill="currentColor"
                                            height="16"
                                            viewBox="0 0 16 16"
                                            width="16"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4Zm7.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7ZM2 5.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5ZM10.5 5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3ZM13 8h-2V6h2v2Z"
                                                fill-rule="evenodd"
                                            />
                                        </svg>
                                        Items
                                    </SideBarLink>
                                </div>
                            </div>
                        </div>

                        <ul>

                        </ul>
                    </div>
                </aside>
            </div>
            <div class="ml-[240px]">
                <nav class="bg-amber-100 border-b border-gray-100">
                    <!-- Primary Navigation Menu -->
                    <div class="w-auto mx-auto">
                        <div class="flex items-center justify-between h-16">
                            <div class="flex">
                                <!-- Logo -->
                                <div class="ml-3">

                                </div>

                            </div>

                            <div class="flex items-center mr-3">
                                <!-- Settings Dropdown -->
                                <div class="ml-3 relative">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                        </template>

                                        <template #content>
                                            <DropdownLink :href="route('profile.edit')"> Profile</DropdownLink>
                                            <DropdownLink :href="route('logout')" method="post" as="button">
                                                Log Out
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                        class="sm:hidden"
                    >
                        <div class="pt-2 pb-3 space-y-1">
                            <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                Dashboard
                            </ResponsiveNavLink>
                        </div>

                        <div class="pt-4 pb-1 border-t border-gray-200">
                            <div class="px-4">
                                <div class="font-medium text-base text-gray-800">
                                    {{ $page.props.auth.user.name }}
                                </div>
                                <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <ResponsiveNavLink :href="route('profile.edit')"> Profile</ResponsiveNavLink>
                                <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                    Log Out
                                </ResponsiveNavLink>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Page Heading -->
                <header class="bg-white shadow" v-if="$slots.header">
                    <div class="w-auto mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <slot name="header"/>
                    </div>
                </header>
                <!-- Page Content -->
                <main>
                    <slot/>
                </main>
            </div>


        </div>
    </div>
</template>
