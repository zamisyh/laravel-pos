<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Customer;
use App\Models\Order_detail;

class invoiceExcel implements FromView
{

    use Exportable;

    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    // public function registerEvents(): array
    // {
    //     //MEMANIPULASI CELL
    //     return [
    //         AfterSheet::class    => function(AfterSheet $event) {
    //             //CELL TERKAIT AKAN DI-MERGE
    //             $event->sheet->mergeCells('A1:C1');
    //             $event->sheet->mergeCells('A2:B2');
    //             $event->sheet->mergeCells('A3:B3');


    //             //DEFINISIKAN STYLE UNTUK CELL
    //             $styleArray = [
    //                 'font' => [
    //                     'bold' => true,
    //                 ],
    //                 'alignment' => [
    //                     'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    //                 ],
    //                 'borders' => [
    //                     'top' => [
    //                         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //                     ],
    //                 ],
    //                 'fill' => [
    //                     'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
    //                     'rotation' => 90,
    //                     'startColor' => [
    //                         'argb' => 'FFA0A0A0',
    //                     ],
    //                     'endColor' => [
    //                         'argb' => 'FFFFFFFF',
    //                     ],
    //                 ],
    //             ];
    //             //CELL TERAKAIT AKAN MENGGUNAKAN STYLE DARI $styleArray
    //             $event->sheet->getStyle('A9:E9')->applyFromArray($styleArray);


    //             //FORMATTING STYLE UNTUK CELL TERKAIT
    //             $headCustomer = [
    //                 'font' => [
    //                     'bold' => true,
    //                 ]
    //             ];
    //             $event->sheet->getStyle('A5:A7')->applyFromArray($headCustomer);
    //         },
    //     ];
    // }

    public function view(): View
    {
        $order = Order::select('*')->where('customer_id', $this->id)->with('order_detail', 'order_detail.product')->get();
        $customer = Customer::find($this->id);
        $ordered = Order::where('customer_id', $this->id)->first();

        return view('client.customer.report.excel', compact('order', 'customer', 'ordered'));
    }
}
