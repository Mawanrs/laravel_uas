<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePenilaianRequest;
use App\Http\Requests\UpdatePenilaianRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\MassDestroyPenilaianRequest;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PenilaianController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('penilaian_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penilaian = Penilaian::with(['Media'])->get();

        return view('admin.penilaians.index', compact('penilaian'));
    }

    public function create()
    {
        abort_if(Gate::denies('penilaian_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.penilaians.create');
    }

    public function store(StorePenilaianRequest $request)
    {
    $penilaian = Penilaian::create($request->all());

    return redirect()->route('admin.penilaians.index');
    }
    public function edit(Penilaian $penilaian)
    {
        abort_if(Gate::denies('penilaian_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.penilaians.edit', compact('penilaian'));
    }

    public function update(UpdatePenilaianRequest $request, Penilaian $penilaian)
    {
    $penilaian->update($request->all());

    return redirect()->route('admin.penilaians.index');
    }

    public function show(Penilaian $penilaian)
    {
    abort_if(Gate::denies('penilaian_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $penilaian->load('tambah_siswaa');

    return view('admin.penilaians.show', compact('penilaian'));
    }

    public function destroy(Penilaian $penilaian)
    {
        abort_if(Gate::denies('penilaian_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penilaian->delete();

        return back();
    }

    public function massDestroy(MassDestroyPenilaianRequest $request)
    {
        $penilaians = Penilaian::find(request('ids'));

        foreach ($penilaians as $penilaian) {
            $penilaian->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}