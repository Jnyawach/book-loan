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
            category: string
            sub_category: string
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
const activeNames = ref(0)

const book_category=ref([])
const category=ref(props.filters.category||'')
const sub_category=ref(props.filters.sub_category||'')
watch([showing, search,book_category], debounce(function () {
    router.get('/', {
        showing: showing.value,
        search: search.value,
        category: book_category.value[0],
        sub_category: book_category.value[1]
    },{ preserveScroll: true, replace: true,preserveState: true})
}, 300));

const clearFilters=()=>{
    search.value=''
    book_category.value=[]
    router.get('/', {
        showing: showing.value,
    })
}
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
                                <ul class="space-y-2">
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
                        <div class="flex flex-grow gap-2 items-center w-full">
                            <div>
                               <select class="sumo-input w-36" v-model="showing">
                                   <option value="10">10</option>
                                   <option value="20">20</option>
                                   <option value="30">50</option>
                                   <option value="100">100</option>
                               </select>

                            </div>
                            <div class="flex-grow" >
                                <input v-model="search" type="search" class="sumo-input" placeholder="Search book by title or publisher">
                            </div>
                            <div v-if="search || book_category.length">
                                <button class="btn-primary flex gap-2 items-center" @click="clearFilters">
                                    <svg class="fill-white h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                      <path d="M315.31 411.31C309.056 417.563 298.936 417.563 292.682 411.31L160 278.627L27.318 411.31C21.064 417.563 10.944 417.563 4.69 411.31C-1.563 405.056 -1.563 394.936 4.69 388.682L137.373 256L4.69 123.318C-1.563 117.064 -1.563 106.944 4.69 100.69C10.944 94.437 21.064 94.437 27.318 100.69L160 233.373L292.682 100.69C298.936 94.437 309.056 94.437 315.31 100.69C321.563 106.944 321.563 117.064 315.31 123.318L182.627 256L315.31 388.682C321.563 394.936 321.563 405.056 315.31 411.31Z"/>
                                    </svg>
                                   <span>Clear filters</span>
                                </button>
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
                                        <Link :href="`books/${book.id}/borrow`" class="btn-primary btn-small">Borrow</Link>
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
