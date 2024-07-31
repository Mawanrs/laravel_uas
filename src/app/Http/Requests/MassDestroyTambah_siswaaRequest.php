<?php

namespace App\Http\Requests;

use App\Models\Tambah_siswaa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTambah_siswaaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tambah_siswaa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
