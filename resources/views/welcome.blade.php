<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Landing Page</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap');
  * {
    margin: 0; padding: 0; box-sizing: border-box;
  }
  body {
    font-family: 'Quicksand', sans-serif;
    background-color: #F3F3F3; /* Light Grey */
    color: #000014; /* Default black */
    line-height: 1.5;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }
  a {
    text-decoration: none;
    color: inherit;
  }
  button {
    font-family: inherit;
  }

  /* Navbar */
  header {
    position: relative;
    background-image: url("images/kelas_p5.jpeg");
    background-size: cover;
    background-position: center;
    padding: 1rem 2rem;
    color: #F9FBE7;
    z-index: 2;
  }
  header::before {
    content: "";
    position: absolute;
    inset: 0;
    background-color: rgb(254, 161, 161);
    opacity: 0.8; 
    z-index: 1;
  }
  .navbar {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1200px;
    margin: auto;
    z-index: 2;
  }
  .navbar .logo {
    font-weight: 700;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    letter-spacing: 1.1px;
    color: #4d0a10;
  }
  .navbar .logo svg {
    margin-right: 10px;
    fill: #80A1F8; /* Light Blue */
    width: 28px;
    height: 28px;
  }
  .navbar nav {
    display: flex;
    gap: 2rem;
    font-weight: 600;
    font-size: 1rem;
    color: #F9FBE7;
    position: relative;
    z-index: 2;
  }
  .navbar nav a {
    cursor: pointer;
    user-select: none;
    color: #F9FBE7;
    transition: color 0.3s ease;
  }
  .navbar nav a:hover,
  .navbar nav a:focus {
    color: #F0EDD4;
    outline: none;
  }
  .navbar .auth-buttons {
    display: flex;
    gap: 1rem;
    position: relative;
    z-index: 2;
  }
  .btn-register {
    border: 2px solid #F9FBE7; 
    padding: 0.45rem 1.5rem;
    border-radius: 24px;
    font-weight: 600;
    background: transparent;
    cursor: pointer;
    color: #F9FBE7; 
    transition: background-color 0.3s ease, color 0.3s ease;
  }
  .btn-register:hover,
  .btn-register:focus {
    background-color: #F0EDD4;
    border-color: #F0EDD4;
    color: #FDFDFD;
    outline: none;
  }
  .btn-login {
    background-color: #F9FBE7; /* Light Blue */
    color: #ECCDB4; /* Black */
    padding: 0.45rem 1.8rem;
    border-radius: 24px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  .btn-login:hover,
  .btn-login:focus {
    background-color: #F0EDD4; /* Dark Blue */
    color: #FDFDFD; /* White */
    outline: none;
  }


    /* Gallery Grid Section */
  .gallery {
    max-width: 900px;
    margin: 0 auto 3rem auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-auto-rows: 150px;
    gap: 12px;
  }

  .gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    cursor: pointer;
    transition: transform 0.3s ease;
  }

  .gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.4s ease;
  }

  .gallery-item:hover img {
    transform: scale(1.1);
  }

  .item1 { grid-column: span 2; grid-row: span 2; }
  .item2 { }
  .item3 { }
  .item4 { }
  .item5 { }
  .item6 { }
  .item7 { }
  .item8 { grid-column: span 2; grid-row: span 2; }
  .item9 { grid-column: span 2; }

  h1 {
  text-align: center;
  margin-bottom: 1rem;
  font-weight: 700;
}

