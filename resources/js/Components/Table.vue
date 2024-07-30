<script setup>

</script>
<template>
    

<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-500">
        <thead class="text-xs text-gray-600 uppercase bg-gray-50 dark:bg-gray-600 dark:text-gray-100">
            <slot name="header"></slot>
        </thead>
        <tbody>
            <slot></slot>
        </tbody>
    </table>
</div>

</template>