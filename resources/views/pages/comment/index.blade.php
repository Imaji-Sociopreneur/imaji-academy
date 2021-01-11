<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Comment') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Comment</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.comment.index') }}">Data Comment</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="comment" :model="$comment" />
    </div>
</x-app-layout>
