<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PageController@gethome')->name('home');

Route::get('abcc', 'PageController@test');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    // //user----
    Route::get('viewuser', 'AdminController@viewuser');
    Route::get('add-user', 'AdminController@AddUser');
    Route::post('submit-add-user', 'AdminController@SubmitAddUser');
    Route::get('delete-user/{id}', 'AdminController@DeleteUser');

    // //typeproduct----
    Route::get('viewtypeproduct', 'ProductController@viewcategories');
    Route::get('view-add-category', 'ProductController@viewaddcategory');
    Route::post('submit-add-category', 'ProductController@submitaddcategory');
    Route::get('edit-category/{categoryId}', 'ProductController@vieweditcategory');
    Route::post('submit-edit-category/{categoryId}', 'ProductController@submiteditcategory');
    Route::get('delete-category/{categoryId}', 'ProductController@deletecategory');
    //product - add product***************** */
    Route::get('viewproduct', 'ProductController@viewproduct');
    Route::get('viewaddproduct', 'ProductController@viewaddproduct');
    Route::get('view-detail-product/{product_id}', 'ProductController@getproduct')->name('getproduct');
    Route::get('edit-product/{product_id}', 'ProductController@editproduct');
    Route::post('submitaddproduct', 'ProductController@submitaddproduct')->name('submitaddproduct');
    Route::post('save-edit-product/{productId}',  'ProductController@submiteditproduct');
    Route::get('delete-product/{productId}', 'ProductController@deleteproduct');
    Route::get('search-kit', 'ProductController@SearchKit');
    Route::get('search-product', 'ProductController@SearchProduct');
    Route::get('search-accessories', 'ProductController@SearchAccessories');
    //manager option
    Route::get('view-all-accessories', 'AccessoryController@GetAllAccessories');
    Route::get('view-add-accessory', 'AccessoryController@ViewAddAccessories');
    Route::post('submit-add-accessory', 'AccessoryController@SubmitAddAccessories');
    Route::get('edit-accessory/{id}', 'AccessoryController@ViewEditAccessories');
    Route::post('submit-edit-accessory/{id}', 'AccessoryController@SubmitEditAccessories');
    Route::get('delete-accessory/{id}', 'AccessoryController@DeleteAccessories');

    // accessories group view-all-accessories-group
    Route::get('view-all-accessories-group', 'AccessoryController@GetAllAccessoriesGroup');
    Route::get('/view-add-accessory-group', 'AccessoryController@ViewAddAccessoriesGroup');
    Route::post('submit-add-list-accessories', 'AccessoryController@SubmitAddAccessoriesGroup');
    Route::get('/edit-accessory-group/{id}', 'AccessoryController@ViewEditAccessoriesGroup');
    Route::post('submit-edit-group-accessory/{id}', 'AccessoryController@SubmitEditAccessoriesGroup');
    Route::get('delete-group-accessory/{id}', 'AccessoryController@DeleteAccessoriesGroup');
    //cart controller
    Route::get('view-bill', 'CartController@GetAllBill');
    Route::get('/view-bill-detail/{id}', 'CartController@GetBillDetail');
    Route::get('process-bill/{id}', 'CartController@ProcessBill');
    Route::get('success-bill/{id}', 'CartController@SuccessBill');
    Route::get('delete-bill/{id}', 'CartController@DeleteBill');
    Route::get('create-bill', 'CartController@CreateBill');

    Route::get('create-bill-admin/{id}', 'CartController@CreateBillAdmin');

    Route::post('add-kit-cart-admin/{id}', 'CartController@AddKitCartAdmin');
    Route::post('add-product-cart-admin/{id}', 'CartController@AddProductCartAdmin');
    Route::post('add-accessories-to-cart/{id}', 'CartController@AddAccessoriesCartAdmin');
    Route::get('delete-cart-admin/{id}', 'CartController@DeleteCartAdmin');
    Route::get('show-cart-admin/{id}', 'CartController@ShowCartAdmin');
    Route::get('save-cart-admin/{id}', 'CartController@SaveCartAdmin');



    //customer
    Route::get('viewcusaccount', 'CustomerController@GetAll');
    Route::get('view-add-customer', 'CustomerController@ViewAddCustomer');
    Route::post('submit-add-customer', 'CustomerController@AddCustomer');
    Route::get('edit-customer/{customerId}', 'CustomerController@ViewEditCustomer');
    Route::post('submit-edit-customer/{customerId}',  'CustomerController@EditCustomer');
    Route::get('delete-customer/{customerId}', 'CustomerController@DeleteCustomer');
    Route::get('view-all-bill-admin/{id}', 'CustomerController@ViewBillCustomer');
    Route::get('view-detail-bill-admin/{id}', 'CustomerController@ViewDetailBillAdmin');
    Route::get('search-customer', 'CustomerController@SearchCustomer');
    Route::post('add-note-admin/{id}', 'CustomerController@AddContent');

    // Create Bill NOW
    Route::get('create-bill-admin-now', 'CartController@CreateBillNow');
    Route::get('/show-cart-admin-now', 'CartController@ShowCartAdminNow');
    Route::get('search-kit-now', 'CartController@SearchKitNow');
    Route::get('search-product-now', 'CartController@SearchProductNow');
    Route::get('search-accessories-now', 'CartController@SearchAccessoriesNow');

    Route::post('add-kit-cart-admin-now/{id}', 'CartController@AddKitCartAdminNow');
    Route::post('add-product-cart-admin-now/{id}', 'CartController@AddProductCartAdminNow');
    Route::post('add-accessories-to-cart-now/{id}', 'CartController@AddAccessoriesCartAdminNow');
    Route::get('delete-cart-admin-now/{id}', 'CartController@DeleteCartAdminNow');
    Route::get('show-cart-admin-now/{id}', 'CartController@ShowCartAdminNow');
    Route::post('save-cart-admin-now', 'CartController@SaveCartAdminNow');

    //PDF
    Route::get('export-PDF-bill/{id}','PDFController@ExprotBillAdmin');
});
// front-end
Route::get('/', 'ProductController@GetAllProductClient');
Route::get('/view-detail/{productId}', 'ProductController@ViewDetailProduct'); // xem full kit
Route::get('view-detail-accessories/{id}', 'ProductController@ViewDetailAccessories'); // xem accessories
Route::get('/view-detail-one-product/{id}', 'ProductController@ViewDetailOneProduct'); // Xem chi tiết 1 sản phẩm
Route::post('add-tocarrt/{id}', 'CartController@SaveCart');
Route::get('add-to-carrt/{id}','CartController@SaveCartAccessories');
Route::get('add-to-carrt-product/{id}','CartController@SaveCartProduct');
Route::get('show-cart', 'CartController@ShowCart');
Route::get('delete-cart/{id}','CartController@DeleteCart' );
Route::get('clear-cart', 'CartController@ClearCart');
Route::post('check-out',  'CartController@CheckOut');
//bill