p.description {
  text-align: center;
  margin-bottom: 2rem;
  font-weight: 500;
  color: #555;
}


  /* Load More Button */
  .load-more {
    margin: 2rem auto 5rem auto;
    display: block;
    background-color: #0043F1;
    color: #FFF;
    border: none;
    padding: 0.75rem 2rem;
    font-size: 1rem;
    border-radius: 25px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgb(0 67 241 / 0.5);
    transition: background-color 0.3s ease;
  }

  .load-more:hover {
    background-color: #002C58;
  }

  /* Hero Section */
  .hero {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 7rem 1.5rem 7rem;
    max-width: 900px;
    margin: 0 auto;
    color: #FFFFFF; /* White text */
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.7);
  }
  .hero h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 0.8rem;
    line-height: 1.2;
    letter-spacing: 0.03em;
    text-color:#F9FBE7 ;
  }
  .hero p {
    font-size: 1.05rem;
    margin-bottom: 2.5rem;
    max-width: 640px;
    margin-left: auto;
    margin-right: auto;
  }
  .btn-group {
    display: inline-flex;
    gap: 1.2rem;
  }
  .btn-primary {
    background-color: #80A1F8; /* Light Blue */
    border: none;
    padding: 0.8rem 2.6rem;
    font-weight: 700;
    border-radius: 6px;
    cursor: pointer;
    color: #000014; /* Black */
    font-size: 1rem;
    transition: background-color 0.3s ease;
  }
  .btn-primary:hover {
    background-color: #0043F1; /* Blue */
  }
  .btn-secondary {
    background-color: transparent;
    border: 2px solid #80A1F8; /* Light Blue */
    padding: 0.75rem 2.6rem;
    font-weight: 700;
    border-radius: 6px;
    color: #80A1F8; /* Light Blue */
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease, color 0.3s ease;
  }
  .btn-secondary:hover {
    background-color: #80A1F8; /* Light Blue */
    color: #000014; /* Black */
  }

  /* Cards Section */
  .cards {
    display: flex;
    justify-content: center;
    gap: 1.4rem;
    margin: 2.5rem 0 4rem;
    max-width: 960px;
    margin-left: auto;
    margin-right: auto;
    padding: 0 1rem;
  }
  .card {
    position: relative;
    flex: 1;
    cursor: pointer;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 0 22px #000014aa;
    color: #FDFDFD;
    background-size: cover;
    background-position: center;
    min-height: 230px;
    display: flex;
    align-items: flex-end;
    padding: 1.4rem 1.5rem 1.5rem;
    font-size: 1rem;
    font-weight: 600;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .card:hover {
    transform: scale(1.06);
    box-shadow: 0 0 28px #0043F1cc;
  }
  .card .plus {
    position: absolute;
    top: 12px;
    right: 12px;
    font-size: 1.8rem;
    font-weight: 900;
    background: #002C58cc;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    line-height: 28px;
    text-align: center;
    cursor: pointer;
    user-select: none;
    transition: background-color 0.3s ease;
  }
  .card .plus:hover {
    background-color: #0043F1cc;
  }
  .card-text {
    position: relative;
    z-index: 1;
    color: #FDFDFD;
    font-weight: 700;
    font-size: 1.2rem;
    text-shadow: 0 0 6px rgba(0,0,0,0.7);
  }

  /* Gallery Carousel Section */
  .gallery-carousel-section {
    max-width: 960px;
    margin: 3rem auto 5rem;
    padding: 0 1rem;
    color: #000014;
    text-align: center;
  }
  .gallery-carousel-section h2 {
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 1.5rem;
    letter-spacing: 0.03em;
  }
  .carousel-container {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 0 20px rgb(0 0 0 / 0.1);
    background: #fff;
  }
  .carousel-track-container {
    overflow: hidden;
  }
  .carousel-track {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
  }
  .carousel-slide {
    min-width: 100%;
    user-select: none;
  }
  .carousel-slide img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    display: block;
    border-radius: 12px;
  }
  .carousel-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: #0043F1cc;
    border: none;
    color: white;
    font-size: 2rem;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    z-index: 10;
    user-select: none;
    transition: background-color 0.3s ease;
  }
  .carousel-btn:hover {
    background-color: #002C58;
  }
  .carousel-btn.prev {
    left: 10px;
  }
  .carousel-btn.next {
    right: 10px;
  }

  /* About Section */
  .about-section {
    max-width: 960px;
    margin: 4rem auto 3rem;
    display: flex;
    gap: 3rem;
    padding: 0 1rem;
    color: #000014;
    align-items: center;
  }
  .about-text {
    flex: 1 1 350px;
  }
  .about-text h2 {
    font-weight: 700;
    margin-bottom: 1rem;
    font-size: 1.9rem;
    color: #002C58;
  }
  .about-text p {
    font-size: 1rem;
    color:rgb(21, 34, 70);
    line-height: 1.6;
  }
  .about-text a {
    font-weight: 700;
    font-size: 1rem;
    color: #80A1F8;
    display: inline-flex;
    align-items: center;
    margin-top: 1rem;
    transition: color 0.3s ease;
  }
  .about-text a svg {
    margin-left: 8px;
    fill: #80A1F8;
    width: 14px;
    height: 14px;
    transition: transform 0.3s ease;
  }
  .about-text a:hover {
    color: #0043F1;
  }
  .about-text a:hover svg {
    transform: translateX(4px);
  }
  .about-image {
    flex: 1 1 350px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 0 18px #00001422;
  }
  .about-image img {
    width: 100%;
    display: block;
    border-radius: 12px;
  }

   .contact-section {
    max-width: 900px;
    margin: 2rem auto;
    padding: 2rem 8rem;
    background: linear-gradient(135deg,rgb(235, 237, 243),rgb(225, 228, 237)); /* Gradasi Biru */
    border-radius: 13px;
    box-shadow: 0 8px 20px rgba(0, 51, 102, 0.3); /* Darker blue shadow */
    color: #FDFDFD;
    font-weight: 600;
  }

  .contact-section h2 {
    font-weight: 700;
    font-size: 2.0rem;
    margin-bottom: 1.5rem;
    text-align: center;
    color: #000000; /* Warna putih */

  }

  .contact-list-enhanced {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
  }

  .contact-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    background:rgb(2, 9, 15); /* Darker blue background for each item */
    padding: 1rem 1.5rem;
    border-radius: 12px;
    color: #FDFDFD;
    font-size: 1.1rem;
    transition: box-shadow 0.3s ease, transform 0.3s ease;
    user-select: none;
    text-decoration: none;
  }

  .contact-item:hover,
  .contact-item:focus {
    box-shadow: 0 6px 18px rgba(203, 212, 236, 0.9);
    transform: translateY(-4px);
    outline: none;
  }

  .contact-item img {
    flex-shrink: 0;
  }

  .contact-item .arrow {
    margin-left: auto;
    font-size: 1.3rem;
    color: #80A1F8; /* Light blue arrow color */
    transition: margin-left 0.3s ease;
  }

  .contact-item:hover .arrow,
  .contact-item:focus .arrow {
    margin-left: 0.5rem;
  }

  /* Footer */
  footer {
    background-color:#4d0a10;
    color: #EAEAEA;
    padding: 3rem 2rem 3rem;
    font-size: 0.9rem;
    line-height: 1.5;
    margin-top: auto;
  }
  .footer-container {
    max-width: 1100px;
    margin: auto;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 2rem;
  }
  .footer-col {
    flex: 1 1 220px;
    min-width: 180px;
  }
  .footer-col h3 {
    color: #d25c60;
    font-weight: 700;
    font-size: 1.1rem;
    margin-bottom: 1rem;
    letter-spacing: 0.02em;
  }
  .footer-col p,
  .footer-col a {
    color: #EAEAEA;
    font-weight: 500;
    display: block;
    margin-bottom: 0.9rem;
    transition: color 0.3s ease;
  }
  .footer-col a:hover {
    color: #d25c60;
  }
  .footer-contact-info svg {
    width: 18px;
    height: 18px;
    vertical-align: middle;
    margin-right: 6px;
    fill: #EAEAEA;
  }
  .footer-contact-info a {
    display: inline-flex;
    align-items: center;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .navbar nav {
      gap: 1rem;
      font-size: 0.9rem;
    }
    .cards {
      flex-direction: column;
      max-width: 320px;
      margin: 2.5rem auto;
    }
    .about-section {
      flex-direction: column;
      max-width: 320px;
      margin: 4rem auto;
    }
    .stats {
      flex-direction: column;
      max-width: 320px;
      margin: 3rem auto;
      gap: 1.5rem;
    }
    .process-steps {
      flex-direction: column;
      max-width: 320px;
      margin: auto;
      gap: 2.5rem;
    }
    .btn-process {
      float: none;
      margin-bottom: 1.8rem;
    }
    .footer-container {
      flex-direction: column;
      gap: 2.5rem;
      max-width: 320px;
      margin: auto;
    }
  }
