<script setup lang="ts">

import UserLayout from "@/views/layouts/user-layout.vue";
import {Head} from "@inertiajs/vue3";
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
            <div>
                <div v-for="loan in loans.data">
                    <div class="flex gap-3 py-3">
                        <div class="flex-grow w-44">
                           <img :src="loan.book.small_image" :alt="loan.book.name" class="h-36">
                        </div>
                        <div>
                            <h6 class="text-lg font-bold">{{loan.book.name}}</h6>
                            <p>{{loan.book.description}}</p>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</section>
</user-layout>
</template>

<style scoped>

</style>
