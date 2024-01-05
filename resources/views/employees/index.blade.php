@extends('layouts.app')
@section('title', 'Daftar Pegawai')

@section('content')
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Daftar Pegawai</h1>
            <a href="{{ url('/employees/create') }}" class="btn btn-primary">Tambah Pegawai</a>
        </div>

        <div class="section-body">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>x</span>
                        </button>
                        {{ session('success') }}
                    </div>
                </div>
            @elseif (session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>x</span>
                        </button>
                        {{ session('failed') }}
                    </div>
                </div>
            @endif
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-right">
                                <form>
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Induk</th>
                                            <th>Name</th>
                                            <th>Alamat</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Tanggal Bergabung</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $index => $employee)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $employee->id_number }}
                                                <td>{{ $employee->name }}
                                                    <div class="table-links">
                                                        <a href="{{ url('/employees/' . $employee->id_number) }}">View</a>
                                                        <div class="bullet"></div>
                                                        <a
                                                            href="{{ url('/employees/' . $employee->id_number . '/edit') }}">Edit</a>
                                                        <div class="bullet"></div>
                                                        <form action="{{ url('/employees/' . $employee->id_number) }}"
                                                            class="d-inline" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-link text-danger border-0 bg-transparent p-0">Trash</button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td>{{ $employee->address }}</td>
                                                <td>{{ $employee->birthday }}</td>
                                                <td>{{ $employee->join_date }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right">
                                {{ $employees->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>3 karyawan yang pertama kali bergabung</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Induk</th>
                                            <th>Name</th>
                                            <th>Alamat</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Tanggal Bergabung</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($oldEmployees as $employee)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $employee->id_number }}
                                                <td>{{ $employee->name }}
                                                    <div class="table-links">
                                                        <a href="{{ url('/employees/' . $employee->id_number) }}">View</a>
                                                        <div class="bullet"></div>
                                                        <a
                                                            href="{{ url('/employees/' . $employee->id_number . '/edit') }}">Edit</a>
                                                        <div class="bullet"></div>
                                                        <form action="{{ url('/employees/' . $employee->id_number) }}"
                                                            class="d-inline" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-link text-danger border-0 bg-transparent p-0">Trash</button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td>{{ $employee->address }}</td>
                                                <td>{{ $employee->birthday }}</td>
                                                <td>{{ $employee->join_date }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar karyawan yang saat ini pernah mengambil cuti</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Induk</th>
                                            <th>Name</th>
                                            <th>Alamat</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Tanggal Bergabung</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employeeEverLeave as $employee)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $employee->id_number }}
                                                <td>{{ $employee->name }}
                                                    <div class="table-links">
                                                        <a href="{{ url('/employees/' . $employee->id_number) }}">View</a>
                                                        <div class="bullet"></div>
                                                        <a
                                                            href="{{ url('/employees/' . $employee->id_number . '/edit') }}">Edit</a>
                                                        <div class="bullet"></div>
                                                        <form action="{{ url('/employees/' . $employee->id_number) }}"
                                                            class="d-inline" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-link text-danger border-0 bg-transparent p-0">Trash</button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td>{{ $employee->address }}</td>
                                                <td>{{ $employee->birthday }}</td>
                                                <td>{{ $employee->join_date }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right">
                                {{ $employeeEverLeave->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sisa Cuti Karyawan</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Induk</th>
                                            <th>Nama</th>
                                            <th>Sisa Cuti</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employeeLeave as $employee)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $employee->id_number }}
                                                <td>{{ $employee->name }} </td>
                                                <td>{{ 12 - $employee->leaves_sum_duration }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right">
                                {{ $employeeLeave->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
