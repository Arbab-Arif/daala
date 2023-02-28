<template>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Setting
                    </h2>
                </div>
                <div class="p-5" id="form-validation">
                    <div class="preview">
                        <div class="flex flex-wrap -mx-3 mb-2">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Company Logo
                                </label>
                                <file-upload @upload="imagesAdd"></file-upload>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-2">
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Google
                                    Add support
                                </label>
                                <input type="text" name="name" class="cols-3 input w-full border mt-2"
                                       placeholder="Please Enter Your Google Add Support" minlength="2"
                                       v-model="data.google_add">
                            </div>
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Facebook Pixel
                                </label>
                                <input type="text" name="name" class="cols-3 input w-full border mt-2"
                                       placeholder="Please Enter Your Facebook Pixel" minlength="2"
                                       v-model="data.facebook">
                            </div>
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Sender
                                    Email
                                </label>
                                <input type="email" name="name" class="cols-3 input w-full border mt-2"
                                       placeholder="Enter Sender Email" minlength="2" v-model="data.email">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-2">
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Company Name
                                </label>
                                <input type="text" name="name" class="cols-3 input w-full border mt-2"
                                       placeholder="Please Enter Your Company Name " minlength="2"
                                       v-model="data.company_name">
                            </div>
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Company Address
                                </label>
                                <input type="text" name="name" class="cols-3 input w-full border mt-2"
                                       placeholder="Please Enter Your Address " minlength="2" v-model="data.address">
                            </div>
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Company Contact No
                                </label>
                                <input type="text" name="name" class="cols-3 input w-full border mt-2"
                                       placeholder="Please Enter Your Address " minlength="2" v-model="data.contact_no">
                            </div>
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Labour Charges
                                </label>
                                <input type="number" name="name" class="cols-3 input w-full border mt-2"
                                       placeholder="Please Enter Your Labour Charges" minlength="2" v-model="data.labour_charges">
                            </div>
                        </div>
                        <button @click="updateSettings" class="button bg-theme-1 text-white mt-5">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FileUpload from './FileUpload';
export default {
    components: {FileUpload},
    props: ['setting'],
    data() {
        return {
            data: this.setting,
            logo: [],
        }
    },
    methods: {
        imagesAdd(files) {

            this.data.logo = '';

            for (const file of files)
                this.data.logo = file;
        },
        buildFormData: function () {
            const formData = new FormData();
            for (const key in this.data) {
                formData.append(key, this.data[key]);
            }
            return formData;
        },
        updateSettings: function () {
            let url = "/admin/setting";
            axios.post(url, this.buildFormData())
                .then(() => {
                    this.$alertify.success('Settings Updated Successfully')
                })
                .catch(() => {
                    this.$alertify.error('Please Wait! Something Went Wrong')
                });
        }
    }

}
</script>

<style>
.content {
    min-height: 100px!important;
}
</style>
