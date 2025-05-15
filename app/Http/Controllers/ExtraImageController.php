<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ExtraImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExtraImageController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function storeExtraImage(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();
        try
        {
            $newImage = new ExtraImage(['title' => $request->title]);
            $newImage->save();
            if($request->hasFile('file'))
            {
                $newImage
                   ->addMedia($request->file('file'))
                   ->toMediaCollection('images');
            }

            DB::commit();

            return redirect()->back()->with('success', 'Caricamento di un immagine con successo');
        }catch(\Throwable $e)
        {
            Log::info("Impossibile caricare un immagine", [$e]);
            DB::rollback();

            return redirect()->back()->with('error', 'Impossibile caricare immagine');
        }
    }

    public function excludeExtraImage(ExtraImage $extraImage)
    {
        try{
            $extraImage->delete();

            return redirect()->back()->with('success', 'Immagine esclusa con successo');
        }catch(\Throwable $e)
        {
            Log::error('errore softDelete immagine', [$e]);
            return redirect()->back()->with('error', 'Impossibile escludere immagine');
        }
    }

    public function restoreExtraImage($extraImage)
    {
        try{
            $extraImage = ExtraImage::onlyTrashed()
                ->where('id', $extraImage)->firstOrFail();

            $extraImage->restore();

            return redirect()->back()->with('success', 'Restore immagine con successo');
        }catch(\Throwable $e)
        {
            Log::error('errore softDelete immagine', [$e]);
            return redirect()->back()->with('error', 'Impossibile fare restore immagine');
        }
    }

    public function filter(Request $request)
    {
        $validate = $request->validate([
            'search' => 'nullable|string',
            'sort' => 'required|string',
            'is_deleted' => 'nullable',
        ]);

        $query = ExtraImage::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->sort === 'date') {
            $query->orderBy('created_at', 'desc');
        } elseif($request->sort === 'title') {
            $query->orderBy('title');
        }

        if ($request->boolean('is_deleted')) {
            $query->onlyTrashed();
        }

        $images = $query->get();

        return view('home', ['images' => $images]);
    }
}
