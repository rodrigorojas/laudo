<?php
/** @package    LAUDO::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Laudo.php");

/**
 * LaudoController is the controller class for the Laudo object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package LAUDO::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class LaudoController extends AppBaseController
{

	/**
	 * Override here for any controller-specific functionality
	 *
	 * @inheritdocs
	 */
	protected function Init()
	{
		parent::Init();

		// TODO: add controller-wide bootstrap code
		
		// TODO: if authentiation is required for this entire controller, for example:
		// $this->RequirePermission(ExampleUser::$PERMISSION_USER,'SecureExample.LoginForm');
	}

	/**
	 * Displays a list view of Laudo objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Laudo records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new LaudoCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('CdLaudo,BbLaudo,DtLaudo,CdMedico,BbAssinado,DtAssinado,DtRevisado,BbLaudoRevisado,CdSituacaoLaudo,CdDigitador,FlAtivo'
				, '%'.$filter.'%')
			);

			// TODO: this is generic query filtering based only on criteria properties
			foreach (array_keys($_REQUEST) as $prop)
			{
				$prop_normal = ucfirst($prop);
				$prop_equals = $prop_normal.'_Equals';

				if (property_exists($criteria, $prop_normal))
				{
					$criteria->$prop_normal = RequestUtil::Get($prop);
				}
				elseif (property_exists($criteria, $prop_equals))
				{
					// this is a convenience so that the _Equals suffix is not needed
					$criteria->$prop_equals = RequestUtil::Get($prop);
				}
			}

			$output = new stdClass();

			// if a sort order was specified then specify in the criteria
 			$output->orderBy = RequestUtil::Get('orderBy');
 			$output->orderDesc = RequestUtil::Get('orderDesc') != '';
 			if ($output->orderBy) $criteria->SetOrder($output->orderBy, $output->orderDesc);

			$page = RequestUtil::Get('page');

			if ($page != '')
			{
				// if page is specified, use this instead (at the expense of one extra count query)
				$pagesize = $this->GetDefaultPageSize();

				$laudos = $this->Phreezer->Query('Laudo',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $laudos->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $laudos->TotalResults;
				$output->totalPages = $laudos->TotalPages;
				$output->pageSize = $laudos->PageSize;
				$output->currentPage = $laudos->CurrentPage;
			}
			else
			{
				// return all results
				$laudos = $this->Phreezer->Query('Laudo',$criteria);
				$output->rows = $laudos->ToObjectArray(true, $this->SimpleObjectParams());
				$output->totalResults = count($output->rows);
				$output->totalPages = 1;
				$output->pageSize = $output->totalResults;
				$output->currentPage = 1;
			}


			$this->RenderJSON($output, $this->JSONPCallback());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method retrieves a single Laudo record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('cdLaudo');
			$laudo = $this->Phreezer->Get('Laudo',$pk);
			$this->RenderJSON($laudo, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Laudo record and render response as JSON
	 */
	public function Create()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$laudo = new Laudo($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $laudo->CdLaudo = $this->SafeGetVal($json, 'cdLaudo');

			$laudo->BbLaudo = $this->SafeGetVal($json, 'bbLaudo');
			$laudo->DtLaudo = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dtLaudo')));
			$laudo->CdMedico = $this->SafeGetVal($json, 'cdMedico');
			$laudo->BbAssinado = $this->SafeGetVal($json, 'bbAssinado');
			$laudo->DtAssinado = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dtAssinado')));
			$laudo->DtRevisado = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dtRevisado')));
			$laudo->BbLaudoRevisado = $this->SafeGetVal($json, 'bbLaudoRevisado');
			$laudo->CdSituacaoLaudo = $this->SafeGetVal($json, 'cdSituacaoLaudo');
			$laudo->CdDigitador = $this->SafeGetVal($json, 'cdDigitador');
			$laudo->FlAtivo = $this->SafeGetVal($json, 'flAtivo');

			$laudo->Validate();
			$errors = $laudo->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$laudo->Save();
				$this->RenderJSON($laudo, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Laudo record and render response as JSON
	 */
	public function Update()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$pk = $this->GetRouter()->GetUrlParam('cdLaudo');
			$laudo = $this->Phreezer->Get('Laudo',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $laudo->CdLaudo = $this->SafeGetVal($json, 'cdLaudo', $laudo->CdLaudo);

			$laudo->BbLaudo = $this->SafeGetVal($json, 'bbLaudo', $laudo->BbLaudo);
			$laudo->DtLaudo = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dtLaudo', $laudo->DtLaudo)));
			$laudo->CdMedico = $this->SafeGetVal($json, 'cdMedico', $laudo->CdMedico);
			$laudo->BbAssinado = $this->SafeGetVal($json, 'bbAssinado', $laudo->BbAssinado);
			$laudo->DtAssinado = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dtAssinado', $laudo->DtAssinado)));
			$laudo->DtRevisado = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dtRevisado', $laudo->DtRevisado)));
			$laudo->BbLaudoRevisado = $this->SafeGetVal($json, 'bbLaudoRevisado', $laudo->BbLaudoRevisado);
			$laudo->CdSituacaoLaudo = $this->SafeGetVal($json, 'cdSituacaoLaudo', $laudo->CdSituacaoLaudo);
			$laudo->CdDigitador = $this->SafeGetVal($json, 'cdDigitador', $laudo->CdDigitador);
			$laudo->FlAtivo = $this->SafeGetVal($json, 'flAtivo', $laudo->FlAtivo);

			$laudo->Validate();
			$errors = $laudo->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$laudo->Save();
				$this->RenderJSON($laudo, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Laudo record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('cdLaudo');
			$laudo = $this->Phreezer->Get('Laudo',$pk);

			$laudo->Delete();

			$output = new stdClass();

			$this->RenderJSON($output, $this->JSONPCallback());

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
}

?>
