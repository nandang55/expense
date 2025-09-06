<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-4">
        <x-layouts.breadcrumb heading="Users" sub-heading="Manage user accounts"/>

        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('user.create') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center" wire:navigate>
                <i class="fa fa-plus me-1"></i>
                Add New User
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
                    <input type="text" wire:model.live="search" class="form-control" placeholder="Search users...">
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Member</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse($users as $user)
                    <tr>
                        <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->member)
                                <span class="badge bg-info">{{ $user->member->name }}</span>
                                <br>
                                <small class="text-muted">{{ $user->member->nik }}</small>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary" wire:navigate>
                                <i class="fa fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-danger" wire:click="setDeleteId({{ $user->id }})" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-danger text-center" colspan="6">No users found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $users->links() }}
    </div>

    <x-modals.delete/>
</div>