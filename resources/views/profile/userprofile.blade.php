@extends('layouts.template')

@section('title', $title)

@section('main')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profil</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active">Profil</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <button type="button" class="btn" data-toggle="modal"
                                    data-target="#modal_profile_photo_update">
                                    @if (isset(Auth::user()->photo_profile))
                                        <img class="profile-user-img img-fluid img-circle"
                                            src="{{ asset('storage/' . Auth::user()->photo_profile) }}"
                                            alt="User profile picture">
                                    @else
                                        <img class="profile-user-img img-fluid img-circle"
                                            src="{{ asset('photo/default.jpg') }}"
                                            alt="User profile picture">
                                    @endif
                                </button>
                                <div class="modal fade" id="modal_profile_photo_update">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ganti Foto Profil</h4>
                                            </div>
                                            <form class="form-horizontal"
                                                action="{{ route('photo.update', Auth::user()->id) }}" method="post"
                                                autocomplete="off" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Pilih File</label>
                                                        <div class="col-sm-8">
                                                            <input type="file" name="photo_profile"
                                                                class="form-control @error('photo_profile') is-invalid @enderror"
                                                                placeholder="Pilih File" required>
                                                            @error('photo_profile')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"
                                                        title="Batal">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                    <button type="submit" class="btn btn-primary" title="Simpan">
                                                        <i class="fa fa-save"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            </div>
                            <h3 class="profile-username text-center">{{ Str::title(Str::limit($user->name, 20, '.')) }}
                            </h3>
                            <p class="text-muted text-center">User Id <b>{{ $user->user_id }}</b></p>
                            <ul class="list-group list-group-unbordered mb-3">
                                @if (Auth::user()->role == 'Admin')
                                    <li class="list-group-item">
                                        <b>Role</b> <a class="float-right text-decoration-none">{{ $user->role }}</a>
                                    </li>
                                @endif
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right text-decoration-none">{{ $user->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>No HP</b> <a class="float-right text-decoration-none">{{ $user->no_telepon }}</a>
                                </li>
                            </ul>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-block"><b>Log Out</b></button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings"
                                        data-toggle="tab">Profil</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Password</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">
                                    <form class="form-horizontal" action="{{ route('profile.update', Auth::user()->id) }}"
                                        method="post" id="profil_form">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="profil_input_name" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    id="profil_input_name" placeholder="ex : Nama User"
                                                    value="{{ Auth::user()->name }}" maxlength="20" readonly required>
                                                @error('name')
                                                    <span class="text-danger ms-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="profil_input_email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="profil_input_email" placeholder="ex : example@gmail.com"
                                                    value="{{ Auth::user()->email }}" readonly required>
                                                @error('email')
                                                    <span class="text-danger ms-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="profil_input_no_hp" class="col-sm-2 col-form-label">No HP</label>
                                            <div class="col-sm-10">
                                                <input type="tel" name="no_telepon"
                                                    class="form-control @error('no_telepon') is-invalid @enderror"
                                                    id="profil_input_no_hp" placeholder="ex : 08**********"
                                                    value="{{ Auth::user()->no_telepon }}" pattern="(0)8[1-9][0-9]{6,9}$"
                                                    readonly required>
                                                @error('no_telepon')
                                                    <span class="text-danger ms-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="button" id="profil_button_edit" class="btn btn-primary"
                                                    title="Edit Data">
                                                    <i class="fa fa-file-signature"></i>
                                                </button>
                                                <button type="submit" id="profil_button_simpan"
                                                    class="btn btn-primary d-none" title="Simpan data">
                                                    <i class="fa fa-save"></i>
                                                </button>
                                                <button type="button" id="profil_button_batal"
                                                    class="btn btn-danger d-none" title="Batal">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="activity">
                                    <form class="form-horizontal"
                                        action="{{ route('password.update', Auth::user()->id) }}" method="post"
                                        id="profil_pass_form">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="profil_input_old_pass" class="col-sm-4 col-form-label">Password
                                                Lama</label>
                                            <div class="col-sm-8">
                                                <input type="password" name="old_password"
                                                    class="form-control @error('old_password') is-invalid @enderror"
                                                    id="profil_input_old_pass" placeholder="Password Lama" required
                                                    readonly>
                                                @error('old_password')
                                                    <span class="text-danger ms-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="profil_input_new_pass" class="col-sm-4 col-form-label">Password
                                                Baru</label>
                                            <div class="col-sm-8">
                                                <input type="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="profil_input_new_pass" placeholder="min : 8 karakter" required
                                                    readonly>
                                                @error('password')
                                                    <span class="text-danger ms-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="profil_input_con_pass" class="col-sm-4 col-form-label">Konfirmasi
                                                Password</label>
                                            <div class="col-sm-8">
                                                <input type="password" name="password_confirmation"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    id="profil_input_con_pass" placeholder="Konfirmasi" required readonly>
                                                @error('password_confirmation')
                                                    <span class="text-danger ms-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-4 col-sm-8">
                                                <button type="button" id="profil_button_edit_pass"
                                                    class="btn btn-primary" title="Edit Password">
                                                    <i class="fa fa-file-signature"></i>
                                                </button>
                                                <button type="submit" id="profil_button_simpan_pass"
                                                    class="btn btn-primary d-none" title="Simpan data">
                                                    <i class="fa fa-save"></i>
                                                </button>
                                                <button type="button" id="profil_button_eye_pass"
                                                    class="btn btn-primary d-none" title="Tutup Password">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <button type="button" id="profil_button_eye_slash_pass"
                                                    class="btn btn-primary d-none" title="Lihat Password">
                                                    <i class="fa fa-eye-slash"></i>
                                                </button>
                                                <button type="button" id="profil_button_batal_pass"
                                                    class="btn btn-danger d-none" title="Batal">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // Profil
            const pForm = $('#profil_form');
            const pInputName = $('#profil_input_name');
            const pInputEmail = $('#profil_input_email');
            const pInputNoHp = $('#profil_input_no_hp');
            const pBtnEdit = $('#profil_button_edit');
            const pBtnSave = $('#profil_button_simpan');
            const pBtnCancel = $('#profil_button_batal');

            // Password
            const pPassForm = $('#profil_pass_form');
            const pPassOld = $('#profil_input_old_pass');
            const pPassOldAttr = $(pPassOld).attr('type');
            const pPassNew = $('#profil_input_new_pass');
            const pPassNewAttr = $(pPassNew).attr('type');
            const pPassCon = $('#profil_input_con_pass');
            const pPassConAttr = $(pPassCon).attr('type');
            const pPassBtnEdit = $('#profil_button_edit_pass');
            const pPassBtnSave = $('#profil_button_simpan_pass');
            const pPassBtnEye = $('#profil_button_eye_pass');
            const pPassBtnEyeSlash = $('#profil_button_eye_slash_pass');
            const pPassBtnCancel = $('#profil_button_batal_pass');

            // Profil
            $(pForm).keydown(function(e) {
                if (e.key === "Enter") {
                    e.preventDefault();
                }
            });

            $(pBtnEdit).click(function() {
                $(pInputName).removeAttr('readonly');
                $(pInputEmail).removeAttr('readonly');
                $(pInputNoHp).removeAttr('readonly');
                $(pBtnEdit).toggleClass('d-none');
                $(pBtnSave).toggleClass('d-none');
                $(pBtnCancel).toggleClass('d-none');
            });

            $(pBtnCancel).click(function() {
                $(pInputName).prop('readonly', true);
                $(pInputEmail).prop('readonly', true);
                $(pInputNoHp).prop('readonly', true);
                $(pBtnEdit).toggleClass('d-none');
                $(pBtnSave).toggleClass('d-none');
                $(pBtnCancel).toggleClass('d-none');
            });

            // Password
            $(pPassForm).keydown(function(e) {
                if (e.key === "Enter") {
                    e.preventDefault();
                }
            });

            $(pPassBtnEdit).click(function() {
                $(pPassOld).removeAttr('readonly').attr('type', 'password');
                $(pPassNew).removeAttr('readonly').attr('type', 'password');
                $(pPassCon).removeAttr('readonly').attr('type', 'password');
                $(pPassBtnEdit).toggleClass('d-none');
                $(pPassBtnSave).toggleClass('d-none');
                $(pPassBtnEye).addClass('d-none');
                $(pPassBtnEyeSlash).toggleClass('d-none');
                $(pPassBtnCancel).toggleClass('d-none');
            });

            $(pPassBtnEyeSlash).click(function() {
                $(pPassOld).attr('type', 'text');
                $(pPassNew).attr('type', 'text');
                $(pPassCon).attr('type', 'text');
                $(pPassBtnEye).removeClass('d-none');
                $(pPassBtnEyeSlash).addClass('d-none');
            });

            $(pPassBtnEye).click(function() {
                $(pPassOld).attr('type', 'password');
                $(pPassNew).attr('type', 'password');
                $(pPassCon).attr('type', 'password');
                $(pPassBtnEye).addClass('d-none');
                $(pPassBtnEyeSlash).removeClass('d-none');
            });

            $(pPassBtnCancel).click(function() {
                $(pPassOld).prop('readonly', true).attr('type', 'password');
                $(pPassNew).prop('readonly', true).attr('type', 'password');
                $(pPassCon).prop('readonly', true).attr('type', 'password');
                $(pPassBtnEdit).toggleClass('d-none');
                $(pPassBtnSave).toggleClass('d-none');
                $(pPassBtnEye).addClass('d-none');
                $(pPassBtnEyeSlash).addClass('d-none');
                $(pPassBtnCancel).toggleClass('d-none');
            });
        });
    </script>
@endsection
