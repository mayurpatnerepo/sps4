@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"/>    
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>    
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css"/>    
<link rel="stylesheet" href="{{asset('css/datatableCutstom.css')}}"/>
<link rel="stylesheet" href="{{asset('css/swal.css')}}"/> 
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}"/> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<style>
a {
  -webkit-transition: .25s all;
  transition: .25s all;
}
/*.card {
  overflow: hidden;
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  -webkit-transition: .25s box-shadow;
  transition: .25s box-shadow;
}

.card:focus,
.card:hover {
  box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 0.18), 0 4px 15px 0 rgba(0, 0, 0, 0.15);
}

.card-inverse .card-img-overlay {
  background-color: rgba(51, 51, 51, 0.85);
  border-color: rgba(51, 51, 51, 0.85);
}
.accord{
		width: -webkit-fill-available;
		width:100%;
		border-radius: 0px;}
#accordion .panel{padding:5 0 5 0;}
#accordion .panel-body{padding:5px;border-style: none ridge none ridge;margin: 0 8 0 8;}
#accordion .panel-body-last{padding:5px;border-style: none ridge ridge ridge;margin: 0 8 0 8;}

.panel-default>.panel-heading a:after {
  content: "";
  position: relative;
  top: 1px;
  display: inline-block;
  font-family: 'Glyphicons Halflings';
  font-style: normal;
  font-weight: 400;
  line-height: 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  float: right;
  transition: transform .25s linear;
  -webkit-transition: -webkit-transform .25s linear;
}

.panel-default>.panel-heading a[aria-expanded="true"] {
  background-color: #eee;
}

.panel-default>.panel-heading a[aria-expanded="true"]:after {
  content: "\2212";
  -webkit-transform: rotate(180deg);
  transform: rotate(180deg);
}

.panel-default>.panel-heading a[aria-expanded="false"]:after {
  content: "\002b";
  -webkit-transform: rotate(90deg);
  transform: rotate(90deg);
}

*/

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
#container_div {
    background:#FAFAFA;

}
#headername {
 background:#6495ed;
 color:white;
}

button.dt-button, div.dt-button, a.dt-button {
  background-image: linear-gradient(to bottom, #F08080	 0%, #F08080 100%);!important
  border-radius: 15px;
  color: white;
  font-size: 12px;
  margin: 10px 0px;
}

.text-wrap{
    white-space:normal;
}
.width-200{
    width:150px;
}
div.dt-button-collection button.dt-button.active:not(.disabled) {
background-image: linear-gradient(to bottom, #9cbbc7 0%, #4CAF50 100%)!important;
}
#data_table tbody tr.even:hover {
       background-color: cadetblue;
       cursor: pointer;
   }
 
   #data_table tr.odd:hover {
       background-color: cadetblue;
       cursor: pointer;
   }
</style>

<div class="card" id="container_div">
<div class="card-header" id="headername" style="font-weight:solid">
    List of Orders
</div>
<div class="card-body">
<div class="cc_wrapper">

</div>
    <table class=" table nowrap data-table table-responsive display " style="width:100%" cellspacing="0"  id="data_table">
       {{csrf_field()}}
        <thead >
            
            <tr class="table_head">
                <th>Id</th>
                <th>Organization Name</th>
                <th>Contact Person</th>
                <th>Mobile Number</th>
                <th>products</th>
                <!--<th>Tax Amount</th>
                <th>Discount Amount</th>-->
                <th>Total Amount</th>
                <th>Created at</th>
                <th>Status</th>
                <th>Invoice</th>
            </tr>
                       
        </thead>
        <thead class="theadx">
             <tr>
              <th>Id</th>
                <th>Organization Name</th>
                <th>Contact Person</th>
                <th>Mobile Number</th>
                <th>products</th>
                <!--<th>Tax Amount</th>
                <th>Discount Amount</th>-->
                <th>Total Amount</th>
                <th>Created at</th>
                <th>Status</th>
                <th>Invoice</th>
            </tr>
        </thead>
        <tbody class="bodytable">
            
                @foreach ($mainorders as $order)
                 <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->organization_name}}</td>
                    <td>{{$order->contact_person_name}}</td>
                    <td>{{$order->mobile_number}}</td>
                    <td>
                    <ul style="list-style: none;">
                       <?php $counter_prop=1; ?>
                    @foreach ($orderparticulars as $orderparticular)
                    @if($order->id == $orderparticular->orders_id)

                         <b>{{$counter_prop}}</b>. {{$orderparticular->products}}
                          <?php $counter_prop++; ?>
                      <br>
                    @endif
                    
                    @endforeach 
                    </ul>
                    </td>
                     <!--<?php
                         $true_tax=0;
                         $discounted_amt=0;
                          $tax_amt=0;

                          $igst = $order->igst;
                          $cgst =  $order->cgst;
                          $sgst=  $order->sgst;

                          $true_tax=$sgst+$igst+$cgst;

                          $qty = $order->qty;
                          $price = $order->price;
                          $discount= $order->discount;
                          $discounted_amt=($qty*$price)-$discount; 

                            $tax_amt=$discounted_amt*($true_tax/100);
                      ?>
                    <td>{{$tax_amt}}</td>
                    <td>{{$discounted_amt}}</td>-->
                    <td>{{$order->grand_total}}</td>
                    <td>{{$order->created_at}}</td>
                    
                     @if($order->is_active == 1)
                    <td>
                        <label class="switch">
                        <input type="checkbox" data-is_active="{{$order->is_active}}" data-order_id="{{$order->id}}" value="{{$order->id}}" class="active" checked>
                        <span class="slider round"></span>
                        </label>
                    </td>
                    @elseif($order->is_active == 0)
                    <td>
                        <label class="switch">
                        
                        <input type="checkbox" data-is_active="{{$order->is_active}}" data-order_id="{{$order->id}}" value="{{$order->id}}" class="active">
                        <span class="slider round"></span>
                        </label>
                    </td>
                    @endif
                    @if($order->button_disable == 0) 
                    <td>  
                      <button class="btn btn-success invoicesave" name="invoice" data-order_id="{{$order->id}}" id="invoice"  title="create Invoice" ><i class="fas fa-file-invoice-dollar"></i></button>
                    </td> 
                    @elseif($order->button_disable == 1)
                    <td>
                      <button class="btn btn-success invoicesave" name="invoice" data-order_id="{{$order->id}}" id="invoice" title=" create Invoice" disabled><i class="fas fa-file-invoice-dollar"></i></button>
                    </td>
                    @endif
                </tr>
                @endforeach
           
        </tbody>
       
        
    </table>
