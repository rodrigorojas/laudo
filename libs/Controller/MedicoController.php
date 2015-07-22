<?php
/** @package    LAUDO::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Medico.php");

/**
 * MedicoController is the controller class for the Medico object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package LAUDO::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class MedicoController extends AppBaseController
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
	 * Displays a list view of Medico objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Medico records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new MedicoCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('CdMedico,DsMedico,DsCrm,FlAtivo,BbAssinatura'
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

				$medicos = $this->Phreezer->Query('Medico',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $medicos->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $medicos->TotalResults;
				$output->totalPages = $medicos->TotalPages;
				$output->pageSize = $medicos->PageSize;
				$output->currentPage = $medicos->CurrentPage;
			}
			else
			{
				// return all results
				$medicos = $this->Phreezer->Query('Medico',$criteria);
				$output->rows = $medicos->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single Medico record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('cdMedico');
			$medico = $this->Phreezer->Get('Medico',$pk);
			$this->RenderJSON($medico, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Medico record and render response as JSON
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

			$medico = new Medico($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $medico->CdMedico = $this->SafeGetVal($json, 'cdMedico');

			$medico->DsMedico = $this->SafeGetVal($json, 'dsMedico');
			$medico->DsCrm = $this->SafeGetVal($json, 'dsCrm');
			$medico->FlAtivo = $this->SafeGetVal($json, 'flAtivo');
			$medico->BbAssinatura = $this->SafeGetVal($json, 'bbAssinatura');

			$medico->Validate();
			$errors = $medico->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$medico->Save();
				$this->RenderJSON($medico, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Medico record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('cdMedico');
			$medico = $this->Phreezer->Get('Medico',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $medico->CdMedico = $this->SafeGetVal($json, 'cdMedico', $medico->CdMedico);

			$medico->DsMedico = $this->SafeGetVal($json, 'dsMedico', $medico->DsMedico);
			$medico->DsCrm = $this->SafeGetVal($json, 'dsCrm', $medico->DsCrm);
			$medico->FlAtivo = $this->SafeGetVal($json, 'flAtivo', $medico->FlAtivo);
			$medico->BbAssinatura = $this->SafeGetVal($json, 'bbAssinatura', $medico->BbAssinatura);

			$medico->Validate();
			$errors = $medico->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$medico->Save();
				$this->RenderJSON($medico, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Medico record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('cdMedico');
			$medico = $this->Phreezer->Get('Medico',$pk);

			$medico->Delete();

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
