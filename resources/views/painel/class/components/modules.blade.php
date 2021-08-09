<hr>
    <center>
      <h4>
        {{( $grade->count() > 1) ? $grade->count(). ' módulos' : $grade->count().' módulo'}}<count-chapters></count-chapters>.
      </h4>

      <panel></panel>
    </center>
    <br>
    @if($grade->count() > 0)
            @foreach($grade as $model)
            <div class="accordion accordion-flush" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$loop->iteration}}" aria-expanded="true" aria-controls="collapseOne">
                            <b class="model_number">( {{$loop->iteration}} )</b>&nbsp;{{$model->title}}
                    </button>
                </h2>
                <div id="collapse_{{$loop->iteration}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="card card-chapter">
                    <ul class="list-group list-group-flush">

                        @for($i = 0; $i < $model->chapters->count(); $i++)
                            @php
                                $content_type = '';
                                $link = '';
                                switch($model->chapters[$i]->content_type){
                                    case 'video';
                                        $content_type = 'video';
                                    break;
                                    case 'text':
                                        $content_type = 'info';
                                    break;
                                    case 'link':
                                        $content_type = 'link';
                                        $link = $model->chapters[$i]->content;
                                    break;
                                }
                            @endphp
                            @if($link != '')
                                <a href="{{$link}}" target="_blank" style="witdh:max-content;">
                                @else
                                <a href="javascript:void(0);" style="witdh:max-content;" onclick="giveContent('{{$model->chapters[$i]->content_type}}', `{{$model->chapters[$i]->content}}`)">
                            @endif
                                <li class="list-group-item" title="Capítulo {{$i+1}} do Módulo {{$loop->iteration}}">
                                    <b id="class_count" class="model_number chapter_number">{{$loop->iteration}} . {{$i+1}}</b>

                                    <i class="fas fa-{{($content_type)}}"></i>&nbsp;&nbsp;
                                    {{ucfirst($model->chapters[$i]->title)}}
                                </li>
                            </a>
                        @endfor
                    </ul>
                </div>
                </div>
            </div>

            </div>

            @endforeach

            </div>



            <style>
                .model_number {
                    background: #668477;
                    padding: 4px 7px;
                    box-sizing: border-box;
                    margin-right: 15px;
                    border-radius: 75px;
                    border: 1px solid transparent;
                }

                .chapter_number{
                    background:#e4e4e4;
                }
            </style>

            <script>
                let class_count = document.querySelectorAll('b#class_count')
                let count_aulas = document.querySelector('count-chapters')

                count_aulas.innerText = `, ${class_count.length} aulas no total`

                function giveContent(type, content){
                    // types: text, link, video

                    let panel = document.querySelector('panel')
                    switch(type){
                        case 'text':
                            panel.innerHTML = `<div class="content-class">${content}</div>`;
                            document.querySelector('panel').scrollIntoView({ behavior: 'smooth', block: 'top' })
                        break;
                        case 'video':
                            panel.innerHTML = `<div class="content-class" style="background:#000; padding:0;"><video id="aula" src="${content}" controls autoplay width="100%"></video></div>`
                            document.querySelector('panel').scrollIntoView({ behavior: 'smooth', block: 'center' })
                        break;
                        default:
                            panel.innerHTML = ''
                        break;
                    }
                }

            </script>
@else
<center><b>Nenhum módulo foi criado.</b></center>
@endif
