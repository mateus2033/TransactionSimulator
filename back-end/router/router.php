<?php


use Pecee\SimpleRouter\SimpleRouter;
use Source\ClassLoader;
use Source\Controllers\AccountHolderController;
use Source\Controllers\AuthenticationController;
use Source\Controllers\LegalPersonController;
use Source\Controllers\PhysicalPersonController;

SimpleRouter::setCustomClassLoader(new ClassLoader());

$middlewares = [ \Source\Middlewares\JWTAuth::class];

SimpleRouter::group(['middleware' => $middlewares, 'prefix' => '/accountholder'], function () {
    SimpleRouter::post('/deposit',       [AccountHolderController::class, 'depositAccount']);
    SimpleRouter::post('/withdraw',      [AccountHolderController::class, 'withdrawAccount']);
    SimpleRouter::post('/transfer',      [AccountHolderController::class, 'transferAccount']);
    SimpleRouter::post('/historicList',  [AccountHolderController::class, 'historicList']);
    SimpleRouter::post('/list',          [AccountHolderController::class, 'accountHolderList']);
});

SimpleRouter::group(['prefix' => '/'], function () {
    SimpleRouter::post('/physicalPerson',[PhysicalPersonController::class, 'storagePhysicalAccount']);
    SimpleRouter::post('/legalPerson',   [LegalPersonController::class, 'storageLegalAccount']);
    SimpleRouter::post('/accountholder', [AccountHolderController::class, 'invalidToken']);
    SimpleRouter::post('/login', [AuthenticationController::class, 'login']);
});

SimpleRouter::get('/home', function() {
    return 'Hello world';
});


try {
    SimpleRouter::start();
} catch (\Throwable $th) {
    var_dump($th);
}