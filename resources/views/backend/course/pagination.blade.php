
                                                    @foreach ($courses as $course)
                                                        <tr>
                                                            <td>#{{ $course->id }}</td>
                                                            <td>{{ $course->name }}</td>
                                                            <td>{{ optional($course->category)->name }}</td>
                                                            <td>{{ optional($course->subcategory)->name }}</td>
                                                            <td>{{ $course->mp_course_status }}</td>
                                                            <td>{{ $course->loyalty_program_status }}</td>
                                                            <td>{{ $course->base_course_type }}</td>
                                                            <td>
                                                                @if ($course->name == 'Super Admin')
                                                                    <i class="text-muted">{{ __('Default course') }}</i>
                                                                @else
                                                                    @can('change course')
                                                                        <a href="{{ route('backend.courses.edit', $course->id) }}"
                                                                            class="btn btn-sm btn-warning">
                                                                            <i class="fas fa-edit mr-2"></i>
                                                                            {{ __('Update') }}
                                                                        </a>
                                                                    @endcan
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
 