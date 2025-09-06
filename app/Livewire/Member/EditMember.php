<?php

namespace App\Livewire\Member;

use App\Models\Member;
use Livewire\Component;

class EditMember extends Component
{
    public Member $member;
    
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

    public function mount(Member $member)
    {
        $this->member = $member;
        $this->nik = $member->nik;
        $this->name = $member->name;
        $this->place_of_birth = $member->place_of_birth;
        $this->date_of_birth = $member->date_of_birth?->format('Y-m-d');
        $this->gender = $member->gender;
        $this->address = $member->address;
        $this->rt = $member->rt;
        $this->rw = $member->rw;
        $this->village = $member->village;
        $this->subdistrict = $member->subdistrict;
        $this->city = $member->city;
        $this->province = $member->province;
        $this->postal_code = $member->postal_code;
        $this->phone = $member->phone;
        $this->email = $member->email;
        $this->religion = $member->religion;
        $this->marital_status = $member->marital_status;
        $this->occupation = $member->occupation;
        $this->education = $member->education;
        $this->notes = $member->notes;
        $this->is_active = $member->is_active;
    }

    public function update()
    {
        $this->rules['nik'] = 'required|string|size:16|unique:members,nik,' . $this->member->id;
        $this->validate();

        $this->member->update([
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
        ]);

        session()->flash('message', 'Member updated successfully.');
        
        return $this->redirect(MemberTable::class, navigate: true);
    }

    public function render()
    {
        return view('livewire.member.edit-member');
    }
}
