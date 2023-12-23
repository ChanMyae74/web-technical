<template>
    <div class="flex flex-wrap justify-center gap-x-2">
        <Link
            v-for="link in links"
            :class="{
                'leading-4 flex h-8 items-center justify-center rounded-xl border px-3 py-2 text-2xs text-blue-500 dark:text-blue-300 duration-300 font-bold dark:hover:text-blue-500 bg-blue/7 border-blue/75':
                    link.active,
                'leading-4 flex h-8 items-center justify-center rounded-xl hover:border-blue-500 px-3 py-2 text-xs font-bold hover:text-blue-500 duration-300 dark:hover:text-blue-300 bg-blue/7':
                    link,
            }"
            :href="link.url"
        >
            <span v-html="link.label"></span>
        </Link>
    </div>
</template>

<script>
import {Link} from '@inertiajs/vue3';

export default {
    name: "MasterPagination",
    props: {
        links: Array,
    },
    components: {Link}
};
</script>

<style>
a {
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s, border 0.3s;
}
</style>
