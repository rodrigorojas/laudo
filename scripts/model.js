/**
 * backbone model definitions for LAUDO
 */

/**
 * Use emulated HTTP if the server doesn't support PUT/DELETE or application/json requests
 */
Backbone.emulateHTTP = false;
Backbone.emulateJSON = false;

var model = {};

/**
 * long polling duration in miliseconds.  (5000 = recommended, 0 = disabled)
 * warning: setting this to a low number will increase server load
 */
model.longPollDuration = 0;

/**
 * whether to refresh the collection immediately after a model is updated
 */
model.reloadCollectionOnModelUpdate = true;


/**
 * a default sort method for sorting collection items.  this will sort the collection
 * based on the orderBy and orderDesc property that was used on the last fetch call
 * to the server. 
 */
model.AbstractCollection = Backbone.Collection.extend({
	totalResults: 0,
	totalPages: 0,
	currentPage: 0,
	pageSize: 0,
	orderBy: '',
	orderDesc: false,
	lastResponseText: null,
	lastRequestParams: null,
	collectionHasChanged: true,
	
	/**
	 * fetch the collection from the server using the same options and 
	 * parameters as the previous fetch
	 */
	refetch: function() {
		this.fetch({ data: this.lastRequestParams })
	},
	
	/* uncomment to debug fetch event triggers
	fetch: function(options) {
            this.constructor.__super__.fetch.apply(this, arguments);
	},
	// */
	
	/**
	 * client-side sorting baesd on the orderBy and orderDesc parameters that
	 * were used to fetch the data from the server.  Backbone ignores the
	 * order of records coming from the server so we have to sort them ourselves
	 */
	comparator: function(a,b) {
		
		var result = 0;
		var options = this.lastRequestParams;
		
		if (options && options.orderBy) {
			
			// lcase the first letter of the property name
			var propName = options.orderBy.charAt(0).toLowerCase() + options.orderBy.slice(1);
			var aVal = a.get(propName);
			var bVal = b.get(propName);
			
			if (isNaN(aVal) || isNaN(bVal)) {
				// treat comparison as case-insensitive strings
				aVal = aVal ? aVal.toLowerCase() : '';
				bVal = bVal ? bVal.toLowerCase() : '';
			} else {
				// treat comparision as a number
				aVal = Number(aVal);
				bVal = Number(bVal);
			}
			
			if (aVal < bVal) {
				result = options.orderDesc ? 1 : -1;
			} else if (aVal > bVal) {
				result = options.orderDesc ? -1 : 1;
			}
		}
		
		return result;

	},
	/**
	 * override parse to track changes and handle pagination
	 * if the server call has returned page data
	 */
	parse: function(response, options) {

		// the response is already decoded into object form, but it's easier to
		// compary the stringified version.  some earlier versions of backbone did
		// not include the raw response so there is some legacy support here
		var responseText = options && options.xhr ? options.xhr.responseText : JSON.stringify(response);
		this.collectionHasChanged = (this.lastResponseText != responseText);
		this.lastRequestParams = options ? options.data : undefined;
		
		// if the collection has changed then we need to force a re-sort because backbone will
		// only resort the data if a property in the model has changed
		if (this.lastResponseText && this.collectionHasChanged) this.sort({ silent:true });
		
		this.lastResponseText = responseText;
		
		var rows;

		if (response.currentPage) {
			rows = response.rows;
			this.totalResults = response.totalResults;
			this.totalPages = response.totalPages;
			this.currentPage = response.currentPage;
			this.pageSize = response.pageSize;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		} else {
			rows = response;
			this.totalResults = rows.length;
			this.totalPages = 1;
			this.currentPage = 1;
			this.pageSize = this.totalResults;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}

		return rows;
	}
});

/**
 * Digitador Backbone Model
 */
