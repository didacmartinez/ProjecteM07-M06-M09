@extends('layouts.box-app')

@section('header')
    @include('layouts.navigation')
@endsection

@section('box-content')
   <!-- CABECERA -->
   <div class="bg-color-2 shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
         <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">
               Welcome to LeMa
            </h2>
         </div>
      </div>
   

   <!-- MAPA -->
      <div class="bg-color-2 w-full h-96">
         <iframe class="w-full h-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4055.3294164270333!2d1.7251339388206666!3d41.23102715693436!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a387b0453a3e91%3A0x3fd8003c6f9b646f!2sInstituto%20Joaquim%20Mir!5e0!3m2!1ses!2ses!4v1701813928009!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

   <!-- RESEÑAS -->
      <div class="bg-gray-100 py-8">
         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Reseñas</h3>
            <div class="flex space-x-4 overflow-x-auto">
               <!-- Tarjeta de reseña -->
               <div class="min-w-80 bg-white rounded-lg shadow p-4">
                  <!-- Contenido de la tarjeta -->
               </div>
               <!-- Repetir tarjetas de reseña según sea necesario -->
            </div>
         </div>
      </div>
   </div>
@endsection

