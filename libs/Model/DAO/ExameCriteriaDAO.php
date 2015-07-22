<?php
/** @package    Laudo::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Criteria.php");

/**
 * ExameCriteria allows custom querying for the Exame object.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * Add any custom business logic to the ModelCriteria class which is extended from this class.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @inheritdocs
 * @package Laudo::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class ExameCriteriaDAO extends Criteria
{

	public $CdExame_Equals;
	public $CdExame_NotEquals;
	public $CdExame_IsLike;
	public $CdExame_IsNotLike;
	public $CdExame_BeginsWith;
	public $CdExame_EndsWith;
	public $CdExame_GreaterThan;
	public $CdExame_GreaterThanOrEqual;
	public $CdExame_LessThan;
	public $CdExame_LessThanOrEqual;
	public $CdExame_In;
	public $CdExame_IsNotEmpty;
	public $CdExame_IsEmpty;
	public $CdExame_BitwiseOr;
	public $CdExame_BitwiseAnd;
	public $CdProcedimento_Equals;
	public $CdProcedimento_NotEquals;
	public $CdProcedimento_IsLike;
	public $CdProcedimento_IsNotLike;
	public $CdProcedimento_BeginsWith;
	public $CdProcedimento_EndsWith;
	public $CdProcedimento_GreaterThan;
	public $CdProcedimento_GreaterThanOrEqual;
	public $CdProcedimento_LessThan;
	public $CdProcedimento_LessThanOrEqual;
	public $CdProcedimento_In;
	public $CdProcedimento_IsNotEmpty;
	public $CdProcedimento_IsEmpty;
	public $CdProcedimento_BitwiseOr;
	public $CdProcedimento_BitwiseAnd;
	public $DtLancamento_Equals;
	public $DtLancamento_NotEquals;
	public $DtLancamento_IsLike;
	public $DtLancamento_IsNotLike;
	public $DtLancamento_BeginsWith;
	public $DtLancamento_EndsWith;
	public $DtLancamento_GreaterThan;
	public $DtLancamento_GreaterThanOrEqual;
	public $DtLancamento_LessThan;
	public $DtLancamento_LessThanOrEqual;
	public $DtLancamento_In;
	public $DtLancamento_IsNotEmpty;
	public $DtLancamento_IsEmpty;
	public $DtLancamento_BitwiseOr;
	public $DtLancamento_BitwiseAnd;
	public $CdMedico_Equals;
	public $CdMedico_NotEquals;
	public $CdMedico_IsLike;
	public $CdMedico_IsNotLike;
	public $CdMedico_BeginsWith;
	public $CdMedico_EndsWith;
	public $CdMedico_GreaterThan;
	public $CdMedico_GreaterThanOrEqual;
	public $CdMedico_LessThan;
	public $CdMedico_LessThanOrEqual;
	public $CdMedico_In;
	public $CdMedico_IsNotEmpty;
	public $CdMedico_IsEmpty;
	public $CdMedico_BitwiseOr;
	public $CdMedico_BitwiseAnd;
	public $CdMedicoSolicitante_Equals;
	public $CdMedicoSolicitante_NotEquals;
	public $CdMedicoSolicitante_IsLike;
	public $CdMedicoSolicitante_IsNotLike;
	public $CdMedicoSolicitante_BeginsWith;
	public $CdMedicoSolicitante_EndsWith;
	public $CdMedicoSolicitante_GreaterThan;
	public $CdMedicoSolicitante_GreaterThanOrEqual;
	public $CdMedicoSolicitante_LessThan;
	public $CdMedicoSolicitante_LessThanOrEqual;
	public $CdMedicoSolicitante_In;
	public $CdMedicoSolicitante_IsNotEmpty;
	public $CdMedicoSolicitante_IsEmpty;
	public $CdMedicoSolicitante_BitwiseOr;
	public $CdMedicoSolicitante_BitwiseAnd;
	public $FlLaudado_Equals;
	public $FlLaudado_NotEquals;
	public $FlLaudado_IsLike;
	public $FlLaudado_IsNotLike;
	public $FlLaudado_BeginsWith;
	public $FlLaudado_EndsWith;
	public $FlLaudado_GreaterThan;
	public $FlLaudado_GreaterThanOrEqual;
	public $FlLaudado_LessThan;
	public $FlLaudado_LessThanOrEqual;
	public $FlLaudado_In;
	public $FlLaudado_IsNotEmpty;
	public $FlLaudado_IsEmpty;
	public $FlLaudado_BitwiseOr;
	public $FlLaudado_BitwiseAnd;
	public $CdSituacaoExame_Equals;
	public $CdSituacaoExame_NotEquals;
	public $CdSituacaoExame_IsLike;
	public $CdSituacaoExame_IsNotLike;
	public $CdSituacaoExame_BeginsWith;
	public $CdSituacaoExame_EndsWith;
	public $CdSituacaoExame_GreaterThan;
	public $CdSituacaoExame_GreaterThanOrEqual;
	public $CdSituacaoExame_LessThan;
	public $CdSituacaoExame_LessThanOrEqual;
	public $CdSituacaoExame_In;
	public $CdSituacaoExame_IsNotEmpty;
	public $CdSituacaoExame_IsEmpty;
	public $CdSituacaoExame_BitwiseOr;
	public $CdSituacaoExame_BitwiseAnd;
	public $CdPaciente_Equals;
	public $CdPaciente_NotEquals;
	public $CdPaciente_IsLike;
	public $CdPaciente_IsNotLike;
	public $CdPaciente_BeginsWith;
	public $CdPaciente_EndsWith;
	public $CdPaciente_GreaterThan;
	public $CdPaciente_GreaterThanOrEqual;
	public $CdPaciente_LessThan;
	public $CdPaciente_LessThanOrEqual;
	public $CdPaciente_In;
	public $CdPaciente_IsNotEmpty;
	public $CdPaciente_IsEmpty;
	public $CdPaciente_BitwiseOr;
	public $CdPaciente_BitwiseAnd;
	public $NuProtocoloInterno_Equals;
	public $NuProtocoloInterno_NotEquals;
	public $NuProtocoloInterno_IsLike;
	public $NuProtocoloInterno_IsNotLike;
	public $NuProtocoloInterno_BeginsWith;
	public $NuProtocoloInterno_EndsWith;
	public $NuProtocoloInterno_GreaterThan;
	public $NuProtocoloInterno_GreaterThanOrEqual;
	public $NuProtocoloInterno_LessThan;
	public $NuProtocoloInterno_LessThanOrEqual;
	public $NuProtocoloInterno_In;
	public $NuProtocoloInterno_IsNotEmpty;
	public $NuProtocoloInterno_IsEmpty;
	public $NuProtocoloInterno_BitwiseOr;
	public $NuProtocoloInterno_BitwiseAnd;
	public $CdModalidade_Equals;
	public $CdModalidade_NotEquals;
	public $CdModalidade_IsLike;
	public $CdModalidade_IsNotLike;
	public $CdModalidade_BeginsWith;
	public $CdModalidade_EndsWith;
	public $CdModalidade_GreaterThan;
	public $CdModalidade_GreaterThanOrEqual;
	public $CdModalidade_LessThan;
	public $CdModalidade_LessThanOrEqual;
	public $CdModalidade_In;
	public $CdModalidade_IsNotEmpty;
	public $CdModalidade_IsEmpty;
	public $CdModalidade_BitwiseOr;
	public $CdModalidade_BitwiseAnd;
	public $CdLaudo_Equals;
	public $CdLaudo_NotEquals;
	public $CdLaudo_IsLike;
	public $CdLaudo_IsNotLike;
	public $CdLaudo_BeginsWith;
	public $CdLaudo_EndsWith;
	public $CdLaudo_GreaterThan;
	public $CdLaudo_GreaterThanOrEqual;
	public $CdLaudo_LessThan;
	public $CdLaudo_LessThanOrEqual;
	public $CdLaudo_In;
	public $CdLaudo_IsNotEmpty;
	public $CdLaudo_IsEmpty;
	public $CdLaudo_BitwiseOr;
	public $CdLaudo_BitwiseAnd;

}

?>