model.DigitadorModel = Backbone.Model.extend({
	urlRoot: 'api/digitador',
	idAttribute: 'cdDigitador',
	cdDigitador: '',
	dsDigitador: '',
	flAtivo: '',
	flDigita: '',
	flAssina: '',
	flImprime: '',
	defaults: {
		'cdDigitador': null,
		'dsDigitador': '',
		'flAtivo': '',
		'flDigita': '',
		'flAssina': '',
		'flImprime': ''
	}
});

/**
 * Digitador Backbone Collection
 */
model.DigitadorCollection = model.AbstractCollection.extend({
	url: 'api/digitadores',
	model: model.DigitadorModel
});

/**
 * Exame Backbone Model
 */
model.ExameModel = Backbone.Model.extend({
	urlRoot: 'api/exame',
	idAttribute: 'cdExame',
	cdExame: '',
	cdProcedimento: '',
	dtLancamento: '',
	cdMedico: '',
	cdMedicoSolicitante: '',
	flLaudado: '',
	cdSituacaoExame: '',
	cdPaciente: '',
	nuProtocoloInterno: '',
	cdModalidade: '',
	cdLaudo: '',
	defaults: {
		'cdExame': null,
		'cdProcedimento': '',
		'dtLancamento': new Date(),
		'cdMedico': '',
		'cdMedicoSolicitante': '',
		'flLaudado': '',
		'cdSituacaoExame': '',
		'cdPaciente': '',
		'nuProtocoloInterno': '',
		'cdModalidade': '',
		'cdLaudo': ''
	}
});

/**
 * Exame Backbone Collection
 */
model.ExameCollection = model.AbstractCollection.extend({
	url: 'api/exames',
	model: model.ExameModel
});

/**
 * Laudo Backbone Model
 */
model.LaudoModel = Backbone.Model.extend({
	urlRoot: 'api/laudo',
	idAttribute: 'cdLaudo',
	cdLaudo: '',
	bbLaudo: '',
	dtLaudo: '',
	cdMedico: '',
	bbAssinado: '',
	dtAssinado: '',
	dtRevisado: '',
	bbLaudoRevisado: '',
	cdSituacaoLaudo: '',
	cdDigitador: '',
	flAtivo: '',
	defaults: {
		'cdLaudo': null,
		'bbLaudo': '',
		'dtLaudo': new Date(),
		'cdMedico': '',
		'bbAssinado': '',
		'dtAssinado': '',
		'dtRevisado': new Date(),
		'bbLaudoRevisado': '',
		'cdSituacaoLaudo': '',
		'cdDigitador': '',
		'flAtivo': ''
	}
});

/**
 * Laudo Backbone Collection
 */
model.LaudoCollection = model.AbstractCollection.extend({
	url: 'api/laudos',
	model: model.LaudoModel
});

/**
 * Medico Backbone Model
 */
model.MedicoModel = Backbone.Model.extend({
	urlRoot: 'api/medico',
	idAttribute: 'cdMedico',
	cdMedico: '',
	dsMedico: '',
	dsCrm: '',
	flAtivo: '',
	bbAssinatura: '',
	defaults: {
		'cdMedico': null,
		'dsMedico': '',
		'dsCrm': '',
		'flAtivo': '',
		'bbAssinatura': ''
	}
});

/**
 * Medico Backbone Collection
 */
model.MedicoCollection = model.AbstractCollection.extend({
	url: 'api/medicos',
	model: model.MedicoModel
});

/**
 * Modalidade Backbone Model
 */
model.ModalidadeModel = Backbone.Model.extend({
	urlRoot: 'api/modalidade',
	idAttribute: 'cdModalidade',
	cdModalidade: '',
	dsModalidade: '',
	flAtivo: '',
	dsSigla: '',
	defaults: {
		'cdModalidade': null,
		'dsModalidade': '',
		'flAtivo': '',
		'dsSigla': ''
	}
});

/**
 * Modalidade Backbone Collection
 */
model.ModalidadeCollection = model.AbstractCollection.extend({
	url: 'api/modalidades',
	model: model.ModalidadeModel
});

