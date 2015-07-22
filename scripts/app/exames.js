/**
 * View logic for Exames
 */

/**
 * application logic specific to the Exame listing page
 */
var page = {

	exames: new model.ExameCollection(),
	collectionView: null,
	exame: null,
	modelView: null,
	isInitialized: false,
	isInitializing: false,

	fetchParams: { filter: '', orderBy: '', orderDesc: '', page: 1 },
	fetchInProgress: false,
	dialogIsOpen: false,

	/**
	 *
	 */
	init: function() {
		// ensure initialization only occurs once
		if (page.isInitialized || page.isInitializing) return;
		page.isInitializing = true;

		if (!$.isReady && console) console.warn('page was initialized before dom is ready.  views may not render properly.');

		// make the new button clickable
		$("#newExameButton").click(function(e) {
			e.preventDefault();
			page.showDetailDialog();
		});

		// let the page know when the dialog is open
		$('#exameDetailDialog').on('show',function() {
			page.dialogIsOpen = true;
		});

		// when the model dialog is closed, let page know and reset the model view
		$('#exameDetailDialog').on('hidden',function() {
			$('#modelAlert').html('');
			page.dialogIsOpen = false;
		});

		// save the model when the save button is clicked
		$("#saveExameButton").click(function(e) {
			e.preventDefault();
			page.updateModel();
		});

		// initialize the collection view
		this.collectionView = new view.CollectionView({
			el: $("#exameCollectionContainer"),
			templateEl: $("#exameCollectionTemplate"),
			collection: page.exames
		});

		// initialize the search filter
		$('#filter').change(function(obj) {
			page.fetchParams.filter = $('#filter').val();
			page.fetchParams.page = 1;
			page.fetchExames(page.fetchParams);
		});
		
		// make the rows clickable ('rendered' is a custom event, not a standard backbone event)
		this.collectionView.on('rendered',function(){

			// attach click handler to the table rows for editing
			$('table.collection tbody tr').click(function(e) {
				e.preventDefault();
				var m = page.exames.get(this.id);
				page.showDetailDialog(m);
			});

			// make the headers clickable for sorting
 			$('table.collection thead tr th').click(function(e) {
 				e.preventDefault();
				var prop = this.id.replace('header_','');

				// toggle the ascending/descending before we change the sort prop
				page.fetchParams.orderDesc = (prop == page.fetchParams.orderBy && !page.fetchParams.orderDesc) ? '1' : '';
				page.fetchParams.orderBy = prop;
				page.fetchParams.page = 1;
 				page.fetchExames(page.fetchParams);
 			});

			// attach click handlers to the pagination controls
			$('.pageButton').click(function(e) {
				e.preventDefault();
				page.fetchParams.page = this.id.substr(5);
				page.fetchExames(page.fetchParams);
			});
			
			page.isInitialized = true;
			page.isInitializing = false;
		});

		// backbone docs recommend bootstrapping data on initial page load, but we live by our own rules!
		this.fetchExames({ page: 1 });

		// initialize the model view
		this.modelView = new view.ModelView({
			el: $("#exameModelContainer")
		});

		// tell the model view where it's template is located
		this.modelView.templateEl = $("#exameModelTemplate");

		if (model.longPollDuration > 0)	{
			setInterval(function () {

				if (!page.dialogIsOpen)	{
					page.fetchExames(page.fetchParams,true);
				}

			}, model.longPollDuration);
		}
	},

	/**
	 * Fetch the collection data from the server
	 * @param object params passed through to collection.fetch
	 * @param bool true to hide the loading animation
	 */
	fetchExames: function(params, hideLoader) {
		// persist the params so that paging/sorting/filtering will play together nicely
		page.fetchParams = params;

		if (page.fetchInProgress) {
			if (console) console.log('supressing fetch because it is already in progress');
		}

		page.fetchInProgress = true;

		if (!hideLoader) app.showProgress('loader');

		page.exames.fetch({

			data: params,

			success: function() {

				if (page.exames.collectionHasChanged) {
					// TODO: add any logic necessary if the collection has changed
					// the sync event will trigger the view to re-render
				}

				app.hideProgress('loader');
				page.fetchInProgress = false;
			},

			error: function(m, r) {
				app.appendAlert(app.getErrorMessage(r), 'alert-error',0,'collectionAlert');
				app.hideProgress('loader');
				page.fetchInProgress = false;
			}

		});
	},

	/**
	 * show the dialog for editing a model
	 * @param model
	 */
	showDetailDialog: function(m) {

		// show the modal dialog
		$('#exameDetailDialog').modal({ show: true });

		// if a model was specified then that means a user is editing an existing record
		// if not, then the user is creating a new record
		page.exame = m ? m : new model.ExameModel();

		page.modelView.model = page.exame;

		if (page.exame.id == null || page.exame.id == '') {
			// this is a new record, there is no need to contact the server
			page.renderModelView(false);
		} else {
			app.showProgress('modelLoader');

			// fetch the model from the server so we are not updating stale data
			page.exame.fetch({

				success: function() {
					// data returned from the server.  render the model view
					page.renderModelView(true);
				},

				error: function(m, r) {
					app.appendAlert(app.getErrorMessage(r), 'alert-error',0,'modelAlert');
					app.hideProgress('modelLoader');
				}

			});
		}

	},

	/**
	 * Render the model template in the popup
	 * @param bool show the delete button
	 */
	renderModelView: function(showDeleteButton)	{
		page.modelView.render();

		app.hideProgress('modelLoader');

		// initialize any special controls
		try {
			$('.date-picker')
				.datepicker()
				.on('changeDate', function(ev){
					$('.date-picker').datepicker('hide');
				});
		} catch (error) {
			// this happens if the datepicker input.value isn't a valid date
			if (console) console.log('datepicker error: '+error.message);
		}
		
		$('.timepicker-default').timepicker({ defaultTime: 'value' });

		// populate the dropdown options for cdProcedimento
		// TODO: load only the selected value, then fetch all options when the drop-down is clicked
		var cdProcedimentoValues = new model.ProcedimentoCollection();
		cdProcedimentoValues.fetch({
			success: function(c){
				var dd = $('#cdProcedimento');
				dd.append('<option value=""></option>');
				c.forEach(function(item,index) {
					dd.append(app.getOptionHtml(
						item.get('cdProcedimento'),
						item.get('dsProcedimento'), // TODO: change fieldname if the dropdown doesn't show the desired column
						page.exame.get('cdProcedimento') == item.get('cdProcedimento')
					));
				});
				
				if (!app.browserSucks()) {
					dd.combobox();
					$('div.combobox-container + span.help-inline').hide(); // TODO: hack because combobox is making the inline help div have a height
				}

			},
			error: function(collection,response,scope) {
				app.appendAlert(app.getErrorMessage(response), 'alert-error',0,'modelAlert');
			}
		});

		// populate the dropdown options for cdMedico
		// TODO: load only the selected value, then fetch all options when the drop-down is clicked
		var cdMedicoValues = new model.MedicoCollection();
		cdMedicoValues.fetch({
			success: function(c){
				var dd = $('#cdMedico');
				dd.append('<option value=""></option>');
				c.forEach(function(item,index) {
					dd.append(app.getOptionHtml(
						item.get('cdMedico'),
						item.get('dsMedico'), // TODO: change fieldname if the dropdown doesn't show the desired column
						page.exame.get('cdMedico') == item.get('cdMedico')
					));
				});
				
				if (!app.browserSucks()) {
					dd.combobox();
					$('div.combobox-container + span.help-inline').hide(); // TODO: hack because combobox is making the inline help div have a height
				}

			},
			error: function(collection,response,scope) {
				app.appendAlert(app.getErrorMessage(response), 'alert-error',0,'modelAlert');
			}
		});

		// populate the dropdown options for cdMedicoSolicitante
		// TODO: load only the selected value, then fetch all options when the drop-down is clicked
		var cdMedicoSolicitanteValues = new model.MedicoCollection();
		cdMedicoSolicitanteValues.fetch({
			success: function(c){
				var dd = $('#cdMedicoSolicitante');
				dd.append('<option value=""></option>');
				c.forEach(function(item,index) {
					dd.append(app.getOptionHtml(
						item.get('cdMedico'),
						item.get('dsMedico'), // TODO: change fieldname if the dropdown doesn't show the desired column
						page.exame.get('cdMedicoSolicitante') == item.get('cdMedico')
					));
				});
				
				if (!app.browserSucks()) {
					dd.combobox();
					$('div.combobox-container + span.help-inline').hide(); // TODO: hack because combobox is making the inline help div have a height
				}

			},
			error: function(collection,response,scope) {
				app.appendAlert(app.getErrorMessage(response), 'alert-error',0,'modelAlert');
			}
		});

		// populate the dropdown options for cdSituacaoExame
		// TODO: load only the selected value, then fetch all options when the drop-down is clicked
		var cdSituacaoExameValues = new model.SituacaoExameCollection();
		cdSituacaoExameValues.fetch({
			success: function(c){
				var dd = $('#cdSituacaoExame');
				dd.append('<option value=""></option>');
				c.forEach(function(item,index) {
					dd.append(app.getOptionHtml(
						item.get('cdSituacaoExame'),
						item.get('dsSituacaoExame'), // TODO: change fieldname if the dropdown doesn't show the desired column
						page.exame.get('cdSituacaoExame') == item.get('cdSituacaoExame')
					));
				});
				
				if (!app.browserSucks()) {
					dd.combobox();
					$('div.combobox-container + span.help-inline').hide(); // TODO: hack because combobox is making the inline help div have a height
				}

			},
			error: function(collection,response,scope) {
				app.appendAlert(app.getErrorMessage(response), 'alert-error',0,'modelAlert');
			}
		});

		// populate the dropdown options for cdPaciente
		// TODO: load only the selected value, then fetch all options when the drop-down is clicked
		var cdPacienteValues = new model.PacienteCollection();
		cdPacienteValues.fetch({
			success: function(c){
				var dd = $('#cdPaciente');
				dd.append('<option value=""></option>');
				c.forEach(function(item,index) {
					dd.append(app.getOptionHtml(
						item.get('cdPaciente'),
						item.get('dsPaciente'), // TODO: change fieldname if the dropdown doesn't show the desired column
						page.exame.get('cdPaciente') == item.get('cdPaciente')
					));
				});
				
				if (!app.browserSucks()) {
					dd.combobox();
					$('div.combobox-container + span.help-inline').hide(); // TODO: hack because combobox is making the inline help div have a height
				}

			},
			error: function(collection,response,scope) {
				app.appendAlert(app.getErrorMessage(response), 'alert-error',0,'modelAlert');
			}
		});

		// populate the dropdown options for cdModalidade
		// TODO: load only the selected value, then fetch all options when the drop-down is clicked
		var cdModalidadeValues = new model.ModalidadeCollection();
		cdModalidadeValues.fetch({
			success: function(c){
				var dd = $('#cdModalidade');
				dd.append('<option value=""></option>');
				c.forEach(function(item,index) {
					dd.append(app.getOptionHtml(
						item.get('cdModalidade'),
						item.get('dsModalidade'), // TODO: change fieldname if the dropdown doesn't show the desired column
						page.exame.get('cdModalidade') == item.get('cdModalidade')
					));
				});
				
				if (!app.browserSucks()) {
					dd.combobox();
					$('div.combobox-container + span.help-inline').hide(); // TODO: hack because combobox is making the inline help div have a height
				}

			},
			error: function(collection,response,scope) {
				app.appendAlert(app.getErrorMessage(response), 'alert-error',0,'modelAlert');
			}
		});

		// populate the dropdown options for cdLaudo
		// TODO: load only the selected value, then fetch all options when the drop-down is clicked
		var cdLaudoValues = new model.LaudoCollection();
		cdLaudoValues.fetch({
			success: function(c){
				var dd = $('#cdLaudo');
				dd.append('<option value=""></option>');
				c.forEach(function(item,index) {
					dd.append(app.getOptionHtml(
						item.get('cdLaudo'),
						item.get('cdLaudo'), // TODO: change fieldname if the dropdown doesn't show the desired column
						page.exame.get('cdLaudo') == item.get('cdLaudo')
					));
				});
				
				if (!app.browserSucks()) {
					dd.combobox();
					$('div.combobox-container + span.help-inline').hide(); // TODO: hack because combobox is making the inline help div have a height
				}

			},
			error: function(collection,response,scope) {
				app.appendAlert(app.getErrorMessage(response), 'alert-error',0,'modelAlert');
			}
		});


		if (showDeleteButton) {
			// attach click handlers to the delete buttons

			$('#deleteExameButton').click(function(e) {
				e.preventDefault();
				$('#confirmDeleteExameContainer').show('fast');
			});

			$('#cancelDeleteExameButton').click(function(e) {
				e.preventDefault();
				$('#confirmDeleteExameContainer').hide('fast');
			});

			$('#confirmDeleteExameButton').click(function(e) {
				e.preventDefault();
				page.deleteModel();
			});

		} else {
			// no point in initializing the click handlers if we don't show the button
			$('#deleteExameButtonContainer').hide();
		}
	},

	/**
	 * update the model that is currently displayed in the dialog
	 */
	updateModel: function() {
		// reset any previous errors
		$('#modelAlert').html('');
		$('.control-group').removeClass('error');
		$('.help-inline').html('');

		// if this is new then on success we need to add it to the collection
		var isNew = page.exame.isNew();

		app.showProgress('modelLoader');

		page.exame.save({

			'cdProcedimento': $('select#cdProcedimento').val(),
			'dtLancamento': $('input#dtLancamento').val()+' '+$('input#dtLancamento-time').val(),
			'cdMedico': $('select#cdMedico').val(),
			'cdMedicoSolicitante': $('select#cdMedicoSolicitante').val(),
			'flLaudado': $('input#flLaudado').val(),
			'cdSituacaoExame': $('select#cdSituacaoExame').val(),
			'cdPaciente': $('select#cdPaciente').val(),
			'nuProtocoloInterno': $('input#nuProtocoloInterno').val(),
			'cdModalidade': $('select#cdModalidade').val(),
			'cdLaudo': $('select#cdLaudo').val()
		}, {
			wait: true,
			success: function(){
				$('#exameDetailDialog').modal('hide');
				setTimeout("app.appendAlert('Exame was sucessfully " + (isNew ? "inserted" : "updated") + "','alert-success',3000,'collectionAlert')",500);
				app.hideProgress('modelLoader');

				// if the collection was initally new then we need to add it to the collection now
				if (isNew) { page.exames.add(page.exame) }

				if (model.reloadCollectionOnModelUpdate) {
					// re-fetch and render the collection after the model has been updated
					page.fetchExames(page.fetchParams,true);
				}
		},
			error: function(model,response,scope){

				app.hideProgress('modelLoader');

				app.appendAlert(app.getErrorMessage(response), 'alert-error',0,'modelAlert');

				try {
					var json = $.parseJSON(response.responseText);

					if (json.errors) {
						$.each(json.errors, function(key, value) {
							$('#'+key+'InputContainer').addClass('error');
							$('#'+key+'InputContainer span.help-inline').html(value);
							$('#'+key+'InputContainer span.help-inline').show();
						});
					}
				} catch (e2) {
					if (console) console.log('error parsing server response: '+e2.message);
				}
			}
		});
	},

	/**
	 * delete the model that is currently displayed in the dialog
	 */
	deleteModel: function()	{
		// reset any previous errors
		$('#modelAlert').html('');

		app.showProgress('modelLoader');

		page.exame.destroy({
			wait: true,
			success: function(){
				$('#exameDetailDialog').modal('hide');
				setTimeout("app.appendAlert('The Exame record was deleted','alert-success',3000,'collectionAlert')",500);
				app.hideProgress('modelLoader');

				if (model.reloadCollectionOnModelUpdate) {
					// re-fetch and render the collection after the model has been updated
					page.fetchExames(page.fetchParams,true);
				}
			},
			error: function(model,response,scope) {
				app.appendAlert(app.getErrorMessage(response), 'alert-error',0,'modelAlert');
				app.hideProgress('modelLoader');
			}
		});
	}
};

