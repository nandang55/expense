<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-4">
        <x-layouts.breadcrumb heading="Edit User" sub-heading="Update user account"/>

        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('user.index') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center" wire:navigate>
                <i class="fa fa-arrow-left me-1"></i>
                Back to Users
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-8">
            <div class="card card-body shadow-sm mb-4">
                <h2 class="h5 mb-4">User Information</h2>
                
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form wire:submit="update">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model="email">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password (Leave blank to keep current)</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" wire:model="password">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" wire:model="password_confirmation">
                            @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3" wire:ignore>
                            <label for="member_id" class="form-label">Link to Member (Optional)</label>
                            <select class="form-control select2-member" wire:model="member_id" id="member_id">
                                <option value="">Select Member (Optional)</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}" 
                                            data-nik="{{ $member->nik }}" 
                                            data-phone="{{ $member->phone }}"
                                            {{ $member_id == $member->id ? 'selected' : '' }}>
                                        {{ $member->name }} - {{ $member->nik }}
                                    </option>
                                @endforeach
                            </select>
                            @error('member_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            @if($member_id)
                                <small class="text-muted">Selected: {{ $members->where('id', $member_id)->first()->name ?? 'Unknown' }}</small>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                            <select class="form-control" wire:model="role" id="role">
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ $this->role == $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save me-1"></i>
                            Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
$(document).ready(function() {
    // Initialize Select2 for member
    $('.select2-member').select2({
        theme: "bootstrap-5",
        placeholder: "Search Member (Optional)",
        allowClear: true,
        templateResult: function(member) {
            if (!member.id) {
                return member.text;
            }
            
            var $member = $(member.element);
            var nik = $member.data('nik');
            var phone = $member.data('phone');
            
            var $result = $(
                '<div class="d-flex justify-content-between align-items-center">' +
                    '<div>' +
                        '<strong>' + member.text + '</strong><br>' +
                        '<small class="text-muted">NIK: ' + nik + '</small>' +
                    '</div>' +
                    '<div class="text-end">' +
                        '<small class="text-info">' + phone + '</small>' +
                    '</div>' +
                '</div>'
            );
            
            return $result;
        },
        templateSelection: function(member) {
            if (!member.id) {
                return member.text;
            }
            return member.text;
        }
    });

    // Set the selected value for Select2
    setTimeout(function() {
        if ($('#member_id').val()) {
            $('#member_id').trigger('change');
        }
    }, 100);

    $('.select2-member').change(function (){
        Livewire.first().member_id = $(this).val()
    })
})

// Re-initialize Select2 after Livewire updates
document.addEventListener('livewire:updated', function () {
    $('.select2-member').select2({
        theme: "bootstrap-5",
        placeholder: "Search Member (Optional)",
        allowClear: true,
        templateResult: function(member) {
            if (!member.id) {
                return member.text;
            }
            
            var $member = $(member.element);
            var nik = $member.data('nik');
            var phone = $member.data('phone');
            
            var $result = $(
                '<div class="d-flex justify-content-between align-items-center">' +
                    '<div>' +
                        '<strong>' + member.text + '</strong><br>' +
                        '<small class="text-muted">NIK: ' + nik + '</small>' +
                    '</div>' +
                    '<div class="text-end">' +
                        '<small class="text-info">' + phone + '</small>' +
                    '</div>' +
                '</div>'
            );
            
            return $result;
        },
        templateSelection: function(member) {
            if (!member.id) {
                return member.text;
            }
            return member.text;
        }
    });

    // Set the selected value for Select2
    setTimeout(function() {
        if ($('#member_id').val()) {
            $('#member_id').trigger('change');
        }
    }, 100);

    $('.select2-member').change(function (){
        Livewire.first().member_id = $(this).val()
    })
});
</script>
@endpush