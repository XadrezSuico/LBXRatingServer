@extends('adminlte::page')

@section("title", "Nova Importação")

@section('content_header')
  <h1>Nova Importação</h1>
@stop


@section('css')
	<style>
		.display-none, .displayNone{
			display: none;
		}
	</style>
@endsection

@section("content")
<!-- Main row -->
<ul class="nav nav-pills">
  <li role="presentation"><a href="/importacao">Voltar a Lista de Importações</a></li>
</ul>
<div class="row">
  <!-- Left col -->
  <section class="col-lg-12 connectedSortable">
	<div class="box box-primary" id="inscricao">
		<div class="box-header">
			<h3 class="box-title">Nova Importação</h3>
		</div>
	  <!-- form start -->
        <form method="post" enctype="multipart/form-data">
			<div class="box-body">
				<div class="form-group">
					<label for="tipo_modalidade">Tipo de Modalidade</label>
					<select id="tipo_modalidade" class="form-control" name="tipo_modalidade">
						<option value="">-- Selecione --</option>
						<option value="0">STD</option>
						<option value="1">RPD</option>
						<option value="2">BTZ</option>
					</select>
				</div>
				<div class="form-group">
					<label for="arquivo">Arquivo de Rating (XLSX)</label>
					<input type="file" id="arquivo" name="arquivo">
				</div>
			</div>
			<!-- /.box-body -->

			<div class="box-footer">
				<button type="submit" class="btn btn-success">Enviar</button>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</div>
        </form>
	</div>

  </section>
  <!-- /.Left col -->
</div>
<!-- /.row (main row) -->

@endsection

@section("js")
<!-- Morris.js charts -->
<script type="text/javascript" src="{{url("/js/jquery.mask.min.js")}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
		$("#tipo_modalidade").select2();
  });
</script>
@endsection
