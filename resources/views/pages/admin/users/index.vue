<script setup lang="ts">

import MainLayout from "@/views/layouts/main-layout.vue";
import {Head, Link, router} from "@inertiajs/vue3";
import {ref, watch} from "vue";
import DataPagination from "@/views/components/data-pagination.vue";
import CreateUser from "@/views/pages/admin/users/CreateUser.vue";
import PromptAlert from "@/views/components/prompt-alert.vue";
import EditUser from "@/views/pages/admin/users/EditUser.vue";
import debounce from "lodash/debounce";
let props=defineProps({
    users:{
        type:Object as ()=>any,
        required:true
    },
    filters:{
        type:Object as ()=>any,
        required:true
    }
})

const showing=ref(props.filters.showing || 10)
const search=ref(props.filters.search || '')
const deleteUser=(user:number)=>{
    router.delete(`/admin/users/${user}`)
}
watch([showing, search], debounce(function () {
    router.get('/admin/users', {
        showing: showing.value,
        search: search.value
    },{ preserveScroll: true, replace: true,preserveState: true})
}, 300));
</script>

<template>
    <Head>
        <title>Users</title>
    </Head>
<main-layout>
    <section>
        <div class="my-5">
            <ul class="flex gap-2 items-center font-medium">
                <li>
                    <Link   :class="{ 'text-sky-700': $page.component === 'admin/users/index' }" href="/admin/users">Users</Link>
                </li>

            </ul>
        </div>
        <div class="flex justify-between gap-2">
            <div class="flex gap-2 items-center">
                <label>Showing</label>
                <select class="sumo-input" v-model="showing">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="flex gap-2">
                <div class="w-96">
                    <input v-model="search" type="search" class="sumo-input" placeholder="Search users by name...">
                </div>
                <div>
                    <CreateUser>
                        <template #trigger>
                            <button title="Add new books" >
                                <button class="btn-primary flex gap-2 items-center">
                                    <svg class="h-4 w-5 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path d="M432 256C432 269.25 421.25 280 408 280H248V440C248 453.25 237.25 464 224 464S200 453.25 200 440V280H40C26.75 280 16 269.25 16 256S26.75 232 40 232H200V72C200 58.75 210.75 48 224 48S248 58.75 248 72V232H408C421.25 232 432 242.75 432 256Z"/>
                                    </svg>
                                    New user
                                </button>
                            </button>
                        </template>
                    </CreateUser>

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
                               Joined on
                            </th>
                            <th scope="col" class="px-2 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-2 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-2 py-3">
                               Role
                            </th>

                            <th scope="col" class="px-2 py-3 text-end">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody class="[&>*:nth-child(even)]:bg-gray-100">
                        <tr class="border-b text-xs" v-for="user in users.data" :key="user.id">
                            <th scope="row" class="p-2">
                                {{new Date(user.created_at).toDateString()}}

                            </th>
                            <td class="px-2 py-3 font-semibold text-sumo-800 whitespace-nowrap">
                                {{user.name}}
                            </td>
                            <td class="px-2 py-3">
                                {{user.email}}
                            </td>
                            <td class="px-2 py-3">
                                {{user.user_role}}
                            </td>

                            <td class="px-2 py-3 flex justify-end">
                                <el-dropdown :key="user.id" placement="bottom-end">
                                    <button class="flex items-center gap-2 text-xs border-0 outline-0">
                                        <span>Action</span>
                                        <svg class="h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M12 3C10.9 3 10 3.9 10 5C10 6.1 10.9 7 12 7C13.1 7 14 6.1 14 5C14 3.9 13.1 3 12 3ZM12 17C10.9 17 10 17.9 10 19C10 20.1 10.9 21 12 21C13.1 21 14 20.1 14 19C14 17.9 13.1 17 12 17ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"></path>
                                        </svg>
                                    </button>

                                    <template #dropdown>
                                        <ul class="divide-y w-36">

                                            <li>
                                                <EditUser :user="user">
                                                    <template #trigger>
                                                        <button  class="p-2  text-xs  flex gap-2 font-medium ">
                                                            <span>Update details</span>
                                                        </button>
                                                    </template>
                                                </EditUser>

                                            </li>
                                            <li>
                                                <prompt-alert @proceed="deleteUser(user.id)"
                                                              title="Are you sure you want to delete this user?"
                                                              description="This action cannot be undone."
                                                >
                                                    <template #trigger>
                                                        <button  class="p-2  text-xs text-red-600">
                                                            <span>Delete user</span>
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
                    <data-pagination :data="users"></data-pagination>
                </div>

            </div>
        </div>
    </section>
</main-layout>
</template>

<style scoped>

</style>
