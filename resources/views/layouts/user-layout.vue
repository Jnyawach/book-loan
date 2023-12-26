<script setup lang="ts">

import {Link, router} from "@inertiajs/vue3";
const logout=()=>{
    router.post('/auth/logout')
}
</script>

<template>
    <div class=" px-5 py-3 border-b">
        <div class="flex justify-between items-center gap-3">
            <div>
                <Link href="/">
                    <h1 class="text-lg font-bold text-sky-600">BOOK LOAN</h1>
                </Link>
            </div>

            <div v-if="$page.props.auth" class="flex items-center gap-5">
                <div>
                    <Link href="/borrowing" class="text-sky-600 hover:underline">Loaned books</Link>
                </div>
                <el-dropdown  placement="bottom-end">
                    <button class="outline-0 h-8 w-8 border border-sky-600  rounded-full bg-sky-50  flex place-content-center">
                        <svg class="fill-sky-600 self-center h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M4 22C4 17.5817 7.58172 14 12 14C16.4183 14 20 17.5817 20 22H18C18 18.6863 15.3137 16 12 16C8.68629 16 6 18.6863 6 22H4ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11Z"></path>
                        </svg>
                    </button>

                    <template #dropdown>
                        <ul class="w-52 rounded overflow-hidden divide-y text-gray-800 ">
                            <li>
                                <Link href="/profile" class="p-2 py-3 text-xs hover:text-blue-800 flex
                  gap-2 items-center group font-medium dark:hover:text-blue-400">
                                    <svg class="h-4 w-4 fill-sky-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M4 22C4 17.5817 7.58172 14 12 14C16.4183 14 20 17.5817 20 22H18C18 18.6863 15.3137 16 12 16C8.68629 16 6 18.6863 6 22H4ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11Z"></path>
                                    </svg>
                                    <span>Your profile</span>
                                </Link>
                            </li>



                            <li>
                                <button @click="logout" type="submit" class="bg-blue-800 dark:bg-blue-400 hover:bg-blue-900 justify-center
                                text-white text-center w-full px-4 py-2 text-sm flex items-center gap-2">
                                    <svg class="h-4 w-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M416 224H384V128C384 57.406 326.594 0 256 0S128 57.406 128 128V224H96C60.654 224 32 252.652 32 288V448C32 483.346 60.654 512 96 512H416C451.348 512 480 483.346 480 448V288C480 252.652 451.348 224 416 224ZM160 128C160 75.062 203.062 32 256 32S352 75.062 352 128V224H160V128ZM448 448C448 465.645 433.645 480 416 480H96C78.355 480 64 465.645 64 448V288C64 270.355 78.355 256 96 256H416C433.645 256 448 270.355 448 288V448Z"/>
                                    </svg>
                                    Log out
                                </button>
                            </li>

                        </ul>
                    </template>
                </el-dropdown>

            </div>
            <div v-else>
                <Link href="/auth/login" title="Login" class="bg-sky-600 py-2 px-5 rounded-lg border
            border-sky-700 text-white hover:bg-sky-700 duration-300 transition-colors flex gap-2 items-center group">
                    <svg class="h-5 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M20 22H18V20C18 18.3431 16.6569 17 15 17H9C7.34315 17 6 18.3431 6 20V22H4V20C4 17.2386 6.23858 15 9 15H15C17.7614 15 20 17.2386 20 20V22ZM12 13C8.68629 13 6 10.3137 6 7C6 3.68629 8.68629 1 12 1C15.3137 1 18 3.68629 18 7C18 10.3137 15.3137 13 12 13ZM12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"></path>
                    </svg>
                    <span> Login</span>
                </Link>
            </div>
        </div>
    </div>
    <section>
        <slot></slot>
    </section>
</template>

<style scoped>

</style>
