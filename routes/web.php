<?php

use App\Http\Controllers\Client\RegulasiHealthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DigitalBookController;
use App\Http\Controllers\MasterCategoriesController;
use App\Http\Controllers\MasterDepartementController;
use App\Http\Controllers\MasterDivisionController;
use App\Http\Controllers\MasterHSEPageController;
use App\Http\Controllers\MasterISOController;
use App\Http\Controllers\MasterLocationController;
use App\Http\Controllers\MasterNewsController;
use App\Http\Controllers\MasterNwesController;
use App\Http\Controllers\MasterTitleController;
use App\Http\Controllers\MasterTypeController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserAccessController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Admin
    Route::group(['middleware' => ['auth']], function() {
            // Dashboard
                // View Permission
                    Route::group(['middleware' => ['permission:view-home']], function () {
                        Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
                    });
                // View Permission
                
                // Operational
                // Operational
            // Dashboard

            //  Setting
                // Role & Permission

                // View Permission
                    Route::group(['middleware' => ['permission:view-rolePermission']], function () {
                        Route::get('rolePermission', [RolePermissionController::class, 'index'])->name('rolePermission');
                        // Opertional Role & Permission
                            Route::get('getRolePermission', [RolePermissionController::class, 'getRolePermission'])->name('getRolePermission');
                            Route::post('saveRole', [RolePermissionController::class, 'saveRole'])->name('saveRole');
                            Route::get('getMenusName', [RolePermissionController::class, 'getMenusName'])->name('getMenusName');
                            Route::post('savePermissions', [RolePermissionController::class, 'savePermissions'])->name('savePermissions');
                            Route::get('roleDetail', [RolePermissionController::class, 'roleDetail'])->name('roleDetail');
                            Route::post('updateRole', [RolePermissionController::class, 'updateRole'])->name('updateRole');
                            Route::get('deleteRole', [RolePermissionController::class, 'deleteRole'])->name('deleteRole');
                            Route::get('deletePermission', [RolePermissionController::class, 'deletePermission'])->name('deleteRole');
                        // Opertional Role & Permission
                    });
                    
                // View Permission
                // Role & Permission
        
                //  User Access
                    // View Permission
                        Route::group(['middleware' => ['permission:view-userAccess']], function () {
                            Route::get('userAccess', [UserAccessController::class, 'index'])->name('userAccess');
                            // Operational User Access
                                Route::get('getRoleUser', [UserAccessController::class, 'getRoleUser'])->name('getRoleUser');
                                Route::post('addRoleUser', [UserAccessController::class, 'addRoleUser'])->name('addRoleUser');
                                Route::get('detailRoleUser', [UserAccessController::class, 'detailRoleUser'])->name('detailRoleUser');
                                Route::post('updateRoleUser', [UserAccessController::class, 'updateRoleUser'])->name('updateRoleUser');
                                Route::get('getRolePermissionDetail', [UserAccessController::class, 'getRolePermissionDetail'])->name('getRolePermissionDetail');
                                Route::post('saveRolePermission', [UserAccessController::class, 'saveRolePermission'])->name('saveRolePermission');
                                Route::get('destroyRolePermission', [UserAccessController::class, 'destroyRolePermission'])->name('destroyRolePermission');
                            // Operational User Access
                        });
                    // View Permission

                
                //  User Access

                
            //  Setting

            // Master
                // Master Location
                    // View Permission
                        Route::group(['middleware' => ['permission:view-masterLocation']], function () {
                            Route::get('masterLocation', [MasterLocationController::class, 'index'])->name('masterLocation');
                            // Operational Master Location
                                Route::post('updateMasterLocation', [MasterLocationController::class, 'updateMasterLocation'])->name('updateMasterLocation');
                            // Operational Master Location
                        });
                    // View Permission
                // Master Location

                // Master Division
                    // View Permission
                        Route::group(['middleware' => ['permission:view-masterDivision']], function () {
                            Route::get('masterDivision', [MasterDivisionController::class, 'index'])->name('masterDivision');
                            // Operation    
                                Route::post('addMasterDivision', [MasterDivisionController::class, 'addMasterDivision'])->name('addMasterDivision');
                                Route::post('updateMasterDivision', [MasterDivisionController::class, 'updateMasterDivision'])->name('updateMasterDivision');
                                Route::get('deleteMasterDivision', [MasterDivisionController::class, 'deleteMasterDivision'])->name('deleteMasterDivision');
                            // Operation
                        });
                        // View Permission
                // Master Division

                // Master Departement
                    // View Permission
                        Route::group(['middleware' => ['permission:view-masterDepartement']], function () {
                            Route::get('masterDepartement', [MasterDepartementController::class, 'index'])->name('masterDepartement');
                            // Opertaion
                                Route::post('updateMasterDepartement', [MasterDepartementController::class, 'updateMasterDepartement'])->name('updateMasterDepartement');
                                Route::post('addMasterDepartement', [MasterDepartementController::class, 'addMasterDepartement'])->name('addMasterDepartement');
                                Route::post('updateStatusMasterDepartement', [MasterDepartementController::class, 'updateStatusMasterDepartement'])->name('updateStatusMasterDepartement');
                            // Opertaion
                        });
                    // View Permission
                // Master Departement

                // Master Title
                    // View Permission
                        Route::group(['middleware' => ['permission:view-masterTitle']], function () {
                            Route::get('masterTitle', [MasterTitleController::class, 'index'])->name('masterTitle');
                            // Operation
                                Route::post('addMasterTitle', [MasterTitleController::class, 'addMasterTitle'])->name('addMasterTitle');
                                Route::post('updateMasterTitle', [MasterTitleController::class, 'updateMasterTitle'])->name('updateMasterTitle');
                                Route::post('updateStatusMasterTitle', [MasterTitleController::class, 'updateStatusMasterTitle'])->name('updateStatusMasterTitle');
                            // Operation
                        });
                    // View Permission
                // Master Title

                // Master ISO
                    // View Permission
                        Route::group(['middleware' => ['permission:view-masterIso']], function () {
                            Route::get('masterIso', [MasterISOController::class, 'index'])->name('masterIso');
                            // Operation
                                Route::post('addIso', [MasterISOController::class, 'addIso'])->name('addIso');
                                Route::post('updateIso', [MasterISOController::class, 'updateIso'])->name('updateIso');
                                Route::post('updateStatusIso', [MasterISOController::class, 'updateStatusIso'])->name('updateStatusIso');
                            // Operation
                        });
                    // View Permission
                // Master ISO
            // Master

            // Main Transaction
                // DigitalBook
                    // View Permission
                        Route::group(['middleware' => ['permission:view-digitalBook']], function () {
                            Route::get('digitalBook', [DigitalBookController::class, 'index'])->name('digitalBook');
                            // Operation
                                // Digital Book Header
                                    Route::post('updateStatusDigitalBookHeader', [DigitalBookController::class, 'updateStatusDigitalBookHeader'])->name('updateStatusDigitalBookHeader');   
                                    Route::post('addDigitalBookDetail', [DigitalBookController::class, 'addDigitalBookDetail'])->name('addDigitalBookDetail');   
                                    Route::post('addDigitalBookHeader', [DigitalBookController::class, 'addDigitalBookHeader'])->name('addDigitalBookHeader');   
                                    Route::post('updateDigitalBookPIC', [DigitalBookController::class, 'updateDigitalBookPIC'])->name('updateDigitalBookPIC');   
                                    Route::post('updateIndexDigitalBook', [DigitalBookController::class, 'updateIndexDigitalBook'])->name('updateIndexDigitalBook');   
                                    Route::post('updateDigitalBookDetail', [DigitalBookController::class, 'updateDigitalBookDetail'])->name('updateDigitalBookDetail');   
                                // Digital Book Header
                            // Operation
                        });
                    // View Permission
                // DigitalBook
                        
            // Main Transaction 

            // Master HSE Page
                Route::group(['middleware' => ['permission:view-masterHSEPage']], function () {
                    Route::get('masterHSEPage', [MasterHSEPageController::class, 'index'])->name('masterHSEPage');
                    // Operation
                        Route::get('getMasterHSE', [MasterHSEPageController::class, 'getMasterHSE'])->name('getMasterHSE');
                        Route::get('getClientMenus', [MasterHSEPageController::class, 'getClientMenus'])->name('getClientMenus');
                        Route::post('addHSEPage', [MasterHSEPageController::class, 'addHSEPage'])->name('addHSEPage');
                        Route::get('getClientSubmenus', [MasterHSEPageController::class, 'getClientSubmenus'])->name('getClientSubmenus');
                      
                    // Operation
                });
            // Master HSE Page
    });
