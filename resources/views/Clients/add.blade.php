@extends('Shared.top')
@section('contentMain')

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Agregar nuevo cliente</h1>
</div>
<div class="row form-container">
  <div class="col-lg-11">

    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Datos del cliente</h6>
      </div>
      <div class="card-body">
        <form class="user" action="#" id="client-form">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Razón Social:</label>
                        <input type="text" class="form-control" maxlength="50" v-model="name" />
                        <label for="name" class="validate-msg">Este campo es requerido</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="alias">Alias:</label>
                        <input type="text" class="form-control" maxlength="50" v-model="alias" />
                        <label for="name" class="validate-msg">Este campo es requerido</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">R.F.C:</label>
                        <input type="text" class="form-control" maxlength="15" v-model="rfc" />
                        <label for="name" class="validate-msg">Este campo es requerido</label>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <div class="form-group">
                    <a href="#" class="btn btn-primary btn-icon-split" @click="SaveClient">
                        <span class="text">Guardar</span>
                    </a>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<!-- /.container-fluid -->
<script>

Vue.use(window.vuelidate.default)
var required = window.validators.required

new Vue({
    el: '#client-form',
    data: {
        name: '',
        alias: '',
        rfc: ''
    },
    validations: {    
        name:{
            required
        },
        alias:{
            required
        },
        rfc:{
            required
        }
    },
    methods: {
        SaveClient: function () {
            if(this.$v.$invalid){
                alert("Datos invalidos");
            }
            else{
                axios.post("{{ url('/clientes/add') }}", { name: this.name, alias: this.alias, rfc: this.rfc }, {
                    headers: {}
                })
                .then((response) => {
                    console.log(response);
                })
                .catch((ex) => {
                    console.log(ex.message);
                })
            }
        }
    }
})
</script>

@endsection