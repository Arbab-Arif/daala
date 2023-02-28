<template>
    <div class="content">
        <vehicleCategoryAdd @category-added="updateCategory"></vehicleCategoryAdd>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Create Commercial Type
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Commercial Type
                        </h2>
                    </div>
                    <div class="p-5" id="form-validation">
                        <div class="preview">
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Vehicle Type
                                    </label>
                                    <input type="text" name="name" id="name" class="cols-3 input w-full border mt-2"
                                           placeholder="Enter Vehicle Type Name" minlength="2" v-model="data.name">
                                </div>

                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Vehicle Category
                                        <button class="button bg-theme-1 text-white cols-3 input border mt-2 ml-2" @click="showCategoryForm()">
                                            Add Vehicle Category
                                        </button>
                                    </label>
                                    <select2
                                        v-model="data.vehicle_category_id"
                                        :options="categories"
                                        placeholder="Please Select Category">
                                    </select2>
                                </div>

                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Per Km
                                    </label>
                                    <input type="number" name="per_km" id="per_km"
                                           class="cols-3 input w-full border mt-2"
                                           placeholder="20 Per Km" minlength="2" v-model="data.per_km">
                                </div>

                                <div class="w-full md:w-1/3 px-3 mt-4 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Base Fare
                                    </label>
                                    <input type="number" name="base_fare" id="das"
                                           class="cols-3 input w-full border mt-2"
                                           placeholder="100" minlength="2" v-model="data.base_fare">
                                </div>

                                <div class="w-full md:w-1/3 mt-4 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Width
                                    </label>
                                    <input type="text" name="width" id="width" class="cols-3 input w-full border mt-2"
                                           placeholder="20 m" minlength="2" v-model="data.width">
                                </div>
                                <div class="w-full md:w-1/3 mt-4 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Height
                                    </label>
                                    <input type="number" name="height" id="height"
                                           class="cols-3 input w-full border mt-2"
                                           placeholder="20 m" minlength="2" v-model="data.height">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mt-4 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Length
                                    </label>
                                    <input type="number" name="breath" id="breath"
                                           class="cols-3 input w-full border mt-2"
                                           placeholder="10 m" minlength="2" v-model="data.breath">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mt-4 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Base Distance
                                    </label>
                                    <input type="number" name="base_distance" id="base_distance"
                                           class="cols-3 input w-full border mt-2"
                                           placeholder="40 Distance" minlength="2" v-model="data.base_distance">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Commission (Percentage %)
                                    </label>
                                    <input type="number" name="commission" id="commission"
                                           class="cols-3 input w-full border mt-2"
                                           placeholder="100" minlength="2" v-model="data.commission">
                                </div>

                                <div class="w-full md:w-1/2 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Base Waiting Time (In Minutes)
                                    </label>
                                    <input type="number" name="base_waiting_time" id="base_waiting_time"
                                           class="cols-3 input w-full border mt-2"
                                           placeholder="30" minlength="2" v-model="data.base_waiting_time">
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Waiting Time Penalty
                                    </label>
                                    <input type="number" name="waiting_time_penalty" id="waiting_time_penalty"
                                           class="cols-3 input w-full border mt-2"
                                           placeholder="112" minlength="2" v-model="data.waiting_time_penalty">
                                </div>
                            </div>

                            <div class="flex flex-wrap -mx-3 mb-6">

                                <div class="w-full px-3 mt-4">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Description

                                    </label>
                                    <textarea
                                        class="resize border w-full rounded focus:outline-none focus:shadow-outline"
                                        rows="5" name="description" id="description"
                                        v-model="data.description"></textarea>
                                </div>
                                <div class="w-full px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Image
                                    </label>
                                    <file-upload @upload="fileSelected"></file-upload>
                                </div>
                            </div>

                            <div class="flex flex-wrap -mx-3 mb-4">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td colspan="3">
                                            <button type="button" @click="addRow"
                                                    class="button bg-theme-1 text-white cols-3 input border mt-2">
                                                Add Area
                                            </button>

                                        </td>
                                    </tr>
                                    </thead>
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Area</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Area Per Km</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Area Per Min</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Price</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(area, key) of data.areas">
                                        <td class="border-b whitespace-no-wrap">
                                            <select2 v-model="area.area_id" :options="areaItems"
                                                     placeholder="Please Select Area">
                                            </select2>
                                        </td>
                                        <td class="border-b whitespace-no-wrap">
                                            <input type="number" name="name" class="cols-3 input w-full border mt-2"
                                                   placeholder="Ex # Area Per km" minlength="2" v-model="area.area_per_km">
                                        </td>
                                        <td class="border-b whitespace-no-wrap">
                                            <input type="number" name="name" class="cols-3 input w-full border mt-2"
                                                   placeholder="Ex # Area Per Min" minlength="2" v-model="area.area_per_min">
                                        </td>
                                        <td class="border-b whitespace-no-wrap">

                                            <input type="number" name="name" class="cols-3 input w-full border mt-2"
                                                   placeholder="Ex # Price 100" minlength="2" v-model="area.price">
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
                            <a href="/admin/vehicle_type">
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

