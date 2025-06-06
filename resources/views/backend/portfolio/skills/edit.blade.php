@extends('backend.layouts.app')

@section('title', __('Edit Skill'))

@section('admin-content')
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">
                    {{ __('Edit Skill') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ __('Update your portfolio skill.') }}
                </p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('admin.portfolio.skills.index') }}" class="btn-default">
                    {{ __('Cancel') }}
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <form action="{{ route('admin.portfolio.skills.update', $skill) }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $skill->name) }}" class="form-control" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="percentage" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Percentage') }}</label>
                        <div class="flex items-center">
                            <input type="range" name="percentage" id="percentage" min="0" max="100" value="{{ old('percentage', $skill->percentage) }}" class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer" oninput="updatePercentageValue(this.value)">
                            <span id="percentageValue" class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $skill->percentage }}%</span>
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
                        @if($skill->icon)
                            <div class="mt-2">
                                <img src="{{ $skill->icon_url }}" alt="{{ $skill->name }}" class="w-8 h-8 object-contain">
                            </div>
                        @endif
                    </div>

                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Display Order') }}</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $skill->order) }}" class="form-control" min="0">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Lower numbers will be displayed first.') }}</p>
                        @error('order')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="btn-primary">
                        {{ __('Update Skill') }}
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
