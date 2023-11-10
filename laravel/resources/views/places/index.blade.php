@extends('layouts.app')
@section('header')
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Places') }}
       </h2>
   @endsection  
    @section('content')
    <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 bg-white border-b border-gray-200">
                   <table class="table">
                      <thead>
                 
                           <!-- modificado-->
                              <td scope="col">ID</td>
                              <td scope="col">Name</td>
                              <td scope="col">Description</td>
                              <td scope="col">File</td>
                              <td scope="col">Latitude</td>
                              <td scope="col">Longitude</td>
                              <td scope="col">Created</td>
                              <td scope="col">Updated</td>
                              <td scope="col">Show</td>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($places as $place)
                          <tr>
                              <td>{{ $place->id }}</td>
                              <td class="w-1/4 p-2"><img class="img-fluid w-7/10" src='{{ asset("storage/{$place->filepath}") }}' /></td>
                              <td>{{ $place->name }}</td>
                              <td>{{ $place->description }}</td>
                              <td>{{ $place->latitude }}</td>
                              <td>{{ $place->longitude }}</td>
                              <td>{{ $place->created_at }}</td>
                              <td>{{ $place->updated_at }}</td>
                              <td>
                                <a href="{{ route('places.show', $place->id) }}" class="text-blue-500 hover:text-blue-700">Show</a>
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