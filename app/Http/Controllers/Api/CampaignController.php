<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCampaignRequest;
use App\Http\Requests\EditCampaignRequest;
use App\Services\CampaignService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    private CampaignService $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    public function addCampaign(CreateCampaignRequest $createCampaignRequest)
    {
        $result = $this->campaignService->addCampaign(
            $createCampaignRequest->validated(),
            $createCampaignRequest->file('images'));

        return response()->json($result->toArray());
    }

    public function editCampaign(EditCampaignRequest $editCampaignRequest)
    {
        $result = $this->campaignService->editCampaign(
            $editCampaignRequest->validated(),
            $editCampaignRequest->file('images'));

        $code = 200;

        if(!$result->success) $code = 400;

        return response()->json($result->toArray(),$code);
    }

    public function getCampaigns()
    {
        $result = $this->campaignService->getCampaigns();

        return response()->json($result->toArray());
    }

    public function removeCampaignImage(int $imageId)
    {
        $result = $this->campaignService->removeCampaignImage($imageId);

        $code = 200;

        if(!$result->success) $code = 400;

        return response()->json($result->toArray(),$code);
    }

    public function getCampaignImage(string $imageUrl)
    {
        if(!storage::exists($imageUrl)) {
            return response()->json([], 404);
        }

        return storage::download($imageUrl);
    }
}
