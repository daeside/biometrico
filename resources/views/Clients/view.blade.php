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
      <table class="table table-bordered" id="clients-table" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Razon social</th>
            <th>R.F.C.</th>
            <th>Fecha alta</th>
            <th>Editar</th>
            <th>Eliminar</th>
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
$(document).ready(function() {


  $.get("/clientes/get", function(result){
    $('#clients-table').dataTable().fnClearTable();
    $('#clients-table').dataTable().fnDraw();
    $('#clients-table').dataTable().fnDestroy();

    result.forEach(item => 
     $("#clients-table").DataTable().row.add([
        item.name, item.alias, item.rfc, item.date_add, '1', '2'
      ]).draw()
    );
  });
});
</script>

@endsection