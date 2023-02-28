<template>
    <modal class="center" name="vehicle-category-add" height="auto">
        <div class="" id="header-footer-modal-preview"
             style="margin-top: 0px; margin-left: 0px; padding-left: 0px; z-index: 53;">
            <div class="modal__content">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base-center mr-auto text-center">
                        Add Vehicle Category
                    </h2>
                </div>
                <div class="p-5 pb-2 grid grid-cols-12 gap-4 row-gap-3">
                    <div class="col-span-12 sm:col-span-12">
                        <label>Vehicle Category Name</label>
                        <input type="text" class="input w-full border mt-2 flex-1" name="name" id="name" v-model="data.name">
                    </div>
                </div>
            <div class="p-5 pt-2 grid grid-cols-12 gap-4 row-gap-3">
                    <div class="col-span-12 sm:col-span-12">
                        <label>App Label</label>
                        <input type="text" class="input w-full border mt-2 flex-1" name="app_level" id="app_level" v-model="data.app_level">
                    </div>

                </div>
                <div class="w-full px-3 mb-6 mt-4 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Image
                    </label>
                    <file-upload @upload="fileSelected"></file-upload>
                </div>
                <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                    <button @click="submit" class="button w-20 bg-theme-1 text-white">Submit</button>
                    <button @click="dismissModal" data-dismiss="modal"
                            class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel
                    </button>
                </div>
            </div>
        </div>
    </modal>

</template>

<script>

import FileUpload from '../../FileUpload';
export default {
    components: {FileUpload},
    data() {
        return {
            data: {
                name: '',
                app_level: '',
                image: '',
            }
        }
    },
    methods: {
        fileSelected(files) {
            this.data.image = '';

            for (const file of files)
                this.data.image = file;
        },

        dismissModal: function () {
            this.$modal.hide('vehicle-category-add')
        },
        buildFormData: function () {
            const formData = new FormData()
            formData.append('name', this.data.name)
            formData.append('app_level', this.data.app_level)
            formData.append('image', this.data.image)
            return formData;
        },

        submit: function () {
            for (let input in this.data) {
                if (this.data.name === '') {
                    this.$alertify.error(`${input} is required`);
                    return false;
                }
            }
            axios.post('/admin/vehicle/category', this.buildFormData())
                .then(({data}) => {
                    this.$alertify.success("Category Created Successfully!");
                    this.$emit('category-added', data)
                    this.dismissModal();
                    this.data.name = '';
                    this.data.app_level = '';
                    this.data.image = '';
                })
                .catch(err => {
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

