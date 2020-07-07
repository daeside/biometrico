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
            <th>Opciones</th>
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
                "<a href='#' class='btn btn-info btn-icon-split'><i class='fas fa-edit'></i></a><a href='#' class='btn btn-danger btn-icon-split'><i class='fas fa-trash'></i></a>"
            ]).draw()
        );
    })
    .catch(ex => {
        console.log(ex.message);
    })
});

</script>

@endsection