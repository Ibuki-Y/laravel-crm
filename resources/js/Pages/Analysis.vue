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
  rfmPrms: [14, 28, 60, 90, 7, 5, 3, 2, 300000, 200000, 100000, 30000],
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
          rfmPrms: form.rfmPrms,
        },
      })
      .then((res) => {
        data.data = res.data.data;
        if (res.data.labels) {
          data.labels = res.data.labels;
        }
        if (res.data.eachCount) {
          data.eachCount = res.data.eachCount;
        }
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
              <div class="mb-8">
                <h1>分析方法</h1>
                <input type="radio" v-model="form.type" value="perDay" class="mr-1" checked />
                <span class="mr-4">日別</span>
                <input type="radio" v-model="form.type" value="perMonth" class="mr-1" />
                <span class="mr-4">月別</span>
                <input type="radio" v-model="form.type" value="perYear" class="mr-1" />
                <span class="mr-4">年別</span>
                <input type="radio" v-model="form.type" value="decile" class="mr-1" />
                <span class="mr-4"> デシル分析</span>
                <input type="radio" v-model="form.type" value="rfm" class="mr-1" />
                <span class="mr-4">RFM分析</span>
              </div>
              <div class="mb-8">
                <h1>期間</h1>
                <span>From: </span>
                <input type="date" name="startDate" v-model="form.startDate" class="mr-4" />
                <span>To: </span>
                <input type="date" name="endDate" v-model="form.endDate" />
              </div>
              <div v-if="form.type === 'rfm'" class="w-full mt-4 mb-4 mx-auto overflow-auto">
                <table class="mx-auto w-full text-left whitespace-no-wrap">
                  <thead>
                    <tr>
                      <th
                        class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl"
                      >
                        ランク
                      </th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                        R(-日以内)
                      </th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                        F(-回以上)
                      </th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                        M(-円以上)
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="border-b-2 border-gray-200 px-4 py-3">5</td>
                      <td class="border-b-2 border-gray-200 px-4 py-3">
                        <input type="number" v-model="form.rfmPrms[0]" />
                      </td>
                      <td class="border-b-2 border-gray-200 px-4 py-3">
                        <input type="number" v-model="form.rfmPrms[4]" />
                      </td>
                      <td class="border-b-2 border-gray-200 px-4 py-3">
                        <input type="number" v-model="form.rfmPrms[8]" />
                      </td>
                    </tr>
                    <tr>
                      <td class="border-b-2 border-gray-200 px-4 py-3">4</td>
                      <td class="border-b-2 border-gray-200 px-4 py-3">
                        <input type="number" v-model="form.rfmPrms[1]" />
                      </td>
                      <td class="border-b-2 border-gray-200 px-4 py-3">
                        <input type="number" v-model="form.rfmPrms[5]" />
                      </td>
                      <td class="border-b-2 border-gray-200 px-4 py-3">
                        <input type="number" v-model="form.rfmPrms[9]" />
                      </td>
                    </tr>
                    <tr>
                      <td class="border-b-2 border-gray-200 px-4 py-3">3</td>
                      <td class="border-b-2 border-gray-200 px-4 py-3">
                        <input type="number" v-model="form.rfmPrms[2]" />
                      </td>
                      <td class="border-b-2 border-gray-200 px-4 py-3">
                        <input type="number" v-model="form.rfmPrms[6]" />
                      </td>
                      <td class="border-b-2 border-gray-200 px-4 py-3">
                        <input type="number" v-model="form.rfmPrms[10]" />
                      </td>
                    </tr>
                    <tr>
                      <td class="border-b-2 border-gray-200 px-4 py-3">2</td>
                      <td class="border-b-2 border-gray-200 px-4 py-3">
                        <input type="number" v-model="form.rfmPrms[3]" />
                      </td>
                      <td class="border-b-2 border-gray-200 px-4 py-3">
                        <input type="number" v-model="form.rfmPrms[7]" />
                      </td>
                      <td class="border-b-2 border-gray-200 px-4 py-3">
                        <input type="number" v-model="form.rfmPrms[11]" />
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <button
                class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
              >
                分析
              </button>
            </form>
            <div v-show="data.data">
              <div v-if="data.type != 'rfm'">
                <ChartVue :data="data" />
              </div>
              <ResultTableVue :data="data" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
