<script setup lang="ts">
import {Head, Link} from "@inertiajs/vue3";
import MainLayout from "@/views/layouts/main-layout.vue";
</script>

<template>
<Head title="Books"/>
    <main-layout>

        <section>
            <div class="my-5">
                <ul class="flex gap-2 items-center font-medium">
                    <li>
                        <Link   :class="{ 'text-sky-700': $page.component === 'admin/books/index' }" href="/admin/books">All Books</Link>
                    </li>
                    <li>
                        <Link href="/admin/loan">On Loan</Link>
                    </li>
                </ul>
            </div>
            <div class="flex justify-between gap-2">
                <div class="flex gap-2 items-center">
                    <label>Showing</label>
                    <select class="sumo-input">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <div class="w-96">
                        <input type="search" class="sumo-input" placeholder="Search books by name...">
                    </div>
                    <div>
                        <Link title="Add new books" href="/admin/books/create">
                            <button class="btn-primary flex gap-2 items-center">
                                <svg class="h-4 w-5 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M432 256C432 269.25 421.25 280 408 280H248V440C248 453.25 237.25 464 224 464S200 453.25 200 440V280H40C26.75 280 16 269.25 16 256S26.75 232 40 232H200V72C200 58.75 210.75 48 224 48S248 58.75 248 72V232H408C421.25 232 432 242.75 432 256Z"/>
                                </svg>
                                New book
                            </button>
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </main-layout>
</template>

<style scoped>

</style>
