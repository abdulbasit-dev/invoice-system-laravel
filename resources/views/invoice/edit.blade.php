@extends('layouts.app')



@section('style')
  <link rel="stylesheet"
    href="{{ asset('frontend/css/pickadate/classic.css') }}">
  <link rel="stylesheet"
    href="{{ asset('frontend/css/pickadate/classic.date.css') }}">
  @if (config('app.locale') == 'ar' || config('app.locale') == 'kr')
    <link rel="stylesheet"
      href="{{ asset('frontend/css/pickadate/rtl.css') }}">
  @endif
  <style>
    form.form label.error,
    label.error {
      color: red;
      font-style: italic;
    }

  </style>
@endsection



@section('content')
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex">
          <h2>{{ __('Frontend/frontend.invoice', ['invoice_number' => $invoice->invoice_number]) }}</h2>
          <a href="{{ route('invoice.index') }}"
            class="btn btn-primary ml-auto pt-2"><i
              class="fa fa-home mr-2"></i>{{ __('Frontend/frontend.back_to_invoice') }}</a>
        </div>
        <div class="card-body">
          <form action="{{ route('invoice.update', $invoice->id) }}"
            method="POST"
            class="form">
            @csrf
            @method("PATCH")
            <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <label for="customer_name">{{ __('Frontend/frontend.customer_name') }}</label>
                  <input type="text"
                    name="customer_name"
                    class="form-control"
                    value="{{ old('cutomer_name', $invoice->customer_name) }}">
                  @error('customer_name')<span class="help-block text-danger">{{ $message }}</span>@enderror
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label for="customer_email">{{ __('Frontend/frontend.customer_email') }}</label>
                  <input type="text"
                    name="customer_email"
                    class="form-control"
                    value="{{ old('cutomer_email', $invoice->customer_email) }}">
                  @error('customer_email')<span class="help-block text-danger">{{ $message }}</span>@enderror
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label for="customer_mobile">{{ __('Frontend/frontend.customer_mobile') }}</label>
                  <input type="text"
                    name="customer_mobile"
                    class="form-control"
                    value="{{ old('customer_mobile', $invoice->customer_mobile) }}">
                  @error('customer_mobile')<span class="help-block text-danger">{{ $message }}</span>@enderror
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-4">
                <div class="form-group">
                  <label for="company_name">{{ __('Frontend/frontend.company_name') }}</label>
                  <input type="text"
                    name="company_name"
                    class="form-control"
                    value="{{ old('company_name', $invoice->company_name) }}">
                  @error('company_name')<span class="help-block text-danger">{{ $message }}</span>@enderror
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label for="invoice_number">{{ __('Frontend/frontend.invoice_number') }}</label>
                  <input type="text"
                    name="invoice_number"
                    class="form-control"
                    value="{{ old('invoice_number', $invoice->invoice_number) }}">
                  @error('invoice_number')<span class="help-block text-danger">{{ $message }}</span>@enderror
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label for="invoice_date">{{ __('Frontend/frontend.invoice_date') }}</label>
                  <input type="text"
                    name="invoice_date"
                    class="form-control pickadate"
                    value="{{ old('invoice_date', $invoice->invoice_date) }}">
                  @error('invoice_date')<span class="help-block text-danger">{{ $message }}</span>@enderror
                </div>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table"
                id="invoice_details">
                <thead>
                  <tr>
                    <th></th>
                    <th>{{ __('Frontend/frontend.product_name') }}</th>
                    <th>{{ __('Frontend/frontend.unit') }}</th>
                    <th>{{ __('Frontend/frontend.quantity') }}</th>
                    <th>{{ __('Frontend/frontend.unit_price') }}</th>
                    <th>{{ __('Frontend/frontend.product_subtotal') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($invoice->details as $item)
                    <tr class="cloning_row"
                      id="0">

                      <td>
                        @if ($loop->index === 0)
                          #
                        @else
                          <button type="button"
                            class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button>
                        @endif
                      </td>
                      <td>
                        <input type="text"
                          name="product_name[{{ $loop->index }}]"
                          id="product_name"
                          value="{{ old('prodauct_name', $item->product_name) }}"
                          class="product_name form-control">
                        @error('product_name')<span class="help-block text-danger">{{ $message }}</span>@enderror
                      </td>
                      <td>
                        <select name="unit[{{ $loop->index }}]"
                          id="unit"
                          class="unit form-control">
                          <option></option>
                          <option value="piece"
                            {{ $item->unit == 'piece' ? 'selected' : '' }}></option>
                          }}>{{ __('Frontend/frontend.piece') }}
                          </option>
                          <option value="g"
                            {{ $item->unit == 'g' ? 'selected' : '' }}>{{ __('Frontend/frontend.gram') }}</option>
                          <option value="kg"
                            {{ $item->unit == 'kg' ? 'selected' : '' }}>{{ __('Frontend/frontend.kilo_gram') }}
                          </option>
                        </select>
                        @error('unit')<span class="help-block text-danger">{{ $message }}</span>@enderror
                      </td>
                      <td>
                        <input type="number"
                          name="quantity[{{ $loop->index }}]"
                          step="0.01"
                          value={{ old('quntity', $item->quantity) }}
                          id="quantity"
                          class="quantity form-control">
                        @error('quantity')<span class="help-block text-danger">{{ $message }}</span>@enderror
                      </td>
                      <td>
                        <input type="number"
                          name="unit_price[{{ $loop->index }}]"
                          step="0.01"
                          id="unit_price"
                          value={{ old('unit_price', $item->unit_price) }}
                          class="unit_price form-control">
                        @error('unit_price')<span class="help-block text-danger">{{ $message }}</span>@enderror
                      </td>
                      <td>
                        <input type="number"
                          step="0.01"
                          name="row_sub_total[{{ $loop->index }}]"
                          id="row_sub_total"
                          class="row_sub_total form-control"
                          value={{ old('row_sub_total', $item->row_sub_total) }}
                          readonly="readonly">
                        @error('row_sub_total')<span class="help-block text-danger">{{ $message }}</span>@enderror
                      </td>
                    </tr>

                  @endforeach
                </tbody>

                <tfoot>
                  <tr>
                    <td colspan="6">
                      <button type="button"
                        class="btn_add btn btn-primary">{{ __('Frontend/frontend.add_another_product') }}</button>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3"></td>
                    <td colspan="2">{{ __('Frontend/frontend.sub_total') }}</td>
                    <td><input type="number"
                        step="0.01"
                        name="sub_total"
                        id="sub_total"
                        value="{{ old('sub_total', $invoice->sub_total) }}"
                        class="sub_total form-control"
                        readonly="readonly"></td>
                  </tr>
                  <tr>
                    <td colspan="3"></td>
                    <td colspan="2">{{ __('Frontend/frontend.discount') }}</td>
                    <td>
                      <div class="input-group mb-3">
                        <select name="discount_type"
                          id="discount_type"
                          class="discount_type custom-select">
                          <option value="fixed"
                            {{ $invoice->discount_type === 'fiexd' ? 'selected' : '' }}>
                            {{ __('Frontend/frontend.sr') }}</option>
                          <option value="percentage"
                            {{ $invoice->discount_type === 'percentage' ? 'selected' : '' }}>
                            {{ __('Frontend/frontend.percentage') }}</option>
                        </select>
                        <div class="input-group-append">
                          <input type="number"
                            step="0.01"
                            name="discount_value"
                            id="discount_value"
                            value="{{ old('discount_value', $invoice->discount_value) }}"
                            class="discount_value form-control"
                            value="0.00">
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3"></td>
                    <td colspan="2">{{ __('Frontend/frontend.vat') }}</td>
                    <td><input type="number"
                        step="0.01"
                        name="vat_value"
                        id="vat_value"
                        value="{{ old('vat_value', $invoice->vat_value) }}"
                        class="vat_value form-control"
                        readonly="readonly"></td>
                  </tr>
                  <tr>
                    <td colspan="3"></td>
                    <td colspan="2">{{ __('Frontend/frontend.shipping') }}</td>
                    <td><input type="number"
                        step="0.01"
                        name="shipping"
                        value="{{ old('shipping', $invoice->shipping) }}"
                        id="shipping"
                        class="shipping form-control"></td>
                  </tr>
                  <tr>
                    <td colspan="3"></td>
                    <td colspan="2">{{ __('Frontend/frontend.total_due') }}</td>
                    <td><input type="number"
                        step="0.01"
                        name="total_due"
                        value="{{ old('total_due', $invoice->total_due) }}"
                        id="total_due"
                        class="total_due form-control"
                        readonly="readonly"></td>
                  </tr>
                </tfoot>
              </table>
            </div>

            <div class="text-right pt-3">
              <button type="submit"
                name="save"
                class="btn btn-primary">{{ __('Frontend/frontend.update') }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')

  <script src="{{ asset('frontend/js/pickadate/picker.js') }}"></script>
  <script src="{{ asset('frontend/js/pickadate/picker.date.js') }}"></script>
  <script src="{{ asset('frontend/js/form_validation/jquery.form.js') }}"></script>
  <script src="{{ asset('frontend/js/form_validation/jquery.validate.min.js') }}"></script>
  @if (config('app.locale') == 'ar' || config('app.locale') == 'kr')
    <script src="{{ asset('frontend/js/pickadate/ar.js') }}"></script>
    <script src="{{ asset('frontend/js/form_validation/messages_ar.js') }}"></script>
  @endif
  <script src="{{ asset('frontend/js/custom.js') }}"></script>

@endsection
