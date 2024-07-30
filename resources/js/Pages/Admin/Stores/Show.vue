<template>
    <AuthenticatedLayout>
        <Head title="Show Store" />
        <div class="py-6 sm:py-24 bg-gray-900">
            <div class="max-w-full mx-4 sm:mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="max-w-md mx-auto p-4 sm:p-6 bg-gray-800 border-b border-gray-900 rounded-lg shadow-lg">
                        <h1 class="text-xl sm:text-2xl font-bold text-white text-center">{{ store.name }}</h1>
                        <p class="text-white text-center">{{ store.description }}</p>
                        <img v-if="store.image" :src="`/storage/${store.image}`" alt="Store Image" class="mt-4 w-full max-w-xs mx-auto rounded-lg shadow-md" />
                        <TableDataCell class="space-x-2 flex flex-col sm:flex-row justify-center mt-4">
                            <Link :href="route('stores.edit', store.id)" class="text-green-400 hover:text-green-600 mx-2">Edit</Link>
                            <button @click="confirmDeleteStore(store.id)" class="text-red-400 hover:text-red-600 mx-2">Delete</button>
                            <Modal :show="showConfirmDeleteStoreModal" @close="closeModal">
                                <div class="p-6">
                                    <h2 class="text-lg font-semibold text-slate-400 text-center">Are you sure to delete this store?</h2>
                                    <div class="mt-6 flex flex-col sm:flex-row space-x-0 sm:space-x-4 justify-center">
                                        <DangerButton @click="deleteStore(store.id)" class="mx-2">Delete</DangerButton>
                                        <SecondaryButton @click="closeModal" class="mx-2">Cancel</SecondaryButton>
                                    </div>
                                </div>
                            </Modal>
                        </TableDataCell>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { usePage } from '@inertiajs/vue3';
import { Head, Link, useForm } from '@inertiajs/vue3';
import TableDataCell from "@/Components/TableDataCell.vue";
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

// Use page props
const { props } = usePage();
const store = props.store;

// State to control modal visibility
const showConfirmDeleteStoreModal = ref(false);

// Form instance for deleting the store
const form = useForm({});

// Method to show the confirmation modal
const confirmDeleteStore = (id) => {
    showConfirmDeleteStoreModal.value = true;
};

// Method to close the modal
const closeModal = () => {
    showConfirmDeleteStoreModal.value = false;
};

// Method to delete the store
const deleteStore = (id) => {
    form.delete(route('stores.destroy', id));
    closeModal();
};
</script>
