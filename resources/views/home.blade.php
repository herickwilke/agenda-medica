@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="{{ $settings1['column_class'] }}">
                    <div class="info-box">
                        <span class="info-box-icon bg-red" style="display:flex; flex-direction: column; justify-content: center;">
                            <i class="fa fa-chart-line"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{ $settings1['chart_title'] }}</span>
                            <span class="info-box-number">{{ number_format($settings1['total_number']) }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="{{ $settings2['column_class'] }}">
                    <div class="info-box">
                        <span class="info-box-icon bg-red" style="display:flex; flex-direction: column; justify-content: center;">
                            <i class="fa fa-chart-line"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{ $settings2['chart_title'] }}</span>
                            <span class="info-box-number">{{ number_format($settings2['total_number']) }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="{{ $settings3['column_class'] }}">
                    <div class="info-box">
                        <span class="info-box-icon bg-red" style="display:flex; flex-direction: column; justify-content: center;">
                            <i class="fa fa-chart-line"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{ $settings3['chart_title'] }}</span>
                            <span class="info-box-number">{{ number_format($settings3['total_number']) }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="{{ $settings4['column_class'] }}">
                    <div class="info-box">
                        <span class="info-box-icon bg-red" style="display:flex; flex-direction: column; justify-content: center;">
                            <i class="fa fa-chart-line"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{ $settings4['chart_title'] }}</span>
                            <span class="info-box-number">{{ number_format($settings4['total_number']) }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <input type="hidden" name="event_id" id="event_id" value="" />
            <input type="hidden" name="atendimento_id" id="atendimento_id" value="" />
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Atendimento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
            <div class="modal-body">
                <div class="form-group">
                    <label >Paciente</label>
                    <input type="text" class="form-control" name="nome" id="nome" disabled="disabled" placeholder="Paciente">
                </div>
                <div class="form-group">
                    <label >Data</label>
                    <input type="text" id="date" name="date" class="form-control date" value="{{ old('data', isset($atendimento) ? $atendimento->data : '') }}" required>
                </div>
                <div class="form-group">
                    <label>Procedimento</label>
                    <input type="text" class="form-control" name="procedimento" id="procedimento" placeholder="Procedimento">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Hora</label>
                        <input type="text" id="time" name="time" class="form-control timepicker" value="{{ old('hora', isset($atendimento) ? $atendimento->hora : '') }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Duração</label>
                        <input type="text" class="form-control" name="duracao" id="duracao" placeholder="Duração">
                    </div>
                </div>
                <div class="form-group">
                    <label>Observação</label>
                    <input type="text" class="form-control" name="observacao" id="observacao" placeholder="Observação">
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <input type="button" class="btn btn-primary" id="atendimento_update" value="Salvar">
                </div>
            </form>
        </div>
    </div>
</div>

<h3 class="page-title">{{ trans('global.systemCalendar') }}</h3>
<div class="card">
    <div class="card-header">
        {{ trans('global.systemCalendar') }}
    </div>

    <div class="card-body">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

        <div id='calendar'></div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/locale/pt-br.js'></script>
<script>
    $(document).ready(function () {
            // page is now ready, initialize the calendar...
            events={!! json_encode($events) !!};
            
            $('#calendar').fullCalendar({
               
                events: events,

                theme: false,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    console.log('criar o eventSelect');
                },
                editable: true,
                droppable: true,
                events: events,
                eventDrop: function(drag, event, dayDelta, minuteDelta, allDay, revertFunc) {
                    console.log('criar evento eventDrop');
                    // if (!confirm("Você tem certeza sobre essa mudança?")) {
                    //     revertFunc();
                    // }
                    // saveEvent(drag, event);
                },
                eventClick: function(calEvent, jsEvent, view) {
                    $('#event_id').val(calEvent._id);
                    $('#atendimento_id').val(calEvent.id);
                    $('#nome').val(calEvent.nome);
                    $('#date').val(moment(calEvent.start).format('DD-MM-YYYY'));
                    $('#time').val(calEvent.hora);
                    $('#procedimento').val(calEvent.procedimento);
                    $('#duracao').val(calEvent.duracao);
                    $('#editModal').modal();
                }
            });

            function saveEvent(drag, event){
                console.log(event);
                $.ajax({
                    url: 'uashuahsusah',
                    type: 'post',
                    data: {event: event, atendimento_id: drag.id},
                    dataType: 'json',
                    success: function(response){
                        console.log('response');
                    }
                });
            }

            $('#atendimento_update').click(function(e) {
                e.preventDefault();
                var data = {
                    _token: '{{ csrf_token() }}',
                    atendimento_id: $('#atendimento_id').val(),
                    procedimento: $('#procedimento').val(),
                    data: $('#date').val(),
                    hora: $('#time').val(),
                };

                $.post('{{ route('admin.atendimentos.ajax_update') }}', data, function( result ) {

                    $('#editModal').modal('hide');

                    location.reload();
                });
            });
        });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@endsection