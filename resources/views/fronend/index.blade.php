@extends('layouts.app')
@section('content')
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex">
          <h2>{{ __('Frontend/frontend.invoices') }}</h2>
          <a href="{{ route('invoice.create') }}"
            class="btn btn-primary ml-auto pt-2"><i class="fa fa-plus"></i>
            {{ __('Frontend/frontend.create_invoice') }}</a>
        </div>

        <div class="table-responsive">
          <table class="table card-table">
            <thead>
              <tr>
                <th>{{ __('Frontend/frontend.customer_name') }}</th>
                <th>{{ __('Frontend/frontend.customer_email') }}</th>
                <th>{{ __('Frontend/frontend.invoice_date') }}</th>
                <th>{{ __('Frontend/frontend.total_due') }}</th>
                <th>{{ __('Frontend/frontend.actions') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($invoices as $invoice)

                <tr>
                  <td><a href="{{ route('invoice.show', $invoice) }}">{{ $invoice->customer_name }}</a></td>
                  <td><a href="{{ route('invoice.show', $invoice) }}">{{ $invoice->customer_email }}</a></td>
                  <td>{{ $invoice->invoice_date }}</td>
                  <td>{{ $invoice->total_due }}</td>
                  <td class="d-flex">
                    <a href="{{ route('invoice.edit', $invoice) }}"
                      class="btn btn-primary btn-sm mr-2"><i class="fa fa-edit"></i></a>
                    {{-- DELETE ACTION --}}
                    <a href="javascript:void(0)"
                      class="btn btn-danger btn-sm"
                      onclick="if (confirm('{{ __('Frontend/frontend.r_u_sure') }}')){document.getElementById('delete-{{ $invoice->id }}').submit();} else{return false}">
                      <i class="fa fa-trash"></i>
                    </a>
                    <form action="{{ route('invoice.destroy', $invoice) }}"
                      method="POST"
                      id="delete-{{ $invoice->id }}">
                      @csrf
                      @method('DELETE')
                    </form>
                    {{-- DELETE WITHOUT WARING --}}
                    {{-- <form action="{{ route('invoice.destroy', $invoice) }}"
                      method="post">
                      @csrf
                      @method("DELETE")
                      <button type="submit"
                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </form> --}}
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4">
                  <div class="float-right">
                    {{ $invoices->links() }}
                  </div>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>


      </div>
    </div>
  </div>


@endsection
