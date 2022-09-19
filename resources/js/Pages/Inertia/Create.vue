<script setup lang="ts">
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';

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
    <input type="text" name="content" v-model="form.content" /><br />
    <button>submit</button>
  </form>
</template>

<style scoped></style>
