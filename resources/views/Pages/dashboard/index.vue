<script setup lang="ts">

import MainLayout from "@/views/layouts/main-layout.vue";
import {Head,Link} from "@inertiajs/vue3";
import DonutChart from "@/views/components/donut-chart.vue";
import LineChart from "@/views/components/line-chart.vue";
defineProps({
    customer:Number,
    rating:String
})
</script>

<template>
    <Head>
        <title>Dashboard</title>
    </Head>
<main-layout>
<div class="grid grid-cols-2 gap-2">
    <div class="border  bg-white rounded-xl p-2">
        <div class="flex gap-5 items-center w-full">
            <div>
                <svg class="h-14 fill-sky-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                   <path d="M112 128h160C280.8 128 288 120.8 288 112S280.8 96 272 96h-24.88C252.6 86.55 256 75.72 256 64c0-35.35-28.65-64-64-64S128 28.65 128 64c0 11.72 3.379 22.55 8.877 32H112C103.2 96 96 103.2 96 112S103.2 128 112 128zM192 32c17.64 0 32 14.36 32 32s-14.36 32-32 32S160 81.64 160 64S174.4 32 192 32zM320 64c-8.844 0-16 7.156-16 16S311.2 96 320 96c17.64 0 32 14.34 32 32v320c0 17.66-14.36 32-32 32H64c-17.64 0-32-14.34-32-32V128c0-17.66 14.36-32 32-32c8.844 0 16-7.156 16-16S72.84 64 64 64C28.7 64 0 92.72 0 128v320c0 35.28 28.7 64 64 64h256c35.3 0 64-28.72 64-64V128C384 92.72 355.3 64 320 64zM72 256c0 13.25 10.75 24 24 24c13.26 0 24-10.75 24-24c0-13.26-10.74-24-24-24C82.75 232 72 242.7 72 256zM96 328c-13.25 0-24 10.74-24 24c0 13.25 10.75 24 24 24c13.26 0 24-10.75 24-24C120 338.7 109.3 328 96 328zM304 240h-128C167.2 240 160 247.2 160 256s7.156 16 16 16h128C312.8 272 320 264.8 320 256S312.8 240 304 240zM304 336h-128C167.2 336 160 343.2 160 352s7.156 16 16 16h128c8.844 0 16-7.156 16-16S312.8 336 304 336z"/>
                </svg>
            </div>
            <div class="w-full">
                <div class="flex justify-between w-full">
                    <h2 class="text-lg font-bold">Total Respondents</h2>
                    <Link href="/dashboard/customers" class="btn-simple btn-medium">view</Link>
                </div>
                <h1 class="text-5xl font-bold text-sky-800 my-3">{{customer}}</h1>
            </div>
        </div>
    </div>

    <div class="border  bg-white rounded-xl p-2">
        <div class="flex gap-5 items-center w-full">
            <div>
                <svg class="h-14 fill-sky-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M364.2 267.2l-104.8-15.28L212.6 156.7C208.7 148.8 200.7 143.9 191.9 143.9C183.2 143.8 175.1 148.8 171.4 156.7L124.5 251.1L19.71 267.2C.9566 269.9-6.618 293.1 7.007 306.5l75.87 74l-17.1 104.6c-1.25 6.75 .5878 13.51 4.963 18.63C74.22 509 80.64 512 87.52 512c3.625 0 7.436-.9554 10.69-2.705l93.79-49.38l93.74 49.38c3.25 1.625 6.991 2.675 10.62 2.675c6.75 0 13.23-2.97 17.61-8.22c4.25-5.125 6.273-11.98 5.148-18.61L301.2 380.5l75.92-74C390.6 293 383.1 269.1 364.2 267.2zM266.7 369.3l17.62 103.1l-92.5-48.75l-92.5 48.75l17.62-103.1L42.22 296.1l103.4-15l46.38-93.88l46.13 93.88l103.5 15L266.7 369.3zM256 112h64v64C320 184.8 327.2 192 336 192S352 184.8 352 176v-64h64c8.844 0 16-7.156 16-16s-7.154-15.1-15.1-15.1L352 80v-64C352 7.156 344.8 0 336 0S320 7.156 320 16v64l-63.99 .0022C247.2 80 240 87.16 240 96S247.2 112 256 112zM496 208h-32v-32c0-8.844-7.155-15.1-15.1-15.1S432 167.2 432 176v32h-32c-8.844 0-15.1 7.162-15.1 16.01S391.2 240 400 240h32v32c0 8.844 7.158 16.01 16 16.01S464 280.8 464 272v-32h32c8.844 0 16-7.151 16-15.99S504.8 208 496 208z"/>
                </svg>
            </div>
            <div class="w-full">
                <div class="flex justify-between w-full">
                    <h2 class="text-lg font-bold">Average rating</h2>
                    <Link href="/dashboard/customers" class="btn-simple btn-medium">view</Link>
                </div>
                <h1 class="text-5xl font-bold text-sky-800 my-3">{{rating}}/5</h1>
            </div>
        </div>
    </div>
</div>
    <!--charts-->
    <div class="grid grid-cols-6 gap-2 my-5">
        <div class="col-span-2 grid">
            <donut-chart></donut-chart>
        </div>
        <div class="col-span-4 grid">
            <line-chart></line-chart>
        </div>
    </div>
</main-layout>
</template>

<style scoped>

</style>
