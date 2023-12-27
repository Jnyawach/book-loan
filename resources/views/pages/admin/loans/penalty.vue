<script setup lang="ts">

import MainLayout from "@/views/layouts/main-layout.vue";
import {Head, router} from "@inertiajs/vue3";
import {ref, watch} from "vue";
import DataPagination from "@/views/components/data-pagination.vue";
import moment from "moment";
import debounce from "lodash/debounce";
let props=defineProps({
    loans:{
        type: Object as ()=>any,
        required:true
    },
    statuses:{
        type: Object as ()=>string,
        required:true
    },
    filters:{
        type: Object as ()=>{
            search:string,
            showing:number
        },
        required:true
    }
})

const search=ref(props.filters.search??'')
const showing=ref(props.filters.showing??10)

watch([search,showing],debounce(function (){
    router.get('/admin/loans/penalties', {
        search:search.value,
        showing:showing.value
    })
},500))
</script>

<template>
    <Head title="Penalties"/>
<main-layout>
<section>
    <div class="my-3">
        Applied Penalties
    </div>
    <div class="flex justify-end gap-2">
        <div class="flex gap-2 items-center">

            <select class="sumo-input" v-model="showing">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="flex gap-2">
            <div class="w-96">
                <input v-model="search" type="search" class="sumo-input" placeholder="Search books by name...">
            </div>

        </div>
    </div>

    <div class="border rounded shadow my-3 overflow-hidden">
        <div>

            <div class="relative">
                <table class="w-full text-sm text-left text-gray-700 font-medium">
                    <thead class="text-xs text-sky-600 uppercase bg-sky-50">
                    <tr class="border-b">
                        <th scope="col" class="px-2 py-3">
                            Book title
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Loaned by
                        </th>
                        <th scope="col" class="px-2 py-3">
                           Loaned on
                        </th>
                        <th scope="col" class="px-2 py-3">
                           Due Date
                        </th>
                        <th scope="col" class="px-2 py-3">
                          Return Date
                        </th>
                        <th scope="col" class="px-2 py-3">
                           Penalty Amount (KES)
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Applied By
                        </th>

                    </tr>
                    </thead>
                    <tbody class="[&>*:nth-child(even)]:bg-gray-100">
                    <tr class="border-b text-xs" v-for="loan in loans.data" :key="loan.id">
                        <th scope="row" class="p-2">
                            {{loan.book.name}}
                        </th>
                        <td class="px-2 py-3 ">
                            {{loan.user.name}}
                        </td>
                        <td class="px-2 py-3">
                            {{moment(loan.loan_date).format('DD-MM-YYYY')}}
                        </td>
                        <td class="px-2 py-3">
                            {{moment(loan.due_date).format('DD-MM-YYYY')}}

                        </td>

                        <td class="px-2 py-3 ">
                            {{moment(loan.return_date).format('DD-MM-YYYY')}}
                        </td>
                        <td class="px-2 py-3">
                            {{new Number(loan.penalty_amount).toFixed(2)}}
                        </td>
                        <td class="px-2 py-3">
                            {{loan.added_by.name}}
                        </td>


                    </tr>
                    </tbody>
                </table>
                <!--pagination-->
                <data-pagination :data="loans"></data-pagination>
            </div>

        </div>
    </div>
</section>
</main-layout>
</template>

<style scoped>

</style>
