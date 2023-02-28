<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('vehicle', Admin\VehicleController::class);
    Route::resource('category', Admin\CategoryController::class);
    Route::resource('vehicle_type', Admin\VehicleTypeController::class);
    Route::resource('customer', Admin\CustomerController::class);
    Route::delete('customerDeleteAll', [Admin\CustomerController::class, 'deleteAll'])->name('customer.delete.all');
    Route::resource('sub_admin', Admin\SubAdminController::class);
    Route::delete('userDeleteAll', [Admin\SubAdminController::class, 'deleteAll'])->name('user.delete.all');
    Route::resource('driver', Admin\DriverController::class);
    Route::delete('driverDeleteAll', [Admin\DriverController::class, 'deleteAll'])->name('driver.delete.all');
    Route::resource('item', Admin\ItemController::class);
    Route::delete('itemDeleteAll', [Admin\ItemController::class, 'deleteAll'])->name('item.delete.all');
    Route::resource('role', Admin\RoleController::class);
    Route::delete('roleDeleteAll', [Admin\RoleController::class, 'deleteAll'])->name('role.delete.all');
    Route::resource('page', Admin\PageController::class);
    Route::delete('pageDeleteAll', [Admin\PageController::class, 'deleteAll'])->name('page.delete.all');
    Route::resource('slider', Admin\SliderController::class);
    Route::delete('sliderDeleteAll', [Admin\SliderController::class, 'deleteAll'])->name('slider.delete.all');
    Route::resource('area', Admin\AreaController::class);
    Route::delete('areaDeleteAll', [Admin\AreaController::class, 'deleteAll'])->name('area.delete.all');
    Route::resource('job', Admin\UserRequestController::class);
    Route::resource('coupon', Admin\CouponController::class);
    Route::get('contact', [Admin\ContactController::class, 'index'])->name('contact.index');
    Route::delete('couponDeleteAll', [Admin\CouponController::class, 'deleteAll'])->name('coupon.delete.all');

    Route::group(['as' => 'report.', 'prefix' => 'report'], function () {
        Route::get('operation', [Admin\OperationReportController::class, 'index'])->name('operation');
        Route::get('driver', [Admin\DriverReportController::class, 'index'])->name('driver');
        Route::get('customer', [Admin\CustomerReportController::class, 'index'])->name('customer');
        Route::get('vehicle/type', [Admin\VehicleTypeReportController::class, 'index'])->name('vehicle.type');
        Route::get('revenue/breakdown', [Admin\RevenueBreakDownReportController::class, 'index'])->name('revenue.breakdown');
    });

    Route::post('vehicle/category', [Admin\VehicleCategoryController::class, 'store'])->name('vehicle.category.store');

    Route::post('job/export', [Admin\UserRequestController::class, 'export'])->name('job.export');

    Route::get('/banner/create', [Admin\BannerController::class, 'create'])->name('banner.create');
    Route::post('/banner', [Admin\BannerController::class, 'update'])->name('banner.update');

    Route::get('/rating', [Admin\CustomerRatingController::class, 'index'])->name('rating.index');
    Route::get('/feedback', [Admin\CustomerFeedbackController::class, 'index'])->name('feedback.index');
    Route::get('/setting/create', [Admin\SettingController::class, 'create'])->name('setting.create');
    Route::post('/setting', [Admin\SettingController::class, 'store'])->name('setting');
});
