<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="{{$action}}">
        <div class="form-group col-span-6 sm:col-span-5">
            <label for="name">{{__('Author')}}</label>
            <input type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="data.author"
                   required/>
        </div>

        <div class="form-group col-span-6 sm:col-span-5" wire:ignore>
            <label for="name">{{__('Isi Testimonial')}}</label>
            <textarea type="text" input="description" id="summernote" class="form-control summernote" required>
                @isset($data['testimonial'])
                    {{$data['testimonial']}}
                    @endif
            </textarea>
        </div>

        <div class="form-group col-span-6 sm:col-span-5">
            <label for="name">{{__('Posisi')}}</label>
            <input type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="data.position"
                   required/>
        </div>

        <div class="form-group col-span-6 sm:col-span-5">
            <label for="name">{{__('Foto Author')}}</label>
            <input type="file" class="mt-1 block w-full form-control shadow-none" wire:model="file"
                {{$action=="update"?'':'required'}}/>
            <br>
            @if($file)
                <img src="{{$file->temporaryUrl()}}" alt="" style="max-height: 300px">
            @else
                @isset($this->data['photo'])
                <img src="{{ asset('storage/content/'.$this->data['photo']) }}" alt="" style="max-height: 300px">
                @endif
            @endif
        </div>

        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>

    </form>

    <script>

        document.addEventListener('livewire:load', function () {
            window.livewire.on('redirect', () => {
                setTimeout(function () {
                    window.location.href = "{{route('admin.testimonial.index')}}"; //will redirect to your data page (an ex: data.html)
                }, 2000); //will call the function after 2 secs.
            })

            $('#summernote').summernote({
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function (content, $editable) {
                    @this.set('data.testimonial', content);
                    }
                }
            });
        });
    </script>
</div>
