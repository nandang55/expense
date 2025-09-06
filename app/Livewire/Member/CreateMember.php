<?php

namespace App\Livewire\Member;

use App\Models\Member;
use Livewire\Component;

class CreateMember extends Component
{
    public $nik = '';
    public $name = '';
    public $place_of_birth = '';
    public $date_of_birth = '';
    public $gender = '';
    public $address = '';
    public $rt = '';
    public $rw = '';
    public $village = '';
    public $subdistrict = '';
    public $city = '';
    public $province = '';
    public $postal_code = '';
    public $phone = '';
    public $email = '';
    public $religion = '';
    public $marital_status = '';
    public $occupation = '';
    public $education = '';
    public $notes = '';
    public $is_active = true;

    protected $rules = [
        'nik' => 'required|string|size:16|unique:members,nik',
        'name' => 'required|string|max:255',
        'place_of_birth' => 'nullable|string|max:255',
        'date_of_birth' => 'nullable|date',
        'gender' => 'nullable|in:male,female',
        'address' => 'nullable|string',
        'rt' => 'nullable|string|max:3',
        'rw' => 'nullable|string|max:3',
        'village' => 'nullable|string|max:255',
        'subdistrict' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'province' => 'nullable|string|max:255',
        'postal_code' => 'nullable|string|max:5',
        'phone' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        'religion' => 'nullable|in:islam,kristen,katolik,hindu,buddha,khonghucu',
        'marital_status' => 'nullable|in:single,married,divorced,widowed',
        'occupation' => 'nullable|string|max:255',
        'education' => 'nullable|string|max:255',
        'notes' => 'nullable|string',
        'is_active' => 'boolean',
    ];

    public function save()
    {
        $this->validate();

        Member::create([
            'nik' => $this->nik,
            'name' => $this->name,
            'place_of_birth' => $this->place_of_birth,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'address' => $this->address,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'village' => $this->village,
            'subdistrict' => $this->subdistrict,
            'city' => $this->city,
            'province' => $this->province,
            'postal_code' => $this->postal_code,
            'phone' => $this->phone,
            'email' => $this->email,
            'religion' => $this->religion,
            'marital_status' => $this->marital_status,
            'occupation' => $this->occupation,
            'education' => $this->education,
            'notes' => $this->notes,
            'is_active' => $this->is_active,
            'updated_by' => auth()->user()->name,
        ]);

        session()->flash('message', 'Member created successfully.');
        
        return $this->redirect(MemberTable::class, navigate: true);
    }

    public function render()
    {
        return view('livewire.member.create-member');
    }
}