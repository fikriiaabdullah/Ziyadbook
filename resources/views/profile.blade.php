<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Profile Information Section -->
            <div class="p-6 bg-white shadow rounded-lg border-t-4 border-indigo-500">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Update Profile Information</h3>
                <div class="max-w-xl mx-auto">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <!-- Update Password Section -->
            <div class="p-6 bg-white shadow rounded-lg border-t-4 border-indigo-500">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Change Password</h3>
                <div class="max-w-xl mx-auto">
                    <livewire:profile.update-password-form />
                </div>
            </div>

            <!-- Delete Account Section -->
            <div class="p-6 bg-white shadow rounded-lg border-t-4 border-red-500">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Delete Account</h3>
                <div class="max-w-xl mx-auto">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
