<template>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Edit Driver
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Driver Information
                        </h2>
                    </div>
                    <div class="py-2 px-5" id="form-validation">
                        <div class="preview">
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        First Name
                                    </label>
                                    <input type="text" name="first_name" id="first_name" v-model="data.firstName"
                                           class="cols-3 input w-full border mt-2" placeholder="Enter First Name"
                                           minlength="2">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Last Name
                                    </label>
                                    <input type="text" name="last_name" id="last_name" v-model="data.lastName"
                                           class="cols-3 input w-full border mt-2" placeholder="Enter Last Name"
                                           minlength="2">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Email
                                    </label>
                                    <input type="email" name="email" id="email" class="cols-3 input w-full border mt-2"
                                           placeholder="Please Enter Your Email" minlength="2" v-model="data.email">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 mt-4">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Phone No # (92-333-1234567)
                                    </label>
                                    <input type="text" name="phone" id="phone" class="cols-3 input w-full border mt-2"
                                           placeholder="Ex # +92-000-0000000" minlength="2" v-mask="'+92-###-#######'"
                                           v-model="data.phone" maxlength="15"
                                           pattern="[0-9]{4}-[0-9]{7}">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mt-4 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Postal Code
                                    </label>
                                    <input type="text" name="postal_code" class="cols-3 input w-full border mt-2"
                                           placeholder="75600" minlength="2" v-model="data.postal_code"
                                           v-mask="'#####'" maxlength="5">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mt-4 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Cnic # (42000-0000000-0)
                                    </label>
                                    <input type="text" name="cnic" id="cnic" class="cols-3 input w-full border mt-2"
                                           placeholder="EX # 42101-8909877-2" minlength="2" v-model="data.cnic"
                                           v-mask="'#####-#######-#'" maxlength="15">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">
                                        Country
                                    </label>
                                    <select data-search="true" name="country" id="country" v-model="data.country_id"
                                            class="tail-select cols-3 w-full mt-2 input input-sm border mr-2">
                                        <option v-for="country of countries" :value="country.id">{{
                                                country.title
                                            }}
                                        </option>
                                    </select>
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">
                                        City
                                    </label>
                                    <select data-search="true" name="city_id" id="city_id" v-model="data.city_id"
                                            class="tail-select cols-3 w-full mt-2 input input-sm border mr-2">
                                        <option v-for="city of cities" :value="city.id">{{ city.title }}</option>
                                    </select>
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">
                                        Areas
                                    </label>
                                    <select data-search="true" name="area_id" id="area_id" v-model="data.area_id"
                                            class="tail-select cols-3 w-full mt-2 input input-sm border mr-2">
                                        <option v-for="area of areas" :value="area.id">{{ area.title }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/2 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Picture
                                    </label>
                                    <file-upload @upload="fileSelected"></file-upload>
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Driver Picture
                                    </label>
                                    <img :src="getFullUrl(data.picture)" class="img-fluid" alt="Driver Documents" style="height: 200px;width: 460px;">
                                </div>
                            </div>

                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3 mt-4">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Address
                                    </label>
                                    <textarea
                                        class="resize border w-full rounded focus:outline-none focus:shadow-outline"
                                        name="address" id="address" rows="5" v-model="data.address"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-col sm:flex-row items-center py-2 px-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Vehicle Information
                        </h2>
                    </div>
                    <div class="p-5" id="form-2">
                        <div class="preview">
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/3 px-3 mb-6">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">
                                        Commercial Type
                                    </label>
                                    <select2
                                        v-model="data.vehicle_type_id"
                                        :options="vehicleTypes"
                                        placeholder="Please Select Commercial Type">
                                    </select2>
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

                                <div class="w-full md:w-1/4 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Vehicle Image
                                    </label>
                                    <file-upload @upload="vehiclePicture"></file-upload>
                                </div>
                                <div class="w-full md:w-1/4 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Vehicle Image
                                    </label>
                                    <img :src="getFullUrl(data.vehicle_image)" class="img-fluid" alt="Driver Documents" style="height: 200px;">
                                </div>

                                <div class="w-full md:w-1/4 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Cnic Front
                                    </label>
                                    <file-upload @upload="cnicFront"></file-upload>
                                </div>
                                <div class="w-full md:w-1/4 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Cnic Front
                                    </label>
                                    <img :src="getFullUrl(data.cnic_front_image)" class="img-fluid" alt="Driver Documents" style="height: 200px;">
                                </div>

                                <div class="w-full md:w-1/4 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Cnic Back
                                    </label>
                                    <file-upload @upload="cnicBack"></file-upload>
                                </div>
                                <div class="w-full md:w-1/4 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Cnic Back
                                    </label>
                                    <img :src="getFullUrl(data.cnic_back_image)" class="img-fluid" alt="Driver Documents" style="height: 200px;">
                                </div>

                                <div class="w-full md:w-1/4 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        License Front
                                    </label>
                                    <file-upload @upload="licenseFront"></file-upload>
                                </div>
                                <div class="w-full md:w-1/4 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        License Front
                                    </label>
                                    <img :src="getFullUrl(data.license_front_image)" class="img-fluid" alt="Driver Documents" style="height: 200px;">
                                </div>

                                <div class="w-full md:w-1/4 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        License Back
                                    </label>
                                    <file-upload @upload="licenseBack"></file-upload>
                                </div>
                                <div class="w-full md:w-1/4 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        License Back
                                    </label>
                                    <img :src="getFullUrl(data.license_back_image)" class="img-fluid" alt="Driver Documents" style="height: 200px;">
                                </div>

                                <div class="w-full md:w-1/4 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Vehicle Registration Image
                                    </label>
                                    <file-upload @upload="vehicleRegImage"></file-upload>
                                </div>
                                <div class="w-full md:w-1/4 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Vehicle Registration Image
                                    </label>
                                    <img :src="getFullUrl(data.vehicle_reg_image)" class="img-fluid" alt="Driver Documents" style="height: 200px;">
                                </div>

                            </div>
                            <button
                                @click="update"
                                class="button bg-theme-1 text-white mt-5"
                                :disabled="updating"
                                v-text="updating ? 'Updating...' : 'Update'"
                            ></button>
                            <a href="/admin/driver">
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

import FileUpload from "../FileUpload";

export default {
    components: {FileUpload},
    props: {
        'driver': {
            required: true
        },
        'vehicle': {
            type: Object,
            default: []
        },
        'vehicle-types': {
            type: Array,
            default: []
        },
        'countries': {
            type: Array,
            default: []
        },
        'cities': {
            type: Array,
            default: []
        },
        'areas': {
            type: Array,
            default: []
        }
    },
    // props: ['driver', 'vehicle', 'vehicleTypes'],

    data() {
        return {
            updating: false,
            data: {
                firstName: this.driver.firstName,
                lastName: this.driver.lastName,
                email: this.driver.email,
                phone: this.driver.phone,
                password: this.driver.password,
                picture: this.driver.picture,
                postal_code: this.driver.postal_code,
                country_id: this.driver.country_id,
                city_id: this.driver.city_id,
                area_id: this.driver.area_id,
                cnic: this.driver.cnic,
                address: this.driver.address,
                vehicle_type_id: this.vehicle.vehicle_type_id,
                vehicle_no: this.vehicle.vehicle_no,
                license_no: this.vehicle.license_no,
                vehicle_image: this.vehicle.vehicle_image,
                cnic_front_image: this.vehicle.cnic_front_image,
                cnic_back_image: this.vehicle.cnic_back_image,
                license_front_image: this.vehicle.license_front_image,
                license_back_image: this.vehicle.license_back_image,
                vehicle_reg_image: this.vehicle.vehicle_reg_image
            },
            required: {
                'name': "Name",
                'email': 'Email',
                'phone': 'Phone',
            }
        };
    },
    methods: {
        getFullUrl(src) {
            return `${location.origin}/storage/${src}`;
        },

        fileSelected(files) {
            this.data.picture = '';

            for (const file of files)
                this.data.picture = file;
        },
        vehiclePicture(vehicleFiles) {
            this.data.vehicle_image = '';

            for (const vehicleFile of vehicleFiles)
                this.data.vehicle_image = vehicleFile;
        },
        cnicFront(cincFiles) {
            this.data.cnic_front_image = '';

            for (const cincFile of cincFiles)
                this.data.cnic_front_image = cincFile;
        },
        cnicBack(backFiles) {
            this.data.cnic_back_image = '';

            for (const backFile of backFiles)
                this.data.cnic_back_image = backFile;
        },
        licenseFront(licenseFiles) {
            this.data.license_front_image = '';

            for (const licenseFile of licenseFiles)
                this.data.license_front_image = licenseFile;
        },
        licenseBack(backLicenseFiles) {
            this.data.license_back_image = '';

            for (const backLicenseFile of backLicenseFiles)
                this.data.license_back_image = backLicenseFile;
        },
        vehicleRegImage(regFiles) {
            this.data.vehicle_reg_image = '';

            for (const regFile of regFiles)
                this.data.vehicle_reg_image = regFile;
        },
        buildFormData: function () {
            const formData = new FormData();
            formData.append('_method', 'put');
            formData.append('first_name', this.data.firstName);
            formData.append('last_name', this.data.lastName);
            formData.append('email', this.data.email);
            formData.append('phone', this.data.phone);
            formData.append('password', this.data.password);
            formData.append('picture', this.data.picture);
            formData.append('postal_code', this.data.postal_code);
            formData.append('country_id', this.data.country_id);
            formData.append('city_id', this.data.city_id);
            formData.append('cnic', this.data.cnic);
            formData.append('address', this.data.address);
            formData.append('vehicle_name', this.data.vehicle_name);
            formData.append('vehicle_type_id', this.data.vehicle_type_id);
            formData.append('vehicle_cc', this.data.vehicle_cc);
            formData.append('vehicle_no', this.data.vehicle_no);
            formData.append('license_no', this.data.license_no);
            formData.append('make', this.data.make);
            formData.append('model', this.data.model);
            formData.append('color', this.data.color);
            formData.append('year', this.data.year);
            formData.append('vehicle_image', this.data.vehicle_image);
            formData.append('cnic_front_image', this.data.cnic_front_image);
            formData.append('cnic_back_image', this.data.cnic_back_image);
            formData.append('license_front_image', this.data.license_front_image);
            formData.append('license_back_image', this.data.license_back_image);
            formData.append('vehicle_reg_image', this.data.vehicle_reg_image);
            return formData;
        },
        update: function () {
            delete this.data.id;
            for (let input in this.required) {
                if (this.data[input] === '') {
                    this.$alertify.error(`${this.required[input]} is required`);
                    return false;
                }
            }

            if (this.data.password === '') {
                delete this.data.password;
            }
            this.updating = true;
            axios.post(`/admin/driver/${this.driver.id}`, this.buildFormData())
                .then(() => {
                    this.$alertify.success("Driver Updated Successfully!");
                    setTimeout(() => {
                        window.location.href = '/admin/driver';
                    }, 1000);
                })
                .catch(err => {
                    this.updating = false;
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
