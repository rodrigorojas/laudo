<?php
/** @package    Laudo::Reporter */

/** import supporting libraries */
require_once("verysimple/Phreeze/Reporter.php");

/**
 * This is an example Reporter based on the Laudo object.  The reporter object
 * allows you to run arbitrary queries that return data which may or may not fith within
 * the data access API.  This can include aggregate data or subsets of data.
 *
 * Note that Reporters are read-only and cannot be used for saving data.
 *
 * @package Laudo::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class LaudoReporter extends Reporter
{

	// the properties in this class must match the columns returned by GetCustomQuery().
	// 'CustomFieldExample' is an example that is not part of the `laudo` table
	public $CustomFieldExample;

	public $CdLaudo;
	public $BbLaudo;
	public $DtLaudo;
	public $CdMedico;
	public $BbAssinado;
	public $DtAssinado;
	public $DtRevisado;
	public $BbLaudoRevisado;
	public $CdSituacaoLaudo;
	public $CdDigitador;
	public $FlAtivo;

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
			,`laudo`.`cd_laudo` as CdLaudo
			,`laudo`.`bb_laudo` as BbLaudo
			,`laudo`.`dt_laudo` as DtLaudo
			,`laudo`.`cd_medico` as CdMedico
			,`laudo`.`bb_assinado` as BbAssinado
			,`laudo`.`dt_assinado` as DtAssinado
			,`laudo`.`dt_revisado` as DtRevisado
			,`laudo`.`bb_laudo_revisado` as BbLaudoRevisado
			,`laudo`.`cd_situacao_laudo` as CdSituacaoLaudo
			,`laudo`.`cd_digitador` as CdDigitador
			,`laudo`.`fl_ativo` as FlAtivo
		from `laudo`";

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
		$sql = "select count(1) as counter from `laudo`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();

		return $sql;
	}
}

?>