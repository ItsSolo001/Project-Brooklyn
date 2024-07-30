<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="flex flex-col sm:flex-row w-full max-w-2xl mt-10 px-4 py-6 bg-white dark:bg-gray-800 shadow-md overflow-hidden rounded-xl border border-gray-300 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-400 transition duration-200 ease-in-out">
            <div class="flex flex-col items-center justify-center w-full sm:w-1/2 bg-gray-200 dark:bg-gray-700 rounded-xl p-4 mb-4 sm:mb-0">
                <div class="featured-image mb-3">
                    <img src="images/loginimage.jpg" class="img-fluid rounded-xl w-full h-auto">
                </div>
                <p class="text-blue-600 text-lg font-semibold">Be Verified</p>
                <small class="text-dark text-center block mt-2">
                    “Get in touch with the thrift clothing scene.”
                </small>
            </div>
            <div class="flex items-center justify-center w-full sm:w-1/2 p-4">
                <slot />
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Additional custom styles can be added here if needed */
</style>
