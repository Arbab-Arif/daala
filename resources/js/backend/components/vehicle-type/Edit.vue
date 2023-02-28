<template>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Edit Commercial Type
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
                                        Name
                                    </label>
                                    <input type="text" name="name" id="name" class="cols-3 input w-full border mt-2"
                                           placeholder="Enter Name" minlength="2" v-model="data.name">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Vehicle Category
                                    </label>
                                    <select2
                                        v-model="data.vehicle_category_id"
                                        :options="category"
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
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide mt-4 text-gray-700 text-xs font-bold mb-2">
                                        Base Fare
                                    </label>
                                    <input type="number" name="base_fare" id="base_fare"
                                           class="cols-3 input w-full border mt-2"
                                           placeholder="109" minlength="2" v-model="data.base_fare">
                                </div>
                                <div class="w-full md:w-1/3 mt-4 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Width
                                    </label>
                                    <input type="text" name="width" id="width" class="cols-3 input w-full border mt-2"
                                           placeholder="John Legend" minlength="2" v-model="data.width">
                                </div>
                                <div class="w-full md:w-1/3 mt-4 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Height
                                    </label>
                                    <input type="number" name="height" id="height"
                                           class="cols-3 input w-full border mt-2"
                                           placeholder="20 Per Km" minlength="2" v-model="data.height">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mt-4 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Breath
                                    </label>
                                    <input type="number" name="breath" id="breath"
                                           class="cols-3 input w-full border mt-2"
                                           placeholder="10 Per Min" minlength="2" v-model="data.breath">
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
                                            <select2 v-model="area.area_id" :options="items"
                                                     placeholder="Please Select Area">
                                            </select2>
                                        </td>
                                        <td class="border-b whitespace-no-wrap">
                                            <input type="number" name="name" class="cols-3 input w-full border mt-2"
                                                   placeholder="Ex # Box" minlength="2" v-model="area.area_per_km">
                                        </td>
                                        <td class="border-b whitespace-no-wrap">
                                            <input type="number" name="name" class="cols-3 input w-full border mt-2"
                                                   placeholder="Ex # Box" minlength="2" v-model="area.area_per_min">
                                        </td>
                                        <td class="border-b whitespace-no-wrap">
                                            <input type="number" name="name" class="cols-3 input w-full border mt-2"
                                                   placeholder="Ex # Box" minlength="2" v-model="area.price">
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
                            <button @click="submit" class="button bg-theme-1 text-white mt-5">Update</button>
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
export default {
    props: {
        'vehicle_type': {
            required: true
        },
        'items': {
            type: Array,
            default: []
        },
        'category': {
            type: Array,
            default: []
        },
    },
    data() {
        return {
            data: {
                vehicle_category_id: this.vehicle_type.vehicle_category_id,
                name: this.vehicle_type.name,
                width: this.vehicle_type.width,
                height: this.vehicle_type.height,
                breath: this.vehicle_type.breath,
                per_km: this.vehicle_type.per_km,
                per_min: this.vehicle_type.per_min,
                base_fare: this.vehicle_type.base_fare,
                base_waiting_time: this.vehicle_type.base_waiting_time,
                waiting_time_penalty: this.vehicle_type.waiting_time_penalty,
                base_distance: this.vehicle_type.base_distance,
                commission: this.vehicle_type.commission,
                description: this.vehicle_type.description,
                status: this.vehicle_type.status,
                areas: [],
            },
        }
    },
    mounted() {
        for (const area of this.vehicle_type.areas) {
            this.data.areas.push({
                area_id: area.area_id,
                area_per_km: area.area_per_km,
                area_per_min: area.area_per_min,
                price: area.price,
            });
        }
    },
    methods: {
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
        submit: function () {
            for (let input in this.data) {
                if (this.data[input] === '') {
                    this.$alertify.error(`${input} is required`);
                    return false;
                }
            }
            axios.put(`/admin/vehicle_type/${this.vehicle_type.id}`, this.data)
                .then(() => {
                    this.$alertify.success("Commercial Type Updated Successfully!");
                    setTimeout(() => {
                        window.location.href = '/admin/vehicle_type';
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
    margin-top: 8px;
}

.select2-container--default .select2-selection--single {
    border: none;
}
</style>
