<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCampaignRequest extends BaseRequest
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
            'name' => ['string','required'],
            'startDate' => ['date_format:Y-m-d','required'],
            'endDate' => ['date_format:Y-m-d','required'],
            'dailyBudget' => ['numeric','required'],
            'totalBudget' => ['numeric','required'],
            'images' => ['required','array'],
            'images.*' => ['image']

        ];
    }
}
