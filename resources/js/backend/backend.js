/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../bootstrap');

import Vue from 'vue';
import VueAlertify from "vue-alertify";
import VueJSModal from "vue-js-modal";
import Select2 from 'v-select2-component';
import wysiwyg from "vue-wysiwyg";
import * as VueGoogleMaps from 'vue2-google-maps';
import VueMask from 'v-mask';

window.validateEmail = function (email) {
    return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
}

//const ExampleComponent = () => import(/* webpackChunkName: "example_component" */'../components/ExampleComponent');
const customerAdd = () => import(/* webpackChunkName: "customer_add" */'./components/customer/Add');
const customerEdit = () => import(/* webpackChunkName: "customer_edit" */'./components/customer/Edit');
const categoryAdd = () => import(/*webpackChunkName "category_add"*/'./components/category/Add');
const categoryEdit = () => import(/*webpackChunkName "category_edit"*/'./components/category/Edit');
const vehicleAdd = () => import(/* webpackChunkName: "customer_add" */'./components/vehicle/Add');
const vehicleEdit = () => import(/* webpackChunkName: "customer_edit" */'./components/vehicle/Edit');
const subAdminAdd = () => import(/* webpackChunkName: "sub_admin_add" */'./components/sub_admin/Add');
const subAdminEdit = () => import(/* webpackChunkName: "sub_admin_edit" */'./components/sub_admin/Edit');
const vehicleTypeAdd = () => import(/* webpackChunkName: "vehicle_type_add" */'./components/vehicle-type/Add');
const vehicleTypeEdit = () => import(/* webpackChunkName: "vehicle_type_edit" */'./components/vehicle-type/Edit');
const driverAdd = () => import(/* webpackChunkName: "vehicle_type_add" */'./components/driver/Add');
const driverEdit = () => import(/* webpackChunkName: "vehicle_type_edit" */'./components/driver/Edit');
const itemAdd = () => import(/*webpackChunkName: "item_add"*/'./components/item/Add');
const itemEdit = () => import(/*webpackChunkName: "item_edit"*/ './components/item/Edit')
const settingAdd = () => import(/*webpackChunkName "setting_add*/'./components/setting')
const roleAdd = () => import(/*webpackChunkName: "role_add"*/'./components/role/Add');
const roleEdit = () => import(/*webpackChunkName: "role_edit"*/ './components/role/Edit');
const itemCategoryAdd = () => import(/*webpackChunkName: "item_category_add"*/ './components/item/category/Add');
const customerAreaAdd = () => import(/*webpackChunkName: "customer_area_add"*/ './components/customer/area/Add');
const vehicleCategoryAdd = () => import(/*webpackChunkName: "vehicle_category_add"*/ './components/vehicle-type/vehicle-category/Add');
const pageAdd = () => import(/*webpackChunkName: "page_add"*/'./components/page/Add');
const pageEdit = () => import(/*webpackChunkName: "page_edit"*/ './components/page/Edit');
const sliderAdd = () => import(/*webpackChunkName: "slider_add"*/'./components/slider/Add');
const sliderEdit = () => import(/*webpackChunkName: "slider_edit"*/ './components/slider/Edit');
const bannerAdd = () => import(/*webpackChunkName: "banner_add"*/'./components/banner/Add');
const areaAdd = () => import(/*webpackChunkName: "area_add"*/'./components/area/Add');
const areaEdit = () => import(/*webpackChunkName: "area_edit"*/ './components/area/Edit');
const couponAdd = () => import(/*webpackChunkName: "coupon_add"*/ './components/coupon/Add');
const couponEdit = () => import(/*webpackChunkName: "coupon_edit"*/ './components/coupon/Edit');

//Vue.component('example-component', ExampleComponent);
Vue.component('customer-add', customerAdd);
Vue.component('customer-edit', customerEdit);
Vue.component('vehicle-add', vehicleAdd);
Vue.component('vehicle-edit', vehicleEdit);
Vue.component('category-add', categoryAdd);
Vue.component('category-edit', categoryEdit);
Vue.component('sub-admin-add', subAdminAdd);
Vue.component('sub-admin-edit', subAdminEdit);
Vue.component('vehicle-type-add', vehicleTypeAdd);
Vue.component('vehicle-type-edit', vehicleTypeEdit);
Vue.component('driver-add', driverAdd);
Vue.component('driver-edit', driverEdit);
Vue.component('item-add', itemAdd)
Vue.component('item-edit', itemEdit);
Vue.component('setting-add', settingAdd)
Vue.component('role-add', roleAdd)
Vue.component('role-edit', roleEdit);
Vue.component('item-category-add', itemCategoryAdd);
Vue.component('customer-area-add', customerAreaAdd);
Vue.component('vehicle-category-add', vehicleCategoryAdd);
Vue.component('page-add', pageAdd)
Vue.component('page-edit', pageEdit);
Vue.component('slider-add', sliderAdd)
Vue.component('slider-edit', sliderEdit);
Vue.component('banner-add', bannerAdd)
Vue.component('area-add', areaAdd)
Vue.component('area-edit', areaEdit);
Vue.component('coupon-add', couponAdd);
Vue.component('coupon-edit', couponEdit);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(VueAlertify);
Vue.use(VueJSModal);
Vue.component('Select2', Select2);
Vue.use(wysiwyg, {});
Vue.use(VueMask);

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyCgEQi5BtiMAtIKnNnCp5RuuNiQAQQyRTQ',
        libraries: 'places'
    },
});


new Vue({
    el: '#backend-app',
});
