<?php
	$this->assign('title','LAUDO | Laudos');
	$this->assign('nav','laudos');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/laudos.js").wait(function(){
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
	<i class="icon-th-list"></i> Laudos
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="laudoCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_CdLaudo">Cd Laudo<% if (page.orderBy == 'CdLaudo') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_BbLaudo">Bb Laudo<% if (page.orderBy == 'BbLaudo') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DtLaudo">Dt Laudo<% if (page.orderBy == 'DtLaudo') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CdMedico">Cd Medico<% if (page.orderBy == 'CdMedico') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_BbAssinado">Bb Assinado<% if (page.orderBy == 'BbAssinado') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_DtAssinado">Dt Assinado<% if (page.orderBy == 'DtAssinado') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DtRevisado">Dt Revisado<% if (page.orderBy == 'DtRevisado') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_BbLaudoRevisado">Bb Laudo Revisado<% if (page.orderBy == 'BbLaudoRevisado') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CdSituacaoLaudo">Cd Situacao Laudo<% if (page.orderBy == 'CdSituacaoLaudo') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CdDigitador">Cd Digitador<% if (page.orderBy == 'CdDigitador') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_FlAtivo">Fl Ativo<% if (page.orderBy == 'FlAtivo') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('cdLaudo')) %>">
				<td><%= _.escape(item.get('cdLaudo') || '') %></td>
				<td><%= _.escape(item.get('bbLaudo') || '') %></td>
				<td><%if (item.get('dtLaudo')) { %><%= _date(app.parseDate(item.get('dtLaudo'))).format('MMM D, YYYY') %><% } else { %>NULL<% } %></td>
				<td><%= _.escape(item.get('cdMedico') || '') %></td>
				<td><%= _.escape(item.get('bbAssinado') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%if (item.get('dtAssinado')) { %><%= _date(app.parseDate(item.get('dtAssinado'))).format('MMM D, YYYY h:mm A') %><% } else { %>NULL<% } %></td>
				<td><%if (item.get('dtRevisado')) { %><%= _date(app.parseDate(item.get('dtRevisado'))).format('MMM D, YYYY') %><% } else { %>NULL<% } %></td>
				<td><%= _.escape(item.get('bbLaudoRevisado') || '') %></td>
				<td><%= _.escape(item.get('cdSituacaoLaudo') || '') %></td>
				<td><%= _.escape(item.get('cdDigitador') || '') %></td>
				<td><%= _.escape(item.get('flAtivo') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="laudoModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="cdLaudoInputContainer" class="control-group">
					<label class="control-label" for="cdLaudo">Cd Laudo</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="cdLaudo"><%= _.escape(item.get('cdLaudo') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="bbLaudoInputContainer" class="control-group">
					<label class="control-label" for="bbLaudo">Bb Laudo</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="bbLaudo" placeholder="Bb Laudo" value="<%= _.escape(item.get('bbLaudo') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dtLaudoInputContainer" class="control-group">
					<label class="control-label" for="dtLaudo">Dt Laudo</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
							<input id="dtLaudo" type="text" value="<%= _date(app.parseDate(item.get('dtLaudo'))).format('YYYY-MM-DD') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="cdMedicoInputContainer" class="control-group">
					<label class="control-label" for="cdMedico">Cd Medico</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="cdMedico" placeholder="Cd Medico" value="<%= _.escape(item.get('cdMedico') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="bbAssinadoInputContainer" class="control-group">
					<label class="control-label" for="bbAssinado">Bb Assinado</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="bbAssinado" placeholder="Bb Assinado" value="<%= _.escape(item.get('bbAssinado') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dtAssinadoInputContainer" class="control-group">
					<label class="control-label" for="dtAssinado">Dt Assinado</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
							<input id="dtAssinado" type="text" value="<%= _date(app.parseDate(item.get('dtAssinado'))).format('YYYY-MM-DD') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<div class="input-append bootstrap-timepicker-component">
							<input id="dtAssinado-time" type="text" class="timepicker-default input-small" value="<%= _date(app.parseDate(item.get('dtAssinado'))).format('h:mm A') %>" />
							<span class="add-on"><i class="icon-time"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dtRevisadoInputContainer" class="control-group">
					<label class="control-label" for="dtRevisado">Dt Revisado</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
							<input id="dtRevisado" type="text" value="<%= _date(app.parseDate(item.get('dtRevisado'))).format('YYYY-MM-DD') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="bbLaudoRevisadoInputContainer" class="control-group">
					<label class="control-label" for="bbLaudoRevisado">Bb Laudo Revisado</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="bbLaudoRevisado" placeholder="Bb Laudo Revisado" value="<%= _.escape(item.get('bbLaudoRevisado') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="cdSituacaoLaudoInputContainer" class="control-group">
					<label class="control-label" for="cdSituacaoLaudo">Cd Situacao Laudo</label>
					<div class="controls inline-inputs">
						<select id="cdSituacaoLaudo" name="cdSituacaoLaudo"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="cdDigitadorInputContainer" class="control-group">
					<label class="control-label" for="cdDigitador">Cd Digitador</label>
					<div class="controls inline-inputs">
						<select id="cdDigitador" name="cdDigitador"></select>
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
		<form id="deleteLaudoButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteLaudoButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Laudo</button>
						<span id="confirmDeleteLaudoContainer" class="hide">
							<button id="cancelDeleteLaudoButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteLaudoButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="laudoDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Laudo
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="laudoModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveLaudoButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="laudoCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newLaudoButton" class="btn btn-primary">Add Laudo</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
