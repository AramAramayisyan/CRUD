@extends('layouts/app')

@section('content')
    <div class="container">
        <h1>Projects</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Create New Project</a>

        @if($projects->count())
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Project Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
{{--                @foreach($projects as $project)--}}
                    <tr>
{{--                        <td>{{ $project->id }}</td>--}}
{{--                        <td>{{ $project->name }}</td>--}}
{{--                        <td>{{ $project->description }}</td>--}}
                        <td>
{{--                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning">Edit</a>--}}

{{--                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline-block;">--}}
{{--                                @c?srf--}}
{{--                                @method('DELETE')--}}

                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this project?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
{{--                @endforeach--}}
                </tbody>
            </table>

{{--            {{ $projects->links() }} {{-- Pagination links --}}--}}
        @else
            <p>No projects found.</p>
        @endif
    </div>
@endsection
