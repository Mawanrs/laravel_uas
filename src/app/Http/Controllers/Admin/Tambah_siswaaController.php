<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Tambah_siswaa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTambah_siswaaRequest;
use App\Http\Requests\UpdateTambah_siswaaRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\MassDestroyTambah_siswaaRequest;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Tambah_siswaaController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('tambah_siswaa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tambah_siswaas = Tambah_siswaa::with(['media'])->get();

        return view('admin.tambah_siswaa.index', compact('tambah_siswaas'));
    }

    public function create()
    {
        abort_if(Gate::denies('tambah_siswaa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tambah_siswaa.create');
    }

    public function store(StoreTambah_siswaaRequest $request)
    {
        $tambah_siswaa = Tambah_siswaa::create($request->all());

        return redirect()->route('admin.tambah_siswaa.index');
    }

    public function edit(Tambah_siswaa $tambah_siswaa)
    {
        abort_if(Gate::denies('tambah_siswaa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tambah_siswaa.edit', compact('tambah_siswaa'));
    }

    public function update(UpdateTambah_siswaaRequest $request, Tambah_siswaa $tambah_siswaa)
    {
        $tambah_siswaa->update($request->all());

        return redirect()->route('admin.tambah_siswaa.index');
    }

    public function show(Tambah_siswaa $tambah_siswaa)
    {
        abort_if(Gate::denies('tambah_siswaa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tambah_siswaa.show', compact('tambah_siswaa'));
    }

    public function destroy(Tambah_siswaa $tambah_siswaa)
    {
        abort_if(Gate::denies('tambah_siswaa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tambah_siswaa->delete();

        return back();
    }

    public function massDestroy(MassDestroyTambah_siswaaRequest $request)
    {
        $tambah_siswaas = Tambah_siswaa::find(request('ids'));

        foreach ($tambah_siswaas as $tambah_siswaa) {
            $tambah_siswaa->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

}