</style>
</head>
<body>

<header id="home">
  <div class="navbar">
    <a href="#" class="logo" aria-label="Garden Tree Logo">
    <img src="images/a_logo.png" alt="Garden Tree Logo" style="width:50px; height:50px; margin-right:10px; object-fit:contain;">
    READY4PKL
    </a>


    <nav>
        <a href="#home" tabindex="0">Home</a>
        <a href="#gallery" tabindex="0">Gallery</a>
        <a href="#about-us" tabindex="0">About us</a>
        <a href="#contact-us" tabindex="0">Contact us</a>
    </nav>

    <div class="auth-buttons" >
      <button class="btn-register" type="button" onclick="window.location.href='http://127.0.0.1:8000/register'">Register</button>
<button class="btn-login" type="button" onclick="window.location.href='http://127.0.0.1:8000/login'">Login</button>
    </div>
  </div>
  <div class="hero" role="banner" aria-label="Garden Tree hero section with call to action">
    <h1>Selamat Datang di READY4PKL</h1>
    <p>Laporkan kegiatan PKL-mu kapan saja & dimana saja menggunakan website READY4PKL.</p>
  </div>
</header>

<section class="cards" aria-label="Services cards">
<div class="card" style="background-image: url('{{ asset('images/') }}')">
    <span class="card-text">Jaringan Komputer Dasar</span>
  </div>
  <div class="card" style="background-image: url('{{ asset('images/database.jpeg') }}')">
    <span class="card-text">Sistem Komputer</span>
  </div>
  <div class="card" style="background-image: url('{{ asset('images/') }}')">
    <span class="card-text">Pemrograman Dasar</span>
  </div>
  <div class="card" style="background-image: url('{{ asset('images/pkk.jpeg') }}')" tabindex="0" aria-label="Internet of Things">
    <span class="card-text">Internet of Things</span>
  </div>
