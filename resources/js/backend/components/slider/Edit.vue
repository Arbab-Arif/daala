<template>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Edit Slider
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Slider
                        </h2>
                    </div>
                    <div class="p-5" id="form-validation">
                        <div class="preview">

                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/2 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Image
                                    </label>
                                    <file-upload @upload="sliderImage"></file-upload>
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Image
                                    </label>
                                    <img :src="getFullUrl(data.image)" class="img-fluid" alt="Driver Documents"
                                         style="height: 200px;width: 460px;">
                                </div>
                            </div>

                            <button @click="update" v-text="updating ? 'Updating...' : 'Update'"
                                    class="button bg-theme-1 text-white mt-5">
                            </button>
                            <a href="/admin/slider">
                                <button class="button bg-red-600 text-white">Cancel</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FileUpload from '../FileUpload';

export default {
    components: {FileUpload},
    props: ['slider'],
    data() {
        return {
            data: this.slider,
            updating: false

        }
    },
    methods: {
        getFullUrl(src) {
            return `${location.origin}/storage/${src}`;
        },

        sliderImage(files) {
            this.data.image = '';

            for (const file of files)
                this.data.image = file;
        },
        buildFormData: function () {
            const formData = new FormData()
            formData.append('_method', 'PUT')
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
            axios.post(`/admin/slider/${this.slider.id}`, this.buildFormData())
                .then(() => {
                    this.$alertify.success("Category Updated Successfully!");
                    setTimeout(() => {
                        window.location.href = '/admin/slider';
                    }, 1000)
                })
                .catch(err => {
                    this.updating = false
                    if (err.response.status === 422) {
                        let errors = Object.values(err.response.data.errors);
                        for (let error of errors) {
                            this.$alertify.error(error[0]);
                        }
                    }
                })
        }
    }

}
</script>
