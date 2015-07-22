<?php
	$this->assign('title','LAUDO | SituacaoExames');
	$this->assign('nav','situacaoexames');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/situacaoexames.js").wait(function(){
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
	<i class="icon-th-list"></i> SituacaoExames
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="situacaoExameCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_CdSituacaoExame">Cd Situacao Exame<% if (page.orderBy == 'CdSituacaoExame') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DsSituacaoExame">Ds Situacao Exame<% if (page.orderBy == 'DsSituacaoExame') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_FlAtivo">Fl Ativo<% if (page.orderBy == 'FlAtivo') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('cdSituacaoExame')) %>">
				<td><%= _.escape(item.get('cdSituacaoExame') || '') %></td>
				<td><%= _.escape(item.get('dsSituacaoExame') || '') %></td>
				<td><%= _.escape(item.get('flAtivo') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="situacaoExameModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="cdSituacaoExameInputContainer" class="control-group">
					<label class="control-label" for="cdSituacaoExame">Cd Situacao Exame</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="cdSituacaoExame"><%= _.escape(item.get('cdSituacaoExame') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dsSituacaoExameInputContainer" class="control-group">
					<label class="control-label" for="dsSituacaoExame">Ds Situacao Exame</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="dsSituacaoExame" placeholder="Ds Situacao Exame" value="<%= _.escape(item.get('dsSituacaoExame') || '') %>">
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
		<form id="deleteSituacaoExameButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteSituacaoExameButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete SituacaoExame</button>
						<span id="confirmDeleteSituacaoExameContainer" class="hide">
							<button id="cancelDeleteSituacaoExameButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteSituacaoExameButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="situacaoExameDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit SituacaoExame
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="situacaoExameModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveSituacaoExameButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="situacaoExameCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newSituacaoExameButton" class="btn btn-primary">Add SituacaoExame</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
