<script setup>
import { reactive, onMounted } from 'vue';
import { Head } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import { getToday } from '@/common';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FlashMessageVue from '@/Components/FlashMessage.vue';

const form = reactive({
  startDate: null,
  endDate: null,
  type: 'perDay',
});

const getData = async () => {
  try {
    await axios
      .get('/api/analysis/', {
        params: {
          startDate: form.startDate,
          endDate: form.endDate,
          type: form.type,
        },
      })
      .then((res) => {
        console.log(res.data);
        // data.value=res.data;
      });
  } catch (e) {
    console.log(e.message);
  }
};

onMounted(() => {
  form.startDate = getToday();
  form.endDate = getToday();
});
</script>

<template>
  <Head title="データ分析" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">データ分析</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <FlashMessageVue />
          <div class="p-6 bg-white border-b border-gray-200">
            <form @submit.prevent="getData">
              <span>From: </span>
              <input type="date" name="startDate" v-model="form.startDate" />
              <span>To: </span>
              <input type="date" name="endDate" v-model="form.endDate" />
              <button
                class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
              >
                分析
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
