<script setup lang="ts">

import UserLayout from "@/views/layouts/user-layout.vue";
import {Head} from "@inertiajs/vue3";
import moment from "moment";
import {useTruncate} from "@/scripts/useTruncate";
import RequestExtension from "@/views/components/request-extension.vue";
import DataPagination from "@/views/components/data-pagination.vue";
defineProps({
    loans:{
        type:Object as ()=>any,
        required:true
    }
})
</script>

<template>
    <Head>
        <title>Loaned Books</title>
    </Head>
<user-layout>
<section>
    <div class="max-w-[1280px] mx-auto p-8">
        <div>
            <h1 class="text-xl font-bold my-3">Loaned Books</h1>
            <div v-if="loans.data.length">
                <div v-for="loan in loans.data">
                    <div class="flex gap-3 py-3">
                        <div class="">
                           <img :src="loan.book.small_image" :alt="loan.book.name" class="h-44">
                        </div>
                        <div>
                            <h6 class="text-lg font-bold">{{loan.book.name}}</h6>
                            <p class="text-sky-600 text-xs">By {{loan.book.publisher}} | ISBN: {{loan.book.isbn}} | {{loan.book.pages}} pages</p>
                            <p class="my-2 text-xs">Category: <span class="text-sky-600">{{loan.book.category}}>{{loan.book.sub_category}}</span></p>
                            <p>{{useTruncate(loan.book.description,150)}}</p>
                            <div>
                                <p>Loaned on: <span class="text-sky-600">{{moment(loan.loan_date).format('MMMM Do YYYY, h:mm a')}}</span></p>
                                <p>Due Date: <span class="text-sky-600">{{moment(loan.due_date).format('MMMM Do YYYY, h:mm a')}}</span></p>
                            </div>
                            <div v-if="loan.status==='Pending'">
                                <p class="my-3">Status: <span class="bg-red-600 text-white p-1 rounded-full text-xs px-3">{{loan.status}}</span></p>
                            </div>
                            <div v-if="loan.status==='Borrowed'">
                                <request-extension :loan="loan">
                                    <template #trigger>
                                        <button class="text-red-600 font-medium">Request for extension</button>
                                    </template>
                                </request-extension>
                            </div>
                            <div v-if="loan.status==='Extended'" class="text-red-500">
                                <p>Under extension until: {{moment(loan.due_date).format('MMMM Do YYYY, h:mm a')}}</p>
                            </div>
                            <div v-if="loan.status==='Delayed'" class="text-red-500">
                                <p>Return deadline passed</p>
                                <p>A penalty of KES {{moment().diff(loan.due_date,'days')*100}} has been applied</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>

                <div class="my-3">
                    <data-pagination :data="loans"/>
                </div>
            </div>
            <div v-else>
                <h6 class="text-lg">No books borrowed at the moment!</h6>
            </div>
        </div>
    </div>
</section>
</user-layout>
</template>

<style scoped>

</style>
