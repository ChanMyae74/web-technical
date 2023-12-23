<template>
    <div class="col-span-12 overflow-auto lg:overflow-visible">
        <table class="w-full text-left border-spacing-y-[10px] border-separate -mt-2">
            <thead v-if="table_head" :class="showVoucher ? `font-sm text-gray-900 whitespace-nowrap border-0 bg-white ` :`w-full text-left border-spacing-y-[10px] border-separate -mt-2`">
            <tr class="">
                <th
                    v-for="th in table_head"
                    class="font-medium px-5 py-3 dark:border-darkmode-300 border-b-0 whitespace-nowrap"
                >
                    {{ th }}
                </th>
            </tr>
            </thead>
            <tbody class="">
            <slot/>
            </tbody>
        </table>
    </div>
    <div class="flex flex-wrap items-center justify-center col-span-12 intro-y sm:flex-row sm:flex-nowrap">
        <master-pagination :links="links"></master-pagination>
    </div>
</template>

<script setup>
import {ref} from 'vue';
import MasterPagination from "@/components/MasterPagination.vue";

const search = ref('');

const props = defineProps({
    table_head: [],
    links:[],
    name: 'MasterTable',
    classes: 'font-medium px-5 py-3 dark:border-darkmode-300 border-b-0 whitespace-nowrap',
    showVoucher : {
        type: Boolean,
        default: false
    }
});

const category_search = (search) => {
    Inertia.get(
        '/session/categories',
        {category: search},
        {
            queryStringArrayFormat: {},
            preserveState: true,
            replace: true,
        }
    );
};
</script>
