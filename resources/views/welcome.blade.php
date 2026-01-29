<!-- layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Programisty</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body class="antialiased">
    <!-- Navigation -->
    <nav id="mainNav" class="fixed w-full z-50 transition-all duration-300">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="#page-top" class="text-xl font-bold text-white">Portfolio</a>
                <button class="lg:hidden text-white" onclick="toggleMenu()">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="hidden lg:flex space-x-8">
                    <a href="#about" class="text-white hover:text-gray-300">O mnie</a>
                    <a href="#services" class="text-white hover:text-gray-300">Usługi</a>
                    <a href="#portfolio" class="text-white hover:text-gray-300">Portfolio</a>
                    <a href="#contact" class="text-white hover:text-gray-300">Kontakt</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="relative h-screen flex items-center justify-center text-center text-white"
            style="background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%), url('/img/bg-masthead.jpg') center/cover;">
        <div class="container mx-auto px-4 max-w-4xl">
            <h1 class="text-6xl font-bold mb-4">Dariusz Gut</h1>
            <hr class="my-6 mx-auto w-160 border-t-4 border-yellow-500">

            <h1 class="text-5xl font-bold mb-4">Tworzę rozwiązania szyte na miarę</h1>
            <hr class="my-6 mx-auto w-160 border-t-4 border-yellow-500">


            <p class="text-xl mb-6 leading-relaxed">
                Specjalizuję się w projektowaniu dedykowanego oprogramowania biznesowego, systemów zarządzania danymi
                i automatyzacji procesów firmowych. Dla Cebit, Govecs i Yellow dostarczam rozwiązania dopasowane
                do ich unikalnych potrzeb.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12 mb-12 text-lg">
                <div>
                    <i class="fas fa-database text-yellow-500 text-3xl mb-4"></i>
                    <p>Systemy zarządzania danymi</p>
                </div>
                <div>
                    <i class="fas fa-cogs text-yellow-500 text-3xl mb-4"></i>
                    <p>Automatyzacja procesów</p>
                </div>
                <div>
                    <i class="fas fa-code-branch text-yellow-500 text-3xl mb-4"></i>
                    <p>Integracja systemów</p>
                </div>
            </div>
            <a href="#contact" class="bg-yellow-500 text-white px-8 py-3 rounded-full text-lg hover:bg-yellow-600 transition-colors">
                Rozpocznij projekt
            </a>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4">O mnie</h2>
            <hr class="my-4 mx-auto w-16 border-t-4 border-yellow-500">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
                <div>
                    <h3 class="text-2xl font-bold mb-4">Doświadczenie</h3>
                    <p class="text-gray-600">
                        Specjalizuję się w tworzeniu zaawansowanych systemów bazodanowych i aplikacji webowych.
                        Współpracuję z firmami takimi jak Cebit, Govecs i Yellow, dostarczając dedykowane rozwiązania.
                    </p>
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-4">Technologie</h3>
                    <p class="text-gray-600">
                        Wykorzystuję najnowsze technologie, w tym Laravel, MySQL, PostgreSQL oraz nowoczesne
                        frameworki frontendowe.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4">Usługi</h2>
            <hr class="my-4 mx-auto w-16 border-t-4 border-yellow-500">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <div class="text-center p-6">
                    <i class="fas fa-database text-4xl text-yellow-500 mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Systemy Bazodanowe</h3>
                    <p class="text-gray-600">Projektowanie i implementacja wydajnych baz danych</p>
                </div>
                <div class="text-center p-6">
                    <i class="fas fa-laptop-code text-4xl text-yellow-500 mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Aplikacje Webowe</h3>
                    <p class="text-gray-600">Tworzenie nowoczesnych aplikacji internetowych</p>
                </div>
                <div class="text-center p-6">
                    <i class="fas fa-cogs text-4xl text-yellow-500 mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Integracje Systemów</h3>
                    <p class="text-gray-600">Łączenie i optymalizacja istniejących systemów</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4">Portfolio</h2>
            <hr class="my-4 mx-auto w-16 border-t-4 border-yellow-500">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
                <div class="relative group">
                    <img src="/img/portfolio/1.jpg" alt="Projekt 1" class="w-full">
                    <div class="absolute inset-0 bg-yellow-500 bg-opacity-75 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <div class="text-white text-center">
                            <h3 class="text-xl font-bold mb-2">System dla Cebit</h3>
                            <p>Zarządzanie danymi klientów</p>
                        </div>
                    </div>
                </div>
                <!-- Powtórz dla innych projektów -->
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4">Kontakt</h2>
            <hr class="my-4 mx-auto w-16 border-t-4 border-yellow-500">
            <div class="max-w-2xl mx-auto mt-12">
                <form class="space-y-6">
                    <div>
                        <input type="text" placeholder="Imię i nazwisko" class="w-full px-4 py-3 rounded border">
                    </div>
                    <div>
                        <input type="email" placeholder="Email" class="w-full px-4 py-3 rounded border">
                    </div>
                    <div>
                        <textarea placeholder="Wiadomość" rows="5" class="w-full px-4 py-3 rounded border"></textarea>
                    </div>
                    <button type="submit" class="bg-yellow-500 text-white px-8 py-3 rounded-full hover:bg-yellow-600 transition-colors">
                        Wyślij wiadomość
                    </button>
                </form>
            </div>
        </div>
    </section>

    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Navigation background change on scroll
        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) {
                document.getElementById('mainNav').classList.add('bg-gray-900');
            } else {
                document.getElementById('mainNav').classList.remove('bg-gray-900');
            }
        });

        // Mobile menu toggle
        function toggleMenu() {
            const menu = document.querySelector('.lg\\:flex');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>
