<template>
    <ReaderLayout>
   
        <div class="container mx-auto p-10 ">
            <div class="flex justify-center items-center h-screen gap-5" >
                 
                <a href="/login" class="mx-2 rounded-md"><button class="px-3 py-2 bg-purple-500 rounded-md"> Login</button></a>
                <a href="/register" class="mx-2 rounded-md"><button class="px-3 py-2 bg-purple-500 rounded-md"> Register</button></a>
                <a href="/admin/dashboard" class="mx-2 rounded-md"><button class="px-3 py-2 bg-purple-500 rounded-md"> Dashboard</button></a>
            </div>
        </div>
          
    </ReaderLayout>
</template>


<script setup>
 
import ReaderLayout from "@/Layouts/ReaderLayout.vue";
 
</script>
