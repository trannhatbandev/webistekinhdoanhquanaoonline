<?php

use App\Http\Controllers\Admin\AdminControllers;
use App\Http\Controllers\Admin\Attributes\ProductAttributesController;
use App\Http\Controllers\Admin\Blog\BlogController;
use App\Http\Controllers\Admin\Brand\BrandControllers;
use App\Http\Controllers\Admin\Category\CategoryControllers;
use App\Http\Controllers\Admin\Color\ColorController;
use App\Http\Controllers\Admin\Comment\CommentController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Size\SizeController;
use App\Http\Controllers\Admin\Users\LoginControllers;
use App\Http\Controllers\Customer\Cart\CartController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\Product\ProductHomeController;
use App\Http\Controllers\Admin\DiscountCode\DiscountCodeController;
use App\Http\Controllers\Admin\TransportFee\TransportFeeController;
use App\Http\Controllers\Customer\Cart\CheckoutController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Statistical\StatisticalController;
use App\Http\Controllers\Customer\Contact\ContactController;
use App\Http\Controllers\Customer\HistoryOrder\HistoryOrderController;
use App\Http\Controllers\Staff\StaffController;
use Illuminate\Support\Facades\Route;


//admin
Route::get('/admin', [LoginControllers::class,'index'])->name('login');
Route::prefix('admin')->group(function () {

    Route::post('users/login-admin', [LoginControllers::class,'login']);
    Route::get('users/logout', [LoginControllers::class,'logout']);

    Route::get('dashboard', [AdminControllers::class,'showDashboard']);
    //category
    Route::prefix('category')->group(function () {
        Route::controller(CategoryControllers::class)->group(function (){
            Route::get('show-category', 'showListCategory');
            Route::get('delete-category/{id}','deleteCategory');
            Route::get('update-category-status-hide/{id}','updateCategoryStatusHide');
            Route::get('update-category-status-display/{id}','updateCategoryStatusDisplay');
            Route::post('create-category','createCategory');
            Route::post('update-category/{id}','updateCategory');
            //import,export
            Route::post('import-excel-category', 'importExcelCategory');
            Route::post('export-excel-category', 'exportExcelCategory');
        });
    });

    //brand
    Route::prefix('brand')->group(function (){
        Route::controller(BrandControllers::class)->group(function (){
            Route::get('show-brand', 'showListBrand');
            Route::post('create-brand', 'createBrand');
            Route::get('delete-brand/{id}','deleteBrand');
            Route::post('update-brand/{id}', 'updateBrand');
            Route::get('update-brand-status-hide/{id}', 'updateBrandStatusHide');
            Route::get('update-brand-status-display/{id}', 'updateBrandStatusDisplay');
            //import,export
            Route::post('import-excel-brand', 'importExcelBrand');
            Route::post('export-excel-brand', 'exportExcelBrand');
        });
    });

    //size
    Route::prefix('size')->group(function (){
        Route::controller(SizeController::class)->group(function (){
            Route::get('show-size', 'showListSize');
            Route::post('create-size', 'createSize');
            Route::get('delete-size/{id}','deleteSize');
            Route::post('update-size/{id}', 'updateSize');
            Route::get('update-size-status-hide/{id}', 'updateSizeStatusHide');
            Route::get('update-size-status-display/{id}', 'updateSizeStatusDisplay');
            //import,export
            Route::post('import-excel-size', 'importExcelSize');
            Route::post('export-excel-size', 'exportExcelSize');
        });
    });

    //color
    Route::prefix('color')->group(function (){
        Route::controller(ColorController::class)->group(function (){
            Route::get('show-color', 'showListColor');
            Route::post('create-color', 'createColor');
            Route::get('delete-color/{id}','deleteColor');
            Route::post('update-color/{id}', 'updateColor');
            Route::get('update-color-status-hide/{id}', 'updateColorStatusHide');
            Route::get('update-color-status-display/{id}', 'updateColorStatusDisplay');
            //import,export
            Route::post('import-excel-color', 'importExcelColor');
            Route::post('export-excel-color', 'exportExcelColor');
        });
    });

    //product
    Route::prefix('product')->group(function (){
        Route::controller(ProductController::class)->group(function (){
            Route::get('show-product', 'showListProduct');
            Route::post('create-product', 'createProduct');
            Route::get('delete-product/{id}','deleteProduct');
            Route::post('update-product/{id}', 'updateProduct');
            Route::get('update-product-status-hide/{id}', 'updateProductStatusHide');
            Route::get('update-product-status-display/{id}', 'updateProductStatusDisplay');
            Route::get('show-create-gallery-product/{id}', 'showCreateGalleryProduct');
            Route::post('create-gallery-product/{product_id}','createGalleryProduct');
            Route::get('delete-gallery-product/{id}', 'deleteGalleryProduct');
            Route::post('update-gallery/{id}','updateGalleryProduct');
        });
    });
    //attributes
    Route::prefix('attributes-product')->group(function (){
        Route::controller(ProductAttributesController::class)->group(function (){
            Route::get('show-attributes-product', 'showListAttributesProduct');
            Route::post('create-attributes-product', 'createAttributesProduct');
            Route::post('update-attributes-product-quantity', 'updateAttributesProductQuantity');
            Route::get('delete-attributes-product/{id}','deleteAttributesProduct');
            //import,export
            Route::post('import-excel-attributes-product', 'importExcelAttributesProduct');
            Route::post('export-excel-attributes-product', 'exportExcelAttributesProduct');
        });
    });
    //discount code
    Route::prefix('discount-code')->group(function (){
        Route::controller(DiscountCodeController::class)->group(function (){
            Route::get('show-discount-code', 'showListDiscountCode');
            Route::post('create-discount-code', 'createDiscountCode');
            Route::get('delete-discount-code/{id}','deleteDiscountCode');
            Route::post('update-discount-code/{id}', 'updateDiscountCode');
            Route::get('send-discount-code/{discountCodeID}','sendDiscountCode');

            //import,export
            Route::post('import-excel-discount-code', 'importExcelDiscountCode');
            Route::post('export-excel-discount-code', 'exportExcelDiscountCode');
        });
    });
    //transport fee
    Route::prefix('transport-fee')->group(function (){
        Route::controller(TransportFeeController::class)->group(function (){
            Route::get('show-transport-fee', 'showListTransportFee');
            Route::post('select-transport-fee','selectTransportFee');
            Route::post('add-transport-fee','addTransportFee');
            Route::post('update-transport-fee-freeship','updateTransportFeeFreeship');
            Route::get('delete-transport-fee/{id}','deleteTransportFee');
            //import,export
            Route::post('import-excel-transport-fee', 'importExcelTransportFee');
            Route::post('export-excel-transport-fee', 'exportExcelTransportFee');

        });
    });
    //order
    Route::prefix('order')->group(function (){
        Route::controller(OrderController::class)->group(function (){
            Route::get('manage-order', 'showListOrder');
            Route::get('show-order-detail/{orderCode}','showOrderDetail');
            Route::get('export-pdf/{orderCode}', 'exportPDF');
            Route::post('update-order-status','updateOrderStatus');
        });
    });
    //comment
    Route::prefix('comment')->group(function (){
        Route::controller(CommentController::class)->group(function (){
            Route::get('manage-comment', 'showListComment');
            Route::get('no-accept-comments/{id}','noAcceptComment');
            Route::get('accept-comments/{id}','acceptComment');
            Route::post('reply-comment','replyComment');
        });
    });
     //blog
    Route::prefix('blog')->group(function (){
        Route::controller(BlogController::class)->group(function (){
            Route::get('show-list-blog', 'showListBlog');
            Route::post('create-blog','createBlog');
            Route::post('update-blog/{id}','updateBlog');
            Route::get('delete-blog/{id}', 'deleteBlog');
            Route::get('update-blog-status-hide/{id}', 'updateBlogStatusHide');
            Route::get('update-blog-status-display/{id}', 'updateBlogStatusDisplay');

             //import,export
             Route::post('import-excel-blog', 'importExcelBlog');
             Route::post('export-excel-blog', 'exportExcelblog');

        });
    });
    Route::prefix('statistical')->group(function (){
        Route::controller(StatisticalController::class)->group(function (){
            Route::get('show-statistical','showStatistical');
            Route::post('get-date-filter','getDateFilter');
            Route::post('filter-statistical-profit','filterStatisticalProfit');
            Route::post('show-statistical-one-year','showStatisticalOnewYear');


        });
    });
});

