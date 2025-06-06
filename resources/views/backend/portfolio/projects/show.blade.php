@extends('backend.layouts.app')

@section('title', $project->name)

@section('admin-content')
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">
                    {{ $project->name }}
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ __('Project Details') }}
                </p>
            </div>
            <div class="mt-4 sm:mt-0 flex space-x-3">
                @can('portfolio.edit')
                    <a href="{{ route('admin.portfolio.projects.edit', $project) }}" class="btn-default">
                        {{ __('Edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.portfolio.projects.index') }}" class="btn-default">
                    {{ __('Back to Projects') }}
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1">
                        @if($project->image)
                            <img src="{{ $project->image_url }}" alt="{{ $project->name }}" class="w-full h-auto rounded-lg shadow">
                        @else
                            <div class="w-full aspect-video bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif

                        <div class="mt-6 space-y-4">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Status') }}</h4>
                                <div class="mt-1">
                                    @if($project->featured)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                            {{ __('Featured') }}
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                            {{ __('Not Featured') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Display Order') }}</h4>
                                <p class="mt-1 text-gray-900 dark:text-white">{{ $project->order }}</p>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Links') }}</h4>
                                <div class="mt-1 space-y-2">
                                    @if($project->github_link)
                                        <a href="{{ $project->github_link }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline flex items-center">
                                            <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                            </svg>
                                            {{ __('GitHub Repository') }}
                                        </a>
                                    @endif
                                    @if($project->demo_link)
                                        <a href="{{ $project->demo_link }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline flex items-center">
                                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                            {{ __('Live Demo') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('Summary') }}</h3>
                                <p class="mt-1 text-gray-600 dark:text-gray-300">{{ $project->summary }}</p>
                            </div>

                            <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('Description') }}</h3>
                                <div class="mt-1 prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300">
                                    {!! nl2br(e($project->description)) !!}
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('Project Details') }}</h3>
                                <dl class="mt-2 grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Created') }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $project->created_at->format('M d, Y') }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Last Updated') }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $project->updated_at->format('M d, Y') }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Slug') }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $project->slug }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
