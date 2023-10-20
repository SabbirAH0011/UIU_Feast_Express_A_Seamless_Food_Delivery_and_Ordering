<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>{{ str_replace(array("/","-",".","_") , " ",strtoupper(request()->route()->getName())) }} | {{
    config('siteConfig.app.name') }}</title>
    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link href="{{ asset('invoice_assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <!--  Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!--  Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Custom Style -->
    <style>
    body {
    font-family: 'Anek Bangla', sans-serif;
    font-size: 12px;
     }
     @media print {
          @page {
              margin-top: 0;
              margin-left: 0.25;
              margin-right: 0.25;
              margin-bottom: 0;
          }

          body {
              padding-top: 40px;
              margin-left: 0.25px;
              margin-right: 0.25px;
              padding-bottom: 40px;
          }
      }
      @media print {
          #printButton {
              display: none;
              position: fixed;
              bottom: 20px;
              right: 30px;
              z-index: 99;
          }
      }

      .details th {
          padding: 5px;
          padding-left: 15px;
      }
    </style>
</head>

<body>
    <section class="p-2">
        <!-- Button -->
        <button class="btn btn-lg btn-floating float-end" style="background-color: #0a7151;color: white;"
            id="printButton" onclick="window.print()"><i class="fas fa-print"></i> Print Invoice</button>
        <!-- Main Invoice starts -->
        <div class="row">
            <div class="col">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Latif And Sons" width="40px" height="40px">
                <p>{{ config('siteConfig.app.address') }}</p>
                <p>Phone: {{ config('siteConfig.app.phone') }}</p>
                <div style="padding-top: 20px;">
                    <table class="table table-borderless">
                        <tr>
                            <td>Bill To:</td>
                            <td scope="col"></td>
                        </tr>
                        <tr>
                            <td>Address:</td>
                            <td scope="col">
                                {{ $address }}<br>
                            </td>
                        </tr>
                        <tr>
                            <td>Contact:</td>
                            <td scope="col">{{ $phone }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col">
                <div class="float-end">
                    <h4 class="text-uppercase">Invoice</h4>
                    <div style="color:#1c1c1c"># <span id="invoiceID"> {{ $serial }}</span></div>
                    <span class="text-white px-2" style="background-color: #0a7151;">Zone: {{ $zone }}</span>
                    <div style="padding-top: 10px;">
                        <p><span style="color:#1c1c1c">Date:</span><span style="padding-left:40px">{{ $date }}</span></p>
                    </div>
                    <div style="background-color:#f5f5f5;">
                        <p style="padding:5px;padding-left:10px"><span style="color:#1c1c1c">Total Bill:</span><span
                                style="padding-left:25px;color:#1c1c1c">{{ $total_cost }} &#2547;</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div style="padding-top: 40px;">
                    <table class="table table-bordered" style="width: 100%; border: 1px solid #0a7151;">
                        <thead style="background-color:#0a7151;">
                            <tr class="text-white">
                                <th scope="col">Item</th>
                                <th scope="col">Weight/unit</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Rate</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product_deatils as $key => $pd)
                            <tr>
                                <td>
                                    {{ strlen($pd['product_name']) > 40 ? substr($pd['product_name'], 0, 20) . '..' : $pd['product_name'] }}
                                </td>
                                <td>{{ $pd['weight'] }}</td>
                                <td>{{ $pd['product_quantity'] }}</td>
                                <td>{{ $pd['single_price'] }}  &#2547;</td>
                                <td>{{ $pd['total_price'] }} &#2547;</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4">Total product price</td>
                                <td>{{ $product_total }} &#2547;</td>
                            </tr>
                            <tr>
                                <td colspan="4">Delivery Charge</td>
                                <td>{{ $delivery_charge }} &#2547;</td>
                            </tr>
                            <tr>
                                <td colspan="4">Grand Total</td>
                                <td>{{ $total_cost }} &#2547;</td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="padding-top:50px">
                        <div class="pt-2">
                            <p><span style="color:#777777">শর্তাবলী:</span><br><span>
                                <span style="color:#e94646">প্যাকেটজাত পণ্য খোলা হলে তা ফেরত যোগ্য নয়</span>
                            </span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="{{ asset('invoice_assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
