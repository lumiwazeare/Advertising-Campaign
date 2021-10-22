<?php


namespace App\Services;


use App\Http\Requests\CreateCampaignRequest;
use App\Http\Requests\EditCampaignRequest;
use App\Models\Campaign;
use App\Models\CampaignImage;
use Illuminate\Support\Facades\Storage;

class CampaignService
{
    public function addCampaign(array $input, $file): ServiceResponse
    {
        $campaignModel = Campaign::create([
            'name' => $input['name'],
            'start_date' => $input['startDate'],
            'end_date' => $input['endDate'],
            'daily_budget' => $input['dailyBudget'],
            'total_budget' => $input['totalBudget'],
        ]);


        //attach each image to campaign
        foreach ($file as $image){
            CampaignImage::create([
                'campaign_id' => $campaignModel->id,
                'url' => $image->store('')
            ]);
        }

        $serviceResponse = new ServiceResponse();
        $serviceResponse->success = true;
        $serviceResponse->message = "campaign was created successfully";
        $serviceResponse->data = $campaignModel;

        return $serviceResponse;
    }

    public function editCampaign(array $input, $file): ServiceResponse
    {
        $serviceResponse = new ServiceResponse();
        $serviceResponse->message = "campaign does not exist";

        $campaignModel = Campaign::find($input['campaignId']);

        if(!$campaignModel){
            return $serviceResponse;
        }

        //patch the content
        $campaignModel->name = $input['name'] ?? $campaignModel->name;
        $campaignModel->start_date = $input['startDate'] ?? $campaignModel->start_date;
        $campaignModel->end_date = $input['endDate'] ?? $campaignModel->end_date;
        $campaignModel->daily_budget = $input['dailyBudget'] ?? $campaignModel->daily_budget;
        $campaignModel->total_budget = $input['totalBudget'] ?? $campaignModel->total_budget;

        //attach each image to campaign
        if($file){
            foreach ($file as $image) {
                CampaignImage::create([
                    'campaign_id' => $campaignModel->id,
                    'url' => $image->store('')
                ]);
            }
        }

        $campaignModel->save();

        $serviceResponse->success = true;
        $serviceResponse->message = "campaign was edited successfully";
        $serviceResponse->data = $campaignModel;

        return $serviceResponse;
    }

    public function getCampaigns(): ServiceResponse
    {
        $serviceResponse = new ServiceResponse();
        $serviceResponse->success = true;
        $serviceResponse->message = "";

        $campaignModels = Campaign::paginate(30);

        $data = [];
        //include images attached to this campaign
        foreach ($campaignModels as $model){

            $currentData = $model->toArray();
            $currentData['images'] = $model->images;

            array_push($data, $currentData);
        }

        $recordCollection = collect(['records' => $data]);

        $outputData = $recordCollection->merge($campaignModels);

        $outputData->pull('data');


        $serviceResponse->data = $outputData;


        return $serviceResponse;
    }

    public function removeCampaignImage(int $imageId): ServiceResponse
    {
        $serviceResponse = new ServiceResponse();
        $serviceResponse->message = "image not found";

        $campaignImage = CampaignImage::find($imageId);

        if(!$campaignImage){
            return $serviceResponse;
        }

        if(Storage::exists(Storage::delete($campaignImage->url))){
            Storage::delete($campaignImage->url);
        }

        $campaignImage->delete();

        $serviceResponse->success = true;
        $serviceResponse->message = "image was remove successfully";

        return $serviceResponse;
    }
}
