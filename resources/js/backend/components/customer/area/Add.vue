<template>
    <modal class="center" name="area-add" height="auto">
        <div class="" id="header-footer-modal-preview"
             style="margin-top: 0px; margin-left: 0px; padding-left: 0px; z-index: 53;">
            <div class="modal__content">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base-center mr-auto text-center">
                        Add Category
                    </h2>
                </div>
                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                    <div class="col-span-12 sm:col-span-12">
                        <label>Category Name</label>
                        <input type="text" class="input w-full border mt-2 flex-1" name="title" v-model="data.title"
                               id="title">
                    </div>
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
export default {
    data() {
        return {
            data: {
                title: '',
            },
            submitting: false
        }
    },
    methods: {
        dismissModal: function () {
            this.$modal.hide('area-add')
        },
        submit: function () {
            for (let input in this.data) {
                if (this.data[input] === '') {
                    this.$alertify.error(`${input} is required`);
                    return false;
                }
            }
            this.submitting = true
            axios.post('/admin/category', this.data)
                .then(({data}) => {
                    this.$alertify.success("Category Created Successfully!");
                    this.$emit('category-added', data)
                    this.dismissModal();
                    this.data.title = '';
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

