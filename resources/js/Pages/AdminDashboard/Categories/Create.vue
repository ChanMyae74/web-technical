<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import {Head, useForm} from "@inertiajs/vue3";
import {Breadcrumb, BreadcrumbItem, Switch} from "view-ui-plus";
import {ref} from "vue";

const categoryForm = useForm({
    name: '',
    is_publish: false,
    attachment: []
});

const createCategory = () => {
    categoryForm.post(route('dashboard:categories:store'), {
        preserveScroll: true,
        onSuccess: () => {
            categoryForm.reset();
            photos.value = [];
        }
    });
}
const photos = ref([]);
const handleFileChange = (event) => {
    categoryForm.attachment = event.target.files;
    const files = categoryForm.attachment;
    for (const file of files) {
        const reader = new FileReader();
        reader.onload = (e) => {
            photos.value.push(e.target.result);
        };
        reader.readAsDataURL(file);
    }
};
const removeImage = (image, index) => {
    photos.value.splice(index, 1)
    handleFileChange();
}

</script>

<template>
    <AuthenticatedLayout>
        <Head title="Add_Category"/>
        <Breadcrumb class="py-3 pl-2">
            <BreadcrumbItem :to="route('dashboard:categories:all') ">
                    <span class="text-gray-700 hover:text-sky-500 duration-300">
                    Categories
                    </span>
            </BreadcrumbItem>
            <BreadcrumbItem :to="route('dashboard:categories:create')">
                    <span class="text-gray-700 hover:text-sky-500 duration-300">
                        Add Category
                    </span>
            </BreadcrumbItem>
        </Breadcrumb>
        <div class="px-2">
            <h1 class="w-full border bg-gray-300 rounded-lg px-3 py-2">Add Categories</h1>
            <div class="mt-4 pl-2">
                <InputLabel for="category" value="Category Name"/>
                <div class="mt-1">
                    <div class="my-2">
                        <TextInput id="category" v-model="categoryForm.name" autocomplete="category"
                                   class="mt-1 block w-full"
                                   type="text"/>
                        <InputError class="mb-2" :message="$page.props.errors.name"/>
                    </div>
                    <div class="my-3 w-[700px]">
                        <div class="block flex-col items-start mt-10">
                            <label
                                class="inline-block mb-2">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">Category Photos</div>
                                        <div
                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 text-xs rounded-md">
                                            Required
                                        </div>
                                    </div>
                                </div>
                            </label>
                            <div class="flex-1 w-full  pt-4 mt-3 border-2 border-dashed rounded-md xl:mt-0">
                                <div class="grid grid-cols-10 h-48 gap-5 pl-4 pr-5">
                                    <div v-for="(photo, index) in photos" :key="index"
                                         class="relative col-span-5 cursor-pointer md:col-span-2 h-28 image-fit zoom-in">
                                        <img
                                            :src="photo" alt=""
                                            class="rounded-md">
                                        <span
                                            @click.prevent="removeImage(photo,index)"
                                            class="cursor-pointer absolute top-0 right-0 flex items-center justify-center w-5 h-5
                                         -mt-2 -mr-2 text-white rounded-full bg-red-500">
                            <svg class="stroke-1.5 w-4 h-4" fill="none" height="24" stroke="currentColor"
                                 stroke-linecap="round"
                                 stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24"
                                 xmlns="http://www.w3.org/2000/svg">
                            <line x1="18" x2="6" y1="6" y2="18"></line>
                            <line x1="6" x2="18" y1="6" y2="18"></line>
                          </svg>
                          </span>
                                    </div>
                                </div>
                                <div class="relative flex items-center justify-center px-4 pb-4 mt-5 cursor-pointer">
                                    <svg class="stroke-1.5 w-4 h-4 mr-2" fill="none" height="24" stroke="currentColor"
                                         stroke-linecap="round"
                                         stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <rect height="18" rx="2" ry="2" width="18" x="3" y="3"></rect>
                                        <circle cx="9" cy="9" r="2"></circle>
                                        <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path>
                                    </svg>
                                    <span class="mr-1 text-primary"> Upload a file </span>
                                    <input
                                        id="photos"
                                        :multiple="true"
                                        class="disabled:bg-slate-100 disabled:cursor-not-allowed
                                      [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed transition
                                      duration-200 ease-in-out text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4
                                      focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 flex-1 absolute top-0 left-0 w-full h-full opacity-0"
                                        name="attachment"
                                        type="file"
                                        @change="handleFileChange"></div>
                            </div>
                        </div>
                    </div>

                    <PrimaryButton :class="{ 'opacity-25': categoryForm.processing }"
                                   :disabled="categoryForm.processing" @click="createCategory" class="mb-2">
                        Add Category
                    </PrimaryButton>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
