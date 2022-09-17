<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <h1>InertiaTest</h1>
  <a href="/">aタグ</a>
  <br />
  <Link href="/">Linkタグ</Link>
  <br />
  <Link :href="route('inertia.index')">v-bind:Linkタグ</Link>
  <br />
</template>
