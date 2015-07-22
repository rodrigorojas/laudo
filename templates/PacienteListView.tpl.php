<?php
	$this->assign('title','LAUDO | Pacientes');
	$this->assign('nav','pacientes');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/pacientes.js").wait(function(){
		$(document).ready(function(){
			page.init();
		});
		
		// hack for IE9 which may respond inconsistently with document.ready
		setTimeout(function(){
			if (!page.isInitialized) page.init();
		},1000);
	});
</script>

<div class="container">

<h1>
	<i class="icon-th-list"></i> Pacientes
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="pacienteCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_CdPaciente">Cd Paciente<% if (page.orderBy == 'CdPaciente') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DsPaciente">Ds Paciente<% if (page.orderBy == 'DsPaciente') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DtNascimento">Dt Nascimento<% if (page.orderBy == 'DtNascimento') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DsSexo">Ds Sexo<% if (page.orderBy == 'DsSexo') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DsObservacao">Ds Observacao<% if (page.orderBy == 'DsObservacao') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_FlAtivo">Fl Ativo<% if (page.orderBy == 'FlAtivo') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('cdPaciente')) %>">
				<td><%= _.escape(item.get('cdPaciente') || '') %></td>
				<td><%= _.escape(item.get('dsPaciente') || '') %></td>
				<td><%if (item.get('dtNascimento')) { %><%= _date(app.parseDate(item.get('dtNascimento'))).format('MMM D, YYYY') %><% } else { %>NULL<% } %></td>
				<td><%= _.escape(item.get('dsSexo') || '') %></td>
				<td><%= _.escape(item.get('dsObservacao') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('flAtivo') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="pacienteModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="cdPacienteInputContainer" class="control-group">
					<label class="control-label" for="cdPaciente">Cd Paciente</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="cdPaciente"><%= _.escape(item.get('cdPaciente') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dsPacienteInputContainer" class="control-group">
					<label class="control-label" for="dsPaciente">Ds Paciente</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="dsPaciente" placeholder="Ds Paciente" value="<%= _.escape(item.get('dsPaciente') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dtNascimentoInputContainer" class="control-group">
					<label class="control-label" for="dtNascimento">Dt Nascimento</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
							<input id="dtNascimento" type="text" value="<%= _date(app.parseDate(item.get('dtNascimento'))).format('YYYY-MM-DD') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dsSexoInputContainer" class="control-group">
					<label class="control-label" for="dsSexo">Ds Sexo</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="dsSexo" placeholder="Ds Sexo" value="<%= _.escape(item.get('dsSexo') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dsObservacaoInputContainer" class="control-group">
					<label class="control-label" for="dsObservacao">Ds Observacao</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="dsObservacao" placeholder="Ds Observacao" value="<%= _.escape(item.get('dsObservacao') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="flAtivoInputContainer" class="control-group">
					<label class="control-label" for="flAtivo">Fl Ativo</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="flAtivo" placeholder="Fl Ativo" value="<%= _.escape(item.get('flAtivo') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deletePacienteButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletePacienteButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Paciente</button>
						<span id="confirmDeletePacienteContainer" class="hide">
							<button id="cancelDeletePacienteButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletePacienteButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="pacienteDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Paciente
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="pacienteModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savePacienteButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="pacienteCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newPacienteButton" class="btn btn-primary">Add Paciente</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
