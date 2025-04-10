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
                    <th colspan="27" class="text-center align-middle">Prenetal</th>
                </tr>
                <tr class="fs-10">
                    <th class="text-center align-middle" style="width: 120px;" rowspan="3">Registration</th>
                    <th class="text-center align-middle" style="width: 180px;" rowspan="3">Fullname</th>
                    <th class="text-center align-middle" rowspan="3">Age</th>
                    <th class="text-center" colspan="3">Prenatal Check-ups</th>
                    <th class="text-center" colspan="6">Immunization Status</th>
                    <th class="text-center" colspan="8">Micronutrient Supplementation</th>
                    <th class="text-center">Nutritional Assessment</th>
                    <th class="text-center">Deworming Tablet</th>
                    <th class="text-center" colspan="3">Infectious Disease Surveillance</th>
                    <th class="text-center" colspan="2">Laboratory Screening</th>
                </tr>
                <tr class="fs-10">
                    <th class="text-center align-middle" rowspan="2">1st Tri</th>
                    <th class="text-center align-middle" rowspan="2">2nd Tri</th>
                    <th class="text-center align-middle" rowspan="2">3rd Tri</th>
                    <th class="text-center" colspan="5">Tetanus Diphtheria/Toxoid</th>
                    <th class="text-center">FIM</th>
                    <th class="text-center" colspan="4">Iron Sulfate</th>
                    <th class="text-center" colspan="3">Calcium Carbonate</th>
                    <th class="text-center">Iodine Capsules</th>
                    <th class="text-center align-middle" rowspan="2">-</th>
                    <th class="text-center align-middle" rowspan="2">-</th>
                    <th class="text-center align-middle" rowspan="2">Screening</th>
                    <th class="text-center align-middle" rowspan="2">Hepatitis B</th>
                    <th class="text-center align-middle" rowspan="2">HIV</th>
                    <th class="text-center align-middle" rowspan="2">Gestational Diabetes</th>
                    <th class="text-center align-middle" rowspan="2">CBC/HGB/HCT</th>
                </tr>
                <tr class="fs-10">
                    <th class="text-center">1</th>
                    <th class="text-center">2</th>
                    <th class="text-center">3</th>
                    <th class="text-center">4</th>
                    <th class="text-center">5</th>
                    <th class="text-center">-</th>
                    <th class="text-center">1st Tri</th>
                    <th class="text-center">2nd Tri</th>
                    <th class="text-center">3rd Tri</th>
                    <th class="text-center">4th Tri</th>
                    <th class="text-center">2nd Tri</th>
                    <th class="text-center">3rd Tri</th>
                    <th class="text-center">4th Tri</th>
                    <th class="text-center">1st Tri</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lists as $index=>$list)
                    {{-- <tr style="text-align: center; font-size: 10px; color: #072388;">
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
                    </tr> --}}
                @endforeach
            </tbody>
        </table>

      
        @endforeach
    </div>
</body>
</html>