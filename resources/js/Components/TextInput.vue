<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
    type: {
        type: String,
        required: true,
    },
    modelValue: {
        type: [String, Number],
        default: '',
    },
    autocomplete: {
        type: String,
        default: '',
    },
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

const emit = defineEmits(['update:modelValue']);

const updateValue = (event) => {
    emit('update:modelValue', event.target.value);
};

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        :type="type"
        :value="modelValue"
        :autocomplete="autocomplete"
        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
        @input="updateValue"
        ref="input"
    />
</template>
