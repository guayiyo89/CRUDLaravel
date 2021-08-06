
<form action="{{ url('/empleado') }}" method="post" enctype="multipart/form-data">
@csrf
@include('empleado.form',['modo'=>'Crear']);
</form>
<!-- be careful about the item's name they must be the same to database and model. -->