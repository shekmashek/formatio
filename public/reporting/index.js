function plusieurs(){
  document.getElementById('toute_personne').style.display = "block";
  document.getElementById('seul_personne').style.display = "none";
  var classe = document.getElementById('btn_plusieurs').classList;
  if(classe == "titre_nombre_personne"){
    classe.add('titre_nombre_personne_active');
    classe.remove('titre_nombre_personne');
  }else if (classe == "titre_nombre_personne_active"){

  }
  document.getElementById('unique').classList = "titre_nombre_personne";
}
function unique(){
  document.getElementById('toute_personne').style.display = "none";
  document.getElementById('seul_personne').style.display = "block";
  var classe1 = document.getElementById('unique').classList;
  if(classe1 == "titre_nombre_personne"){
    classe1.add('titre_nombre_personne_active');
    classe1.remove('titre_nombre_personne');
  }else if (classe1 == "titre_nombre_personne_active"){

  }
   document.getElementById('btn_plusieurs').classList = "titre_nombre_personne";
}

function personne(){
  document.getElementById('personne_hover').style.backgroundColor = "white";
}
function fonction(){
  document.getElementById('fonction_hover').style.backgroundColor = "white";
}
function domaine(){
  document.getElementById('domaine_hover').style.backgroundColor = "white";
}
function date_hover(){
  document.getElementById('date_hover').style.backgroundColor = "white";
}
function qualite(){
  document.getElementById('qualite_hover').style.backgroundColor = "white";
}
function niveau(){
  document.getElementById('niveau_hover').style.backgroundColor = "white";
}
function status(){
  document.getElementById('status_hover').style.backgroundColor = "white";
}
function modalite(){
  document.getElementById('modalite_hover').style.backgroundColor = "white";
}
function quit(){
  document.getElementById('personne_hover').style.backgroundColor ="";
  document.getElementById('fonction_hover').style.backgroundColor = "";
  document.getElementById('domaine_hover').style.backgroundColor = "";
  document.getElementById('date_hover').style.backgroundColor = "";
  document.getElementById('qualite_hover').style.backgroundColor = "";
  document.getElementById('niveau_hover').style.backgroundColor = "";
  document.getElementById('status_hover').style.backgroundColor = "";
  document.getElementById('modalite_hover').style.backgroundColor = "";
}

  function annee1(){
    var doc = document.getElementById('annee_1').classList;
    if(doc == "classe_sexe_active"){
        doc.add("classe_sexe");
        doc.remove("classe_sexe_active");
    }else
    if(doc == "classe_sexe"){
        doc.add('classe_sexe_active');
        doc.remove('classe_sexe');
    }
  };
  function annee2(){
    var doc = document.getElementById('annee_2').classList;
    if(doc == "classe_sexe_active"){
        doc.add("classe_sexe");
        doc.remove("classe_sexe_active");
    }else
    if(doc == "classe_sexe"){
        doc.add('classe_sexe_active');
        doc.remove('classe_sexe');
    }
  };
  function annee3(){
    var doc = document.getElementById('annee_3').classList;
    if(doc == "classe_sexe_active"){
        doc.add("classe_sexe");
        doc.remove("classe_sexe_active");
    }else
    if(doc == "classe_sexe"){
        doc.add('classe_sexe_active');
        doc.remove('classe_sexe');
    }
  };
  function annee4(){
    var doc = document.getElementById('annee_4').classList;
    if(doc == "classe_sexe_active"){
        doc.add("classe_sexe");
        doc.remove("classe_sexe_active");
    }else
    if(doc == "classe_sexe"){
        doc.add('classe_sexe_active');
        doc.remove('classe_sexe');
    }
  };
  function annee5(){
    var doc = document.getElementById('annee_5').classList;
    if(doc == "classe_sexe_active"){
        doc.add("classe_sexe");
        doc.remove("classe_sexe_active");
    }else
    if(doc == "classe_sexe"){
        doc.add('classe_sexe_active');
        doc.remove('classe_sexe');
    }
  };
  function niveau1(){
    document.getElementById('debutant_btn').style.backgroundColor = "rgb(214, 210, 210)";
    document.getElementById('intermediaire_btn').style.backgroundColor = "white";
    document.getElementById('avance_btn').style.backgroundColor = "white";
  };
  function niveau2(){
    document.getElementById('debutant_btn').style.backgroundColor = "white";
    document.getElementById('intermediaire_btn').style.backgroundColor = "rgb(214, 210, 210)";
    document.getElementById('avance_btn').style.backgroundColor = "white";
  };
  function niveau3(){
    document.getElementById('debutant_btn').style.backgroundColor = "white";
    document.getElementById('intermediaire_btn').style.backgroundColor = "white";
    document.getElementById('avance_btn').style.backgroundColor = "rgb(214, 210, 210)";
  };
  function modalite1(){
    document.getElementById('presentille_btn').style.backgroundColor = "rgb(214, 210, 210)";
    document.getElementById('distance_btn').style.backgroundColor = "white";
  };
  function modalite2(){
    document.getElementById('presentille_btn').style.backgroundColor = "white";
    document.getElementById('distance_btn').style.backgroundColor = "rgb(214, 210, 210)";
  };
  function status1(){
    document.getElementById('cours_btn').style.backgroundColor = "rgb(214, 210, 210)";
    document.getElementById('complete_btn').style.backgroundColor = "white";
    document.getElementById('avenir_btn').style.backgroundColor = "white";
  };
  function status2(){
    document.getElementById('cours_btn').style.backgroundColor = "white";
    document.getElementById('complete_btn').style.backgroundColor = "rgb(214, 210, 210)";
    document.getElementById('avenir_btn').style.backgroundColor = "white";
  };
  function status3(){
    document.getElementById('cours_btn').style.backgroundColor = "white";
    document.getElementById('complete_btn').style.backgroundColor = "white";
    document.getElementById('avenir_btn').style.backgroundColor = "rgb(214, 210, 210)";
  };
  function qualite1(){
    document.getElementById('presence_btn').style.backgroundColor = "rgb(214, 210, 210)";
    document.getElementById('absence_btn').style.backgroundColor = "white";
    document.getElementById('reussite_btn').style.backgroundColor = "white";
  };
  function qualite2(){
    document.getElementById('presence_btn').style.backgroundColor = "white";
    document.getElementById('absence_btn').style.backgroundColor = "rgb(214, 210, 210)";
    document.getElementById('reussite_btn').style.backgroundColor = "white";
  };
  function qualite3(){
    document.getElementById('presence_btn').style.backgroundColor = "white";
    document.getElementById('absence_btn').style.backgroundColor = "white";
    document.getElementById('reussite_btn').style.backgroundColor = "rgb(214, 210, 210)";
  };
  function tous_btn(){
    document.getElementById('tous_btn').style.backgroundColor = "rgb(214, 210, 210)";
    document.getElementById('homme_btn').style.backgroundColor = "white";
    document.getElementById('femme_btn').style.backgroundColor = "white";
  };
  function homme_btn(){
    document.getElementById('tous_btn').style.backgroundColor = "white";
    document.getElementById('homme_btn').style.backgroundColor = "rgb(214, 210, 210)";
    document.getElementById('femme_btn').style.backgroundColor = "white";
  };
  function femme_btn(){
    document.getElementById('tous_btn').style.backgroundColor = "white";
    document.getElementById('homme_btn').style.backgroundColor = "white";
    document.getElementById('femme_btn').style.backgroundColor = "rgb(214, 210, 210)";
  };
  function menu_1(){
    var element_1 = document.getElementById('menu_personne').classList;
    if(element_1 == "fa fa-angle-up"){
      element_1.remove("fa-angle-up");
      element_1.add("fa-angle-down");
    }else if(element_1 == "fa fa-angle-down"){
      element_1.remove("fa-angle-down");
      element_1.add("fa-angle-up");
    }
  };
  function menu_2(){
    var element_2 = document.getElementById('menu_fonction').classList;
    if(element_2 == "fa fa-angle-up"){
      element_2.remove("fa-angle-up");
      element_2.add("fa-angle-down");
    }else if(element_2 == "fa fa-angle-down"){
      element_2.remove("fa-angle-down");
      element_2.add("fa-angle-up");
    }
  };
  function menu_3(){
    var element_3 = document.getElementById('menu_domaine').classList;
    if(element_3 == "fa fa-angle-up"){
      element_3.remove("fa-angle-up");
      element_3.add("fa-angle-down");
    }else if(element_3 == "fa fa-angle-down"){
      element_3.remove("fa-angle-down");
      element_3.add("fa-angle-up");
    }
  };
  function menu_4(){
    var element_4 = document.getElementById('menu_date').classList;
    if(element_4 == "fa fa-angle-up"){
      element_4.remove("fa-angle-up");
      element_4.add("fa-angle-down");
    }else if(element_4 == "fa fa-angle-down"){
      element_4.remove("fa-angle-down");
      element_4.add("fa-angle-up");
    }
  };
  function menu_5(){
    var element_5 = document.getElementById('menu_modalite').classList;
    if(element_5 == "fa fa-angle-up"){
      element_5.remove("fa-angle-up");
      element_5.add("fa-angle-down");
    }else if(element_5 == "fa fa-angle-down"){
      element_5.remove("fa-angle-down");
      element_5.add("fa-angle-up");
    }
  };