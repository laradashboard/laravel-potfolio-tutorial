@extends('frontend.portfolio.layouts.app')

@section('title', __('Projects'))

@section('meta_description', __('Browse my portfolio of projects and see my work in web development, design, and more.'))

@section('content')
    <!-- Projects Header -->
    <section class="bg-gradient-to-r from-blue-500 to-indigo-600 dark:from-blue-700 dark:to-indigo-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-4" data-aos="fade-up">{{ __('My Projects') }}</h1>
            <p class="text-lg mb-0 text-blue-50 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                {{ __('A collection of my work, personal projects, and experiments') }}
            </p>
        </div>
    </section>

    <!-- Projects Grid -->
    <section class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects as $project)
                    <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md transition-all hover:shadow-xl" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="relative h-48">
                            @if($project->image)
                                <img src="{{ $project->image_url }}" alt="{{ $project->name }}" class="w-full h-full object-cover">
                                @if($project->featured)
                                    <div class="absolute top-0 right-0 bg-blue-600 text-white text-xs font-bold px-2 py-1">
                                        {{ __('Featured') }}
                                    </div>
                                @endif
                            @else
                                <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                @if($project->featured)
                                    <div class="absolute top-0 right-0 bg-blue-600 text-white text-xs font-bold px-2 py-1">
                                        {{ __('Featured') }}
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ $project->name }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">{{ $project->summary }}</p>
                            <div class="flex justify-between items-center">
                                <a href="{{ route('portfolio.project', $project) }}" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">
                                    {{ __('View Details') }}
                                </a>
                                <div class="flex space-x-2">
                                    @if($project->github_link)
                                        <a href="{{ $project->github_link }}" target="_blank" rel="noopener noreferrer" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300" aria-label="GitHub">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    @endif
                                    @if($project->demo_link)
                                        <a href="{{ $project->demo_link }}" target="_blank" rel="noopener noreferrer" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300" aria-label="Live Demo">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">{{ __('No projects found') }}</h3>
                        <p class="mt-1 text-gray-500 dark:text-gray-400">{{ __('Check back later for updates.') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Contact CTA Section -->
    <section class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6" data-aos="fade-up">{{ __('Have a project in mind?') }}</h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                {{ __("I'm always open to discussing new projects, creative ideas or opportunities to be part of your vision.") }}
            </p>
            <a href="{{ route('portfolio.contact') }}" class="btn-primary" data-aos="fade-up" data-aos-delay="200">
                {{ __('Start a Conversation') }}
            </a>
        </div>
    </section>
@endsection

@push('styles')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .btn-primary {
            @apply inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
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
