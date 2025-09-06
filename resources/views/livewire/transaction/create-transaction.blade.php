<div class="row">

    <x-layouts.breadcrumb />

    <div class="col-md-12">
        <!-- Account details card-->
        <div class="card mb-4">
            <div class="card-header bg-gray-800 text-white p-3">
                <span class="h4">Add New Transaction</span>
            </div>
            <div class="card-body">
                <form wire:submit="save">
                    <div class="row gx-3 mb-3">
                        <div class="col-md-4 col-xl-3">
                            <label class="small mb-1" for="date">Date</label>
                            <input class="form-control" wire:model="form.date" type="date" id="date">
                            @error('form.date') <small class="text-danger">{{ $message }}</small>  @enderror
                        </div>

                        <div class="col-md-4 col-xl-3">
                            <label class="small mb-1" for="account_id">
                                Account
                            </label>
                            <select class="form-control" wire:model="form.account_id" id="account_id">
                                <option value="" disabled>Select Account</option>
                                @foreach($accounts as $account)
                                    <option value="{{ $account->id }}" wire:key="{{ $account->id }}">{{ $account->name }}</option>
                                @endforeach
                            </select>
                            @error('form.account_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-4 col-xl-3" wire:ignore>
                            <label class="small mb-1" for="category_id">
                                Category
                                <span class="badge badge-pill bg-success my-0" id="type"></span>
                            </label>
                            <select class="form-control select2" wire:model="form.category_id" id="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" wire:key="{{ $category->id }}" data-type="{{ $category->type }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('form.category_id') <small class="text-danger">{{ $message }}</small>  @enderror
                        </div>

                        <div class="col-md-4 col-xl-3">
                            <label class="small mb-1" for="amount">Amount</label>
                            <input class="form-control" wire:model="form.amount" type="number" id="amount">
                            @error('form.amount') <small class="text-danger">{{ $message }}</small>  @enderror
                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6" wire:ignore>
                            <label class="small mb-1" for="member_id">Member (Optional)</label>
                            <select class="form-control select2-member" wire:model="form.member_id" id="member_id">
                                <option value="">Select Member (Optional)</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}" data-nik="{{ $member->nik }}" data-phone="{{ $member->phone }}">
                                        {{ $member->name }} - {{ $member->nik }}
                                    </option>
                                @endforeach
                            </select>
                            @error('form.member_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="small mb-1" for="description">Description</label>
                            <input class="form-control" wire:model="form.description" type="text" id="description" placeholder="Enter description">
                            @error('form.description') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            // Initialize Select2 for category
            $('.select2').select2({
                theme: "bootstrap-5"
            });

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

            $('#type').text($(this).find(':selected').data('type'))

            $('.select2').change(function (){
                Livewire.first().form.category_id = $(this).val()
                $('#type').text($(this).find(':selected').data('type'))
            })

            $('.select2-member').change(function (){
                Livewire.first().form.member_id = $(this).val()
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

            $('.select2-member').change(function (){
                Livewire.first().form.member_id = $(this).val()
            })
        });
    </script>
@endpush
