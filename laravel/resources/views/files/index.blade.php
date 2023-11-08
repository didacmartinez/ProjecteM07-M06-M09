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
                              <td scope="col">Filepath</td>
                              <td scope="col">Filesize</td>
                              <td scope="col">Created</td>
                              <td scope="col">Updated</td>
                              <td scope="col">Show</td>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($files as $file)
                          <tr>
                              <td>{{ $file->id }}</td>
                              <td class="w-1/4 p-2"><img class="img-fluid w-7/10" src='{{ asset("storage/{$file->filepath}") }}' /></td>
                              <td>{{ $file->filesize }}</td>
                              <td>{{ $file->created_at }}</td>
                              <td>{{ $file->updated_at }}</td>
                              <td>
                                <a href="{{ route('files.show', $file->id) }}" class="text-blue-500 hover:text-blue-700">Show</a>
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