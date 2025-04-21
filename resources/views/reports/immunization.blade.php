<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <style>
        /* Styles for the footer */
        @page {
            margin-top: 30px;
           margin-left: 4px;
           margin-right: 4px;
        }

        html * {
            font-family:Arial, Helvetica, sans-serif;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9px;
        }

        .content {
            margin-bottom:55px; /* Space for the footer */
        }

        table,
        td,
        th {
            border: .5px solid black;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            padding: 7px;
            vertical-align: top;
        }
        td {
            padding: 3px;
            /* vertical-align: top; */
            /* text-align: center; */
        }
        input[type=checkbox] {
            transform: scale(.7);
        }
        .a {
            width: 55px; 
            height: 55px;
        }
        label {
            display: block;
            padding-left: 15px;
            text-indent: -15px;
        }
        input {
            width: 13px;
            height: 13px;
            padding: 0;
            margin:0;
            vertical-align: bottom;
            position: relative;
            top: -5px;
            left: 7px;
            *overflow: hidden;
        }
        input[type=checkbox] { display: inline; }
        input[type=checkbox]:before { font-family: DejaVu Sans; }
        label {
            display: inline-block;
        }
        .footer {
            position: fixed;
            bottom: -10;
            width: 100%;
            left: 0;
            margin-left: auto;
            margin-right: auto;
        }
        .text-center {
    text-align: center;
}

.align-middle {
    vertical-align: middle;
}
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<?php 

    $lists = json_encode($lists); 
    $lists = json_decode($lists, true);   

    $pages = [
        [
            'name' => 'ACCOUNTING COPY',
            'color' => '#CE2F14'
        ]
    ];

    $loopcount = 0;
