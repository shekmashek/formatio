<!-- CSS only -->
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
<script>
function evaluation_chaud(){
    document.getElementById('btn_chaud').style.backgroundColor = "white";
    document.getElementById('btn_chaud').style.border = "1px solid grey";
    document.getElementById('btn_froid').style.border = "none";
    document.getElementById('btn_formateur').style.border = "none";
    document.getElementById('btn_froid').style.backgroundColor = "rgb(241, 241, 242)";
    document.getElementById('btn_formateur').style.backgroundColor = "rgb(241, 241, 242)";
    document.getElementById('evaluation_chaud').style.display = "block";
    document.getElementById('evaluation_froid').style.display = "none";
    document.getElementById('evaluation_formateurs').style.display = "none";
}
function evaluation_froid(){
    document.getElementById('btn_chaud').style.backgroundColor = "rgb(241, 241, 242)";
    document.getElementById('btn_froid').style.backgroundColor = "white";
    document.getElementById('btn_chaud').style.border = "none";
    document.getElementById('btn_froid').style.border = "1px solid grey";
    document.getElementById('btn_formateur').style.border = "none";
    document.getElementById('btn_formateur').style.backgroundColor = "rgb(241, 241, 242)";
    document.getElementById('evaluation_froid').style.display = "block";
    document.getElementById('evaluation_chaud').style.display = "none";
    document.getElementById('evaluation_formateurs').style.display = "none";
}
// function evaluation_formateur(){
//     document.getElementById('btn_chaud').style.backgroundColor = "rgb(241, 241, 242)";
//     document.getElementById('btn_chaud').style.border = "none";
//     document.getElementById('btn_froid').style.border = "none";
//     document.getElementById('btn_formateur').style.border = "1px solid grey";
//     document.getElementById('btn_froid').style.backgroundColor = "rgb(241, 241, 242)";
//     document.getElementById('btn_formateur').style.backgroundColor = "white";
//     document.getElementById('evaluation_chaud').style.display = "none";
//     document.getElementById('evaluation_froid').style.display = "none";
//     document.getElementById('evaluation_formateurs').style.display = "block";
// }
</script>


<style>
.btn_evaluation{
    width: 100%;
    background-color: rgb(241, 241, 242);
    margin: 0 2px;
}
.btn:focus{
    outline: none;
    box-shadow: none;
}
</style>

<nav class="d-flex justify-content-around">
    <button id="btn_chaud" class="btn btn_evaluation" style="background-color: #fff; border: 1px solid grey" onclick="evaluation_chaud()">Evaluation a chaud</button>
    <button id="btn_froid" class="btn btn_evaluation" onclick="evaluation_froid()">Evaluation a froid</button>
    {{-- <button id="btn_formateur" class="btn btn_evaluation" onclick="evaluation_formateur()">Evaluation des formateurs</button> --}}
</nav>
<div id="evaluation_chaud" style="display: block">
    {{-- @include('admin.evaluation.evaluationChaud.evaluationChaud') --}}
    {{-- evaluation_chaud --}}
</div>
<div id="evaluation_froid" style="display: none">
    {{-- Evaluation a froid --}}
    {{-- @include('admin.evaluation.evaluationChaud.evaluationChaud') --}}
</div>
{{-- <div id="evaluation_formateurs" style="display: none">
    Evaluation des formateurs
</div> --}}


