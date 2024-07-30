<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="email" 
                />


                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="flex items-center justify-between mt-5 space-x-4">
                <Link :href="route('login')" class="px-4 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-600 rounded flex-1 text-center">
                    Back
                </Link>
                
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="flex-1">
                    Email Password Reset Link
                </PrimaryButton>
            </div>

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 mt-5">
                Forgot your password? No problem. Just let us know your email address and we will email you a password reset
                link that will allow you to choose a new one.
            </div>
        </form>
    </GuestLayout>
</template>
