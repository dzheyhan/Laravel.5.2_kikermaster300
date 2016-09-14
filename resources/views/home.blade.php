@extends('layouts.app')

@section('content')
   <div class="container">
   @if (count($errors) > 0)
       <div class="alert alert-danger">
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
   @endif
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">New Score 1vs1</div>
                <div class="panel-body hidden_panel_body hidden">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/score/create') }}">
                    <input type="hidden"  name="stat" value="1vs1" >
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label">Player 1</label>
                            <div class="col-md-6">
                                 {{ Form::select('player_1', $User, array(),array('class'=>'form-control player_list','required' => 'required') ) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Score</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="score_P1" required >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Player 2</label>
                            <div class="col-md-6">
                                 {{ Form::select('player_2', $User, array(),array('class'=>'form-control player_list','required' => 'required') ) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Score</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="score_P2" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Add
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">New Score 2vs2</div>
                        <div class="panel-body hidden_panel_body hidden">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/score/create') }}">
                            <input type="hidden"  name="stat" value="2vs2" >
                                {!! csrf_field() !!}
                                <fieldset>
                                    <legend>Team 1</legend>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Player 1</label>
                                        <div class="col-md-6">
                                             {{ Form::select('player_1', $User, array(),array('class'=>'form-control player_list','required' => 'required') ) }}
                                        </div>
                                    </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Player 2</label>
                                    <div class="col-md-6">
                                         {{ Form::select('player_2', $User, array(),array('class'=>'form-control player_list','required' => 'required') ) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Score</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="score_T1" required>
                                    </div>
                                </div>
                                </fieldset>

                                <fieldset>
                                    <legend>Team 2</legend>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Player 1</label>
                                        <div class="col-md-6">
                                             {{ Form::select('player_3', $User, array(),array('class'=>'form-control player_list', 'required' => 'required') ) }}
                                        </div>
                                    </div>


                                <div class="form-group">
                                    <label class="col-md-4 control-label">Player 2</label>
                                    <div class="col-md-6">
                                         {{ Form::select('player_4', $User, array(),array('class'=>'form-control player_list','required' => 'required') ) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Score</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="score_T2" required>
                                    </div>
                                </div>

                                </fieldset>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-user"></i>Add
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
        </div>
    </div>

      <row>
            <div class="panel panel-default">
                 <div class="panel-heading">
                    {!! isset($user_name) ? "<h3><strong><i>Score".' '.ucfirst($user_name)."</i></strong></h3>" : 'Score' !!}
                 </div>
                 <div class="panel-body">
            <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Stat</th>
                    <th>Players</th>
                    <th>Score</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i = 0;?>
                @foreach($Games as $Game)
                    <?php $i++;?>
                 <tr>
                    <td>{{ $i }}</td>
                    <td>{{$Game->stat}}</td>
                    <td>
                        @foreach($Game->games_users()->get() as $key =>$players )
                            <a href="/user/{{ $players->User->id }}/show">{{ucfirst($players->User->name)}}</a>
                            @if($Game->stat=='1vs1' && $key==0 || $Game->stat=='2vs2' && $key==1 )
                                {!! "<b>VS</b>" !!}
                            @else
                                @if($key==0 || $key==2)
                                    {{','}}
                                @endif

                            @endif
                        @endforeach
                    </td>
                    <td>
                         @foreach($Game->games_users()->get() as $key =>$players )
                           @if($key==1){{ ':' }}@endif
                              @if($Game->stat=='1vs1' || $Game->stat=='2vs2' && $key==0 || $key==3 )
                                  {{ $players->score }}
                           @endif
                         @endforeach
                    </td>
                    <td>{{$Game->created_at->diffForHumans()}} </td>
                 </tr>
                @endforeach
                </tbody>
              </table>
              {!! $Games->links() !!}
                </div>
            </div>
       </row>


</div>

@endsection
