<?php

namespace App\Http\Controllers;

use App\Models\FonctionGenerique;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class SimpleQRcodeController extends Controller
{
    // L'action "generate" de la route "simple-qrcode" (GET)
    public function generate ($id) {

        $fonct = new FonctionGenerique();
        $emp = $fonct->findWhereMulitOne("employers",["id"],[$id]);
        $info = $emp->matricule_emp . $emp->nom_emp . $emp->prenom_emp;
    	# 2. On génère un QR code de taille 200 x 200 px
    	$qrcode = QrCode::size(50)->generate($id);

    	# 3. On envoie le QR code généré à la vue "simple-qrcode"
    	return view("qrCode", compact('qrcode','emp'));
    }
}
