<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h3 style="text-align: center;">Laporan diagnosa Penyakit Kesehatan Mental</h3>
  <h5 style="text-align: center;">Puskesmas Sekargadung</h5>
  <p style="text-align: center;">Jl. Sekarsono No. 1 RT.2 RW.5 Kel. Sekargadung Kec. Purworejo</p>
  <hr>
  <table  width='100%' style="border-collapse: collapse;" border="1">
    <thead>
      <tr>
        <th style="padding:5px;">No</th>
        <th style="padding:5px;">Nama Pasien</th>
        <th style="padding:5px;">Diagnosa</th>
        <th style="padding:5px;">Perawat yang melayani</th>
        <th style="padding:5px;">Tanggal Diagnosa</th>
        <th style="padding:5px;">Hasil diagnosa</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($kasus as $item)
      <tr>
        <td style="padding:5px;" align="right">{{ $loop->iteration }}</td>
        <td style="padding:5px;">{{ $item->pasien->nama }}</td>
        <td style="padding:5px;">
          @if (is_null($item->penyakit_id))
          <i>"Dijadwalkan bertemu dengan Dokter"</i>
          @else
          {{ $item->penyakit->nama }}
          @endif
        </td>
        <td style="padding:5px;">{{ $item->user->nama }}</td>
        <td style="padding:5px;" align="right">{{ $item->created_at->translatedFormat("d M Y")   }}</td>
        <td style="padding:5px;" align="right">{{ number_format($item->bobot, 2) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <br><br>
  <table width="100%">
    <tr>
      <td width="33%">
      </td>
      <td width="33%">
      </td>
      <td width="33%">
        <div class="text-right">
          {{ $date->translatedFormat('l') }}, {{ $date->translatedFormat('d F Y') }}
        </div>
        <br><br><br><br><hr>
      </td>
    </tr>
  </table>
</body>
<script>
  window.onload = window.print;
</script>
</html>