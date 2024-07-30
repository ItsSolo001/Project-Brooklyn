<!-- StoresCard.vue -->
<template>
    <div class="max-w-4xl mx-auto mt-6 p-6 bg-slate-800 rounded-2xl">
        <h1 class="text-2xl text-center font-semibold text-gray-400">Stores</h1><br>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="store in stores" :key="store.id" class="bg-slate-700 p-4 rounded-lg shadow-lg">
                <h2 class="text-lg font-semibold text-white">{{ store.name }}</h2>
                <p class="text-gray-400 mt-2">Store ID: {{ store.id }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

defineProps({
    stores: {
        type: Array,
        required: true
    }
});
</script>

<style scoped>
.grid {
    display: grid;
}
</style>
