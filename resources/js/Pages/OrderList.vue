<script setup>
import 'vue-good-table/dist/vue-good-table.css'
import { VueGoodTable } from 'vue-good-table';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref,onMounted } from 'vue';
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';



const tableData = ref([]);

async function get(){
    await axios.get('/orders/get')
    .then(function (response) {
        console.log(response.data);
        console.log(response.data);
        if(response.data){
            console.log('test');
            tableData.value = response.data;
        }else{
            tableData.value = {};
        }
    })
    .catch(function (error) {
        console.log(error);
    });

    console.log(tableData);
}

onMounted(() => {
  get();
});

</script>

<template>
  <div class="text-center">
    <table>
      <thead>
        <tr>
          <th>amount</th>
          <th>buyer</th>
          <th>receipt_id</th>
          <th>items</th>
          <th>buyer_email</th>
          <th>note</th>
          <th>city</th>
          <th>phone</th>
          <th>buyer_ip</th>
          <th>hash_key</th>
          <th>entry_at</th>
          <th>entry_by</th>
        </tr>
      </thead>
      <!-- {{ tableData }} -->
      <tbody>
        <tr v-for="(rowData, index) in tableData" :key="index">
        <td>{{ rowData.amount }}</td>
        <td>{{ rowData.buyer }}</td>
        <td>{{ rowData.receipt_id }}</td>
        <td>{{ rowData.items }}</td>
        <td>{{ rowData.buyer_email }}</td>
        <td>{{ rowData.note }}</td>
        <td>{{ rowData.city }}</td>
        <td>{{ rowData.phone }}</td>
        <td>{{ rowData.buyer_ip }}</td>
        <td>{{ rowData.hash_key }}</td>
        <td>{{ rowData.entry_at }}</td>
        <td>{{ rowData.entry_by }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<style scoped>
  /* Style the table container */
  .text-center {
    text-align: center;
    margin: 20px;
  }

  /* Style the table */
  table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
  }

  /* Style the table header */
  th {
    background-color: #f2f2f2;
    text-align: left;
    padding: 8px;
    border-bottom: 1px solid #ddd;
  }

  /* Style the table rows */
  tr {
    border-bottom: 1px solid #ddd;
  }

  /* Style the table data cells */
  td {
    padding: 8px;
  }

  /* Add some hover effect on table rows */
  tr:hover {
    background-color: #f5f5f5;
  }
</style>