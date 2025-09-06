<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Models\Member;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $member_id = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'member_id' => 'nullable|exists:members,id',
    ];

    public function save()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'member_id' => $this->member_id ?: null,
        ]);

        session()->flash('message', 'User created successfully.');
        
        return $this->redirect(UserTable::class, navigate: true);
    }

    public function render()
    {
        return view('livewire.user.create-user', [
            'members' => Member::active()->get(),
        ]);
    }
}