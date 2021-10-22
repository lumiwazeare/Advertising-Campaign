<?php


namespace App\Http\Requests;


use App\Services\ServiceResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;


abstract class BaseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules(): array;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize(): bool;

    /**
     * Handle a failed validation attempt.
     *
     * @param  Validator  $validator
     *
     * @return void
     */
    protected function failedValidation(Validator $validator): void
    {
        $serviceResponse = new ServiceResponse();
        $serviceResponse->message = "some error occurred";

        $serviceResponse->error = $validator->errors()->toArray();

        throw new HttpResponseException(response()->json($serviceResponse->toArray(),
            Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
