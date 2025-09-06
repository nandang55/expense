<div class="row" style="height: 500px !important;">

    <x-layouts.breadcrumb />

    <div class="col-md-12">
        <!-- Account details card-->
        <div class="card mb-4">
            <div class="card-header bg-gray-800 text-white p-3">
                <span class="h4">Edit Category</span>
            </div>
            <div class="card-body">
                <form wire:submit="update">
                    <div class="row gx-3 mb-3">
                        <div class="col-md-3">
                            <label class="small mb-1" for="icon">Icon</label>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start" type="button" id="iconDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span id="selectedIcon">
                                        <i class="fas fa-link"></i> Select an icon
                                    </span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" style="max-height: 300px; overflow-y: auto; min-width: 300px; z-index: 9999; position: absolute;">
                                    <li class="px-3 py-2">
                                        <input type="text" class="form-control form-control-sm" id="iconSearch" placeholder="Search icons..." autocomplete="off">
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <div id="iconList">
                                        @foreach(ICONS as $icon)
                                            <li class="icon-item">
                                                <a class="dropdown-item icon-option" href="#" data-icon="{{ $icon }}">
                                                    <i class="{{ $icon }}"></i> {{ $icon }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </div>
                                </ul>
                            </div>
                            <input type="hidden" wire:model="form.icon" id="iconInput" value="fas fa-link">
                            @error('form.icon') <small class="text-danger">{{ $message }}</small>  @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="small mb-1" for="category">Category</label>
                            <input
                                    class="form-control"
                                    wire:model="form.name"
                                    id="category"
                                    type="text"
                                    placeholder="Enter category"
                                    value="">
                            @error('form.name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="small mb-1" for="type">Type</label>
                            <select class="form-control" wire:model="form.type" id="type">
                                <option value="income">Income</option>
                                <option value="expense">Expense</option>
                            </select>
                            @error('form.type') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                    </div>

                    <button class="btn btn-primary" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('css')
<style>
/* Simple dropdown styling to prevent clipping */
.dropdown-menu {
    z-index: 1050 !important;
    max-height: 300px !important;
    overflow-y: auto !important;
    min-width: 300px !important;
}

/* Ensure parent containers don't clip the dropdown */
.card-body {
    overflow: visible !important;
    min-height: 500px !important;
}

.row {
    overflow: visible !important;
}

.col-md-3 {
    overflow: visible !important;
}

/* Make sure dropdown shows properly */
.dropdown-menu.show {
    display: block !important;
}
</style>
@endpush

@push('js')
<script>
$(document).ready(function() {
    // Handle icon selection
    $(document).on('click', '.icon-option', function(e) {
        e.preventDefault();
        
        var selectedIcon = $(this).data('icon');
        var iconClass = selectedIcon;
        
        // Create proper HTML for the selected icon
        var iconHtml = '<i class="' + iconClass + '"></i> ' + iconClass;
        
        // Update the dropdown button
        $('#selectedIcon').html(iconHtml);
        
        // Update the hidden input
        $('#iconInput').val(selectedIcon);
        
        // Update Livewire
        @this.set('form.icon', selectedIcon);
        
        // Close dropdown
        $('#iconDropdown').dropdown('hide');
    });
    
    // Handle search functionality
    $('#iconSearch').on('input', function() {
        var searchTerm = $(this).val().toLowerCase();
        var iconItems = $('.icon-item');
        
        iconItems.each(function() {
            var iconText = $(this).find('.icon-option').text().toLowerCase();
            if (iconText.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    
    // Clear search when dropdown is closed
    $('#iconDropdown').on('hidden.bs.dropdown', function() {
        $('#iconSearch').val('');
        $('.icon-item').show();
    });
    
    // Focus search input when dropdown opens
    $('#iconDropdown').on('shown.bs.dropdown', function() {
        $('#iconSearch').focus();
    });
    
    // Initialize with current value
    @if(!empty($form->icon))
        var currentIcon = '{{ $form->icon }}';
        var iconHtml = '<i class="' + currentIcon + '"></i> ' + currentIcon;
        $('#selectedIcon').html(iconHtml);
        $('#iconInput').val(currentIcon);
    @endif
});
</script>
@endpush
