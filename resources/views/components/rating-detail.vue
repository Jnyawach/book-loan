<template>
    <div @click="show=true">
        <slot name="trigger"></slot>
    </div>
    <teleport to="body">
        <Transition
            enter-from-class="opacity-0 scale-125"
            enter-to-class="opacity-100 scale-100"
            enter-active-class="transition duration-300"
            leave-active-class="transition duration-200"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-125"
        >
            <div @click.self="show=false" v-if="show" class="inset-0 fixed bg-black bg-opacity-40 z-[100000] grid place-items-center p-5">
                <div class="bg-white lg:w-1/2 w-full rounded-xl overflow-hidden">
                    <header class="p-3">
                        <div class="flex justify-between">

                            <slot name="header">
                                <div class="font-bold text-sumo-300 text-lg">
                                    <h6>Rating details: <span class="capitalize">{{customer.name}}</span></h6>
                                </div>
                            </slot>
                            <div>
                                <div class="text-end">
                                    <button type="button" @click="show=false" class="rounded-full bg-sky-700 h-7 w-7 flex place-content-center">
                                        <svg class="h-5 fill-white self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M312.1 375c9.369 9.369 9.369 24.57 0 33.94s-24.57 9.369-33.94 0L160 289.9l-119 119c-9.369 9.369-24.57 9.369-33.94 0s-9.369-24.57 0-33.94L126.1 256L7.027 136.1c-9.369-9.369-9.369-24.57 0-33.94s24.57-9.369 33.94 0L160 222.1l119-119c9.369-9.369 24.57-9.369 33.94 0s9.369 24.57 0 33.94L193.9 256L312.1 375z"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </header>
                    <hr>
                    <div class="p-3.5 max-h-[70vh] overflow-y-auto">
                        <div class="space-y-5">
                            <div v-for="(rate,index) in customer.answers" :key="index" class="bg-white border p-3 shadow rounded-lg">
                                <div>
                                    <h2 class="text-lg font-bold text-center">Quiz {{index+1}}: <span class="text-sky-600">{{rate.question.quiz}}</span></h2>
                                    <div class="flex justify-center gap-5 items-center my-3">
                                        <div class="group cursor-pointer p-2 w-36" :class="[rate.value===1?'border rounded-lg bg-sky-50 border-sky-600':'']">
                                            <img class="mx-auto group-hover:scale-125 hover:scale-125 transition-all duration-300 cursor-pointer h-10 w-10" src="https://img.icons8.com/emoji/48/000000/angry-face-emoji--v2.png" alt="Hungry face"/>
                                            <h6 class="text-center text-sm my-2 group-hover:text-sky-600">Very dissatisfied</h6>
                                        </div>
                                        <div class="group cursor-pointer p-2 w-36" :class="[rate.value===2?'border rounded-lg bg-sky-50 border-sky-600':'']">
                                            <img class="mx-auto group-hover:scale-125 hover:scale-125 transition-all duration-300 cursor-pointer h-10 w-10" src="https://img.icons8.com/fluent/48/000000/sad.png" alt="Sad face"/>
                                            <h6 class="text-center text-sm my-2 group-hover:text-sky-600">Dissatisfied</h6>
                                        </div>
                                        <div class="group cursor-pointer p-2 w-36" :class="[rate.value===3?'border rounded-lg bg-sky-50 border-sky-600':'']">
                                            <img class="mx-auto group-hover:scale-125 hover:scale-125 transition-all duration-300 cursor-pointer h-10 w-10" src="https://img.icons8.com/color/48/000000/happy.png" alt="Happy face"/>
                                            <h6 class="text-center text-sm my-2 group-hover:text-sky-600">Neutral</h6>
                                        </div>
                                        <div class="group cursor-pointer p-2 w-36" :class="[rate.value===4?'border rounded-lg bg-sky-50 border-sky-600':'']">
                                            <img class="mx-auto group-hover:scale-125 hover:scale-125 transition-all duration-300 cursor-pointer h-10 w-10" src="https://img.icons8.com/emoji/48/000000/smiling-face.png" alt="Smiling face"/>
                                            <h6 class="text-center text-sm my-2 group-hover:text-sky-600">Satisfied</h6>
                                        </div>
                                        <div class="group cursor-pointer p-2 w-36" :class="[rate.value===5?'border rounded-lg bg-sky-50 border-sky-600':'']">
                                            <img class="mx-auto group-hover:scale-125 hover:scale-125 transition-all duration-300 cursor-pointer h-10 w-10" src="https://img.icons8.com/color/48/000000/lol.png" alt="Lots of love face"/>
                                            <h6 class="text-center text-sm my-2 group-hover:text-sky-600">Very satisfied</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <hr>
                    <footer class="p-3 bg-gray-100">

                    </footer>


                </div>
            </div>
        </Transition>
    </teleport>
</template>

<script setup lang="ts">
import {watch, ref} from "vue";

let props=defineProps({
    customer:Object
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
