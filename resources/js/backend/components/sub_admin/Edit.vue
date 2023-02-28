<template>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Edit User
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            User
                        </h2>
                    </div>
                    <div class="p-5" id="form-validation">
                        <div class="preview">
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Name
                                    </label>
                                    <input type="text" name="name" class="cols-3 input w-full border mt-2"
                                           placeholder="Enter Name" minlength="2" v-model="data.name">
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Email
                                    </label>
                                    <input type="email" name="email" class="cols-3 input w-full border mt-2"
                                           placeholder="Please Enter Your Email" minlength="2" v-model="data.email">
                                </div>

                            </div>
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-4">
                                        Contact No # (+92-000-0000000)
                                    </label>
                                    <input type="text" name="phone" id="phone" v-mask="'+92-###-#######'" v-model="data.contact"
                                           class="cols-3 input w-full border mt-2" maxlength="15"
                                           placeholder="Enter Contact No #" minlength="2">
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 mt-4 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 ">
                                        Password
                                    </label>
                                    <div class="border cols-3 rounded-md mt-4">
                                        <input :type="passwordIsShowing ? 'text': 'password'" id="password" name="password"
                                               placeholder="Enter Password" v-model="data.password" required="required"
                                               class="text-black focus:outline-none input w-10/12 is-minimal text-sm">
                                        <button
                                            type="button" @click="passwordIsShowing = !passwordIsShowing"
                                            v-text="passwordIsShowing ? 'Hide': 'Show'"
                                            class="ml-4 focus:outline-none text-2xs font-bold text-grey">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/2 px-3 mb-6 mt-4 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 ">
                                        Confirm Password
                                    </label>
                                    <div class="border cols-3 rounded-md mt-4">
                                        <input :type="passwordIsShowing ? 'text': 'password'" id="password_confirmation" name="password_confirmation"
                                               placeholder="Enter Password" v-model="data.password_confirmation" required="required"
                                               class="text-black focus:outline-none input w-10/12 is-minimal text-sm">
                                        <button
                                            type="button" @click="passwordIsShowing = !passwordIsShowing"
                                            v-text="passwordIsShowing ? 'Hide': 'Show'"
                                            class="ml-4 focus:outline-none text-2xs font-bold text-grey">
                                        </button>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-4">
                                        Role
                                    </label>
                                    <select2
                                        v-model="data.role_id"
                                        :options="role"
                                        placeholder="Please Select Role">
                                    </select2>
                                </div>
                            </div>
                            <button @click="update" v-text="updating ? 'Updating...' : 'Update'"
                                    class="button bg-theme-1 text-white mt-5">
                            </button>
                            <a href="/admin/sub_admin">
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
        'role': {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            passwordIsShowing: false,
            data: {
                name: this.item.name,
                email: this.item.email,
                contact: this.item.contact,
                role_id: this.getIdsFromObject(this.item.roles),
                password: '',
                password_confirmation: ''
            },
            updating: false
        };
    },
    methods: {
        getIdsFromObject: function (objects) {
            let ids = [];
            for (const object of objects) {
                ids.push(object.id);
            }
            return ids;
        },

        update: function () {
            if (!validateEmail(this.data.email)) {
                this.$alertify.error('Email is not valid');
                return false;
            }

            if (this.data.password === '') {
                delete this.data.password;
            }
            this.updating = true
            axios.put(`/admin/sub_admin/${this.item.id}`, this.data)
                .then(() => {
                    this.$alertify.success("Sub Admin Updated Successfully!");
                    setTimeout(() => {
                        window.location.href = '/admin/sub_admin';
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


