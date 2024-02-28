@extends('customers.layout.shardClient')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset($globalVariable . 'assetsCustomers') }}/css/history.css" rel="stylesheet"">
@endsection


@section('content')

{{-- Message Success --}}
@if(session('success'))
<div class="alert-container" style="position: absolute; top: 0; left: 50%;">
        <div class="alertStyle" id="alertSuccess">
            <div class="d-flex align-items-center">
                <i class="fa-regular fa-circle-check fs-5"></i>
                <span class="mx-2"> {!!session('success')!!}  (<span class="countdown">5</span>)</span>
            </div>
        </div>
</div>
@endif

@yield('error')
{{-- Message Error --}}
@if(session('error'))
 <div class="alert-container" style="position: absolute; top: 0; left: 50%;">
        <div class="alertStyle" id="alertWrong">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-triangle-exclamation fs-5"></i>
                <span class="mx-2">{!!session('error')!!} (<span class="countdown">5</span>)</span>
            </div>
        </div>
    </div>
@endif


    <header>
        <!-- Title Section -->
        <div class="titleSection">
            <h3>Deleted data</h3>
            <a href="/show-plan" class="btnGray py-2"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>

        <!-- Main content -->
        <div class="row">

            {{-- Customers history --}}
            <div class="col-6 mb-3">
                <div class="card">
                    <div class="card-header tect-color d-flex justify-content-between align-items-center">
                        <h5>Customers history</h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool text-color" data-bs-toggle="collapse"
                                data-bs-target="#customers" aria-expanded="false" aria-controls="customers"
                                title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body collapse show" id="customers">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="text-start">Name</th>
                                    <th>Deletion date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($clientData))
                                    @foreach ($clientData as $client)
                                        <tr>
                                            <td>{{ $client->id }}</td>
                                            <td class="text-start">
                                                <img class="img-circle mr-2"
                                                    src="{{ isset($client->image) ? asset($globalVariable . 'images/client/' . $client->image) : asset($globalVariable . 'assetsClinet/imgs/testi-2.jpg') }}"
                                                    alt="">
                                                {{ $client->name }}
                                            </td>
                                            <td>{{ $client->deleted_at }}</td>
                                            <td>
                                                <form action="{{ route('delete-clienthistory', ['id' => $client->id]) }}"
                                                    method="POST" style="display: initial;, margin-lift:2px;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="delete" type="submit"> <i
                                                            class="fa-regular fa-trash-can mx-2"></i></button>
                                                </form>
                                                <form action="{{ route('restore-clienthistory', ['id' => $client->id]) }}"
                                                    method="POST" style="display: initial;, margin-lift:2px;">
                                                    @csrf
                                                    <button class="recovery" type="submit"> <i
                                                            class="fa-solid fa-arrow-rotate-left mx-2"></i></button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                        </table>
                    </div>
                </div>
            </div>

            {{-- Employees history --}}
            <div class="col-6 mb-3">
                <div class="card">
                    <div class="card-header tect-color d-flex justify-content-between align-items-center">
                        <h5>Employees history</h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool text-color" data-bs-toggle="collapse"
                                data-bs-target="#Employee" aria-expanded="false" aria-controls="Employee" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body collapse show" id="Employee">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="text-start">Name</th>
                                    <th>Deletion date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($userData))
                                    @foreach ($userData as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td class="text-start">
                                                <img class="img-circle mr-2"
                                                    src="{{ asset($globalVariable . 'images') }}/{{ $user->image }}"
                                                    alt="{{ $user->name }}">
                                                {{ $user->name }}
                                            </td>
                                            <td>{{ $user->deleted_at }}</td>
                                            <td>
                                                <form action="{{ route('delete-userhistory', ['id' => $user->id]) }}"
                                                    method="POST" style="display: initial;, margin-lift:2px;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="delete" type="submit"> <i
                                                            class="fa-regular fa-trash-can mx-2"></i></button>
                                                </form>
                                                <form action="{{ route('restore-userhistory', ['id' => $user->id]) }}"
                                                    method="POST" style="display: initial;, margin-lift:2px;">
                                                    @csrf
                                                    <button class="recovery" type="submit"> <i
                                                            class="fa-solid fa-arrow-rotate-left mx-2"></i></button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                        </table>
                    </div>
                </div>

            </div>

            {{-- data entry history --}}
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-header tect-color d-flex justify-content-between align-items-center">
                        <h5>Data enty history</h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool text-color" data-bs-toggle="collapse"
                                data-bs-target="#dataEntry" aria-expanded="false" aria-controls="dataEntry"
                                title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body collapse show" id="dataEntry">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="text-start">Name</th>
                                    <th>Type</th>
                                    <th>Day</th>
                                    <th>Deletion date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($attendanceData))
                                    @foreach ($attendanceData as $attendance)
                                        <tr>
                                            <td>{{ $attendance->id }}</td>
                                            <td class="text-start">
                                                <img class="img-circle mr-2"
                                                    src="{{ asset($globalVariable . 'images') }}/{{ $attendance->employee->image }}"
                                                    alt="">
                                                {{ $attendance->employee->name }}
                                            </td>
                                            <td>{{ $attendance->on_leave ? 'Holiday' : ($attendance->absent ? 'Absence' : 'Attendance') }}
                                            </td>

                                            <td>{{ $attendance->day }}</td>
                                            <td>{{ $attendance->deleted_at }}</td>
                                            <td>
                                                <form action="{{ route('delete-attendance', ['id' => $attendance->id]) }}"
                                                    method="POST" style="display: initial;, margin-lift:2px;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="delete" type="submit"> <i
                                                            class="fa-regular fa-trash-can mx-2"></i></button>
                                                </form>
                                                <form action="{{ route('restore-attendance', ['id' => $attendance->id]) }}"
                                                    method="POST" style="display: initial;, margin-lift:2px;">
                                                    @csrf
                                                    <button class="recovery" type="submit"> <i
                                                            class="fa-solid fa-arrow-rotate-left mx-2"></i></button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                        </table>
                    </div>
                </div>

            </div>

            {{-- Plans history --}}
            <div class="col-6 mb-3">
                <div class="card">
                    <div class="card-header tect-color d-flex justify-content-between align-items-center">
                        <h5>Plans history</h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool text-color" data-bs-toggle="collapse"
                                data-bs-target="#Plans" aria-expanded="false" aria-controls="Plans" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body collapse show" id="Plans">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="text-start">Name</th>
                                    <th>Price</th>
                                    <th>Deletion date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($planeData))
                                    @foreach ($planeData as $plane)
                                        <tr>
                                            <td>{{ $plane->id }}</td>
                                            <td class="text-start">
                                                {{ $plane->title }}
                                            </td>
                                            <td>{{ $plane->cost }} <span class="text-warning">.EGP</span></td>
                                            <td>{{ $plane->deleted_at }}</td>
                                            <td>
                                                <form action="{{ route('delete-planehistory', ['id' => $plane->id]) }}"
                                                    method="POST" style="display: initial;, margin-lift:2px;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="delete" type="submit"> <i
                                                            class="fa-regular fa-trash-can mx-2"></i></button>
                                                </form>
                                                <form action="{{ route('restore-planehistory', ['id' => $plane->id]) }}"
                                                    method="POST" style="display: initial;, margin-lift:2px;">
                                                    @csrf
                                                    <button class="recovery" type="submit"> <i
                                                            class="fa-solid fa-arrow-rotate-left mx-2"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                        </table>
                    </div>
                </div>

            </div>

            {{-- Projects history --}}
            <div class="col-6 mb-3">
                <div class="card">
                    <div class="card-header tect-color d-flex justify-content-between align-items-center">
                        <h5>Projects history</h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool text-color" data-bs-toggle="collapse"
                                data-bs-target="#Projects" aria-expanded="false" aria-controls="Projects"
                                title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <form class="card-body collapse show" id="Projects">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="text-start">Name</th>
                                    <th>Deletion date</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                </tr>

                            </thead>
                            <tbody>
                                @if (isset($projectMarketing))
                                @foreach ($projectMarketing as $marketing)
                                <tr>
                                    <td>{{$marketing->id}}</td>
                                    <td class="text-start">
                                        {{$marketing->project_name}}
                                    </td>
                                    <td>{{$marketing->department}}</td>
                                    <td>{{$marketing->deleted_at}}</td>
                                    <td>
                                        <form action="{{ route('delete-projectmarketing', ['id' => $marketing->id]) }}"
                                            method="POST"  style="display: initial;, margin-lift:2px;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="delete" type="submit"> <i
                                                    class="fa-regular fa-trash-can mx-2"></i></button>
                                        </form>
                                        <form  action="{{ route('restore-projectmarketing', ['id' => $marketing->id]) }}"
                                            method="POST" style="display: initial;, margin-lift:2px;">
                                            @csrf
                                            <button class="recovery" type="submit"> <i
                                                    class="fa-solid fa-arrow-rotate-left mx-2"></i></button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                                @endif

                                @if (isset($projectProgramming))
                                @foreach ($projectProgramming as $programming)
                                <tr>
                                    <td>{{$programming->id}}</td>
                                    <td class="text-start">
                                        {{$programming->project_name}}
                                    </td>
                                    <td>{{$programming->department}}</td>
                                    <td>{{$programming->deleted_at}}</td>
                                    <td>
                                        <form action="{{ route('delete-projectprogramming', ['id' => $programming->id]) }}"
                                            method="POST"  style="display: initial;, margin-lift:2px;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="delete" type="submit"> <i
                                                    class="fa-regular fa-trash-can mx-2"></i></button>
                                        </form>
                                        <form  action="{{ route('restore-projectprogramming', ['id' => $programming->id]) }}"
                                            method="POST" style="display: initial;, margin-lift:2px;">
                                            @csrf
                                            <button class="recovery" type="submit"> <i
                                                    class="fa-solid fa-arrow-rotate-left mx-2"></i></button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                                @endif
                        </table>
                    </form>
                </div>

            </div>


            {{-- Expenses history --}}
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-header tect-color d-flex justify-content-between align-items-center">
                        <h5>Expenses history</h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool text-color" data-bs-toggle="collapse"
                                data-bs-target="#Expenses" aria-expanded="false" aria-controls="Expenses"
                                title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body collapse show" id="Expenses">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="text-start">Type</th>
                                    <th>from</th>
                                    <th>to</th>
                                    <th>value</th>
                                    <th>Deletion date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($expensesData))
                                    @foreach ($expensesData as $expenses)
                                        <tr>
                                            <td>{{ $expenses->id }}</td>
                                            <td class="text-start">
                                                {{ $expenses->invoice_type }}
                                            </td>
                                            <td>{{ $expenses->start_date }}</td>
                                            <td>{{ $expenses->due_date }}</td>
                                            <td>{{ $expenses->amount }} <span class="text-warning">.EGP</span></td>
                                            <td>{{ $expenses->deleted_at }}</td>
                                            <td>
                                                <form action="{{ route('delete-expenses', ['id' => $expenses->id]) }}"
                                                    method="POST" style="display: initial;, margin-lift:2px;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="delete" type="submit"> <i
                                                            class="fa-regular fa-trash-can mx-2"></i></button>
                                                </form>
                                                <form action="{{ route('restore-expenses', ['id' => $expenses->id]) }}"
                                                    method="POST" style="display: initial;, margin-lift:2px;">
                                                    @csrf
                                                    <button class="recovery" type="submit"> <i
                                                            class="fa-solid fa-arrow-rotate-left mx-2"></i></button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                                @if (isset($pettyCashData))
                                    @foreach ($pettyCashData as $pettyCash)
                                        <tr>
                                            <td>{{ $pettyCash->id }}</td>
                                            <td class="text-start">
                                                {{ $pettyCash->invoice_type }}
                                            </td>
                                            <td>{{ $pettyCash->start_date }}</td>
                                            <td>{{ $pettyCash->due_date }}</td>
                                            <td>{{ $pettyCash->amount }} <span class="text-warning">.EGP</span></td>
                                            <td>{{ $pettyCash->deleted_at }}</td>
                                            <td>
                                                <form action="{{ route('delete-pettyCash', ['id' => $pettyCash->id]) }}"
                                                    method="POST" style="display: initial;, margin-lift:2px;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="delete" type="submit"> <i
                                                            class="fa-regular fa-trash-can mx-2"></i></button>
                                                </form>
                                                <form action="{{ route('restore-pettyCash', ['id' => $pettyCash->id]) }}"
                                                    method="POST" style="display: initial;, margin-lift:2px;">
                                                    @csrf
                                                    <button class="recovery" type="submit"> <i
                                                            class="fa-solid fa-arrow-rotate-left mx-2"></i></button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                        </table>
                    </div>
                </div>

            </div>

            {{-- Revenue history --}}
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-header tect-color d-flex justify-content-between align-items-center">
                        <h5>Revenue history</h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool text-color" data-bs-toggle="collapse"
                                data-bs-target="#Revenue" aria-expanded="false" aria-controls="Revenue"
                                title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body collapse show" id="Revenue">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="text-start">Name</th>
                                    <th>Type</th>
                                    <th>from</th>
                                    <th>to</th>
                                    <th>value</th>
                                    <th>Deletion date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($revenueData))
                                    @foreach ($revenueData as $revenue)
                                        <tr>
                                            <td>{{ $revenue->id }}</td>
                                            <td class="text-start">
                                                {{ $revenue->name }}
                                            </td>
                                            <td>{{ $revenue->contract_type }}</td>
                                            <td>{{ $revenue->start_date }}</td>
                                            <td>{{ $revenue->due_date }}</td>
                                            <td>{{ $revenue->amount }} <span class="text-warning">.EGP</span></td>
                                            <td>{{ $revenue->deleted_at }}</td>
                                            <td>
                                                <form action="{{ route('delete-revenue', ['id' => $revenue->id]) }}"
                                                    method="POST" style="display: initial;, margin-lift:2px;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="delete" type="submit"> <i
                                                            class="fa-regular fa-trash-can mx-2"></i></button>
                                                </form>
                                                <form action="{{ route('restore-revenue', ['id' => $revenue->id]) }}"
                                                    method="POST" style="display: initial;, margin-lift:2px;">
                                                    @csrf
                                                    <button class="recovery" type="submit"> <i
                                                            class="fa-solid fa-arrow-rotate-left mx-2"></i></button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                                @if (isset($shortContractsData))
                                    @foreach ($shortContractsData as $shortCont)
                                        <tr>
                                            <td>{{ $shortCont->id }}</td>
                                            <td class="text-start">
                                                {{ $shortCont->name }}
                                            </td>
                                            <td>{{ $shortCont->contract_type }}</td>
                                            <td>{{ $shortCont->start_date }}</td>
                                            <td>{{ $shortCont->due_date }}</td>
                                            <td>{{ $shortCont->amount }} <span class="text-warning">.EGP</span></td>
                                            <td>{{ $shortCont->deleted_at }}</td>
                                            <td>
                                                <form action="{{ route('delete-shortcontracts', ['id' => $shortCont->id]) }}"
                                                    method="POST" style="display: initial;, margin-lift:2px;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="delete" type="submit"> <i
                                                            class="fa-regular fa-trash-can mx-2"></i></button>
                                                </form>
                                                <form action="{{ route('restore-shortcontracts', ['id' => $shortCont->id]) }}"
                                                    method="POST" style="display: initial;, margin-lift:2px;">
                                                    @csrf
                                                    <button class="recovery" type="submit"> <i
                                                            class="fa-solid fa-arrow-rotate-left mx-2"></i></button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </header>
@endsection
@section('scripts')
    <script></script>
@endsection
