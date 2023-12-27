<script setup lang="ts">

import MainLayout from "@/views/layouts/main-layout.vue";
import {Head, Link, router} from "@inertiajs/vue3";
import {ref, watch} from "vue";
import CreateUser from "@/views/pages/admin/users/CreateUser.vue";
import DataPagination from "@/views/components/data-pagination.vue";
import EditUser from "@/views/pages/admin/users/EditUser.vue";
import PromptAlert from "@/views/components/prompt-alert.vue";
import ApplyPenalty from "@/views/components/ApplyPenalty.vue";
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
            status:string,
            search:string,
            showing:number
        },
        required:true
    }
})
const loan_status=ref(props.filters.status??'')
const search=ref(props.filters.search??'')
const showing=ref(props.filters.showing??10)

const approveLoan=(loan_id:number)=>{
    router.patch(`/admin/loans/${loan_id}/approve`)
}
const receiveBook=(loan_id:number)=>{
    router.patch(`/admin/loans/${loan_id}/receive`)
}

watch([search,showing],debounce(function (){
    router.get('/admin/loans', {
        search:search.value,
        showing:showing.value
    })
},500))
</script>

<template>
    <Head>
        <title>Loans</title>
    </Head>
<main-layout>
    <div class="my-3">
        <ul class="flex gap-3 items-center text-sky-600 font-medium">
            <li>
                <Link href="/admin/loans" :class="[loan_status===''?'underline':'']">All Loans</Link>
            </li>
            <li v-show="status!='Returned'" :key="index" v-for="(status, index) in statuses">
                <Link :class="[loan_status===status?'underline':'']" :href="`/admin/loans?status=${status}`">{{ status }}</Link>
            </li>
        </ul>
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
                            Loaned on
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Book title
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Loaned by
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Status
                        </th>

                        <th scope="col" class="px-2 py-3 text-end">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody class="[&>*:nth-child(even)]:bg-gray-100">
                    <tr class="border-b text-xs" v-for="loan in loans.data" :key="loan.id">
                        <th scope="row" class="p-2">
                            {{new Date(loan.loan_date).toDateString()}}

                        </th>
                        <td class="px-2 py-3 ">
                            {{loan.book.name}}
                        </td>
                        <td class="px-2 py-3">
                            {{loan.user.name}}
                        </td>
                        <td class="px-2 py-3">
                            <p v-if="loan.status==='Pending'" class="text-orange-500">
                                {{loan.status}}
                                <button class="ml-2 btn-primary btn-small" @click="approveLoan(loan.id)">Approve</button>
                            </p>
                            <p v-if="loan.status==='Borrowed'" >
                               <span class="text-green-500"> {{loan.status}}</span> Due: {{new Date(loan.due_date).toDateString()}}
                            </p>
                            <p v-if="loan.status==='Extended'" >
                                <span class="text-blue-500"> {{loan.status}}</span> Until: {{new Date(loan.due_date).toDateString()}}
                            </p>
                            <p v-if="loan.status==='Delayed'" >
                                <span class="text-red-500"> {{loan.status}}</span> Due date: {{new Date(loan.due_date).toDateString()}}
                                <ApplyPenalty :loan="loan">
                                   <template #trigger>
                                       <button class="btn-danger btn-small">Apply penalty</button>
                                   </template>
                                </ApplyPenalty>

                            </p>

                        </td>

                        <td class="px-2 py-3 flex justify-end">
                            <el-dropdown :key="loan.id" placement="bottom-end">
                                <button class="flex items-center gap-2 text-xs border-0 outline-0">
                                    <span>Action</span>
                                    <svg class="h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M12 3C10.9 3 10 3.9 10 5C10 6.1 10.9 7 12 7C13.1 7 14 6.1 14 5C14 3.9 13.1 3 12 3ZM12 17C10.9 17 10 17.9 10 19C10 20.1 10.9 21 12 21C13.1 21 14 20.1 14 19C14 17.9 13.1 17 12 17ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"></path>
                                    </svg>
                                </button>

                                <template #dropdown>
                                    <ul class="divide-y w-36">

                                        <li v-if="loan.status==='Pending'">
                                            <button class="p-2 hover:text-sky-600" @click="approveLoan(loan.id)">Approve loan</button>
                                        </li>
                                        <li v-if="loan.status==='Borrowed'||loan.status==='Extended'">
                                            <button class="p-2 hover:text-sky-600" @click="receiveBook(loan.id)">Receive book</button>
                                        </li>

                                    </ul>
                                </template>
                            </el-dropdown>
                        </td>


                    </tr>
                    </tbody>
                </table>
                <!--pagination-->
                <data-pagination :data="loans"></data-pagination>
            </div>

        </div>
    </div>

</main-layout>
</template>

<style scoped>

</style>