import vehicleCategoryAdd from "./vehicle-category/Add";
import FileUpload from '../FileUpload';

export default {
    components: {vehicleCategoryAdd,FileUpload},
    props: {
        'default_area': {
            type: Array,
            default: []
        },
        'category': {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            data: {
                name: '',
                vehicle_category_id: '',
                width: '',
                height: '',
                breath: '',
                per_km: '',
                per_min: 0,
                base_fare: '',
                base_waiting_time: '',
                waiting_time_penalty: '',
                base_distance: '',
                commission: '',
                description: '',
                image: '',
                status: 1,
                areas: [
                    {
                        area_id: '',
                        area_per_km: '',
                        area_per_min: '',
                        price: '',
                    }
                ],
            },
            areaItems: this.default_area,
            categories: this.category,
        };
    },
    methods: {
        fileSelected(files) {
            this.data.image = '';

            for (const file of files)
                this.data.image = file;
        },

        showCategoryForm: function () {
            this.$modal.show('vehicle-category-add');
        },
        updateCategory: function (data) {
            this.categories.push({
                id: data.id,
                text: data.name
            });
        },
        addRow: function () {
            if (this.data.areas.length === 4) {
                this.$alertify.error("Only 4 Area Can Be Added");
                return false;
            }
            this.data.areas.push({
                area_id: '',
                area_per_km: '',
                area_per_min: '',
                price: '',
            });
        },
        removeRow: function (key) {
            this.data.areas.splice(key, 1);
        },
        buildFormData: function () {
            const formData = new FormData()
            formData.append('vehicle_category_id', this.data.vehicle_category_id)
            formData.append('name', this.data.name)
            formData.append('width', this.data.width)
            formData.append('height', this.data.height)
            formData.append('breath', this.data.breath)
            formData.append('per_km', this.data.per_km);
            formData.append('per_min', this.data.per_min)
            formData.append('base_fare', this.data.base_fare)
            formData.append('base_waiting_time', this.data.base_waiting_time)
            formData.append('waiting_time_penalty', this.data.waiting_time_penalty)
            formData.append('base_distance', this.data.base_distance)
            formData.append('commission', this.data.commission)
            formData.append('description', this.data.description)
            formData.append('image', this.data.image)
            formData.append('status', 1)
            // formData.append('areas', []);
            let i = 0;
            for (let area of this.data.areas) {
                formData.append(`areas[${i}][area_id]`, area.area_id)
                formData.append(`areas[${i}][area_per_km]`, area.area_per_km)
                formData.append(`areas[${i}][area_per_min]`, area.area_per_min)
                formData.append(`areas[${i}][price]`, area.price)
                i++;
            }
            return formData;
        },
        submit: function () {
            for (let input in this.data) {
                if (this.data[input] === '') {
                    this.$alertify.error(`${input} is required`);
                    return false;
                }
            }

            axios.post('/admin/vehicle_type', this.buildFormData())
                .then(() => {
                    this.$alertify.success("Commercial Type Created Successfully!");
                    setTimeout(() => {
                        window.location.href = '/admin/vehicle_type';
                    }, 1000);
                })
                .catch(err => {
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
    margin-top: 8px;
}

.select2-container--default .select2-selection--single {
    border: none;
}
</style>