</section>


<section id="about-us" class="about-section custom-about" aria-label="Digital agency problems and solutions">
  <div class="about-text">
    <h2>Praktik Kerja Lapangan (PKL)<br>SMK NEGERI 2 Depok</h2>
    <p>Praktik Kerja Lapangan (PKL) di SMKN 2 Depok Yogyakarta memberikan kesempatan kepada siswa untuk mendapatkan pengalaman langsung di dunia industri. Namun, tantangan yang sering dihadapi adalah kesenjangan antara kurikulum pendidikan dengan kebutuhan industri yang terus berkembang. Meskipun demikian, dengan dukungan dari mitra industri, kami terus berupaya untuk menyesuaikan program PKL agar lebih relevan dengan kebutuhan pasar kerja.</p>
  </div>
  <div class="images-carousel" aria-label="Team images carousel">
    <button class="carousel-btn prev" aria-label="Previous image">&lt;</button>
    <div class="carousel-track-container">
      <ul class="carousel-track">
        <li class="carousel-slide">
          <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=800&q=80" alt="Team Collaboration" />
        </li>
      </ul>
    </div>
    <button class="carousel-btn next" aria-label="Next image">&gt;</button>
  </div>
</section>


<h1>Our Gallery</h1>
<p class="description">some photos of SIJA'26 memories</p>

