<?php
/** @package    Laudo::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * ExameMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the ExameDAO to the exame datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Laudo::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class ExameMap implements IDaoMap, IDaoMap2
{

	private static $KM;
	private static $FM;
	
	/**
	 * {@inheritdoc}
	 */
	public static function AddMap($property,FieldMap $map)
	{
		self::GetFieldMaps();
		self::$FM[$property] = $map;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public static function SetFetchingStrategy($property,$loadType)
	{
		self::GetKeyMaps();
		self::$KM[$property]->LoadType = $loadType;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetFieldMaps()
	{
		if (self::$FM == null)
		{
			self::$FM = Array();
			self::$FM["CdExame"] = new FieldMap("CdExame","exame","cd_exame",true,FM_TYPE_INT,11,null,true);
			self::$FM["CdProcedimento"] = new FieldMap("CdProcedimento","exame","cd_procedimento",false,FM_TYPE_INT,11,null,false);
			self::$FM["DtLancamento"] = new FieldMap("DtLancamento","exame","dt_lancamento",false,FM_TYPE_DATETIME,null,null,false);
			self::$FM["CdMedico"] = new FieldMap("CdMedico","exame","cd_medico",false,FM_TYPE_INT,11,null,false);
			self::$FM["CdMedicoSolicitante"] = new FieldMap("CdMedicoSolicitante","exame","cd_medico_solicitante",false,FM_TYPE_INT,11,null,false);
			self::$FM["FlLaudado"] = new FieldMap("FlLaudado","exame","fl_laudado",false,FM_TYPE_INT,11,null,false);
			self::$FM["CdSituacaoExame"] = new FieldMap("CdSituacaoExame","exame","cd_situacao_exame",false,FM_TYPE_INT,11,null,false);
			self::$FM["CdPaciente"] = new FieldMap("CdPaciente","exame","cd_paciente",false,FM_TYPE_INT,11,null,false);
			self::$FM["NuProtocoloInterno"] = new FieldMap("NuProtocoloInterno","exame","nu_protocolo_interno",false,FM_TYPE_VARCHAR,36,null,false);
			self::$FM["CdModalidade"] = new FieldMap("CdModalidade","exame","cd_modalidade",false,FM_TYPE_INT,11,null,false);
			self::$FM["CdLaudo"] = new FieldMap("CdLaudo","exame","cd_laudo",false,FM_TYPE_INT,11,null,false);
		}
		return self::$FM;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetKeyMaps()
	{
		if (self::$KM == null)
		{
			self::$KM = Array();
			self::$KM["fk_laudo_exame"] = new KeyMap("fk_laudo_exame", "CdLaudo", "Laudo", "CdLaudo", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["fk_medico_exame"] = new KeyMap("fk_medico_exame", "CdMedico", "Medico", "CdMedico", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["fk_medico_solicitante_exame"] = new KeyMap("fk_medico_solicitante_exame", "CdMedicoSolicitante", "Medico", "CdMedico", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["fk_modalidade_exame"] = new KeyMap("fk_modalidade_exame", "CdModalidade", "Modalidade", "CdModalidade", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["fk_paciente_exame"] = new KeyMap("fk_paciente_exame", "CdPaciente", "Paciente", "CdPaciente", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["fk_procedimento_exame"] = new KeyMap("fk_procedimento_exame", "CdProcedimento", "Procedimento", "CdProcedimento", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["fk_situacao_exame"] = new KeyMap("fk_situacao_exame", "CdSituacaoExame", "SituacaoExame", "CdSituacaoExame", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>