<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-4">
        <x-layouts.breadcrumb heading="Members" sub-heading="Manage member data"/>

        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('member.create') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center" wire:navigate>
                <i class="fa fa-plus me-1"></i>
                Add New Member
            </a>
        </div>
    </div>

    <div class="table-settings mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-9 col-lg-8 d-md-flex">
                <div class="input-group me-2 me-lg-3 fmxw-200">
                    <span class="input-group-text">
                        <i class="fa fa-search"></i>
                    </span>
                    <input type="text" wire:model.live="search" class="form-control" placeholder="Search members...">
                </div>
            </div>
            <div class="col-3 col-lg-4 d-flex justify-content-end">
                <select class="form-select" wire:model.live="per_page">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table user-table table-hover align-items-center">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>NIK</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse($members as $member)
                    <tr>
                        <td>{{ $loop->iteration + ($members->currentPage() - 1) * $members->perPage() }}</td>
                        <td>{{ $member->nik }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ ucfirst($member->gender ?? '-') }}</td>
                        <td>{{ $member->phone ?? '-' }}</td>
                        <td>{{ Str::limit($member->full_address, 50) }}</td>
                        <td>
                            <span class="badge bg-{{ $member->is_active ? 'success' : 'danger' }}">
                                {{ $member->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('member.edit', $member->id) }}" class="btn btn-sm btn-primary" wire:navigate>
                                <i class="fa fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-danger" wire:click="setDeleteId({{ $member->id }})" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-danger text-center" colspan="8">No members found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $members->links() }}
    </div>

    <x-modals.delete/>
</div>