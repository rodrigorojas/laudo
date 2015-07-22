<?php
/** @package    LAUDO::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Exame.php");

/**
 * ExameController is the controller class for the Exame object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package LAUDO::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class ExameController extends AppBaseController
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
	 * Displays a list view of Exame objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Exame records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new ExameCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('CdExame,CdProcedimento,DtLancamento,CdMedico,CdMedicoSolicitante,FlLaudado,CdSituacaoExame,CdPaciente,NuProtocoloInterno,CdModalidade,CdLaudo'
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

				$exames = $this->Phreezer->Query('Exame',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $exames->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $exames->TotalResults;
				$output->totalPages = $exames->TotalPages;
				$output->pageSize = $exames->PageSize;
				$output->currentPage = $exames->CurrentPage;
			}
			else
			{
				// return all results
				$exames = $this->Phreezer->Query('Exame',$criteria);
				$output->rows = $exames->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single Exame record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('cdExame');
			$exame = $this->Phreezer->Get('Exame',$pk);
			$this->RenderJSON($exame, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Exame record and render response as JSON
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

			$exame = new Exame($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $exame->CdExame = $this->SafeGetVal($json, 'cdExame');

			$exame->CdProcedimento = $this->SafeGetVal($json, 'cdProcedimento');
			$exame->DtLancamento = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dtLancamento')));
			$exame->CdMedico = $this->SafeGetVal($json, 'cdMedico');
			$exame->CdMedicoSolicitante = $this->SafeGetVal($json, 'cdMedicoSolicitante');
			$exame->FlLaudado = $this->SafeGetVal($json, 'flLaudado');
			$exame->CdSituacaoExame = $this->SafeGetVal($json, 'cdSituacaoExame');
			$exame->CdPaciente = $this->SafeGetVal($json, 'cdPaciente');
			$exame->NuProtocoloInterno = $this->SafeGetVal($json, 'nuProtocoloInterno');
			$exame->CdModalidade = $this->SafeGetVal($json, 'cdModalidade');
			$exame->CdLaudo = $this->SafeGetVal($json, 'cdLaudo');

			$exame->Validate();
			$errors = $exame->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$exame->Save();
				$this->RenderJSON($exame, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Exame record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('cdExame');
			$exame = $this->Phreezer->Get('Exame',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $exame->CdExame = $this->SafeGetVal($json, 'cdExame', $exame->CdExame);

			$exame->CdProcedimento = $this->SafeGetVal($json, 'cdProcedimento', $exame->CdProcedimento);
			$exame->DtLancamento = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dtLancamento', $exame->DtLancamento)));
			$exame->CdMedico = $this->SafeGetVal($json, 'cdMedico', $exame->CdMedico);
			$exame->CdMedicoSolicitante = $this->SafeGetVal($json, 'cdMedicoSolicitante', $exame->CdMedicoSolicitante);
			$exame->FlLaudado = $this->SafeGetVal($json, 'flLaudado', $exame->FlLaudado);
			$exame->CdSituacaoExame = $this->SafeGetVal($json, 'cdSituacaoExame', $exame->CdSituacaoExame);
			$exame->CdPaciente = $this->SafeGetVal($json, 'cdPaciente', $exame->CdPaciente);
			$exame->NuProtocoloInterno = $this->SafeGetVal($json, 'nuProtocoloInterno', $exame->NuProtocoloInterno);
			$exame->CdModalidade = $this->SafeGetVal($json, 'cdModalidade', $exame->CdModalidade);
			$exame->CdLaudo = $this->SafeGetVal($json, 'cdLaudo', $exame->CdLaudo);

			$exame->Validate();
			$errors = $exame->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$exame->Save();
				$this->RenderJSON($exame, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Exame record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('cdExame');
			$exame = $this->Phreezer->Get('Exame',$pk);

			$exame->Delete();

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