//staff
Route::get('/staff', [StaffController::class,'index']);
Route::get('/staff/order/manage-order', [StaffController::class,'showManageOrder']);
Route::get('/staff/order/show-order-detail/{orderCode}', [StaffController::class,'showOrderDetailStaff']);
Route::post('/staff/order/update-order-status', [StaffController::class,'updateOrderStatusStaff']);






//home
Route::get('/',[HomeController::class,'showHome']);
Route::post('/autocomplete-search',[HomeController::class,'autocompleteSearch']);

Route::prefix('home')->group(function (){

    Route::controller(HomeController::class)->group(function (){
        Route::post('search-product','searchProduct');
        Route::get('all-new-product','showAllNewProduct');
        Route::get('all-blog','showAllBlog');
        Route::get('detail-blog/{slug}','detailBlog');
        Route::get('wistList','showWistList');
        Route::post('add-whistlist','addWhistList');
        Route::post('add-compare-product','addCompareProduct');

    });

    Route::controller(CustomerController::class)->group(function (){
        //customer
        Route::get('show-register-customer','showRegisterCustomer');
        Route::post('register-customer','registerCustomer');
        Route::post('register-success','registerSuccess');
        Route::get('show-confirm-email','showConfirmEmail');
        Route::get('logout-customer','logoutCustomer');
        Route::get('show-login-customer','showLoginCustomer');
        Route::post('login-customer','loginCustomer');
        Route::get('show-forget-password','showForgetPassword');
        Route::get('show-recover-new-password','showRecoverNewPassword');
        Route::post('recover-new-password','recoverNewPassword');
        Route::post('recover-password','recoverPassword');
        Route::post('customer/customer-add-address-shipping','customerAddAddressShipping');
        Route::post('customer/change-address-customer','changeAddressCustomer');

        Route::get('personal-information','showPersonalInformation');
        Route::post('customer/change-info-customer/{id}','changeInfoCustomer');
        Route::get('customer/change-address','showChangeAddress');
        Route::post('customer/change-address-update/{id}','changeAddressUpdate');
        Route::get('customer/change-password-customer','showChangePasswordCustomer');
        Route::post('customer/change-password-customer-update/{id}','changePasswordCustomerUpdate');
        Route::get('customer/show-all-discount-code-customer','showAllDiscountCodeCustomer');

        //google login
        Route::get('login-google','googleLogin');
        Route::get('show-register-customer/google/callback','callbackGoogle');

        //facebook login
        Route::get('login-facebook','facebookLogin');
        Route::get('show-register-customer/facebook/callback','callbackFacebook');
    });

    Route::controller(CartController::class)->group(function (){
        //cart
        Route::get('cart/show-cart','showCart');
        Route::post('cart/add-cart','addCart');
        Route::post('cart/add-cart-detail','addCartDetail');
        Route::post('cart/update-cart','updateCart');
        Route::get('cart/delete-cart/{sessionId}','deleteCart');
        Route::get('cart/delete-all-cart','deleteAllCart');
        Route::post('cart/select-color','selectColorCart');
        Route::post('cart/select-attributes','selectAttributes');
        Route::post('cart/update-quantity-product','updateQuantityProduct');
        Route::post('cart/update-size-cart','updateSizeCart');
        Route::post('cart/update-color-cart','updateColorCart');
        Route::get('cart/count-quantity-cart','countQuantityCart');
        Route::get('cart/hover-cart-product','hoverCartProduct');

        //trasnport fee
        Route::post('transport-fee/select-transport-fee','selectTransportFeeCustomer');
        Route::post('transport-fee/shipping_charges_apply','shippingChargesApply');
        Route::get('transport-fee-customer/delete-transport-fee-customer','deleteTransportFeeCustomer');
    });

    Route::controller(ProductHomeController::class)->group(function (){
        //product
        Route::get('product-detail/show-product-detail/{slug}','showProductDetail');
        Route::get('category/show-product-with-category/{slug}','showProductWithCategory');
        Route::get('product/show-all-product','showAllProduct');
        Route::get('product/show-product-compare','showProductCompare');
        Route::post('quick-view-product','quickViewProduct');
        Route::post('star-rating/insert-rating','insertRatingProduct');
        Route::post('product-detail/select-color-detail','selectColorDetail');
        Route::post('product-detail/check-the-amount-inventory','checkTheAmountInventory');

    });

    Route::controller(DiscountCodeController::class)->group(function (){
        //discount code
        Route::post('discount-code-customer/add-discount-code-customer','addDiscountCodeCustomer');
        Route::get('discount-code-customer/delete-discount-code-customer','deleteDiscountCodeCustomer');
    });

    Route::controller(CheckoutController::class)->group(function (){
        //checkout
        Route::get('show-checkout','showCheckout');
        Route::post('momo-checkout','momoCheckout');
        Route::post('offline-checkout','offLineCheckout');
        Route::get('show-checkout-success','showCheckoutSucess');


    });
    Route::controller(CommentController::class)->group(function (){
        //comment
        Route::post('comment','showComment');
        Route::post('add-comment','addComment');
    });
    Route::controller(ContactController::class)->group(function (){
        Route::get('contact','showContact');
    });
    Route::controller(HistoryOrderController::class)->group(function (){
        Route::get('history/history-order','showHistoryOrder');
        Route::get('order/show-history-order-detail/{orderCode}','showHistoryOrderDetail');
        Route::get('order/cancel-order/{orderCode}','cancelOrder');
        Route::get('count-order','countOrder');

    });
});


