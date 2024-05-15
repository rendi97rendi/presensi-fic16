@extends('layouts.app')

@section('title', 'Izin - Detail')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <style>
        textarea {
            height: 100px !important;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Manajemen Perizinan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Beranda</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Perizinan</a></div>
                    <div class="breadcrumb-item">Detail</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                <img alt="image" src="{{ asset($permission->image_profile) }}"
                                    class="rounded-circle profile-widget-picture">
                                <div class="profile-widget-items">
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Nomor Hp</div>
                                        <div class="profile-widget-item-value">{{ $permission->user->phone }}</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Department</div>
                                        <div class="profile-widget-item-value">{{ $permission->user->department }}</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Total Kehadiran</div>
                                        <div class="profile-widget-item-value">
                                            {{ $permission->total_kehadiran->attendance_count }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-widget-description">
                                <div class="profile-widget-name text-uppercase">{{ $permission->user->name }} <div
                                        class="text-muted d-inline font-weight-normal">
                                        <div class="slash"></div> {{ $permission->user->position }}
                                    </div>
                                </div>
                                Ujang maman is a superhero name in <b>Indonesia</b>, especially in my family. He is not a
                                fictional character but an original hero in my family, a hero for his children and for his
                                wife. So, I use the name as a user in this template. Not a tribute, I'm just bored with
                                <b>'John Doe'</b>.
                            </div>
                            <div class="card-footer text-center">
                                <div class="font-weight-bold mb-2">Follow Ujang On</div>
                                <a href="#" class="btn btn-social-icon btn-facebook mr-1 btn-dark">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-social-icon btn-twitter mr-1 btn-dark">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-social-icon btn-github mr-1 btn-dark">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a href="#" class="btn btn-social-icon btn-instagram btn-dark">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card">
                            <form method="post" action="{{ route('permissions.update', $permission->id) }}"
                                class="needs-validation" novalidate="">
                                @method('PUT')
                                @csrf
                                <div class="card-header">
                                    <h4>Detail Izin</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Tanggal Perizinan</label>
                                            <input type="text" class="form-control" value="{{ $permission->date }}"
                                                required="">
                                            <div class="invalid-feedback">
                                                Please fill in the first name
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Status Izin</label>
                                            <select class="form-control form-select" name="is_approved">
                                                <option @if ($permission->is_approved == false) selected @endif value="0">
                                                    Ditolak</option>
                                                <option @if ($permission->is_approved == true) selected @endif value="1">
                                                    Diterima</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please fill in the last name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Alasan</label>
                                            <textarea class="form-control" rows="3">{{ $permission->reason }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Bukti Gambar</label>
                                            @if ($permission->image)
                                                <img src="{{ url('document/' . $permission->image . '/permission') }}"
                                                    alt="Foto Bukti" class="img-thumbnail form-control"
                                                    style="height:100%; max-width: 200px;">
                                            @else
                                                <p class="text-danger">Tidak ada bukti pendukung</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
