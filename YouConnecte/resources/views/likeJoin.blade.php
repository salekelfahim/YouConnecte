@if ($publication->like->contains('user_id',session('user_id') ))
                    

                    <div class="like-icon" onclick="deletLike('{{ $publication->id }}')" id="{{ $publication->id }}">
                        <i class="bi bi-heart">like</i>
                        <i>{{$publication->like->count()}}</i>
                    </div>
                    
                    @else
                    <div class="like-icon" onclick="addLike('{{ $publication->id }}')" id="{{ $publication->id }}">
                        <i class="bi bi-heart">like not</i>
                        <i>{{$publication->like->count()}}</i>
                    </div>
                    @endif
