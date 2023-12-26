<script >

import MasterPagination from "@/Components/MasterPagination.vue";
import { Head, Link } from '@inertiajs/vue3';
import {pickBy, throttle} from "lodash";
import {Breadcrumb, BreadcrumbItem} from "view-ui-plus";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";


export default {
    components: {
        AuthenticatedLayout,
        Breadcrumb,
        BreadcrumbItem,
        MasterPagination,
        Link


    },
    props: {
        items: Object,
        filters: Object,
    },
    data() {
        return {
            params: {
                search: this.filters.search,
                field: this.filters.field,
                direction: this.filters.direction,
            },
        };
    },
    methods: {
        sort(field) {
            this.params.field = field;
            this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc';
        },
    },
    watch: {
        params: {
            handler: throttle(function () {
                let params = pickBy(this.params);

                this.$inertia.get(this.route('dashboard:items:all'), params, { replace: true, preserveState: true });
            }, 150),
            deep: true,
        },
    },
};

</script>

<template>
    <AuthenticatedLayout>
        <Head title="Items"/>
        <Breadcrumb class="py-3 pl-2">
            <BreadcrumbItem :to="route('dashboard:items:all')">
                    <span class="text-gray-700 hover:text-sky-500 duration-300">
                    Items
                    </span>
            </BreadcrumbItem>
        </Breadcrumb>
        <div class="flex justify-end mr-5 ">
            <a :href="route('dashboard:items:create')"
               class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer bg-indigo-500 hover:bg-indigo-400
           focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none
           disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white mr-2 shadow-md">
                <svg class="stroke-1.5 w-4 h-4 mr-2" fill="none"
                     height="24" stroke="currentColor" stroke-linecap="round"
                     stroke-linejoin="round" stroke-width="2"
                     viewBox="0 0 24 24" width="24"
                     xmlns="http://www.w3.org/2000/svg">
                    <line x1="12" x2="12" y1="5" y2="19"></line>
                    <line x1="5" x2="19" y1="12" y2="12"></line>
                </svg>
                Add Item
            </a>
        </div>
        <div class="p-6 text-gray-900">
            <div class="">
                <div class="mx-auto w-auto">
                    <div class="mb-4">
                        <input type="search" v-model="params.search" aria-label="Search" placeholder="Search..."
                               class="block w-[450px] rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"/>
                    </div>

                    <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
                        <div class="flex flex-col">
                            <div class="overflow-x-auto -my-2  lg:-mx-8">
                                <div class="inline-block py-2 min-w-full align-middle sm:px-6 lg:px-8">
                                    <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">

                                        <table class="min-w-full divide-y divide-gray-200 table-fixed">
                                            <thead class="bg-indigo-500">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3 px-6 w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                                                    Action
                                                </th>
                                                <th scope="col"
                                                    class="py-3 px-6 w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                                                    No
                                                </th>
                                                <th scope="col"
                                                    class="w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                        <span class="inline-flex py-3 px-6 w-full justify-between" @click="sort('name')">Name

                        <svg v-if="params.field === 'name' && params.direction === 'asc'"
                             xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                          <path
                              d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                        </svg>

                        <svg v-if="params.field === 'name' && params.direction === 'desc'"
                             xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                          <path
                              d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                        </svg>
                        </span>

                                                </th>
                                                <th scope="col"
                                                    class="w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                        <span class="inline-flex py-3 px-6 w-full justify-between" @click="sort('category_id')">Category

                        <svg v-if="params.field === 'category_id' && params.direction === 'asc'"
                             xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                          <path
                              d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                        </svg>

                        <svg v-if="params.field === 'category_id' && params.direction === 'desc'"
                             xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                          <path
                              d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                        </svg>
                        </span>
                                                </th>
                                                <th scope="col"
                                                    class="w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                        <span class="inline-flex py-3 px-6 w-full justify-between" @click="sort('description')">Description

                        <svg v-if="params.field === 'description' && params.direction === 'asc'"
                             xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                          <path
                              d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                        </svg>

                        <svg v-if="params.field === 'description' && params.direction === 'desc'"
                             xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                          <path
                              d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                        </svg>
                        </span>
                                                </th>
                                                <th scope="col"
                                                    class="w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                        <span class="inline-flex py-3 px-6 w-full justify-between" @click="sort('price')">Price

                        <svg v-if="params.field === 'price' && params.direction === 'asc'"
                             xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                          <path
                              d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                        </svg>

                        <svg v-if="params.field === 'price' && params.direction === 'desc'"
                             xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                          <path
                              d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                        </svg>
                        </span>
                                                </th>
                                                <th scope="col"
                                                    class="w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                        <span class="inline-flex py-3 px-6 w-full justify-between" @click="sort('user_name')">Owner

                        <svg v-if="params.field === 'user_name' && params.direction === 'asc'"
                             xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                          <path
                              d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                        </svg>

                        <svg v-if="params.field === 'user_name' && params.direction === 'desc'"
                             xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                          <path
                              d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                        </svg>
                        </span>
                                                </th>
                                            </tr>
                                            </thead>

                                            <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="(item, index) in items.data" :key="item.id">
                                                <td class="py-4 px-6 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4 flex">
                                                            <div class="flex items-center text-white bg-indigo-500 p-2 rounded-lg mr-2 hover:bg-indigo-700">
                                                                <a
                                                                    :href="route('dashboard:items:edit', item)"
                                                                    class="inline-block"
                                                                >
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                    </svg>

                                                                </a>
                                                            </div>
                                                            <div class="flex items-center text-white bg-red-500 p-2 rounded-lg">
                                                                <Link
                                                                    :href="route('dashboard:items:destroy', item)"
                                                                    class="inline-block"
                                                                    method="delete"
                                                                    type="button"
                                                                >
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                    </svg>

                                                                </Link>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                    {{ item.id }}
                                                </td>
                                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                    {{ item.name }}
                                                </td>
                                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                    {{ item.category?.name }}
                                                </td>
                                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                    {{ item.description }}
                                                </td>
                                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                   $ {{ item.price }}
                                                </td>
                                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                    {{ item.user_name }}
                                                </td>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        v-if="items.next_page_url || items.prev_page_url"
                        class="mt-3 bg-panel-800 px-4 rounded-xl py-3"
                    >
                        <MasterPagination :links="items.links"></MasterPagination>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

