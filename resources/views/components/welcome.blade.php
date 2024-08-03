<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <x-application-logo class="block h-12 w-auto" />

    <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Table Company List
    </h1>

    <p class="mt-6 text-gray-500 leading-relaxed">
        <a href="{{ route('add_company') }}"><button type="button" class="btn btn-success mb-4">Create
                Company</button></a>
    <table class="table table-bordered table-striped-columns" style="width: 100%; text-align: center;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Logo</th>
                <th scope="col">Website</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $index = 0;
            @endphp
            @foreach ($companies as $company)
                <tr>
                    <td>{{ ++$index }}</td>
                    <td>{{ $company->name }}</td>
                    <td>
                        @if ($company->logo)
                            <a href="/storage/images/companies/{{ $company->logo }}" target="_blank">
                                <img src="{{ asset('/storage/images/companies/' . $company->logo) }}" alt=""
                                    width="50" height="50">
                            </a>
                        @else
                            -
                        @endif

                    </td>
                    <td>
                        @if ($company->website)
                            {{ $company->website }}
                    </td>
                @else
                    -
            @endif

            <td>
                @if ($company->email)
                    {{ $company->email }}
            </td>
        @else
            -
            @endif

            <td>
                <a href="{{ route('edit_company', $company->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('destroy_company', $company->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            {{ $companies->links() }}
        </ul>
    </nav>
    </p>

    <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Table Employee
    </h1>

    <p class="mt-6 text-gray-500 leading-relaxed">
        <a href="{{ route('add_employee') }}"><button type="button" class="btn btn-success mb-4">Create
                Employee</button></a>
    <table class="table table-bordered table-striped-columns" style="width: 100%; text-align: center;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Company</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $index = 0;
            @endphp
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ ++$index }}</td>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->company->name }}</td>
                    <td>
                        @if ($employee->email)
                            {{ $employee->email }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($employee->phone)
                            {{ $employee->phone }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('edit_employee', $employee->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('destroy_employee', $employee->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            {{ $companies->links() }}
        </ul>
    </nav>
    </p>
</div>
