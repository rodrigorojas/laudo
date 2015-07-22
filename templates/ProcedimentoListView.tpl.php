<?php
	$this->assign('title','LAUDO | Procedimentos');
	$this->assign('nav','procedimentos');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/procedimentos.js").wait(function(){
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
	<i class="icon-th-list"></i> Procedimentos
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="procedimentoCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_CdProcedimento">Cd Procedimento<% if (page.orderBy == 'CdProcedimento') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DsProcedimento">Ds Procedimento<% if (page.orderBy == 'DsProcedimento') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_FlAtivo">Fl Ativo<% if (page.orderBy == 'FlAtivo') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CdModalidade">Cd Modalidade<% if (page.orderBy == 'CdModalidade') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('cdProcedimento')) %>">
				<td><%= _.escape(item.get('cdProcedimento') || '') %></td>
				<td><%= _.escape(item.get('dsProcedimento') || '') %></td>
				<td><%= _.escape(item.get('flAtivo') || '') %></td>
				<td><%= _.escape(item.get('cdModalidade') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="procedimentoModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="cdProcedimentoInputContainer" class="control-group">
					<label class="control-label" for="cdProcedimento">Cd Procedimento</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="cdProcedimento"><%= _.escape(item.get('cdProcedimento') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dsProcedimentoInputContainer" class="control-group">
					<label class="control-label" for="dsProcedimento">Ds Procedimento</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="dsProcedimento" placeholder="Ds Procedimento" value="<%= _.escape(item.get('dsProcedimento') || '') %>">
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
				<div id="cdModalidadeInputContainer" class="control-group">
					<label class="control-label" for="cdModalidade">Cd Modalidade</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="cdModalidade" placeholder="Cd Modalidade" value="<%= _.escape(item.get('cdModalidade') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteProcedimentoButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteProcedimentoButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Procedimento</button>
						<span id="confirmDeleteProcedimentoContainer" class="hide">
							<button id="cancelDeleteProcedimentoButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteProcedimentoButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="procedimentoDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Procedimento
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="procedimentoModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveProcedimentoButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="procedimentoCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newProcedimentoButton" class="btn btn-primary">Add Procedimento</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
