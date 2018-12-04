<div class="row pb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row w-100 align-items-center">
                    <div class="col-auto">
                        @if($firedSection->isCreatable())
                            <a @click.prevent="$emit('redirectTo',$event)" href="{{ Request::url() }}/create" class="btn btn-primary">Создать</a>
                        @endif
                    </div>
                    <div class="col">
                        {!! $nav !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="table-responsive display-table br-display" data-delete-redirect="{{ $pluginData['redirectUrl'] ?? null }}" data-section-path="{{ $pluginData['sectionPath'] ?? null }}">
    <table class="table">
        <thead>
        <tr>
            @foreach($columns as $column)
                <th scope="col">
                    <div class="d-inline-block">
                        {{ $column->getLabel() }}
                    </div>
                    @if($column->getSortable())
                        <div class="text-right d-inline-block float-right">
                            <a href="?sortBy={{ $column->getName() }}" class="@if(app('request')->input('sortBy') == $column->getName()) text-success @else text-muted @endif"><i class="fas fa-chevron-up"></i></a>
                            <a href="?sortByDesc={{ $column->getName() }}" class="@if(app('request')->input('sortByDesc') == $column->getName()) text-success @else text-muted @endif"><i class="fas fa-chevron-down"></i></a>
                        </div>
                    @endif
                </th>
            @endforeach
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($fields as $field)
            <tr>
                @foreach($columns as $column)
                    <td scope="col">
                        @if($field[$column->getName()] instanceof Countable)
                            @php
                                $path = explode('.', $column->getName());
                                $name = end($path);
                            @endphp
                            @foreach($field[$column->getName()] as $value)
                                <span class="badge badge-info text-white">{!! $value->{$name} !!}</span>
                            @endforeach
                        @else
                            @switch(basename(get_class($column)))
                                @case('Text')
                                    {!! $field[$column->getName()] !!}
                                    @break
                                @case('Link')
                                    <a href="{{ parse_url(Request::url(), PHP_URL_PATH) . '/' . $field['brRowId'] . '/edit' }}">{!! $field[$column->getName()] !!}</a>
                                    @break
                                @default
                                    {!! $field[$column->getName()] !!}
                                    @break
                            @endswitch
                        @endif
                    </td>
                @endforeach
                <td class="text-right">
                    @if($firedSection->isEditable())
                        <a @click.prevent="$emit('redirectTo',$event)" href="{{ parse_url(Request::url(), PHP_URL_PATH) . '/' . $field['brRowId'] . '/edit' }}" class="text-success">Ред.</a>
                    @endif
                    @if($firedSection->isDeletable())
                        <button @click="$emit('showDeleteModal',$event)" type="button" class="delete-btn text-danger bg-transparent border-0" data-delete-link="{{ Request::url() . '/' . $field['brRowId'] . '/delete' }}">Удал.</button>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
