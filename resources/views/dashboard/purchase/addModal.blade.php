<!-- start add modal -->
<div class="modal" id="modaldemo8">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ trans('main.Add') }}</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <form method="POST" action="{{ route('purchases.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- date -->
                        <div class="col-4">
                            <label for="date" class="mr-sm-2">{{ trans('main.Date') }} :</label>
                            <input id="date" type="date" class="form-control" name="date" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <!-- warehouse_id -->
                        <div class="col-4">
                            <label for="warehouse" class="mr-sm-2">{{ trans('main.Warehouse') }} :</label>
                            <select class="form-control select2" name="warehouse_id" required>
                                <option label="{{ trans('main.Choose') }}"></option>
                                @foreach($warehouses as $warehouse)
                                    <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- provider_id -->
                        <div class="col-4">
                            <label for="provider_id" class="mr-sm-2">{{ trans('main.Provider') }} :</label>
                            <select class="form-control select2" name="provider_id" required>
                                <option label="{{ trans('main.Choose') }}"></option>
                                @foreach($providers as $provider)
                                    <option value="{{$provider->id}}">{{$provider->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- tax_rate -->
                        <div class="col-4">
                            <label for="tax_rate" class="mr-sm-2">{{ trans('main.Tax Rate') }} (%) :</label>
                            <input id="tax_rate" type="number" class="form-control" name="tax_rate" value="0" value="{{ old('tax_rate') }}" required oninput="checkTaxRate()">
                        </div>
                        <!-- discount -->
                        <div class="col-4">
                            <label for="discount" class="mr-sm-2">{{ trans('main.Discount') }} :</label>
                            <input id="discount" type="number" class="form-control" name="discount" value="0" value="{{ old('discount') }}" required oninput="checkDiscount()">
                        </div>
                        <!-- shipping -->
                        <div class="col-4">
                            <label for="shipping" class="mr-sm-2">{{ trans('main.Shipping') }} :</label>
                            <input id="shipping" type="number" class="form-control" name="shipping" value="0" value="{{ old('shipping') }}" required oninput="checkShipping()">
                        </div>
                        <!-- status -->
                        <div class="col-4">
                            <label for="status" class="mr-sm-2">{{ trans('main.Status') }} :</label>
                            <select class="form-control" name="status" required>
                                <option value="received" selected>{{ trans('main.Received') }}</option>
                                <option value="ordered">{{ trans('main.Ordered') }}</option>
                                <option value="pending">{{ trans('main.Pending') }}</option>
                            </select>
                        </div>
                        <!--notes-->
                        <div class="col-8">
                            <label for="note">{{ trans('main.Notes') }}</label>
                            <textarea id="note" name="notes" type="text" class="form-control" value="{{ old('notes') }}"></textarea>
                        </div>
                        <!--details-->
                        <div class="col-12 mt-3" style="border-top: 1px solid grey;">
                            <div id="purchase_details" name="purchase_details">
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <h4>{{ trans('main.Details') }}</h4>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-4">
                                        <!--add_row-->
                                        <button type="button" class="btn btn-primary ripple" onclick="addRow()">{{ trans('main.Add') }} {{ trans('main.Item') }}</button>
                                        <!--remove_row-->
                                        <button type="button" class="btn btn-dark ripple" onclick="removeRow()">{{ trans('main.Delete') }} {{ trans('main.Item') }}</button>
                                    </div>
                                </div>
                                <table id="myTable" class="col-12">
                                    <tr>
                                        <td style="width:48%;">
                                            <label for="product_id" class="mr-sm-2">{{ trans('main.Product') }} :</label>
                                            <select class="form-control select2" name="product_id[]" required>
                                                <option label="{{ trans('main.Choose') }}"></option>
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}">
                                                        {{$product->name}}
                                                        {{ trans('main.Machine Number') }} : {{$product->machine_number}}
                                                        {{ trans('main.Motor Number') }} : {{$product->motor_number}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="width:3%;"></td>
                                        <td style="width:48%;">
                                            <label for="quantity" class="mr-sm-2">{{ trans('main.Quantity') }} :</label>
                                            <input id="quantity" type="number" class="form-control" name="quantity[]" value="1" value="{{ old('quantity') }}" required oninput="checkQuantity()">
                                        </td>
                                        <td style="width:1%;"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer mt-3">
                        @can('إضافة المشتريات')
                            <button type="submit" class="btn btn-success ripple">{{ trans('main.Confirm') }}</button>
                        @endcan
                        <button type="button" class="btn btn-danger ripple" data-dismiss="modal">{{ trans('main.Close') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end add modal -->