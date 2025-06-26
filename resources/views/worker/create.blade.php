@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Add Worker</h1>
            <p class="text-gray-600 dark:text-gray-400">Create a new worker entry</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('worker.index') }}" class="btn btn-outline flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Workers
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card">
        <div class="card-header">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Worker Information</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('worker.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name" class="form-label">Name <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" 
                               class="form-input @error('name') border-red-500 @enderror" 
                               placeholder="Enter worker name" required>
                        @error('name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Unit -->
                    <div class="form-group">
                        <label for="unit" class="form-label">Unit <span class="text-red-500">*</span></label>
                        <input type="text" id="unit" name="unit" value="{{ old('unit') }}" 
                               class="form-input @error('unit') border-red-500 @enderror" 
                               placeholder="e.g., Person, Hour, Day" required>
                        @error('unit')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                        <label for="price" class="form-label">Price (Rp) <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 dark:text-gray-400">
                                Rp
                            </span>
                            <input type="number" id="price" name="price" value="{{ old('price') }}" 
                                   class="form-input pl-12 @error('price') border-red-500 @enderror" 
                                   placeholder="0" min="0" step="1000" required>
                        </div>
                        @error('price')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- TKDN -->
                    <div class="form-group">
                        <label for="tkdn" class="form-label">TKDN (%) <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="number" id="tkdn" name="tkdn" value="{{ old('tkdn') }}" 
                                   class="form-input pr-12 @error('tkdn') border-red-500 @enderror" 
                                   placeholder="0" min="0" max="100" step="0.01" required>
                            <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 dark:text-gray-400">
                                %
                            </span>
                        </div>
                        @error('tkdn')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('worker.index') }}" class="btn btn-outline">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Create Worker
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 