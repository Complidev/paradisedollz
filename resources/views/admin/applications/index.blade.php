<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Applications') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="rounded-md bg-green-50 p-4 text-sm text-green-800">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="rounded-md bg-red-50 p-4 text-sm text-red-800">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <tr>
                            <th class="px-6 py-3">{{ __('Applicant') }}</th>
                            <th class="px-6 py-3">{{ __('Status') }}</th>
                            <th class="px-6 py-3">{{ __('Submitted') }}</th>
                            <th class="px-6 py-3 text-right">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($applications as $application)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $application->name }}</div>
                                    <div class="text-gray-500">{{ $application->email }}</div>
                                    @if ($application->experience_level)
                                        <div class="text-xs text-gray-400 mt-1">{{ __('Experience') }}: {{ $application->experience_level }}</div>
                                    @endif
                                    @if ($application->social_handle)
                                        <div class="text-xs text-gray-400">{{ __('Social') }}: {{ $application->social_handle }}</div>
                                    @endif
                                    @if ($application->age_confirmed)
                                        <div class="text-xs text-gray-400">{{ __('18+ confirmed') }}</div>
                                    @endif
                                    @if ($application->phone)
                                        <div class="text-gray-500">{{ $application->phone }}</div>
                                    @endif
                                    @if ($application->message)
                                        <p class="mt-2 whitespace-pre-line text-gray-600">{{ $application->message }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 capitalize">{{ __($application->status) }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $application->created_at->toFormattedDateString() }}</td>
                                <td class="px-6 py-4 text-right space-y-2">
                                    @if ($application->status === \App\Models\ModelApplication::STATUS_PENDING)
                                        <form method="POST" action="{{ route('admin.applications.approve', $application) }}" class="inline">
                                            @csrf
                                            <x-secondary-button type="submit">{{ __('Approve') }}</x-secondary-button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.applications.reject', $application) }}" class="inline">
                                            @csrf
                                            <x-danger-button type="submit">{{ __('Reject') }}</x-danger-button>
                                        </form>
                                    @elseif ($application->reviewer)
                                        <div class="text-xs text-gray-500">{{ __('Reviewed by :name', ['name' => $application->reviewer->name]) }}</div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">{{ __('No applications yet.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-2">{{ $applications->links() }}</div>
        </div>
    </div>
</x-admin-layout>
