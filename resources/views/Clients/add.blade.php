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
                        <span class="validate-msg" v-if="submitted && !$v.name.required">Este campo es requerido</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="alias">Alias:</label>
                        <input type="text" class="form-control" maxlength="50" v-model="alias" />
                        <span class="validate-msg" v-if="submitted && !$v.alias.required">Este campo es requerido</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">R.F.C:</label>
                        <input type="text" class="form-control" maxlength="15" v-model="rfc" />
                        <span class="validate-msg" v-if="submitted && !$v.rfc.required">Este campo es requerido</span>
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
Vue.use(Toasted)
let required = window.validators.required

new Vue({
    el: '#client-form',
    data: {
        name: '',
        alias: '',
        rfc: '',
        submitted: false
    },
    validations: {    
        name:{
            required: required
        },
        alias:{
            required: required
        },
        rfc:{
            required: required
        }
    },
    methods: {
        SaveClient: function () {

            if(this.$v.$invalid){
                this.submitted = true;
            }
            else{
                axios.post("{{ url('/clientes/add') }}", { name: this.name, alias: this.alias, rfc: this.rfc }, {
                    headers: {}
                })
                .then((response) => {
                    if(response.data){
                        this.$toasted.show("Nuevo cliente creado", { 
	                        theme: "toasted-primary", 
	                        position: "top-right", 
                            duration : 2000,
                            type: "success",
                            onComplete: function(){
                                location.reload();
                            }
                        });
                    }
                    else{
                        this.$toasted.show("No se creo el cliente", { 
	                        theme: "toasted-primary", 
	                        position: "top-right", 
                            duration : 3000,
                            type: "error"
                        });
                    }
                })
                .catch((ex) => {
                    this.$toasted.show(ex.message, { 
	                    theme: "toasted-primary", 
	                    position: "top-right", 
                        duration : 3000,
                        type: "error"
                    });
                })
            }
        }
    }
})
</script>

@endsection