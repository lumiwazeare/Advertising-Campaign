<?php

use App\Http\Controllers\Api\CampaignController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('campaign/add', [CampaignController::class, 'addCampaign']); //form data
Route::post('campaign', [CampaignController::class, 'editCampaign']); //form data
Route::get('campaigns', [CampaignController::class, 'getCampaigns']);
Route::delete('campaign/image/{imageId}', [CampaignController::class, 'removeCampaignImage']);

Route::get('campaign/image/{imageUrl}', [CampaignController::class, 'getCampaignImage']);
