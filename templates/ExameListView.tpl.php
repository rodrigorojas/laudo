<?php
	$this->assign('title','LAUDO | Exames');
	$this->assign('nav','exames');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/exames.js").wait(function(){
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
	<i class="icon-th-list"></i> Exames
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="exameCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_CdExame">Cd Exame<% if (page.orderBy == 'CdExame') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CdProcedimento">Cd Procedimento<% if (page.orderBy == 'CdProcedimento') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DtLancamento">Dt Lancamento<% if (page.orderBy == 'DtLancamento') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CdMedico">Cd Medico<% if (page.orderBy == 'CdMedico') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CdMedicoSolicitante">Cd Medico Solicitante<% if (page.orderBy == 'CdMedicoSolicitante') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_FlLaudado">Fl Laudado<% if (page.orderBy == 'FlLaudado') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CdSituacaoExame">Cd Situacao Exame<% if (page.orderBy == 'CdSituacaoExame') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CdPaciente">Cd Paciente<% if (page.orderBy == 'CdPaciente') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_NuProtocoloInterno">Nu Protocolo Interno<% if (page.orderBy == 'NuProtocoloInterno') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CdModalidade">Cd Modalidade<% if (page.orderBy == 'CdModalidade') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CdLaudo">Cd Laudo<% if (page.orderBy == 'CdLaudo') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('cdExame')) %>">
				<td><%= _.escape(item.get('cdExame') || '') %></td>
				<td><%= _.escape(item.get('cdProcedimento') || '') %></td>
				<td><%if (item.get('dtLancamento')) { %><%= _date(app.parseDate(item.get('dtLancamento'))).format('MMM D, YYYY h:mm A') %><% } else { %>NULL<% } %></td>
				<td><%= _.escape(item.get('cdMedico') || '') %></td>
				<td><%= _.escape(item.get('cdMedicoSolicitante') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('flLaudado') || '') %></td>
				<td><%= _.escape(item.get('cdSituacaoExame') || '') %></td>
				<td><%= _.escape(item.get('cdPaciente') || '') %></td>
				<td><%= _.escape(item.get('nuProtocoloInterno') || '') %></td>
				<td><%= _.escape(item.get('cdModalidade') || '') %></td>
				<td><%= _.escape(item.get('cdLaudo') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="exameModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="cdExameInputContainer" class="control-group">
					<label class="control-label" for="cdExame">Cd Exame</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="cdExame"><%= _.escape(item.get('cdExame') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="cdProcedimentoInputContainer" class="control-group">
					<label class="control-label" for="cdProcedimento">Cd Procedimento</label>
					<div class="controls inline-inputs">
						<select id="cdProcedimento" name="cdProcedimento"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dtLancamentoInputContainer" class="control-group">
					<label class="control-label" for="dtLancamento">Dt Lancamento</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
							<input id="dtLancamento" type="text" value="<%= _date(app.parseDate(item.get('dtLancamento'))).format('YYYY-MM-DD') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<div class="input-append bootstrap-timepicker-component">
							<input id="dtLancamento-time" type="text" class="timepicker-default input-small" value="<%= _date(app.parseDate(item.get('dtLancamento'))).format('h:mm A') %>" />
							<span class="add-on"><i class="icon-time"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="cdMedicoInputContainer" class="control-group">
					<label class="control-label" for="cdMedico">Cd Medico</label>
					<div class="controls inline-inputs">
						<select id="cdMedico" name="cdMedico"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="cdMedicoSolicitanteInputContainer" class="control-group">
					<label class="control-label" for="cdMedicoSolicitante">Cd Medico Solicitante</label>
					<div class="controls inline-inputs">
						<select id="cdMedicoSolicitante" name="cdMedicoSolicitante"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="flLaudadoInputContainer" class="control-group">
					<label class="control-label" for="flLaudado">Fl Laudado</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="flLaudado" placeholder="Fl Laudado" value="<%= _.escape(item.get('flLaudado') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="cdSituacaoExameInputContainer" class="control-group">
					<label class="control-label" for="cdSituacaoExame">Cd Situacao Exame</label>
					<div class="controls inline-inputs">
						<select id="cdSituacaoExame" name="cdSituacaoExame"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="cdPacienteInputContainer" class="control-group">
					<label class="control-label" for="cdPaciente">Cd Paciente</label>
					<div class="controls inline-inputs">
						<select id="cdPaciente" name="cdPaciente"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nuProtocoloInternoInputContainer" class="control-group">
					<label class="control-label" for="nuProtocoloInterno">Nu Protocolo Interno</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="nuProtocoloInterno" placeholder="Nu Protocolo Interno" value="<%= _.escape(item.get('nuProtocoloInterno') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="cdModalidadeInputContainer" class="control-group">
					<label class="control-label" for="cdModalidade">Cd Modalidade</label>
					<div class="controls inline-inputs">
						<select id="cdModalidade" name="cdModalidade"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="cdLaudoInputContainer" class="control-group">
					<label class="control-label" for="cdLaudo">Cd Laudo</label>
					<div class="controls inline-inputs">
						<select id="cdLaudo" name="cdLaudo"></select>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteExameButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteExameButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Exame</button>
						<span id="confirmDeleteExameContainer" class="hide">
							<button id="cancelDeleteExameButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteExameButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="exameDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Exame
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="exameModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveExameButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="exameCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newExameButton" class="btn btn-primary">Add Exame</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
