<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCampaignRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'campaignId' => ['required','numeric'],
            'name' => ['string'],
            'startDate' => ['date_format:Y-m-d'],
            'endDate' => ['date_format:Y-m-d'],
            'dailyBudget' => ['numeric'],
            'totalBudget' => ['numeric'],
            'images' => ['array'],
            'images.*' => ['image']
        ];
    }
}
