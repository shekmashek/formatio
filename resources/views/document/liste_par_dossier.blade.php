@extends('./layouts/admin')
@section('title')
    <h3 class="text-white ms-5">Liste des documents </h3>
@endsection
<style>
    .liste{
        padding-top: 10px;
    }
    .vertical-line{
      border-left: 2px solid #000;
      display: inline-block;
      height: 300px;
      margin: 0 20px;
    }
    .sous_dossier{
        padding : 10px;
        border-radius: 5px;
    }
    .liste_fichier{
        border: 2px solid;
        padding : 10px;
        border-radius: 5px;
    }
</style>
@section('content')
<div class="container" style="padding-top: 50px">
    <div class="row">
        <div class="col-md-4">
            @if (\Session::has('error'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{!! \Session::get('error') !!}</li>
                    </ul>
                </div>
            @endif
            <strong>Gestion de vos documents</strong>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-6">
            <form action="{{route('importation_fichier')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" value="{{$id}}" name="sous_dossier" hidden>
                <input type="file"  name="documents">
                <button type="submit"><span class="border border-dark sous_dossier" style = "background-color: #801D68;color:white"><i class="fa fa-upload"></i>&nbsp; Importer </span> </button>
            </form>
        </div><br><br><br>
        <hr>
    </div>
    <div class="row liste">
        <div class="col-md-2">
            {{-- <i class="fa fa-caret-down " onclick="afficherSousDossier();" style="display: none" id="bas"></i>--}}
            <i class="fa fa-caret-right " id="droite" onclick="afficherSousDossier();" ></i>&nbsp;&nbsp;<i class="fa fa-folder"></i>&nbsp;&nbsp;<a href="{{route('gestion_documentaire')}}">  {{$get_nom_cfp}} </a>
            <div class="row" id="sub_directory">
                @for($i = 0; $i < $nb_sub_folder; $i++)
                <div class="col-12">
                     @if ( Request::segment(2)  == $id && $id == $get_sub_folder[$i]['name'])
                        <span style="padding-left: 28px;color : #801D68 "><i class="fa fa-folder"></i>&nbsp; <a href="{{route('liste_fichier',$get_sub_folder[$i]['name'])}}"> {{$get_sub_folder[$i]['name']}} </a> </span> &nbsp;&nbsp
                    @else
                        <span style="padding-left: 28px" ><i class="fa fa-folder"></i>&nbsp; <a href="{{route('liste_fichier',$get_sub_folder[$i]['name'])}}"> {{$get_sub_folder[$i]['name']}} </a> </span> &nbsp;&nbsp

                    @endif
                </div>
                @endfor
            </div>
        </div>
        <div class="col-md-1"><span class="vertical-line"></span></div>
        <div class="col-md-9">
            <div class="container">
                <div class="row">
                    @for($i = 0; $i < $nb_res; $i++)
                    <div class="col-6 justify-content-around">
                         <div class = "liste_fichier">

                            <span><i class="fa fa-file-download"></i>&nbsp; <a href="{{route('download_file',['id'=>$id,'filename'=>$res[$i]['filename'],'extension'=>$res[$i]['extension']])}}"> {{$res[$i]['filename'].'.'.$res[$i]['extension']}} </a> </span> &nbsp;&nbsp;
                            <br>
                        </div><br>
                    </div><br>
                    @endfor
                </div>
            </div>
            {{-- @for($i = 0; $i < $nb_res; $i++)

                    <div class = "liste_fichier col-md-6">
                        @if($res[$i]['extension'] == "txt")
                            <span>Fichier texte</span>
                        @endif
                        @if($res[$i]['extension'] == "html")
                            <span>Fichier html</span>
                        @endif
                        @if($res[$i]['extension'] == "pdf")
                            <span>Fichier pdf</span>
                        @endif
                        <span><i class="fa fa-file-download"></i>&nbsp; <a href="#"> {{$res[$i]['filename'].'.'.$res[$i]['extension']}} </a> </span> &nbsp;&nbsp;
                        <br>
                    </div>

            @endfor --}}
        </div>
    </div>
</div>
<script>
    function afficherSousDossier(){
        let sub_dir = document.getElementById('sub_directory');
        if(getComputedStyle(sub_dir).display != "none"){
            sub_dir.style.display = "none";
            droite.className = "fa fa-caret-right";
        }

        else{
            sub_dir.style.display = "block";
            droite.className = "fa fa-caret-down";
        }
    }
</script>
@endsection