<?php
	$this->assign('title','LAUDO | Digitadores');
	$this->assign('nav','digitadores');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/digitadores.js").wait(function(){
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
	<i class="icon-th-list"></i> Digitadores
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="digitadorCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_CdDigitador">Cd Digitador<% if (page.orderBy == 'CdDigitador') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DsDigitador">Ds Digitador<% if (page.orderBy == 'DsDigitador') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_FlAtivo">Fl Ativo<% if (page.orderBy == 'FlAtivo') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_FlDigita">Fl Digita<% if (page.orderBy == 'FlDigita') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_FlAssina">Fl Assina<% if (page.orderBy == 'FlAssina') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_FlImprime">Fl Imprime<% if (page.orderBy == 'FlImprime') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('cdDigitador')) %>">
				<td><%= _.escape(item.get('cdDigitador') || '') %></td>
				<td><%= _.escape(item.get('dsDigitador') || '') %></td>
				<td><%= _.escape(item.get('flAtivo') || '') %></td>
				<td><%= _.escape(item.get('flDigita') || '') %></td>
				<td><%= _.escape(item.get('flAssina') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('flImprime') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="digitadorModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="cdDigitadorInputContainer" class="control-group">
					<label class="control-label" for="cdDigitador">Cd Digitador</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="cdDigitador" placeholder="Cd Digitador" value="<%= _.escape(item.get('cdDigitador') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dsDigitadorInputContainer" class="control-group">
					<label class="control-label" for="dsDigitador">Ds Digitador</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="dsDigitador" placeholder="Ds Digitador" value="<%= _.escape(item.get('dsDigitador') || '') %>">
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
				<div id="flDigitaInputContainer" class="control-group">
					<label class="control-label" for="flDigita">Fl Digita</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="flDigita" placeholder="Fl Digita" value="<%= _.escape(item.get('flDigita') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="flAssinaInputContainer" class="control-group">
					<label class="control-label" for="flAssina">Fl Assina</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="flAssina" placeholder="Fl Assina" value="<%= _.escape(item.get('flAssina') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="flImprimeInputContainer" class="control-group">
					<label class="control-label" for="flImprime">Fl Imprime</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="flImprime" placeholder="Fl Imprime" value="<%= _.escape(item.get('flImprime') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteDigitadorButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteDigitadorButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Digitador</button>
						<span id="confirmDeleteDigitadorContainer" class="hide">
							<button id="cancelDeleteDigitadorButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteDigitadorButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="digitadorDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Digitador
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="digitadorModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveDigitadorButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="digitadorCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newDigitadorButton" class="btn btn-primary">Add Digitador</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