// Admin
// Client
    Route::get('/', [ClientController::class, 'index'])->name('/');

    // Get Active Item
        Route::get('getRole', [RolePermissionController::class, 'getRole'])->name('getRole');
        Route::get('getPermission', [RolePermissionController::class, 'getPermission'])->name('getPermission');
        Route::get('getUser', [RolePermissionController::class, 'getUser'])->name('getUser');
        Route::get('getProvince', [MasterLocationController::class, 'getProvince'])->name('getProvince');
        Route::get('getRegion', [MasterLocationController::class, 'getRegion'])->name('getRegion');
        Route::get('getDistrict', [MasterLocationController::class, 'getDistrict'])->name('getDistrict');
        Route::get('getVillage', [MasterLocationController::class, 'getVillage'])->name('getVillage');
        Route::get('getPostalCode', [MasterLocationController::class, 'getPostalCode'])->name('getPostalCode');
        Route::get('getMasterDivision', [MasterDivisionController::class, 'getMasterDivision'])->name('getMasterDivision');
        Route::get('getMasterLocation', [MasterLocationController::class, 'getMasterLocation'])->name('getMasterLocation');
        Route::get('detailMasterDivision', [MasterDivisionController::class, 'detailMasterDivision'])->name('detailMasterDivision');
        Route::get('detailMasterLocation', [MasterLocationController::class, 'detailMasterLocation'])->name('detailMasterLocation');
        Route::get('detailMasterDepartement', [MasterDepartementController::class, 'detailMasterDepartement'])->name('detailMasterDepartement');
        Route::get('detailMasterTitle', [MasterTitleController::class, 'detailMasterTitle'])->name('detailMasterTitle');
        Route::get('getMasterTitle', [MasterTitleController::class, 'getMasterTitle'])->name('getMasterTitle');
        Route::get('getMasterDepartement', [MasterDepartementController::class, 'getMasterDepartement'])->name('getMasterDepartement');
        Route::get('DepartementByDiv', [MasterDepartementController::class, 'DepartementByDiv'])->name('DepartementByDiv');
        Route::get('getMasterIso', [MasterISOController::class, 'getMasterIso'])->name('getMasterIso');
        Route::get('detailMasterIso', [MasterISOController::class, 'detailMasterIso'])->name('detailMasterIso');
        Route::get('getDigitalBook', [DigitalBookController::class, 'getDigitalBook'])->name('getDigitalBook');
        Route::get('getDigitalBookDetail', [DigitalBookController::class, 'getDigitalBookDetail'])->name('getDigitalBookDetail');
        Route::get('getPICDigitalBook', [DigitalBookController::class, 'getPICDigitalBook'])->name('getPICDigitalBook');
        Route::get('detailDigitalBook', [DigitalBookController::class, 'detailDigitalBook'])->name('detailDigitalBook');
        Route::get('getDigitalBookLog', [DigitalBookController::class, 'getDigitalBookLog'])->name('getDigitalBookLog');
      
        Route::get('getDitialBookClient', [ClientController::class, 'getDitialBookClient'])->name('getDitialBookClient');
        // Get Active Item
        
        // Client Page
            Route::get('regulasiHealth', [RegulasiHealthController::class, 'index'])->name('regulasiHealth');
            Route::get('implementasiKesehatan', [RegulasiHealthController::class, 'index'])->name('implementasiKesehatan');
            Route::get('pelaporanHealth', [RegulasiHealthController::class, 'index'])->name('pelaporanHealth');
            Route::get('regulasiSafety', [RegulasiHealthController::class, 'index'])->name('regulasiSafety');
            Route::get('meetingBulanan', [RegulasiHealthController::class, 'index'])->name('meetingBulanan');
            Route::get('peralatanSafety', [RegulasiHealthController::class, 'index'])->name('peralatanSafety');
            Route::get('tanggapDarurat', [RegulasiHealthController::class, 'index'])->name('tanggapDarurat');
            Route::get('pelaporanTriwulan', [RegulasiHealthController::class, 'index'])->name('pelaporanTriwulan');
            Route::get('regulasiEnvironment', [RegulasiHealthController::class, 'index'])->name('regulasiEnvironment');
            Route::get('plb3', [RegulasiHealthController::class, 'index'])->name('plb3');
            Route::get('plcd', [RegulasiHealthController::class, 'index'])->name('plcd');
            Route::get('kedaruratan', [RegulasiHealthController::class, 'index'])->name('kedaruratan');
            Route::get('pelaporanEnvironment', [RegulasiHealthController::class, 'index'])->name('pelaporanEnvironment');
            Route::get('kecelakaanSafety', [RegulasiHealthController::class, 'index'])->name('kecelakaanSafety');
            Route::get('uklupl', [RegulasiHealthController::class, 'index'])->name('uklupl');
            Route::get('craneAbus2Ton', [RegulasiHealthController::class, 'index'])->name('craneAbus2Ton');
            Route::get('forklift', [RegulasiHealthController::class, 'index'])->name('forklift');
            Route::get('bejana', [RegulasiHealthController::class, 'index'])->name('bejana');
            Route::get('craneSemiGentri', [RegulasiHealthController::class, 'index'])->name('craneSemiGentri');
            Route::get('penyalur', [RegulasiHealthController::class, 'index'])->name('penyalur');
            Route::get('genset', [RegulasiHealthController::class, 'index'])->name('genset');
            Route::get('ahlik3Umum', [RegulasiHealthController::class, 'index'])->name('ahlik3Umum');
            Route::get('petugasP3K', [RegulasiHealthController::class, 'index'])->name('petugasP3K');
            Route::get('petugasDamkarKelasD', [RegulasiHealthController::class, 'index'])->name('petugasDamkarKelasD');
            Route::get('operatorForklift', [RegulasiHealthController::class, 'index'])->name('operatorForklift');
            Route::get('optOverHeadCrane', [RegulasiHealthController::class, 'index'])->name('optOverHeadCrane');
            Route::get('optOverHeadCrane', [RegulasiHealthController::class, 'index'])->name('optK3ElevatorEska');
            Route::get('optGenset', [RegulasiHealthController::class, 'index'])->name('optGenset');
            Route::get('optJuruLas', [RegulasiHealthController::class, 'index'])->name('optJuruLas');
            Route::get('neracaLimbah', [RegulasiHealthController::class, 'index'])->name('neracaLimbah');
            Route::get('craneAbus10Ton', [RegulasiHealthController::class, 'index'])->name('craneAbus10Ton');
            Route::get('craneEbuCrane', [RegulasiHealthController::class, 'index'])->name('craneEbuCrane');
            Route::get('craneEbuCrane5', [RegulasiHealthController::class, 'index'])->name('craneEbuCrane5');
            Route::get('lift', [RegulasiHealthController::class, 'index'])->name('lift');
            Route::get('neracaLimbahCair', [RegulasiHealthController::class, 'index'])->name('neracaLimbahCair');
        // Client Page


        Route::get('phpinfo', [RegulasiHealthController::class, 'phpinfo'])->name('phpinfo');
// Client

