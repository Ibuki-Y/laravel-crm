<script setup lang="ts">
import GuestLayoutVue from '@/Layouts/GuestLayout.vue';
import InputLabelVue from '@/Components/InputLabel.vue';
import TextInputVue from '@/Components/TextInput.vue';
</script>

<template>
  <GuestLayoutVue>
    <InputLabelVue value="title">Title</InputLabelVue>
    <TextInputVue modelValue="input"></TextInputVue>
  </GuestLayoutVue>
</template>

<style scoped></style>
