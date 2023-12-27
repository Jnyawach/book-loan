<script setup lang="ts">
import {Head, Link, router} from "@inertiajs/vue3";
import MainLayout from "@/views/layouts/main-layout.vue";
import DataPagination from "@/views/components/data-pagination.vue";
import PromptAlert from "@/views/components/prompt-alert.vue";
import {watch,ref} from "vue";
import debounce from "lodash/debounce";
import PreviewBook from "@/views/components/PreviewBook.vue";
let props=defineProps({
    books:{
        type:Object as ()=>any,
        required:true
    },
    filters:{
        type:Object as ()=>any,
        required:true
    }
})
const deleteBook=(book:number)=>{
    router.delete(`/admin/books/${book}` )
}

const showing=ref(props.filters.showing || 10)
const search=ref(props.filters.search || '')
watch([showing, search], debounce(function () {
router.get('/admin/books', {
    showing: showing.value,
    search: search.value
},{ preserveScroll: true, replace: true,preserveState: true})
}, 300));
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

                </ul>
            </div>
            <div class="flex justify-between gap-2">
                <div class="flex gap-2 items-center">
                    <label>Showing</label>
                    <select v-model="showing" class="sumo-input">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <div class="w-96">
                        <input v-model="search" type="search" class="sumo-input" placeholder="Search books by name...">
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

            <div class="border rounded shadow my-3 overflow-hidden">
                <div>

                    <div class="relative">
                        <table class="w-full text-sm text-left text-gray-700 font-medium">
                            <thead class="text-xs text-sky-600 uppercase bg-sky-50">
                            <tr class="border-b">
                                <th scope="col" class="px-2 py-3">
                                   Cover
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    Title
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    ISBN
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    Publisher
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    Added By
                                </th>

                                <th scope="col" class="px-2 py-3">
                                    Category
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    Subcategory
                                </th>
                                <th scope="col" class="px-2 py-3 text-end">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody class="[&>*:nth-child(even)]:bg-gray-100">
                            <tr class="border-b text-xs" v-for="book in books.data" :key="book.id">
                                <th scope="row" class="p-2">
                                    <img class="h-14" :src="book.small_image" :alt="book.name">

                                </th>
                                <td class="px-2 py-3 font-semibold text-sumo-800 whitespace-nowrap">
                                    {{book.name}}
                                </td>
                                <td class="px-2 py-3 capitalize">
                                    {{book.isbn}}
                                </td>

                                <td class="px-2 py-3 capitalize">
                                    {{book.publisher}}
                                </td>
                                <td class="px-2 py-3 capitalize">
                                    {{book.added_by}}
                                </td>
                                <td class="px-2 py-3 capitalize">
                                    {{book.category}}
                                </td>
                                <td class="px-2 py-3 capitalize">
                                    {{book.sub_category}}
                                </td>
                                <td class="px-2 py-3">
                                    <el-dropdown :key="book.id" placement="bottom-end">
                                        <button class="flex items-center gap-2 text-xs border-0 outline-0">
                                            <span>Action</span>
                                            <svg class="h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path d="M12 3C10.9 3 10 3.9 10 5C10 6.1 10.9 7 12 7C13.1 7 14 6.1 14 5C14 3.9 13.1 3 12 3ZM12 17C10.9 17 10 17.9 10 19C10 20.1 10.9 21 12 21C13.1 21 14 20.1 14 19C14 17.9 13.1 17 12 17ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"></path>
                                            </svg>
                                        </button>

                                        <template #dropdown>
                                            <ul class="divide-y w-36">
                                                <li>

                                                    <Link :href="`/admin/books/${book.id}`" class="p-2  text-xs hover:text-blue-800 flex gap-2 font-medium dark:hover:text-blue-400">
                                                        <span>View details</span>
                                                    </Link>
                                                </li>
                                                <li>
                                                    <Link :href="`/admin/books/${book.id}/edit`" class="p-2  text-xs hover:text-blue-800 flex gap-2 font-medium dark:hover:text-blue-400">
                                                        <span>Update details</span>
                                                    </Link>
                                                </li>
                                                <li>
                                                    <prompt-alert @proceed="deleteBook(book.id)"
                                                                title="Are you sure you want to delete this book?"
                                                                  description="This action is irreversible. The book will be deleted from the system."
                                                    >
                                                        <template #trigger>
                                                            <button   class="p-2  text-xs hover:text-blue-800 flex gap-2 font-medium dark:hover:text-blue-400">
                                                                <span>Delete book</span>
                                                            </button>
                                                        </template>
                                                    </prompt-alert>

                                                </li>


                                            </ul>
                                        </template>
                                    </el-dropdown>
                                </td>


                            </tr>
                            </tbody>
                        </table>
                        <!--pagination-->
                        <data-pagination :data="books"></data-pagination>
                    </div>

                </div>
            </div>
        </section>
    </main-layout>
</template>

<style scoped>

</style>
