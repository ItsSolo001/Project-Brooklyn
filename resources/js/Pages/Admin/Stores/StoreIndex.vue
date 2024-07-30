<template>
    <AdminLayout>
        <div class="max-w-full mx-4 sm:mx-auto py-4">
            <div class="flex flex-col sm:flex-row justify-between items-center">
                <h1 class="text-xl sm:text-2xl font-bold text-center bg-clip-text text-transparent bg-gradient-to-r from-gray-500 via-gray-600 to-gray-700 py-1">
                    Stores Index Page
                </h1>
                <Link :href="route('stores.create')" class="mt-4 sm:mt-0 px-4 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">New Store</Link>
            </div>
            <div class="mt-6">
                <Table>
                    <template #header>
                        <TableRow>
                            <TableHeaderCell>ID</TableHeaderCell>
                            <TableHeaderCell>Name</TableHeaderCell>
                            <TableHeaderCell>Description</TableHeaderCell>
                            <TableHeaderCell>Image</TableHeaderCell>
                            <TableHeaderCell>Action</TableHeaderCell>
                        </TableRow>
                    </template>
                    <template #default>
                        <TableRow v-for="store in stores" :key="store.id" class="border-b">
                            <TableDataCell>{{ store.id }}</TableDataCell>
                            <TableDataCell>
                                <Link :href="route('stores.show', store.id)" class="text-blue-500 hover:underline">{{ store.name }}</Link>
                            </TableDataCell>
                            <TableDataCell>{{ store.description }}</TableDataCell>
                            <TableDataCell>
                                <img :src="`/storage/${store.image}`" alt="Store Image" class="w-16 h-16 object-cover"/>
                            </TableDataCell>
                            <TableDataCell class="space-x-2 flex flex-col sm:flex-row">
                                <Link :href="route('stores.edit', store.id)" class="text-green-400 hover:text-green-600">Edit</Link>
                                <button @click="confirmDeleteStore(store.id)" class="text-red-400 hover:text-red-600">Delete</button>
                                <Modal :show="showConfirmDeleteStoreModal" @close="closeModal">
                                    <div class="p-6">
                                        <h2 class="text-lg font-semibold text-slate-400">Are you sure to delete this store?</h2>
                                        <div class="mt-6 flex flex-col sm:flex-row space-x-0 sm:space-x-4">
                                            <DangerButton @click="deleteStore(store.id)">Delete</DangerButton>
                                            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                                        </div>
                                    </div>
                                </Modal>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from "vue";
import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

defineProps(["stores"]);
const form = useForm({})

const showConfirmDeleteStoreModal = ref(false)

const confirmDeleteStore = (id) => {
    showConfirmDeleteStoreModal.value = true;
}

const closeModal = () => {
    showConfirmDeleteStoreModal.value = false;
}

const deleteStore = (id) => {
    form.delete(route('stores.destroy', id));
    closeModal();
}
</script>
