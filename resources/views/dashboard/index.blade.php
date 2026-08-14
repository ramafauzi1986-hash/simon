@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><div><h2 class="fw-bold mb-1">Dashboard Kinerja</h2><p class="text-muted mb-0">Monitoring kinerja Sekretariat DPRD</p></div></div>
<div class="row g-3">
@foreach([['PROGRAM',$program],['KEGIATAN',$kegiatan],['SUB KEGIATAN',$subKegiatan],['INDIKATOR',$indikator]] as $card)<div class="col-6 col-lg-3"><div class="card shadow-sm border-0 h-100"><div class="card-body"><div class="text-muted small">{{$card[0]}}</div><div class="fs-2 fw-bold">{{$card[1]}}</div></div></div></div>@endforeach
<div class="col-md-4"><div class="card shadow-sm border-0"><div class="card-body"><div class="text-muted small">TARGET</div><div class="fs-3 fw-bold">{{number_format($target,2)}}</div></div></div></div>
<div class="col-md-4"><div class="card shadow-sm border-0"><div class="card-body"><div class="text-muted small">REALISASI</div><div class="fs-3 fw-bold">{{number_format($realisasi,2)}}</div></div></div></div>
<div class="col-md-4"><div class="card shadow-sm border-0"><div class="card-body"><div class="text-muted small">CAPAIAN</div><div class="fs-3 fw-bold">{{$capaian}}%</div></div></div></div>
</div>
<div class="row g-4 mt-1"><div class="col-lg-8"><div class="card shadow-sm border-0"><div class="card-body"><h5 class="fw-bold">Target vs Realisasi per Triwulan</h5><canvas id="twChart" height="110"></canvas></div></div></div><div class="col-lg-4"><div class="card shadow-sm border-0"><div class="card-body"><h5 class="fw-bold">Ringkasan Capaian</h5><div class="progress" style="height:28px"><div class="progress-bar" style="width:{{min($capaian,100)}}%">{{$capaian}}%</div></div><p class="mt-3 text-muted">Persentase dihitung dari total realisasi dibanding total target indikator.</p></div></div></div></div>
<script>
new Chart(document.getElementById('twChart'),{type:'bar',data:{labels:['TW I','TW II','TW III','TW IV'],datasets:[{label:'Target',data:[@foreach($tw as $x){{$x['target']}},@endforeach]},{label:'Realisasi',data:[@foreach($tw as $x){{$x['realisasi']}},@endforeach]}]},options:{responsive:true,scales:{y:{beginAtZero:true}}}});
</script>
@endsection
