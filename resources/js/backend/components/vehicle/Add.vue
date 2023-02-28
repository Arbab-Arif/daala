<template>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Create Vehicle
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Vehicle
                        </h2>
                    </div>
                    <div class="p-5" id="form-validation">
                        <div class="preview">
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    >Vehicle Name
                                    </label>
                                    <input type="text" name="vehicle_name" id="vehicle_name"
                                           class="cols-3 input w-full border mt-2"
                                           placeholder="Ex # Honda Bike 70CC" minlength="2" v-model="data.vehicle_name">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">
                                        Commercial Type
                                    </label>
                                    <select2
                                        v-model="data.vehicle_type_id"
                                        :options="vehicleType"
                                        placeholder="Please Select Commercial Type">
                                    </select2>
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Vehicle CC
                                    </label>
                                    <input type="text" name="vehicle_cc" id="vehicle_cc"
                                           class="cols-3 input w-full border mt-2"
                                           placeholder="Ex # 70CC" minlength="2" v-model="data.vehicle_cc">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Vehicle Number
                                    </label>
                                    <input type="text" name="vehicle_no" class="cols-3 input w-full border mt-2"
                                           placeholder="Ex # KHI-1234" minlength="2" v-model="data.vehicle_no">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        License No
                                    </label>
                                    <input type="text" name="license_no" class="cols-3 input w-full border mt-2"
                                           placeholder="Ex # SAD-86684" minlength="2" v-model="data.license_no">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Make
                                    </label>
                                    <input type="text" name="make" id="make" class="cols-3 input w-full border mt-2"
                                           placeholder="Please Enter Your Make" minlength="2" v-model="data.make">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Year
                                    </label>
                                    <input type="text" name="year" class="cols-3 input w-full border mt-2"
                                           placeholder="Ex # 2020" minlength="2" v-model="data.year">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Color
                                    </label>
                                    <input type="text" name="color" class="cols-3 input w-full border mt-2"
                                           placeholder="Ex # Blue" minlength="2" v-model="data.color">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Model
                                    </label>
                                    <input type="text" name="model" class="cols-3 input w-full border mt-2"
                                           placeholder="Enter Model" minlength="2" v-model="data.model">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-2">


                            </div>
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/3 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Icon
                                    </label>
                                    <input type="file" name="icon" class="cols-3 input w-full border mt-2 p-1"
                                           placeholder="10 Per Min" minlength="2" @change="fileSelected($event)">
                                </div>
                            </div>

                            <button @click="submit" class="button bg-theme-1 text-white mt-5">Submit</button>
                            <a href="/admin/vehicle">
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
        "vehicleType": {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            data: {
                vehicle_name: '',
                vehicle_type_id: '',
                vehicle_cc: '',
                vehicle_no: '',
                license_no: '',
                make: '',
                model: '',
                year: '',
                color: '',
                icon: '',
            }
        }
    },
    methods: {
        fileSelected(evt) {
            this.data.icon = evt.target.files[0]
        },
        buildFormData: function () {
            const formData = new FormData()
            formData.append('vehicle_name', this.data.vehicle_name)
            formData.append('vehicle_type_id', this.data.vehicle_type_id)
            formData.append('vehicle_cc', this.data.vehicle_cc)
            formData.append('vehicle_no', this.data.vehicle_no)
            formData.append('license_no', this.data.license_no)
            formData.append('make', this.data.make)
            formData.append('model', this.data.model)
            formData.append('year', this.data.year)
            formData.append('color', this.data.color)
            formData.append('icon', this.data.icon)
            return formData;
        },
        submit: function () {
            for (let input in this.data) {
                if (this.data[input] === '') {
                    this.$alertify.error(`${input} is required`);
                    return false;
                }
            }

            axios.post('/admin/vehicle', this.buildFormData())
                .then(() => {
                    this.$alertify.success("Vehicle Created Successfully!");
                    setTimeout(() => {
                         window.location.href = '/admin/vehicle';
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
}
</style>
