<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4><b>Tambah Data</b></h4>
                    @isset($user)
                        <form action="/admin/user/{{ $user->id }}" method="POST">
                            @method('put')
                    @else
                    @endisset
                    <form action="/admin/user" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for=""><b>Nama Lengkap</b></label>
                            <input type="text" name="name" placeholder="Nama Lengkap" value="{{ isset($user) ? $user->name : '' }}" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for=""><b>Email</b></label>
                            <input type="text" name="email" placeholder="Email" value="{{ isset($user) ? $user->email : '' }}" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for=""><b>Password</b></label>
                            <input type="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for=""><b>Konfrmasi Password</b></label>
                            <input type="password" name="re_password" placeholder="Password" class="form-control @error('re_password') is-invalid @enderror">
                            @error('re_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <a href="/admin/user" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>