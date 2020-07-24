@extends('Shared.top')
@section('contentMain')
{{--json_encode($data)--}}
<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Editar cliente</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
    <form class="user" action="#" id="product-update">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" v-model="nombre" />
                    <span class="validate-msg" v-if="submitted && !$v.nombre.required">Este campo es requerido</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Alias</label>
                    <input type="text" class="form-control" v-model="alias" />
                    <span class="validate-msg" v-if="submitted && !$v.alias.required">Este campo es requerido</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>R.F.C</label>
                    <input type="text" class="form-control" v-model="rfc" />
                    <span class="validate-msg" v-if="submitted && !$v.rfc.required">Este campo es requerido</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Vigencia:</label>
                        <div>
                            <v-date-picker 
                                v-model="range"
                                :mode="dateOptions.mode"
                                :min-date="dateOptions.minDate"
                                :attributes="dateOptions.attrs"
                                :input-props="dateOptions.inputProps"
                                :popover="dateOptions.display"
                                :masks="{ data: ['YYYY-MM-DD'] }"
                             />
                        </div>
                    <span class="validate-msg" v-if="submitted && !$v.range.required">Este campo es requerido</span>
                </div>
            </div>

            
            <div class="col-md-12" style="text-align: center;">
                <div class="form-group btn-container">
                    <a href="#" class="btn btn-primary btn-icon-split" @click="UpdateClient">
                        <span class="text">Modificar</span>
                    </a>
                </div>
            </div>
        </div>
    </form>
  </div>
</div>
</div>
<!-- /.container-fluid -->
<script>
    Vue.use(window.vuelidate.default)
    let rules = {
        required: window.validators.required,
        numeric: window.validators.numeric,
        integer: window.validators.integer
    };

    new Vue({
    el: '#product-update',
    data: {
        id: '{{ $data->id }}',
        nombre: '{{ $data->nombre }}',
        alias: '{{ $data->alias }}',
        rfc: '{{ $data->rfc }}',
        range: '',
        dateOptions: {
            minDate: new Date(),
            mode: 'range',
            attrs: [
                {
                    key: 'today',
                    highlight: true,
                    dates: new Date(),
                    //dates: [{start: new Date(2020, 7, 01), end: new Date(2020, 7, 31) }]
                }
            ],
            inputProps: {
                readonly: true,
                class: 'form-control'
            },
            display: { visibility: 'click' }
        },
        submitted: false
    },
    validations: { 
        /*   
        precio:{
            required: rules.required,
            numeric: rules.numeric
        },
        mayoreo:{
            required: rules.required,
            numeric: rules.numeric
        },
        stock:{
            required: rules.required,
            integer: rules.integer
        },
        nombre:{
            required: rules.required
        }
        */
    },
    methods: {
        UpdateClient: function(){
            if(this.$v.$invalid){
                this.submitted = true;
            }
            else
            {
                /*
                let request = {
                    id: this.id, 
                    precio: this.precio, 
                    mayoreo: this.mayoreo,
                    nombre: this.nombre,
                    stock: this.stock
                };
                axios.post("{{ url('/editar-producto') }}", request, {
                    headers: {}
                })
                .then((response) => {
                    if(response.data){
                        alert("Se modifico correctamente");
                        location.reload();
                    }
                    else{
                        alert("No se modificaron los datos");
                    }
                })
                .catch((ex) => {
                    console.log(ex.message);
                })
                */
            }
        }
    }
})
</script>

@endsection