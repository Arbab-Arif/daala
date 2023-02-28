<template>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Edit Role & Permission
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div
                        class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Role
                        </h2>
                    </div>
                    <div class="p-5">
                        <div class="preview">
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Name
                                    </label>
                                    <input type="text" name="label" v-model="data.label"
                                           class="cols-3 input w-full border mt-2"
                                           placeholder="Enter Role Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-col sm:flex-row items-center pl-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto mb-5">
                            Permissions
                        </h2>
                    </div>
                    <div class="p-5 flex flex-wrap" id="form-validation">
                        <div class="preview w-full md:w-1/3" v-for="(permission, key) in permissions">
                            <input class="input flex-wrap flex-none border border-gray-500 mt-1"
                                   type="checkbox" @change="choosePermission($event, permission)"
                                   :checked="data.permissions.indexOf(permission.id) > -1">
                            <span v-text="permission.label"></span>
                        </div>
                    </div>
                    <div class="p-5">
                        <button @click="update" v-text="updating ? 'Updating...' : 'Update'"
                                class="button bg-theme-1 text-white mt-5">
                        </button>
                        <a href="/admin/role">
                            <button class="button bg-red-600 text-white">Cancel</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        'role': {
            required: true
        },
        "permissions": {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            data: {
                label: this.role.label,
                permissions: this.getIdsFromObject(this.role.permissions),
            },
            updating: false
        }
    },
    methods: {
        getIdsFromObject: function (objects) {
            let ids = [];
            for (const object of objects) {
                ids.push(object.id);
            }
            return ids;
        },
        choosePermission(evt, permission) {
            if (evt.target.checked === true) {
                this.data.permissions.push(permission.id);
            }
            if (evt.target.checked === false) {
                let index = this.data.permissions.indexOf(permission.id);
                this.data.permissions.splice(index, 1);
            }
        },

        update: function () {
            if (this.data.label === '') {
                this.$alertify.error(`Role Name Is Required`);
                return false;
            }
            this.updating = true
            this.data['_method'] = 'PUT';
            axios.post(`/admin/role/${this.role.id}`, this.data)
                .then(() => {
                    this.$alertify.success("Role Updated Successfully!");
                    setTimeout(() => {
                        window.location.href = '/admin/role';
                    }, 1000)
                })
                .catch(err => {
                    this.updating = false
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
