<template>
    <carousel :autoplay="true" :nav="false" :dots="false" :items="1">
        <div v-for="n of [1,2,3]" class="flex flex-col md:flex-row mb-4 mx-auto">
            <div class="w-full md:w-1/4">
                <img
                    class="mx-auto rounded-full" style="width: 10rem !important;"
                    src="https://demos.creative-tim.com/tailwindcss-starter-project/_next/static/images/team-1-800x800-fa5a7ac2c81a43925586ea85f2fea332.jpg"
                    alt="Diesan Romero avatar picture."
                />
                <h2 class="my-3 text-center text-gray-900">Name Here</h2>
            </div>
            <div class="flex flex-col my-auto">
                <div class="w-full text-center">
                    <i class="text-3xl fas fa-star" v-for="nn of [1,1,1,1,1]"></i>
                </div>
                <div class="w-full text-center md:text-left text-lg">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </div>
            </div>
        </div>
    </carousel>
</template>

<script>
import carousel from 'vue-owl-carousel'

export default {
    components: {carousel},
}
</script>
