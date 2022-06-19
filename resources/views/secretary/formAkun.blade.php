@extends("secretary.main")

@section("content")

<div class="card">
    <form class="form-horizontal">
      <div class="card-body">
        <center><h4 class="card-title">Tambah Akun</h4>
        <div class="form-group row">
          <label
            for="fname"
            class="col-sm-3 text-end control-label col-form-label"
            >Nama</label
          >
          <div class="col-sm-9">
            <input
              type="text"
              class="form-control"
              id="fname"
              placeholder="Input Nama"
            />
          </div>
        </div>
        <div class="form-group row">
          <label
            for="lname"
            class="col-sm-3 text-end control-label col-form-label"
            >Email</label
          >
          <div class="col-sm-9">
            <input
              type="text"
              class="form-control"
              id="lname"
              placeholder="Input Email"
            />
          </div>
        </div>
        <div class="form-group row">
          <label
            for="lname"
            class="col-sm-3 text-end control-label col-form-label"
            >NIP</label
          >
          <div class="col-sm-9">
            <input
              type="password"
              class="form-control"
              id="lname"
              placeholder="Input NIP"
            />
          </div>
        </div>
        <div class="form-group row">
          <label
            for="email1"
            class="col-sm-3 text-end control-label col-form-label"
            >Password</label
          >
          <div class="col-sm-9">
            <input
              type="text"
              class="form-control"
              id="email1"
              placeholder="Input Password"
            />
          </div>
        </div>
        <div class="form-group row">
            <label
              for="email1"
              class="col-sm-3 text-end control-label col-form-label"
              >Role</label
            >
            <div class="col-sm-9">
              <input
                type="text"
                class="form-control"
                id="email1"
                placeholder="Pilih Role Akun"
              />
            </div>
          </div>
          <div class="form-group row">
            <label
              for="email1"
              class="col-sm-3 text-end control-label col-form-label"
              >Bidang</label
            >
            <div class="col-sm-9">
              <input
                type="text"
                class="form-control"
                id="email1"
                placeholder="Isi Bidang Divisi"
              />
            </div>
          </div>
      </div>
      <div class="border-top">
        <div class="card-body">
          <center><button type="button" class="btn btn-primary">
            Simpan
          </button>
        </div>
      </div>
    </form>
  </div>

@stop