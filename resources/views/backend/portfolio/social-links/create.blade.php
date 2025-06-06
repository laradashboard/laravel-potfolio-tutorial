@extends('backend.layouts.app')

@section('title', __('Add Social Link'))

@section('admin-content')
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">
                    {{ __('Add Social Link') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ __('Add a new social media link to your portfolio.') }}
                </p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('admin.portfolio.social-links.index') }}" class="btn-default">
                    {{ __('Cancel') }}
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <form action="{{ route('admin.portfolio.social-links.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="platform" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Platform') }} <span class="text-red-500">*</span></label>
                        <select name="platform" id="platform" class="form-control" required>
                            <option value="">{{ __('Select Platform') }}</option>
                            @foreach($platforms as $key => $value)
                                <option value="{{ $key }}" {{ old('platform') == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('platform')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('URL') }} <span class="text-red-500">*</span></label>
                        <input type="url" name="url" id="url" value="{{ old('url') }}" class="form-control" required placeholder="https://example.com/username">
                        @error('url')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Custom Icon') }}</label>
                        <input type="file" name="icon" id="icon" class="form-control" accept="image/*">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Upload a custom icon for this social platform (optional).') }}</p>
                        @error('icon')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Display Order') }}</label>
                        <input type="number" name="order" id="order" value="{{ old('order', 0) }}" class="form-control" min="0">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Lower numbers will be displayed first.') }}</p>
                        @error('order')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="btn-primary">
                        {{ __('Save Social Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
