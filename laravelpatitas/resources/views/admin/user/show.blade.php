@extends('layouts.admin')

@section('title', __('admin.users.show.title', ['name' => $viewData['user']->getName()]))

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>{{ $viewData['user']->getName() }}</h2>
                <p class="text-muted mb-0">{{ __('admin.users.show.user_information') }}</p>
            </div>
            <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>{{ __('admin.users.actions.back_to_list') }}
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    {{-- Column of icon --}}
                    <div class="col-md-3 text-center mb-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($viewData['user']->getName()) }}&background=0D8ABC&color=fff&size=200"
                            alt="{{ $viewData['user']->getName() }}" class="img-fluid rounded-circle border shadow-sm">
                    </div>

                    {{-- Column of information --}}
                    <div class="col-md-9">
                        <dl class="row">
                            <dt class="col-sm-3">{{ __('admin.users.form.name') }}:</dt>
                            <dd class="col-sm-9">{{ $viewData['user']->getName() }}</dd>

                            <dt class="col-sm-3">{{ __('admin.users.form.email') }}:</dt>
                            <dd class="col-sm-9">
                                <a
                                    href="mailto:{{ $viewData['user']->getEmail() }}">{{ $viewData['user']->getEmail() }}</a>
                            </dd>

                            <dt class="col-sm-3">{{ __('admin.users.form.phone') }}:</dt>
                            <dd class="col-sm-9">{{ $viewData['user']->getPhone() ?? __('admin.common.not_available') }}
                            </dd>

                            <dt class="col-sm-3">{{ __('admin.users.form.address') }}:</dt>
                            <dd class="col-sm-9">{{ $viewData['user']->getAddress() ?? __('admin.common.not_available') }}
                            </dd>

                            <dt class="col-sm-3">{{ __('admin.users.form.role') }}:</dt>
                            <dd class="col-sm-9">
                                <span
                                    class="badge
                                @if ($viewData['user']->getRole()->value === 'admin') bg-primary
                                @elseif($viewData['user']->getRole()->value === 'veterinarian') bg-success
                                @else bg-secondary @endif">
                                    {{ __('admin.users.roles.' . $viewData['user']->getRole()->value) }}
                                </span>
                            </dd>

                            <dt class="col-sm-3">{{ __('admin.users.show.created_at') }}:</dt>
                            <dd class="col-sm-9">{{ $viewData['user']->getCreatedAt()?->format('d/m/Y H:i') ?? 'N/A' }}
                            </dd>

                            <dt class="col-sm-3">{{ __('admin.users.show.updated_at') }}:</dt>
                            <dd class="col-sm-9">{{ $viewData['user']->getUpdatedAt()->format('d/m/Y H:i') }}</dd>
                        </dl>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                        <i class="fas fa-list me-2"></i>{{ __('admin.users.actions.back_to_list') }}
                    </a>
                    <a href="{{ route('admin.user.edit', $viewData['user']->getId()) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>{{ __('admin.users.actions.edit') }}
                    </a>
                    <form action="{{ route('admin.user.destroy', $viewData['user']->getId()) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('{{ __('admin.users.messages.confirm_delete') }}')">
                            <i class="fas fa-trash me-2"></i>{{ __('admin.users.actions.delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
