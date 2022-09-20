<script setup lang="ts">
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';

defineProps({
  errors: Object,
});

const form = reactive({
  title: null,
  content: null,
});

const onSubmit = () => {
  Inertia.post('/inertia/store', form);
};
</script>

<template>
  <form @submit.prevent="onSubmit">
    <input type="text" name="title" v-model="form.title" /><br />
    <div v-if="errors.title">{{ errors.title }}</div>
    <input type="text" name="content" v-model="form.content" /><br />
    <div v-if="errors.content">{{ errors.content }}</div>
    <button>submit</button>
  </form>
</template>

<style scoped></style>