<div id="gallery" class="gallery" aria-label="Image gallery with mixed sizes">
  <div class="gallery-item item1">
    <img src="{{ asset('images/maam_rosi.jpeg') }}" alt="Hanger rack with clothes" />
  </div>
  <div class="gallery-item item2">
    <img src="{{ asset('images/cewe_yb.jpeg') }}" alt="Two people walking outside" />
  </div>
  <div class="gallery-item item3">
    <img src="{{ asset('images/cewe_lapangan.jpeg') }}" alt="Watch on table" />
  </div>
  <div class="gallery-item item4">
    <img src="{{ asset('images/kelas_pjok.jpeg') }}" alt="Man wearing hat looking sideways" />
  </div>
  <div class="gallery-item item5">
    <img src="{{ asset('images/') }}" alt="Shoes and pants flat lay" />
  </div>
  <div class="gallery-item item6">
    <img src="{{ asset('images/prmk.jpeg') }}" alt="Shirts on hangers" />
  </div>
  <div class="gallery-item item7">
    <img src="{{ asset('images/kelas_sintaks.jpeg') }}" alt="Colorful flower pattern" />
  </div>
  <div class="gallery-item item8">
    <img src="{{ asset('images/Bu_Nikmah.jpeg') }}" alt="Green leaves in glass vase" />
  </div>
  <div class="gallery-item item9">
    <img src="{{ asset('images/kelas_bebersih.jpeg') }}" alt="Stack of white books" />
  </div>
</div>






<footer>
  <div class="footer-container" aria-label="Footer navigation and contact information">
    <div class="footer-col">
      <h3>PKL Tracker</h3>
      <p>Platform digital untuk mengelola Praktek Kerja Lapangan SMK NEGERI 2 DEPOK dengan teknologi modern dan interface yang user-friendly.</p>
    </div>
    <div class="footer-col">
      <h3>Quick Links</h3>
      <a href="#">Home</a>
      <a href="#">Gallery</a>
      <a href="#">About us</a>
      <a href="#">Login</a>
      <a href="#">Register</a>
    </div>
    <div class="footer-col">
      <h3>Support</h3>
      <a href="#">Help Center</a>
      <a href="#">Documentation</a>
      <a href="#">FAQ</a>
      <a href="#">Contact Support</a>
    </div>
    <div class="footer-col footer-contact-info">
      <h3>Contact Info</h3>
      <p><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24"><path d="M20 4H4c-1.104 0-2 .896-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6c0-1.104-.896-2-2-2zm0 2l-8 5-8-5h16z"/></svg> <a href="mailto:pkl@smktibali.ac.id">pklsija@stembayo.ac.id</a></p>
      <p><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24"><path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l1.58-1.58a1 1 0 011.11-.21c1.21.48 2.53.74 3.88.74a1 1 0 011 1v3.5a1 1 0 01-1 1C10.54 21 3 13.46 3 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.35.25 2.67.74 3.88a1 1 0 01-.21 1.11l-1.41 1.8z"/></svg> +62 361-123-4567</p>
      <p><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM7 9a5 5 0 0110 0c0 2.98-3.02 7.87-5 10.88C10.01 16.86 7 11.92 7 9z"/></svg> Yogyakarta, Indonesia</p>
    </div>
  </div>
</footer>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const track = document.querySelector('.gallery-carousel-section .carousel-track');
    const slides = Array.from(track.children);
    const nextButton = document.querySelector('.gallery-carousel-section .carousel-btn.next');
    const prevButton = document.querySelector('.gallery-carousel-section .carousel-btn.prev');
    const slideWidth = slides[0].getBoundingClientRect().width;

    slides.forEach((slide, index) => {
      slide.style.left = slideWidth * index + 'px';
    });

    let currentSlideIndex = 0;

    const moveToSlide = (track, targetIndex) => {
      track.style.transform = 'translateX(-' + slides[targetIndex].style.left + ')';
      currentSlideIndex = targetIndex;
    };

    prevButton.addEventListener('click', () => {
      const prevIndex = currentSlideIndex === 0 ? slides.length - 1 : currentSlideIndex - 1;
      moveToSlide(track, prevIndex);
    });

    nextButton.addEventListener('click', () => {
      const nextIndex = currentSlideIndex === slides.length - 1 ? 0 : currentSlideIndex + 1;
      moveToSlide(track, nextIndex);
    });
  });
</script>

</body>
</html>
