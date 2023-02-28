<template>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Create Slider
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
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Image
                                    </label>
                                    <file-upload @upload="sliderImage"></file-upload>
                                </div>
                                <span class="text-red-600 ml-4 mt-4">Note: Slide Size 1920px By 800px</span>
                            </div>


                            <button @click="submit" v-text="submitting ? 'Submitting...' : 'Submit'"
                                    class=" button bg-theme-1 text-white mt-5">
                                Submit
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
    data() {
        return {
            data: {
                image: '',
            },
            submitting: false
        }
    },
    methods: {
        sliderImage(files) {
            this.data.image = '';

            for (const file of files)
                this.data.image = file;
        },
        buildFormData: function () {
            const formData = new FormData()
            formData.append('image', this.data.image)
            return formData;
        },
        submit: function () {
            for (let input in this.data) {
                if (this.data[input] === '') {
                    this.$alertify.error(`${input} is required`);
                    return false;
                }
            }
            this.submitting = true
            axios.post('/admin/slider', this.buildFormData())
                .then(() => {
                    this.$alertify.success("Slider Created Successfully!");
                    setTimeout(() => {
                        window.location.href = '/admin/slider';
                    }, 1000)
                })
                .catch(err => {
                    this.submitting = false
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

