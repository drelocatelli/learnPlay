<hr>
    <center>
      <h4>
        {{( $grade->count() > 1) ? $grade->count(). ' módulos' : $grade->count().' módulo'}}.
      </h4>
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
                            <a href="#" style="witdh:max-content;">
                                <li class="list-group-item">
                                    <b id="class_count" class="model_number chapter_number">0</b>
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

                for(i = 0; i < class_count.length; i++){
                    class_count[i].innerText = (i+1)
                }
            </script>
@else
<center><b>Nenhum módulo foi criado.</b></center>
@endif
