<script setup lang="ts">

import MainLayout from "@/views/layouts/main-layout.vue";
import {Head,Link} from "@inertiajs/vue3";
import DataPagination from "@/views/components/data-pagination.vue";
import ApplyPenalty from "@/views/components/ApplyPenalty.vue";
defineProps({
    books:Number,
    loans:Number,
    extended:Number,
    delayed:Number,
    borrowed:Number,
    users:Number,
    pending:Number,
    pending_loans:{
        type:Object as ()=>any,
        required:true
    }
})
</script>

<template>
    <Head title="Dashboard"/>
<main-layout>
    <div class="grid grid-cols-3 gap-2">
        <div class="border  bg-white rounded-xl p-2">
            <div>
               <div class="flex justify-between items-center">
                   <div class="flex gap-2 items-center">
                       <svg class="h-5 fill-sky-600"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                           <path d="M510.354 435.363L402.686 35.422C396.939 14.078 377.547 0 356.354 0C352.242 0 348.059 0.531 343.896 1.641L282.078 18.125C276.193 19.695 270.939 22.383 266.295 25.758C258.254 10.508 242.436 0 224 0H160C151.213 0 143.084 2.531 136 6.656C128.916 2.531 120.787 0 112 0H48C21.49 0 0 21.492 0 48V464C0 490.508 21.49 512 48 512H112C120.787 512 128.916 509.469 136 505.344C143.084 509.469 151.213 512 160 512H224C250.51 512 272 490.508 272 464V165.281L355.805 476.578C361.553 497.926 380.945 512 402.139 512C406.25 512 410.432 511.469 414.594 510.359L476.412 493.875C502.018 487.043 517.215 460.848 510.354 435.363ZM224 48V96H160V48H224ZM160 144H224V368H160V144ZM112 368H48V144H112V368ZM112 48V96H48V48H112ZM48 464V416H112V464H48ZM160 464V416H224V464H160ZM294.445 64.504L356.271 48.02L356.361 48L368.742 93.93L306.828 110.445L294.445 64.504ZM319.266 156.586L381.18 140.074L439.223 355.41L377.309 371.922L319.266 156.586ZM402.154 464.102L389.746 418.066L451.66 401.555L464.045 447.496L402.154 464.102Z"/>
                       </svg>
                       <h2 class="text-lg font-bold">Total Books</h2>
                   </div>
                   <div>
                       <Link href="/admin/books" class="btn-simple btn-medium">view</Link>
                   </div>
               </div>
                <div class="w-full">

                    <h1 class="text-5xl font-bold text-sky-800 my-3">{{books}}</h1>
                </div>
            </div>
        </div>

        <div class="border  bg-white rounded-xl p-2">
            <div>
                <div class="flex justify-between items-center">
                    <div class="flex gap-2 items-center">
                        <svg class="h-5 fill-sky-600"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M384 64H344V24C344 10.75 333.25 0 320 0S296 10.75 296 24V64H152V24C152 10.75 141.25 0 128 0S104 10.75 104 24V64H64C28.654 64 0 92.652 0 128V448C0 483.348 28.654 512 64 512H384C419.346 512 448 483.348 448 448V128C448 92.652 419.346 64 384 64ZM400 448C400 456.824 392.822 464 384 464H64C55.178 464 48 456.824 48 448V192H400V448ZM112 384H208C216.75 384 224 376.75 224 368V272C224 263.25 216.75 256 208 256H112C103.25 256 96 263.25 96 272V368C96 376.75 103.25 384 112 384Z"/>
                        </svg>
                        <h2 class="text-lg font-bold">Books on Loaning</h2>
                    </div>
                    <div>
                        <Link href="/admin/loans" class="btn-simple btn-medium">view</Link>
                    </div>
                </div>
                <div class="w-full">

                    <h1 class="text-5xl font-bold text-sky-800 my-3">{{loans}}</h1>
                    <div class="flex gap-2 ">
                        <h6 class="flex-grow font-bold text-md">Pending: {{pending}}</h6>
                        <h6 class="flex-grow font-bold text-md">Borrowed: {{borrowed}}</h6>
                        <h6 class="flex-grow font-bold text-md">Extended: {{extended}}</h6>
                        <h6 class="flex-grow font-bold text-md">Delayed: {{delayed}}</h6>


                    </div>
                </div>
            </div>
        </div>

        <div class="border  bg-white rounded-xl p-2">
            <div>
                <div class="flex justify-between items-center">
                    <div class="flex gap-2 items-center">
                        <svg class="h-5 text-sky-600"   xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M2 22C2 17.5817 5.58172 14 10 14C14.4183 14 18 17.5817 18 22H16C16 18.6863 13.3137 16 10 16C6.68629 16 4 18.6863 4 22H2ZM10 13C6.685 13 4 10.315 4 7C4 3.685 6.685 1 10 1C13.315 1 16 3.685 16 7C16 10.315 13.315 13 10 13ZM10 11C12.21 11 14 9.21 14 7C14 4.79 12.21 3 10 3C7.79 3 6 4.79 6 7C6 9.21 7.79 11 10 11ZM18.2837 14.7028C21.0644 15.9561 23 18.752 23 22H21C21 19.564 19.5483 17.4671 17.4628 16.5271L18.2837 14.7028ZM17.5962 3.41321C19.5944 4.23703 21 6.20361 21 8.5C21 11.3702 18.8042 13.7252 16 13.9776V11.9646C17.6967 11.7222 19 10.264 19 8.5C19 7.11935 18.2016 5.92603 17.041 5.35635L17.5962 3.41321Z" fill="currentColor"></path>
                        </svg>
                        <h2 class="text-lg font-bold">Total Users</h2>
                    </div>
                    <div>
                        <Link href="/admin/users" class="btn-simple btn-medium">view</Link>
                    </div>
                </div>
                <div class="w-full">

                    <h1 class="text-5xl font-bold text-sky-800 my-3">{{users}}</h1>
                </div>
            </div>

        </div>
    </div>
    <div class="border rounded-xl shadow my-3 overflow-hidden">
        <div class="p-2 border-b">
            <h1 class="text-lg font-bold">Pending approval</h1>
        </div>
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
                    <tr class="border-b text-xs" v-for="loan in pending_loans.data" :key="loan.id">
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
                            <p  class="text-orange-500">
                                {{loan.status}}
                                <button class="ml-2 btn-primary btn-small" @click="approveLoan(loan.id)">Approve</button>
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


                                    </ul>
                                </template>
                            </el-dropdown>
                        </td>


                    </tr>
                    </tbody>
                </table>
                <!--pagination-->

            </div>

        </div>
    </div>
</main-layout>
</template>

<style scoped>

</style>
