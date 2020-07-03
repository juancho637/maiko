<?php

namespace App\Http\Controllers\Dashboard\Inspection;

use App\Status;
use Carbon\Carbon;
use App\Inspection;
use App\Http\Controllers\Controller;
use PhpOffice\PhpWord\TemplateProcessor;

class InspectionController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:download inspection cert')->only(['approved', 'rejected']);
    }

    /**
     * .
     *
     * @param  \App\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function approved(Inspection $inspection)
    {
        if (Status::abbreviation('insp-pass')->id !== $inspection->status_id) {
            return redirect()->route('dashboard.work_orders.inspections.show', [$inspection->work_order, $inspection])->with('error', __("La inspección no contiene el estado requerido para realizar la descarga del certificado"));
        }

        try {
            $date = Carbon::now()->locale('es')->isoFormat('D [de] MMMM [/] YYYY');
            $company = $inspection->work_order->company;
            $client = $inspection->tank->client;
            $tank = $inspection->tank;

            $template = new TemplateProcessor(storage_path('certs/aprobacion.docx'));
            $template->setValue('date', $date);
            $template->setValue('company_name', $company->name);
            $template->setValue('client_address', $client->address);
            $template->setValue('client_city', $client->city->name);
            $template->setValue('client_state', $client->city->state->name);
            $template->setValue('tank_serial', $tank->serial_number);
            $template->setValue('tank_maker', $tank->maker);
            $template->setValue('tank_fabrication_year', Carbon::parse($tank->fabrication_year)->locale('es')->isoFormat('YYYY'));
            $template->setValue('inspection_date', Carbon::parse($inspection->date)->locale('es')->isoFormat('D [de] MMMM [/] YYYY'));

            $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
            $template->saveAs($tempFile);

            $headers = [
                "Content-type: application/octet-stream",
            ];

            return response()->download($tempFile, 'inspección_#'.$inspection->id.'_aprobada.docx', $headers)->deleteFileAfterSend(true);
        } catch (\PhpOffice\PhpWord\Exception\Exception $e) {
            return back($e->getCode());
        }
    }

    /**
     * .
     *
     * @param  \App\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function rejected(Inspection $inspection)
    {
        if (Status::abbreviation('insp-refu')->id !== $inspection->status_id) {
            return redirect()->route('dashboard.inspections.show', $inspection)->with('error', __("La inspección no contiene el estado requerido para realizar la descarga del certificado"));
        }

        try {

        } catch (\PhpOffice\PhpWord\Exception\Exception $e) {
            return back($e->getCode());
        }
    }
}
