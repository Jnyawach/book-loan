<script setup lang="ts">

import MainLayout from "@/views/layouts/main-layout.vue";
import {Head, Link} from "@inertiajs/vue3";
import {ref} from "vue";
import moment from "moment";

let props=defineProps({
    book:{
        type:Object as ()=>any,
        required:true
    }
})

const book=ref<any>(props.book.data)
</script>

<template>
    <Head>
        <title>{{book.name}}</title>
    </Head>
<main-layout>
   <section>
       <div class="my-5">
           <h1 class="text-lg font-bold">{{book.name}}</h1>
       </div>
       <div class="p-5">
           <div class="grid grid-cols-2 gap-2">
               <div >
                   <img :src="book.big_image" class="rounded-md w-full" :alt="book.name">
               </div>
               <div>
                   <h5 class="text-lg font-bold">{{book.name}}</h5>
                   <p class="text-sky-600 text-xs">By {{book.publisher}} | ISBN: {{book.isbn}} | {{book.pages}} pages</p>
                   <p class="my-2 text-xs">Category: <span class="text-sky-600">{{book.category}}>{{book.sub_category}}</span></p>
                   <p>{{book.description}}</p>
                   <div v-if="book.active_loan" class="my-3">
                       <h6 class="text-sky-600 font-medium">Currently on loan </h6>
                       <p>Loan date: <span class="text-sky-600">{{moment(book.active_loan.loan_date).format('MMMM Do YYYY')}}</span></p>
                       <p>Loan date: <span class="text-sky-600">{{moment(book.active_loan.due_date).format('MMMM Do YYYY')}}</span></p>
                   </div>

               </div>
           </div>

       </div>
   </section>
</main-layout>
</template>

<style scoped>

</style>