/**
 * Paciente Backbone Model
 */
model.PacienteModel = Backbone.Model.extend({
	urlRoot: 'api/paciente',
	idAttribute: 'cdPaciente',
	cdPaciente: '',
	dsPaciente: '',
	dtNascimento: '',
	dsSexo: '',
	dsObservacao: '',
	flAtivo: '',
	defaults: {
		'cdPaciente': null,
		'dsPaciente': '',
		'dtNascimento': new Date(),
		'dsSexo': '',
		'dsObservacao': '',
		'flAtivo': ''
	}
});

/**
 * Paciente Backbone Collection
 */
model.PacienteCollection = model.AbstractCollection.extend({
	url: 'api/pacientes',
	model: model.PacienteModel
});

/**
 * Procedimento Backbone Model
 */
model.ProcedimentoModel = Backbone.Model.extend({
	urlRoot: 'api/procedimento',
	idAttribute: 'cdProcedimento',
	cdProcedimento: '',
	dsProcedimento: '',
	flAtivo: '',
	cdModalidade: '',
	defaults: {
		'cdProcedimento': null,
		'dsProcedimento': '',
		'flAtivo': '',
		'cdModalidade': ''
	}
});

/**
 * Procedimento Backbone Collection
 */
model.ProcedimentoCollection = model.AbstractCollection.extend({
	url: 'api/procedimentos',
	model: model.ProcedimentoModel
});

/**
 * Role Backbone Model
 */
model.RoleModel = Backbone.Model.extend({
	urlRoot: 'api/role',
	idAttribute: 'id',
	id: '',
	name: '',
	canAdmin: '',
	canEdit: '',
	canWrite: '',
	canRead: '',
	defaults: {
		'id': null,
		'name': '',
		'canAdmin': '',
		'canEdit': '',
		'canWrite': '',
		'canRead': ''
	}
});

/**
 * Role Backbone Collection
 */
model.RoleCollection = model.AbstractCollection.extend({
	url: 'api/roles',
	model: model.RoleModel
});

/**
 * SituacaoExame Backbone Model
 */
model.SituacaoExameModel = Backbone.Model.extend({
	urlRoot: 'api/situacaoexame',
	idAttribute: 'cdSituacaoExame',
	cdSituacaoExame: '',
	dsSituacaoExame: '',
	flAtivo: '',
	defaults: {
		'cdSituacaoExame': null,
		'dsSituacaoExame': '',
		'flAtivo': ''
	}
});

/**
 * SituacaoExame Backbone Collection
 */
model.SituacaoExameCollection = model.AbstractCollection.extend({
	url: 'api/situacaoexames',
	model: model.SituacaoExameModel
});

/**
 * SituacaoLaudo Backbone Model
 */
model.SituacaoLaudoModel = Backbone.Model.extend({
	urlRoot: 'api/situacaolaudo',
	idAttribute: 'cdSituacaoLaudo',
	cdSituacaoLaudo: '',
	dsSituacaoLaudo: '',
	flAtivo: '',
	defaults: {
		'cdSituacaoLaudo': null,
		'dsSituacaoLaudo': '',
		'flAtivo': ''
	}
});

/**
 * SituacaoLaudo Backbone Collection
 */
model.SituacaoLaudoCollection = model.AbstractCollection.extend({
	url: 'api/situacaolaudos',
	model: model.SituacaoLaudoModel
});

/**
 * User Backbone Model
 */
model.UserModel = Backbone.Model.extend({
	urlRoot: 'api/user',
	idAttribute: 'id',
	id: '',
	roleId: '',
	username: '',
	password: '',
	firstName: '',
	lastName: '',
	defaults: {
		'id': null,
		'roleId': '',
		'username': '',
		'password': '',
		'firstName': '',
		'lastName': ''
	}
});

/**
 * User Backbone Collection
 */
model.UserCollection = model.AbstractCollection.extend({
	url: 'api/users',
	model: model.UserModel
});

