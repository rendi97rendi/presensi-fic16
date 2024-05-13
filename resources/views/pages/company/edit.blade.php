@extends('layouts.app')

@section('title', 'Perusahaan - Ubah')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Manajemen Perusahaan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Beranda</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('companies.index') }}">Perusahaan</a></div>
                    <div class="breadcrumb-item">Ubah</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Ubah Perusahaan</h2>

                <div class="card">
                    <form action="{{ route('companies.update', $company) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"
                                    class="form-control @error('name')
                                is-invalid
                            @enderror"
                                    name="name" value="{{ old('name') ?? $company->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email"
                                    class="form-control @error('email')
                                is-invalid
                            @enderror"
                                    name="email" value="{{ old('email') ?? $company->email }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea
                                    class="form-control @error('address')
                                    is-invalid
                                @enderror"
                                    name="address" rows="3">{{ old('address') ?? $company->address }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Latitude</label>
                                        <input type="text"
                                            class="form-control @error('latitude')
                                        is-invalid
                                    @enderror"
                                            name="latitude" value="{{ old('latitude') ?? $company->latitude }}">
                                        @error('latitude')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Longitude</label>
                                        <input type="text"
                                            class="form-control @error('longitude')
                                        is-invalid
                                    @enderror"
                                            name="longitude" value="{{ old('longitude') ?? $company->longitude }}">
                                        @error('longitude')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Radius</label>
                                <div class="input-group">
                                    <input type="number" step="0.1"
                                        class="form-control @error('radius')
                                    is-invalid
                                @enderror"
                                        name="radius" value="{{ old('radius') ?? $company->radius }}">
                                    @error('radius')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="input-group-append">
                                        <div class="input-group-text">KM</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Time In</label>
                                        <input type="time"
                                            class="form-control @error('time_in')
                                        is-invalid
                                    @enderror"
                                            name="time_in" value="{{ old('time_in') ?? $company->time_in }}">
                                        @error('time_in')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Time Out</label>
                                        <input type="time"
                                            class="form-control @error('time_out')
                                        is-invalid
                                    @enderror"
                                            name="time_out" value="{{ old('time_out') ?? $company->time_out }}">
                                        @error('time_out')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right row">
                            <div class="col">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary w-100 text-dark">KEMBALI</a>
                            </div>

                            <div class="col">
                                <button class="btn btn-success w-100">SIMPAN</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
