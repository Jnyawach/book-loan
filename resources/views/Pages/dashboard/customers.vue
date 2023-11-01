<script setup lang="ts">

import MainLayout from "@/views/layouts/main-layout.vue";
import {Head,router} from "@inertiajs/vue3";
import DataPagination from "@/views/components/data-pagination.vue";
import {ref, watch} from "vue";
import RatingDetail from "@/views/components/rating-detail.vue";

let props=defineProps({
    filters: Object,
    customers: Object
})

const search = ref<String>(props.filters?.search??'');
const showing = ref<Number>(props.filters?.showing??10);
const rating = ref<String>(props.filters?.rating??'');

const clearFilter=()=>{
    search.value="";
    rating.value='';
}

watch([search,showing, rating],()=>{
    router.get('/dashboard/customers', {
        search: search.value,
        showing: showing.value,
        rating:rating.value
    },{preserveScroll:true,preserveState:true})
})
</script>

<template>
    <Head>
        <title>Customer Ratings</title>
    </Head>
<main-layout>
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">Customer Ratings</h1>
        </div>

    </div>
    <div>
        <div class="flex justify-between my-5">
            <div class="flex gap-2">
                <h6 class="self-center">Showing Entries:</h6>
                <select v-model="showing" class="font-medium text-xs  rounded-xl border bg-gray-50 border border-gray-300 text-gray-900 focus:ring-sky-600 focus:border-sky-600 block h-9 p-2  self-center">
                    <option value="10">10</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="flex justify-end gap-3 self-center">
                <div class="flex gap-2">
                    <h6 class="self-center">Rating:</h6>
                    <select v-model="rating" class="font-medium text-xs  rounded-xl  bg-gray-50 border border-gray-300 text-gray-900 focus:ring-sky-600 focus:border-sky-600 block h-9 p-2  self-center">
                        <option value="">All</option>
                        <option value="5"> 5 - Rating</option>
                        <option value="4"> 4 - Rating</option>
                        <option value="3"> 3 - Rating</option>
                        <option value="2"> 2 - Rating</option>
                        <option value="1"> 1 - Rating</option>

                    </select>
                </div>

                <div class="flex gap-2">
                    <h6 class="self-center">Search:</h6>
                    <input  placeholder="Search by name" type="search" class="small-input" v-model="search">
                </div>
                <div class="flex gap-2" v-if="search || rating ">
                    <button @click="clearFilter" class="btn-secondary btn-small">
                        <span>Clear</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-end gap-3 self-center my-3">
        <h6 class="font-semibold">Export Data:</h6>
        <a href="#" class="text-sky-700 font-bold">CSV</a>
    </div>
    <div class="border rounded-xl  shadow-sm overflow-hidden">
        <div>
            <div class="relative">
                <table class="w-full text-xs text-left text-gray-700 font-medium">
                    <thead class="text-xs text-sky-700 uppercase bg-sky-50">
                    <tr class="border-b">
                        <th scope="col" class="px-2 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Cellphone
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Average rating
                        </th>
                        <th scope="col" class="px-2 py-3 text-end">
                           Rating Details
                        </th>

                    </tr>
                    </thead>
                    <tbody class="[&>*:nth-child(even)]:bg-gray-100">
                    <tr class="border-b" v-for="customer in customers.data" :key="customer.id" >
                        <td  class="px-2 py-3 capitalize text-sky-600">
                            {{customer.name}}
                        </td>
                        <td  class="px-2 py-3">
                            {{customer.email}}
                        </td>
                        <td class="px-2 py-3">
                            {{customer.phone}}

                        </td>
                        <td class="px-2 py-3">
                            {{customer.rating}}
                        </td>
                        <td class="px-2 py-3 flex justify-end">
                            <rating-detail :customer="customer">
                                <template #trigger>
                                    <button class="text-sky-600">See details...</button>
                                </template>
                            </rating-detail>

                        </td>

                    </tr>
                    </tbody>
                </table>
                <!--pagination-->
                <data-pagination :data="customers"></data-pagination>
            </div>
        </div>
    </div>
</main-layout>
</template>

<style scoped>

</style>
