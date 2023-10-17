@extends($chemin_theme_actif,['title' => 'toto'])
    @section('content')
    <style>
        body { font-family: "Roboto", serif; font-size: 0.8rem; font-weight: 400; line-height: 1.4; color: #000000; }
        h1, h2, h4, h5 { font-weight: 700; color: #000000; }
        h1 { font-size: 2rem; }
        h2 { font-size: 1.6rem; }
        h4 { font-size: 1.2rem; }
        h5 { font-size: 1rem; }
        .table { color: #000; }
        .table td, .table th { border-top: 1px solid #000; }
        .table thead th { vertical-align: bottom; border-bottom: 2px solid #000; }

        @page {
            margin-top: 2.5cm;
            margin-bottom: 2.5cm;
            size: 297mm 210mm ;
        }

        @page :first {
            margin-top: 0;
            margin-bottom: 2.5cm;
        }
        @media print {  
        @page {  
        /* size:297mm 200mm;   */
        }  
}
    </style>
    <div style="background-color: #000000; height: 10px;"></div>
    <div class="container-fluid pt-2 pt-md-4 px-md-5">

        <!-- Invoice heading -->
    
        <table class="table table-borderless">
            <tbody>
            <tr>
                <td class="border-0">
                    <div class="row">
                        <div class="col-md text-center text-md-left mb-3 mb-md-0">
                            <img class="logo img-fluid mb-3" src="https://docamatic.s3-eu-west-1.amazonaws.com/assets/360_logo.png" style="max-height: 140px;"/>
                            <br>
    
                            <h2 class="mb-1">360 Footwear</h2>
                            787 Brunswick, Los Angeles, CA 50028<br>
                            support@360footwear.co / 4444 555 555<br>
                            <strong>360footwear.co</strong>
                        </div>
    
                        <div class="col text-center text-md-right">
    
                            <!-- Dont' display Bill To on mobile -->
                            <span class="d-none d-md-block">
                                <h1>Billed To</h1>
                            </span>
    
                            <h4 class="mb-0">Casey Williams</h4>
    
                            57 Parkway, 5th Floor<br/>
                            New York, NY 10013<br/>
                            casey@test.com<br/>
    
                            <h5 class="mb-0 mt-3">14th June, 2018</h5>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    
        <!-- Invoice items table -->
    
        <table class="table">
            <thead>
            <tr>
                <th>Summary</th>
                <th class="text-right">Price</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <h5 class="mb-1">Pursuit Running Shoes</h5>
                    Men's Pursuit Running Shoes - 10/M
                </td>
                <td class="font-weight-bold align-middle text-right text-nowrap">$149.00 USD</td>
            </tr>
        </table>
    
        <!-- Thank you note -->
    
        <h5 class="text-center pt-2">
            Thank you for your custom!
        </h5>
    </div>
    @endsection
    <script>
        window.print()
    </script>