<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
   {
       return view("places.index", [
           "places" => File::all()
       ]);
   }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
   {
       return view("places.create");
   }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'upload' => 'required|mimes:gif,jpg,png|max:2048',
            'name' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ], [
            'upload.mimes' => 'Solo se admiten archivos de tipo jpg, gif, png.',
        ]);
    
        $filePath = $request->file('upload')->store('uploads', 'public');
    
        $file = File::create([
            'filepath' => $filePath,
            'filesize' => $request->file('upload')->getSize(),
        ]);
    
        $place = Place::create([
            'name' => $request->name,
            'description'=> $request->description,
            'file_id' => $file->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'author_id' => auth()->user()->id,
        ]);
    
        return redirect()->route('places.index')
            ->with('success', 'Post successfully saved');

    }
    /**
     * Display the specified resource.
     */
    public function show(Place $file)
{
    $filePath = $file->filepath;
    $fileExists = Storage::disk('public')->exists($filePath);

    if ($fileExists) {
        return view('files.show', compact('file', 'fileExists'));
    } else {
        return redirect()->route('files.index')->with('error', 'Aquest arxiu no existeix.');
    }
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
{
    return view('files.edit', compact('file'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
{
    // Validación de la solicitud
    $request->validate([
        'upload' => 'required|file|mimes:jpeg,png,gif|max:2048',
    ]);

    if ($request->hasFile('upload')) {
        Storage::delete($file->filepath);
        $newFilePath = $request->file('upload')->store('uploads', 'public');
        $file->update([
            'filepath' => $newFilePath,
            'filesize' => $request->file('upload')->getSize(),
        ]);
    }

    return redirect()->route('files.show', $file->id)->with('success', 'Archivo actualizado correctamente.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $file = File::findOrFail($id);
        try {
            Storage::delete($file->filepath);
            $file->delete();
            $message = 'Archivo borrado correctamente.';
            $redirectRoute = 'files.index';
        } catch (\Exception $e) {
            $message = 'No se ha podido eliminar el archivo.';
            $redirectRoute = 'files.show';
        }
    
        return redirect()->route($redirectRoute, $id)->with('success', $message);
    }
}

