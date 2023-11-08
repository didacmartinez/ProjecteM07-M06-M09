<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
   {
       return view("files.index", [
           "files" => File::all()
       ]);
   }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
   {
       return view("files.create");
   }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
   {
       $validatedData = $request->validate([
        'upload' => 'required|mimes:gif,jpg,png|max:2048',
    ], [
        'upload.mimes' => 'Solo se admiten archivos de tipo jpg, gif, png.',
    ]);
      
       // Obtenir dades del fitxer
       $upload = $request->file('upload');
       $fileName = $upload->getClientOriginalName();
       $fileSize = $upload->getSize();
       \Log::debug("Storing file '{$fileName}' ($fileSize)...");

       $uploadName = time() . '_' . $fileName;
       $filePath = $upload->storeAs(
           'uploads',    
           $uploadName ,   
           'public'        
       );
      
       if (\Storage::disk('public')->exists($filePath)) {
           \Log::debug("Disk storage OK");
           $fullPath = \Storage::disk('public')->path($filePath);
           \Log::debug("File saved at {$fullPath}");
           $file = File::create([
               'filepath' => $filePath,
               'filesize' => $fileSize,
           ]);
           \Log::debug("DB storage OK");
           return redirect()->route('files.show', $file)
               ->with('success', 'File successfully saved');
       } else {
           \Log::debug("Disk storage FAILS");
           return redirect()->route("files.create")
               ->with('error', 'ERROR uploading file');
       }

   }

    
    /**
     * Display the specified resource.
     */
    public function show(File $file)
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
