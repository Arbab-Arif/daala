<template>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Banner
                    </h2>
                </div>
                <div class="p-5" id="form-validation">
                    <div class="preview">
                        <div class="flex flex-wrap -mx-3 mb-2">
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Image
                                </label>
                                <input type="file" name="image" id="image"
                                       class="cols-3 input w-full border mt-2 mb-2 p-1"
                                       minlength="2" @change="bannerImage($event)">
                                <span class="text-red-600">Note: Banner Size 1920px By 300px</span>
                            </div>
                            <img v-for="(image, key) in this.item" class="h-20 w-64 zoom-in" :src="`/storage/${image.image}`">
                        </div>

                        <button @click="update" v-text="updating ? 'Updating...' : 'Update'"
                                class="button bg-theme-1 text-white mt-5">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['item'],
    data() {
        return {
            data: this.item,
            updating: false,
        }
    },
    methods: {
        imgGet(){
            return 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png';
        },
        bannerImage(evt) {
            this.data.image = evt.target.files[0]
        },
        buildFormData: function () {
            const formData = new FormData()
            formData.append('image', this.data.image)
            return formData;
        },
        update: function () {
            for (let input in this.data) {
                if (this.data[input] === '') {
                    this.$alertify.error(`${input} is required`);
                    return false;
                }
            }
            this.updating = true
            axios.post('/admin/banner', this.buildFormData())
                .then(() => {
                    this.$alertify.success('Banner Updated Successfully')
                    setTimeout(() => {
                        window.location.href = '/admin/banner/create';
                    }, 1000)
                })
                .catch(() => {
                    this.updating = false
                    this.$alertify.error('Please Wait! Something Went Wrong')
                });
        }
    }

}
</script>
