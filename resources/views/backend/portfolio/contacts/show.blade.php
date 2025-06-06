@extends('backend.layouts.app')

@section('title', __('View Message'))

@section('admin-content')
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">
                    {{ __('Message from') }} {{ $contact->name }}
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ $contact->created_at->format('F j, Y \a\t g:i a') }}
                </p>
            </div>
            <div class="mt-4 sm:mt-0 flex space-x-3">
                <a href="mailto:{{ $contact->email }}" class="btn-default">
                    {{ __('Reply') }}
                </a>
                <a href="{{ route('admin.portfolio.contacts.index') }}" class="btn-default">
                    {{ __('Back to Messages') }}
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1">
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('Contact Details') }}</h3>

                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Name') }}</h4>
                                    <p class="mt-1 text-gray-900 dark:text-white">{{ $contact->name }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Email') }}</h4>
                                    <p class="mt-1">
                                        <a href="mailto:{{ $contact->email }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                            {{ $contact->email }}
                                        </a>
                                    </p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Received') }}</h4>
                                    <p class="mt-1 text-gray-900 dark:text-white">{{ $contact->created_at->format('M d, Y H:i') }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Status') }}</h4>
                                    <p class="mt-1">
                                        @if($contact->read)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                                {{ __('Read') }} {{ $contact->read_at ? '(' . $contact->read_at->format('M d, Y H:i') . ')' : '' }}
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                                {{ __('Unread') }}
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            @can('portfolio.delete')
                                <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-600">
                                    <form action="{{ route('admin.portfolio.contacts.destroy', $contact) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300" onclick="return confirm('{{ __('Are you sure you want to delete this message?') }}')">
                                            {{ __('Delete Message') }}
                                        </button>
                                    </form>
                                </div>
                            @endcan
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                                {{ $contact->subject ?? __('No Subject') }}
                            </h3>

                            <div class="mt-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                                <div class="prose dark:prose-invert max-w-none">
                                    {!! nl2br(e($contact->message)) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
