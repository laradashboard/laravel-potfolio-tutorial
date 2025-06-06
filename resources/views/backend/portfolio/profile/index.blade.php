@extends('backend.layouts.app')

@section('title', __('Profile'))

@section('admin-content')
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">
                    {{ __('Portfolio Profile') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ __('Manage your portfolio profile information.') }}
                </p>
            </div>
            <div class="mt-4 sm:mt-0">
                @can('portfolio.edit')
                    <a href="{{ route('admin.portfolio.profile.edit') }}" class="btn-primary">
                        {{ __('Edit Profile') }}
                    </a>
                @endcan
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <div class="p-6">
                @if ($profile)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-1">
                            <div class="flex flex-col items-center">
                                @if ($profile->profile_image)
                                    <img src="{{ $profile->profile_image_url }}" alt="{{ $profile->name }}" class="w-48 h-48 object-cover rounded-full mb-4">
                                @else
                                    <div class="w-48 h-48 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-24 h-24 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                @endif
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $profile->name }}</h3>
                                <p class="text-gray-500 dark:text-gray-400">{{ $profile->job_title }}</p>
                                <p class="text-gray-500 dark:text-gray-400">{{ $profile->location }}</p>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Email') }}</h4>
                                    <p class="mt-1 text-gray-900 dark:text-white">{{ $profile->email }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Phone') }}</h4>
                                    <p class="mt-1 text-gray-900 dark:text-white">{{ $profile->phone ?? __('Not provided') }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Bio') }}</h4>
                                    <p class="mt-1 text-gray-900 dark:text-white">{{ $profile->bio ?? __('Not provided') }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('CV') }}</h4>
                                    @if ($profile->cv_path)
                                        <div class="mt-1">
                                            <a href="{{ $profile->cv_url }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline flex items-center">
                                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                {{ __('View CV') }}
                                            </a>
                                        </div>
                                    @else
                                        <p class="mt-1 text-gray-900 dark:text-white">{{ __('No CV uploaded') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">{{ __('No profile found') }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Create a profile to showcase your information.') }}</p>
                        <div class="mt-6">
                            @can('portfolio.edit')
                                <a href="{{ route('admin.portfolio.profile.edit') }}" class="btn-primary">
                                    {{ __('Create Profile') }}
                                </a>
                            @endcan
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
