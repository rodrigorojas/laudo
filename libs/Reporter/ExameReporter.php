<?php
/** @package    Laudo::Reporter */

/** import supporting libraries */
require_once("verysimple/Phreeze/Reporter.php");

/**
 * This is an example Reporter based on the Exame object.  The reporter object
 * allows you to run arbitrary queries that return data which may or may not fith within
 * the data access API.  This can include aggregate data or subsets of data.
 *
 * Note that Reporters are read-only and cannot be used for saving data.
 *
 * @package Laudo::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class ExameReporter extends Reporter
{

	// the properties in this class must match the columns returned by GetCustomQuery().
	// 'CustomFieldExample' is an example that is not part of the `exame` table
	public $CustomFieldExample;

	public $CdExame;
	public $CdProcedimento;
	public $DtLancamento;
	public $CdMedico;
	public $CdMedicoSolicitante;
	public $FlLaudado;
	public $CdSituacaoExame;
	public $CdPaciente;
	public $NuProtocoloInterno;
	public $CdModalidade;
	public $CdLaudo;

	/*
	* GetCustomQuery returns a fully formed SQL statement.  The result columns
	* must match with the properties of this reporter object.
	*
	* @see Reporter::GetCustomQuery
	* @param Criteria $criteria
	* @return string SQL statement
	*/
	static function GetCustomQuery($criteria)
	{
		$sql = "select
			'custom value here...' as CustomFieldExample
			,`exame`.`cd_exame` as CdExame
			,`exame`.`cd_procedimento` as CdProcedimento
			,`exame`.`dt_lancamento` as DtLancamento
			,`exame`.`cd_medico` as CdMedico
			,`exame`.`cd_medico_solicitante` as CdMedicoSolicitante
			,`exame`.`fl_laudado` as FlLaudado
			,`exame`.`cd_situacao_exame` as CdSituacaoExame
			,`exame`.`cd_paciente` as CdPaciente
			,`exame`.`nu_protocolo_interno` as NuProtocoloInterno
			,`exame`.`cd_modalidade` as CdModalidade
			,`exame`.`cd_laudo` as CdLaudo
		from `exame`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();
		$sql .= $criteria->GetOrder();

		return $sql;
	}
	
	/*
	* GetCustomCountQuery returns a fully formed SQL statement that will count
	* the results.  This query must return the correct number of results that
	* GetCustomQuery would, given the same criteria
	*
	* @see Reporter::GetCustomCountQuery
	* @param Criteria $criteria
	* @return string SQL statement
	*/
	static function GetCustomCountQuery($criteria)
	{
		$sql = "select count(1) as counter from `exame`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();

		return $sql;
	}
}

?>