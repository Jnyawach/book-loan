<script setup lang="ts">

import {Link,useForm} from "@inertiajs/vue3";
import Toast from "@/views/components/toast.vue"

let form=useForm({
})
const logout=()=>{
    form.post('/auth/logout',{
        onSuccess:()=>{
        }
    })
}
</script>

<template>
    <Teleport to="body">
        <Toast :toast="$page.props.toast"></Toast>
    </Teleport>
    <div class="sm:hidden flex justify-between gap-2 z-[100000] p-2 w-full bg-white shadow">
        <div>
            <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button">
                <svg class="fill-sky-700 h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M424 392H23.1C10.8 392 0 402.8 0 415.1C0 429.2 10.8 440 23.1 440H424c13.2 0 24-10.8 24-23.1C448 402.8 437.2 392 424 392zM424 72H23.1C10.8 72 0 82.8 0 95.1S10.8 120 23.1 120H424c13.2 0 24-10.8 24-23.1S437.2 72 424 72zM424 232H23.1C10.8 232 0 242.8 0 256c0 13.2 10.8 24 23.1 24H424C437.2 280 448 269.2 448 256S437.2 232 424 232z"/>
                </svg>
            </button>
        </div>

        <div>
            <button class="flex gap-2 items-center"  data-dropdown-toggle="dropdownMenu">
                <span class="font-bold">{{$page.props.auth.name}}</span>
                <img :src="'/images/user-icon.png'" alt="Profile picture" class="h-10 rounded-full">
            </button>


            <!-- Dropdown menu -->
            <div id="dropdownMenu" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 divide-y" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <Link href="#" class="block px-4 py-2 hover:bg-gray-100">
                            Profile
                        </Link>
                    </li>
                    <li>
                        <button @click="logout" class="block px-4 py-2 hover:bg-gray-100">
                            Logout
                        </button>
                    </li>


                </ul>
            </div>
        </div>

    </div>



    <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-white shadow-r-lg border-r" aria-label="Sidebar">
        <div class="h-full px-5 py-4 overflow-y-auto bg-white">
            <div class="my-3">
                    <h1 class="font-bold text-lg ">BOOK LOAN</h1>
            </div>
            <div class="my-5 bg-sky-50 rounded-xl p-2 ">
                <div class="flex gap-2 items-center border-b py-3 border-gray-300">
                    <div>
                        <img alt="User profile" :src="'/images/user-icon.png'" class="h-11 rounded-full">
                    </div>
                    <div>
                        <h6 class="font-bold text-sm">{{$page.props.auth.name}}</h6>
                        <Link href="#" class="text-sky-700 text-sm">Edit profile</Link>
                    </div>
                </div>
                <div class="py-3">
                    <h6 class="text-gray-600 font-medium text-sm">Role</h6>
                    <h2 class="text-xl font-bold text-sky-700">{{$page.props.auth.role}}</h2>
                </div>
            </div>
            <ul class="space-y-2 font-medium pt-3 min-h-[45vh] border-b border-gray-300 text-sm">
                <li>
                    <Link href="/admin" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-sky-700  hover:bg-gray-100 group"
                          :class="{ 'bg-gray-100 text-sky-700': $page.component === 'admin/index' }"
                    >
                        <svg class="h-5 fill-gray-900 group-hover:fill-sky-700" :class="{ 'fill-sky-700': $page.component === 'admin/index' }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M488 392H251.9C241.7 359.6 211.8 336 176 336s-65.69 23.62-75.93 56H24C10.75 392 0 402.7 0 416s10.75 24 24 24h76.07C110.3 472.4 140.2 496 176 496s65.69-23.62 75.93-56H488c13.25 0 24-10.75 24-24S501.3 392 488 392zM176 448c-17.64 0-32-14.36-32-32s14.36-32 32-32s32 14.36 32 32S193.6 448 176 448zM488 232h-76.07C401.7 199.6 371.8 176 336 176s-65.69 23.62-75.93 56H24C10.75 232 0 242.7 0 256s10.75 24 24 24h236.1C270.3 312.4 300.2 336 336 336s65.69-23.62 75.93-56H488C501.3 280 512 269.3 512 256S501.3 232 488 232zM336 288c-17.64 0-32-14.36-32-32s14.36-32 32-32s32 14.36 32 32S353.6 288 336 288zM24 120h108.1C142.3 152.4 172.2 176 208 176s65.69-23.62 75.93-56H488C501.3 120 512 109.3 512 96s-10.75-24-24-24h-204.1C273.7 39.62 243.8 16 208 16S142.3 39.62 132.1 72H24C10.75 72 0 82.75 0 96S10.75 120 24 120zM208 64c17.64 0 32 14.36 32 32s-14.36 32-32 32s-32-14.36-32-32S190.4 64 208 64z"/>
                        </svg>
                        <span class="ml-3">Dashboard</span>
                    </Link>
                </li>

                <li>
                    <Link href="/admin/books" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-sky-700  hover:bg-gray-100 group"
                          :class="{ 'bg-gray-100 text-sky-700': $page.component === 'admin/books/index' }"
                    >
                        <svg class="h-5 fill-gray-900 group-hover:fill-sky-700" :class="{ 'fill-sky-700': $page.component === '/admin/books/index' }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                           <path d="M510.354 435.363L402.686 35.422C396.939 14.078 377.547 0 356.354 0C352.242 0 348.059 0.531 343.896 1.641L282.078 18.125C276.193 19.695 270.939 22.383 266.295 25.758C258.254 10.508 242.436 0 224 0H160C151.213 0 143.084 2.531 136 6.656C128.916 2.531 120.787 0 112 0H48C21.49 0 0 21.492 0 48V464C0 490.508 21.49 512 48 512H112C120.787 512 128.916 509.469 136 505.344C143.084 509.469 151.213 512 160 512H224C250.51 512 272 490.508 272 464V165.281L355.805 476.578C361.553 497.926 380.945 512 402.139 512C406.25 512 410.432 511.469 414.594 510.359L476.412 493.875C502.018 487.043 517.215 460.848 510.354 435.363ZM224 48V96H160V48H224ZM160 144H224V368H160V144ZM112 368H48V144H112V368ZM112 48V96H48V48H112ZM48 464V416H112V464H48ZM160 464V416H224V464H160ZM294.445 64.504L356.271 48.02L356.361 48L368.742 93.93L306.828 110.445L294.445 64.504ZM319.266 156.586L381.18 140.074L439.223 355.41L377.309 371.922L319.266 156.586ZM402.154 464.102L389.746 418.066L451.66 401.555L464.045 447.496L402.154 464.102Z"/>
                        </svg>
                        <span class="ml-3">Books</span>
                    </Link>
                </li>

                <li>
                    <Link href="/admin/users" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-sky-700  hover:bg-gray-100 group"
                          :class="{ 'bg-gray-100 text-sky-700': $page.component === 'admin/users/index' }"
                    >

                        <svg class="h-5 fill-gray-900 group-hover:fill-sky-700" :class="{ 'fill-sky-700': $page.component === 'admin/users/index' }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M2 22C2 17.5817 5.58172 14 10 14C14.4183 14 18 17.5817 18 22H16C16 18.6863 13.3137 16 10 16C6.68629 16 4 18.6863 4 22H2ZM10 13C6.685 13 4 10.315 4 7C4 3.685 6.685 1 10 1C13.315 1 16 3.685 16 7C16 10.315 13.315 13 10 13ZM10 11C12.21 11 14 9.21 14 7C14 4.79 12.21 3 10 3C7.79 3 6 4.79 6 7C6 9.21 7.79 11 10 11ZM18.2837 14.7028C21.0644 15.9561 23 18.752 23 22H21C21 19.564 19.5483 17.4671 17.4628 16.5271L18.2837 14.7028ZM17.5962 3.41321C19.5944 4.23703 21 6.20361 21 8.5C21 11.3702 18.8042 13.7252 16 13.9776V11.9646C17.6967 11.7222 19 10.264 19 8.5C19 7.11935 18.2016 5.92603 17.041 5.35635L17.5962 3.41321Z" fill="currentColor"></path>
                        </svg>
                        <span class="ml-3">Users</span>
                    </Link>
                </li>

                <li>
                    <Link href="/admin/loans" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-sky-700  hover:bg-gray-100 group"
                          :class="{ 'bg-gray-100 text-sky-700': $page.component === 'admin/loans/index' }"
                    >
                        <svg class="h-5 fill-gray-900 group-hover:fill-sky-700" :class="{ 'fill-sky-700': $page.component === 'admin/loans/index' }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                           <path d="M384 64H344V24C344 10.75 333.25 0 320 0S296 10.75 296 24V64H152V24C152 10.75 141.25 0 128 0S104 10.75 104 24V64H64C28.654 64 0 92.652 0 128V448C0 483.348 28.654 512 64 512H384C419.346 512 448 483.348 448 448V128C448 92.652 419.346 64 384 64ZM400 448C400 456.824 392.822 464 384 464H64C55.178 464 48 456.824 48 448V192H400V448ZM112 384H208C216.75 384 224 376.75 224 368V272C224 263.25 216.75 256 208 256H112C103.25 256 96 263.25 96 272V368C96 376.75 103.25 384 112 384Z"/>
                        </svg>
                        <span class="ml-3">Loans</span>
                    </Link>
                </li>

                <li>
                    <Link href="/admin/loans/penalties" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-sky-700  hover:bg-gray-100 group"
                          :class="{ 'bg-gray-100 text-sky-700': $page.component === 'admin/loans/penalty' }"
                    >

                        <svg class="h-5 fill-gray-900 group-hover:fill-sky-700" :class="{ 'fill-sky-700': $page.component === 'admin/loans/penalty' }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                         <path d="M512 64H64C28.654 64 0 92.652 0 128V384C0 419.346 28.654 448 64 448H512C547.348 448 576 419.346 576 384V128C576 92.652 547.348 64 512 64ZM528 336C492.625 336 464 364.625 464 400H112C112 364.625 83.375 336 48 336V176C83.375 176 112 147.375 112 112H464C464 147.375 492.625 176 528 176V336ZM368 256C368 309.018 332.184 352 288 352S208 309.018 208 256C208 202.98 243.816 160 288 160S368 202.98 368 256Z"/>
                        </svg>
                        <span class="ml-3">Penalties</span>
                    </Link>
                </li>






            </ul>
            <div class="my-5">
                <ul class="space-y-2 font-medium pt-3 text-sm">
                    <li>
                        <Link href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-sky-700  hover:bg-gray-100 group">
                            <svg class="h-5 fill-gray-900 group-hover:fill-sky-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M504.1 315.1c0-8.652-4.607-16.84-12.36-21.39l-32.91-18.97C459.5 269.1 459.8 262.5 459.8 256s-.3228-13.1-.9683-19.62l32.91-18.97c7.752-4.548 12.36-12.74 12.36-21.39c0-21.27-49.32-128.2-84.52-128.2c-4.244 0-8.51 1.094-12.37 3.357l-32.78 18.97c-10.71-7.742-22.07-14.32-34.07-19.74V32.49c0-11.23-7.484-21.04-18.33-23.88C300.5 2.871 278.3 0 256 0C233.8 0 211.5 2.871 189.9 8.613C179.1 11.45 171.6 21.26 171.6 32.49v37.94c-12 5.42-23.36 12-34.07 19.74l-32.78-18.97C100.9 68.94 96.63 67.85 92.38 67.85c-.0025 0 .0025 0 0 0c-32.46 0-84.52 101.7-84.52 128.2c0 8.652 4.607 16.84 12.36 21.39l32.91 18.97C52.49 242.9 52.17 249.5 52.17 256s.3228 13.1 .9683 19.62L20.23 294.6C12.47 299.1 7.867 307.3 7.867 315.1c0 21.27 49.32 128.2 84.52 128.2c4.244 0 8.51-1.094 12.37-3.357l32.78-18.97c10.71 7.742 22.07 14.32 34.07 19.74v37.94c0 11.23 7.484 21.04 18.33 23.88C211.5 509.1 233.7 512 255.1 512c22.25 0 44.47-2.871 66.08-8.613c10.84-2.84 18.33-12.65 18.33-23.88v-37.94c12-5.42 23.36-12 34.07-19.74l32.78 18.97c3.855 2.264 8.123 3.357 12.37 3.357C452.1 444.2 504.1 342.4 504.1 315.1zM415.2 389.1l-43.66-25.26c-42.06 30.39-32.33 24.73-79.17 45.89v50.24c-13.29 2.341-25.58 3.18-36.44 3.18c-15.42 0-27.95-1.693-36.36-3.176v-50.24c-46.95-21.21-37.18-15.54-79.17-45.89l-43.64 25.25c-15.74-18.69-28.07-40.05-36.41-63.11L103.1 301.7C101.4 276.1 100.1 266.1 100.1 256c0-10.02 1.268-20.08 3.81-45.76L60.37 185.2C68.69 162.1 81.05 140.7 96.77 122l43.66 25.26c42.06-30.39 32.33-24.73 79.17-45.89V51.18c13.29-2.341 25.58-3.18 36.44-3.18c15.42 0 27.95 1.693 36.36 3.176v50.24c46.95 21.21 37.18 15.54 79.17 45.89l43.64-25.25c15.74 18.69 28.07 40.05 36.4 63.11L408 210.3c2.538 25.64 3.81 35.64 3.81 45.68c0 10.02-1.268 20.08-3.81 45.76l43.58 25.12C443.3 349.9 430.9 371.3 415.2 389.1zM256 159.1c-52.88 0-96 43.13-96 96S203.1 351.1 256 351.1s96-43.13 96-96S308.9 159.1 256 159.1zM256 304C229.5 304 208 282.5 208 256S229.5 208 256 208s48 21.53 48 48S282.5 304 256 304z"/>
                            </svg>

                            <span class="ml-3">Account Settings</span>
                        </Link>
                    </li>

                    <li>
                        <button @click="logout()" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-sky-700  hover:bg-gray-100 group">

                            <svg class="h-5 fill-gray-900 group-hover:fill-sky-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M312 336c6.156 0 12.28-2.344 16.97-7.031c9.375-9.375 9.375-24.56 0-33.94L81.94 48H192c13.25 0 24-10.75 24-24S205.3 0 192 0H24C10.75 0 0 10.75 0 24V192c0 13.25 10.75 24 24 24S48 205.3 48 192V81.94l247 247C299.7 333.7 305.8 336 312 336zM288 64c-13.25 0-24 10.75-24 24S274.8 112 288 112c97.03 0 176 78.97 176 176s-78.97 176-176 176S112 385 112 288c0-13.25-10.75-24-24-24S64 274.8 64 288c0 123.5 100.5 224 224 224s224-100.5 224-224S411.5 64 288 64z"/>
                            </svg>

                            <span class="ml-3">Logout</span>
                        </button>
                    </li>

                </ul>
            </div>
        </div>
    </aside>

    <div class="p-4 sm:ml-64 bg-gray-50">
        <div class="hidden sm:block">
            <div class="flex justify-between">
                <div class="flex gap-3 items-center">
                    <img alt="Profile Picture" :src="'/images/user-icon.png'" class="h-12 rounded-full border border-white">
                    <h1 class="text-lg font-bold">Hello {{$page.props.auth.name}}, Welcome!</h1>
                </div>
                <div class="flex gap-2 items-center">
                    <div>
                        <button class="rounded-full h-10 w-10 bg-white flex
                items-center place-content-center border">

                            <svg class="h-5 fill-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M439.4 362.3C420.1 341.5 383.9 310.2 383.9 208c0-77.75-54.38-139.9-127.9-155.1V32c0-17.62-14.38-32-32-32S192 14.38 192 32v20.88C118.5 68.12 64.13 130.2 64.13 208c0 102.2-36.25 133.5-55.5 154.3C2.625 368.8 0 376.5 0 384c.125 16.38 13 32 32.13 32h383.8c19.12 0 32-15.62 32.13-32C448 376.5 445.4 368.8 439.4 362.3zM67.5 368C88.75 340 112 293.6 112 208.6V208C112 146.1 162.1 96 224 96s112 50.12 112 112v.625C336 293.6 359.2 340 380.5 368H67.5zM223.1 512C259.4 512 288 483.4 288 448H160C160 483.4 188.6 512 223.1 512z"/>
                            </svg>
                        </button>
                    </div>
                    <div>

                        <button class="btn-primary btn-medium" @click="logout">
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-8">
            <slot></slot>
        </div>

    </div>

</template>

<style scoped>

</style>
