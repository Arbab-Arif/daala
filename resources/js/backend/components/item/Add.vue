<template>
    <div class="content">
        <itemCategoryAdd @category-added="updateCategory"></itemCategoryAdd>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Create Item
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="flex-1 font-medium text-base mr-auto">
                            Item
                        </h2>

                        <h2 class="flex-1 font-medium text-base mr-auto text-right">
                        </h2>
                    </div>
                    <div class="p-5" id="form-validation">
                        <div class="preview">
                            <div class="flex flex-wrap -mx-3 mb-4">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-0">
                                        Item name
                                    </label>
                                    <input type="text" name="name" id="name" class="cols-3 input w-full border mt-2"
                                           placeholder="Ex # Flex Box" minlength="2" v-model="data.name">
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Unit
                                    </label>
                                    <select class="tail-select cols-3 w-full input input-sm border mr-2" name="unit" id="unit" v-model="data.unit">
                                        <option>KG</option>
                                        <option>Gallon</option>
                                        <option>Liter</option>
                                        <option>Piece</option>
                                        <option>Crates</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-4">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">
                                        Item Category
                                    </label>
                                    <select2
                                        v-model="data.category_id"
                                        :options="categories"
                                        placeholder="Please Select Category">
                                    </select2>
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Manage Category
                                    </label>
                                    <button class="button bg-theme-1 text-white cols-3 input border mt-2"
                                            @click="showCategoryForm()">
                                        Add Category
                                    </button>
                                </div>
                            </div>

                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3 mt-4">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-0">
                                        Item Description
                                    </label>
                                    <textarea
                                        class="resize border w-full rounded focus:outline-none focus:shadow-outline"
                                        name="address" id="address" rows="5" v-model="data.description"></textarea>
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-4">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td colspan="3">
                                            <button type="button" @click="addRow"
                                                    class="button bg-theme-1 text-white cols-3 input border mt-2">
                                                Add Size Chart
                                            </button>

                                        </td>
                                    </tr>
                                    </thead>
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Label</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Weight</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Width</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Height</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Length</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(size, key) of data.sizeChart">
                                        <td class="border-b whitespace-no-wrap">
                                            <input type="text" name="label" class="cols-3 input w-full border mt-2"
                                                   placeholder="Ex # Small" minlength="2" v-model="size.label">
                                        </td>
                                        <td class="border-b whitespace-no-wrap">
                                            <input type="number" name="weight" class="cols-3 input w-full border mt-2"
                                                   placeholder="Ex # Weight - 23" minlength="2" v-model="size.weight">
                                        </td>
                                        <td class="border-b whitespace-no-wrap">
                                            <input type="number" name="width" class="cols-3 input w-full border mt-2"
                                                   placeholder="Ex # Width - 12" minlength="2" v-model="size.width">
                                        </td>
                                        <td class="border-b whitespace-no-wrap">
                                            <input type="number" name="height" class="cols-3 input w-full border mt-2"
                                                   placeholder="Ex # Height - 2" minlength="2" v-model="size.height">
                                        </td>
                                        <td class="border-b whitespace-no-wrap">
                                            <input type="number" name="breath" class="cols-3 input w-full border mt-2"
                                                   placeholder="Ex # Length 4" minlength="2" v-model="size.breath">
                                        </td>
                                        <td class="border-b whitespace-no-wrap">
                                            <button type="button" @click="removeRow(key)" v-if="key > 0"
                                                    class="button bg-red-600 text-white">Remove
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>
                            <button @click="submit" class="button bg-theme-1 text-white mt-5">Submit</button>
                            <a href="/admin/item">
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
import itemCategoryAdd from "./category/Add";

export default {
    components: {itemCategoryAdd},
    props: {
        "category": {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            data: {
                category_id: '',
                name: '',
                unit: 'KG',
                description: '',
                sizeChart: [
                    {
                        label: '',
                        weight: '',
                        width: '',
                        height: '',
                        breath: '',
                    }
                ],
            },
            categories: this.category
        }
    },
    methods: {
        showCategoryForm: function () {
            this.$modal.show('category-add');
        },
        updateCategory: function (data) {
            this.categories.push({
                id: data.id,
                text: data.name
            });
        },
        addRow: function () {
            if(this.data.sizeChart.length === 10){
                this.$alertify.error("Only 10 Size Chart Can Be Added");
                return false;
            }
            this.data.sizeChart.push({
                label: '',
                weight: '',
                width: '',
                height: '',
                breath: '',
            });
        },
        removeRow: function (key) {
                this.data.sizeChart.splice(key, 1);
        },

        submit: function () {
            for (let input in this.data) {
                if (this.data[input] === '') {
                    this.$alertify.error(`${input} is required`);
                    return false;
                }
            }
            if(this.data.sizeChart[0].label === '' ||
                this.data.sizeChart[0].breath === '' ||
                this.data.sizeChart[0].weight === '' ||
                this.data.sizeChart[0].width === '' ||
                this.data.sizeChart[0].height === '')
            {
                this.$alertify.error(`Please Fill Size Chart Properly`);
                return false;
            }

            axios.post('/admin/item', this.data)
                .then(() => {
                    this.$alertify.success("Item Created Successfully!");
                    setTimeout(() => {
                        window.location.href = '/admin/item';
                    }, 1000)
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
<style>
.select2 {
    width: 100% !important;
    padding-top: 4px;
    border: 1px solid #e2e2e2;
    border-radius: 7px;
    padding-bottom: 4px;
}

.select2-container--default .select2-selection--single {
    border: none;
}
</style>