?>
<body>
    
   


    <div class="content">
        @foreach($pages as $page)
        <table style="border: 1px solid black; font-size: 10px; margin-top: -22px;">
          
            <thead  style="background-color:#c8c8c8; padding: 5px; font-size: 9px;">
                <tr>
                    <th colspan="54" class="text-center align-middle">Immunization and Nutrition Service</th>
                </tr>
                <tr class="fs-10">
                    {{-- <th class="text-center align-middle" rowspan="2" style="width: 4.5%;">Registration</th>
                    <th class="text-center align-middle" rowspan="2" style="width: 3.5%;">Serial No.</th>
                    <th class="text-center align-middle" rowspan="2" style="width: 8%;">Fullname</th>
                    <th class="text-center align-middle" rowspan="2" style="width: 2%;">Age</th>
                    <th class="text-center align-middle" rowspan="2" style="width: 5%;">Client Type</th>
                    <th class="text-center align-middle" rowspan="2" style="width: 10%;">Method</th>
                    <th class="text-center" colspan="12">Follow-up Visits</th>
                    <th class="text-center" colspan="3" style="width: 15%;">Deworming Drugs Given to 20-40 yrs old</th>
                    <th class="text-center align-middle" style="width: 5%;" rowspan="2">Drop-out</th> --}}
                    <th class="text-center align-middle" rowspan="3" style="width: 4%;">Registration</th>
                    <th class="text-center align-middle" rowspan="3" style="width: 3%;">Serial No.</th>
                    <th class="text-center align-middle" rowspan="3" style="width: 8%;">Name of Child</th>
                    <th class="text-center align-middle" rowspan="3">Sex</th>
                    <th class="text-center align-middle" colspan="2" rowspan="1" style="width: 3.5%;">Child Protected at Birth</th>
                    <th class="text-center" colspan="6" rowspan="1" width="10%">Newborn (0-28 days old)</th>
                    <th class="text-center" colspan="15" rowspan="1" width="15%">1-3 months</th>
                    <th class="text-center" colspan="11" rowspan="1" width="10%">6-11 months</th>
                    <th class="text-center" colspan="6" rowspan="1" width="10%">12 months old</th>
                    <th class="text-center" rowspan="3" width="5%">CIC</th>
                    <th class="text-center" colspan="8" rowspan="1" width="10%">0-11 months</th>
                    <th class="text-center" rowspan="3" width="5%">Remarks</th>
                </tr>
                <tr class="fs-10">
                    <th class="text-center align-middle" rowspan="2">TT2/TD2</th>
                    <th class="text-center align-middle" rowspan="2">TT3/TD3</th>
                    <th class="text-center align-middle" rowspan="2">Length</th>
                    <th class="text-center align-middle" rowspan="2">Weight</th>
                    <th class="text-center align-middle" rowspan="2">Breast Feeding</th>
                    <th class="text-center align-middle" rowspan="2">Status</th>
                    <th class="text-center align-middle" colspan="2">Immunization</th>
                    <th class="text-center align-middle" colspan="4">Breast Feeding</th>
                    <th class="text-center align-middle" colspan="4">Nutritional Status Assessment</th>
                    <th class="text-center align-middle" colspan="3">Birth Weight</th>
                    <th class="text-center align-middle" colspan="4">Immunization</th>
                    <th class="text-center align-middle" colspan="4">Nutritional Status Assessment</th>
                    <th class="text-center align-middle" colspan="2">Complementary Feeding</th>
                    <th class="text-center align-middle" rowspan="2">Exclusively Breastfed</th>
                    <th class="text-center align-middle" rowspan="2">Vitamin A</th>
                    <th class="text-center align-middle" rowspan="2">MNP</th>
                    <th class="text-center align-middle" rowspan="2">MMR Dose 1</th>
                    <th class="text-center align-middle" rowspan="2">IPV Dose 2</th>
                    <th class="text-center align-middle" colspan="4">Nutritional Status Assessment</th>
                    <th class="text-center align-middle" rowspan="2">MMR Dose 2</th>
                    <th class="text-center align-middle" rowspan="2">FIC Date</th>
                    <th class="text-center align-middle" colspan="4">MAM</th>
                    <th class="text-center align-middle" colspan="4">SAM</th>
                </tr>
                <tr>
                    <th class="text-center align-middle">BCG</th>
                    <th class="text-center align-middle">Hepa B</th>
                    <th class="text-center align-middle">1 1/2</th>
                    <th class="text-center align-middle">2 1/2</th>
                    <th class="text-center align-middle">3 1/2</th>
                    <th class="text-center align-middle">4-5</th>
                    <th class="text-center align-middle">Age</th>
                    <th class="text-center align-middle">Length</th>
                    <th class="text-center align-middle">Weight</th>
                    <th class="text-center align-middle">Status</th>
                    <th class="text-center align-middle">1 mos.</th>
                    <th class="text-center align-middle">2 mos.</th>
                    <th class="text-center align-middle">3 mos.</th>
                    <th class="text-center align-middle">DPT-HIB-HepB</th>
                    <th class="text-center align-middle">OPV</th>
                    <th class="text-center align-middle">PCV</th>
                    <th class="text-center align-middle">IPV</th>
                    <th class="text-center align-middle">Age</th>
                    <th class="text-center align-middle">Length</th>
                    <th class="text-center align-middle">Weight</th>
                    <th class="text-center align-middle">Status</th>
                    <th class="text-center align-middle">Y/N</th>
                    <th class="text-center align-middle">1/2</th>
                    <th class="text-center align-middle">Age</th>
                    <th class="text-center align-middle">Length</th>
                    <th class="text-center align-middle">Weight</th>
                    <th class="text-center align-middle">Status</th>
                    <th class="text-center align-middle">Admitted</th>
                    <th class="text-center align-middle">Cured</th>
                    <th class="text-center align-middle">Defaulted</th>
                    <th class="text-center align-middle">Died</th>
                    <th class="text-center align-middle">Admitted</th>
                    <th class="text-center align-middle">Cured</th>
                    <th class="text-center align-middle">Defaulted</th>
                    <th class="text-center align-middle">Died</th>
                <tr>
            </thead>
            <tbody>1
                @foreach($lists as $index=>$list)
                    <tr style="text-align: center; font-size: 10px; color: #072388;">
                        <td class="text-center"> {{ $list['registration']}}</td>
                        <td class="text-center"> {{ $list['serial_no']}}</td>
                        <td class="text-center"> {{ $list['name']}}</td>
                        <td class="text-center"> {{ $list['age']}}</td>
                        <td class="text-center"> {{ $list['type']}}</td>
                        <td class="text-center"> {{ $list['method']}}</td>
                        @foreach($list['visits'] as $index2=>$visit)
                            <td class="text-center">
                                {{($visit) ? $visit : '-'}}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

      
        @endforeach
    </div>
</body>
</html>