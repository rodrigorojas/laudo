<?php
/** @package    Laudo::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * ModalidadeMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the ModalidadeDAO to the modalidade datastore.
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
class ModalidadeMap implements IDaoMap, IDaoMap2
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
			self::$FM["CdModalidade"] = new FieldMap("CdModalidade","modalidade","cd_modalidade",true,FM_TYPE_INT,11,null,true);
			self::$FM["DsModalidade"] = new FieldMap("DsModalidade","modalidade","ds_modalidade",false,FM_TYPE_VARCHAR,64,null,false);
			self::$FM["FlAtivo"] = new FieldMap("FlAtivo","modalidade","fl_ativo",false,FM_TYPE_TINYINT,1,null,false);
			self::$FM["DsSigla"] = new FieldMap("DsSigla","modalidade","ds_sigla",false,FM_TYPE_VARCHAR,8,null,false);
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
			self::$KM["fk_modalidade_exame"] = new KeyMap("fk_modalidade_exame", "CdModalidade", "Exame", "CdModalidade", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
		}
		return self::$KM;
	}

}

?>