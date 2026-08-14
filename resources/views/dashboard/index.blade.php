@extends('layouts.app')
@section('content')
<div class="row g-4"><div class="col-md-4"><div class="card shadow-sm border-0"><div class="card-body"><h6>PROGRAM</h6><h2>{{ $program }}</h2></div></div></div><div class="col-md-4"><div class="card shadow-sm border-0"><div class="card-body"><h6>INDIKATOR</h6><h2>{{ $indikator }}</h2></div></div></div><div class="col-md-4"><div class="card shadow-sm border-0"><div class="card-body"><h6>TOTAL REALISASI</h6><h2>{{ number_format($realisasi,2) }}</h2></div></div></div></div>
<div class="card shadow-sm mt-4"><div class="card-body"><h5>Dashboard Realisasi Kinerja</h5><canvas id="chart"></canvas></div></div>
<script>new Chart(document.getElementById('chart'),{type:'bar',data:{labels:['Target','Realisasi'],datasets:[{label:'Kinerja',data:[100,{{ $realisasi }}]}]},options:{responsive:true}});</script>
@endsection
