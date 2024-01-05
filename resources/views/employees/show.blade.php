@extends('layouts.app')
@section('title', 'Detail Pegawai')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Form Detail Pegawai</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nomor Induk</label>
                            <input type="text" class="form-control"
                                value="{{ $id }}" readonly />
                        </div>
                        <div class="form-group">
                            <label>Nama Pegawai</label>
                            <input type="text" class="form-control"
                                value="{{ $employee->name }}" readonly />
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control"
                                value={{ $employee->address }} readonly />
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control"
                                value="{{ $employee->birthday }}" readonly />
                        </div>
                        <div class="form-group">
                            <label>Tanggal Bergabung</label>
                            <input type="date" class="form-control"
                                value="{{ $employee->join_date }}" readonly />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
