<script setup lang="ts">
import {Link, Head, useForm} from "@inertiajs/vue3";
import Quiz from "@/views/components/quiz.vue";
import {useStorage} from "@vueuse/core";
defineProps({
    quizzes:Object
})
const currentQuiz=useStorage('currentQuiz',0)
const answers=useStorage('answers',[])
let  form=useForm({
    name:'',
    email:'',
    phone:'',
    answers:[]
})

const saveResponse=()=>{
    form.answers=answers.value
    form.post('/answers/save',{
        onSuccess:()=>{
            currentQuiz.value=4;
            localStorage.removeItem('answers')
        }
    })
}
</script>

<template>
    <Head>
        <title>Company X</title>
    </Head>
<div class="bg-gray-50 px-5 py-8 border-b shadow">
    <div class="flex justify-between items-center gap-3">
        <div>
            <h1 class="text-lg font-bold text-sky-600">COMPANY X</h1>
        </div>
        <div>
            <Link href="dashboard" title="Login" class="bg-sky-600 py-2 px-5 rounded-lg border
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
        <div class="mx-auto max-w-[1280px] my-10 md:px-14 px-3">
            <div>
                <h1 class="text-2xl font-bold text-center text-sky-600">This is a marketing Survey. No personal data will be stored</h1>
            <div class="my-8 text-center flex justify-center ">
                <div v-if="currentQuiz===3" class="w-1/2">
                    <form @submit.prevent="saveResponse">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="grid text-start my-3">
                                <label for="your_name" class="text-sm">Your name: </label>
                                <input id="your_name" v-model="form.name" type="text" placeholder="e.g. John Doe"
                                       class="p-2 text-sm w-full rounded-xl h-10 border my-2 focus:border-sky-700 focus:outline-sky-600 bg-white">
                                <div v-if="form.errors.name" class="creative-error">
                                    <span>{{ form.errors.name}}</span>
                                </div>
                            </div>
                            <div class="grid text-start my-3">
                                <label for="your_email" class="text-sm">Your email: </label>
                                <input id="your_email" v-model="form.email" type="text" placeholder="e.g. johndoe@gmail.com"
                                       class="p-2 text-sm w-full rounded-xl h-10 border my-2 focus:border-sky-700 focus:outline-sky-600 bg-white">
                                <div v-if="form.errors.name" class="creative-error">
                                    <span>{{ form.errors.name}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="grid text-start my-3">
                            <label for="your_cellphone" class="text-sm">Your cellphone: </label>
                            <input id="your_cellphone" v-model="form.phone" type="text" placeholder="e.g. +25472000000"
                                   class="p-2 text-sm w-full rounded-xl h-10 border my-2 focus:border-sky-700 focus:outline-sky-600 bg-white">
                            <div v-if="form.errors.name" class="creative-error">
                                <span>{{ form.errors.name}}</span>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" :disabled="form.processing" :class="[form.processing?'cursor-not-allowed':'']" class="bg-sky-600 py-2 px-5 rounded-lg border
                             border-sky-700 text-white hover:bg-sky-700 duration-300 transition-colors flex gap-2 justify-center items-center group">
                                <span>Submit response</span>
                                <svg v-if="form.processing" class="fill-white h-5 animate-spin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M12 2C12.5523 2 13 2.44772 13 3V6C13 6.55228 12.5523 7 12 7C11.4477 7 11 6.55228 11 6V3C11 2.44772 11.4477 2 12 2ZM12 17C12.5523 17 13 17.4477 13 18V21C13 21.5523 12.5523 22 12 22C11.4477 22 11 21.5523 11 21V18C11 17.4477 11.4477 17 12 17ZM22 12C22 12.5523 21.5523 13 21 13H18C17.4477 13 17 12.5523 17 12C17 11.4477 17.4477 11 18 11H21C21.5523 11 22 11.4477 22 12ZM7 12C7 12.5523 6.55228 13 6 13H3C2.44772 13 2 12.5523 2 12C2 11.4477 2.44772 11 3 11H6C6.55228 11 7 11.4477 7 12ZM19.0711 19.0711C18.6805 19.4616 18.0474 19.4616 17.6569 19.0711L15.5355 16.9497C15.145 16.5592 15.145 15.9261 15.5355 15.5355C15.9261 15.145 16.5592 15.145 16.9497 15.5355L19.0711 17.6569C19.4616 18.0474 19.4616 18.6805 19.0711 19.0711ZM8.46447 8.46447C8.07394 8.85499 7.44078 8.85499 7.05025 8.46447L4.92893 6.34315C4.53841 5.95262 4.53841 5.31946 4.92893 4.92893C5.31946 4.53841 5.95262 4.53841 6.34315 4.92893L8.46447 7.05025C8.85499 7.44078 8.85499 8.07394 8.46447 8.46447ZM4.92893 19.0711C4.53841 18.6805 4.53841 18.0474 4.92893 17.6569L7.05025 15.5355C7.44078 15.145 8.07394 15.145 8.46447 15.5355C8.85499 15.9261 8.85499 16.5592 8.46447 16.9497L6.34315 19.0711C5.95262 19.4616 5.31946 19.4616 4.92893 19.0711ZM15.5355 8.46447C15.145 8.07394 15.145 7.44078 15.5355 7.05025L17.6569 4.92893C18.0474 4.53841 18.6805 4.53841 19.0711 4.92893C19.4616 5.31946 19.4616 5.95262 19.0711 6.34315L16.9497 8.46447C16.5592 8.85499 15.9261 8.85499 15.5355 8.46447Z"></path>
                                </svg>
                            </button>
                        </div>
                    </form>

                </div>
                <div v-else-if="currentQuiz===4">
                   <div class="py-3 text-center">
                       <img class="mx-auto group-hover:scale-125 hover:scale-125 transition-all duration-300 cursor-pointer h-10 w-10" src="https://img.icons8.com/color/48/000000/lol.png" alt="Lots of love face"/>
                       <h2 class="text-2xl my-2">Thank you for your feedback!</h2>
                   </div>
                </div>
                <div v-else v-for="(quiz,index) in quizzes" :key="quiz.id">
                    <quiz :question="quiz" :index="index"></quiz>
                </div>
            </div>
            </div>

        </div>
    </section>
</template>

<style scoped>

</style>
