@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('File Details') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($fileExists)
                        <table class="table">
                            <thead>
                                <tr>
                                    <td scope="col">ID</td>
                                    <td scope="col">Filepath</td>
                                    <td scope="col">Filesize</td>
                                    <td scope="col">Created</td>
                                    <td scope="col">Updated</td>
                                    <td scope="col">Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $file->id }}</td>
                                    <td class="w-1/4 p-2"><img class="img-fluid w-7/10" src='{{ asset("storage/{$file->filepath}") }}' /></td>
                                    <td>{{ $file->filesize }}</td>
                                    <td>{{ $file->created_at }}</td>
                                    <td>{{ $file->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('files.edit', $file->id) }}" class="text-blue-500 hover:text-blue-700">Editar</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('files.destroy', $file->id) }}" method="post" onsubmit="return confirm('¿Seguro que quieres eliminar el archivo?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Borrar</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <p>Aquest arxiu no existeix.</p>
                        <a href="{{ route('files.show') }}" class="btn btn-primary">Tornar a la llista</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
