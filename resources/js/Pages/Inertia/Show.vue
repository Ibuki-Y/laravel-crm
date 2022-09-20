<script setup>
import { Inertia } from '@inertiajs/inertia';

defineProps({
  id: String,
  blog: Object,
});

const deleteConfirm = (id) => {
  Inertia.delete(`/inertia/${id}`, {
    onBefore: () => confirm('really?'),
  });
};
</script>

<template>
  <p>id: {{ id }}</p>
  <h2>{{ blog.title }}</h2>
  <h3>{{ blog.content }}</h3>
  <button @click="deleteConfirm(blog.id)">delete</button>
</template>
