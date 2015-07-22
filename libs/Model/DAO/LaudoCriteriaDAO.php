<?php
/** @package    Laudo::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Criteria.php");

/**
 * LaudoCriteria allows custom querying for the Laudo object.
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
class LaudoCriteriaDAO extends Criteria
{

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
	public $BbLaudo_Equals;
	public $BbLaudo_NotEquals;
	public $BbLaudo_IsLike;
	public $BbLaudo_IsNotLike;
	public $BbLaudo_BeginsWith;
	public $BbLaudo_EndsWith;
	public $BbLaudo_GreaterThan;
	public $BbLaudo_GreaterThanOrEqual;
	public $BbLaudo_LessThan;
	public $BbLaudo_LessThanOrEqual;
	public $BbLaudo_In;
	public $BbLaudo_IsNotEmpty;
	public $BbLaudo_IsEmpty;
	public $BbLaudo_BitwiseOr;
	public $BbLaudo_BitwiseAnd;
	public $DtLaudo_Equals;
	public $DtLaudo_NotEquals;
	public $DtLaudo_IsLike;
	public $DtLaudo_IsNotLike;
	public $DtLaudo_BeginsWith;
	public $DtLaudo_EndsWith;
	public $DtLaudo_GreaterThan;
	public $DtLaudo_GreaterThanOrEqual;
	public $DtLaudo_LessThan;
	public $DtLaudo_LessThanOrEqual;
	public $DtLaudo_In;
	public $DtLaudo_IsNotEmpty;
	public $DtLaudo_IsEmpty;
	public $DtLaudo_BitwiseOr;
	public $DtLaudo_BitwiseAnd;
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
	public $BbAssinado_Equals;
	public $BbAssinado_NotEquals;
	public $BbAssinado_IsLike;
	public $BbAssinado_IsNotLike;
	public $BbAssinado_BeginsWith;
	public $BbAssinado_EndsWith;
	public $BbAssinado_GreaterThan;
	public $BbAssinado_GreaterThanOrEqual;
	public $BbAssinado_LessThan;
	public $BbAssinado_LessThanOrEqual;
	public $BbAssinado_In;
	public $BbAssinado_IsNotEmpty;
	public $BbAssinado_IsEmpty;
	public $BbAssinado_BitwiseOr;
	public $BbAssinado_BitwiseAnd;
	public $DtAssinado_Equals;
	public $DtAssinado_NotEquals;
	public $DtAssinado_IsLike;
	public $DtAssinado_IsNotLike;
	public $DtAssinado_BeginsWith;
	public $DtAssinado_EndsWith;
	public $DtAssinado_GreaterThan;
	public $DtAssinado_GreaterThanOrEqual;
	public $DtAssinado_LessThan;
	public $DtAssinado_LessThanOrEqual;
	public $DtAssinado_In;
	public $DtAssinado_IsNotEmpty;
	public $DtAssinado_IsEmpty;
	public $DtAssinado_BitwiseOr;
	public $DtAssinado_BitwiseAnd;
	public $DtRevisado_Equals;
	public $DtRevisado_NotEquals;
	public $DtRevisado_IsLike;
	public $DtRevisado_IsNotLike;
	public $DtRevisado_BeginsWith;
	public $DtRevisado_EndsWith;
	public $DtRevisado_GreaterThan;
	public $DtRevisado_GreaterThanOrEqual;
	public $DtRevisado_LessThan;
	public $DtRevisado_LessThanOrEqual;
	public $DtRevisado_In;
	public $DtRevisado_IsNotEmpty;
	public $DtRevisado_IsEmpty;
	public $DtRevisado_BitwiseOr;
	public $DtRevisado_BitwiseAnd;
	public $BbLaudoRevisado_Equals;
	public $BbLaudoRevisado_NotEquals;
	public $BbLaudoRevisado_IsLike;
	public $BbLaudoRevisado_IsNotLike;
	public $BbLaudoRevisado_BeginsWith;
	public $BbLaudoRevisado_EndsWith;
	public $BbLaudoRevisado_GreaterThan;
	public $BbLaudoRevisado_GreaterThanOrEqual;
	public $BbLaudoRevisado_LessThan;
	public $BbLaudoRevisado_LessThanOrEqual;
	public $BbLaudoRevisado_In;
	public $BbLaudoRevisado_IsNotEmpty;
	public $BbLaudoRevisado_IsEmpty;
	public $BbLaudoRevisado_BitwiseOr;
	public $BbLaudoRevisado_BitwiseAnd;
	public $CdSituacaoLaudo_Equals;
	public $CdSituacaoLaudo_NotEquals;
	public $CdSituacaoLaudo_IsLike;
	public $CdSituacaoLaudo_IsNotLike;
	public $CdSituacaoLaudo_BeginsWith;
	public $CdSituacaoLaudo_EndsWith;
	public $CdSituacaoLaudo_GreaterThan;
	public $CdSituacaoLaudo_GreaterThanOrEqual;
	public $CdSituacaoLaudo_LessThan;
	public $CdSituacaoLaudo_LessThanOrEqual;
	public $CdSituacaoLaudo_In;
	public $CdSituacaoLaudo_IsNotEmpty;
	public $CdSituacaoLaudo_IsEmpty;
	public $CdSituacaoLaudo_BitwiseOr;
	public $CdSituacaoLaudo_BitwiseAnd;
	public $CdDigitador_Equals;
	public $CdDigitador_NotEquals;
	public $CdDigitador_IsLike;
	public $CdDigitador_IsNotLike;
	public $CdDigitador_BeginsWith;
	public $CdDigitador_EndsWith;
	public $CdDigitador_GreaterThan;
	public $CdDigitador_GreaterThanOrEqual;
	public $CdDigitador_LessThan;
	public $CdDigitador_LessThanOrEqual;
	public $CdDigitador_In;
	public $CdDigitador_IsNotEmpty;
	public $CdDigitador_IsEmpty;
	public $CdDigitador_BitwiseOr;
	public $CdDigitador_BitwiseAnd;
	public $FlAtivo_Equals;
	public $FlAtivo_NotEquals;
	public $FlAtivo_IsLike;
	public $FlAtivo_IsNotLike;
	public $FlAtivo_BeginsWith;
	public $FlAtivo_EndsWith;
	public $FlAtivo_GreaterThan;
	public $FlAtivo_GreaterThanOrEqual;
	public $FlAtivo_LessThan;
	public $FlAtivo_LessThanOrEqual;
	public $FlAtivo_In;
	public $FlAtivo_IsNotEmpty;
	public $FlAtivo_IsEmpty;
	public $FlAtivo_BitwiseOr;
	public $FlAtivo_BitwiseAnd;

}

?>