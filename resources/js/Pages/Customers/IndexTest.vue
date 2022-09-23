<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FlashMessageVue from '@/Components/FlashMessage.vue';
import PaginationVue from '@/Components/Pagination.vue';

defineProps({
  customers: Object,
});
</script>

<template>
  <ul v-for="customer in customers.data" :key="customer.id">
    <li>{{ customer.id }}</li>
    <li>{{ customer.name }}</li>
  </ul>
  <PaginationVue class="mt-6" :links="customers.links"></PaginationVue>
</template>
