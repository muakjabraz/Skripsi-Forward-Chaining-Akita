<!doctype html>
<html lang="en">

<head>
  <title>{{ $title }}</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <nav class="navbar navbar-expand-sm navbar-light font-weight-bold text-light fixed-top" style="background-color: #8BCB98;">
    <div class="container">
      {{-- <a class="navbar-brand" href="#">Navbar</a> --}}
      <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
        </ul>
        <ul class="navbar-nav mt-2 mt-lg-0">
          <li class="nav-item mx-3">
            <a class="nav-link font-weight-bold text-light" href="#home">Home</a>
          </li>
          <li class="nav-item mx-3">
            <a class="nav-link font-weight-bold text-light" href="#informasi">Informasi</a>
          </li>
          <li class="nav-item mx-3">
            <a class="nav-link font-weight-bold text-light" href="{{ route('logout') }}">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <main>
    <section id="home" class="pt-lg-5 text-light" style="background-color: #48694A;">
      <div class="container">
        <div class="row justify-content-center align-items-center g-2">
          <div class="col text-center pt-5">
            <h1 class="font-weight-bold display-2">Selamat Datang</h1>
            <h3>PUSKESMAS SEKARGADUNG</h3>
            <marquee width="500" height="40">Jl. Sekarsono No. 1 RT.2 RW.5 Kel. Sekargadung Kec. Purworejo phpTelp : 0343 – 5643610</marquee>
          </div>
          <div class="col text-center pt-5">
            <img src="{{ asset('assets/img/logo-kotapas.png') }}" height="400px" alt="">
          </div>
        </div>
      </div>
    </section>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#48694A" fill-opacity="1" d="M0,128L120,154.7C240,181,480,235,720,234.7C960,235,1200,181,1320,154.7L1440,128L1440,0L1320,0C1200,0,960,0,720,0C480,0,240,0,120,0L0,0Z"></path>
    </svg>
    <section id="informasi" class="bg-white pt-lg-5 pb-lg-5" style="background-color: #4e73df;">
      <div class="container">
        <div class="row justify-content-center align-items-center g-2">
          <div class="col text-center pt-5 pb-5">
            <h1 class="font-weight-bold display-2">Informasi</h1>
            <h6>PUSKESMAS SEKARGADUNG</h6>
          </div>

        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-md-3 row-cols-md-4 g-4">
          <div class="col">
            <div class="card">
              <img src="{{ asset('assets/img/hush-naidoo-jade-photography-yo01Z-9HQAw-unsplash.jpg') }}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Judul info</h5>
                <p class="card-text">isi konten tentang informasi yang menjelaskan tentang sistem pakar gangguan kesehatan mental.</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <img src="{{ asset('assets/img/hush-naidoo-jade-photography-yo01Z-9HQAw-unsplash.jpg') }}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Judul info</h5>
                <p class="card-text">isi konten tentang informasi yang menjelaskan tentang sistem pakar gangguan kesehatan mental.</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <img src="{{ asset('assets/img/hush-naidoo-jade-photography-yo01Z-9HQAw-unsplash.jpg') }}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Judul info</h5>
                <p class="card-text">isi konten tentang informasi yang menjelaskan tentang sistem pakar gangguan kesehatan mental.</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <img src="{{ asset('assets/img/hush-naidoo-jade-photography-yo01Z-9HQAw-unsplash.jpg') }}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Judul info</h5>
                <p class="card-text">isi konten tentang informasi yang menjelaskan tentang sistem pakar gangguan kesehatan mental.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#48694A" fill-opacity="1" d="M0,128L120,144C240,160,480,192,720,192C960,192,1200,160,1320,144L1440,128L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
    </svg>
    <section class="text-light" style="background-color: #48694A;">
      <div class="container">
        <div class="row justify-content-center align-items-center g-2">
          <div class="col text-center">
            <p>Copyright@2023</p>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>