@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Projects</h1>
            <p class="text-gray-600 dark:text-gray-400">Manage project information and data</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('master.project.create') }}" class="btn btn-primary flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Project
            </a>
        </div>
</div>

@if(session('success'))
    <div class="mb-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
@endif

    <!-- Project Table -->
    <div class="card">
        <div class="card-header">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Project List</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            </svg>
                    Click row to view details
                </p>
            </div>
    </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th class="text-center">Actions</th>
                </tr>
            </thead>
                    <tbody>
                        @forelse($projects as $project)
                        <tr class="cursor-pointer hover:bg-blue-100 dark:hover:bg-gray-600 transition-colors border-b border-gray-100 dark:border-gray-700" data-detail-url="{{ route('master.project.show', $project->id) }}" onclick="goToDetail(this, event)">
                            <td>{{ $loop->iteration + ($projects->firstItem() - 1) }}</td>
                            <td>
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900 dark:text-white">{{ $project->name }}</div>
                                        @if($project->description)
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ \App\Helpers\StringHelper::safeLimit($project->description, 40) }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-xs text-gray-700 dark:text-gray-200">{{ $project->location }}</span>
                            </td>
                            <td>
                                <span class="badge {{ $project->status == 'completed' ? 'badge-success' : ($project->status == 'on_progress' ? 'badge-primary' : 'badge-secondary') }}">
                                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                </span>
                            </td>
                            <td>
                                <span class="text-xs text-gray-700 dark:text-gray-200">{{ $project->start_date }}</span>
                            </td>
                            <td>
                                <span class="text-xs text-gray-700 dark:text-gray-200">{{ $project->end_date }}</span>
                            </td>
                            <td>
                                <div class="flex items-center justify-center space-x-2" onclick="event.stopPropagation()">
                                    <a href="{{ route('master.project.edit', $project) }}" class="btn btn-outline p-2 text-yellow-600 hover:text-yellow-700 dark:text-yellow-400 dark:hover:text-yellow-300" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                                    <form action="{{ route('master.project.destroy', $project) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus project ini?');">
                            @csrf
                            @method('DELETE')
                                        <button type="submit" class="btn btn-outline p-2 text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                                </div>
                    </td>
                </tr>
                @empty
                <tr>
                            <td colspan="5" class="text-center py-12">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Tidak ada project ditemukan</h3>
                                    <p class="text-gray-500 dark:text-gray-400 mb-4">Mulai dengan menambah project</p>
                                    <a href="{{ route('master.project.create') }}" class="btn btn-primary">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Tambah Project
                                    </a>
                                </div>
                            </td>
                </tr>
                @endforelse
            </tbody>
        </table>
            </div>
    </div>
    @if($projects->hasPages())
        {{ $projects->links('components.pagination') }}
    @endif
</div>
</div>

<script>
function goToDetail(element, event) {
    // Check if the click is on a button or link
    if (event.target.closest('button') || event.target.closest('a')) {
        return;
    }
    
    const detailUrl = element.getAttribute('data-detail-url');
    if (detailUrl) {
        window.location.href = detailUrl;
    }
}
</script>
@endsection 