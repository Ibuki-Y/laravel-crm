<script setup>
import { reactive, onMounted } from 'vue';
import { Head } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import { getToday } from '@/common';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FlashMessageVue from '@/Components/FlashMessage.vue';
import ChartVue from '@/Components/Chart.vue';
import ResultTableVue from '@/Components/ResultTable.vue';

const form = reactive({
  startDate: null,
  endDate: null,
  type: 'perDay',
});

const data = reactive({});

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
        data.data = res.data.data;
        data.labels = res.data.labels;
        data.totals = res.data.totals;
        data.type = res.data.type;
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
              <div class="mb-4">
                <span>分析方法</span>
                <input type="radio" v-model="form.type" value="perDay" checked /><span class="mr-2">日別</span>
                <input type="radio" v-model="form.type" value="perMonth" /><span class="mr-2">月別</span>
                <input type="radio" v-model="form.type" value="perYear" /><span class="mr-2">年別</span>
                <input type="radio" v-model="form.type" value="decile" /><span class="mr-2">デシル分析</span>
              </div>
              <div class="mb-4">
                <span>From: </span>
                <input type="date" name="startDate" v-model="form.startDate" class="mr-4" />
                <span>To: </span>
                <input type="date" name="endDate" v-model="form.endDate" />
              </div>
              <button
                class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
              >
                分析
              </button>
            </form>
            <div v-show="data.data">
              <ChartVue :data="data" />
              <ResultTableVue :data="data" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
