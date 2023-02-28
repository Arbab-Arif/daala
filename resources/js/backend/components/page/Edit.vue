<template>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Edit Page
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Page
                        </h2>
                    </div>
                    <div class="p-5" id="form-validation">
                        <div class="preview">
                            <div class="flex flex-wrap -mx-3 mb-4">
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-0">
                                        Title
                                    </label>
                                    <input type="text" name="name" id="name" class="cols-3 input w-full border mt-2"
                                           placeholder="About Us" minlength="2" v-model="data.title">
                                </div>
<!--                                <div class="w-full px-3 mb-6 md:mb-0">-->
<!--                                    <label-->
<!--                                        class="block uppercase mt-4 tracking-wide text-gray-700 text-xs font-bold mb-0">-->
<!--                                        Type-->
<!--                                    </label>-->
<!--                                    <select2-->
<!--                                        class="mt-2"-->
<!--                                        v-model="data.type"-->
<!--                                        :options="['Header', 'Footer', 'Footer Sub Menu']"-->
<!--                                        placeholder="Please Select Type">-->
<!--                                    </select2>-->
<!--                                </div>--><div class="w-full px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase mt-4 tracking-wide text-gray-700 text-xs font-bold mb-0">
                                    Type
                                </label>
                                <select2
                                    @change="data.parent_id = 0"
                                    class="mt-2"
                                    v-model="data.type"
                                    :options="['Header', 'Footer']"
                                    placeholder="Please Select Type">
                                </select2>
                            </div>
                                <div class="w-full px-3 mb-6 md:mb-0" v-show="data.type === 'Footer'">
                                    <label
                                        class="block uppercase mt-4 tracking-wide text-gray-700 text-xs font-bold mb-0">
                                        Parent Page
                                    </label>
                                    <select2
                                        class="mt-2"
                                        v-model="data.parent_id"
                                        :options="item"
                                        placeholder="Please Select Parent Page">
                                    </select2>
                                </div>
                                <div class="w-full px-3 mt-4 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-0">
                                        Content
                                    </label>
                                    <wysiwyg v-model="data.content"/>
                                </div>
                            </div>
                            <button @click="update" v-text="updating ? 'Updating...' : 'Update'"
                                    class="button bg-theme-1 text-white mt-5">
                            </button>
                            <a href="/admin/page">
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
import "vue-wysiwyg/dist/vueWysiwyg.css";

export default {
    props: ["item"],
    data() {
        return {
            data: {...this.item},
            updating: false,
        }
    },

    methods: {
        buildFormData: function () {
            const formData = new FormData()
            formData.append('_method', 'put')
            formData.append('title', this.data.title)
            formData.append('type', this.data.type)
            formData.append('content', this.data.content)
            return formData;
        },

        update: function () {
            for (let input in this.required) {
                if (this.data[input] === '') {
                    this.$alertify.error(`${this.required[input]} is required`);
                    return false;
                }
            }
            this.updating = true;
            axios.post(`/admin/page/${this.item.id}`, this.buildFormData())
                .then(() => {
                    this.$alertify.success("Page Updated Successfully!");
                    setTimeout(() => {
                        window.location.href = '/admin/page';
                    }, 1000)
                })
                .catch(err => {
                    this.updating = false;
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

<style>
.select2 {
    width: 100% !important;
}
</style>
