<!DOCTYPE html>
<html>
<head>
	<title>Badge avec Qrcode</title>
</head>
    <body>
        <!-- On affiche le code QR au format SVG -->
        <div class="card">
            <div class="card__img">
                <img src="https://phongvu.vn/cong-nghe/wp-content/uploads/2019/09/img_7866.jpg" alt="nhan">
            </div>
            <div class="card__name">
                <h2>User Name</h2>
            </div>
            <div class="card__job">
                <span>Fullstack Developer</span>
            </div>
            <div class="card__link">
                <a href="#">
                    <i class='bx bxl-facebook'></i>
                </a>
                <a href="#">
                    <i class='bx bxl-youtube' ></i>
                </a>
                <a href="#">
                    <i class='bx bxl-tiktok' ></i>
                </a>
                <a href="#">
                    <i class='bx bxl-github' ></i>
                </a>
            </div>
            <div class="card__btn">
                <button class="card__btn-contact">Contact me</button>
            </div>
        </div>
        {{$qrcode}}
    </body>
</html>