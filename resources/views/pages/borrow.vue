<script setup lang="ts">

import UserLayout from "@/views/layouts/user-layout.vue";
import {Head, useForm} from "@inertiajs/vue3";
import moment from "moment";
import {ref} from "vue";
let props=defineProps({
    book:{
        type:Object as ()=>any,
        required:true
    },
    user:{
        type:Object as ()=>any,
        required:true
    }
})

const form=useForm({
    user_id:props.user.id,
    book_id:props.book.data.id,
    period:''
})
const borrowBook=()=>{
   form.post('/books/borrow')
}
</script>

<template>
    <Head title="Borrow Books"/>
<user-layout>
    <section>
        <div class=" max-w-[1280px] mx-auto p-8">

            <div class="grid grid-cols-2 gap-5">
                <div>
                    <img :src="book.data.big_image" :alt="book.data.name" class="w-full rounded-md">
                </div>
                <div>
                    <h1 class="text-3xl font-bold">Borrow {{book.data.name}}</h1>
                    <p class="text-sky-600 text-xs my-2">By {{book.data.publisher}} | ISBN: {{book.data.isbn}} | {{book.data.pages}} pages</p>
                    <p class="my-2 text-xs">Category: <span class="text-sky-600">{{book.data.category}}>{{book.data.sub_category}}</span></p>
                    <p>{{book.data.description}}</p>

                    <div class="my-3 border rounded p-3 bg-sky-50">
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
                    <div class="border-t py-3 border-black">
                        <h6 class="text-sky-600 font-bold my-2">Borrow this book</h6>
                        <form @submit.prevent="borrowBook">
                            <div class="grid grid-cols-3 gap-3">
                                <div class="border p-2  rounded-md cursor-pointer hover:bg-sky-50"
                                     :class="{'bg-sky-50 border-sky-600':form.period==='7'}"
                                >
                                    <input v-model="form.period" type="radio" value="7"  id="7-days" class="hidden">
                                    <label for="7-days" class="cursor-pointer">
                                        Borrow for 7 days. <br>
                                        Return on {{moment(new Date()).add(7,'days').format('DD-MM-YYYY')}}<br>
                                        <span class="text-sky-600 font-medium">KES 200.00</span>
                                    </label>
                                </div>

                                <div class="border p-2  rounded-md cursor-pointer hover:bg-sky-50"
                                     :class="{'bg-sky-50 border-sky-600':form.period==='14'}"
                                >
                                    <input v-model="form.period" type="radio" value="14"  id="14-days" class="hidden">
                                    <label for="14-days" class="cursor-pointer">
                                        Borrow for 14 days. <br>
                                        Return on {{moment(new Date()).add(14,'days').format('DD-MM-YYYY')}}<br>
                                        <span class="text-sky-600 font-medium">KES 350.00</span>
                                    </label>
                                </div>
                                <div class="border p-2  rounded-md cursor-pointer hover:bg-sky-50"
                                     :class="{'bg-sky-50 border-sky-600':form.period==='30'}"
                                >
                                    <input v-model="form.period" type="radio" value="30"  id="30-days" class="hidden">
                                    <label for="30-days" class="cursor-pointer">
                                        Borrow for 30 days. <br>
                                        Return on {{moment(new Date()).add(30,'days').format('DD-MM-YYYY')}}<br>
                                        <span class="text-sky-600 font-medium">KES 600.00</span>
                                    </label>
                                </div>
                            </div>
                            <div class="my-3" v-if="form.period">
                                <button :disabled="form.processing" type="submit" class="btn-primary btn-medium flex items-center gap-2 justify-center">
                                    <span>Borrow this book</span>

                                    <svg v-if="form.processing" class="fill-white w-5 animate-spin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M11.9995 2C12.5518 2 12.9995 2.44772 12.9995 3V6C12.9995 6.55228 12.5518 7 11.9995 7C11.4472 7 10.9995 6.55228 10.9995 6V3C10.9995 2.44772 11.4472 2 11.9995 2ZM11.9995 17C12.5518 17 12.9995 17.4477 12.9995 18V21C12.9995 21.5523 12.5518 22 11.9995 22C11.4472 22 10.9995 21.5523 10.9995 21V18C10.9995 17.4477 11.4472 17 11.9995 17ZM20.6597 7C20.9359 7.47829 20.772 8.08988 20.2937 8.36602L17.6956 9.86602C17.2173 10.1422 16.6057 9.97829 16.3296 9.5C16.0535 9.02171 16.2173 8.41012 16.6956 8.13398L19.2937 6.63397C19.772 6.35783 20.3836 6.52171 20.6597 7ZM7.66935 14.5C7.94549 14.9783 7.78161 15.5899 7.30332 15.866L4.70525 17.366C4.22695 17.6422 3.61536 17.4783 3.33922 17C3.06308 16.5217 3.22695 15.9101 3.70525 15.634L6.30332 14.134C6.78161 13.8578 7.3932 14.0217 7.66935 14.5ZM20.6597 17C20.3836 17.4783 19.772 17.6422 19.2937 17.366L16.6956 15.866C16.2173 15.5899 16.0535 14.9783 16.3296 14.5C16.6057 14.0217 17.2173 13.8578 17.6956 14.134L20.2937 15.634C20.772 15.9101 20.9359 16.5217 20.6597 17ZM7.66935 9.5C7.3932 9.97829 6.78161 10.1422 6.30332 9.86602L3.70525 8.36602C3.22695 8.08988 3.06308 7.47829 3.33922 7C3.61536 6.52171 4.22695 6.35783 4.70525 6.63397L7.30332 8.13398C7.78161 8.41012 7.94549 9.02171 7.66935 9.5Z" fill="currentColor"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </section>
</user-layout>
</template>

<style scoped>

</style>
