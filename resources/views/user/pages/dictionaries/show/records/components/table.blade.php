<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Имя</th>
        <th scope="col">Рекорд</th>
        <th scope="col">Среднее</th>
        <th scope="col">Ошибки</th>
    </tr>
    </thead>
    <tbody>
    @foreach($records as $record)
        <tr class="lh-lg">
            <th scope="row">{{($records->currentpage()-1) * $records->perpage() + $loop->index+1}}</th>
            <td>
                <div class="profile-img rounded align-middle" style="width: 20px; height: 20px; {{$record->user->profile->photo == null ? null : 'background-color: transparent'}}">
                    @if($record->user->profile->photo == null)
                        <i class="fas fa-user m-auto" style="font-size: 14px"></i>
                    @else
                        <img class="rounded" src="{{ $record->user->profile->photo }}" alt="">
                    @endif
                </div>
                <a class="link-underline" href="{{route('profile.index', $record->user->name)}}">{{$record['user']['name']}}</a>
            </td>
            <td class="table-active">{{round($record->max_speed)}} зн/мин</td>
            <td>{{round($record->avg_speed)}} зн/мин</td>
            <td>{{round($record->avg_mistakes, 2)}}%</td>
        </tr>
    @endforeach
    </tbody>
</table>

{!! $records->links() !!}
