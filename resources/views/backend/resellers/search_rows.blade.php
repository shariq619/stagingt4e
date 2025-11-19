@forelse ($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->telephone }}</td>
        <td>
            @foreach ($user->roles as $user_role)
                <span class="badge badge-info">{{ $user_role->name }}</span>
            @endforeach
        </td>
        <td>{{ $user->created_at->diffForHumans() }}</td>
        <td>
            @if (in_array('Super Admin', $user->roles->pluck('name')->toArray()))
            @else
                @can('change user')
                    <a href="{{ route('backend.users.edit', $user) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit mr-2"></i>
                        {{ __('Change') }}
                    </a>
                @endcan
            @endif
            @can('see user')
                <a href="{{ route('backend.users.show', $user) }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-eye mr-2"></i>
                    {{ __('Detail') }}
                </a>
            @endcan
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center text-muted"><i>{{ __('No User Found') }}</i>
        </td>
    </tr>
@endforelse
