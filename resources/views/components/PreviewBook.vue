<template>
    <div @click="show=true">
        <slot name="trigger"></slot>
    </div>
    <teleport to="body">
        <Transition
            enter-from-class="opacity-0 scale-125"
            enter-to-class="opacity-100 scale-100"
            enter-active-class="transition duration-500"
            leave-active-class="transition duration-500"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-125"
        >
            <div @click.self="show=false" v-if="show" class="inset-0 fixed bg-black bg-opacity-40 z-[100000] grid place-items-center p-5">
                <div class="bg-white lg:w-1/2 w-full rounded-xl">
                    <header class="p-3 font-semibold text-lg">
                        <div class="flex justify-end">
                            <div>
                                <div class="text-end">
                                    <button type="button" @click="show=false" :class="'rounded-full bg-sky-800 h-7 w-7 flex place-content-center'">
                                        <svg class="h-5 fill-white self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                            <path d="M312.1 375c9.369 9.369 9.369 24.57 0 33.94s-24.57 9.369-33.94 0L160 289.9l-119 119c-9.369 9.369-24.57 9.369-33.94 0s-9.369-24.57 0-33.94L126.1 256L7.027 136.1c-9.369-9.369-9.369-24.57 0-33.94s24.57-9.369 33.94 0L160 222.1l119-119c9.369-9.369 24.57-9.369 33.94 0s9.369 24.57 0 33.94L193.9 256L312.1 375z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </header>
                    <hr>
                    <div class="p-5">
                        <div class="grid md:grid-cols-5 gap-2">
                            <div class="md:col-span-2">
                                <img :src="book.small_image" class="rounded-md" alt="book.name">
                            </div>
                            <div class="md:col-span-3">
                                <h5 class="text-lg font-bold">{{book.name}}</h5>
                                <p class="text-sky-600 text-xs">By {{book.publisher}} | ISBN: {{book.isbn}} | {{book.pages}} pages</p>
                                <p class="my-2 text-xs">Category: <span class="text-sky-600">{{book.category}}>{{book.sub_category}}</span></p>
                                <p>{{book.description}}</p>
                                <div class="my-3">
                                    <Link href="#" title="Borrow this book" class="btn-primary btn-small">Borrow this book</Link>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </Transition>
    </teleport>
</template>

<script setup lang="ts">
import {ref, watch} from "vue";
import {Link} from "@inertiajs/vue3";

let props=defineProps({
    book:{
        type:Object as ()=>any,
        required:true
    }
})
const show=ref(false)

watch(show,(val)=>{
    if(val){
        document.body.style.overflow='hidden'
    }else{
        document.body.style.overflow='auto'
    }
})

</script>

<style scoped>

</style>
