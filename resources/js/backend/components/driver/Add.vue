<template>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Create Driver With Vehicle Information
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
                                        Cnic # (42000-0000000-0)
                                    </label>
                                    <input type="text" name="cnic" id="cnic" class="cols-3 input w-full border mt-2"
                                           placeholder="EX # 42101-8909877-2" minlength="2" v-model="data.cnic"
                                           v-mask="'#####-#######-#'" maxlength="15">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mt-4 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Postal Code
                                    </label>
                                    <input type="text" name="postal_code" class="cols-3 input w-full border mt-2"
                                           placeholder="75600" minlength="2" v-model="data.postal_code"
                                           v-mask="'#####'" maxlength="5">
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

                                <div class="w-full md:w-1/3 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Password: (at least 8 characters)
                                    </label>
                                    <div class="border cols-3 rounded-md mt-4">
                                        <input :type="passwordIsShowing ? 'text': 'password'" id="password"
                                               name="password"
                                               placeholder="Enter Password" v-model="data.password" required="required"
                                               class="text-black focus:outline-none input w-10/12 is-minimal text-sm">
                                        <button
                                            type="button" @click="passwordIsShowing = !passwordIsShowing"
                                            v-text="passwordIsShowing ? 'Hide': 'Show'"
                                            class="ml-4 focus:outline-none text-2xs font-bold text-grey"
                                        >
                                        </button>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 mt-4 md:mb-0">
                                    <label for="confirm_password"
                                           class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">
                                        Confirm Password: (at least 8 characters)
                                    </label>
                                    <div class="border cols-3 rounded-md">
                                        <input :type="passwordIsShowing ? 'text': 'password'" id="confirm_password"
                                               name="password"
                                               placeholder="Re-enter Password" v-model="data.password_confirmation"
                                               required="required"
                                               class="text-black focus:outline-none input w-10/12 is-minimal text-sm">
                                        <button
                                            type="button" @click="passwordIsShowing = !passwordIsShowing"
                                            v-text="passwordIsShowing ? 'Hide': 'Show'"
                                            class="ml-4 focus:outline-none text-2xs font-bold text-grey"
                                        >
                                        </button>
                                    </div>
                                </div>

                                <div class="w-full px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Picture
                                    </label>
                                    <file-upload @upload="fileSelected"></file-upload>
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
                                        Vehicle Type
                                    </label>
                                    <select2
                                        v-model="data.vehicle_type_id"
                                        :options="vehicleType"
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
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Vehicle Image
                                    </label>
                                    <file-upload @upload="vehiclePicture"></file-upload>

                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Cnic Front
                                    </label>
                                    <file-upload @upload="cnicFront"></file-upload>

                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Cnic Back
                                    </label>
                                    <file-upload @upload="cnicBack"></file-upload>
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        License Front
                                    </label>
                                    <file-upload @upload="licenseFront"></file-upload>
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        License Back
                                    </label>
                                    <file-upload @upload="licenseBack"></file-upload>
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Vehicle Registeration Image
                                    </label>
                                    <file-upload @upload="vehicleRegImage"></file-upload>
                                </div>
                            </div>
                            <button
                                @click="submit"
                                class="button bg-theme-1 text-white mt-5"
                                :disabled="submitting"
                                v-text="submitting ? 'Submitting...' : 'Submit'"
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
        "vehicle-type": {
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

    data() {
        return {
            passwordIsShowing: false,
            submitting: false,
            data: {
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                password: '',
                password_confirmation: '',
                picture: '',
                postal_code: '',
                country_id: '',
                city_id: '',
                area_id: '',
                cnic: '',
                address: '',
                vehicle_type_id: '',
                vehicle_no: '',
                license_no: '',
                vehicle_image: '',
                cnic_front_image: '',
                cnic_back_image: '',
                license_front_image: '',
                license_back_image: '',
                vehicle_reg_image: ''
            }
        }
    },
    methods: {
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
            const formData = new FormData()
            formData.append('first_name', this.data.firstName)
            formData.append('last_name', this.data.lastName)
            formData.append('email', this.data.email)
            formData.append('phone', this.data.phone)
            formData.append('password', this.data.password)
            formData.append('password_confirmation', this.data.password_confirmation);
            formData.append('picture', this.data.picture)
            formData.append('postal_code', this.data.postal_code)
            formData.append('country_id', this.data.country_id)
            formData.append('city_id', this.data.city_id)
            formData.append('area_id', this.data.area_id)
            formData.append('cnic', this.data.cnic)
            formData.append('address', this.data.address)
            // formData.append('vehicle_name', this.data.vehicle_name)
            formData.append('vehicle_type_id', this.data.vehicle_type_id)
            // formData.append('vehicle_cc', this.data.vehicle_cc)
            formData.append('vehicle_no', this.data.vehicle_no)
            formData.append('license_no', this.data.license_no)
            // formData.append('make', this.data.make)
            // formData.append('model', this.data.model)
            // formData.append('color', this.data.color)
            // formData.append('year', this.data.year)
            formData.append('vehicle_image', this.data.vehicle_image)
            formData.append('cnic_front_image', this.data.cnic_front_image)
            formData.append('cnic_back_image', this.data.cnic_back_image)
            formData.append('license_front_image', this.data.license_front_image)
            formData.append('license_back_image', this.data.license_back_image)
            formData.append('vehicle_reg_image', this.data.vehicle_reg_image)
            return formData;
        },
        submit: function () {
            for (let input in this.data) {
                if (this.data[input] === '') {
                    this.$alertify.error(`${input} is required`);
                    return false;
                }
            }

            if (!validateEmail(this.data.email)) {
                this.$alertify.error('Email is not valid');
                return false;
            }
            if (this.data.password !== this.data.password_confirmation) {
                this.$alertify.error("Password Don't Match");
                return false;
            }

            this.submitting = true;
            axios.post('/admin/driver', this.buildFormData())
                .then(() => {
                    this.$alertify.success("Driver Created Successfully!");
                    setTimeout(() => {
                        window.location.href = '/admin/driver';
                    }, 1000)
                })
                .catch(err => {
                    this.submitting = false;
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
