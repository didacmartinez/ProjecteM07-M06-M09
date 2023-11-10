@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
                
                <h2 class="text-2xl font-semibold mt-4">{{ __('Resources') }}</h2>

                <div class="flex mt-2">
                    <a href="{{ route('files.index') }}" class="bg-blue-500 text-white py-2 px-4 rounded mr-2">{{ __('Files') }}</a>
                    <a href="{{ route('files.create') }}" class="bg-green-500 text-white py-2 px-4 rounded">{{ __('Create') }}</a>
                    <a href="{{ route('places.index') }}" class="bg-green-500 text-white py-2 px-4 rounded">{{ __('Places') }}</a>
                    <a href="{{ route('posts.index') }}" class="bg-red-500 text-white py-2 px-4 rounded mr-2">{{ __('Posts') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
