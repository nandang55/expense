<div class="row">
    <x-layouts.breadcrumb />
    <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-header bg-gray-800 text-white p-3">
                    <span class="h4">Create New Member</span>
                </div>
                <div class="card-body">
                    <form wire:submit="save">
                        <!-- Personal Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">Personal Information</h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="nik" maxlength="16" placeholder="Enter 16-digit NIK">
                                @error('nik') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="name" placeholder="Enter full name">
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Place of Birth</label>
                                <input type="text" class="form-control" wire:model="place_of_birth" placeholder="Enter place of birth">
                                @error('place_of_birth') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" wire:model="date_of_birth">
                                @error('date_of_birth') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Gender</label>
                                <select class="form-select" wire:model="gender">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">Address Information</h5>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" wire:model="address" rows="3" placeholder="Enter detailed address"></textarea>
                                @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">RT</label>
                                <input type="text" class="form-control" wire:model="rt" placeholder="RT">
                                @error('rt') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">RW</label>
                                <input type="text" class="form-control" wire:model="rw" placeholder="RW">
                                @error('rw') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Village</label>
                                <input type="text" class="form-control" wire:model="village" placeholder="Village">
                                @error('village') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Subdistrict</label>
                                <input type="text" class="form-control" wire:model="subdistrict" placeholder="Subdistrict">
                                @error('subdistrict') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control" wire:model="city" placeholder="City">
                                @error('city') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Province</label>
                                <input type="text" class="form-control" wire:model="province" placeholder="Province">
                                @error('province') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Postal Code</label>
                                <input type="text" class="form-control" wire:model="postal_code" placeholder="Postal Code">
                                @error('postal_code') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">Contact Information</h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" wire:model="phone" placeholder="Phone number">
                                @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" wire:model="email" placeholder="Email address">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">Additional Information</h5>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Religion</label>
                                <select class="form-select" wire:model="religion">
                                    <option value="">Select Religion</option>
                                    <option value="islam">Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="katolik">Katolik</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="buddha">Buddha</option>
                                    <option value="khonghucu">Khonghucu</option>
                                </select>
                                @error('religion') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Marital Status</label>
                                <select class="form-select" wire:model="marital_status">
                                    <option value="">Select Status</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="divorced">Divorced</option>
                                    <option value="widowed">Widowed</option>
                                </select>
                                @error('marital_status') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Occupation</label>
                                <input type="text" class="form-control" wire:model="occupation" placeholder="Occupation">
                                @error('occupation') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Education</label>
                                <input type="text" class="form-control" wire:model="education" placeholder="Education level">
                                @error('education') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" wire:model="is_active">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('is_active') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control" wire:model="notes" rows="3" placeholder="Additional notes"></textarea>
                                @error('notes') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('member.index') }}" class="btn btn-secondary me-2" wire:navigate>Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Member</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>