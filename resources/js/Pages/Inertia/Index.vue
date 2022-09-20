<script setup>
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
  blogs: Array,
});
</script>

<template>
  <div v-if="$page.props.flash.message" class="bg-blue-200">
    {{ $page.props.flash.message }}
  </div>
  <h1>Hello Index Page</h1>
  <ul>
    <li v-for="blog in blogs" :key="blog.id" class="my-4">
      <Link :href="route('inertia.show', { id: blog.id })" class="text-blue-500">件名: {{ blog.title }}</Link>
      <br />
      本文: {{ blog.content }}
    </li>
  </ul>
</template>

<style scoped></style>
