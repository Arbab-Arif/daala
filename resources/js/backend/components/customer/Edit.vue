<template>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Edit Customer
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
                                    <input type="text" name="name" id="first_name" v-model="data.firstName"
                                           class="cols-3 input w-full border mt-2" placeholder="Enter Name"
                                           minlength="2">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        First Name
                                    </label>
                                    <input type="text" name="name" id="last_name" v-model="data.lastName"
                                           class="cols-3 input w-full border mt-2" placeholder="Enter Name"
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
                                <div class="w-full md:w-1/2 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Phone No # (92-333-1234567)
                                    </label>
                                    <input type="text" name="phone" id="phone" v-mask="'+92-###-#######'" v-model="data.phone"
                                           class="cols-3 input w-full border mt-2" maxlength="15"
                                           placeholder="Enter Phone #" minlength="2">
                                </div>

                                <div class="w-full md:w-1/2 px-3 mt-4 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Postal Code
                                    </label>
                                    <input type="text" name="postal_code" class="cols-3 input w-full border mt-2" v-mask="'#####'"
                                           v-model="data.postal_code" placeholder="75600" minlength="2" maxlength="5">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/3 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">
                                        Country
                                    </label>
                                    <select data-search="true" name="country" id="country" v-model="data.country_id"
                                            class="tail-select cols-3 w-full mt-2 input input-sm border mr-2">
                                        <option v-for="country of countries" :value="country.id">{{ country.title }}</option>
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

                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/2 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Customer Picture
                                    </label>
                                    <file-upload @upload="fileSelected"></file-upload>
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 mt-4 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Customer Picture
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
                            <button @click="update" v-text="updating ? 'Updating...' : 'Update'"
                                    class="button bg-theme-1 text-white mt-5">
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
    props:{
        'item': {
            required: true
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
            data: {...this.item},
            updating: false,
            required: {
                'name': "Title",
                'email': 'Email',
                'phone': 'Phone',
                'customer_type': 'Customer type',
                'postal_code': 'Postal Code',
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

        buildFormData: function () {
            const formData = new FormData();
            formData.append('_method', 'put');
            formData.append('first_name', this.data.firstName);
            formData.append('last_name', this.data.lastName);
            formData.append('email', this.data.email);
            formData.append('phone', this.data.phone);
            formData.append('password', this.data.password);
            formData.append('customer_type', this.data.customer_type);
            formData.append('picture', this.data.picture);
            formData.append('postal_code', this.data.postal_code);
            formData.append('country_id', this.data.country_id);
            formData.append('city_id', this.data.city_id);
            formData.append('address', this.data.address);
            return formData;
        },
        update: function () {
            delete this.data.id;
            if (!validateEmail(this.data.email)) {
                this.$alertify.error('Email is not valid');
                return false;
            }

            for (let input in this.required) {
                if (this.data[input] === '') {
                    this.$alertify.error(`${this.required[input]} is required`);
                    return false;
                }
            }

            if (this.data.password === '') {
                delete this.data.password;
            }
            this.updating = true
            axios.post(`/admin/customer/${this.item.id}`, this.buildFormData())
                .then(() => {
                    this.$alertify.success("Customer Updated Successfully!");
                    setTimeout(() => {
                        window.location.href = '/admin/customer';
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
