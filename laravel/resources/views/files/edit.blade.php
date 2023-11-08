@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit File') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('files.update', $file->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <p>File ID: {{ $file->id }}</p>
                            <img class="img-fluid w-60 h-auto" src='{{ asset("storage/{$file->filepath}") }}' />
                        <p>Filesize: {{ $file->filesize }}</p>
                        <div class="mt-4">
                            <label for="upload" class="block text-gray-600 text-sm font-semibold mb-2">Subir nuevo archivo:</label>
                            <input type="file" name="upload" id="upload" class="form-input">
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-green-500 text-black py-2 px-4 rounded">Subir archivo</button>
                        </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection