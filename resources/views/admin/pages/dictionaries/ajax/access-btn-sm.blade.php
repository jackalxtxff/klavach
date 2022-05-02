@if($dictionary->report->status_code == 'new')
    <button type="button" data-type="accept" data-id="{{$dictionary['id']}}" data-uri="{{route('admin.reports.update', $dictionary->report->id)}}" data-method="PUT" class="btn btn-sm btn-success access-btn">Принять</button>
    <button type="button" data-type="deny" data-bs-target="#report-modal" data-bs-toggle="modal" data-id="{{$dictionary['id']}}" data-uri="{{route('admin.reports.update', $dictionary->report->id)}}" data-repuri="{{route('admin.reports.getReport', $dictionary->report->id)}}" data-method="PUT" class="btn btn-sm btn-danger access-btn">Отказ</button>
@elseif($dictionary->report->status_code == 'wait')
    <button type="button" data-type="accept" data-id="{{$dictionary['id']}}" data-uri="{{route('admin.reports.update', $dictionary->report->id)}}" data-method="PUT" class="btn btn-sm btn-success access-btn">Принять</button>
    <button type="button" data-type="deny" data-bs-target="#report-modal" data-bs-toggle="modal" data-id="{{$dictionary['id']}}" data-uri="{{route('admin.reports.update', $dictionary->report->id)}}" data-repuri="{{route('admin.reports.getReport', $dictionary->report->id)}}" data-method="PUT" class="btn btn-sm btn-danger access-btn">Отказ</button>
@elseif($dictionary->report->status_code == 'accept')
    <button type="button" class="btn btn-sm btn-success" disabled>Принят</button>
    <a class="link-dark link-sm access-btn" data-type="wait" data-id="{{$dictionary['id']}}" data-uri="{{route('admin.reports.update', $dictionary->report->id)}}" data-method="PUT"><i style="font-size: 12px" class="fa-solid fa-right-left"></i> Изменить решение</a>
@elseif($dictionary->report->status_code == 'deny')
    <button type="button" class="btn btn-sm btn-danger" disabled>Отказ</button>
    <a class="link-dark link-sm access-btn" data-type="wait" data-id="{{$dictionary['id']}}" data-uri="{{route('admin.reports.update', $dictionary->report->id)}}" data-method="PUT"><i style="font-size: 12px" class="fa-solid fa-right-left"></i> Изменить решение</a>
@endif
