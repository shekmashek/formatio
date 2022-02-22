<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="py-20 h-screen bg-gray-300 px-2">
    <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden md:max-w-md">
        <div class="md:flex">
            <div class="w-full p-3 px-6 py-10">
                <div class="text-center"> <span class="text-xl text-gray-700">Veuillez remplir les informations manquantes</span> </div>
                @for ($i=1; $i <= count($res); $i++)
                    <div class="mt-3 relative"> <span class="absolute p-1 bottom-8 ml-2 bg-white text-gray-400 ">{{$res[$i]}}</span> <input type="text" class="h-12 px-2 w-full border-2 rounded focus:outline-none focus:border-red-600"> </div>
                @endfor
                <div class="mt-4"> <button class="h-12 w-full bg-red-600 text-white rounded hover:bg-red-700">Click to proceed <i class="fa fa-long-arrow-right"></i></button> </div>
             </div>
        </div>
    </div>
</div>