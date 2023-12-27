<script setup lang="ts">

import UserLayout from "@/views/layouts/user-layout.vue";
import {Head} from "@inertiajs/vue3";
import {ref} from "vue";
import moment from "moment/moment";
let props=defineProps({
    loan:{
        type:Object as ()=>any,
        required:true
    }
})
const loan=ref(props.loan.data)
</script>

<template>
    <Head>
        <title>{{loan.book.name}}</title>
    </Head>
<user-layout>
<section>
    <div class=" max-w-[1280px] mx-auto p-8">
        <div class="grid grid-cols-2 gap-5">
            <div>
                <h1 class="text-xl font-bold">Book Loan</h1>
                <div class="my-3">
                    <h6>Book title: <span class="text-sky-600">{{loan.book.name}}</span></h6>
                    <div class="my-3 border rounded p-3 bg-sky-50">
                        <p>Borrowed on <span class="text-sky-600">{{moment(loan.created_at).format('MMMM Do YYYY, h:mm a')}}</span></p>
                        <p>Due date <span class="text-sky-600">{{moment(loan.due_date).format('MMMM Do YYYY, h:mm a')}}</span></p>
                        <p class="my-3">Status: <span class="bg-red-600 text-white p-1 rounded-full text-xs px-3">{{loan.status}}</span></p>
                    </div>

                    <div class="my-3 p-3">
                        <h6 class="text-lg font-bold text-sky-800">Terms for borrowing</h6>
                        <ul class="list-disc pl-5">
                            <li>Book must be returned in the same condition it was borrowed. Any damage to the books will
                                attract penalty charges ad determined by the library</li>
                            <li>Books not returned on time are charged <span class="text-sky-600">KES 100.00</span>
                                excluding Sundays, Mondays, and Holidays.
                            </li>
                            <li>Do not mark any borrowed book in any way. Failure to adhere to this term will attract fines that matches
                                the cost of a new book</li>

                        </ul>
                    </div>
                </div>
            </div>
            <div>
                <img :src="loan.book.big_image" :alt="loan.book.name" class="rounded-md">
                <h1 class="text-xl font-bold">{{loan.book.name}}</h1>
                <p class="text-sky-600 text-xs my-2">By {{loan.book.publisher}} | ISBN: {{loan.book.isbn}} | {{loan.book.pages}} pages</p>
                <p class="my-2 text-xs">Category: <span class="text-sky-600">{{loan.book.category}}>{{loan.book.sub_category}}</span></p>
                <p>{{loan.book.description}}</p>



            </div>
        </div>
    </div>
</section>
</user-layout>
</template>

<style scoped>

</style>
