<!DOCTYPE html>
<html>
<head>
	<title>e-Raport Unira</title>
    <link rel="icon" href="{{ asset('img/unira.png') }}" type="image/icon type">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
</head>
<body>
	{{-- <style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style> --}}
	<center>
		<h4>e-Raport Unira</h4>
        <br>
		<h6>NIM : {{$id}}</h6>
        {{-- <br> --}}
		{{-- <h6>DDDDD</h6> --}}
            {{-- <h6><a target="_blank" href="https://www.malasngoding.com/membuat-laporan-…n-dompdf-laravel/">www.malasngoding.com</a></h5> --}}
	</center>
    
    <br>
    

	<table class='table table-bordered'>
		<thead>
            <tr>
                <th>No</th>
                <th>Matakuliah</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; ?>
            @foreach ($matkul as $item)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$item["nama"]}}</td>
                    <td>
                        <?php 
                            $total_tugas = 0;    
                        ?>
                        @foreach ($tugas as $t)
                            <?php 
                                $rata2 = 0;
                            ?>
                            @if ($t->id_kelas == $item["id_kelas"])
                                @foreach ($nilai as $n)
                                    @if ($n->id_tugas == $t->id)
                                        <?php $rata2 = $rata2 + $n->nilai ?>
                                    @endif
                                @endforeach
                                <?php 
                                    $total_tugas = $total_tugas + 1; 
                                ?>
                            @endif

                        @endforeach
                        @if ($total_tugas != 0)
                            <?php 
                                $nilai_akhir = $rata2/$total_tugas;
                            ?>
                            {{round($nilai_akhir, 3)}}
                        @else
                            0     
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
	</table>
 
</body>
</html>