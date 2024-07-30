<template>
    <GuestLayout>
        <div class="max-w-md w-full mx-auto mb-20 bg-gray-900 p-6 rounded-lg shadow-lg sm:mt-10 sm:p-6">
            <h2 class="text-1xl font-bold text-gray-200 mb-4 text-center">Register as Store Owner</h2>
            <form @submit.prevent="submit">
                <div class="space-y-4">
                    <div>
                        <InputLabel for="name" value="Name" />
                        <TextInput
                            id="name"
                            type="text"
                            v-model="form.name"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div>
                        <InputLabel for="email" value="Email" />
                        <TextInput
                            id="email"
                            type="email"
                            v-model="form.email"
                            class="mt-1 block w-full"
                            required
                            autocomplete="username"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div>
                        <InputLabel for="no" value="Contact Number" />
                        <TextInput
                            id="no"
                            type="text"
                            v-model="form.no"
                            class="mt-1 block w-full"
                            required
                            autocomplete="tel"
                        />
                        <InputError class="mt-2" :message="form.errors.no" />
                    </div>
                    <div>
                        <InputLabel for="password" value="Password" />
                        <TextInput
                            id="password"
                            type="password"
                            v-model="form.password"
                            class="mt-1 block w-full"
                            required
                            autocomplete="new-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
                    <div>
                        <InputLabel for="password_confirmation" value="Confirm Password" />
                        <TextInput
                            id="password_confirmation"
                            type="password"
                            v-model="form.password_confirmation"
                            class="mt-1 block w-full"
                            required
                            autocomplete="new-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>
                    <div>
                        <InputLabel for="id_upload" value="Upload ID" />
                        <input
                            id="id_upload"
                            type="file"
                            @change="handleFileUpload"
                            class="mt-1 block w-full"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.id_upload" />
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-between">
                    <PrimaryButton class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full sm:w-auto">
                        Register
                    </PrimaryButton>
                </div>
            </form>
            <div class="text-center mt-4">
                <button class="bg-gray-300 text-gray-900 hover:bg-gray-200 rounded-xl px-4 py-2" @click="showOtpForm">
                    Verify OTP
                </button>
            </div>
            <div v-if="showOtp" class="mt-6">
                <h2 class="text-1xl font-bold text-gray-200 mb-4 text-center">Enter OTP</h2>
                <form @submit.prevent="verifyOtp">
                    <div class="space-y-4">
                        <div>
                            <InputLabel for="otp" value="OTP" />
                            <TextInput
                                id="otp"
                                type="text"
                                v-model="otpForm.otp"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="otpForm.errors.otp" />
                        </div>
                        <div>
                            <InputLabel for="user_id" value="User ID" />
                            <TextInput
                                id="user_id"
                                type="text"
                                v-model="otpForm.user_id"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="otpForm.errors.user_id" />
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-between">
                        <PrimaryButton class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full sm:w-auto">
                            Verify OTP
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </GuestLayout>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';

const form = useForm({
    name: '',
    email: '',
    no: '',
    password: '',
    password_confirmation: '',
    id_upload: null,
});

const otpForm = useForm({
    otp: '',
    user_id: '',
});

const showOtp = ref(false);

const submit = () => {
    form.post(route('storecenter.register'), {
        onSuccess: () => {
            form.reset();
        },
    });
};

const handleFileUpload = (event) => {
    form.id_upload = event.target.files[0];
};

const showOtpForm = () => {
    showOtp.value = true;
};

const verifyOtp = () => {
    otpForm.post(route('storecenter.verify-otp'), {
        onSuccess: () => {
            otpForm.reset();
        },
    });
};
</script>
