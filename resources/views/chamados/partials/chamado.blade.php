<ul style="list-style-type: none;">

        <li><b>id: </b>#{{ $chamado->id }}
        </li>

        <li>
            <b>Ver chamado</b> <a href="/chamados/{{$chamado->id}}"> <i class="fas fa-eye"></i> </a>
        </li>

        <li>
            @can('view',$chamado)
            <b>Editar chamado</b> <a href="/chamados/{{$chamado->id}}/edit"> <i class="fas fa-edit"></i> </a>
            @endcan
        </li>
        @if($chamado->status == 'Triagem')
            <li>
            @can('admin')
            <b>Fazer triagem</b> <a href="/chamados/{{$chamado->id}}/edit"> <i class="fas fa-plus"></i> </a>
            @endcan
            </li>
        @endif


        <li><b>total de comentários</b>: {{ $chamado->comentarios->count() }}</li>

        @if(config('chamados.usar_replicado') == 'true')
        <li><b>por: 
            </b>{{ \Uspdev\Replicado\Pessoa::dump($chamado->user->codpes)['nompes'] }}</li>
        @endif

        <li><b>aberto em: </b>{{ Carbon\Carbon::parse($chamado->created_at)->format('d/m/Y H:i') }}</li>
        @if(!is_null($chamado->fechado_em))
            <li><b>fechado em</b>: {{ Carbon\Carbon::parse($chamado->fechado_em)->format('d/m/Y H:i') }}</li>
        @endif

        <li><b>status: </b> <span style="color:red;"> {{ $chamado->status }} </span> </li>
        @if($chamado->status == 'Atribuído')
            @if(config('chamados.usar_replicado') == 'true')
                <li><b>triagem por</b>: {{ \Uspdev\Replicado\Pessoa::dump($chamado->triagem_por)['nompes'] }}</li>
                <li><b>atribuído para</b>: {{ \Uspdev\Replicado\Pessoa::dump($chamado->atribuido_para)['nompes'] }}</li>
            @endif
            <li><b>complexidade</b>: {{ $chamado->complexidade }}</li>
        @endif
        <li><b>prédio</b>: {{ $chamado->predio }}</li>
        <li><b>sala</b>: {{ $chamado->sala }}</li>
        
        <li><b>Categoria: </b>{{ $chamado->categoria->nome }}</li>

        @if (!empty($chamado->patrimonio))
        <b>patrimônio(s)</b>:
        <ul class="list-group">
              @foreach(explode(',', $chamado->patrimonio) as $patrimonio) 
                <li class="list-group-item">
                    {{trim($patrimonio)}}
                    @if(config('chamados.usar_replicado') == 'true')
                    {{ \Uspdev\Replicado\Bempatrimoniado::dump(trim($patrimonio))['epfmarpat'] }}
                    {{ \Uspdev\Replicado\Bempatrimoniado::dump(trim($patrimonio))['modpat'] }}
                    @endif
                </li>
              @endforeach        
        </ul>
        @endif
</ul>
