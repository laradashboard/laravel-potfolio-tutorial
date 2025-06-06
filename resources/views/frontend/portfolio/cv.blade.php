@extends('frontend.portfolio.layouts.app')

@section('title', __('CV'))

@section('meta_description', __('View my professional CV and resume.'))

@section('content')
    <!-- CV Header -->
    <section class="bg-gradient-to-r from-blue-500 to-indigo-600 dark:from-blue-700 dark:to-indigo-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-4" data-aos="fade-up">{{ __('Curriculum Vitae') }}</h1>
            <p class="text-lg mb-6 text-blue-50 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                {{ __('My professional background and qualifications') }}
            </p>
            @if($profile && $profile->cv_path)
                <a href="{{ $profile->cv_url }}" download class="btn-default bg-white text-blue-600 hover:bg-blue-50 inline-flex items-center" data-aos="fade-up" data-aos-delay="200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    {{ __('Download CV') }}
                </a>
            @endif
        </div>
    </section>

    <!-- CV Viewer -->
    <section class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($profile && $profile->cv_path)
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-lg overflow-hidden" data-aos="fade-up">
                    <div class="h-screen">
                        <iframe src="{{ $profile->cv_url }}" class="w-full h-full" frameborder="0"></iframe>
                    </div>
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">{{ __('CV not available') }}</h3>
                    <p class="mt-1 text-gray-500 dark:text-gray-400">{{ __('The CV is currently not available for viewing.') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Contact CTA Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6" data-aos="fade-up">{{ __('Interested in my skills?') }}</h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                {{ __("Let's discuss how I can contribute to your team or project.") }}
            </p>
            <a href="{{ route('portfolio.contact') }}" class="btn-primary" data-aos="fade-up" data-aos-delay="200">
                {{ __('Get in Touch') }}
            </a>
        </div>
    </section>
@endsection

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
