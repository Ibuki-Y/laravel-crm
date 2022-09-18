<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const newTitle = ref('');
const newContent = ref('');
</script>

<template>
  <h1>InertiaTest</h1>
  <a href="/">aタグ</a>
  <br />
  <Link href="/">Linkタグ</Link>
  <br />
  <Link :href="route('inertia.index')">v-bind:Linkタグ</Link>
  <br />
  <Link :href="route('inertia.show', { id: 1 })">ルートパラメータLinkタグ</Link>
  <div class="mb-8"></div>
  <input type="text" name="newTitle" v-model="newTitle" />{{ newTitle }}
  <br />
  <input type="text" name="newContent" v-model="newContent" />{{ newContent }}
  <br />
  <Link method="post" as="button" :href="route('inertia.store')" :data="{ title: newTitle, content: newContent }">
    DB
  </Link>
</template>
