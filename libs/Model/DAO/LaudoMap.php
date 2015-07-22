<?php
/** @package    Laudo::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * LaudoMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the LaudoDAO to the laudo datastore.
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
class LaudoMap implements IDaoMap, IDaoMap2
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
			self::$FM["CdLaudo"] = new FieldMap("CdLaudo","laudo","cd_laudo",true,FM_TYPE_INT,11,null,true);
			self::$FM["BbLaudo"] = new FieldMap("BbLaudo","laudo","bb_laudo",false,FM_TYPE_BLOB,null,null,false);
			self::$FM["DtLaudo"] = new FieldMap("DtLaudo","laudo","dt_laudo",false,FM_TYPE_DATE,null,null,false);
			self::$FM["CdMedico"] = new FieldMap("CdMedico","laudo","cd_medico",false,FM_TYPE_INT,11,null,false);
			self::$FM["BbAssinado"] = new FieldMap("BbAssinado","laudo","bb_assinado",false,FM_TYPE_BLOB,null,null,false);
			self::$FM["DtAssinado"] = new FieldMap("DtAssinado","laudo","dt_assinado",false,FM_TYPE_TIMESTAMP,null,null,false);
			self::$FM["DtRevisado"] = new FieldMap("DtRevisado","laudo","dt_revisado",false,FM_TYPE_DATE,null,null,false);
			self::$FM["BbLaudoRevisado"] = new FieldMap("BbLaudoRevisado","laudo","bb_laudo_revisado",false,FM_TYPE_BLOB,null,null,false);
			self::$FM["CdSituacaoLaudo"] = new FieldMap("CdSituacaoLaudo","laudo","cd_situacao_laudo",false,FM_TYPE_INT,11,null,false);
			self::$FM["CdDigitador"] = new FieldMap("CdDigitador","laudo","cd_digitador",false,FM_TYPE_INT,11,null,false);
			self::$FM["FlAtivo"] = new FieldMap("FlAtivo","laudo","fl_ativo",false,FM_TYPE_TINYINT,1,null,false);
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
			self::$KM["fk_laudo_exame"] = new KeyMap("fk_laudo_exame", "CdLaudo", "Exame", "CdLaudo", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["fk_digitador_laudo"] = new KeyMap("fk_digitador_laudo", "CdDigitador", "Digitador", "CdDigitador", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["fk_situacao_laudo"] = new KeyMap("fk_situacao_laudo", "CdSituacaoLaudo", "SituacaoLaudo", "CdSituacaoLaudo", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>