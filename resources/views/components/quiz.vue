<script setup lang="ts">
import {ref} from "vue";
import {useStorage} from "@vueuse/core";
let props=defineProps({
    question:Object,
    index:Number
})

const rating=ref()


const answers=useStorage('answers',[])
const currentQuiz=useStorage('currentQuiz',0)
const submitReview=(review:number)=>{
  const quiz={
      quiz_id:props.question?.id,
      value:review
  }
    answers.value.push(quiz)
    currentQuiz.value= currentQuiz.value+1;
}
</script>

<template>
<div class="p-3" v-if="index===currentQuiz">
    <h2 class="text-2xl ">Quiz {{index+1}} of 3 : {{question.quiz}}</h2>
    <div class="my-8 flex justify-center ">
     <div class="flex justify-center gap-5 items-center">
         <div class="group cursor-pointer" @click="submitReview(1)">
             <img class="mx-auto group-hover:scale-125 hover:scale-125 transition-all duration-300 cursor-pointer h-10 w-10" src="https://img.icons8.com/emoji/48/000000/angry-face-emoji--v2.png" alt="Hungry face"/>
             <h6 class="text-lg my-2 group-hover:text-sky-600">Very dissatisfied</h6>
         </div>
         <div class="group cursor-pointer" @click="submitReview(2)">
             <img class="mx-auto group-hover:scale-125 hover:scale-125 transition-all duration-300 cursor-pointer h-10 w-10" src="https://img.icons8.com/fluent/48/000000/sad.png" alt="Sad face"/>
             <h6 class="text-lg my-2 group-hover:text-sky-600">Dissatisfied</h6>
         </div>
         <div class="group cursor-pointer" @click="submitReview(3)">
             <img class="mx-auto group-hover:scale-125 hover:scale-125 transition-all duration-300 cursor-pointer h-10 w-10" src="https://img.icons8.com/color/48/000000/happy.png" alt="Happy face"/>
             <h6 class="text-lg my-2 group-hover:text-sky-600">Neutral</h6>
         </div>
         <div class="group cursor-pointer" @click="submitReview(4)">
             <img class="mx-auto group-hover:scale-125 hover:scale-125 transition-all duration-300 cursor-pointer h-10 w-10" src="https://img.icons8.com/emoji/48/000000/smiling-face.png" alt="Smiling face"/>
             <h6 class="text-lg my-2 group-hover:text-sky-600">Satisfied</h6>
         </div>
         <div class="group cursor-pointer" @click="submitReview(5)">
             <img class="mx-auto group-hover:scale-125 hover:scale-125 transition-all duration-300 cursor-pointer h-10 w-10" src="https://img.icons8.com/color/48/000000/lol.png" alt="Lots of love face"/>
             <h6 class="text-lg my-2 group-hover:text-sky-600">Very satisfied</h6>
         </div>
     </div>
    </div>
</div>
</template>

<style scoped>

</style>
