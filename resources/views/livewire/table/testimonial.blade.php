<div>
    <x-data-table :data="$data" :model="$testimonials">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                        ID
                        @include('components.sort-icon', ['field' => 'id'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('title')" role="button" href="#">
                        Author
                        @include('components.sort-icon', ['field' => 'author'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('content_id')" role="button" href="#">
                        Posisi
                        @include('components.sort-icon', ['field' => 'position'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Tanggal Dibuat
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($testimonials as $testimonial)
                <tr x-data="window.__controller.dataTableController({{ $testimonial->id }})">
                    <td>{{ $testimonial->id }}</td>
                    <td>{{ $testimonial->author }}</td>
                    <td>{{ $testimonial->position }}</td>
                    <td>{{ $testimonial->created_at->format('d M Y H:i') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="{{request()->segment(2)}}/{{$testimonial->id }}/edit" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
