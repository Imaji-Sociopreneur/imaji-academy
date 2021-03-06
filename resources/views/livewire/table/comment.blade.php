<div>
    <x-data-table :data="$data" :model="$comments">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                        ID
                        @include('components.sort-icon', ['field' => 'id'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('title')" role="button" href="#">
                        Comment
                        @include('components.sort-icon', ['field' => 'comment'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('title')" role="button" href="#">
                        Penulis
                        @include('components.sort-icon', ['field' => 'comment'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Tanggal Dibuat
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($comments as $comment)
                <tr x-data="window.__controller.dataTableController({{ $comment->id }})">
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->comment }}</td>
                    <td>{{ $comment->name }}</td>
                    <td>{{ $comment->created_at->format('d M Y H:i') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
