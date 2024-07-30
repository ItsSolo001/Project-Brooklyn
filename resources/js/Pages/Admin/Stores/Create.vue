<template>
    <AuthenticatedLayout>
        <Head title="Create Store" />
        <div class="py-6 sm:py-24 bg-gray-900">
            <div class="max-w-md mx-auto p-6 bg-gray-900 shadow-lg rounded-lg">
                <form @submit.prevent="submit" class="bg-gray-800 shadow-md rounded-xl px-4 sm:px-8 pt-6 pb-5 mb-4" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-200 text-xs sm:text-sm font-bold mb-1 sm:mb-2">Store Name</label>
                        <input type="text" id="name" v-model="form.name" required
                               class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-100 bg-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-200 text-xs sm:text-sm font-bold mb-1 sm:mb-2">Description</label>
                        <textarea id="description" v-model="form.description" required
                                  class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-100 bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                    </div>
                    <div class="mb-6">
                        <label for="image" class="block text-gray-200 text-xs sm:text-sm font-bold mb-1 sm:mb-2">Image</label>
                        <input type="file" id="image" @change="handleImageUpload" required
                               class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-100 bg-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full sm:w-auto">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const form = useForm({
    name: '',
    description: '',
    image: null,
});

const handleImageUpload = (event) => {
    form.image = event.target.files[0];
};

const submit = () => {
    form.post(route('stores.store'), {
        forceFormData: true,
    });
};
</script>

<style scoped>
/* Scoped styles for rounded corners and hover effects */
.grid > * {
    transition: transform 0.3s ease-in-out;
}

.grid > *:hover {
    transform: translateY(-3px);
}
</style>
