@extends('Shared.top')
@section('contentMain')

<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Lista de clientes</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-condensed compact nowrap" id="clients-table" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Razon social</th>
            <th>R.F.C.</th>
            <th>Alta</th>
            <th>Desde</th>
            <th>Hasta</th>
            <th>Editar</th>
            <th>Borrar</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<!-- /.container-fluid -->
<script>

Vue.use(Toasted)

function DisableProduct(id)
{
    event.preventDefault();

    if(confirm("¿Realmente desea borrar el producto?"))
    {
        axios.delete("{{ url('/eliminar-cliente') }}/" + id)
        .then(response => {
            console.log(response);
            if(response.data)
            {
                alert("Se borro correctamente");
                location.reload();
            }
        })
        .catch(ex => {
            console.log(ex.message);
        })
    }
}

ready(function(){
    dataTableConfig("clients-table", [{ "className": "dt-center", "targets": [4] }]);

    axios.get("{{ url('/clientes/get') }}")
    .then(response => {
        response.data.forEach(item => 
            $("#clients-table").DataTable().row.add([
                item.nombre, 
                item.alias, 
                item.rfc, 
                item.fechaAlta,
                item.start,
                item.end, 
                "<a href='{{ url('/clientes/ver/editar') }}/"+item.id+"' target='_blank'><i class='fas fa-edit'></i></a>",
                "<a href='#'><i class='fas fa-trash' onclick='DisableProduct("+item.id+");'></i></a>"
            ]).draw()
        );
    })
    .catch(ex => {
        console.log(ex.message);
    })
});

</script>

@endsection