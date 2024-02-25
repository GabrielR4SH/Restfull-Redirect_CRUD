<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Http;
use Hashids\Hashids;


class RedirectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'url_destino' => [
                'required',
                'url',
                'regex:/^https:\/\/.*/',
                function ($attribute, $value, $fail) {
                    $response = Http::get($value);
                    if ($response->status() !== 200) {
                        $fail('A URL de destino deve retornar um status 200.');
                    }
                },
                function ($attribute, $value, $fail) {
                    $url = parse_url($value);
                    if ($url['host'] === request()->getHost()) {
                        $fail('A URL de destino não pode apontar para a própria aplicação.');
                    }
                },
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $hashids = new Hashids();
        $this->merge(['code' => $hashids->encode(uniqid())]);
    }



}
