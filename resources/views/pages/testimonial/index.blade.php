<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Testimonial') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Testimonial</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.testimonial.index') }}">Data Testimonial</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="testimonial" :model="$testimonial" />
    </div>
</x-app-layout>
