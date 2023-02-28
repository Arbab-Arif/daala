<template>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Edit Item
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Item
                        </h2>
                    </div>
                    <div class="p-5" id="form-validation">
                        <div class="preview">
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Item
                                        Name
                                    </label>
                                    <input type="text" name="name" id="name" class="cols-3 input w-full border mt-2"
                                           placeholder="Ex # Flex Box" minlength="2" v-model="data.name">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">
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
                                <div class="w-full md:w-1/3 px-3 mb-6">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">
                                        Item Category
                                    </label>
                                    <select2
                                        v-model="data.category_id"
                                        :options="category"
                                        :settings="{placeholder: 'Please Select Category' }"
                                    ></select2>
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3 mt-4">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Item Description
                                    </label>
                                    <textarea
                                        class="resize border w-full rounded focus:outline-none focus:shadow-outline"
                                        name="address" id="address" rows="5" v-model="data.description"></textarea>
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-2">
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
                                    <tr v-for="(size, key) of data.size_chart">
                                        <td class="border-b whitespace-no-wrap">
                                            <input type="text" name="label" class="cols-3 input w-full border mt-2"
                                                   placeholder="Ex # Box" minlength="2" v-model="size.label">
                                        </td>
                                        <td class="border-b whitespace-no-wrap">
                                            <input type="number" name="weight" class="cols-3 input w-full border mt-2"
                                                   placeholder="Ex # Box" minlength="2" v-model="size.weight">
                                        </td>
                                        <td class="border-b whitespace-no-wrap">
                                            <input type="number" name="width" class="cols-3 input w-full border mt-2"
                                                   placeholder="Ex # Box" minlength="2" v-model="size.width">
                                        </td>
                                        <td class="border-b whitespace-no-wrap">
                                            <input type="number" name="height" class="cols-3 input w-full border mt-2"
                                                   placeholder="Ex # Box" minlength="2" v-model="size.height">
                                        </td>
                                        <td class="border-b whitespace-no-wrap">
                                            <input type="number" name="breath" class="cols-3 input w-full border mt-2"
                                                   placeholder="Ex # Box" minlength="2" v-model="size.breath">
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

                            <button @click="update" v-text="updating ? 'Updating...' : 'Update'"
                                    class="button bg-theme-1 text-white mt-5">
                            </button>
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
export default {
    props: {
        'item': {
            required: true
        },
        'category': {
            type: Array,
            default: []
        },
    },
    data() {
        return {
            data: {
                _method: 'PUT',
                category_id: this.item.category_id,
                name: this.item.name,
                unit: this.item.unit,
                description: this.item.description,
                size_chart: []
            },
            updating: false,
        };
    },

    mounted() {
        for (const size_chart of this.item.size_chart) {
            this.data.size_chart.push({
                label: size_chart.label,
                weight: size_chart.weight,
                width: size_chart.width,
                height: size_chart.height,
                breath: size_chart.breath
            });
        }
    },

    methods: {
        addRow: function () {
            if (this.data.size_chart.length === 10) {
                this.$alertify.error("Only 10 Size Chart Can Be Added");
                return false;
            }
            this.data.size_chart.push({
                label: '',
                weight: '',
                width: '',
                height: '',
                breath: '',
            });
        },
        removeRow: function (key) {
            this.data.size_chart.splice(key, 1);
        },
        // validateSizeChart: function () {
        //     for (const sizeChart of this.data.size_chart) {
        //         const result = Object.values(sizeChart).every(this.isNotEmpty);
        //         if (!result) {
        //             return false;
        //         }
        //     }
        //     return true;
        // },
        // isNotEmpty: function (value) {
        //     return value !== '' && value > 0
        // },
        update: function () {
            for (let input in this.required) {
                if (this.data[input] === '') {
                    this.$alertify.error(`${this.required[input]} is required`);
                    return false;
                }
            }
            if(this.data.size_chart[0].label === '' ||
                this.data.size_chart[0].breath === '' ||
                this.data.size_chart[0].weight === '' ||
                this.data.size_chart[0].width === '' ||
                this.data.size_chart[0].height === '')
            {
                this.$alertify.error(`Please Fill Size Chart Properly`);
                return false;
            }
            this.updating = true
            axios.post(`/admin/item/${this.item.id}`, this.data)
                .then(() => {
                    this.$alertify.success("Item Updated Successfully!");
                    setTimeout(() => {
                        window.location.href = '/admin/item';
                    }, 1000);
                })
                .catch(err => {
                    this.updating = false
                    if (err.response.status === 422) {
                        let errors = Object.values(err.response.data.errors);
                        for (let error of errors) {
                            this.$alertify.error(error[0]);
                        }
                    }
                });
        }
    }

};
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
