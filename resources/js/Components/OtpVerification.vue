<template>
    <div class="max-w-md w-full mx-auto mb-20 bg-gray-900 p-6 rounded-lg shadow-lg sm:mt-10 sm:p-6">
        <h2 class="text-1xl font-bold text-gray-200 mb-4 text-center">Verify OTP</h2>
        <form @submit.prevent="verifyOtp">
            <div class="space-y-4">
                <div>
                    <InputLabel for="otp" value="Enter OTP" />
                    <TextInput
                        id="otp"
                        type="text"
                        v-model="otp"
                        class="mt-1 block w-full"
                        required
                    />
                    <InputError class="mt-2" :message="errors.otp" />
                </div>
            </div>
            <div class="mt-6 flex items-center justify-between">
                <PrimaryButton class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full sm:w-auto">
                    Verify OTP
                </PrimaryButton>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const otp = ref('');
const userId = ref(''); // Set this from a backend response or other method

const form = useForm({
    otp: otp.value,
    user_id: userId.value,
});

const verifyOtp = () => {
    form.post(route('storecenter.verifyOtp'))
        .then(() => {
            // Handle successful OTP verification
        })
        .catch((error) => {
            // Handle errors
        });
};
</script>
