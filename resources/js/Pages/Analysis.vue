<script setup>
import { reactive, onMounted } from 'vue';
import { Head } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import { getToday } from '@/common';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FlashMessageVue from '@/Components/FlashMessage.vue';
import ChartVue from '@/Components/Chart.vue';

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
            <div v-show="data.data">
              <ChartVue :data="data" />
            </div>
            <div v-show="data.data" class="mt-8 lg:w-2/3 w-full mx-auto overflow-auto">
              <table class="table-auto w-full text-left whitespace-no-wrap">
                <thead>
                  <tr>
                    <th
                      class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl"
                    >
                      年月日
                    </th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                      金額
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in data.data" :key="item.date">
                    <td class="px-4 py-3">{{ item.date }}</td>
                    <td class="px-4 py-3">{{ Number(item.total).toLocaleString() }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