</div>
</div>

@endsection

@section('javascript')

<!-- DataTables -->
<script src="{{asset('admin-lte/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin-lte/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>


<script>




  $(document).ready(function() {

  $('#data_table thead tr:eq(1) th').each( function (i) {

        var title = $(this).text();
        $(this).html( '<input type="text"/>' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( data_table.column(i).search() !== this.value ) {
              data_table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );








  // $('#data_table thead.theadx th').each( function () {
  //       var title = $(this).text();
  //       $(this).html( '<input id="column_3_search" class="column_filter" type="text" />' );
  //   } );

     var data_table=$('#data_table').DataTable({
  
      "order": [[ 0, "desc" ]],
      "paging":true,
      "lengthMenu": [10],
       "searching": true,
      columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-200'>" + data + "</div>";
                    },
                    targets: [ 1,2,3,4,5,6 ]
                },
                 { orderable: false, targets: [-1,-2,-4,-5,-6,-7,-8] }
               
             ],
       "searching": true,
       dom: 'Bfrtip',
        stateSave: true,
        buttons: [
            
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 5 ]
                }
            },
            'colvis'
        ]
      
    });

});

 $('.active').change(function (e) {
        var ord_id=$(this).attr("data-order_id");
        var active_id=$(this).attr("data-is_active");
        if(active_id==1)
        {
          $.ajax({
          data: {'is_active':0},
          url: "/orders/orderactive/"+ord_id,
          type: "get",
          dataType: 'json',
          success: function (data) {
                swal("Order Deactivated Successfully","","success");
                 setTimeout(function() { location.reload(); }, 2000); 
            }
        });
        }
        else if(active_id==0)
        {
            $.ajax({
          data: {'is_active':1},
          url: "/orders/orderactive/"+ord_id,
          type: "get",
          dataType: 'json',
          success: function (data) {
              swal("Order Activated Successfully","","success");
              
             setTimeout(function() { location.reload(); }, 3000); 
            }
        });
        }
     });

/*function saveinvoice(Context)
{
   var ord_id=Context.getAttribute("data-order_id");
//alert(ord_id);
       $.ajax({
          url: "/orders/InvoicePDF/"+ord_id,
          type: "get",
          dataType: 'json',
          success: function (data) {
                $.ajax({
                data:{'button_disable':1},
                url: "/orders/invoicecreated/"+ord_id,
                type: "get",
                dataType: 'json',
                success: function (data) {
                      swal("Invoice Created Successfully","","success");
                      setTimeout(function() { window.location.href="{{ route('invoiceActive') }}";}, 2000); 
                  }
              });
            }
        });
  }*/
  $('.invoicesave').click(function (e) {
    debugger;
       var ord_id=$(this).attr("data-order_id");
        $.ajax({
          url: "/orders/InvoicePDF/"+ord_id,
          type: "get",
          dataType: 'json',
          success: function (data) {
                $.ajax({
                data:{'button_disable':1},
                url: "/orders/invoicecreated/"+ord_id,
                type: "get",
                dataType: 'json',
                success: function (data) {
                      swal("Invoice Created Successfully","","success");
                     setTimeout(function() { window.location.href="{{ route('invoiceActive') }}";}, 2000); 
                  }
              });
            }
        });
        

     });

</script>
@endsection
