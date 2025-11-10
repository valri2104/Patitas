@extends('layouts.admin')

@section('title', __('admin.users.index.title'))
@section('subtitle', __('admin.users.index.subtitle'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Header with Create Button -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2>{{ __('admin.users.index.title') }}</h2>
                        <p class="text-muted mb-0">{{ __('admin.users.index.subtitle') }}</p>
                    </div>
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>{{ __('admin.users.index.create_new') }}
                    </a>
                </div>

                <!-- Users Table -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            {{ __('admin.users.index.total_products', ['count' => count($viewData['users'])]) }}</h5>
                    </div>
                    <div class="card-body p-0">
                        @if (count($viewData['users']) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">{{ __('admin.users.table.name') }}</th>
                                            <th scope="col">{{ __('admin.users.table.email') }}</th>
                                            <th scope="col">{{ __('admin.users.table.phone') }}</th>
                                            <th scope="col">{{ __('admin.users.table.address') }}</th>
                                            <th scope="col">{{ __('admin.users.table.role') }}</th>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($viewData['users'] as $user)
                                            <tr>
                                                <td>
                                                    <div class="fw-bold">{{ $user->getName() }}</div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary">
                                                        {{ $user->getEmail() }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary">
                                                        {{ $user->getPhone() }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary">
                                                        {{ $user->getAddress() }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($user->isAdmin())
                                                        <span class="badge bg-success">
                                                            {{ __('admin.users.roles.admin') }}
                                                        </span>
                                                    @else
                                                        <span class="badge bg-danger">
                                                            {{ $user->getRole() }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        <!-- View Button -->
                                                        <a href="{{ route('admin.user.show', $user->getId()) }}"
                                                            class="btn btn-sm btn-outline-primary"
                                                            title="{{ __('admin.users.actions.view') }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <!-- Edit Button -->
                                                        <a href="{{ route('admin.user.edit', $user->getId()) }}"
                                                            class="btn btn-sm btn-outline-secondary"
                                                            title="{{ __('admin.users.actions.edit') }}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <!-- Delete Button -->
                                                        <form action="{{ route('admin.user.destroy', $user->getId()) }}"
                                                            method="POST" class="d-inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                title="{{ __('admin.users.actions.delete') }}"
                                                                onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="mb-3">
                                    <i class="fas fa-box-open fa-3x text-muted"></i>
                                </div>
                                <h5 class="text-muted">{{ __('admin.users.index.no_users') }}</h5>
                                <p class="text-muted mb-3">{{ __('admin.users.index.subtitle') }}</p>
                                <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>{{ __('admin.users.index.create_new') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
