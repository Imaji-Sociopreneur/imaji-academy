<?php

namespace App\Http\Livewire;

use App\Models\Testimonial;
use Livewire\Component;
use Livewire\WithFileUploads;

class TestimonialForm extends Component
{
    use WithFileUploads;

    public $action;
    public $data;
    public $dataId;
    public $file;
    public $author;
    public $testimonials;
    public $position;

    public function getRules()
    {
        if ($this->action == "update") {
            return [
                'data.author' => 'required|max:255',
                'data.testimonial' => 'required',
                'data.position' => 'required'
            ];
        } else {
            return [
                'data.author' => 'required|max:255',
                'data.testimonial' => 'required',
                'file' => 'required|image',
                'data.position' => 'required'
            ];
        }
    }

    public function mount()
    {
        $this->data['photo'] = '';

        if ($this->dataId) {
            $data = Testimonial::find($this->dataId);
            $this->data = [
                "testimonial" => $data->testimonial,
                "author" => $data->author,
                "position" => $data->position,
                "photo" => $data->photo
            ];
        }
//        dd($this->data);
    }

    public function create()
    {
        $this->resetErrorBag();
        $this->validate();

        if ($this->file->temporaryUrl() == null) {
            sleep(3);
            $this->create();
        }

        $this->data['photo'] = $this->data['author'] . '-' . $this->data['position'] . '.' . $this->file->getClientOriginalExtension();
        $this->file->storeAs('public/content', $this->data['photo']);

        Testimonial::create($this->data);

        $this->emit('swal:alert', [
            'icon' => 'success',
            'title' => 'Berhasil menambahkan testimonial',
        ]);

        $this->emit('redirect');

    }

    public function update()
    {
        $this->resetErrorBag();
        $this->validate();

        if ($this->file) {
            $this->data['photo'] = $this->data['author'] . '-' . $this->data['position'] .  '.' .$this->file->getClientOriginalExtension();
            $this->file->storeAs('public/content', $this->data['photo']);
        }


        Testimonial::query()
            ->where('id', $this->dataId)
            ->update($this->data);

        $this->emit('swal:alert', [
            'icon' => 'success',
            'title' => 'Berhasil mengubah testimonial',
        ]);

        $this->emit('redirect');

    }

    public function render()
    {
        return view('livewire.testimonial-form');
    }
}
