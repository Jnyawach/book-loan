<template>
    <div @click="show=true">
        <slot name="trigger"></slot>
    </div>
    <teleport to="body">
        <Transition
            enter-from-class="opacity-0 scale-125"
            enter-to-class="opacity-100 scale-100"
            enter-active-class="transition duration-500"
            leave-active-class="transition duration-500"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-125"
        >
            <div @click.self="show=false" v-if="show" class="inset-0 fixed bg-black bg-opacity-40 z-[100000] grid place-items-center p-5">
                <div class="bg-white lg:w-2/5 w-full rounded-xl">
                    <header class="p-3 font-semibold text-lg">
                        <div class="flex justify-between">

                            <slot name="header">
                                <div class="font-medium text-sumo-300 text-lg">
                                    <h6 class="font-bold">Create a new user</h6>
                                </div>
                            </slot>
                            <div>
                                <div class="text-end">
                                    <button type="button" @click="show=false" :class="'rounded-full bg-sky-800 h-7 w-7 flex place-content-center'">
                                        <svg class="h-5 fill-white self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                            <path d="M312.1 375c9.369 9.369 9.369 24.57 0 33.94s-24.57 9.369-33.94 0L160 289.9l-119 119c-9.369 9.369-24.57 9.369-33.94 0s-9.369-24.57 0-33.94L126.1 256L7.027 136.1c-9.369-9.369-9.369-24.57 0-33.94s24.57-9.369 33.94 0L160 222.1l119-119c9.369-9.369 24.57-9.369 33.94 0s9.369 24.57 0 33.94L193.9 256L312.1 375z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </header>
                    <hr>
                    <div class="p-5">
                        <form @submit.prevent="submit" id="createUser">
                            <div class="my-5 grid  gap-3">
                                <div>
                                    <label for="form-input-name" class="sumo-label">Name:</label>
                                    <input type="text" class="sumo-input my-2" id="form-input-name" placeholder="Enter user name" required v-model="form.name"/>
                                    <div v-if="form.errors.name" class="sumo-error">
                                        <span>{{ form.errors.name }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label for="form-input" class="sumo-label">Email:</label>
                                    <input type="email" class="sumo-input my-2" id="form-input" placeholder="Enter user email" required v-model="form.email"/>
                                    <div v-if="form.errors.email" class="sumo-error">
                                        <span>{{ form.errors.email }}</span>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <hr>
                    <footer class="p-2">
                        <div class="flex justify-end gap-2">
                            <button class="btn-simple" @click="show=false">
                                Cancel
                            </button>

                            <button form="createUser" type="submit" class="btn-primary flex items-center gap-2 justify-center" :disabled="form.processing">
                                <span>Save</span>
                                <svg v-if="form.processing" class="fill-white w-5 animate-spin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M11.9995 2C12.5518 2 12.9995 2.44772 12.9995 3V6C12.9995 6.55228 12.5518 7 11.9995 7C11.4472 7 10.9995 6.55228 10.9995 6V3C10.9995 2.44772 11.4472 2 11.9995 2ZM11.9995 17C12.5518 17 12.9995 17.4477 12.9995 18V21C12.9995 21.5523 12.5518 22 11.9995 22C11.4472 22 10.9995 21.5523 10.9995 21V18C10.9995 17.4477 11.4472 17 11.9995 17ZM20.6597 7C20.9359 7.47829 20.772 8.08988 20.2937 8.36602L17.6956 9.86602C17.2173 10.1422 16.6057 9.97829 16.3296 9.5C16.0535 9.02171 16.2173 8.41012 16.6956 8.13398L19.2937 6.63397C19.772 6.35783 20.3836 6.52171 20.6597 7ZM7.66935 14.5C7.94549 14.9783 7.78161 15.5899 7.30332 15.866L4.70525 17.366C4.22695 17.6422 3.61536 17.4783 3.33922 17C3.06308 16.5217 3.22695 15.9101 3.70525 15.634L6.30332 14.134C6.78161 13.8578 7.3932 14.0217 7.66935 14.5ZM20.6597 17C20.3836 17.4783 19.772 17.6422 19.2937 17.366L16.6956 15.866C16.2173 15.5899 16.0535 14.9783 16.3296 14.5C16.6057 14.0217 17.2173 13.8578 17.6956 14.134L20.2937 15.634C20.772 15.9101 20.9359 16.5217 20.6597 17ZM7.66935 9.5C7.3932 9.97829 6.78161 10.1422 6.30332 9.86602L3.70525 8.36602C3.22695 8.08988 3.06308 7.47829 3.33922 7C3.61536 6.52171 4.22695 6.35783 4.70525 6.63397L7.30332 8.13398C7.78161 8.41012 7.94549 9.02171 7.66935 9.5Z" fill="currentColor"></path>
                                </svg>
                            </button>
                        </div>
                    </footer>
                </div>
            </div>
        </Transition>
    </teleport>
</template>

<script setup lang="ts">
import {ref, watch} from "vue";
import {useForm} from "@inertiajs/vue3";
const show=ref(false)
let props=defineProps({
    user:{
        type:Object as () => {
            name:string
            email:string,
            id:number
        },
        required:true
    }
})

watch(show,(val)=>{
    if(val){
        document.body.style.overflow='hidden'
    }else{
        document.body.style.overflow='auto'
    }
})

let form=useForm({
    name:props.user.name,
    email:props.user.email,
})
const submit=()=>{
    form.patch(`/admin/users/${props.user.id}`, {
        onSuccess:()=>{
            show.value=false
        }
    })
}
</script>

<style scoped>

</style>
