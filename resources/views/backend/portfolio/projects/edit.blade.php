@extends('backend.layouts.app')

@section('title', __('Edit Project'))

@section('admin-content')
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">
                    {{ __('Edit Project') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ __('Update your portfolio project.') }}
                </p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('admin.portfolio.projects.index') }}" class="btn-default">
                    {{ __('Cancel') }}
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <form action="{{ route('admin.portfolio.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}" class="form-control" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Slug') }}</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $project->slug) }}" class="form-control">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Leave empty to generate automatically from name.') }}</p>
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="summary" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Summary') }}</label>
                        <textarea name="summary" id="summary" rows="2" class="form-control">{{ old('summary', $project->summary) }}</textarea>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('A brief summary of the project.') }}</p>
                        @error('summary')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Description') }}</label>
                        <textarea name="description" id="description" rows="6" class="form-control">{{ old('description', $project->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Project Image') }}</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Upload a screenshot or image representing this project.') }}</p>
                        @error('image')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        @if($project->image)
                            <div class="mt-2">
                                <img src="{{ $project->image_url }}" alt="{{ $project->name }}" class="w-32 h-24 object-cover rounded">
                            </div>
                        @endif
                    </div>

                    <div>
                        <label for="github_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('GitHub Link') }}</label>
                        <input type="url" name="github_link" id="github_link" value="{{ old('github_link', $project->github_link) }}" class="form-control" placeholder="https://github.com/username/project">
                        @error('github_link')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="demo_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Demo Link') }}</label>
                        <input type="url" name="demo_link" id="demo_link" value="{{ old('demo_link', $project->demo_link) }}" class="form-control" placeholder="https://example.com">
                        @error('demo_link')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Display Order') }}</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $project->order) }}" class="form-control" min="0">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Lower numbers will be displayed first.') }}</p>
                        @error('order')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex items-center">
                            <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $project->featured) ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="featured" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">{{ __('Featured Project') }}</label>
                        </div>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Featured projects will be highlighted on your portfolio homepage.') }}</p>
                        @error('featured')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="btn-primary">
                        {{ __('Update Project') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
