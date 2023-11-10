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
                        <table class="table">
                            <thead>
                                <tr>
                                    <td scope="col">ID</td>
                                    <td scope="col">Created</td>
                                    <td scope="col">Body</td>
                                    <td scope="col">Body</td>
                                    <td scope="col">Body</td>
                                    <td scope="col">Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>{{ $post->body }}</td>
                                    <td>
                                        <a href="{{ route('posts.edit', $post->id) }}" class="text-blue-500 hover:text-blue-700">Editar</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="post" onsubmit="return confirm('¿Seguro que quieres eliminar el archivo?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Borrar</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
@endsection
