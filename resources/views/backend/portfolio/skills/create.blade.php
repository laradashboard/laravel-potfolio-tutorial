@extends('backend.layouts.app')

@section('title', __('Add Skill'))

@section('admin-content')
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">
                    {{ __('Add Skill') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ __('Add a new skill to your portfolio.') }}
                </p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('admin.portfolio.skills.index') }}" class="btn-default">
                    {{ __('Cancel') }}
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <form action="{{ route('admin.portfolio.skills.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="percentage" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Percentage') }}</label>
                        <div class="flex items-center">
                            <input type="range" name="percentage" id="percentage" min="0" max="100" value="{{ old('percentage', 75) }}" class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer" oninput="updatePercentageValue(this.value)">
                            <span id="percentageValue" class="ml-2 text-sm text-gray-700 dark:text-gray-300">75%</span>
                        </div>
                        @error('percentage')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Icon') }}</label>
                        <input type="file" name="icon" id="icon" class="form-control" accept="image/*">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Upload a small icon representing this skill (SVG, PNG, or JPG).') }}</p>
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
                        {{ __('Save Skill') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updatePercentageValue(value) {
            document.getElementById('percentageValue').textContent = value + '%';
        }

        // Initialize the percentage value
        document.addEventListener('DOMContentLoaded', function() {
            updatePercentageValue(document.getElementById('percentage').value);
        });
    </script>
@endsection
