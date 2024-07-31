<?php

namespace App\Http\Requests;

use App\Models\Penilaian;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPenilaianRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('penilaian_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:products,id',
        ];
    }
}
