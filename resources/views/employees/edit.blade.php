@extends('layouts.app')
@section('title', 'Edit Pegawai')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Form Edit Pegawai</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                @if (session()->has('failed'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>x</span>
                            </button>
                            {{ session('failed') }}
                        </div>
                    </div>
                @endif
                <form action="{{ url('employees/' . $id) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="employee-name">Nama Pegawai</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $employee->name }}" id="employee-name" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    name="address" value={{ $employee->address }} id="address" />
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="birthday">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('birthday') is-invalid @enderror"
                                    name="birthday" value="{{ $employee->birthday }}" id="birthday" />
                                @error('birthday')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
