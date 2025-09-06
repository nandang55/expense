<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Models\Member;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class EditUser extends Component
{
    public User $user;
    
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $member_id = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'nullable|string|min:8|confirmed',
        'member_id' => 'nullable|exists:members,id',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->member_id = $user->member_id;
    }

    public function update()
    {
        $this->rules['email'] = 'required|string|email|max:255|unique:users,email,' . $this->user->id;
        $this->validate();

        $updateData = [
            'name' => $this->name,
            'email' => $this->email,
            'member_id' => $this->member_id ?: null,
        ];

        if ($this->password) {
            $updateData['password'] = Hash::make($this->password);
        }

        $this->user->update($updateData);

        session()->flash('message', 'User updated successfully.');
        
        return $this->redirect(UserTable::class, navigate: true);
    }

    public function render()
    {
        return view('livewire.user.edit-user', [
            'members' => Member::active()->get(),
        ]);
    }
}