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

    public function excludeExtraImage()
    {

    }

    public function restoreExtraImage()
    {

    }
}
