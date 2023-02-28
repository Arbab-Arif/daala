<template>
    <div class="content">
        <!--        <customerAreaAdd @category-added="updateCategory"></customerAreaAdd>-->
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Create Customer
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Customer
                        </h2>
                    </div>
                    <div class="p-5" id="form-validation">
                        <div class="preview">
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        First Name
                                    </label>
                                    <input type="text" name="first_name" id="name" v-model="data.firstName"
                                           class="cols-3 input w-full border mt-2" placeholder="Enter First Name"
                                           minlength="2">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Last Name
                                    </label>
                                    <input type="text" name="last_name" id="lname" v-model="data.lastName"
                                           class="cols-3 input w-full border mt-2" placeholder="Enter Last Name"
                                           minlength="2">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Email
                                    </label>
                                    <input type="email" name="email" id="email" v-model="data.email"
                                           class="cols-3 input w-full border mt-2"
                                           placeholder="Please Enter Your Email" minlength="2">
                                </div>

                            </div>
                            <div class="flex flex-wrap -mx-3 mb-2">

                                <div class="w-full md:w-1/3 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Phone No # (92-333-1234567)
                                    </label>
                                    <input type="text" name="phone" id="phone" v-mask="'+92-###-#######'"
                                           v-model="data.phone"
                                           class="cols-3 input w-full border mt-2" maxlength="15"
                                           placeholder="Enter Phone #" minlength="2">
                                </div>

                                <div class="w-full md:w-1/3 px-3 mb-6 mt-4 md:mb-0">
                                    <label for="password"
                                           class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">
                                        Password: (At Least 8 Characters)
                                    </label>
                                    <div class="border cols-3 rounded-md">
                                        <input :type="passwordIsShowing ? 'text': 'password'" id="password"
                                               name="password"
                                               placeholder="Enter Password" v-model="data.password" required="required"
                                               class="text-black focus:outline-none input w-10/12 is-minimal text-sm">
                                        <button
                                            type="button" @click="passwordIsShowing = !passwordIsShowing"
                                            v-text="passwordIsShowing ? 'Hide': 'Show'"
                                            class="ml-2 focus:outline-none text-2xs font-bold text-grey"
                                        >
                                        </button>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 mt-4 md:mb-0">
                                    <label for="confirm_password"
                                           class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">
                                        Confirm Password: (At Least 8 Characters)
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
                                            class="ml-2 focus:outline-none text-2xs font-bold text-grey"
                                        >
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/3 px-3 mt-4 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Postal Code
                                    </label>
                                    <input type="text" name="postal_code" class="cols-3 input w-full border mt-2"
                                           v-mask="'#####'"
                                           v-model="data.postal_code" placeholder="75600" minlength="2" maxlength="5">
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
                                    <select data-search="true" name="city" id="city" v-model="data.city_id"
                                            class="tail-select cols-3 w-full mt-2 input input-sm border mr-2">
                                        <option value="0">Choose City</option>
                                        <option v-for="city of cities" :value="city.id">{{ city.title }}</option>
                                    </select>
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">
                                        Areas
                                    </label>
                                    <select data-search="true" name="area" id="area" v-model="data.area_id"
                                            class="tail-select cols-3 w-full mt-2 input input-sm border mr-2">
                                        <option v-for="area of areas" :value="area.id">{{ area.title }}</option>
                                    </select>
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
                                <div class="w-full px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Picture
                                    </label>
                                    <file-upload @upload="fileSelected"></file-upload>
                                </div>
                            </div>
                            <button @click="submit"  v-text="submitting ? 'Submitting...' : 'Submit'" class=" button bg-theme-1 text-white mt-5">
                                Submit
                            </button>
                            <a href="/admin/customer">
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
import FileUpload from '../FileUpload';

export default {
    components: {FileUpload},
    props: ['countries', 'cities', 'areas'],
    data() {
        return {
            passwordIsShowing: false,
            data: {
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                password: '',
                password_confirmation: '',
                picture: '',
                postal_code: '',
                country_id: 1,
                city_id: '',
                area_id: '',
                address: '',
            },
            submitting: false,
            city_areas: this.areas
        };
    },
    methods: {
        fileSelected(files) {
            this.data.picture = '';

            for (const file of files)
                this.data.picture = file;
        },
        buildFormData: function () {
            const formData = new FormData();
            formData.append('first_name', this.data.firstName);
            formData.append('last_name', this.data.lastName);
            formData.append('email', this.data.email);
            formData.append('phone', this.data.phone);
            formData.append('password', this.data.password);
            formData.append('password_confirmation', this.data.password_confirmation);
            formData.append('picture', this.data.picture);
            formData.append('postal_code', this.data.postal_code);
            formData.append('country_id', this.data.country_id);
            formData.append('city_id', this.data.city_id);
            formData.append('area_id', this.data.area_id);
            formData.append('address', this.data.address);
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
            this.submitting = true
            axios.post('/admin/customer', this.buildFormData())
                .then(() => {
                    this.$alertify.success("Customer Created Successfully!");
                    setTimeout(() => {
                        window.location.href = '/admin/customer';
                    }, 1000);
                })
                .catch(err => {
                    this.submitting = false
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
