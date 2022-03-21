@extends('./layouts/admin')
@section('content')



    <div class=" container-fluid">
        <div><p class="p-0" style="font-size: 25px; text-align:left; ">Contactez-nous</p></div>
        <hr>
        <div class="row">

            <div class="col-lg-4">
                <p class=" ms-5 mt-4" style="font-size: 20px;">Adresse</p>

                
                     <i class="bx bx-map text mt-3" >
                        II N 60 A Analamahitsy 101 Antananarivo Madagascar.
                    </i>
                    <i class="bx bx-envelope text mt-3" >
                        <p style="color: gray;font-size:20px"> contact@numerika.center</p>
                </i>

               <p style="color: gray"> <i class="bx bx-phone text mt-3" >
                (261) 033 23 135 63
               </i></p>
            </div>
            <div class="col-lg-8">
                <p class=" ms-5 mt-4" style="font-size: 20px;">Pour nous contacter Veuillez remplir les formulaires ci-dessous</p>
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
                <div class="row">
                    <div class="col-lg-6">
                <form method="POST" action="{{route('contacter')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Votre nom" name="name" autocomplete="off">
                        @error('name')
                        <div class="col-sm-6">
                            <span style="color:#ff0000;"> {{$message}} </span>
                        </div>
                        @enderror
                    </div><br>
                     <div class="form-group">
                        <input type="text" class="form-control" placeholder="Entreprise" name="entreprise" autocomplete="off">
                        @error('entreprise')
                        <div class="col-sm-6">
                            <span style="color:#ff0000;"> {{$message}} </span>
                        </div>
                        @enderror
                    </div><br>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" name="mail" autocomplete="off">
                        @error('mail')
                        <div class="col-sm-6">
                            <span style="color:#ff0000;"> {{$message}} </span>
                        </div>
                        @enderror
                    </div><br>
                      <div class="form-group">
                         <input type="text" class="form-control" placeholder="Objet" name="objet" autocomplete="off">
                         @error('objet')
                         <div class="col-sm-6">
                             <span style="color:#ff0000;"> {{$message}} </span>
                         </div>
                         @enderror
                        </div><br>
                    </div>
                </div>
<br>
                 <div class="form-group">
                    <textarea type="text" class="form-control" placeholder="Votre message" style="height: 75px" name="msg"></textarea>
                    @error('msg')
                    <div class="col-sm-6">
                        <span style="color:#ff0000;"> {{$message}} </span>
                    </div>
                    @enderror
                </div>

                 <p>Captcha</p>
                 0 + <input type="text" name="input" autocomplete="off" style="width: 25px;height:25px" required> = 7 <br>

                    <button class="mt-4 btn " type="submit" style="background-color: #801D68;color:white">Envoyer</button>

            </div>
            </div>
        </form>
        </div>


@endsection