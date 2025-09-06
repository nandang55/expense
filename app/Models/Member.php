<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    protected $fillable = [
        'nik',
        'name',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'address',
        'rt',
        'rw',
        'village',
        'subdistrict',
        'city',
        'province',
        'postal_code',
        'phone',
        'email',
        'religion',
        'marital_status',
        'occupation',
        'education',
        'notes',
        'is_active',
        'updated_by',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'is_active' => 'boolean',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function getFullAddressAttribute()
    {
        $address = $this->address;
        if ($this->rt) $address .= ', RT ' . $this->rt;
        if ($this->rw) $address .= ', RW ' . $this->rw;
        if ($this->village) $address .= ', ' . $this->village;
        if ($this->subdistrict) $address .= ', ' . $this->subdistrict;
        if ($this->city) $address .= ', ' . $this->city;
        if ($this->province) $address .= ', ' . $this->province;
        if ($this->postal_code) $address .= ' ' . $this->postal_code;
        
        return $address;
    }

    public function getAgeAttribute()
    {
        if (!$this->date_of_birth) return null;
        
        return $this->date_of_birth->age;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('nik', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }
}