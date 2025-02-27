<section class="flex justify-center items-center min-h-screen">
    <div class="text-center bg-black/10 backdrop-blur-md p-6 rounded-lg">
        <h1 class="text-6xl text-white font-bold bg-black/10 backdrop-blur-md p-6 rounded-lg" data-aos="fade-up">
            Bienvenue, Voyageurs
        </h1>
        <p class="text-xl text-gray-300 mt-4 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            Découvrez des événements incroyables et explorez des lieux uniques. Votre aventure commence ici !
        </p>
        <?php if (isset($_SESSION['username'])): ?>
            <p class="text-lg text-yellow-500 mt-6" data-aos="fade-up" data-aos-delay="400">
                Bonjour, <?= htmlspecialchars($_SESSION['username']) ?> ! Prêt à explorer ?
            </p>
        <?php endif; ?>
    </div>
</section>