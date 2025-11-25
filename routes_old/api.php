<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\StateController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\DivisionController;
use App\Http\Controllers\API\DistrictController;
use App\Http\Controllers\API\UpazilaController;
use App\Http\Controllers\API\UnionController;

Route::apiResource('countries', CountryController::class);
Route::get('countries/{id}/states', [CountryController::class, 'states']);
Route::get('countries/{id}/cities', [CountryController::class, 'cities']);

Route::apiResource('states', StateController::class);

Route::apiResource('cities', CityController::class);

Route::apiResource('divisions', DivisionController::class);
Route::get('divisions/{id}/districts', [DivisionController::class, 'districts']);

Route::apiResource('districts', DistrictController::class);
Route::get('districts/{id}/upazilas', [DistrictController::class, 'upazilas']);

Route::apiResource('upazilas', UpazilaController::class);
Route::get('upazilas/{id}/unions', [UpazilaController::class, 'unions']);

Route::apiResource('unions', UnionController::class);
