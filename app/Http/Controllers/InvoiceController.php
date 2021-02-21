<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

  public function index()
  {
    $invoices = Invoice::orderBy("id", 'desc')->paginate(8);

    return view("invoice.index", ["invoices" => $invoices]);
  }


  public function create()
  {
    return view("invoice.create");
  }


  public function store(Request $request)
  {
    $data['customer_name'] = $request->customer_name;
    $data['customer_email'] = $request->customer_email;
    $data['customer_mobile'] = $request->customer_mobile;
    $data['company_name'] = $request->company_name;
    $data['invoice_number'] = $request->invoice_number;
    $data['invoice_date'] = $request->invoice_date;
    $data['sub_total'] = $request->sub_total;
    $data['discount_type'] = $request->discount_type;
    $data['discount_value'] = $request->discount_value;
    $data['vat_value'] = $request->vat_value;
    $data['shipping'] = $request->shipping;
    $data['total_due'] = $request->total_due;

    $invoice = Invoice::create($data);

    $details_list = [];
    for ($i = 0; $i < count($request->product_name); $i++) {
      $details_list[$i]['product_name'] = $request->product_name[$i];
      $details_list[$i]['unit'] = $request->unit[$i];
      $details_list[$i]['quantity'] = $request->quantity[$i];
      $details_list[$i]['unit_price'] = $request->unit_price[$i];
      $details_list[$i]['row_sub_total'] = $request->row_sub_total[$i];
    }

    $details = $invoice->details()->createMany($details_list);

    if ($details) {
      return redirect()->back()->with([
        'message' => __('Frontend/frontend.created_successfully'),
        'alert-type' => 'success'
      ]);
    } else {
      return redirect()->back()->with([
        'message' => __('Frontend/frontend.created_failed'),
        'alert-type' => 'danger'
      ]);
    }
  }


  public function show(Invoice $invoice)
  {
    return view("invoice.show", ["invoice" => $invoice]);
  }


  public function edit(Invoice $invoice)
  {
    return view("invoice.edit", compact('invoice'));
  }

  public function update(Request $request, $id)
  {

    $invoice = Invoice::whereId($id)->first();

    $data['customer_name'] = $request->customer_name;
    $data['customer_email'] = $request->customer_email;
    $data['customer_mobile'] = $request->customer_mobile;
    $data['company_name'] = $request->company_name;
    $data['invoice_number'] = $request->invoice_number;
    $data['invoice_date'] = $request->invoice_date;
    $data['sub_total'] = $request->sub_total;
    $data['discount_type'] = $request->discount_type;
    $data['discount_value'] = $request->discount_value;
    $data['vat_value'] = $request->vat_value;
    $data['shipping'] = $request->shipping;
    $data['total_due'] = $request->total_due;

    $invoice->update($data);
    $invoice->details()->delete();


    $details_list = [];
    for ($i = 0; $i < count($request->product_name); $i++) {
      $details_list[$i]['product_name'] = $request->product_name[$i];
      $details_list[$i]['unit'] = $request->unit[$i];
      $details_list[$i]['quantity'] = $request->quantity[$i];
      $details_list[$i]['unit_price'] = $request->unit_price[$i];
      $details_list[$i]['row_sub_total'] = $request->row_sub_total[$i];
    }

    $details = $invoice->details()->createMany($details_list);

    if ($details) {
      return redirect()->route("invoice.index")->with([
        'message' => __('Frontend/frontend.updated_successfully'),
        'alert-type' => 'success'
      ]);
    } else {
      return redirect()->back()->with([
        'message' => __('Frontend/frontend.updated_failed'),
        'alert-type' => 'danger'
      ]);
    }
  }

  public function destroy(Invoice $invoice)
  {
    if ($invoice) {
      $invoice->delete();
      return redirect()->route("invoice.index")->with([
        "message" => __('Frontend/frontend.invoice_delete'),
        "alert-type" => "warning"
      ]);
    }
  }

  public function print(Invoice $invoice)
  {
    return view("invoice.print", compact('invoice'));
  }
}
