<script setup lang="ts">
import GuestLayoutVue from '@/Layouts/GuestLayout.vue';
import InputLabelVue from '@/Components/InputLabel.vue';
import TextInputVue from '@/Components/TextInput.vue';

const emitTest = (e: string) => {
  console.log(e);
};
</script>

<template>
  <GuestLayoutVue>
    <InputLabelVue value="title">Title</InputLabelVue>
    <TextInputVue modelValue="input" @update:model-value="emitTest" />
  </GuestLayoutVue>
</template>

<style scoped></style>
