<template>

    <carousel :autoplay="true" :nav="false" :dots="false" :items="1">
        <img class="w-full"
             src="img/depositphotos_19040089-stock-photo-white-lorry-with-trailer-over.jpg">
        <img class="w-full"
             src="img/depositphotos_19040089-stock-photo-white-lorry-with-trailer-over.jpg">
        <img class="w-full"
             src="img/depositphotos_19040089-stock-photo-white-lorry-with-trailer-over.jpg">
    </carousel>
</template>

<script>
import carousel from 'vue-owl-carousel'

export default {
    components: {carousel},
}
</script>
