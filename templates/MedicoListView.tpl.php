<?php
	$this->assign('title','LAUDO | Medicos');
	$this->assign('nav','medicos');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/medicos.js").wait(function(){
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
	<i class="icon-th-list"></i> Medicos
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="medicoCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_CdMedico">Cd Medico<% if (page.orderBy == 'CdMedico') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DsMedico">Ds Medico<% if (page.orderBy == 'DsMedico') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DsCrm">Ds Crm<% if (page.orderBy == 'DsCrm') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_FlAtivo">Fl Ativo<% if (page.orderBy == 'FlAtivo') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_BbAssinatura">Bb Assinatura<% if (page.orderBy == 'BbAssinatura') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('cdMedico')) %>">
				<td><%= _.escape(item.get('cdMedico') || '') %></td>
				<td><%= _.escape(item.get('dsMedico') || '') %></td>
				<td><%= _.escape(item.get('dsCrm') || '') %></td>
				<td><%= _.escape(item.get('flAtivo') || '') %></td>
				<td><%= _.escape(item.get('bbAssinatura') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="medicoModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="cdMedicoInputContainer" class="control-group">
					<label class="control-label" for="cdMedico">Cd Medico</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="cdMedico"><%= _.escape(item.get('cdMedico') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dsMedicoInputContainer" class="control-group">
					<label class="control-label" for="dsMedico">Ds Medico</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="dsMedico" placeholder="Ds Medico" value="<%= _.escape(item.get('dsMedico') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dsCrmInputContainer" class="control-group">
					<label class="control-label" for="dsCrm">Ds Crm</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="dsCrm" placeholder="Ds Crm" value="<%= _.escape(item.get('dsCrm') || '') %>">
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
				<div id="bbAssinaturaInputContainer" class="control-group">
					<label class="control-label" for="bbAssinatura">Bb Assinatura</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="bbAssinatura" placeholder="Bb Assinatura" value="<%= _.escape(item.get('bbAssinatura') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteMedicoButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteMedicoButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Medico</button>
						<span id="confirmDeleteMedicoContainer" class="hide">
							<button id="cancelDeleteMedicoButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteMedicoButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="medicoDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Medico
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="medicoModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveMedicoButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="medicoCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newMedicoButton" class="btn btn-primary">Add Medico</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
