@extends('frontend.portfolio.layouts.app')

@section('title', __('Home'))

@section('meta_description', $profile->bio ?? __('Personal Portfolio Website'))

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-500 to-indigo-600 dark:from-blue-700 dark:to-indigo-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl sm:text-5xl font-bold mb-4" data-aos="fade-up">
                        {{ __("Hi, I'm") }} {{ $profile->name ?? 'John Doe' }}
                    </h1>
                    <h2 class="text-2xl sm:text-3xl font-medium mb-6 text-blue-100" data-aos="fade-up" data-aos-delay="100">
                        {{ $profile->job_title ?? __('Full-Stack Developer') }}
                    </h2>
                    <p class="text-lg mb-8 text-blue-50 max-w-lg" data-aos="fade-up" data-aos-delay="200">
                        {{ $profile->bio ?? __('A passionate developer with expertise in web development, creating modern and responsive applications.') }}
                    </p>
                    <div class="flex flex-wrap gap-4" data-aos="fade-up" data-aos-delay="300">
                        <a href="{{ route('portfolio.projects') }}" class="btn-primary">
                            {{ __('View Projects') }}
                        </a>
                        <a href="{{ route('portfolio.contact') }}" class="btn-default">
                            {{ __('Contact Me') }}
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center" data-aos="fade-left">
                    @if(isset($profile) && $profile->profile_image)
                        <img src="{{ $profile->profile_image_url }}" alt="{{ $profile->name }}" class="rounded-full w-64 h-64 object-cover border-4 border-white shadow-lg">
                    @else
                        <div class="rounded-full w-64 h-64 bg-blue-400 dark:bg-blue-600 flex items-center justify-center border-4 border-white shadow-lg">
                            <svg class="w-32 h-32 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white" data-aos="fade-up">
                    {{ __('My Skills') }}
                </h2>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-300" data-aos="fade-up" data-aos-delay="100">
                    {{ __('Technologies and tools I work with') }}
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($skills as $skill)
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 shadow-md transition-transform hover:scale-105" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="flex items-center mb-4">
                            @if($skill->icon)
                                <img src="{{ $skill->icon_url }}" alt="{{ $skill->name }}" class="w-8 h-8 mr-3">
                            @endif
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $skill->name }}</h3>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $skill->percentage }}%"></div>
                        </div>
                        <div class="mt-2 text-right text-sm text-gray-600 dark:text-gray-300">{{ $skill->percentage }}%</div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-8 text-gray-500 dark:text-gray-400">
                        {{ __('No skills found.') }}
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Featured Projects Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white" data-aos="fade-up">
                    {{ __('Featured Projects') }}
                </h2>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-300" data-aos="fade-up" data-aos-delay="100">
                    {{ __('Some of my recent work') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($featuredProjects as $project)
                    <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md transition-all hover:shadow-xl" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="relative h-48">
                            @if($project->image)
                                <img src="{{ $project->image_url }}" alt="{{ $project->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
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
                                        <a href="{{ $project->github_link }}" target="_blank" rel="noopener noreferrer" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    @endif
                                    @if($project->demo_link)
                                        <a href="{{ $project->demo_link }}" target="_blank" rel="noopener noreferrer" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
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
                    <div class="col-span-full text-center py-8 text-gray-500 dark:text-gray-400">
                        {{ __('No featured projects found.') }}
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('portfolio.projects') }}" class="btn-primary">
                    {{ __('View All Projects') }}
                </a>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white" data-aos="fade-up">
                    {{ __('Work Experience') }}
                </h2>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-300" data-aos="fade-up" data-aos-delay="100">
                    {{ __('My professional journey') }}
                </p>
            </div>

            <div class="relative">
                <!-- Timeline Line -->
                <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 h-full w-0.5 bg-gray-200 dark:bg-gray-700"></div>

                <div class="space-y-12">
                    @forelse($experiences as $experience)
                        <div class="relative" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <!-- Timeline Dot -->
                            <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 -translate-y-4 w-4 h-4 rounded-full bg-blue-600"></div>

                            <div class="md:flex items-center">
                                <!-- Left Side (Date) -->
                                <div class="md:w-1/2 mb-4 md:mb-0 md:pr-8 md:text-right">
                                    <span class="text-sm font-semibold text-blue-600 dark:text-blue-400">{{ $experience->duration }}</span>
                                </div>

                                <!-- Right Side (Content) -->
                                <div class="md:w-1/2 md:pl-8">
                                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md">
                                        <div class="flex items-center mb-4">
                                            @if($experience->company_logo)
                                                <img src="{{ $experience->company_logo_url }}" alt="{{ $experience->company_name }}" class="w-12 h-12 object-contain mr-4">
                                            @endif
                                            <div>
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $experience->role }}</h3>
                                                <div class="text-gray-600 dark:text-gray-300">
                                                    @if($experience->company_website)
                                                        <a href="{{ $experience->company_website }}" target="_blank" rel="noopener noreferrer" class="hover:underline">
                                                            {{ $experience->company_name }}
                                                        </a>
                                                    @else
                                                        {{ $experience->company_name }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-gray-600 dark:text-gray-300">{{ $experience->summary }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                            {{ __('No experience found.') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA Section -->
    <section class="py-16 bg-gradient-to-r from-blue-500 to-indigo-600 dark:from-blue-700 dark:to-indigo-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-6" data-aos="fade-up">{{ __('Interested in working together?') }}</h2>
            <p class="text-lg mb-8 text-blue-50 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                {{ __("Let's discuss your project and see how I can help you bring your ideas to life.") }}
            </p>
            <a href="{{ route('portfolio.contact') }}" class="btn-primary bg-white text-blue-600 hover:bg-blue-50" data-aos="fade-up" data-aos-delay="200">
                {{ __('Get in Touch') }}
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
        .btn-default {
            @apply inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors;
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
