@extends('layouts.app')
@section('header')
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Files') }}
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
                              <td scope="col">Body:</td>
                              <td scope="col">File ID:</td>
                              <td scope="col">Latitud:</td>
                              <td scope="col">Longitud:</td>
                              <td scope="col">Author ID:</td>
                              <td scope="col">Created:</td>
                          </tr>
                      </thead>
                      <tbody>
                            @foreach ($posts as $post) 
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->body }}</td>
                                    <td>{{ $post->file_id }}</td>
                                    <td>{{ $post->latitude }}</td>
                                    <td>{{ $post->longitude }}</td>
                                    <td>{{ $post->author_id }}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>
                                        <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 hover:text-blue-700">Show</a>
                                    </td>
                                </tr>
                            @endforeach
                      </tbody>
                  </table>
               </div>
           </div>
       </div>
   </div>
@endsection