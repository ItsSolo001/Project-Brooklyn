<template>
    <AuthenticatedLayout>
        <Head title="Edit Store" />
        <div class="py-6 sm:py-12 bg-gray-900">
            <div class="max-w-full mx-4 sm:mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="max-w-md mx-auto p-6 bg-gray-800 shadow-lg rounded-lg">
                        <h1 class="text-xl sm:text-2xl font-bold text-gray-100">Edit Store</h1>
                        <form @submit.prevent="updateStore" enctype="multipart/form-data">
                            <div class="mt-4">
                                <label for="name" class="block text-sm font-medium text-gray-100">Name</label>
                                <input type="text" v-model="form.name" id="name" class="mt-1 block w-full p-2 text-gray-100 bg-gray-700 border border-gray-600 rounded-md" required>
                            </div>
                            <div class="mt-4">
                                <label for="description" class="block text-sm font-medium text-gray-100">Description</label>
                                <textarea v-model="form.description" id="description" class="mt-1 block w-full p-2 text-gray-100 bg-gray-700 border border-gray-600 rounded-md" required></textarea>
                            </div>
                            <div class="mt-4">
                                <label for="image" class="block text-sm font-medium text-gray-100">Image</label>
                                <input type="file" @change="handleImageUpload" id="image" class="mt-1 block w-full p-2 text-gray-100 bg-gray-700 border border-gray-600 rounded-md">
                            </div>
                            <div class="mt-4 sm:mt-6">
                                <button type="submit" class="bg-blue-500 text-gray-100 px-4 py-2 rounded-md w-full sm:w-auto">Update Store</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const { props } = usePage();
const form = ref({ ...props.store, image: null });

const handleImageUpload = (event) => {
    form.value.image = event.target.files[0];
};

const updateStore = () => {
    const formData = new FormData();
    formData.append('_method', 'PUT');
    formData.append('name', form.value.name);
    formData.append('description', form.value.description);
    if (form.value.image) {
        formData.append('image', form.value.image);
    }

    router.post(`/stores/${props.store.id}`, formData);
};
</script>

<style scoped>
.grid > * {
    transition: transform 0.3s ease-in-out;
}

.grid > *:hover {
    transform: translateY(-3px);
}
</style>
