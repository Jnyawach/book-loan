<script setup lang="ts">
import {Head, Link, router} from "@inertiajs/vue3";
import UserLayout from "@/views/layouts/user-layout.vue";
import {ref, watch} from "vue";
import debounce from "lodash/debounce";
import {useTruncate} from "@/scripts/useTruncate";
import PreviewBook from "@/views/components/PreviewBook.vue";
import DataPagination from "@/views/components/data-pagination.vue";
let props=defineProps({
    filters: {
        type: Object as () => {
            search: string,
            showing: number
        },
        required: true
    },
    books: {
        type: Object as ()=>any,
        required: true
    },
    categories: {
        type: Object as ()=>any,
        required: true
    },
    sub_categories: {
        type: Object as ()=>any,
        required: true
    }
})

const search=ref(props.filters.search|| '')
const showing=ref(props.filters.showing|| 10)

watch([showing, search], debounce(function () {
    router.get('/', {
        showing: showing.value,
        search: search.value
    },{ preserveScroll: true, replace: true,preserveState: true})
}, 300));
const activeNames = ref(0)
const book_category=ref([])
</script>

<template>
    <Head>
        <title>Company X</title>
    </Head>
    <user-layout>
        <section class="p-5">
            <div class="grid md:grid-cols-8 gap-2">
                <div class="md:col-span-2">
                    <h1 class="text-lg font-bold">Categories</h1>
                    <div class="my-5 bg-white">
                        <el-collapse v-model="activeNames">
                            <el-collapse-item :name="index" v-for="(category, index) in categories">
                                <template #title>
                                   <h6 class="p-2 font-medium"> {{category}}</h6>

                                </template>
                                <ul>
                                  <li v-for="(sub_category, newIndex) in sub_categories" :key="newIndex">
                                      <label class="flex items-center gap-2">
                                          <input v-model="book_category" type="radio" :value="[category, sub_category]">
                                          <span>{{sub_category}}</span>
                                      </label>
                                  </li>
                                </ul>
                            </el-collapse-item>


                        </el-collapse>

                    </div>
                </div>
                <div class="md:col-span-6">
                    <h1 class="text-lg font-bold">Books</h1>
                    <div class="my-5 w-full">
                        <div class="flex gap-2 items-center w-full">
                            <div>
                               <select class="sumo-input" v-model="showing">
                                   <option value="10">10</option>
                                   <option value="20">20</option>
                                   <option value="30">50</option>
                                   <option value="100">100</option>
                               </select>

                            </div>
                            <div class="w-full">
                                <input v-model="search" type="search" class="sumo-input" placeholder="Search book by title or publisher">
                            </div>
                        </div>
                    </div>
                    <!--books-->
                    <div class="my-5 grid grid-cols-4 gap-5">
                        <div v-for="book in books.data" :key="book.id">
                            <div class="bg-white shadow rounded-md">
                              <div class="relative">
                                  <div class="aspect-w-8 aspect-h-12 rounded-t-md overflow-hidden">
                                      <img :src="book.small_image" class="w-full h-full object-center object-cover" alt="book.name">
                                  </div>
                                  <div class="absolute top-0 right-0 ">
                                      <PreviewBook :book="book" :key="book.id">
                                          <template #trigger>
                                              <button class="bg-white/80 p-1 text-sky-800 font-medium">Preview details</button>
                                          </template>
                                      </PreviewBook>

                                  </div>
                              </div>
                                <div class="p-3">
                                    <h6 class="my-2 font-bold text-md">{{useTruncate(book.name,30)}}</h6>
                                    <p class="text-sky-600"> by {{book.publisher}}</p>

                                    <div class="flex justify-end">
                                        <button class="btn-primary btn-small">Borrow</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="my-3">
                        <data-pagination :data="books"/>
                    </div>
                </div>
            </div>
        </section>

    </user-layout>


</template>

<style scoped>

</style>
