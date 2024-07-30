<template>
    <AuthenticatedLayout>
        <Head title="Dashboard" />
        <div class="py-6 sm:py-12 bg-gray-900">
            <div class="max-w-full mx-4 sm:mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 sm:p-6 bg-gray-800 border-b border-gray-900 rounded-t-xl">
                        <h1 class="text-xl sm:text-2xl font-bold text-white">Dashboard</h1>
                        <div class="mt-4 sm:mt-6">
                            <h2 class="text-lg sm:text-xl font-semibold text-white">Stores</h2>
                            <div class="mt-4 sm:mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                                <div v-for="store in stores" :key="store.id" class="bg-gray-700 p-4 rounded-lg">
                                    <h3 class="text-md sm:text-lg font-bold text-white">{{ store.name }}</h3>
                                    <p class="text-sm sm:text-base text-white">{{ store.description }}</p>
                                    <img 
                                        :src="store.image ? `/storage/${store.image}` : '/default-image-path.jpg'" 
                                        alt="Store Image" 
                                        class="mt-2 w-full h-32 sm:h-48 object-cover rounded-lg"/>
                                    <a 
                                        :href="`/stores/${store.id}`" 
                                        class="block mt-2 text-xs sm:text-sm text-gray-400 hover:text-white">
                                        View Store
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const { props } = usePage();
const stores = props.stores;
</script>

<style scoped>
.grid > * {
    transition: transform 0.3s ease-in-out;
}

.grid > *:hover {
    transform: translateY(-3px);
}
</style>
