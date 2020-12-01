<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('List Blog') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Blog</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Buat Blog Baru</a></div>
        </div>
    </x-slot>


</x-app-layout>
    
