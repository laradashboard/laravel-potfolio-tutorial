@extends('frontend.portfolio.layouts.app')

@section('title', $project->name)

@section('meta_description', $project->summary)

@section('content')
    <!-- Project Header -->
    <section class="bg-gradient-to-r from-blue-500 to-indigo-600 dark:from-blue-700 dark:to-indigo-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center">
                <h1 class="text-4xl font-bold mb-4 text-center" data-aos="fade-up">{{ $project->name }}</h1>
                <p class="text-lg mb-6 text-blue-50 max-w-3xl text-center" data-aos="fade-up" data-aos-delay="100">
                    {{ $project->summary }}
                </p>
                <div class="flex flex-wrap justify-center gap-4" data-aos="fade-up" data-aos-delay="200">
                    @if($project->github_link)
                        <a href="{{ $project->github_link }}" target="_blank" rel="noopener noreferrer" class="btn-default bg-white text-blue-600 hover:bg-blue-50 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                            </svg>
                            {{ __('View on GitHub') }}
                        </a>
                    @endif
                    @if($project->demo_link)
                        <a href="{{ $project->demo_link }}" target="_blank" rel="noopener noreferrer" class="btn-primary flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            {{ __('Live Demo') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Project Details -->
    <section class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Project Image -->
                <div class="lg:col-span-2" data-aos="fade-right">
                    @if($project->image)
                        <div class="rounded-lg overflow-hidden shadow-lg">
                            <img src="{{ $project->image_url }}" alt="{{ $project->name }}" class="w-full h-auto">
                        </div>
                    @else
                        <div class="rounded-lg overflow-hidden shadow-lg bg-gray-200 dark:bg-gray-700 aspect-video flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Project Info -->
                <div data-aos="fade-left">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 shadow-md">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Project Details') }}</h2>

                        <div class="space-y-4">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Project Type') }}</h3>
                                <p class="mt-1 text-gray-900 dark:text-white">{{ __('Web Development') }}</p>
                            </div>

                            @if($project->github_link)
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('GitHub Repository') }}</h3>
                                    <p class="mt-1">
                                        <a href="{{ $project->github_link }}" target="_blank" rel="noopener noreferrer" class="text-blue-600 dark:text-blue-400 hover:underline">
                                            {{ Str::limit($project->github_link, 40) }}
                                        </a>
                                    </p>
                                </div>
                            @endif

                            @if($project->demo_link)
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Live Demo') }}</h3>
                                    <p class="mt-1">
                                        <a href="{{ $project->demo_link }}" target="_blank" rel="noopener noreferrer" class="text-blue-600 dark:text-blue-400 hover:underline">
                                            {{ Str::limit($project->demo_link, 40) }}
                                        </a>
                                    </p>
                                </div>
                            @endif

                            <div>
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Created') }}</h3>
                                <p class="mt-1 text-gray-900 dark:text-white">{{ $project->created_at->format('F Y') }}</p>
                            </div>

                            @if($project->featured)
                                <div class="pt-2">
                                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                        {{ __('Featured Project') }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project Description -->
            <div class="mt-12" data-aos="fade-up">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">{{ __('About This Project') }}</h2>
                <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300">
                    {!! nl2br(e($project->description)) !!}
                </div>
            </div>
        </div>
    </section>

    <!-- More Projects -->
    <section class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 text-center" data-aos="fade-up">{{ __('More Projects') }}</h2>

            <div class="text-center mt-8" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('portfolio.projects') }}" class="btn-primary">
                    {{ __('View All Projects') }}
                </a>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .btn-primary {
            @apply inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors;
        }
        .btn-default {
            @apply inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                once: true,
            });
        });
    </script>
@endpush
