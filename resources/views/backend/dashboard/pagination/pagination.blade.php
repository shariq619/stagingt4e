<table class="otsDataTable">
    <tr>
        <th>Course Name</th>
        <th>Category</th>
        <th>Base Course Type</th>
        <th>MP Course Status</th>
        <th>Loyalty Program Status</th>
    </tr>
    @foreach ($courses as $course)
        <tr>
            <td>{{ $course->name }}</td>
            <td>{{ $course->category->name }}</td>
            <td>{{ $course->base_course_type }}</td>
            <td>{{ $course->mp_course_status }}</td>
            <td>{{ $course->loyalty_program_status }}</td>
        </tr>
    @endforeach
</table>
{{ $courses->links() }}
