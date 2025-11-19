@forelse ($courses as $course)
    <tr>
        <td>#{{ $course->id }}</td>
        <td>{{ $course->name }}</td>
        <td>{{ optional($course->category)->name }}</td>
        <td>
            @if (isset($course->tasks))
                @foreach ($course->tasks as $tasks)
                    <span class="badge badge-primary">{{ $tasks->name ?? '' }}</span>
                @endforeach
            @endif
        </td>
        <td>
            @if (isset($course->licenses))
                @foreach ($course->licenses as $license)
                    <span class="badge badge-primary">{{ $license->name ?? '' }}</span>
                @endforeach
            @endif
        </td>
        <td>
            @if ($course->name == 'Super Admin')
                <i class="text-muted">{{ __('Default course') }}</i>
            @else
                @can('change course')
                    <a href="{{ route('backend.courses.edit', $course->id) }}" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit mr-2"></i>
                        {{ __('Update') }}
                    </a>
                @endcan
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="8" class="text-center">
            <i>{{ __('Course Data is empty') }}</i>
        </td>
    </tr>
@endforelse
