<script setup lang="ts">
import {useForm, Link, Head} from "@inertiajs/vue3";


let form=useForm({
    email:'',
    password:''
})
</script>

<template>
    <Head>
        <title>Login</title>
    </Head>
    <section>
        <div class="h-screen flex place-content-center p-3">
            <div class="self-center border rounded-xl p-3 md:p-8 w-full md:w-3/5 lg:w-2/5 overflow-hidden bg-white shadow-xl">
                <h1 class="text-center font-bold text-xl text-sky-600">BOOK LOAN</h1>
                <h2 class="my-5 font-medium text-center">Login to proceed</h2>
                <div class="my-5">
                    <form @submit.prevent="form.post('/auth/authenticate')">
                        <div class="my-5 grid">
                            <label for="form-input" class="sumo-label">Email:</label>
                            <input type="email" class="sumo-input my-2" id="form-input" placeholder="Enter your email" required v-model="form.email"/>
                            <div v-if="form.errors.email" class="sumo-error">
                                <span>{{ form.errors.email }}</span>
                            </div>
                        </div>

                        <div class="my-5 grid">
                            <label for="form-password" class="sumo-label">Password:</label>
                            <input type="password" class="sumo-input my-2" id="form-password" placeholder="Enter your password" required v-model="form.password"/>
                            <div v-if="form.errors.password" class="sumo-error">
                                <span>{{ form.errors.password }}</span>
                            </div>
                        </div>

                        <div class="my-5 grid gap-3 md:flex justify-center md:justify-between items-center">
                            <div class="order-2 md:order-1 text-center md:text-start ">
                                <Link href="#" class="hover:text-sky-700">Forgot password</Link>
                            </div>
                            <div class="order-1 md:order-2">
                                <button :disabled="form.processing" type="submit" class="btn-primary w-44 flex items-center gap-2 justify-center">
                                    <span>Login</span>

                                    <svg v-if="form.processing" class="fill-white w-5 animate-spin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M11.9995 2C12.5518 2 12.9995 2.44772 12.9995 3V6C12.9995 6.55228 12.5518 7 11.9995 7C11.4472 7 10.9995 6.55228 10.9995 6V3C10.9995 2.44772 11.4472 2 11.9995 2ZM11.9995 17C12.5518 17 12.9995 17.4477 12.9995 18V21C12.9995 21.5523 12.5518 22 11.9995 22C11.4472 22 10.9995 21.5523 10.9995 21V18C10.9995 17.4477 11.4472 17 11.9995 17ZM20.6597 7C20.9359 7.47829 20.772 8.08988 20.2937 8.36602L17.6956 9.86602C17.2173 10.1422 16.6057 9.97829 16.3296 9.5C16.0535 9.02171 16.2173 8.41012 16.6956 8.13398L19.2937 6.63397C19.772 6.35783 20.3836 6.52171 20.6597 7ZM7.66935 14.5C7.94549 14.9783 7.78161 15.5899 7.30332 15.866L4.70525 17.366C4.22695 17.6422 3.61536 17.4783 3.33922 17C3.06308 16.5217 3.22695 15.9101 3.70525 15.634L6.30332 14.134C6.78161 13.8578 7.3932 14.0217 7.66935 14.5ZM20.6597 17C20.3836 17.4783 19.772 17.6422 19.2937 17.366L16.6956 15.866C16.2173 15.5899 16.0535 14.9783 16.3296 14.5C16.6057 14.0217 17.2173 13.8578 17.6956 14.134L20.2937 15.634C20.772 15.9101 20.9359 16.5217 20.6597 17ZM7.66935 9.5C7.3932 9.97829 6.78161 10.1422 6.30332 9.86602L3.70525 8.36602C3.22695 8.08988 3.06308 7.47829 3.33922 7C3.61536 6.52171 4.22695 6.35783 4.70525 6.63397L7.30332 8.13398C7.78161 8.41012 7.94549 9.02171 7.66935 9.5Z" fill="currentColor"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="pt-8 text-center">
                            <Link class="text-center hover:text-sky-700 underline" href="/auth/register">Create new account</Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
