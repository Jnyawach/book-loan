<template>
    <div>
        <div class="flex justify-between bg-sky-50 py-3 px-2 ">
            <div class="self-center">
                <h6 class="font-semibold text-sm">Page {{ current_page }} of {{ last_page }}</h6>
            </div>
            <div class="flex gap-1">
                <Link v-if="data.links.prev" :href="data.links.prev" class="btn-secondary-outline btn-medium flex gap-2 items-center group">
                    <svg class="h-4 fill-sky-600 group-hover:fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                        <path d="M166.5 424.5l-143.1-152c-4.375-4.625-6.562-10.56-6.562-16.5c0-5.938 2.188-11.88 6.562-16.5l143.1-152c9.125-9.625 24.31-10.03 33.93-.9375c9.688 9.125 10.03 24.38 .9375 33.94l-128.4 135.5l128.4 135.5c9.094 9.562 8.75 24.75-.9375 33.94C190.9 434.5 175.7 434.1 166.5 424.5z"/>
                    </svg>
                    <span>Prev</span>
                </Link>
                <Link v-if="data.links.next" :href="data.links.next" class="btn-secondary-outline btn-medium flex gap-2 items-center group">
                    <span>Next</span>
                    <svg class="h-4 fill-sky-600 group-hover:fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                        <path d="M89.45 87.5l143.1 152c4.375 4.625 6.562 10.56 6.562 16.5c0 5.937-2.188 11.87-6.562 16.5l-143.1 152C80.33 434.1 65.14 434.5 55.52 425.4c-9.688-9.125-10.03-24.38-.9375-33.94l128.4-135.5l-128.4-135.5C45.49 110.9 45.83 95.75 55.52 86.56C65.14 77.47 80.33 77.87 89.45 87.5z"/>
                    </svg>
                </Link>

            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
let props = defineProps({
    data:Object
})
let current_page = props.data?.current_page?props.data.current_page:props.data?.meta.current_page
let last_page = props.data?.last_page?props.data.last_page:props.data?.meta.last_page
</script>

<style scoped>

</style>
