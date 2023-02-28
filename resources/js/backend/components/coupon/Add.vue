<template>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Create Coupon
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Coupon
                        </h2>
                    </div>
                    <div class="p-5" id="form-validation">
                        <div class="preview">
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Title
                                    </label>
                                    <input type="text" name="title" id="title"
                                           class="cols-3 input w-full border mt-2"
                                           placeholder=" Please Enter Title" minlength="2" v-model="data.title">
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Code
                                    </label>
                                    <input type="text" name="code" id="code" class="cols-3 input w-full border mt-2"
                                           placeholder="Please Enter Code" minlength="2" v-model="data.code">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Discount
                                    </label>
                                    <input type="number" name="discount" id="discount"
                                           class="cols-3 input w-full border mt-2"
                                           placeholder="Please Enter Discount" minlength="2" v-model="data.value">
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">
                                        Discount Type
                                    </label>
                                    <select data-search="true" name="discount_type" id="discount_type"
                                            v-model="data.type"
                                            class="tail-select cols-3 w-full input input-sm border mr-2">
                                        <option>Fixed</option>
                                        <option>Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <button @click="submit" v-text="disabled ? 'Submitting...' : 'Submit'"
                                    class="button bg-theme-1 text-white mt-5">Submit
                            </button>
                            <a href="/admin/coupon">
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
export default {
    data() {
        return {
            data: {
                title: '',
                code: '',
                value: '',
                type: 'Fixed',
            },
            disabled: false,
        }
    },
    methods: {
        submit: function () {
            for (let input in this.data) {
                if (this.data[input] === '') {
                    this.$alertify.error(`${input} is required`);
                    return false;
                }
            }
            this.disabled = true;
            axios.post('/admin/coupon', this.data)
                .then(() => {
                    this.$alertify.success("Coupon Created Successfully!");
                    setTimeout(() => {
                        window.location.href = '/admin/coupon';
                    }, 1000)
                })
                .catch(err => {
                    this.disabled = false;
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

<style scoped>

</style>
